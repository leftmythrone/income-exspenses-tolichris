{{--  
|--------------------------------------------------------------------------
| My Income Category
|--------------------------------------------------------------------------
|
| Pada page ini berisi seluruh category pencatatan
| keuangan pada PT. Tolichris
|
--}}


<div class="tabheader">
    
    {{-- HEADING --}}
    <h1>My {{ $title }} Category</h1>

    {{-- SUMMARY --}}
    <h4>Pada page ini berisi seluruh category pencatatan <br> keuangan pada PT. Tolichris</h4>
</div>

{{-- Button add new --}}
    <div class="tabaddnew">
        <div id="overlaycategory" onclick="offCategory()"></div>
        {{-- Button pop up--}}
        <button onclick="onCategory()">Add new category +</button>
        <div id="addcategorybox" class="addcategorybox">
            <form method="post" action="/income/addcategory">
                <h1><center>Add {{ $title }} Category </center></h1>
                <h2><center>Tambah/catat category income / pendapatan 
                supaya memantau keuangan menjadi lebih mudah</center></h2>
                {{ csrf_field() }}
                <label for="">Category Name : <input type="text" name="incat_name" autocomplete="off" required></label><br>
                <input type="hidden" name="incat_date" value="{{ date("l, d-M-Y"); }}">
                <input type="hidden" name="token" 
                    value=
                    "                        
                        @php
    
                        $catuid = uniqid('gfg', true);
                        echo $catuid;
                        
                        @endphp
                   ">
                    
                <button type="submit">Add new Income + </button>
                <br>
            </form>
        </div>

        <div id="overlayeditcategory" onclick="offEditCategory()"></div>
    </div>

    {{-- Clear --}}
    <div class="clear"></div>


        <div class="tabcategory">
            {{-- Search Feature --}}
            <div class="tabsearch">
                <p>Search: <input type="text" placeholder="search . ."></p>
            </div>

            {{-- Showing entries --}}
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
                                            <button><img src="/img/eye_white.png" alt=""></button> 
                                            <a href="/income/editlanding/{{ $category->id }}"><button><img src="/img/pencil_white.png" alt=""></button></a> 
                                            <a href="/income/deletecategory/{{ $category->incat_entry_token }}"><button><img src="/img/trash_white.png" alt=""></button></a>
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
                                    <td colspan="3"></td>
                                    <td><center><b>Total : </b></center></td>
                                    <td>
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
                                </tr>
                    </table>
                    
                    <div class="tabaddnew">
                        <div id="editcategorybox" class="editcategorybox">
                            <form method="post" action="/income/editcategory">
                                <h1><center>Edit {{ $title }} Category </center></h1>
                                <h2><center>Tambah/catat category income / pendapatan 
                                supaya memantau keuangan menjadi lebih mudah</center></h2>
                                {{ csrf_field() }}
                                {{-- @foreach ( $dbincat as $incat) --}}
                                <label for="">Category Name : <input type="text" name="incat_name" autocomplete="off" value="" required></label><br>
                                <input type="hidden" name="incat_date" value="{{ date("l, d-M-Y"); }}">
                                <input type="hidden" name="token" 
                                    value=
                                    "                        
                                        @php
                    
                                        $catuid = uniqid('gfg', true);
                                        echo $catuid;
                                        
                                        @endphp
                                   ">
                                {{-- @endforeach   --}}
                                <button type="submit">Add new Income + </button>
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