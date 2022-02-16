@extends('layouts.app')
@section('content')
<h1>hello world</h1>
<div id="example"></div>
@endsection
@section('sidebar')
@parent
<h1>This is the sidebar append</h1>
@endsection
