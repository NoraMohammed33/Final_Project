
{{--@vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}


@extends('layouts.appAdmin')
@section('content')
{{--   @dd( Auth::user()->isadmin);--}}
@if(Auth::user()->isadmin)
    <h1>yaaa haaaalaaaaa</h1>
<router-view></router-view>
    @endif
@endsection

