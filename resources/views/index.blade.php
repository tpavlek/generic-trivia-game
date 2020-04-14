@extends('layout')

@section('content')

    <form action="{{ URL::route('session.new') }}" method="POST">
        @csrf

        <label for="game_id">Game ID (optional)
            <input type="text" name="game_id" />
        </label>

        <label for="min_year">Minimum Year (optional)
            <input type="number" name="min_year" />
        </label>

        <input type="submit" value="Start new session" />
    </form>

@endsection
