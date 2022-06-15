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

</div>

{{-- CLEAR --}}
<div class="clear"></div>


<div class="tabcategory">
    {{-- SEARCH FEATURE --}}
    <div class="tabsearch">
        <form action="/income/searchcat">
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
                            <td><center>{{ $category->name }}</center></td>
                            {{-- <td><center>{{ "Kas Kecil" }}</center></td> --}}
                            <td><center>{{ $category->incat_entry_date }}</center></td>
                            <td>
                                <center>
                                    {{-- PERHITUNGAN PER CATEGORY  --}}
                                        
                                    @foreach ( $incomes as $income )
                                        @if ($category->name === $income->name)
                                            
                                            @php
                                                $subtotal = $subtotal + $income->nominal;
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
                                    <a href="/income/viewcategory/{{ $category->incat_slug }}"><button><img src="/img/eye_white.png" alt=""></button></a>
                                    <a href="/income/editlanding/{{ $category->incat_slug }}"><button><img src="/img/pencil_white.png" alt=""></button></a> 
                                    <a href="/income/deletecatlanding/{{ $category->incat_slug }}"><button><img src="/img/trash_white.png" alt=""></button></a>
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
                                    <a href="/income/print/"><button><img src="/img/printer_white.png" alt=""></button></a>
                                </center>
                            </td>
                        </tr>
            </table>

        </div> 
    <br>
    {{-- ENTRIES --}}
    <p>Showing {{ $entry }} to {{ $number - 1 }} of {{ $catcount }} entries</p>
    @php
                    
    $number = 1;
    $entry = 0;
    $entries = 0;
    @endphp
    
</div>