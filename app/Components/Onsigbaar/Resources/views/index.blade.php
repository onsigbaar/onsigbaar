@extends('onsigbaar::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from component: {!! config('onsigbaar.name') !!}
    </p>
@stop
