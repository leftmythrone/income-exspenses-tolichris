@extends('layouts.printmain')

@section('gate')

{{-- Main Section --}}

<div class="papper">
    <img src="/img/No-BG.png" alt="">
    <div class="container w-100">
        <h1>PT TOLICHRIS</h1>
        <h2>INTERNATIONAL FREIGHT FORWARDER</h2>
        <h2>AIR & SEA CARGO CLEARANCE & LAND TRANSPORTATION</h2>
        <table>
            <tr>
                <td><h3><b>HEAD OFFICE</b></h3></td>
                <td><h4> : </h4></td>
                <td><h4>JL. Tuban I / 12 Surabaya 60171</h3></td>
            </tr>
            <tr>
                <td><h3><b>PHONE</b></h3></td>
                <td><h4> : </h4></td>
                <td><h4>(031) 3550455, 3534856</h4></td>
            </tr>
            <tr>
                <td><h3><b>FACSIMILE</b></h3></td>
                <td><h4> : </h4></td>
                <td><h4>(031) 3534836</h4></td>
            </tr>
            <tr>
                <td><h3><b>EMAIL</b></h3></td>
                <td><h4> : </h4></td>
                <td><h4>tolichris@indo.net.id</h4></td>
            </tr>
        </table>
        
    </div>
</div>
    <div class="line"></div>
    <div class="line2"></div>
<div class="clear"></div>

<ul>
    <li></li>
    <li><label for="" class="btnremove">Click here for print : <input type="button" id="bt" onclick="print()" value="Print PDF" class="btnremove"/> </label>  <div class="btnback"></li>
    <li><div class="btnback"><a href="/{{ $bck }}"> <input type="button" value="Back / Kembali"/> </a></div></li>
</ul>

<div class="tabtable">    
    <table width="100%">
        <tr>
            {{-- TABLE HEADER --}}
            <th><center>No</center></th> 
            <th><center>Cash Flow</center></th>
            <th><center>List Category   </center></th>
            <th><center>Total</center></th>
            <th><center>Date </center></th>
        </tr>

        <tr>
            {{-- LINE CUTTER --}}
            <td colspan="99"><div class="line3"></div></td>
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
             <td><center><b>Income</b></center></td>
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
            <td><center>Cash value</center></td>
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
             <td><center><b>Expense</b></center></td>
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
            <td><center>Cash Dirty</center></td>
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
             <td><center><b>Debt</b></center></td>
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
            <td><center>Cash Clean</center></td>
        </tr>  
        <tr>
            <td colspan="99"><br></td>
        </tr>
        <tr>
            <td colspan="99"><div class="line4"></div></td>
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
        </tr>
    </table>
</div> 
</table>
</div>
<br>
<br>

<div class="ttd">

</div>

@endsection



