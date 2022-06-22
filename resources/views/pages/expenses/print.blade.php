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
    <li></li>
    <li>Search : </li>
        <li><form method="get" action="/expense/print/search">
        <input type="date" name="start"></li>
        <li>s/d</li>
        <li><input type="date" name="end"></li>
        <li><div class="btnsearch"><button type="submit">Search</button></div></form></li>
    </div>
</ul>

</div>
<br>

<div class="tableprint">
<table>
    <thead>
        <tr>
            <th><center>No.</center></th>
            <th><center>{{ $title }} Detail</center></th>
            <th><center>Category</center></th>
            <th><center>Nominal</center></th>
            <th><center>Date</center></th>
        </tr>
        <tr>
            <td colspan="99"><div class="line3"></div></td>
        </tr>
        
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
        <tr>
            <td><center>{{ $number++  }}.</center></td>
            <td><center>{{ $expense->expense_description }}</center></td>
            <td><center>{{ $expense->excat_name }}</center></td>
            <td><center>Rp. {{ number_format($expense->expense_nominal, 0, " ,","."); }},00</center></td>
            <td><center>{{ $expense->expense_entry_date }}</center></td>
        </tr>

        @php

        $total = $total + $expense->expense_nominal;

        @endphp

        @endforeach
        <tr>
            <td colspan="99"><div class="line4"></div></td>
        </tr>
        <tr>
            <td><td colspan="1"></td>
            <td><center><b>Total : </b></center></td>
            <td><center>Rp. {{ number_format($total, 0, " ,","."); }},00</center></td>
        </tr>

    </tbody>

</table>
</div>
<br>
<br>

<div class="ttd">

</div>

@endsection



