@extends('layouts.app')

@section('content')
<!-- <post-component></post-component > -->

<post-component user_id="{{Auth::user()->id}}"/>

@endsection
