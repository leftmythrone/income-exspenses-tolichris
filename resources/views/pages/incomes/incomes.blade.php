@extends('layouts.main')

@section('gate')

<!-- ISI -->

<br><br>

<div class="tabheader">

    {{-- HEADING --}}
    <h1>My Income Category</h1>

    {{-- SUMMARY --}}
    <h4>Pada page ini berisi seluruh category pencatatan <br> keuangan pada PT. Tolichris</h4>
</div>

    {{--  
    |--------------------------------------------------------------------------
    | My Income Category
    |--------------------------------------------------------------------------
    |
    | Pada page ini berisi seluruh category pencatatan
    | keuangan pada PT. Tolichris
    |
    --}}
    
        <div class="tabaddnew">
            <button>Add new income +</button>
        </div>

        <div class="clear"></div>
    

            <div class="tabcategory">
                {{-- SEARCH FEATURE --}}
                <div class="tabsearch">
                    <p>Search: <input type="text" placeholder="search . ."></p>
                </div>

                {{-- SHOWING ENTRIES --}}
                <p>Show {{ 1 }} entries </p> 
                

                {{-- TABLE --}}
                    <div class="tabtable">    
                        <table width="100%">
                            <tr>
                                {{-- TABLE HEADER --}}
                                <th><center>No</center></th> 
                                <th><center>ID</center></th>
                                <th><center>Category Name / Nama Kategori</center></th>
                                <th><center>Jenis Kas</center></th>
                                <th><center>Total</center></th>
                                <th><center>Date</center></th>
                                <th><center>Action</center></th>
                            </tr>
                            <tr>
                                {{-- LINE CUTTER --}}
                                <td colspan="7"><div class="line"></div></td>
                            </tr>
                    
                                {{-- EACH FOR --}}

                                @foreach ($categories as $category) 

                                    {{-- AUTOMATIC VARIABLE --}}
                                    @php

                                    for($x = 0 ; $x < 3 ; $x++)
                                    {

                                    }

                                    @endphp

                                    <tr>
                                        {{-- TABLE MAIN SECTION --}}
                                        <td> <center> {{ $category->id }}. </center></td>
                                        <td> <center> {{ "24592" }} </center></td>
                                        <td>{{ $category->name }}</td>
                                        <td><center>{{ "Kas Kecil" }}</center></td>
                                        <td><center>Rp. {{ $category->incomes }},00</center></td>
                                        <td><center>{{ $category->created_at }}</center></td>
                                        <td>
                                            <center>
                                                <button><img src="/img/eye_white.png" alt=""></button> 
                                                <button><img src="/img/pencil_white.png" alt=""></button> 
                                                <button><img src="/img/trash_white.png" alt=""></button>
                                            </center>
                                        </td>
                                    </tr>

                                    <tr>
                                        {{-- SPACER --}}
                                        <td><div class="space"></div></td>
                                    </tr>

                                @endforeach

                        </table>
                    </div> 
                <br>

                {{-- ENTRIES --}}
                <p>Showing 1 to {{ 1 }} of {{ 1 }} entries</p>
            </div>

    <br><br>

    {{--  
    |--------------------------------------------------------------------------
    | My Income Overview
    |--------------------------------------------------------------------------
    |
    | Pada page ini berisi seluruh transaksi catatan pendapatan yang telah masuk pada PT Tolichris
    |
    --}}

    <div class="tabheader">

        {{-- HEADING --}}
        <h1>My Income Overview</h1>

        {{-- SUMMARY --}}
        <h4>Pada page ini berisi seluruh transaksi catatan pendapatan yang telah masuk pada PT Tolichris</h4>
    </div>

        <div class="tabaddnew">
            <button>Add new income +</button>
        </div>

        <div class="clear"></div>

            <div class="tabcategory">
                {{-- SEARCH FEATURE --}}
                <div class="tabsearch">
                    <p>Search: <input type="text" placeholder="search . ."></p>
                </div>
            
                {{-- SHOWING ENTRIES --}}
                <p>Show {{ 1 }} entries </p> 

            
                    {{-- TABLE --}}
                    <div class="tabtable">    
                        <table width="100%">
                            <tr>
                                {{-- TABLE HEADER --}}
                                <th><center>No</center></th> 
                                <th><center>ID</center></th>
                                <th><center>Income Detail / Detail Pemasukan</center></th>
                                <th><center>Category / Kategori</center></th>
                                <th><center>Kas besar / Kas kecil</center></th>
                                <th><center>Nominal</center></th>
                                <th><center>Date</center></th>
                                <th><center>Action</center></th>
                            </tr>
                            <tr>
                                {{-- LINE CUTTER --}}
                                <td colspan="99"><div class="line"></div></td>
                            </tr>
                        
                                {{-- EACH FOR --}}
                                @foreach ($incomes as $income) 
                            <tr>
                                {{-- TABLE MAIN SECTION --}}
                                <td> <center> {{ $income->id }}. </center></td>
                                    <td> <center> {{ "24592" }} </center></td>
                                    <td>{{ $income->income_description }}</td>
                                    <td><center>{{ $income->income_category->name }}</center></td>
                                    <td><center>{{ "Kas Kecil" }}</center></td>
                                    <td><center>Rp. {{ $income->nominal }},00</center></td>
                                    <td><center>{{ $income->created_at }}</center></td>
                                    <td>
                                        <center>
                                            <button><img src="/img/eye_white.png" alt=""></button> 
                                            <button><img src="/img/pencil_white.png" alt=""></button> 
                                            <button><img src="/img/trash_white.png" alt=""></button>
                                        </center>
                                </td>
                            </tr>
                        
                            <tr>
                                {{-- SPACER --}}
                                <td><div class="space"></div></td>
                            </tr>

                                {{-- PERHITUNGAN / CALCULATE CATEGORY --}}
                                @foreach ($categories as $calculate)

                                    @if ( $income->income_category->name === $calculate->name )
                                        @php
                                            $subtotal = $subtotal + $income->nominal
                                        @endphp
                                        <tr>
                                            <td>
                                                {{ $subtotal }}
                                            </td>
                                        </tr>
                                    @endif
                                    
                                @endforeach


                                



                            @endforeach
                        
                        </table>
                    </div> 
        <br>

        {{-- ENTRIES --}}
        <p>Showing 1 to {{ 1 }} of {{ 1 }} entries</p>
    </div>
        
@endsection



