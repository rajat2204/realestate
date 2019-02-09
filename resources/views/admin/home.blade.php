@extends('admin.layouts.app')
@section('content')
@includeIf('admin.includes.header')
	@includeIf('admin.includes.sidebar')
	@includeIf($view)
@includeIf('admin.includes.footer')
@endsection