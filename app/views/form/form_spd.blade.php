<form id="illuminati" method="post">
	<div class="form-container">
		<div id="form_spd_container">
			<div class="form-header">
					<div class="navbar-collapse pull-right spyer" style="position:fixed;z-index:999999;right:20px;bottom:40px;">
						<ul class="nav navbar-nav">
							<li><a class="btn btn-default" href="#no1">1</a></li>
							<li><a class="btn btn-default" href="#no2">2</a></li>
							<li><a class="btn btn-default" href="#o_pengikut">Pengikut</a></li>
						</ul>
					</div>
					<div class="backy"></div>
				<div id="edition" style="position:fixed;z-index:999999;left:20px;"></div>
				<div class="buttonium">
					<button type="button" id="panduan" class="btn btn-warning">
        			<i class="icon-help"></i>
          			Panduan
      				</button>
					<button class="btn btn-primary" type="submit">
					<i class="icon-floppy"></i>
					Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
					<i class="icon-backspace"></i>
					Batal</button>
					</div>
			</div>

			<div class="hidden">
			<input type="hidden" name="id_spd" value="<?php $latest = Spd_spd::orderBy('id_spd','desc')->pluck('id_spd');
		if ($latest == null) {
			$latest = 0;
		}
		echo $latest +1; ?>">
			<input type="hidden" name="jenis" >
			<input type="hidden" name="id_pengikut" value="<?php 		$latest = Spd_pengikut::orderBy('id_pengikut', 'desc')->pluck('id_pengikut');
		if ($latest == null) {
			$latest = 0;
		}
		echo $latest +1; ?>">
			<input type="hidden" name="edit_id_spd">
			</div>
			<div class="col-md-12" style="overflow-y:scroll;overflow-x:hidden;color:white;font-weight:bold">
				<div id="form_scrollable" data-spy="scroll" data-target=".spyer" class="row center-block">
					<div id="no1">
						<div class="form-box">
							<div class="hidden">
								<input name="no_surat"
								title="Isi data bidang Nomor Surat "
								required="required"
								autocomplete="off"
								type="text"
								maxlength="20"
								class="form-control input-sm">
							</div>	
							<div class="row">								
								<div class="form-group col-md-6">
									Sumber Dana
									<div class="panduan"
										data-bootstro-step="1"
										data-bootstro-title="Sumber Dana"
										data-bootstro-content="Terdapat 2 Sumber dana, <b>APBD</b> dan <b>APBN</b>"
										data-bootstro-placement="bottom">
										<select name="sumberdana"
										class="form-control input-sm"
										required="required"
										data-role="multiselect">
										<option value="" selected disabled>Sumber Dana</option>
										<option value="1">APBD</option>
										<option value="2">APBN</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									Kop Surat
									<div
										data-bootstro-step="1"
										data-bootstro-title="Sumber Dana"
										data-bootstro-content="pilihan Kop Surat, Terdapat 2 pilihan '<b>Dinas</b>' dan <b>SEKDA</b>"
										data-bootstro-placement="bottom">
										<select name="kop_surat"
										class="form-control input-sm"
										required="required"
										data-role="multiselect">
										<option value="" selected disabled>Kop Surat</option>
										<option value="1">[kop surat]DINAS</option>
										<option value="2">[kop surat]SEKDA</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								MAK
								<div class="panduan"
									data-bootstro-step="2"
									data-bootstro-title="MAK"
									data-bootstro-content="isilah bidang MAK dengan kode akun anda."
									data-bootstro-placement="bottom">
								<input type="text" required="required" title="Isi bidang MAK terlebih dahulu !" name="mak" value="" class="form-control input-sm" autocomplete="off">
								</div>
							</div>
							Dasar Penugasan
							<div class="panduan"
								data-bootstro-step="3"
								data-bootstro-title="Dasar Penugasan"
								data-bootstro-content="bidang Dasar Penugasan."
								data-bootstro-placement="bottom">
							<textarea class="form-control input-sm" title="Isi data bidang Dasar Penugasan terlebih dahulu" required="required" name="dasar_penugasan" value="" style="min-height:135px"></textarea>
							</div>
								<div class="form-group">
								Kendaraan Yang Digunakan
								<div class="panduan"
								data-bootstro-step="4"
								data-bootstro-title="Jenis Transportasi"
								data-bootstro-content="Terdapat 3 pilihan, <b>Kendaraan Umum</b>, <b>Kendaraan Dinas</b>, dan <b>Kendaraan Pribadi</b>"
								data-bootstro-placement="bottom">
									<select name="transportasi" required="required" title="pilih jenis alat angkut terlebih dahulu" class="form-control input-sm" data-role="multiselect">
										<option value="" selected disabled>pilih jenis kendaraan</option>
										<option>Kendaraan Umum</option>
										<option>Kendaraan Dinas</option>
										<option>Kendaraan Pribadi</option>
									</select>
								</div>
								</div>
								Maksud Perjalanan Dinas
								<div class="panduan"
								data-bootstro-step="5"
								data-bootstro-title="Maksud perjalanan dinas"
								data-bootstro-content="Maksud perjalanan dinas"
								data-bootstro-placement="bottom">
								<textarea class="form-control input-sm" title="Isi data bidang Maksud Perjalan Dinas terlebih dahulu" required="required" name="maksud" value="" style="min-height:135px"></textarea>
								</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div id="no2">
						<div class="form-box">
							<div id="nama_petugas">
								{{--list Nama Petugas--}}
							</div>
							<div class="form-group edithide">
								<div class="panduan "
								data-bootstro-step="6"
								data-bootstro-title="Nama Petugas"
								data-bootstro-content="Petugas SPD dapat dipilih melalui tombol ini."
								data-bootstro-placement="bottom">
								Nama Pegawai Yang Bertugas
								<br><span id="nama_nama"></span>
								<div id="select_umum">
								<?php $options = Spd_pemangku::select('nip','nama_pemangku')->orderBy('id_pemangku')->get(); ?>
									<select id="nama_pegawai_umum" multiple="multiple" name="nip[]">
									@foreach ($options as $opsi)
										<option value="{{ $opsi->nip }}">{{ $opsi->nama_pemangku }}</option>
									@endforeach
									</select>
								</div>
								<div id="select_khusus">
									<span></span>
									<select id="nama_pegawai_khusus" multiple="multiple" name="nip[]">
									@foreach ($options as $opsi)
										<option value="{{ $opsi->nip }}">{{ $opsi->nama_pemangku }}</option>
									@endforeach
									</select>
								</div>
								</div>
							</div>
							<div class="panduan "
								data-bootstro-step="7"
								data-bootstro-title="Waktu"
								data-bootstro-content="Isilah Waktu berangkat dan kembali, pada bidang ini."
								data-bootstro-placement="bottom">
								Waktu
								<div class="row">
									<div class="form-group col-sm-5">
										<div>
											<input type="text" class="form-control input-sm" name="waktu_mulai"	autocomplete="off" title="Isi bidang terlebih dahulu !">
										</div>			
									</div>
									<div class="form-group col-sm-2">s/d</div>
									<div class="form-group col-sm-5">
										<input type="text" class="form-control input-sm" name="waktu_selesai" autocomplete="off" title="Isi bidang terlebih dahulu !">
									</div>
								</div>
							</div>

							<div class="row panduan"
								data-bootstro-step="8"
								data-bootstro-title="Tanggal"
								data-bootstro-content="Tanggal Berangkat dan Tanggal kembali"
								data-bootstro-placement="bottom">
								<div class="form-group col-sm-6">
									Tgl Berangkat
									<input name="tgl_berangkat"
									title="Isi data bidang Tanggal Berangkat "
									required="required"
									autocomplete="off"
									type="date" 
									value=""
									class="form-control input-sm" >
								</div>
								<div class="form-group col-sm-6">
									Tgl Kembali
									<input name="tgl_kembali" 
									title="Isi data bidang Tanggal Kembali " 
									required="required"
									autocomplete="off" 
									type="date" 
									value=""
									class="form-control input-sm">
								</div>
							</div>
							<div class="form-group panduan "
								data-bootstro-step="9"
								data-bootstro-title="Tempat Berangkat"
								data-bootstro-content=""
								data-bootstro-placement="bottom">
								Tempat Berangkat
								<input  name="tmpt_asal" 
								title="Isi data bidang Tempat Berangkat " 
								required="required" 
								autocomplete="off" 
								type="text" 
								value=""
								class="form-control input-sm ">
							</div>
							<div  class="form-group panduan"
								data-bootstro-step="10"
								data-bootstro-title="Tempat Tujuan"
								data-bootstro-content=""
								data-bootstro-placement="bottom">
								Tempat Tujuan
								<input name="tujuan"  
								title="Isi data bidang Tempat Tujuan " 
								required="required" 
								autocomplete="off" 
								type="text" 
								value=""
								class="form-control input-sm">
							</div>
						</div>
					</div>
					<div id="o_pengikut"  class="panduan"
								data-bootstro-step="11"
								data-bootstro-title="Form Pengikut"
								data-bootstro-content=""
								data-bootstro-placement="top">
						<div class="form-box">
							<div id="c_pengikut">
								<div class="pengikut-child">
									<div class="row">
										<div class="form-group col-sm-6">
											Nama Pengikut
											<input type="text"
											name="nama_pengikut_" 
											class="form-control input-sm">
										</div>
										<div class="form-group col-sm-6">
											Tanggal Lahir
											<input type="date" 
											name="tgl_lahir_"
											class="form-control input-sm">
										</div>
									</div>
									<div>
										Keterangan
										<input type="text" name="ket_" class="form-control input-sm">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

					<script type="text/javascript">

					$("#panduan").click(function(){
				        bootstro.start(".panduan");    
				    });

					var cope = 	$('div#c_pengikut').html();
					for(i=0;i<4;i++){
						$('div#c_pengikut').append(cope);
					}
					$i = 0;
					$('div#c_pengikut input[name=nama_pengikut_]').each(function(){
						$real = $(this).attr('name');
						$(this).attr('name', $real+$i);
						$i++;
					});
					$i = 0;
					$('div#c_pengikut input[name=tgl_lahir_]').each(function(){
						$real = $(this).attr('name');
						$(this).attr('name', $real+$i);
						$i++;
					});
					$i = 0;
					$('div#c_pengikut input[name=ket_]').each(function(){
						$real = $(this).attr('name');
						$(this).attr('name', $real+$i);
						$i++;
					});
					</script>
			</div>
		</div>
	</div>
</form>