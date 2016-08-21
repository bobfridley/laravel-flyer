@extends('layout')

@section('content')
    <h1>Selling Your Home?</h1>

        <form action="/flyers" method="POST" enctype="multipart/form-data">
            @include('flyers.form')
        </form>

        @include('errors')
@stop