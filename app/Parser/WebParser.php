<?php

namespace App\Parser;

use App\Game;
use App\Category;
use App\Clue;
use App\FinalClue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class WebParser
{

    protected string $url;
    private int $game_id;

    public function __construct($game_id)
    {
        $this->game_id = $game_id;
        $this->url = "http://www.j-archive.com/showgame.php?game_id=$game_id";
    }

    public function parse()
    {
        $game = Game::query()->find($this->game_id);
        if ($game !== null) {
            return $game;
        }

        $data = Http::get($this->url);

        $crawler = new Crawler();
        $crawler->addHtmlContent($data);

        $game_date = new Carbon(trim(explode('-', $crawler->filter('#game_title')->text())[1]));

        $game = Game::build($this->game_id, $game_date);

        $roundNumber = 1;

        $rounds = $crawler->filter('table.round')->each(function ($round) use ($game, &$roundNumber) {
            $categories = $this->processRound($round, $game, $roundNumber);
            $roundNumber++;

            return $categories;
        });

        $final_category = $crawler->filter('#final_jeopardy_round td.category_name')->first()->text();
        $final_clue = $crawler->filter('td#clue_FJ')->first()->text();

        $final_text = $crawler->filter('.final_round div')->first()->attr('onmouseover');

        // 19 is number of characters in correct_response\">
        $start = strpos($final_text, 'correct_response') + 19;

        $final_answer = substr($final_text, $start);

        $final_answer = substr($final_answer, 0, strpos($final_answer, '</'));

        FinalClue::build($game, $final_category, $final_clue, $final_answer);

        return $game;
    }

    public function parseNormal()
    {
        // TODO: Implement parseNormal() method.
    }

    public function parseDouble()
    {
        // TODO: Implement parseDouble() method.
    }

    public function parseFinal()
    {
        // TODO: Implement parseFinal() method.
    }

    private function processRound(Crawler $round, Game $game, $roundNumber = 1)
    {
        $categories = $round->filter('td.category_name')
            ->each(function (Crawler $element) use ($game, $roundNumber) {
                return Category::build($game, $element->text(), [ 'double_jeopardy' => ($roundNumber > 1 )]);
            });

        $clueNumber = 0;

        $clues = $round->filter('td.clue')->each(function (Crawler $clueElement) use (&$clueNumber, $roundNumber, $categories) {
            /** @var Category $category */
            $category = $categories[$clueNumber % 6];

            $clueNumber++;

            $clue = null;
            $answer = null;
            $value = null;
            $daily_double = false;

            $text = trim($clueElement->text());
            if ($text == null || $text == "" || empty($text)) {
                return $category->markIncomplete();
            }

            $clue = $clueElement->filter('td.clue_text')->first()->text();
            $answerMouseover = $clueElement->filter('div')->getNode(0)->attributes->getNamedItem('onmouseover')->nodeValue;
            $matches = [];
            preg_match('{<em class="correct_response">(.*)</em>}', $answerMouseover, $matches);

            $answer = $matches[1];
            try {
                $value = $this->cleanValue($clueElement->filter('td.clue_value')->first()->text());
            } catch (\InvalidArgumentException $exception) {
                // Should be thrown if we hit a daily double.

                // We need to determine the proper value for this clue, not what the wager was.
                $valueModifier = ceil($clueNumber / 6);
                $baseClueValue = $roundNumber * 200;
                $value = $valueModifier * $baseClueValue;
                $daily_double = true;
            }

            return Clue::build($category, $value, $clue, $answer, $daily_double);
        });

        return $categories;
    }

    /**
     * Clean the clue values from the DOM.
     *
     * They all contain dollar signs, which we don't want, and if the clue was a daily double, the value is preceeded by "DD: "
     *
     * @param $value
     * @return int
     */
    private function cleanValue($value)
    {
        $value = Str::of($value);

        if ($value->startsWith('DD:')) {
            // Should get caught by the daily double handler.
            throw new \InvalidArgumentException;
        }

        $value = str_replace("$", "", $value);
        $value = str_replace("DD:", "", $value);
        $value = trim($value);
        return (int)$value;
    }

}
