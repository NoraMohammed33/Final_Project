@extends('layouts.app')

@section('content')
    <addexpert-component user_id="{{Auth::user()->id}}></addexpert-component >

@endsection
