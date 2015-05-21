<script type="text/javascript">
	cancel();
</script>
<div class="modal-dialog center-block">
	<form method="post" class="child-batalkan">
		<div class="form-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right:10px;margin-left:10px">&times;</button>
			<button type="submit" class="btn btn-success btn-sm pull-right">
				<i class="icon-floppy"></i>
				Simpan
			</button>
			Pembatalan SPD, No. Surat <code></code>
			<h6>Diisi ketika terjadi perubahan jadwal, pembatalan, dan penyelesaian tugas lebih cepat dari jadwal terlampir</h6>
		</div>
		<div class="form-box">
			<h3>Status</h3>
			<div class="form-group">
				<select name="status" data-role="multiselect" class="form-control input-sm" required="">
					<option value="" selected disabled>pilih status</option>
					<option value="1">Dibatalkan</option>
					<option value="2">Ditunda</option>
					<option value="3">Selesai Sebelum Jadwal Yang Ditentukan</option>
				</select>
			</div>
			<h3>Alasan</h3>
			<div class="form-group">
				<textarea class="form-control input-sm" 
					title="Isi data field Dasar Penugasan terlebih dahulu"
					name="reason" 
					value="" 
					required=""
					style="min-height:135px"></textarea>
			</div>
		</div>
	</form>
</div>