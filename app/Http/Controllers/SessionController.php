<?php

namespace App\Http\Controllers;

use App\Events\PlayerJoined;
use App\Player;
use App\Session;
use App\SessionOptions;
use Faker\Generator;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function new(Request $request)
    {
        $session = Session::build(SessionOptions::fromRequest($request));

        return redirect()->route('session.observe', $session);
    }

    public function observe(Session $session)
    {
        return view('game')->with('session', $session);
    }

    public function join(Session $session)
    {
        $name = app(Generator::class)->firstName;
        broadcast(new PlayerJoined($session, Player::build($name)));
        return response()->json([]);
    }

    public function play(Session $session)
    {
        return view('play')->with('session', $session);
    }
}
