@extends('layout.bootstrap')

@section('content')
@parent

<h1>{{ $page->name }}</h1>

<div>{{ $page->content }}</div>
@stop