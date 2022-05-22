<div class="tabheader">
    
    {{-- HEADING --}}
    <h1>My {{ $title }} Category</h1>

    {{-- SUMMARY --}}
    <h4>Pada page ini berisi seluruh category pencatatan <br> keuangan pada PT. Tolichris</h4>

</div>

{{-- BUTTON ADD NEW --}}
<div class="tabaddnew">
    <div id="overlaycategory" onclick="offCategory()"></div>
    <div id="overlayviewcategory" onclick="offViewCategory()"></div>

    {{-- BUTTON POP UP FOR CATEGORY--}}
    <button onclick="onCategory()">Add new category +</button>
    <div id="addcategorybox" class="addcategorybox">
        <form method="post" action="/income/addcategory">
            <h1><center>Add {{ $title }} Category </center></h1>
            <h2><center>Tambah/catat category income / pendapatan 
            supaya memantau keuangan menjadi lebih mudah</center></h2>
            
            {{-- CRSF --}}
            @csrf
            <label for="">Category Name : <input type="text" name="incat_name" autocomplete="off" required></label><br>
            <input type="hidden" name="incat_date" value="{{ date("Y-m-d"); }}">
            <input type="hidden" name="incat_slug" 
                value=
                "   
                    {{-- RANDOM CREATE SLUG --}}
                    @php

                    $catuid = uniqid('gfg', true);
                    echo $catuid;
                    
                    @endphp
               ">
                
            <button type="submit">Add new Income + </button>
            <br>
        </form>
    </div>
    {{-- CLOSE OVERLAY --}}
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
    @foreach ( $categories as $category )
        @php
            if ( $category->id = 1 )
            {
                $entry = 1;
            }
            else {
                
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
                    <th><center>Category Name / Nama Kategori</center></th>
                    {{-- <th><center>Jenis Kas</center></th> --}}
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
                            <td> <center> {{ $number++ }}. </center></td>
                            <td><center>{{ $category->name }}</center></td>
                            {{-- <td><center>{{ "Kas Kecil" }}</center></td> --}}
                            <td><center>{{ $category->incat_entry_date }}</center></td>
                            <td>
                                <center>
                                    {{-- PERHITUNGAN PER CATEGORY  --}}
                                        
                                    @foreach ( $incomes as $calculate )
                                        @if ($category->name === $calculate->income_category->name)
                                            
                                            @php
                                                $subtotal = $subtotal + $calculate->nominal
                                            @endphp
                                        @endif
                                    @endforeach
                                    Rp. {{ number_format($subtotal, 0, " ,","."); }},00
                                    {{-- Rp. {{ $subtotal }},00 --}}
                                    @php
                                    $subtotal = 0;
                                    @endphp
                                </center>
                            </td>
                            <td>
                                <center>
                                    <a href="/income/viewcategory/{{ $category->incat_slug }}"><button><img src="/img/eye_white.png" alt=""></button></a>
                                    <a href="/income/editlanding/{{ $category->incat_slug }}"><button><img src="/img/pencil_white.png" alt=""></button></a> 
                                    <a href="/income/deletecategory/{{ $category->incat_slug }}"><button><img src="/img/trash_white.png" alt=""></button></a>
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
                                @foreach ( $incomes as $income )
                                
                                @php 
                                    $total = $total + $income->nominal
                                @endphp
                                @endforeach
                                <center>
                                    Rp. {{ number_format($total, 0, ",", "."); }},00
                                    {{-- Rp.{{ $total }},00 --}}
                                </center>
                                
                            </td>
                            <td>
                                <center>
                                    <a href="/income/print/"><button><img src="/img/printer_white.png" alt=""></button></a>
                                </center>
                            </td>
                        </tr>
            </table>
            
            {{-- EDIT CATEGORY LIST --}}
            <div class="tabaddnew"> 
                <div id="editcategorybox" class="editcategorybox">
                    @foreach ( $incats as $incat)
                    <form method="get" action="/income/editcategory/{{ $incat->incat_slug }}">
                        <h1><center>Edit {{ $title }} Category </center></h1>
                        <h2><center>Tambah/catat category income / pendapatan 
                        supaya memantau keuangan menjadi lebih mudah</center></h2>
                        
                        @csrf
                        
                        <label for="">Category Name : <input type="text" name="incat_name" autocomplete="off" value="{{ $incat->name }}" required></label><br>
                        <label for="">Date Category : <input type="date" name="incat_date" autocomplete="off" value="{{ $incat->incat_entry_date }}" required></label><br>

                        <button type="submit">Add new {{ $title }} + </button>
                        <br>
                    </form>
                    @endforeach
                </div> 
            </div>


            {{-- VIEW CATEGORY LIST --}}
            <div class="tabaddnew">
                <div id="viewcategorybox" class="viewcategorybox">
                    <form method="post" action="/income/viewcategory">
                        <h1><center>View {{ $title }} Category </center></h1>
                        <h2><center>View / lihat category income / pendapatan 
                        untuk lebih detail pada informasi data</center></h2>
                        
                        {{-- CSRF --}}
                        @csrf

                        @foreach ( $incats as $incat)
                            <label for="">Category Name : <input type="text" name="incat_name" autocomplete="off" value="{{ $incat->name }}" disabled></label><br>
                            <label for="">Category Date : <input type="text" name="incat_date" value="{{ $incat->incat_entry_date }}" disabled></label><br>
                        @endforeach  
                        {{-- <button type="submit">Add new Income + </button> --}}
                        <br>
                    </form>
                </div> 
            </div>
        </div> 
    <br>
    {{-- ENTRIES --}}
    <p>Showing {{ $entry }} to {{ $entry }} of {{ $entries }} entries</p>
    @php
                    
    $number = 1;
    $entry = 0;
    $entries = 0;
    @endphp
    
</div>