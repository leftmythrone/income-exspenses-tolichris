<br>
{{-- MAIN DIV HEADER --}}
<div class="tabheader">

    {{-- HEADING --}}
    <h1>My {{ $title }} Overview</h1>

    {{-- SUMMARY --}}
    <h4>Pada page ini berisi seluruh transaksi catatan {{ $title }} yang telah masuk pada PT Tolichris</h4>
</div>

{{--  --}}
<div class="tabaddnew">

        {{-- OVERLAY FOR POP UP --}}
        <div id="overlaytable" onclick="offTable()"></div>
        <div id="overlayviewtable" onclick="offViewTable()"></div>
        <div id="overlayedittable" onclick="offEditTable()"></div>
        <div id="overlaydeletetable" onclick="offDeleteTable()"></div>


    <br><br>
    <button onclick="onTable()" type="submit" >Add new {{ $title }} + </button>
</div>

{{-- REMOVE CLEAR --}}
<div class="clear"></div>

<div class="tabcategory">
    
    {{-- SEARCH FEATURE --}}
    <div class="tabsearch">
        <form action="/income/searchlist">
            <p>Search: <input type="text" name="searchlist" placeholder="search . ." value="{{ $historylist }}"></p>
            <button type="submit">Find</button>
        </form>
    </div>
            
    <p>Show {{ $listcount }} entries </p> 

    {{-- TABLE --}}
    <div class="tabtable">    
        <table width="100%">
            <tr>
                {{-- TABLE HEADER --}}
                <th><center>No</center></th> 
                <th><center>{{ $title }} Detail / Detail Pemasukan</center></th>
                <th><center>Category</center></th>
                <th><center>Account</center></th>
                <th><center>Nominal</center></th>
                <th><center>Date</center></th>
                <th><center>Action</center></th>
            </tr>
            <tr>
                {{-- LINE CUTTER --}}
                <td colspan="99"><div class="line"></div></td>
            </tr>
        
            {{-- LOOPING FOR ARRAY --}}
            @for( $listloop = 0 + $entdata ; $listloop < 10 + $entdata ; $listloop++ )
            
            {{-- UNDEFINED ARRAY KEY 47 - TURN OFF --}}
            @php error_reporting(0); @endphp

            {{-- CHECK IF THERE'S NULL DATA --}}
            @if ( $incomes[$listloop]->id === null )
            
            {{-- TABLE LIST CONTENT --}}
            @else
            <tr>
                <td><center> {{ $listloop + 1 }}. </center></td>
                <td><center>{{ $incomes[$listloop]->income_description }}</center></td>
                <td><center>{{ $incomes[$listloop]->incat_name }}</center></td>
                <td><center>{{ $incomes[$listloop]->account_name }}</center></td>
                <td><center>Rp. {{ number_format($incomes[$listloop]->income_nominal, 0, " ,","."); }},00</center></td>
                <td><center>{{ $incomes[$listloop]->income_entry_date }}</center></td>
                <td>
                    <center>
                        <a href="/income/viewlist/{{ $incomes[$listloop]->income_slug }}"><button><img src="/img/eye_white.png" alt=""></button></a>
                        <a href="/income/editstore/{{ $incomes[$listloop]->income_slug }}"><button><img src="/img/pencil_white.png" alt=""></button></a> 
                        <a href="/income/deletelistlanding/{{ $incomes[$listloop]->income_slug }}"><button><img src="/img/trash_white.png" alt=""></button></a>
                    </center>
                </td>
            </tr>            
        
            <tr>
                {{-- SPACER --}}
                <td><div class="space"></div></td>
            </tr>
                
            @endif


            {{-- UNDEFINED ARRAY KEY 47 - TURN ON --}}
            @php error_reporting(E_ALL); @endphp
            
            @endfor
            <tr>
                <td colspan="7"><div class="line"></div></td>
            </tr>
            <tr>
                <td colspan="6"></td>
                <td>
                    <center>
                        <div class="entriesctrl">
                            <ul>
                                <li>
                                    <form action="/income/entries/{{ $entdata }}" method="get">
                                        <button><img src="/img/left.png" alt=""></button>
                                        <input type="hidden" value="prev" name="type">
                                    </form>
                                </li>

                                <li>
                                    <form action="/income/entries/{{ $entdata }}" method="get">
                                        <button><img src="/img/right.png" alt=""></button>
                                        <input type="hidden" value="next" name="type">
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </center>
                </td>
            </tr>
        
        </table>
         
    </div> 
    <br>

    {{-- ENTRIES --}}
    <p>Showing {{ 1 }} to {{ $listloop }} of {{ $listcount }} entries</p>

</div>

<br>
<br>