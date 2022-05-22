@extends('layouts.main')

@section('gate')

{{-- ISI --}}

<br><br>
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
                            
                            
                            Rp. {{ number_format($subtotal, 0, " ,","."); }},00 
                            
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

                {{-- SPACER TABLE ROW --}}
                <tr>
                    <td><div class="space"></div></td>
                </tr>

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
                                                                
                            Rp. {{ number_format($subtotal, 0, " ,","."); }},00

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
                            Rp. {{ number_format($total, 0, " ,","."); }},00

                            @php 
                                $intotal = $total;

                                $total = 0;
                            @endphp
                        </center>   
                    </td>
                    <td><center>Pendapatan perbulan</center></td>
                </tr>  
                <tr>
                    <td colspan="99"><hr></td>
                </tr>

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
                     <td><center> 2. </center></td>
                     <td><center><b>Expense / Pengeluaran</b></center></td>
                     <td><center>{{ $excats[0]->name }}</center></td>
                     <td><center>
                          @foreach ( $expenses as $expense ) 
                          
                          @if ( $expense->excat->name === $excats[0]->name )
                            
                            @php
                                                                                                            
                                $subtotal = $subtotal + $expense->nominal                                    
                            
                            @endphp

                          @endif

                                    
                            @endforeach                                    
                            Rp. {{ number_format($subtotal, 0, " ,","."); }},00 
                            
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

                {{-- SPACER TABLE ROW --}}
                <tr>
                    <td><div class="space"></div></td>
                </tr>

                {{-- TABLE ROW EACH CATEGORY --}}

                @foreach ($excats->skip(1) as $excat )

                    <tr>
                        <td colspan="2"></td>
                        <td><center>{{ $excat->name }}</center></td>
                        <td><center>
                            @foreach ( $expenses as $expense ) 
                            
                                @if ( $expense->excat->name === $excat->name )

                                    @php

                                        $subtotal = $subtotal + $expense->nominal                                    

                                    @endphp

                                @endif

                            @endforeach
                                                                
                            Rp. {{ number_format($subtotal, 0, " ,","."); }},00

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
                            Rp. {{ number_format($total, 0, " ,","."); }},00

                            @php 
                                $extotal = $total;

                                $total = 0;
                            @endphp
                        </center>   
                    </td>
                    <td><center>Pendapatan Perbulan Dikurangi Pengeluaran</center></td>
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
                     <td><center>{{ $debcats[0]->name }}</center></td>
                     <td><center>
                          @foreach ( $debts as $debt ) 
                          
                          @if ( $debt->debt_cat->name === $debcats[0]->name )
                            
                            @php
                                                                                                            
                                $subtotal = $subtotal + $debt->nominal                                    
                            
                            @endphp

                          @endif

                                    
                            @endforeach                                    
                            Rp. {{ number_format($subtotal, 0, " ,","."); }},00 
                            
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

                {{-- SPACER TABLE ROW --}}
                <tr>
                    <td><div class="space"></div></td>
                </tr>

                {{-- TABLE ROW EACH CATEGORY --}}

                @foreach ($debcats->skip(1) as $debcat )

                    <tr>
                        <td colspan="2"></td>
                        <td><center>{{ $debcat->name }}</center></td>
                        <td><center>
                            @foreach ( $debts as $debt ) 
                            
                                @if ( $debt->debt_cat->name === $debcat->name )

                                    @php

                                        $subtotal = $subtotal + $debt->nominal                                    

                                    @endphp

                                @endif

                            @endforeach
                                                                
                            Rp. {{ number_format($subtotal, 0, " ,","."); }},00

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
                            Rp. {{ number_format($total, 0, " ,","."); }},00

                            @php 
                                $debtotal = $total;

                                $total = 0;
                            @endphp
                        </center>   
                    </td>
                    <td><center>Pendapatan Perbulan Dikurangi Hutang</center></td>
                </tr>  
                <tr>
                    <td colspan="99"><hr></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><b><center>Nilai Akhir : </center></b></td>
                    <td>
                        <center>

                            @php
    
                                $cashflow = $intotal + $extotal - $debtotal;                         
                            
                            @endphp
    
                            Rp.{{ number_format($cashflow, 0, " ,","."); }},00

                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="/mychart/print"><button><img src="/img/printer_white.png" alt=""></button></a>
                        </center>
                    </td>
                </tr>
            </table>
        </div> 
    <br>

    {{-- ENTRIES --}}
    <p>Nilai akhir dari cashflow bulanan pada PT Tolichris</p>

    
</div>

@endsection