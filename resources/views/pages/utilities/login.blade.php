@extends('layouts.utilities')

@section('gate')

{{-- ISI --}}

<div class="left">
    <div class="container">
        <div class="image">
            <img src="/img/With-Name.png" alt="">
        </div>

          @if(session()->has('success'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>{{ session('success'); }}</strong>
              </button>
            </div>
          @endif

        <form action="/login" method="post">
            
        @csrf

            <div class="field">
                <i class='bx bxs-user bx-sm'></i>
                    <span class="tooltip is-invalid"></span>
                <input type="text" placeholder="Username" name="username" autofocus require>
            <div class="line"></div>
            </div>

            <div class="field">
                <i class='bx bxs-lock-alt bx-sm' ></i>
                    <span class="tooltip"></span>
                <input type="password" placeholder="Password" name="password" require>
            <div class="line"></div>

            <div class="rememberme">
                <input type="checkbox">
                <a href="">Remember Me</a>
            </div>
    
            <div class="lupaPass">
                <a href="/emergency">Let's sign up?</a>
            </div>
    
            <button type="submit">Login</button>  

            {{-- <div class="register">
                <p>Don't have an account? <a href="">Sign Up</a></p>
            </div> --}}
        </form>
    </div>
</div>

@endsection