@extends('layouts.utilities')

@section('gate')

{{-- ISI --}}

<div class="left">
    <div class="container">
        <div class="image">
            <img src="/img/With-Name.png" alt="">
        </div>
        <form action="home" method="post">
    
        <!-- USERNAME -->
            <div class="field">
                <i class='bx bxs-user bx-sm'></i>
                    <span class="tooltip"></span>
                <input type="text" placeholder="Email Address   " name="username" require>
            <div class="line"></div>
            </div>
        <!-- PASSWORD -->
            <div class="field">
                <i class='bx bxs-lock-alt bx-sm' ></i>
                    <span class="tooltip"></span>
                <input type="password" placeholder="Password" name="password" require>
            <div class="line"></div>

        <!-- FORGOT YOUR PASSWORD -->
            <div class="rememberme">
                <input type="checkbox">
                <a href="">Remember Me</a>
            </div>
    
        <!-- FORGOT YOUR PASSWORD -->
            <div class="lupaPass">
                <a href="">Forgot your password?</a>
            </div>
    
            <button>Login</button>  

            <div class="register">
                <p>Don't have an account? <a href="">Sign Up</a></p>
            </div>
        </form>
    </div>
</div>

@endsection