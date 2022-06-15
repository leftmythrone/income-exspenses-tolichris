{{-- 
|--------------------------------------------------------------------------
| ADD NEW CATEGORY
|--------------------------------------------------------------------------
 --}}

 <div class="tabaddnew">
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

           <button type="submit">Add new Category + </button>
           <br>
       </form>
    </div>
</div>

{{-- 
|--------------------------------------------------------------------------
| EDIT CATEGORY
|--------------------------------------------------------------------------
 --}}

<div class="tabaddnew">
    <div id="editcategorybox" class="editcategorybox">
        @foreach ( $incats as $incat)
        <form method="get" action="/income/editcategory/{{ $incat->incat_slug }}">
            <h1><center>Edit {{ $title }} Category </center></h1>
            <h2><center>Tambah/catat category income / pendapatan 
            supaya memantau keuangan menjadi lebih mudah</center></h2>
            
            @csrf
            
            <label for="">Category Name : <input type="text" name="incat_name" autocomplete="off" value="{{ $incat->name }}" required></label><br>
            <label for="">Category Date : <input type="date" name="incat_date" value="{{ date("Y-m-d"); }}"></label><br>
 
            <button type="submit">Edit Category + </button>
            <br>
        </form>
        @endforeach
    </div> 
</div>

{{-- 
|--------------------------------------------------------------------------
| VIEW CATEGORY
|--------------------------------------------------------------------------
 --}}
            
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

{{-- 
|--------------------------------------------------------------------------
| DELETE CATEGORY LANDING
|--------------------------------------------------------------------------
 --}}
            
 <div class="tabaddnew">
    <div id="deletecategorybox" class="deletecategorybox">
        @php error_reporting(0); @endphp
        <form method="get" action="/income/deletecategory/{{ $incats[0]->incat_slug }}">
            {{-- <input type="hidden" value="" name="destroy"> --}}
            <h1><center>Delete {{ $title }} Category </center></h1>
            <h2><center>Apabila {{ auth()->user()->username }} <b>menghapus</b>
            maka seluruh data pada category <b>{{ $incats[0]->name }}</b>  akan menghilang!</center></h2>
     
            <button class="bg-danger" type="submit"><b>Delete {{ $title }} Category</b> </button>
            <br>
        </form>
        @php error_reporting(E_ALL); @endphp

    </div> 
</div>






































{{-- 
|--------------------------------------------------------------------------
| ADD NEW LIST
|--------------------------------------------------------------------------
 --}}

 <div class="tabaddnew">
{{-- CONTAINER POP UP --}}
    <div id="addtablebox" class="addtablebox">
                        <h1>Add New {{ $title }}</h1>
                        <h2>Tambah/catat setiap pemasukan pada hari ini
                            agar pemasukan menjadi lebih banyak</h2>
        <div class="tableincomebox">
            <form method="post" action="/income/addnew">
                
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
                        <td><center> <label for="">{{ $title }} Category</label> </center></td>
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
                        <td><center> <label for="">{{ $title }} Account</label> </center></td>
                        <td><center> : </center></td>
                        <td>
                            <center>
                                {{-- DATA LIST INPUT CATEGORY --}}
                                <select name="input_acc">
                                    @foreach ($accopt as $apt)
                                        <option value="{{ $apt->id }}">{{ $apt->account_name }}</option> 
                                    @endforeach
                                </select>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td><center> <label for="">{{ $title }} Nominal</label> </center></td>
                        <td><center> : </center></td>
                        <td>
                            <center> 
                                {{-- INPUT_NOMINAL --}}
                                <input type="text" name="input_nominal" autocomplete="off" required>                
                                {{-- INPUT DATE --}}
                                <input type="hidden" name="input_date" value="{{ date("Y-m-d"); }}">
                                {{-- INPUT TOKEN --}}
                                <input type="hidden" name="income_slug" value="@php $tabuid = uniqid('gfg', true); echo $tabuid; @endphp">
                            </center>
                        </td>
                    </tr>
                    <tr> 
                        <td colspan="2"> </td>
                        <td>
                            <center>
                                <button onclick="offTable()" type="submit" >Edit {{ $title }} list + </button>
                            </center>
                        </td>
                    </tr>
                </table>
                                
            </form>
        </div>
    </div>


{{-- 
|--------------------------------------------------------------------------
| VIEW LIST
|--------------------------------------------------------------------------
 --}}

<div id="viewtablebox" class="viewtablebox">
    <h1>View New {{ $title }}</h1>
    <h2>View / lihat setiap {{ $title }} untuk lebih detail</h2>
        
    <div class="viewtableincomebox">
        
        @foreach ( $inviews as $inview )
        <form method="post" action="/income/viewlist">
    
        {{-- CSRF --}}
        @csrf
        
            {{-- TABLE --}}
            <table>
                <tr>
                    <td><center> <label for="">View {{ $title }} Description</label> </center></td>
                    <td><center> : </center></td>
                    {{-- INPUT_DECS --}}
                    <td><center> <input type="text" name="input_decs" autocomplete="off" value="{{ $inview->income_description }}" disabled required> </center></td>
                </tr>
                <tr>
                    <td><center> <label for="">{{ $title }} Category</label> </center></td>
                    <td><center> : </center></td>
                    <td>
                        <center>
                                <input type="text" value="{{ $inview->name  }}" disabled>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td><center> <label for="">{{ $title }} Account</label> </center></td>
                    <td><center> : </center></td>
                    <td>
                        <center>
                                <input type="text" value="{{ $inview->account_name  }}" disabled>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td><center> <label for="">{{ $title }} Date</label> </center></td>
                    <td><center> : </center></td>
                    <td>
                        <center>
                                <input type="date" value="{{ $inview->income_entry_date }}" disabled>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td><center> <label for="">{{ $title }} Nominal</label> </center></td>
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

{{-- 
|--------------------------------------------------------------------------
| EDIT LIST
|--------------------------------------------------------------------------
 --}}

<div id="edittablebox" class="edittablebox">
    <h1>Edit {{ $title }}</h1>
    <h2>Tambah/catat setiap {{ $title }} pada hari ini
                agar pemasukan menjadi lebih banyak</h2>
        <div class="tableincomebox">
        
            @foreach ($lists as $list)
        
                <form method="post" action="/income/editlist/{{ $list->income_slug }}">
                
                    {{-- CSRF --}}
                    @csrf
                    
                    {{-- TABLE --}}
                    <table>
                    <tr>
                        <td><center> <label for="">Income Description</label> </center></td>
                        <td><center> : </center></td>
                        {{-- INPUT_DECS --}}
                        <td><center> <input type="text" name="input_decs" autocomplete="off" value="{{ $list->income_description }}"  required> </center></td>
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
                        <td><center> <label for="">{{ $title }} Account</label> </center></td>
                        <td><center> : </center></td>
                        <td>
                            <center>
                                {{-- DATA LIST INPUT CATEGORY --}}
                                <select name="input_acc">
                                    @foreach ($accopt as $apt)
                                        <option value="{{ $apt->id }}">{{ $apt->account_name }}</option> 
                                    @endforeach
                                </select>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td><center> <label for="">{{ $title }} Date</label> </center></td>
                        <td><center> : </center></td>
                        <td>
                            <center>                
                                {{-- INPUT DATE --}}
                                <input type="date" name="input_date" value="{{ date("Y-m-d"); }}">
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td><center> <label for="">{{ $title }} Nominal</label> </center></td>
                        <td><center> : </center></td>
                        <td>
                            <center> 
                                {{-- INPUT_NOMINAL --}}
                                <input type="text" name="input_nominal" autocomplete="off" value="{{ $list->nominal }}" required>                

                                {{-- INPUT TOKEN --}}
                                <input type="hidden" name="token" value="@php $tabuid = uniqid('gfg', true); echo $tabuid; @endphp">
                            </center>
                        </td>
                    </tr>
                    <tr> 
                        <td colspan="2"> </td>
                        <td>
                            <center>
                                <button onclick="offTable()" type="submit" >Edit {{ $title }} + </button>
                            </center>
                        </td>
                    </tr>
                    </table>
                </form>
            @endforeach        
        </div>
</div>

</div>

{{-- 
|--------------------------------------------------------------------------
| DELETE CATEGORY LANDING
|--------------------------------------------------------------------------
 --}}
            
 <div class="tabaddnew">
    <div id="deletetablebox" class="deletetablebox">
        @foreach ( $lists as $list)
        <form method="get" action="/income/deletelist/{{ $list->income_slug }}">
            <h1><center>Delete {{ $title }} List</center></h1>
            <h2><center>Apabila {{ auth()->user()->username }} <b>menghapus</b>
            maka </center></h2>
            
            @csrf
 
            <button class="bg-danger" type="submit"><b>Delete {{ $title }} Category</b> </button>
            <br>
        </form>
        @endforeach
    </div> 
</div>