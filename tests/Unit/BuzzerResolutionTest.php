<?php

namespace Tests\Unit;

use App\Buzz;
use App\Clue;
use App\Game;
use App\Player;
use App\Session;
use Tests\TestCase;

class BuzzerResolutionTest extends TestCase
{

    /**
     * @test
     */
    public function it_can_compute_the_resolution_of_three_buzzes()
    {
        $session = Session::factory();

        $clue = $session->game->clues()->inRandomOrder()->first();

        $player1 = Player::factory();
        $player2 = Player::factory();
        $player3 = Player::factory();

        $session->addPlayer($player1);
        $session->addPlayer($player2);
        $session->addPlayer($player3);

        $this->actingAs($player1);

        $session->showClue($clue);
        $session->activateBuzzer();

        $player1->buzzIn(300);
        $player3->buzzIn(150);
        $player2->buzzIn(400);


        $resolution = $session->resolveBuzzer();

        $this->assertEquals($player3->id, $resolution->winner->id);
        $this->assertFalse($session->isBuzzerActive());
    }

}
