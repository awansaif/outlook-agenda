@extends('layout')

@section('content')
<div class="jumbotron ">
    <h1>MY OUTLOOK SECRET</h1>
    <p class="lead">
        Login to access your dashboard
    </p>
    <a href="{{ Route('login') }}" class="btn btn-primary btn-large">Click here to sign in</a>
</div>
@endsection
