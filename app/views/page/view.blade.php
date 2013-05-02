@extends('layout.bootstrap')

@section('content')
@parent

<div style="margin-top:30px;">{{ $page->content }}</div>
@stop