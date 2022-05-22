<div class="tabheader">
    {{-- HEADING --}}
    <h1>My {{ $title }} Overview</h1>

    {{-- SUMMARY --}}
    <h4>Pada page ini berisi seluruh transaksi catatan pendapatan yang telah masuk pada PT Tolichris</h4>
</div>

<div class="tabaddnew">

    {{-- OVERLAY FOR POP UP --}}
    <div id="overlaytable" onclick="offTable()"></div>
    <div id="overlayviewtable" onclick="offViewTable()"></div>
    <div id="overlayedittable" onclick="offEditTable()"></div>
    <div id="overlaypaidtable" onclick="offPaidTable()"></div>




    {{-- CONTAINER POP UP --}}
    <div id="addtablebox" class="addtablebox">
                        <h1>Add New {{ $title }}</h1>
                        <h2>Tambah/catat setiap pemasukan pada hari ini
                            agar pemasukan menjadi lebih banyak</h2>
        <div class="tableincomebox">
            <form method="post" action="/debt/addnew">
                
                {{-- CSRF --}}
                @csrf

                {{-- TABLE --}}
                <table>
                    <tr>
                        <td><center> <label for="">{{ $title }} Description</label> </center></td>
                        <td><center> : </center></td>
                        {{-- INPUT_DECS --}}
                        <td><center> <input type="text" name="input_decs" autocomplete="off" required> </center></td>
                    </tr>
                    <tr>
                        <td><center> <label for="">Income Category</label> </center></td>
                        <td><center> : </center></td>
                        <td>
                            <center>
                                {{-- DATA LIST INPUT CATEGORY --}}
                                <select name="input_cats">
                                    @foreach ($dataopt as $opt)
                                        <option value="{{ $opt->id }}">{{ $opt->name   }}</option> 
                                    @endforeach
                                </select>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td><center> <label for="">nominal</label> </center></td>
                        <td><center> : </center></td>
                        <td>
                            <center> 
                                {{-- INPUT_NOMINAL --}}
                                <input type="text" name="input_nominal" autocomplete="off" required>                
                                {{-- INPUT DATE --}}
                                <input type="hidden" name="input_date" value="{{ date("l, d-M-Y"); }}">
                                {{-- INPUT TOKEN --}}
                                <input type="hidden" name="debt_slug" value="@php $tabuid = uniqid('gfg', true); echo $tabuid; @endphp">
                            </center>
                        </td>
                    </tr>
                    <tr> 
                        <td colspan="2"> </td>
                        <td>
                            <center>
                                <button onclick="offTable()" type="submit" >Add new Income + </button>
                            </center>
                        </td>
                    </tr>
                </table>
                                
            </form>
        </div>
    </div>
    <br>
    <br>
    <button onclick="onTable()" type="submit" >Add new Debt + </button>
</div>


<div class="clear"></div>

<div class="tabcategory">
    
    {{-- SEARCH FEATURE --}}
    <div class="tabsearch">
        <form action="/debt/paidlanding">
            <p>Search: <input type="text" name="searchlist" placeholder="search . ." value="{{ $historylist }}"></p>
            <button type="submit">Find</button>
            </p>
        </form>
    </div>
            
    {{-- SHOWING ENTRIES --}}
    @foreach ( $debts as $debt )
    @php
        if ( $debt->id = 1 )
        {
            $entry = 1;
        }
        else 
        {

        }

        $entries++;
    @endphp
    @endforeach
    <p>Show {{ $entries }} entries </p> 

    {{-- TABLE --}}
    <div class="tabtable">    
        <table width="100%">
            <tr>
                {{-- TABLE HEADER --}}
                <th><center>No</center></th> 
                <th><center>{{ $title }} Detail / Detail Pemasukan</center></th>
                <th><center>Category / Kategori</center></th>
                <th><center>Nominal</center></th>
                <th><center>Date</center></th>
                <th><center>Action</center></th>
                <th><center>Convert</center></th>
            </tr>
            <tr>
                {{-- LINE CUTTER --}}
                <td colspan="99"><div class="line"></div></td>
            </tr>
        
            {{-- FOR EACH --}}
            @foreach ($debts as $debt) 
            <tr>
                {{-- TABLE MAIN SECTION --}}
                <td><center> {{ $number++ }}. </center></td>
                <td><center>{{ $debt->debt_description }}</center></td>
                <td><center>{{ $debt->debt_cat->name }}</center></td>
                <td><center>Rp. {{ number_format($debt->nominal, 0, " ,","."); }},00</center></td>
                <td><center>{{ $debt->debt_entry_date }}</center></td>
                <td>
                    <center>
                        <a href="/debt/viewlist/{{ $debt->debt_slug }}"><button><img src="/img/eye_white.png" alt=""></button></a>
                        <a href="/debt/editstore/{{ $debt->debt_slug }}"><button><img src="/img/pencil_white.png" alt=""></button></a> 
                        <a href="/debt/deletedebt/{{ $debt->debt_slug }}"><button><img src="/img/trash_white.png" alt=""></button></a>
                    </center>
                </td>
                <td>
                    <center>
                        <a href="/debt/paidlanding/{{ $debt->debt_slug }}"><button><img src="/img/paid_white.png" alt=""></button></a>
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
    <p>Showing {{ $entry }} to {{ $entry }} of {{ $entries }} entries</p>

</div>








{{--
|--------------------------------------------------------------------------
| DEBT TO CREATE NEW CATEGORY / LIST
|--------------------------------------------------------------------------
--}}


<div id="viewtablebox" class="viewtablebox">
    <h1>View New {{ $title }}</h1>
    <h2>View / lihat setiap {{ $title }} untuk lebih detail</h2>
    <div class="viewtableincomebox">
    <form method="post" action="/debt/viewlist/{{ $debt->debt_slug }}">

    {{-- CSRF --}}
    @csrf

    @foreach ( $inviews as $inview )
        {{-- TABLE --}}
        <table>
            <tr>
                <td><center> <label for="">View {{ $title }} Description</label> </center></td>
                <td><center> : </center></td>
                {{-- INPUT_DECS --}}
                <td><center> <input type="text" name="input_decs" autocomplete="off" value="{{ $inview->debt_description }}" disabled required> </center></td>
            </tr>
            <tr>
                <td><center> <label for="">Income Category</label> </center></td>
                <td><center> : </center></td>
                <td>
                    <center>
                            <input type="text" value="{{ $inview->name  }}" disabled>
                    </center>
                </td>
            </tr>
            <tr>
                <td><center> <label for="">Nominal</label> </center></td>
                <td><center> : </center></td>
                <td>
                    <center> 
                        {{-- INPUT_NOMINAL --}}
                        <input type="text" name="input_nominal" value="Rp. {{ number_format($inview->nominal, 0, " ,","."); }},00" autocomplete="off" disabled required>                
                        {{-- INPUT DATE --}}
                        <input type="hidden" name="input_date" value="{{ date("l, d-M-Y"); }}">
                        {{-- INPUT TOKEN --}}
                        <input type="hidden" name="token" value="@php $tabuid = uniqid('gfg', true); echo $tabuid; @endphp">
                    </center>
                </td>
            </tr>
        </table>

    @endforeach

    </form>
    </div>
    </div>
</div>



{{--
|--------------------------------------------------------------------------
| DEBT TO EDIT  LIST
|--------------------------------------------------------------------------
--}}


<div id="edittablebox" class="edittablebox">
    <h1>Edit {{ $title }}</h1>
    <h2>Tambah/catat setiap {{ $title }} pada hari ini
        agar pemasukan menjadi lebih banyak</h2>
<div class="tableincomebox">
@foreach ($lists as $list)

<form method="post" action="/debt/editlist/{{ $list->debt_slug }}">

{{-- CSRF --}}
@csrf

{{-- TABLE --}}
<table>
<tr>
    <td><center> <label for="">Income Description</label> </center></td>
    <td><center> : </center></td>
    {{-- INPUT_DECS --}}
    <td><center> <input type="text" name="input_decs" autocomplete="off" value="{{ $list->debt_description }}"  required> </center></td>
</tr>
<tr>
    <td><center> <label for="">Income Category</label> </center></td>
    <td><center> : </center></td>
    <td>
        <center>
            {{-- DATA LIST INPUT CATEGORY --}}
            <select name="input_cats">
                @foreach ($dataopt as $opt)
                    <option value="{{ $opt->id }}">{{ $opt->name }}</option> 
                @endforeach
            </select>
        </center>
    </td>
</tr>
<tr>
    <td><center> <label for="">nominal</label> </center></td>
    <td><center> : </center></td>
    <td>
        <center> 
            {{-- INPUT_NOMINAL --}}
            <input type="text" name="input_nominal" autocomplete="off" value="{{ $list->nominal }}" required>                
            {{-- INPUT DATE --}}
            <input type="hidden" name="input_date" value="{{ date("l, d-M-Y"); }}">
            {{-- INPUT TOKEN --}}
            <input type="hidden" name="token" value="@php $tabuid = uniqid('gfg', true); echo $tabuid; @endphp">
        </center>
    </td>
</tr>
<tr> 
    <td colspan="2"> </td>
    <td>
        <center>
            <button onclick="offTable()" type="submit" >Add new Income + </button>
        </center>
    </td>
</tr>
</table>
@endforeach        
</form>
</div>
</div>



{{--
|--------------------------------------------------------------------------
| DEBT CONVERT TO INOME
|--------------------------------------------------------------------------
--}}


<div id="paidtablebox" class="paidtablebox">
    <h1>Convert Debt to Income</h1>
    <h2>Tambah/catat setiap {{ $title }} pada hari ini
        agar pemasukan menjadi lebih banyak</h2>
<div class="tableincomebox">
@foreach ($lists as $list)

<form method="post" action="/debt/paiddebt/{{ $list->debt_slug }}">

{{-- CSRF --}}
@csrf

{{-- TABLE --}}
<table>
<tr>
    <td><center> <label for="">Debt Convert Description</label> </center></td>
    <td><center> : </center></td>
    {{-- INPUT_DECS --}}
    <td><center> <input type="text" name="input_decs" autocomplete="off" value="{{ $list->debt_description }}"  required> </center></td>
</tr>
<tr>
    <td><center> <label for="">Income Category</label> </center></td>
    <td><center> : </center></td>
    <td>
        <center>
            {{-- DATA LIST INPUT CATEGORY --}}
            <select name="input_cats">
                @foreach ($dataopt as $opt)
                    <option value="{{ $opt->id }}">{{ $opt->name }}</option> 
                @endforeach
            </select>
        </center>
    </td>
</tr>
<tr>
    <td><center> <label for="">nominal</label> </center></td>
    <td><center> : </center></td>
    <td>
        <center> 
            {{-- INPUT_NOMINAL --}}
            <input type="text" name="input_nominal" autocomplete="off" value="{{ $list->nominal }}" required>                
            {{-- INPUT DATE --}}
            <input type="hidden" name="input_date" value="{{ date("l, d-M-Y"); }}">
            {{-- INPUT TOKEN --}}
            <input type="hidden" name="income_slug" value="@php $tabuid = uniqid('gfg', true); echo $tabuid; @endphp">
        </center>
    </td>
</tr>
<tr> 
    <td colspan="2"> </td>
    <td>
        <center>
            <button onclick="offTable()" type="submit" >Convert to Income + </button>
        </center>
    </td>
</tr>
</table>
@endforeach        
</form>
</div>
</div>