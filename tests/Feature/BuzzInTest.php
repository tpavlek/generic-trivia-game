<?php

namespace Tests\Feature;

use App\Player;
use App\Session;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class BuzzInTest extends TestCase
{

    /**
     * @test
     */
    public function it_denies_a_buzz_when_buzzer_is_not_open()
    {
        $session = Session::factory();
        $player = Player::factory();

        $this->post(route('buzzer.buzz', [ 'session' => $session ]), [ 'player_id' => $player->id, 'buzz_time' => 330 ])
            ->assertOk()
            ->assertJson([
                'message' => "Buzzer is closed"
            ]);

        $this->assertFalse($session->game->refresh()->isBuzzerOpen());
    }

    /**
     * @test
     */
    public function it_can_buzz_in()
    {
        $session = Session::factory();
        $player = Player::factory();

        $this->post(route('buzzer.buzz', [ 'session' => $session ]), [ 'player_id' => $player->id, 'buzz_time' => 330 ]);

        $session->game->buzzes();
    }

}
