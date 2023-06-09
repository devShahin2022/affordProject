@extends('layouts.master')
@section('title',"Profile")
@section('content')
    <h1 class="display-3 my-3">This is Profile - {{ Auth::user()->username }}</h1>
@endsection