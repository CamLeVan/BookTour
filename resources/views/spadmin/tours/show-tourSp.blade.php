@extends('layouts.spadmin')

@section('title', 'Chi tiết Tour | HC Travel SPAdmin')

@section('content')
    @livewire('spadmin.tours.show', ['tour' => $tour])
@endsection
