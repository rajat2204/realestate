@extends('layouts.app_front')
@section('content')
@includeIf('includes.header')
@includeIf($view)
@includeIf('includes.footer')
@endsection