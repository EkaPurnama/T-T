<script type="text/javascript">
	detail();
</script>
<style>
	#dialog_detail table th,#dialog_detail table td{
		border:none;
	}
</style>
<div class="modal-dialog center-block" style="max-height:540px;overflow:scroll-y;">

	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<strong><i class="icon-list"></i> DETAIL DATA</strong>
		</div>

		<div class="modal-body" style="max-height: 480px; overflow-y: scroll;">
			<div class="child_detail">
			</div>
			<h3><strong>Rincian Biaya</strong></h3><hr>
			<div class="child_rincian">
			<input type="hidden" name="total">
			</div>
			<div id="alltotal"></div>
			<h3><strong>Pengikut</strong></h3><hr>
			<div class="child_pengikut">
			</div>
		</div>

		<div class="modal-footer">
			<div class="btn-group dropup" style="text-align:left">
				<button type="button" class="btn btn-default disabled">
					<i class="icon-printer"></i>
					<strong>Ekspor Data</strong>
				</button>
				<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
					<span class="sr-only">Toggle Dropdown</span>
				</button>
				<div class="dropdown-menu" style="cursor:pointer;">
					<div class="list-group list-group-dropdown" style="margin:0;width:180px;">
						<a id="ekspor_surat_tugas" class="list-group-item">
							Ekspor Surat Tugas
						</a>
						<a id="ekspor_sppd" class="list-group-item">
							Ekspor SPPD
						</a>
						<form id="ekspor_lampiran_sppd" method="post">
						<button type="submit" class="btn btn-default list-group-item" style="width:100%;text-align:left">Lampiran SPPD</button>
						</form>
						<form id="ekspor_rincian_biaya" method="post">
						<button type="submit" class="btn btn-default list-group-item" style="width:100%;text-align:left">Ekspor Rincian Biaya</button>
						</form>
						<form id="ekspor_kwitansi" method="post">
						<button type="submit" class="btn btn-default list-group-item" style="width:100%;text-align:left">Ekspor Kwitansi</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>