@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Tour | HC Travel Admin')

@section('content')
    @livewire('admin.tours.edit-tour', ['tourId' => $tour->id])
@endsection
