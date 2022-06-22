@extends('layouts.main')

@section('gate')

<!-- ISI -->

@php

$number = 1;
$subtotal = 0;
$total = 0;
$entry = 0;

@endphp


<br><br>

@include('pages.expenses.crud')


@include('pages.expenses.category')

<br>

@include('pages.expenses.list')

{{-- SCRIPT --}}
@if ( $editcategoryjs == 1 )

{{-- SCRIPT EDIT CATEGORY --}}
<script>    
    const categoryPop = document.getElementById('editcategorybox');
    const categoryOverlay = document.getElementById('overlayeditcategory');

    categoryPop.style.display = "block";
    categoryPop.display = "none";
    categoryOverlay.style.display = "block"
</script>

{{-- SCRIPT VIEW CATEGORY --}}
@elseif ( $editcategoryjs == 2 )
<script>    
    const categoryPop = document.getElementById('viewcategorybox');
    const categoryOverlay = document.getElementById('overlayviewcategory');

    categoryPop.style.display = "block";
    categoryPop.display = "none";
    categoryOverlay.style.display = "block"
</script>

{{-- SCRIPT EDIT LIST --}}
@elseif ( $editcategoryjs == 3 )
<script>    
    const listPop = document.getElementById('edittablebox');
    const listOverlay = document.getElementById('overlayedittable');

    listPop.style.display = "block";
    listPop.display = "none";
    listOverlay.style.display = "block"
</script>

{{-- SCRIPT VIEW LIST --}}
@elseif ( $editcategoryjs == 4 )
<script>    
    const listPop = document.getElementById('viewtablebox');
    const listOverlay = document.getElementById('overlayviewtable');

    listPop.style.display = "block";
    listPop.display = "none";
    listOverlay.style.display = "block"
</script>

{{-- SCRIPT DELETE CATEGORY --}}
@elseif ( $editcategoryjs == 5 )
<script>    
    const categoryPop = document.getElementById('deletecategorybox');
    const categoryOverlay = document.getElementById('overlaydeletecategory');

    categoryPop.style.display = "block";
    categoryPop.display = "none";
    categoryOverlay.style.display = "block"
</script>

{{-- SCRIPT DELETE LIST --}}
@elseif ( $editcategoryjs == 6 )
<script>    
    const categoryPop = document.getElementById('deletetablebox');
    const categoryOverlay = document.getElementById('overlaydeletetable');

    categoryPop.style.display = "block";
    categoryPop.display = "none";
    categoryOverlay.style.display = "block"
</script>

@endif


        
@endsection



