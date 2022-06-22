{{-- MAIN DIV CATEGORY --}}
<div class="tabheader">
    
    {{-- HEADING --}}
    <h1>My {{ $title }} Category</h1>

    {{-- SUMMARY --}}
    <h4>Pada page ini berisi seluruh category pencatatan <br> keuangan pada PT. Tolichris</h4>

</div>

{{-- BUTTON ADD NEW --}}
<div class="tabaddnew">

    {{-- BUTTON POP UP FOR CATEGORY--}}
    <button onclick="onCategory()">Add new category +</button>

    {{-- CLOSE OVERLAY --}}
    <div id="overlaycategory" onclick="offCategory()"></div>
    <div id="overlayviewcategory" onclick="offViewCategory()"></div>
    <div id="overlayeditcategory" onclick="offEditCategory()"></div>    
    <div id="overlaypaidtable" onclick="offPaidTable()"></div>

</div>

{{-- CLEAR --}}
<div class="clear"></div>


<div class="tabcategory">
    {{-- SEARCH FEATURE --}}
    <div class="tabsearch">
        <form action="/debt/searchcat">
            <p>Search: <input type="text" name="searchcat" placeholder="search . ." value="{{ $historycat }}"></p>
            <button type="submit">Find</button>
        </form>
    </div>

    {{-- SHOWING ENTRIES --}}

    <p>Show {{ $catcount }} entries </p> 
    {{-- TABLE --}}

        <div class="tabtable">    
            <table width="100%">
                <tr>
                    {{-- TABLE HEADER --}}
                    <th><center>No</center></th> 
                    <th><center>Category Name / Nama Kategori</center></th>
                    <th><center>Date</center></th>
                    <th><center>Total</center></th>
                    <th><center>Action</center></th>
                </tr>
                <tr>
                    {{-- LINE CUTTER --}}
                    <td colspan="99"><div class="line"></div></td>
                </tr>
        
                    {{-- FOR EACH --}}
                    @foreach ($categories as $category) 
                        <tr>
                            {{-- TABLE MAIN SECTION --}}
                            <td><center> {{ $number++ }}. </center></td>
                            <td><center>{{ $category->debcat_name }}</center></td>
                            {{-- <td><center>{{ "Kas Kecil" }}</center></td> --}}
                            <td><center>{{ $category->debcat_entry_date }}</center></td>
                            <td>
                                <center>
                                    {{-- PERHITUNGAN PER CATEGORY  --}}
                                        
                                    @foreach ( $debts as $debt )
                                        @if ($category->debcat_name === $debt->debcat_name)
                                            
                                            @php
                                                $subtotal = $subtotal + $debt->debt_nominal;
                                            @endphp
                                        @endif
                                    @endforeach
                                    
                                    Rp. {{ number_format($subtotal, 0, " ,","."); }},00
                                    @php
                                    $total = $total + $subtotal;
                                    $subtotal = 0;
                                    @endphp
                                </center>
                            </td>
                            <td>
                                <center>
                                    <a href="/debt/viewcategory/{{ $category->debcat_slug }}"><button><img src="/img/eye_white.png" alt=""></button></a>
                                    <a href="/debt/editlanding/{{ $category->debcat_slug }}"><button><img src="/img/pencil_white.png" alt=""></button></a> 
                                    <a href="/debt/deletecatlanding/{{ $category->debcat_slug }}"><button><img src="/img/trash_white.png" alt=""></button></a>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            {{-- SPACER --}}
                            <td><div class="space"></div></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="99"><hr></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td><center><b>Total : </b></center></td>
                            <td>
                                {{-- CALCULATE --}}
                                <center>
                                    Rp. {{ number_format($total, 0, ",", "."); }},00
                                </center>
                                
                            </td>
                            <td>
                                <center>
                                    <a href="/debt/print/"><button><img src="/img/printer_white.png" alt=""></button></a>
                                </center>
                            </td>
                        </tr>
            </table>

        </div> 
    <br>
    {{-- ENTRIES --}}
    <p>Showing {{ $entry + 1 }} to {{ $number - 1 }} of {{ $catcount }} entries</p>
    
    {{-- RESET PHP --}}
    @php
                    
    $number = 1;
    $entry = 0;
    $entries = 0;

    @endphp
    
</div>