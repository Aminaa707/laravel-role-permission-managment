@extends('backend.errors.errors_layout')
@section('err-content')
<h2>403</h2>
<p>Access to this resource on the server is denied</p>
<p>{{$exception->getMessage()}}</p>
<a href="index.html">Back to Dashboard</a>
@endsection