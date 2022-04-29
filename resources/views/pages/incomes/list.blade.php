<div class="tabheader">
    {{-- HEADING --}}
    <h1>My {{ $title }} Overview</h1>

    {{-- SUMMARY --}}
    <h4>Pada page ini berisi seluruh transaksi catatan pendapatan yang telah masuk pada PT Tolichris</h4>
</div>

<div class="tabaddnew">

    {{-- OVERLAY FOR POP UP --}}
    <div id="overlaytable" onclick="offTable()"></div>

    {{-- CONTAINER POP UP --}}
    <div id="addtablebox" class="addtablebox">
                        <h1>Add New Income</h1>
                        <h2>Tambah/catat setiap pemasukan pada hari ini
                            agar pemasukan menjadi lebih banyak</h2>
        <div class="tableincomebox">
            <form method="post" action="/income/addnew">
                
                {{-- CSRF --}}
                @csrf

                {{-- TABLE --}}
                <table>
                    <tr>
                        <td><center> <label for="">Income Description</label> </center></td>
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
                                
            </form>
        </div>
    </div>
    <br>
    <br>
    <button onclick="onTable()" type="submit" >Add new Income + </button>
</div>


<div class="clear"></div>

<div class="tabcategory">
    
    {{-- SEARCH FEATURE --}}
    <div class="tabsearch">
        <p>Search: <input type="text" placeholder="search . ."></p>
    </div>
            
    {{-- SHOWING ENTRIES --}}
    @foreach ( $categories as $category )
    @php
        if ( $category->id = 1 )
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
                <th><center>Income Detail / Detail Pemasukan</center></th>
                <th><center>Category / Kategori</center></th>
                <th><center>Nominal</center></th>
                <th><center>Date</center></th>
                <th><center>Action</center></th>
            </tr>
            <tr>
                {{-- LINE CUTTER --}}
                <td colspan="99"><div class="line"></div></td>
            </tr>
        
            {{-- FOR EACH --}}
            @foreach ($incomes as $income) 
            <tr>
                {{-- TABLE MAIN SECTION --}}
                <td><center> {{ $number++ }}. </center></td>
                <td><center>{{ $income->income_description }}</center></td>
                <td><center>{{ $income->income_category->name }}</center></td>
                <td><center>Rp. {{ number_format($income->nominal, 0, " ,","."); }},00</center></td>
                <td><center>{{ $income->income_entry_date }}</center></td>
                <td>
                    <center>
                        <button><img src="/img/eye_white.png" alt=""></button> 
                        <button><img src="/img/pencil_white.png" alt=""></button> 
                        <a href="/income/deleteincome/{{ $income->income_slug }}"><button><img src="/img/trash_white.png" alt=""></button></a>
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
</div>