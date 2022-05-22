<div class="sidebar">
  <div class="logo">
    <img src="/img/Logo.png" alt="">
  </div>
  <br>
  <div class="sideheading">
    <h1>PT Tolichris Surabaya</h1>
    <h4>Aplikasi Management Keuangan</h4>
    <h4>Welcome, {{ auth()->user()->name }}</h4>
  </div>

  <br><br>
  <ul>


    @if ( auth()->user()->username === 'admin' )
    <li>
      {{-- ICON --}}
      <div class="sideicon">
        <img src="/img/bank_account.png" alt="">
      </div>
      {{-- FONT --}}
      <div class="sidefont">
        <a href="/account">List of Account / <br> Daftar Akun</a>
      </div>
    </li>
    @endif
     
    {{-- 
    |--------------------------------------------------------------------------
    | PAGE INCOMES / PEMASUKAN
    |-------------------------------------------------------------------------- 
    --}}

    <li>
      {{-- ICON --}}
      <div class="sideicon">
        <img src="/img/chart_up.png" alt="" id="test"> 
      </div>
      {{-- FONT --}}
      <div class="sidefont">
        <a href="/income" id="incomeJs">Incomes / Pemasukan</a>
      </div>
    </li>

    {{-- 
    |--------------------------------------------------------------------------
    | PAGE EXPENSES / PENGELUARAN
    |-------------------------------------------------------------------------- 
    --}}
    
    <li>
      {{-- ICON --}}
      <div class="sideicon">
        <img src="/img/chart_down.png" alt="">
      </div>
      {{-- FONT --}}
      <div class="sidefont">
        <a href="/expense">Expense / Pengeluaran</a>
      </div>
    </li>
    
    {{-- 
    |--------------------------------------------------------------------------
    | PAGE DEBTS / HUTANG DAN PIUTANG
    |-------------------------------------------------------------------------- 
    --}}

    @if ( auth()->user()->username === 'admin' )
    <li>
      {{-- ICON --}}
      <div class="sideicon">
        <img src="/img/debt.png" alt="">
      </div>
      {{-- FONT --}}
      <div class="sidefont">
        <a href="/debt">Debts / Utang</a>
      </div>
    </li>
    @endif


    {{-- 
    |--------------------------------------------------------------------------
    | PAGE USERS MANAGEMENT / MANAJEMEN PENGGUNA
    |-------------------------------------------------------------------------- 
    --}}

    @if ( auth()->user()->username === 'admin' )

    <li>
      {{-- ICON --}}
      <div class="sideicon">
        <img src="/img/user_manage.png" alt="">
      </div>
      {{-- FONT --}}
      <div class="sidefont">
        <a href="/user">User Management / Manajemen Pengguna</a>
      </div>
    </li>

    @endif

    {{-- 
    |--------------------------------------------------------------------------
    | PAGE CHART / GRAFIK
    |-------------------------------------------------------------------------- 
    --}}

    @if ( auth()->user()->username === 'admin' )
    <li>
      {{-- ICON --}}
      <div class="sideicon">
        <img src="/img/graph.png" alt="">
      </div>
      {{-- FONT --}}
      <div class="sidefont">
        <a href="/mychart">Chart / Grafik</a>
      </div>
    </li>
    @endif

    {{-- 
    |--------------------------------------------------------------------------
    | PAGE LOGOUT
    |-------------------------------------------------------------------------- 
    --}}

    <li>
      {{-- ICON --}}
      <div class="sideicon">
        <img src="/img/logout.png" alt="">
      </div>
      {{-- FONT --}}
      <div class="sidefont">
        <a href="/logout">Logout / Keluar</a>
      </div>
    </li>
    
  </ul>
</div>

