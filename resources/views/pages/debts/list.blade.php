@extends('layouts.main')

@section('gate')

<!-- ISI -->

@php

$number = 1;
$subtotal = 0;
$total = 0;
$entry = 0;
$entries = 0;

@endphp

<br><br>

    @include('pages.incomes.category')

    <br>
    
    @include('pages.incomes.list')



        
@endsection



