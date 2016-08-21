@extends('layout')

@section('content')
    {{ Auth::check() }}
    <div class="jumbotron">
      <div class="container">
        <h1>Project Flyer</h1>
        <p>
            This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.
        </p>

        @if ($signedIn)
            <a class="btn btn-primary" href="/flyers/create" role="button">Create a Flyer</a>
        @else
            <a class="btn btn-primary" href="/auth/register" role="button">Sign Up</a>
        @endif
      </div>
    </div>

@stop

