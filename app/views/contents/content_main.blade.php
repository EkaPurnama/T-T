@extends('layouts.base')
@section('content')
@if ( Auth::check() )
        @if ($message = Session::get('success'))
            <div class="alert alert-info pull-right" data-alert="alert" style="position:absolute;right:615px">
                <a id="notifier"><i class="icon-thumbs-up"></i><strong>Berhasil !!!</strong> {{ $message }}</a>
            </div>
            <script type="text/javascript">
            setTimeout(function () {
              $('#notifier').alert('close');
            }, 5000);
            </script>
        @endif
<div id="content_table">
<div class="table-responsive">
	<div class="btn-group col-md-12" style="text-align:left;margin:10px;">
			<form class="pull-right" id="ekspormonitor">
				<button type="submit" class="btn btn-success"><i class="icon-printer"></i> Ekspor Monitor</button>
			</form>
			<button type="button" class="btn btn-default disabled">
				<i class="icon-calendar"></i>
				<strong>Monitor Bulanan</strong>
			</button>
			<form action="" method="post">
			<select name="bulan" data-role="multiselect">
				<option value="01">Januari</option>
				<option value="02">Februari</option>
				<option value="03">Maret</option>
				<option value="04">April</option>
				<option value="05">Mei</option>
				<option value="06">Juni</option>
				<option value="07">Juli</option>
				<option value="08">Agustus</option>
				<option value="09">September</option>
				<option value="10">Oktober</option>
				<option value="11">November</option>
				<option value="12">Desember</option>
			</select>
			<button type="submit" class="btn btn-success" >
				<span class="icon-list"></span>
				<span class="sr-only">Toggle Dropdown</span>
			</button>
			</form>
		</div>
<table class="table table-striped table-bordered table-condensed demo2"
	    data-bootstro-step="3" 
        data-bootstro-title="Monitoring ?"
        data-bootstro-content="Setelah data <b>SPD</b> tersimpan, anda dapat memonitoring penerbitan surat tugas secara langsung lewat table ini.	"
        data-bootstro-placement="bottom">
	
	<thead>
	<tr>
		<th rowspan=2>#</th>
		<th rowspan=2 class="col-md-3">nama pelaksana spd</th>
		<th colspan=2 class="col-md-2">surat tugas</th>
		<th colspan=2 class="col-md-2">tanggal pelaksanaan</th>
		<th rowspan=2 class="col-md-4">tujuan</th>
		<th rowspan=2>
		<span class="demo2"
		data-bootstro-step="4" 
 		data-bootstro-title="OPSI ?"
 		data-bootstro-content="Barisan tombol <b>OPSI</b> dikolom ini berfungsi sebagai tuas utama editor data. Seperti <b>Rincian Biaya</b>, <b>Detail</b>, <b>Revisi</b>, <b>Ubah Jadwal</b>, <b>Ekspor Data</b>, <b>Pembatalan</b>, dan <b>Hapus</b>."
		data-bootstro-placement="left" style="text-transform:lowercase">Opsi</span>
		</th>
	</tr>
	<tr>
		<th>nomor</th>
		<th>tgl</th>
		<th>mulai</th>
		<th>selesai</th>
	</tr>
	</thead>
	<tbody id="ajax_table_spd">
		
	</tbody>
</table>
</div>

</div>
@else
<style type="text/css">
.icon-arrow-up-3{
	position:absolute;
	font-size:24px;
	top:56px;
	color:gold;
	-webkit-animation-name:forward;
    -webkit-animation-duration: 4000ms;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
}
@-webkit-keyframes forward{
	0%{left:900px;opacity: 1;}
	12%{top: 36px;}
	18%{top: 56px;}
	24%{left:900px;opacity: 0;}
	50%{left:1100px;opacity: 1;}
	56%{top: 56px;}
	62%{top: 36px;}
	68%{top: 56px;}
	74%{left:1100px;opacity: 0;}
	100%{left:900px;opacity: 1;}
}
a>i.icon-enter{cursor:pointer;}
</style>
	<div class="jumbotron" style="border:2px dashed gold;box-shadow:0 0 5px black,inset 0 0 3px darkgray">
	<h1 class="demo1" data-bootstro-title="Hak Akses" data-bootstro-content="Pertama anda harus mempunyai <b>Akun</b> terlebih dahulu sebelum masuk beranda aplikasi dan mengakses seluruh konten dan fitur dari <b>Aplikasi</b>." data-bootstro-step="1" data-bootstro-placement="bottom"><i class="icon-blocked" style="color:#900"></i> Anda tidak memiliki hak akses, </h1>
	<button id="demo1" class="btn btn-warning btn-lg center-block demo1" style="margin-top: 12px;" data-bootstro-step="0" data-bootstro-title="Selamat Datang." data-bootstro-content="Selamat Datang dimode <b>Trial</b> Aplikasi Surat Perjalanan Dinas. Klik <b>NEXT</b> untuk mulai tur.">
	<i class="icon-help">
	</i>
	Panduan
	</button>
	<h4 class="pull-right">Anda harus masuk <a><i class="icon-enter" onclick="$('[name=username]').focus()"></i></a> dahulu.<i class="icon-arrow-up-3"></i></h4>
	</div>
     
	@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$('input[name=username]').focus();
             
	      $("#demo1").click(function(){
	      bootstro.start(".demo1");    
	  });

	})
</script>
@stop
@endif
@stop
