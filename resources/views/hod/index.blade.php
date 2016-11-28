@extends('layouts.authorized')

@if(isset($record))
@section('department')
   {{ $record->id }}
@endsection
@endif