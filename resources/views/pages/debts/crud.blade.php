{{-- 
|--------------------------------------------------------------------------
| ADD NEW CATEGORY
|--------------------------------------------------------------------------
 --}}

 <div class="tabaddnew">
    <div id="addcategorybox" class="addcategorybox">
       <form method="post" action="/debt/addcategory">
           <h1><center>Add {{ $title }} Category </center></h1>
           <h2><center>Tambah/catat category debt / pendapatan 
           supaya memantau keuangan menjadi lebih mudah</center></h2>
            
           {{-- CRSF --}}
           @csrf
           <label for="">Category Name : <input type="text" name="debcat_name" autocomplete="off" required></label><br>
           <input type="hidden" name="debcat_date" value="{{ date("Y-m-d"); }}">
           <input type="hidden" name="debcat_slug" 
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
        @foreach ( $debcats as $debcat)
        <form method="post" action="/debt/editcategory/{{ $debcat->debcat_slug }}">
            <h1><center>Edit {{ $title }} Category </center></h1>
            <h2><center>Tambah/catat category debt / pendapatan 
            supaya memantau keuangan menjadi lebih mudah</center></h2>
            
            @csrf
            
            <label for="">Category Name : <input type="text" name="debcat_name" autocomplete="off" value="{{ $debcat->debcat_name }}" required></label><br>
            <label for="">Category Date : <input type="date" name="debcat_date" value="{{ date("Y-m-d"); }}"></label><br>
 
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
        <form method="post" action="/debt/viewcategory">
            <h1><center>View {{ $title }} Category </center></h1>
            <h2><center>View / lihat category debt / pendapatan 
            untuk lebih detail pada informasi data</center></h2>
            
            {{-- CSRF --}}
            @csrf

            @foreach ( $debcats as $debcat)
                <label for="">Category Name : <input type="text" name="debcat_name" autocomplete="off" value="{{ $debcat->debcat_name }}" disabled></label><br>
                <label for="">Category Date : <input type="text" name="debcat_date" value="{{ $debcat->debcat_entry_date }}" disabled></label><br>
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
        <form method="get" action="/debt/deletecategory/{{ $debcats[0]->debbcat_slug }}">
            {{-- <input type="hidden" value="" name="destroy"> --}}
            <h1><center>Delete {{ $title }} Category </center></h1>
            <h2><center>Apabila {{ auth()->user()->name }} menghapus category <b>{{ $debcats[0]->debcat_name }}</b>
                maka seluruh data pada category <b>{{ $debcats[0]->debcat_name }}</b>  akan <b>menghilang!</b></center></h2>
     
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
                        <td><center> <label for="">{{ $title }} Category</label> </center></td>
                        <td><center> : </center></td>
                        <td>
                            <center>
                                {{-- DATA LIST INPUT CATEGORY --}}
                                <select name="input_cats">
                                    @foreach ($dataopt as $opt)
                                        <option value="{{ $opt->id }}">{{ $opt->debcat_name }}</option> 
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
                                <input type="hidden" name="debt_slug" value="@php $tabuid = uniqid('gfg', true); echo $tabuid; @endphp">
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
        <form method="post" action="/debt/viewlist">
    
        {{-- CSRF --}}
        @csrf
        
            {{-- TABLE --}}
            <table>
                <tr>
                    <td><center> <label for="">View {{ $title }} Description</label> </center></td>
                    <td><center> : </center></td>
                    {{-- INPUT_DECS --}}
                    <td><center> <input type="text" name="input_decs" autocomplete="off" value="{{ $inview->debt_description }}" disabled required> </center></td>
                </tr>
                <tr>
                    <td><center> <label for="">{{ $title }} Category</label> </center></td>
                    <td><center> : </center></td>
                    <td>
                        <center>
                                <input type="text" value="{{ $inview->debcat_name }}" disabled>
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
                                <input type="date" value="{{ $inview->debt_entry_date }}" disabled>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td><center> <label for="">{{ $title }} Nominal</label> </center></td>
                    <td><center> : </center></td>
                    <td>
                        <center> 
                            {{-- INPUT_NOMINAL --}}
                            <input type="text" name="input_nominal" value="Rp. {{ number_format($inview->debt_nominal, 0, " ,","."); }},00" autocomplete="off" disabled required>                
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
                                        <option value="{{ $opt->id }}">{{ $opt->debcat_name }}</option> 
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
                                <input type="text" name="input_nominal" autocomplete="off" value="{{ $list->debt_nominal }}" required>                

                                {{-- INPUT TOKEN --}}
                                <input type="hidden" name="debt_slug" value="@php $tabuid = uniqid('gfg', true); echo $tabuid; @endphp">
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

{{-- 
|--------------------------------------------------------------------------
| PAID CONVERT INTO INCOME LIST
|--------------------------------------------------------------------------
 --}}

{{-- CONTAINER POP UP --}}
<div id="paidtablebox" class="paidtablebox">
    <h1>Convert Debt into Income</h1>
    <h2>Tambah/catat setiap pemasukan pada hari ini
        agar pemasukan menjadi lebih banyak</h2>
<div class="tableincomebox">

@foreach ( $lists as $list )
<form method="post" action="/debt/paiddebt/{{ $list->debt_slug }}">

{{-- CSRF --}}
@csrf

{{-- TABLE --}}
<table>
<tr>
    <td><center> <label for="">{{ $title }} Description</label> </center></td>
    <td><center> : </center></td>
    {{-- INPUT_DECS --}}
    <td><center> <input type="text" name="input_decs" autocomplete="off" value="{{ $list->debt_description }}" required> </center></td>
</tr>
<tr>
    <td><center> <label for="">{{ $title }} Category</label> </center></td>
    <td><center> : </center></td>
    <td>
        <center>
            {{-- DATA LIST INPUT CATEGORY --}}
            <select name="input_cats">
                @foreach ($dataopt as $opt)
                    <option value="{{ $opt->id }}">{{ $opt->debcat_name }}</option> 
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
                <input type="date" name="input_date" value="{{ $list->debt_entry_date }}" required>
        </center>
    </td>
</tr>
<tr>
    <td><center> <label for="">{{ $title }} Nominal</label> </center></td>
    <td><center> : </center></td>
    <td>
        <center> 
            {{-- INPUT_NOMINAL --}}
            <input type="text" name="input_nominal" autocomplete="off" value="{{ $list->debt_nominal }}" required>
            {{-- INPUT TOKEN --}}
            <input type="hidden" name="debt_slug" value="@php $tabuid = uniqid('gfg', true); echo $tabuid; @endphp">
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

@endforeach
            
</form>
</div>
</div>

</div>

{{-- 
|--------------------------------------------------------------------------
| DELETE LIST LANDING
|--------------------------------------------------------------------------
 --}}
            
 <div class="tabaddnew">
    <div id="deletetablebox" class="deletetablebox">
        @foreach ( $lists as $list)
        <form method="get" action="/debt/deletelist/{{ $list->debt_slug }}">
            <h1><center>Delete {{ $title }} List</center></h1>
            <h2><center>Apabila {{ auth()->user()->name  }} akan menghapus <b>{{ $list->debt_description }}</b>
                maka data tersebut akang menghilang selamanya</center></h2>
            
            @csrf
 
            <button class="bg-danger" type="submit"><b>Delete {{ $title }} Category</b> </button>
            <br>
        </form>
        @endforeach
    </div> 
</div>