@extends('layouts.app')

@section('content')

<addpost-component user_id="{{Auth::user()->id}}"/>

@endsection
