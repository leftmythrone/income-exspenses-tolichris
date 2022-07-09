<div id="overlayaddaccount" onclick="offAccountAdd()"></div>
<div id="overlayediteaccount" onclick="offAccountEdit()"></div>
<div id="overlaydeleteaccount" onclick="offAccountDelete()"></div>
<div id="overlaysum" onclick="offSum()"></div>
<div id="overlaysub" onclick="offSub()"></div>
<div id="overlayclear" onclick="offClear()"></div>


{{-- 
|--------------------------------------------------------------------------
| SUMMATION
|--------------------------------------------------------------------------
 --}}

<div class="tabaddnew">
    <div id="sumbox" class="sumbox">
        @php error_reporting(0); @endphp
            @foreach ( $edits as $edit)
                <form method="post" action="/account/summation/{{ $edit->account_slug }}">
                    <h1><center>Penjumlahan khas awal kas {{ $edit->account_name }}</center></h1>
                    <h2>
                        <center>
                            Nominal awal kas <b>{{ $edit->account_name }}</b> saat ini adalah
                            <b>Rp. {{ number_format( $edit->account_balance, 0, " ,","."); }},00</b> dan akan <b>dijumlahkan</b> oleh berikut
                        </center>
                    </h2>

                    @csrf

                    <label for="">Summation : <input type="number" name="input_nominal" autocomplete="off" value="0" required></label><br>
                    <input type="hidden" name="input_balance" autocomplete="off" value="{{ $edit->account_balance }}">

                    <button type="submit">Edit Category + </button>
                    <br>
                </form>
            @endforeach
        @php error_reporting(E_ALL); @endphp

    </div> 
</div>

{{-- 
|--------------------------------------------------------------------------
| SUBSTRACTION
|--------------------------------------------------------------------------
 --}}

<div class="tabaddnew">
    <div id="subbox" class="subbox">
        @php error_reporting(0); @endphp
        @foreach ( $edits as $edit)
            <form method="post" action="/account/subtraction/{{ $edit->account_slug }}">
                <h1><center>Pengurangan khas awal kas {{ $edit->account_name }}</center></h1>
                <h2>
                    <center>
                        Nominal awal kas <b>{{ $edit->account_name }}</b> saat ini adalah
                        <b>Rp. {{ number_format( $edit->account_balance, 0, " ,","."); }},00</b> dan akan <b>dikurangi</b> oleh berikut
                    </center>
                </h2>
                
                @csrf

                <label for="">Substraction : <input type="number" name="input_nominal" autocomplete="off" value="0" required></label><br>
                <input type="hidden" name="input_balance" autocomplete="off" value="{{ $edit->account_balance }}">
              
                <button type="submit">Edit Category + </button>
                <br>
            </form>
        @endforeach
        @php error_reporting(E_ALL); @endphp

    </div> 
</div>

{{-- 
|--------------------------------------------------------------------------
| ADD
|--------------------------------------------------------------------------
 --}}

 <div class="tabaddnew">
    <div id="addaccount" class="addaccount">
                <form method="post" action="/account/store">
                    <h1><center>Add new {{ $title }}</center></h1>
                    <h2>
                        <center>
                            Tambah/catat category income / pendapatan 
            supaya memantau keuangan menjadi lebih mudah
                        </center>
                    </h2>

                    @csrf

                    <label for="">Account Name : <input type="text" name="input_name" autocomplete="off" value="" required></label><br>
                    <label for="">Account Balance : <input type="number" name="input_balance" autocomplete="off" value="0" required></label><br>
                    <input type="hidden" name="input_slug" autocomplete="off" value="@php $catuid = uniqid('gfg', true); echo $catuid; @endphp" required>

                    <button type="submit">Edit Category + </button>
                    <br>
                </form>
    </div> 
</div>

{{-- 
|--------------------------------------------------------------------------
| EDIT
|--------------------------------------------------------------------------
 --}}

 <div class="tabaddnew">
    <div id="editaccount" class="editaccount">
        @php error_reporting(0); @endphp
            @foreach ( $edits as $edit)
                <form method="post" action="/account/update/{{ $edit->account_slug }}">
                    <h1><center>Edit {{ $title }} {{ $edit->account_name }} </center></h1>
                    <h2>
                        <center>
                            Tambah/catat category income / pendapatan 
            supaya memantau keuangan menjadi lebih mudah
                        </center>
                    </h2>

                    @csrf

                    <label for="">Account Name : <input type="text" name="input_name" autocomplete="off" value="{{ $edit->account_name }}" required></label><br>
                    <label for="">Account Balance : <input type="number" name="input_balance" autocomplete="off" value="{{ $edit->account_balance }}" required></label><br>

                    <button type="submit">Edit Category + </button>
                    <br>
                </form>
            @endforeach
        @php error_reporting(E_ALL); @endphp

    </div> 
</div>






{{-- 
|--------------------------------------------------------------------------
| DELETE CATEGORY LANDING
|--------------------------------------------------------------------------
 --}}
            
 <div class="tabaddnew">
    @php error_reporting(0); @endphp
        <div id="deleteaccount" class="deleteaccount">
            @foreach ( $edits as $edit)
            <form method="get" action="/account/delete/{{ $edit->account_slug }}">
                <h1><center>Delete {{ $title }} Account</center></h1>
                <h2><center>Apabila {{ auth()->user()->name  }} akan menghapus <b>{{ $list->income_description }}</b>
                maka data tersebut akan menghilang selamanya</center></h2>
                
                @csrf
    
                <button class="bg-danger" type="submit"><b>Delete {{ $title }} Category</b> </button>
                <br>
            </form>
            @endforeach
        </div> 
    @php error_reporting(E_ALL); @endphp
</div>



{{-- 
|--------------------------------------------------------------------------
| CLEAR
|--------------------------------------------------------------------------
 --}}
            
 <div class="tabaddnew">
    @php error_reporting(0); @endphp
        <div id="cleartable" class="cleartable">
            <form method="get" action="/account/decision/fresh">
                
                <h1><center><b>Clear Data</b></center></h1>
                <h2><center>Apabila <b>{{ auth()->user()->name  }}</b> akan melakukan <b>clear</b>
                    , maka data <b>pemasukan</b>,  <b>pengeluaran</b>, dan <b>utang</b> sebelumnya akan dihapus</center></h2
                
                @csrf
    
                <button class="bg-danger" type="submit"><b>Read Description!</b> </button>
                <br>
            </form>
        </div> 
    @php error_reporting(E_ALL); @endphp
</div>