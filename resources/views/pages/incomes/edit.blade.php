@extends('layouts.main')

@section('gate')

<!-- ISI -->

<form method="get" action="/income/editcategory/{{ $update }}">
    <h1><center>Edit {{ $title }} Category </center></h1>
    <h2><center>Tambah/catat category income / pendapatan 
    supaya memantau keuangan menjadi lebih mudah</center></h2>
    
    @csrf
    
    @foreach ( $incats as $incat)
        <label for="">Category Name : <input type="text" name="incat_name" autocomplete="off" value="{{ $incat->name }}" required></label><br>
    @endforeach  
    <button type="submit">Add new Income + </button>
    <br>
</form>

        
@endsection



