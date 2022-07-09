@extends('layouts.main')

@section('gate')

{{-- ISI --}}

<br><br>
<div class="tabheader">

    {{-- HEADING --}}
    <h1>My Cash Flow</h1>

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

                </tr>

                <tr>
                    {{-- LINE CUTTER --}}
                    <td colspan="99"><div class="line"></div></td>
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
                <tr><td colspan="4"><hr></td></tr>
                
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
                <tr><td colspan="4"><hr></td></tr>

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
                <tr><td colspan="4"><hr></td></tr>
                
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
                <tr><td colspan="4"><hr></td></tr>

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
                <tr><td colspan="4"><hr></td></tr>
                
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

                {{--  
                |--------------------------------------------------------------------------
                | C A S H - F L O W
                |--------------------------------------------------------------------------
                --}}
                <tr>
                    <td colspan="99"><hr></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><b><center>Print : </center></b></td>
                        {{-- <td>
                            <center>
        
                                Rp.{{ number_format($total, 0, " ,","."); }},00

                            </center>
                        </td> --}}
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
    {{-- <p>Nilai akhir dari cashflow bulanan pada PT Tolichris</p> --}}

    
</div>

@endsection