@extends('layouts.main')

@section('gate')

<!-- ISI -->
<br><br>
<div class="tabheader">
    
  {{-- HEADING --}}
  <h1>My {{ $title }}</h1>

  {{-- SUMMARY --}}
  <h4>Pada page ini berisi seluruh data user yang ada <br> pada PT. Tolichris</h4>

</div>

{{-- BUTTON ADD NEW --}}
<div class="tabaddnew">
    <div id="overlayuser" onclick="offUseraddTable()"></div>
    <div id="overlayedituser" onclick="offUsereditTable()"></div>



    {{-- BUTTON POP UP FOR CATEGORY--}}
    <button onclick="onUseraddTable()">Add New User +</button>
    <div id="adduserbox" class="adduserbox">
        <form method="post" action="/user/userstore">
            <h1><center>Add {{ $title }} Category </center></h1>
            <h2><center>Tambah/catat category income / pendapatan 
            supaya memantau keuangan menjadi lebih mudah</center></h2>
            
            {{-- CRSF --}}
            @csrf
            <label for="">Full Name : <input type="text" name="name" autocomplete="off" required></label><br>
            <label for="">Username : <input type="text" name="username" autocomplete="off" required></label><br>
            <input type="hidden" name="user_slug" 
                value=
                "   
                    {{-- RANDOM CREATE SLUG --}}
                    @php

                    $catuid = uniqid('gfg', true);
                    echo $catuid;
                    
                    @endphp
               ">
            <label for="">Password : <input type="password" name="password" autocomplete="off" required></label><br>

            <button type="submit">Add new User   + </button>
            <br>
        </form>
    </div>
    {{-- CLOSE OVERLAY --}}
    <div id="overlayuser" onclick="offUseraddTable()"></div>
</div>

{{-- CLEAR --}}
<div class="clear"></div>


<div class="tabcategory">
    {{-- SEARCH FEATURE --}}
    <div class="tabsearch">
        <p>Search: <input type="text" placeholder="search . ."></p>
    </div>

    {{-- SHOWING ENTRIES --}}

    <p>Show 1 entries </p> 
    {{-- TABLE --}}

        <div class="tabtable">    
            <table width="100%">
                <tr>
                    {{-- TABLE HEADER --}}
                    <th><center>No</center></th> 
                    <th><center>Nama User</center></th>
                    <th><center>Username</center></th>
                    <th><center>Action</center></th>
                </tr>
                <tr>
                    {{-- LINE CUTTER --}}
                    <td colspan="99"><div class="line"></div></td>
                </tr>
                    {{-- FOR EACH --}}
                    @foreach ( $users as $user)
                        <tr>
                            {{-- TABLE MAIN SECTION --}}
                            <td><center>{{ $number++ }}.</center></td>
                            <td><center>{{ $user->name }}</center></td>
                            <td><center>{{ $user->username }}</center></td>
                            <td>
                                <center>
                                    <a href="/user/editlanding/{{ $user->user_slug }}"><button><img src="/img/pencil_white.png" alt=""></button></a> 
                                    <a href="/user/userdelete/{{ $user->user_slug }}"><button><img src="/img/trash_white.png" alt=""></button></a>
                                </center>
                            </td>
                        </tr>
                        <tr>
                          <td colspan="99"><div class="space"></div></td>
                        </tr>
                    @endforeach
            </table>
    <br>
    {{-- EDIT CATEGORY LIST --}}
    @foreach ( $edits as $edit)
    <div class="tabaddnew"> 
      <div id="edituserbox" class="edituserbox">

          <form method="get" action="/user/useredit/{{ $edit->user_slug }}">
              <h1><center>Edit {{ $title }} Category </center></h1>
              <h2><center>Tambah/catat category income / pendapatan 
              supaya memantau keuangan menjadi lebih mudah</center></h2>
              
              @csrf
              
              <label for="">Full Name : <input type="text" name="full_name" value="{{ $edit->name }}" autocomplete="off" required></label><br>
            <label for="">Username : <input type="text" name="username" value="{{ $edit->username }}" autocomplete="off" required></label><br>
            <input type="hidden" name="user_slug" 
                value=
                "   
                    {{-- RANDOM CREATE SLUG --}}
                    @php

                    $catuid = uniqid('gfg', true);
                    echo $catuid;
                    
                    @endphp
               ">
            <label for="">Password : <input type="password" name="password" autocomplete="off" required></label><br> 
              <button type="submit">Add new Income + </button>
              <br>
          </form>
      </div> 
  </div>
  @endforeach













  
{{-- SCRIPT --}}
@if ( $editcategoryjs == 1 )
<script>    
    const categoryPop = document.getElementById('edituserbox');
    const categoryOverlay = document.getElementById('overlayedituser');

    categoryPop.style.display = "block";
    categoryPop.display = "none";
    categoryOverlay.style.display = "block"
</script>


@elseif ( $editcategoryjs == 2 )
<script>    
    const categoryPop = document.getElementById('overlayuser');
    const categoryOverlay = document.getElementById('overlayuser');

    categoryPop.style.display = "block";
    categoryPop.display = "none";
    categoryOverlay.style.display = "block"
</script>
@endif

        
@endsection



