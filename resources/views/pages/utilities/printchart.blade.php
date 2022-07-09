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
    <div class="remove">
    <li></li>
    <li><label for="" class="btnremove">Click here for print : <input type="button" id="bt" onclick="print()" value="Print PDF" class="btnremove"/> </label>  <div class="btnback"></li>
    <li><div class="btnback"><a href="/{{ $bck }}"> <input type="button" value="Back / Kembali"/> </a></div></li>
    </div>
</ul>

</div>

<div class="tabtable">    
    <table width="100%">
        <tr>
            {{-- TABLE HEADER --}}
            <th><center>No</center></th> 
            <th><center>Cash Flow / Arus Kas</center></th>
            <th><center>Income Category / Kategori Pemasukan</center></th>
            <th><center>Total</center></th>

        </tr>

        <tr>
            {{-- LINE CUTTER --}}
            <td colspan="99"><div class="line3"></div></td>
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
             @php error_reporting(0); @endphp
      
             <td><center> 1. </center></td>
             
             {{-- Title --}}
             <td><center><b>Income / Pemasukan</b></center></td>
             
             {{-- All Category --}}
             <td><center>{{ $incats[0]->incat_name }}</center></td>
             
             <td><center>
                {{-- Calculation for income --}}
                    @foreach ( $incomes as $income ) 
                        @if ( $income->incat_name === $incats[0]->incat_name ) @php $subtotal = $subtotal + $income->income_nominal @endphp @endif
                    @endforeach
                    Rp. {{ number_format($subtotal, 0, " ,","."); }},00 
                    @php
                        $total = $total + $subtotal
                    @endphp
                </center>                            
            </td>                            
        </tr>

        @php $subtotal = 0; @endphp
        
        {{-- DON'T CARE ERROR --}}
        @php error_reporting(E_ALL); @endphp

        {{-- SPACER TABLE ROW --}}
        <tr> <td><div class="space"></div></td> </tr>

        {{-- TABLE ROW EACH CATEGORY --}}
        @foreach ($incats->skip(1) as $incat )
            <tr>
                <td colspan="2"></td>
                <td><center>{{ $incat->incat_name }}</center></td>
                <td><center>
                        @foreach ( $incomes as $income )      
                            @if ( $income->incat_name === $incat->incat_name )
                                @php $subtotal = $subtotal + $income->income_nominal @endphp
                            @endif
                        @endforeach                          
                        Rp. {{ number_format($subtotal, 0, " ,","."); }},00
                        @php $total = $total + $subtotal; $subtotal = 0;  @endphp
                    </center>                            
                </td> 
            </tr>
            {{-- SPACER TABLE ROW --}}
            <tr> <td><div class="space"></div></td> </tr>
        @endforeach

        {{-- LINE --}}
        <tr><td colspan="4"><div class="line3"></div></td></tr>

        
        {{-- CALCULATION GROUP --}}
        <tr>
            <td colspan="2"></td>
            <td><center><b>Total Income :</b></center></td>
            <td>
                <center>
                    Rp. {{ number_format($total, 0, " ,","."); }},00
                    @php $total = 0; @endphp
                </center>
            </td>
        </tr>

        {{-- LINE --}}
        <tr><td colspan="4"><div class="line3"></div></td></tr>

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
             @php error_reporting(0); @endphp
      
             <td><center> 2. </center></td>
             
             {{-- Title --}}
             <td><center><b>Expense / Pengeluaran</b></center></td>
             
             {{-- All Category --}}
             <td><center>{{ $excats[0]->excat_name }}</center></td>
             
             <td><center>
                {{-- Calculation for expense --}}
                    @foreach ( $expenses as $expense ) 
                        @if ( $expense->excat_name === $excats[0]->excat_name ) @php $subtotal = $subtotal + $expense->expense_nominal @endphp @endif
                    @endforeach
                    Rp. {{ number_format($subtotal, 0, " ,","."); }},00 
                    @php
                        $total = $total + $subtotal
                    @endphp
                </center>                            
            </td>                                                        
        </tr>

        @php $subtotal = 0; @endphp
        
        {{-- DON'T CARE ERROR --}}
        @php error_reporting(E_ALL); @endphp

        {{-- SPACER TABLE ROW --}}
        <tr> <td><div class="space"></div></td> </tr>

        {{-- TABLE ROW EACH CATEGORY --}}
        @foreach ($excats->skip(1) as $excat )
            <tr>
                <td colspan="2"></td>
                <td><center>{{ $excat->excat_name }}</center></td>
                <td><center>
                        @foreach ( $expenses as $expense )      
                            @if ( $expense->excat_name === $excat->excat_name )
                                @php $subtotal = $subtotal + $expense->expense_nominal @endphp
                            @endif
                        @endforeach                          
                        Rp. {{ number_format($subtotal, 0, " ,","."); }},00
                        @php $total = $total + $subtotal; $subtotal = 0;  @endphp
                    </center>                            
                </td> 
            </tr>
            {{-- SPACER TABLE ROW --}}
            <tr> <td><div class="space"></div></td> </tr>
        @endforeach

        {{-- LINE --}}
        <tr><td colspan="4"><div class="line3"></div></td></tr>
        
        {{-- CALCULATION GROUP --}}
        <tr>
            <td colspan="2"></td>
            <td><center><b>Total Expense :</b></center></td>
            <td>
                <center>
                    Rp. {{ number_format($total, 0, " ,","."); }},00
                    @php $total = 0; @endphp

                </center>
            </td>
        </tr>

        {{-- LINE --}}
        <tr><td colspan="4"><div class="line3"></div></td></tr>

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
             @php error_reporting(0); @endphp
      
             <td><center> 3. </center></td>
             
             {{-- Title --}}
             <td><center><b>Debt / Hutang</b></center></td>
             
             {{-- All Category --}}
             <td><center>{{ $debcats[0]->debcat_name }}</center></td>
             
             <td><center>
                {{-- Calculation for debt --}}
                    @foreach ( $debts as $debt ) 
                        @if ( $debt->debcat_name === $debcats[0]->debcat_name ) @php $subtotal = $subtotal + $debt->debt_nominal @endphp @endif
                    @endforeach
                    Rp. {{ number_format($subtotal, 0, " ,","."); }},00 
                    @php
                        $total = $total + $subtotal
                    @endphp
                </center>                            
            </td>                                                    
        </tr>

        @php $subtotal = 0; @endphp
        
        {{-- DON'T CARE ERROR --}}
        @php error_reporting(E_ALL); @endphp

        {{-- SPACER TABLE ROW --}}
        <tr> <td><div class="space"></div></td> </tr>

        {{-- TABLE ROW EACH CATEGORY --}}
        @foreach ($debcats->skip(1) as $debcat )
            <tr>
                <td colspan="2"></td>
                <td><center>{{ $debcat->debcat_name }}</center></td>
                <td><center>
                        @foreach ( $debts as $debt )      
                            @if ( $debt->debcat_name === $debcat->debcat_name )
                                @php $subtotal = $subtotal + $debt->debt_nominal @endphp
                            @endif
                        @endforeach                          
                        Rp. {{ number_format($subtotal, 0, " ,","."); }},00
                        @php $total = $total + $subtotal; $subtotal = 0;  @endphp
                    </center>                            
                </td> 
            </tr>
            {{-- SPACER TABLE ROW --}}
            <tr> <td><div class="space"></div></td> </tr>
        @endforeach

        {{-- LINE --}}
        <tr><td colspan="4"><div class="line3"></div></td></tr>
        
        {{-- CALCULATION GROUP --}}
        <tr>
            <td colspan="2"></td>
            <td><center><b>Total Debt :</b></center></td>
            <td>
                <center>
                    Rp. {{ number_format($total, 0, " ,","."); }},00
                    @php $total = 0; @endphp
                </center>
            </td>
        </tr>

        {{-- LINE --}}
        <tr><td colspan="4"><div class="line3"></div></td></tr>
    </table>
</div> 
</table>
</div>
<br>
<br>

<div class="ttd">

</div>

@endsection



