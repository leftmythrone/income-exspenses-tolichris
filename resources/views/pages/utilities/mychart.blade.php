@extends('layouts.main')

@section('gate')

{{-- ISI --}}

<div class="tabheader">

    {{-- HEADING --}}
    <h1>Monthly Chart</h1>

    {{-- SUMMARY --}}
    <h4>Pada page ini berisi seluruh cash flow pada PT. Tolichris</h4>
</div>

{{-- TABLE --}}
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
                    <th><center>Cash Flow / Arus Kas</center></th>
                    <th><center>Income Category / Kategori Pemasukan</center></th>
                    <th><center>Total</center></th>
                    <th><center>Date ( Month ) / Pada Bulan </center></th>
                </tr>

                <tr>
                    {{-- LINE CUTTER --}}
                    <td colspan="99"><div class="line"></div></td>
                </tr>
        
                    {{-- FOR EACH --}} 
                <tr>
                    {{-- 
                    |--------------------------------------------------------------------------
                    | INCOME MY CHART
                    |--------------------------------------------------------------------------
                    |
                    | Here is where you can register web routes source of utilities for your application. These
                    | routes are loaded by the RouteServiceProvider within a group which
                    | contains the "web" middleware group. Now create something great!
                    |
                     --}}                            
                     <td><center> 1. </center></td>
                     <td><center><b>Income / Pemasukan</b></center></td>
                     <td><center>{{ $incats[0]->name }}</center></td>
                     <td><center>
                          @foreach ( $incomes as $income ) 
                          
                          @if ( $income->income_category->name === $incats[0]->name )
                            
                            @php
                                                                                                            
                                $subtotal = $subtotal + $income->nominal                                    
                            
                            @endphp

                          @endif

                                    
                            @endforeach                                    
                            Rp. {{ $subtotal }},00 
                            
                            @php

                                $total = $total + $subtotal

                            @endphp
                        </center>                            
                    </td>                            
                    <td><center>{{ "Maret" }}</center>
                    </td>                            
                </tr>
                    @php
                        $subtotal = 0;
                    @endphp

                {{-- TABLE ROW EACH CATEGORY --}}

                @foreach ($incats->skip(1) as $incat )

                    <tr>
                        <td colspan="2"></td>
                        <td><center>{{ $incat->name }}</center></td>
                        <td><center>
                            @foreach ( $incomes as $income ) 
                            
                                @if ( $income->income_category->name === $incat->name )

                                    @php

                                        $subtotal = $subtotal + $income->nominal                                    

                                    @endphp

                                @endif

                            @endforeach
                                                                
                            Rp. {{ $subtotal }},00

                            @php
                                    
                            $total = $total + $subtotal
                                                    
                            @endphp
                            
                            @php

                            $subtotal = 0;

                            @endphp
                            </center>                            
                        </td> 
                    </tr>

                    {{-- SPACER TABLE ROW --}}
                    <tr>
                        <td><div class="space"></div></td>
                    </tr>

                @endforeach

                {{--  
                |--------------------------------------------------------------------------
                | T O T A L
                |--------------------------------------------------------------------------
                --}}
                <tr>
                    <td colspan="99"><hr></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><center><b>Total : </b></center></td>
                    <td>
                        <center>
                            {{-- PADA BULAN --}}
                            Rp. {{ $total }},00
                        </center>   
                    </td>
                    <td><center>Dikurangi Pengeluaran</center></td>
                </tr>  
                <tr>
                    <td colspan="99"><hr></td>
                </tr>
                
                <tr>
                    {{-- 
                    |--------------------------------------------------------------------------
                    | EXPENSE MY CHART
                    |--------------------------------------------------------------------------
                    |
                    | Here is where you can register web routes source of utilities for your application. These
                    | routes are loaded by the RouteServiceProvider within a group which
                    | contains the "web" middleware group. Now create something great!
                    |
                     --}}                            
                     <td><center> 2. </center></td>
                     <td><center><b>Expense / Pengeluaran</b></center></td>
                     <td><center>{{ $incats[0]->name }}</center></td>
                     <td><center>
                          @foreach ( $incomes as $income ) 
                          
                          @if ( $income->income_category->name === $incats[0]->name )
                            
                            @php
                                                                                                            
                                $subtotal = $subtotal + $income->nominal                                    
                            
                            @endphp

                          @endif

                                    
                            @endforeach                                    
                            Rp. {{ $subtotal }},00 
                            
                            @php

                                $total = $total + $subtotal

                            @endphp
                        </center>                            
                    </td>                            
                    <td><center>{{ "Maret" }}</center>
                    </td>                            
                </tr>
                    @php
                        $subtotal = 0;
                    @endphp

                {{-- TABLE ROW EACH CATEGORY --}}

                @foreach ($incats->skip(1) as $incat )

                    <tr>
                        <td colspan="2"></td>
                        <td><center>{{ $incat->name }}</center></td>
                        <td><center>
                            @foreach ( $incomes as $income ) 
                            
                                @if ( $income->income_category->name === $incat->name )

                                    @php

                                        $subtotal = $subtotal + $income->nominal                                    

                                    @endphp

                                @endif

                            @endforeach
                                                                
                            Rp. {{ $subtotal }},00

                            @php
                                    
                            $total = $total + $subtotal
                                                    
                            @endphp
                            
                            @php

                            $subtotal = 0;

                            @endphp
                            </center>                            
                        </td> 
                    </tr>

                    {{-- SPACER TABLE ROW --}}
                    <tr>
                        <td><div class="space"></div></td>
                    </tr>

                @endforeach

                {{--  
                |--------------------------------------------------------------------------
                | T O T A L
                |--------------------------------------------------------------------------
                --}}
                <tr>
                    <td colspan="99"><hr></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><center><b>Total : </b></center></td>
                    <td>
                        <center>
                            {{-- PADA BULAN --}}
                            Rp. {{ $total }},00
                        </center>   
                    </td>
                    <td><center>Dikurangi Pengeluaran</center></td>
                </tr>  
                <tr>
                    <td colspan="99"><hr></td>
                </tr>


                <tr>
                    {{-- 
                    |--------------------------------------------------------------------------
                    | DEBT MY CHART
                    |--------------------------------------------------------------------------
                    |
                    | Here is where you can register web routes source of utilities for your application. These
                    | routes are loaded by the RouteServiceProvider within a group which
                    | contains the "web" middleware group. Now create something great!
                    |
                     --}}                            
                     <td><center> 3. </center></td>
                     <td><center><b>Debt / Utang</b></center></td>
                     <td><center>{{ $incats[0]->name }}</center></td>
                     <td><center>
                          @foreach ( $incomes as $income ) 
                          
                          @if ( $income->income_category->name === $incats[0]->name )
                            
                            @php
                                                                                                            
                                $subtotal = $subtotal + $income->nominal                                    
                            
                            @endphp

                          @endif

                                    
                            @endforeach                                    
                            Rp. {{ $subtotal }},00 
                            
                            @php

                                $total = $total + $subtotal

                            @endphp
                        </center>                            
                    </td>                            
                    <td><center>{{ "Maret" }}</center>
                    </td>                            
                </tr>
                    @php
                        $subtotal = 0;
                    @endphp

                {{-- TABLE ROW EACH CATEGORY --}}

                @foreach ($incats->skip(1) as $incat )

                    <tr>
                        <td colspan="2"></td>
                        <td><center>{{ $incat->name }}</center></td>
                        <td><center>
                            @foreach ( $incomes as $income ) 
                            
                                @if ( $income->income_category->name === $incat->name )

                                    @php

                                        $subtotal = $subtotal + $income->nominal                                    

                                    @endphp

                                @endif

                            @endforeach
                                                                
                            Rp. {{ $subtotal }},00

                            @php
                                    
                            $total = $total + $subtotal
                                                    
                            @endphp
                            
                            @php

                            $subtotal = 0;

                            @endphp
                            </center>                            
                        </td> 
                    </tr>

                    {{-- SPACER TABLE ROW --}}
                    <tr>
                        <td><div class="space"></div></td>
                    </tr>

                @endforeach

                {{--  
                |--------------------------------------------------------------------------
                | T O T A L
                |--------------------------------------------------------------------------
                --}}
                <tr>
                    <td colspan="99"><hr></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><center><b>Total : </b></center></td>
                    <td>
                        <center>
                            {{-- PADA BULAN --}}
                            Rp. {{ $total }},00
                        </center>   
                    </td>
                    <td><center>Dikurangi Pengeluaran</center></td>
                </tr>  
                <tr>
                    <td colspan="99"><hr></td>
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

@endsection