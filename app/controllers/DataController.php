<?php
require('class.nip.php');
class DataController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getNewId(){
		$latest = Spd_spd::orderBy('id_spd','desc')->pluck('id_spd');
		if ($latest == null) {
			$latest = 0;
		}
		return $latest +1;
	}

	public function getNewKode(){
		$latest = Spd_spd::orderBy('kode_spd', 'desc')->pluck('kode_spd');
		if ($latest == null) {
			$latest = 0;
		}
		return $latest +1;
	}

	public function getNewIdPengikut(){
		$latest = Spd_pengikut::orderBy('id_pengikut', 'desc')->pluck('id_pengikut');
		if ($latest == null) {
			$latest = 0;
		}
		return $latest +1;
	}
	
	public function viewTable(){
		return View::make('tables.monitor')
			->with('title','Table')	
			->with('spd_spd', DB::table('spd_spd')->orderBy('id_spd')->get())
			->with('pemangku', Spd_pemangku::all());
	}

	public function postDeleteTable(){
		$input = Input::all();
		$indexId = $input['id'];
		DB::table('spd_spd')->where('kode_spd', $indexId)->delete();

		DB::table('spd_rincian')->where('kode_spd', $indexId)->delete();

		DB::table('spd_pengikut')->where('kode_spd', $indexId)->delete();

	
		return Redirect::to('')->with('success', 'Data Berhasil Di Hapus');
	}


	public function getNewIdRincian(){
		$latest = Spd_rincian::orderBy('id_rincian','desc')->pluck('id_rincian');
		if ($latest == null) {
			$latest = 0;
		}
		return $latest +1;
	}

	public function postCreateSpd(){
		$input = Input::all();
			$nip = implode(',',$input['nip']);
			DB::table('spd_spd')->insert(array(
				'id_spd' => $input['id_spd'],
				'kode_spd' => $input['no_surat'],
				'jenis' => $input['jenis'],
				'sumberdana' => $input['sumberdana'],
				'kop_surat' => $input['kop_surat'],
				'mak' => $input['mak'],
				'nip' => $nip,
				'waktu_mulai' => $input['waktu_mulai'],
				'waktu_selesai' => $input['waktu_selesai'],
				'tingkat_biaya' => $input['sumberdana'],
				'maksud' => $input['maksud'],
				'transportasi' => $input['transportasi'],
				'tmpt_asal' => $input['tmpt_asal'],
				'tujuan' => $input['tujuan'],
				'tgl_berangkat' => $input['tgl_berangkat'],
				'tgl_kembali' => $input['tgl_kembali'],
				'tgl_terbit' => date("Y-m-d"),
				'dasar_penugasan' => $input['dasar_penugasan']
				));
			if($input['jenis'] == 'umum'){
				$n = $input['id_pengikut'];
				for ($i = 0; $i <5 ; $i++) {
					if($input['nama_pengikut_'.$i] != null){
					DB::table('spd_pengikut')->insert(array(
						'id_pengikut' => $n,
						'nama' => $input['nama_pengikut_'.$i],
						'keterangan' => $input['ket_'.$i],
						'tgl_lahir' => $input['tgl_lahir_'.$i],
						'kode_spd' => $input['no_surat']
						));
					}
					$n++;
				}
			}

		return Redirect::to('')->with('success','SPD Berhasil tersimpan');
	}

	public function postEditSpd($id){
			$input = Input::all();
			DB::table('spd_spd')->where('id_spd', $id)->update(array(
				'kode_spd' => $input['no_surat'],
				'kop_surat' => $input['kop_surat'],
				'tingkat_biaya' => $input['sumberdana'],
				'maksud' => $input['maksud'],
				'transportasi' => $input['transportasi'],
				'tmpt_asal' => $input['tmpt_asal'],
				'tujuan' => $input['tujuan'],
				'tgl_berangkat' => $input['tgl_berangkat'],
				'tgl_kembali' => $input['tgl_kembali'],
				'mak' => $input['mak'],
				'dasar_penugasan' => $input['dasar_penugasan'],
				'waktu_mulai' => $input['waktu_mulai'],
				'waktu_selesai' => $input['waktu_selesai'],
				));
			if($input['jenis'] == 'umum'){
				$n = $input['id_pengikut'];
				for ($i = 0; $i <5 ; $i++) {
					if($input['nama_pengikut_'.$i] != null){
					DB::table('spd_pengikut')->insert(array(
						'id_pengikut' => $n,
						'nama' => $input['nama_pengikut_'.$i],
						'keterangan' => $input['ket_'.$i],
						'tgl_lahir' => $input['tgl_lahir_'.$i],
						'kode_spd' => $input['no_surat']
						));
					}
					$n++;
				}
			}
		return Redirect::to('')->with('success', "SPD berhasil terubah");
	}

	public function postUbahJadwal($id){
		$input = Input::all();
			DB::table('spd_spd')->where('kode_spd', $id)->update(array(
				'tgl_berangkat_revisi' => $input['tgl_berangkat_revisi'],
				'tgl_kembali_revisi' => $input['tgl_kembali_revisi']
				));
			return Redirect::to('')->with('success', "Jadwal Keberangkatan berhasil terubah menjadi tanggal ".$input['tgl_berangkat_revisi']);

	}

	public function postBatalkan($id){
		$input = Input::all();
			DB::table('spd_spd')->where('kode_spd', $id)->update(array(
				'reason' => $input['reason'],
				'status' => $input['status']
				));
			return Redirect::to('')->with('success', "Perjalanan Dinas dengan nomor surat".$id." Dibatalkan dengan alasan".$input['reason']);
	}
	public function postCreateRincian(){
		$k = array('uangharian','uangmakan','transportasi','penginapan','representasi','sewakendaraan','jenazah');
		$v = array('Uang Harian','Uang Makan','Transportasi','Penginapan','Representasi','Sewa Kendaraan','Jenazah');
		$input = Input::all();
		$id_rincian = $input['id_rincian'];
		$jmlForm = $input['jumlah_data'];
		for($i=0;$i<$jmlForm; $i++){
			$nip = $input['nip_'.$i];
			$j = 0;
			foreach ($k as $key) {
				if($input[$key.'_'.$nip] != null){
					if(isset($input['edit_'.$key.'_'.$nip])){
						//iki edit
						DB::table('spd_rincian')->where('id_rincian', $input['edit_id_'.$key.'_'.$nip])
						->update(array(
						'jumlah' => $input[$key.'_'.$nip]
						));
					}else{
						//iki gawe anyar
					DB::table('spd_rincian')
					->insert(array(
						'kode_spd' => $input['kode_spd'],
						'id_rincian' => $id_rincian,
						'komponen_biaya' => $v[$j],
						'jumlah' => $input[$key.'_'.$nip],
						'nip' => $nip
						));
					$id_rincian++;
					}
				}
				$j++;
			}
		}
		return Redirect::to('')->with('success', 'Data Rincian Biaya berhasil tersimpanan');
	}
	public function detail($id){
		return View::make('tables.detail')
			->with('title', '')
			->with('id', $id)
			->with('spd_spd', Spd_spd::where('id_spd', $id)->get());
	}
	
	public function ajaxTableDot(){
		$a = Spd_pemangku::join('spd_spd','spd_pemangku.nip','=','spd_spd.nip')->orderBy('id_spd','asc')->get();
		$b = Spd_spd::where('jenis','khusus')->orderBy('id_spd','asc')->get();
		$c = array_merge($a->toArray(),$b->toArray());
		return $c;
	}

	public function ajaxRincian_biaya($id){

		$kompbiaya = array();

			$kompbiaya = Spd_rincian::where('kode_spd', "=", $id)->select('id_rincian','komponen_biaya','jumlah','nip')->get();
		
		return $kompbiaya;
	}

	public function ajaxDetailRincian($kode, $id){

		$kompbiaya = array();

			$kompbiaya = Spd_rincian::where('kode_spd', $kode)->where('nip', $id)->select('id_rincian','komponen_biaya','jumlah','nip')->get();
		
		return $kompbiaya;
	}

	public function ajaxNip_rincian($id){
		$nip = Spd_rincian::where('kode_spd', $id)->distinct()->get(array('nip'));
		
		return $nip;
	}

	public function ajaxSpd($id){
		$dataspd = array();

		$dataspd = Spd_spd::where('kode_spd', "=", $id)->select('id_spd','kode_spd','jenis','nip','tingkat_biaya','maksud','transportasi','tmpt_asal','tujuan','tgl_berangkat','tgl_kembali','tgl_terbit','status','reason','sumberdana','dasar_penugasan','waktu_mulai','waktu_selesai','mak','tgl_berangkat_revisi','tgl_kembali_revisi')->get();

		return $dataspd;
	}
	public function ajaxPemangku($id){

		$pemangku = array();

			$pemangku = Spd_pemangku::where('nip', "=", $id)->select('nama_pemangku')->get();
		
		return $pemangku;
	}
	public function nip_list(){
		$namanip = Spd_pemangku::select('nama_pemangku','nip')->get(); 
		return $namanip->toArray();
	}

	public function ajaxJmlhNipRincian($id){
		$nip = Spd_rincian::where('kode_spd', "=", $id)->distinct('nip')->get(array('nip'));

		return $nip;
	}

	public function ajaxJmlhNipSpd($id){
		$nip = Spd_spd::where('kode_spd', $id)->select('nip')->get();
		$ns = explode(',',$nip[0]->nip);
		return $ns;
	}

	public function ajaxGetNamaNip($id){
		$nip = Spd_spd::where('kode_spd', $id)->select('nip')->get();
		$nippecah = explode(',',$nip[0]->nip);
		foreach ($nippecah as $key) {
			$nm[$key] = DB::table('spd_pemangku')->where('nip', $key)->select('nip','nama_pemangku','jabatan','golongan_ruang','pangkat')->get();
		}
		return $nm;
	}

	public function ajaxPengikut($id){
		$pengikut = Spd_pengikut::where('kode_spd', $id)->select('nama', 'tgl_lahir', 'keterangan')->get();

		return $pengikut;
	}

	public function eksporSurat_tugas($id, $sumber){
		setlocale(LC_ALL, '');
		$spd = Spd_spd::where('kode_spd', $id)->get(array('nip','kode_spd','maksud','tujuan','tgl_berangkat','tgl_kembali','waktu_mulai','waktu_selesai','dasar_penugasan','tgl_terbit'));
		foreach ($spd as $x) {
		$kd = $x->kode_spd;
		$mksd = $x->maksud;
		$tujuan = $x->tujuan;
		$tgl_berangkat = $x->tgl_berangkat;
		$tgl_kembali = $x->tgl_kembali;
		$waktu_mulai = $x->waktu_mulai;
		$waktu_selesai = $x->waktu_selesai; 
		$dasar_penugasan = $x->dasar_penugasan;
		$tgl_terbit = $x->tgl_terbit;
		}
		
		require("phpDocx.php");
		
		$hariberangkat = strftime("%A",strtotime($tgl_berangkat));
		if($sumber == 1){
			$phpdocx = new phpdocx("template_surat_tugas_1.docx");
		}else{
			$phpdocx = new phpdocx("template_surat_tugas_2.docx");
		}

		$spd_setting = DB::table('spd_setting')->get(array('ppk','nama_skpd','alamat','kode_skpd'));
		foreach ($spd_setting as $key) {
			$ppk = $key->ppk;
			$nama_skpd = $key->nama_skpd;
			$alamat = $key->alamat;
			$kode_skpd = $key->kode_skpd;
		}
		$rfkd = str_replace(".", "/", $kd);
			$phpdocx->assign("#NAMA SKPD#", $nama_skpd);
			$phpdocx->assign("#ALAMAT SKPD#", $alamat);
			$tahun = date('Y');
			$phpdocx->assign("#KODE SPD#", $rfkd);
			$phpdocx->assign("#KODE SKPD#", $kode_skpd);
			$phpdocx->assign("#TAHUN#", $tahun);
			$phpdocx->assign("#DASAR PENUGASAN#", $dasar_penugasan);


		$spd_pemangku = DB::table('spd_pemangku')->where('nip', $ppk)->get(array('nama_pemangku', 'nip','golongan_ruang'));
		foreach ($spd_pemangku as $key) {
			$nama_kepala = $key->nama_pemangku;
			$nip_kepala = $key->nip;
			$golongan_ruang_kepala = $key->golongan_ruang;
		}
		$nc = Nipin($nip_kepala);
		$phpdocx->assign("#NAMA KEPALA#", $nama_kepala);
		$phpdocx->assign("#NIP KEPALA#", $nc);
		$phpdocx->assign("#PANGKAT KEPALA#", $golongan_ruang_kepala);

		$nip_explode = explode(',',$spd[0]->nip);
		$no=1;
		foreach ($nip_explode as $key) {

			$nama[$key] = DB::table('spd_pemangku')->where('nip', $key)->select('nama_pemangku','golongan_ruang','pangkat','jabatan')->get();
			$n3 = Nipin($key);
			$petugas[$key] = array("#NO#"=> $no, "#NAMA#"=> $nama[$key][0]->nama_pemangku, "#GOLONGAN#"=> $nama[$key][0]->golongan_ruang, "#PANGKAT#"=> $nama[$key][0]->pangkat, "#NIP#"=> $n3, "#JABATAN#"=> $nama[$key][0]->jabatan);
			
			$phpdocx->assignBlock("petugas", $petugas);
			$no++;
		}
		$tanggalsurat = strftime("%d-%B-%Y",strtotime($tgl_berangkat));
		$phpdocx->assign("#TUJUAN#", $tujuan);
		$phpdocx->assign("#MAKSUD#", $mksd);
		$phpdocx->assign("TANGGAL BERANGKAT", date_format(date_create($tgl_berangkat),"d-m-Y"));
		$phpdocx->assign("TANGGAL SURAT", $tanggalsurat);
		$phpdocx->assign("#HARI#", $hariberangkat);
		$phpdocx->assign("#WAKTU MULAI#", $waktu_mulai);
		$phpdocx->assign("#WAKTU SELESAI#", $waktu_selesai);
		$time = date('d-m-Y');
		
		$phpdocx->download("Surat_Tugas_".$kd."_".$time.".docx");

		return Redirect::to('')->with('success', 'Data SPD berhasil Terexspor dengan nama : Surat_Tugas_'.$kd.'_'.$time.'.docx');
	
	}

	public function eksporSppd($id, $sumber){

	require("phpDocx.php");

		if($sumber == 1){
			$phpdocx = new phpdocx("template_sppd_1.docx");
		}else{
			$phpdocx = new phpdocx("template_sppd_2.docx");
		}

		$spd_setting = DB::table('spd_setting')->get(array('ppk','nama_skpd','alamat','kode_skpd'));
		foreach ($spd_setting as $key) {
			$ppk = $key->ppk;
			$nama_skpd = $key->nama_skpd;
			$alamat = $key->alamat;
			$kode_skpd = $key->kode_skpd;
		}
		$spd_pemangku = DB::table('spd_pemangku')->where('nip', $ppk)->get(array('nama_pemangku', 'nip','golongan_ruang','jabatan'));
		foreach ($spd_pemangku as $key) {
			$nama_kepala = $key->nama_pemangku;
			$jabatan_kepala = $key->jabatan;
			$nip_kepala = $key->nip;
			$golongan_ruang_kepala = $key->golongan_ruang;
		}
			$phpdocx->assign("#NAMA SKPD#", $nama_skpd);
			$phpdocx->assign("ALAMAT SKPD", $alamat);
			$tahun = date('Y');
			$phpdocx->assign("#KODE SPD#", $id);
			$phpdocx->assign("#KODE SKPD#", $kode_skpd);
			$phpdocx->assign("#TAHUN#", $tahun);
		
		$spd = Spd_spd::where('kode_spd', $id)->get(array('nip','kode_spd','maksud','tujuan','tgl_berangkat','tgl_kembali','waktu_mulai','waktu_selesai','dasar_penugasan','tgl_terbit','tingkat_biaya','transportasi','tmpt_asal'));
		foreach ($spd as $x) {
		$kd = $x->kode_spd;
		$mksd = $x->maksud;
		$tujuan = $x->tujuan;
		$tmpt_asal =$x->tmpt_asal;
		$tgl_berangkat = $x->tgl_berangkat;
		$tgl_kembali = $x->tgl_kembali;
		$waktu_mulai = $x->waktu_mulai;
		$waktu_selesai = $x->waktu_selesai; 
		$dasar_penugasan = $x->dasar_penugasan;
		$tgl_terbit = $x->tgl_terbit;
		$nip = $x->nip;
		$tingkat_biaya = $x->tingkat_biaya;
		$trans = $x->transportasi;
		}
		$spd_pemangku = DB::table('spd_pemangku')->where('nip', $nip)->get(array('nama_pemangku','pangkat','golongan_ruang','jabatan'));
		foreach ($spd_pemangku as $key) {
			$nama = $key->nama_pemangku;
			$pangkat = $key->pangkat;
			$golongan = $key->golongan_ruang;
			$jabatan = $key->jabatan;
		}
		$nip_explode = explode(',',$spd[0]->nip);
		$jmlh = count($nip_explode);
		if ($jmlh == 1) {
			$phpdocx->assign('NAMA PPK', $nama_kepala);
			$phpdocx->assign('#NAMA#', $nama);
			$phpdocx->assign('#NIP#', Nipin($nip));
			$phpdocx->assign('#PANGKAT#', $pangkat);
			$phpdocx->assign('#GOLONGAN#', $golongan);
			$phpdocx->assign('#JABATAN#', $jabatan);
			$phpdocx->assign('#TINGKAT BIAYA#', $tingkat_biaya);
		$phpdocx->assign("#TRANSPORTASI#", $trans);
		$phpdocx->assign("#TEMPAT ASAL#", $tmpt_asal);
		$phpdocx->assign('#TANGGAL BERANGKAT#', Tglan($tgl_berangkat));
		$phpdocx->assign('#TANGGAL KEMBALI#', Tglan($tgl_kembali));
		$phpdocx->assign('#DURASI#', "(isi terlebih dahulu)");


			$pengikut = DB::table('spd_pengikut')->where('kode_spd', $id)->select('nama','tgl_lahir','keterangan')->get();
			$nama = array();
			$ah=1;
			foreach ($pengikut as $key => $value) {
				$nama[$key] = array("#NO#"=> $ah,"#NAMA PENGIKUT#"=> $pengikut[$key]->nama, "#TANGGAL LAHIR#"=> Tglan($pengikut[$key]->tgl_lahir), "KETERANGAN"=> $pengikut[$key]->keterangan);
			
				$phpdocx->assignBlock("pengikut", $nama);
				$ah++;
			}
		}else{
			$phpdocx->assign('NAMA PPK', "terlampir");
			$phpdocx->assign('#NAMA#', "terlampir");
			$phpdocx->assign('#NIP#', "terlampir");
			$phpdocx->assign('#PANGKAT# (#GOLONGAN#)', "terlampir");
			$phpdocx->assign('#JABATAN#', "terlampir");
			$phpdocx->assign('#TINGKAT BIAYA#', "terlampir");
			$phpdocx->assign('#TRANSPORTASI#', "terlampir");
			$phpdocx->assign('#TEMPAT ASAL#', "terlampir");
			$phpdocx->assign('#DURASI#', "terlampir");
			$phpdocx->assign('#TANGGAL BERANGKAT#', "terlampir");
			$phpdocx->assign('#TANGGAL KEMBALI#', "terlampir");
			$phpdocx->assign('#KODE SPD#/#KODE SKPD#/#TAHUN#, #TANGGAL SURAT#', "terlampir");
			$phpdocx->assign('#NO#. #NAMA PENGIKUT#', "nihil");
			$phpdocx->assign('#TANGGAL LAHIR#', "nihil");
			$phpdocx->assign('#KETERANGAN#', "nihil");


		}

		$phpdocx->assign("#MAKSUD#", $mksd);
		$phpdocx->assign('#TUJUAN#', $tujuan);


	$time = date('d-m-Y');
	$tanggalsurat = strftime("%d-%B-%Y",strtotime($tgl_berangkat));
	$phpdocx->assign("TANGGAL SURAT", $tanggalsurat);


	$phpdocx->assign("#JABATAN KEPALA#", $jabatan_kepala);
	$phpdocx->assign("#NAMA KEPALA#", $nama_kepala);
	$phpdocx->assign("#NIP KEPALA#", Nipin($nip_kepala));
	$phpdocx->assign("#PANGKAT KEPALA#", $golongan_ruang_kepala);

	$phpdocx->download("SPPD_".$id."_".$time.".docx");

			return Redirect::to('')
			->with('success', 'Pengikut telah tersimpan : SPPD_'.$id.'_'.$time.'.docx');
		
	}


}