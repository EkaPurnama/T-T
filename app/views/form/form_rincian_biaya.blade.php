
<script type="text/javascript">
	rb(function(){

	$(document).ready(function(){

		$('form#frm-rincian input[type=number]').each(function() {

			$(this).keyup(function(){
				calculateSum();
			});
		});
		$(window).keydown(function(event){
			if(event.keyCode == 13) {
				event.preventDefault();
				return false;
			}
		});

	});

	function calculateSum() {

		var sum = 0;
        //iterate through each textboxes and add the values
        $('form#frm-rincian input[type=number]').each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
            	sum += parseFloat(this.value);
            }

        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("span#totalValue").html('Rp. ' + sum.toFixed(2));
    };
	});

</script>
<div class="modal-dialog center-block">
	<div class="row">
		<div class="form-start">
			<div class="form-medium">
				<form id="frm-rincian" method="post">
					<div class="form-header">
						Rincian Biaya <code></code>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right:10px;margin-left:10px">&times;</button>
						<span id="totalValue" style="margin-left: 30px;"></span>
						<button type="submit" class="btn btn-success btn-sm pull-right">
							<i class="icon-floppy"></i>
							Simpan
						</button>
						<button id="pandurinci" type="button" class="btn btn-warning btn-sm pull-right pandurinci"
						data-bootstro-content="Selamat datang. Isilah data pada bidang - bidang yang telah ditentukan, dengan format seperti contoh :<br>- <code class='alert-info'>benar</code> <b>100000</b> <br>- <code>Salah</code> <b>100-000</b><br>- <code>Salah</code> <b>100.000</b><br>- <code>Salah</code> <b>100 000</b><br>- <code>Salah</code> <b>100.000,-</b><br>- <code>Salah</code> <b>100.000.00</b>."
						data-bootstro-placement="bottom">
							<i class="icon-help"></i>
							Panduan
						</button>
					</div>

					<div class="form-box" style="max-height:560px;overflow-y:scroll">
						<div class="form-group edithide">
							<div class="panduan "
							data-bootstro-step="6"
							data-bootstro-title="Nama Petugas"
							data-bootstro-content="Petugas SPD dapat dipilih melalui tombol ini."
							data-bootstro-placement="bottom">
							Nama Pegawai Yang Bertugas
							<br><span id="nama_nama"></span>

							</div>
						</div>

						<div class="hidden"></div>

						<div id="new-rincian-khusus">

						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>