@extends('layouts.main')

@section('gate')

<!-- ISI -->


<br><br>

@include('pages.accounts.crud')


@include('pages.accounts.calculation')

{{-- SCRIPT --}}
@if ( $editcategoryjs == 1 )

{{-- SCRIPT EDIT CATEGORY --}}
<script>    
    const categoryPop = document.getElementById('sumbox');
    const categoryOverlay = document.getElementById('overlaysum');

    categoryPop.style.display = "block";
    categoryPop.display = "none";
    categoryOverlay.style.display = "block"
</script>

{{-- SCRIPT VIEW CATEGORY --}}
@elseif ( $editcategoryjs == 2 )
<script>    
    const categoryPop = document.getElementById('subbox');
    const categoryOverlay = document.getElementById('overlaysub');

    categoryPop.style.display = "block";
    categoryPop.display = "none";
    categoryOverlay.style.display = "block"
</script>

{{-- SCRIPT EDIT LIST --}}
@elseif ( $editcategoryjs == 3 )
<script>    
    const listPop = document.getElementById('overlayediteaccount');
    const listOverlay = document.getElementById('editaccount');

    listPop.style.display = "block";
    listPop.display = "none";
    listOverlay.style.display = "block"
</script>

{{-- SCRIPT VIEW LIST --}}
@elseif ( $editcategoryjs == 4 )
<script>    
    const listPop = document.getElementById('deleteaccount');
    const listOverlay = document.getElementById('overlaydeleteaccount');

    listPop.style.display = "block";
    listPop.display = "none";
    listOverlay.style.display = "block"
</script>

{{-- SCRIPT VIEW LIST --}}
@elseif ( $editcategoryjs == 5 )
<script>    
    const listPop = document.getElementById('cleartable');
    const listOverlay = document.getElementById('overlayclear');

    listPop.style.display = "block";
    listPop.display = "none";
    listOverlay.style.display = "block"
</script>

@endif

        
@endsection



