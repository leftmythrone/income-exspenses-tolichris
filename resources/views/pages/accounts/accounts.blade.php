@extends('layouts.main')

@section('gate')

<!-- ISI -->

<br><br>
<div class="tabheader">
    
    {{-- HEADING --}}
    <h1>PT. Tolichris Virtual Account</h1>

    {{-- SUMMARY --}}
    <h4>Pada page ini berisi seluruh category pencatatan <br> keuangan pada PT. Tolichris</h4>

</div>

{{-- BUTTON ADD NEW --}}
<div class="tabaddnew">
    <div id="overlaycategory" onclick="offCategory()"></div>
    <div id="overlayviewcategory" onclick="offViewCategory()"></div>

    {{-- CLOSE OVERLAY --}}
    <div id="overlayeditcategory" onclick="offEditCategory()"></div>
</div>

{{-- CLEAR --}}
<div class="clear"></div>


<div class="tabcategory">
    {{-- SEARCH FEATURE --}}
    <div class="tabsearch">
        <form action="/income/searchcat">
            <p>Search: <input type="text" name="searchcat" placeholder="search . ." value=""></p>
            <button type="submit">Find</button>
        </form>
    </div>

    <p>Show 1 entries </p> 
    {{-- TABLE --}}

        <div class="tabtable">    
            <table width="100%">
                <tr>
                    {{-- TABLE HEADER --}}
                    <th><center>No</center></th> 
                    <th><center>Account Name / Nama Akun </center></th>
                    <th><center>Account Balance</center></th>
                    <th><center>Action</center></th>
                </tr>
                <tr>
                    {{-- LINE CUTTER --}}
                    <td colspan="99"><div class="line"></div></td>
                </tr>
        
                    {{-- FOR EACH --}}
                    @foreach ($accounts as $account )
                        <tr>
                            {{-- TABLE MAIN SECTION --}}
                            <td> <center>{{ $number++ }}</center></td>
                            <td><center>{{ $account->account_name }}</center></td>
                            <td><center>Rp. {{ number_format($account->account_balance, 0, " ,","."); }},00</center></td>                            <td>
                                <center>
                                    <a href="/income/viewcategory/"><button><img src="/img/eye_white.png" alt=""></button></a>
                                    <a href="/income/editlanding/"><button><img src="/img/pencil_white.png" alt=""></button></a> 
                                    <a href="/income/deletecategory/"><button><img src="/img/trash_white.png" alt=""></button></a>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            {{-- SPACER --}}
                            <td><div class="space"></div></td>
                        </tr>
                        @endforeach
                        <br>
                        <tr>
                            <td colspan="99"><hr></td>
                        </tr>
                        <tr>
                            <td colspan="1 "></td>
                            <td><center><b>Total : </b></center></td>
                            <td>
                                <center>

                                </center>
                                
                            </td>
                            <td>
                                <center>
                                    <a href="/income/print/"><button><img src="/img/printer_white.png" alt=""></button></a>
                                </center>
                            </td>
                        </tr>
            </table>
</div>
        
@endsection



