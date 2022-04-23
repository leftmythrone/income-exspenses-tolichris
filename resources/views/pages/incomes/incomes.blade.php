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
    
    {{-- button add new --}}
        <div class="tabaddnew">
            <div id="overlaycategory" onclick="offCategory()"></div>
            <button onclick="onCategory()">Add new category +</button>
            <div id="addcategorybox" class="addcategorybox">
                <form method="post" action="/income/addcategory">
                    <h1><center>Add Income Category </center></h1>
                    <h2><center>Tambah/catat category income / pendapatan 
                    supaya memantau keuangan menjadi lebih mudah</center></h2>
                    {{ csrf_field() }}
                        <label for="">Category Name : <input type="text" name="incat_name" required></label><br>
                        <input type="hidden" name="incat_date" value="{{ date("l, d-M-Y"); }}">
                        <input type="hidden" name="token" 
                        value=
                        "                        
                            @php
        
                            $myuid = uniqid('gfg', true);
                            echo $myuid;
                            
                            @endphp
                       ">
                        
                    {{-- <input type="hidden" name="incat_date" value="{{ date("l, d-M-Y") }}"> --}}
                    {{-- <br> --}}
                    <button type="submit" >Add new Income + </button>
                    <br>
                    <br>
                </form>
            </div>
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
                                <th><center>Category Name / Nama Kategori</center></th>
                                <th><center>Jenis Kas</center></th>
                                <th><center>Date</center></th>
                                <th><center>Total</center></th>
                                <th><center>Action</center></th>
                            </tr>

                            <tr>
                                {{-- LINE CUTTER --}}
                                <td colspan="99"><div class="line"></div></td>
                            </tr>
                    
                                {{-- FOR EACH --}}
                                @foreach ($categories as $category) 
                                    <tr>
                                        {{-- TABLE MAIN SECTION --}}
                                        <td> <center> {{ $number++ }}. </center></td>
                                        <td><center>{{ $category->name }}</center></td>
                                        <td><center>{{ "Kas Kecil" }}</center></td>
                                        <td><center>{{ $category->incat_entry_date }}</center></td>
                                        <td>
                                            <center>

                                                {{-- PERHITUNGAN PER CATEGORY  --}}
                                                    
                                                @foreach ( $incomes as $calculate )

                                                    @if ($category->name === $calculate->income_category->name)
                                                        
                                                        @php
                                                            $subtotal = $subtotal + $calculate->nominal
                                                        @endphp

                                                    @endif

                                                @endforeach


                                                
                                                Rp. {{ $subtotal }},00

                                                @php

                                                $subtotal = 0;

                                                @endphp

                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <button><img src="/img/eye_white.png" alt=""></button> 
                                                <button><img src="/img/pencil_white.png" alt=""></button> 
                                                <a href="/income/deletecategory/{{ $category->incat_entry_token }}"><button><img src="/img/trash_white.png" alt=""></button></a>
                                            </center>
                                        </td>
                                    </tr>

                                    <tr>
                                        {{-- SPACER --}}
                                        <td><div class="space"></div></td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="99"><hr></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td><center><b>Total : </b></center></td>
                                        <td>
                                            @foreach ( $incomes as $income )
                                            
                                            @php 
                                                $total = $total + $income->nominal
                                            @endphp

                                            @endforeach
                                            <center>
                                                Rp.{{ $total }},00
                                            </center>
                                            
                                        </td>
                                    </tr>
                        </table>
                    </div> 
                <br>

                {{-- ENTRIES --}}
                <p>Showing 1 to {{ 1 }} of {{ $number - 1 }} entries</p>

                @php
                                
                $number = 1;

                @endphp

                
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
                    <div class="container w-50 bg-warning">
                        <h1>Add Income Overvie</h1>
                        <h2>Tambah/catat setiap pemasukan pada hari ini
                            agar pemasukan menjadi lebih banyak</h2>
                        <form method="post" action="/income/addnew">
                            <table>
                                <tr>
                                    <td><center> <label for="">Income Description</label> </center></td>
                                    <td><center> : </center></td>
                                    <td><center> <input type="text" name="input_decs" required> </center></td>
                                </tr>
                                <tr>
                                    <td><center> <label for="">Income Category</label> </center></td>
                                    <td><center> : </center></td>
                                    <td>
                                        <center>
                                            <input type="text" name="input_cats" required>
                                            <datalist id="incomeList">
                                                @foreach ( $categories as $category )
                                                    <option value="{{ $category->name }}">  
                                                @endforeach
                                            </datalist> 
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td><center> <label for="">Kas besar / Kas kecil</label> </center></td>
                                    <td><center> : </center></td>
                                    <td><center> <input type="text" name="input_type" required> </center></td>
                                </tr>
                                <tr>
                                    <td><center> <label for="">nominal</label> </center></td>
                                    <td><center> : </center></td>
                                    <td>
                                        <center> 
                                            <input type="text" name="input_nominal" required>                
                                            <input type="hidden" name="input_date" value="{{ date("l, d-M-Y"); }}">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        </center>
                                    </td>
                                </tr>
                                <tr> 
                                    <td colspan="2"> </td>
                                    <td>
                                        <center>
                                            <input type="submit" value="Simpan Data">
                                        </center>
                                    </td>
                                </tr>
                            </table>    
                        </form>
                    </div>
                    <button type="submit" >Add new Income + </button>
                    <br>
                    <br>
                </form>
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
                                    <td><center> {{ $number++ }}. </center></td>
                                    <td><center>{{ $income->income_description }}</center></td>
                                    <td><center>{{ $income->income_category->name }}</center></td>
                                    <td><center>{{ "Kas Kecil" }}</center></td>
                                    <td><center>Rp. {{ $income->nominal }},00</center></td>
                                    <td><center>{{ $income->income_entry_date }}</center></td>
                                    <td>
                                        <center>
                                            <button><img src="/img/eye_white.png" alt=""></button> 
                                            <button><img src="/img/pencil_white.png" alt=""></button> 
                                            <a href="/income/hapus/{{ $income->id }}"><button><img src="/img/trash_white.png" alt=""></button></a>
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
        <p>Showing 1 to {{ 1 }} of {{ $number - 1 }} entries</p>
    
        {{-- INI YA BAGIAN --}}


    </div>
        
@endsection



