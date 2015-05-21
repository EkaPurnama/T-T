<script type="text/javascript">
	ubah_jadwal();
	    $("#pandurinci").click(function(){
            bootstro.start(".pandurinci");    
        });
</script>

<div class="modal-dialog center-block">
	<form method="post" class="child-ubah-jadwal">
		<div class="form-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right:10px;margin-left:10px">&times;</button>
			<button type="submit" class="btn btn-success btn-sm pull-right">
				<i class="icon-floppy"></i>
				Simpan
			</button>
			<button id="panduanubah" type="button" class="btn btn-warning btn-sm pull-right panduanubah"
			data-bootstro-title="Panduan Ubah Jadwal"
			data-bootstro-content="Fitur Ubah jadwal hanya digunakan ketika Surat Tugas sudah terlanjur dicetak dan terjadi pengunduran jadwal.">
				<i class="icon-help"></i>
				Panduan
			</button>
			Ubah Jadwal No. Surat <code></code> 
			<div>
		<h6>Diisi ketika Surat Perintah Perjalanan Dinas sudah terlanjur tercetak</h6>
		</div>
		</div>
		<div class="form-box">
			<h3>Rencana Awal</h3>
			<div class="row">
				<div class="col-sm-6">	
					<h5>Tanggal Berangkat</h5>				
					<div class="child-tgl-berangkat"></div>
				</div>
				<div class="col-sm-6">
					<h5>Tanggal Kembali</h5>				
					<div class="child-tgl-kembali"></div>
				</div>
			</div>
			<h3>Revisi</h3>
			<div class="row">
				<div class="col-sm-6">
					<h5>Tanggal Berangkat</h5>
					<input name="tgl_berangkat_revisi" type="date" required="required">
				</div>
				<div class="col-sm-6">
					<h5>Tanggal Kembali</h5>
					<input name="tgl_kembali_revisi" type="date" required="required">
				</div>				
			</div>
		</div>
	</form>
</div>