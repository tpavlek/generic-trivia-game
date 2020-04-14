<?php /** @var \App\Session $session */ ?>
@extends('layout')

@section('content')

    <jeopardy-game session-id="{{ $session->id }}"></jeopardy-game>

@endsection
