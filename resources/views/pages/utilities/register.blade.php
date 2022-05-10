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
    <div id="overlaycategory" onclick="offCategory()"></div>
    <div id="overlayviewcategory" onclick="offViewCategory()"></div>

    {{-- BUTTON POP UP FOR CATEGORY--}}
    <button onclick="onCategory()">Add new category +</button>
    <div id="addcategorybox" class="addcategorybox">
        <form method="post" action="/income/addcategory">
            <h1><center>Add {{ $title }} Category </center></h1>
            <h2><center>Tambah/catat category income / pendapatan 
            supaya memantau keuangan menjadi lebih mudah</center></h2>
            
            {{-- CRSF --}}
            @csrf
            <label for="">Category Name : <input type="text" name="incat_name" autocomplete="off" required></label><br>
            <input type="hidden" name="incat_date" value="{{ date("l, d-M-Y"); }}">
            <input type="hidden" name="incat_slug" 
                value=
                "   
                    {{-- RANDOM CREATE SLUG --}}
                    @php

                    $catuid = uniqid('gfg', true);
                    echo $catuid;
                    
                    @endphp
               ">
                
            <button type="submit">Add new Income + </button>
            <br>
        </form>
    </div>
    {{-- CLOSE OVERLAY --}}
    <div id="overlayeditcategory" onclick="offEditCategory()"></div>
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
                    <th><center>Role</center></th>
                    <th><center>Action</center></th>
                </tr>
                <tr>
                    {{-- LINE CUTTER --}}
                    <td colspan="99"><div class="line"></div></td>
                </tr>
        
                    {{-- FOR EACH --}}
                        <tr>
                            {{-- TABLE MAIN SECTION --}}
                            <td><center> </center></td>
                            <td><center> </center></td>
                            <td><center> </center></td>
                            <td><center> </center></td>
                            <td>
                                <center>
                                    <a href="/user/userview/"><button><img src="/img/eye_white.png" alt=""></button></a>
                                    <a href="/user/useredit/"><button><img src="/img/pencil_white.png" alt=""></button></a> 
                                    <a href="/user/userdelete/"><button><img src="/img/trash_white.png" alt=""></button></a>
                                </center>
                            </td>
                        </tr>
            </table>
    <br>
    {{-- ENTRIES --}}
    <p>Showing 1 to 1 of 1 entries</p>
</div>


<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
  
                  <form class="mx-1 mx-md-4" method="post" action="/registerstore">
                    
                    @csrf
                    
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" id="form3Example1c" name="name" class="form-control @error('name')is-invalid @enderror" value="{{ old('name') }}" required/>
                        <label class="form-label" for="form3Example1c">Your Name</label>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                          </div>
                        @enderror

                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="text" id="form3Example1c" name="username" class="form-control @error('username')is-invalid @enderror" value="{{ old('username') }}" required/>
                          <label class="form-label" for="form3Example1c">Your Username</label>

                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                      </div>
                    @enderror

                        </div>
                      </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="email" id="form3Example3c" name="email" class="form-control @error('email')is-invalid @enderror" value="{{ old('email') }}" required/>
                        <label class="form-label" for="form3Example3c">Role</label>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                          </div>
                        @enderror

                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4c" name="password" class="form-control @error('password')is-invalid @enderror"  required/>
                        <label class="form-label" for="form3Example4c">Password</label>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                          </div>
                        @enderror

                      </div>
                    </div>
  
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg">Register</button>
                    </div>
  
                  </form>
  
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
  
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

        
@endsection



