@extends('layouts.spadmin')

@section('content')
<div class="container">
    <h1>Super Admin Dashboard</h1>
    <p>Welcome {{ Auth::user()->name }}</p>
</div>
@endsection
