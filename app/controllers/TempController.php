<?php

class TempController extends BaseController {
	public function waw($id,$sumber){
		require("class.terbilang.php");
		require("class.nip.php");
		require("phpDocx.php");
		$phpdocx = new phpdocx("start_kwitansi_dobel.docx");
		$in = Input::all();
		$kepala = DB::table('spd_setting')->pluck('ppk');
		$kep = DB::table('spd_pemangku')->where('nip', $kepala)->get(array('nama_pemangku', 'nip'));
		$bendahara = DB::table('spd_setting')->pluck('bendpengeluaran');
		$ben = DB::table('spd_pemangku')->where('nip', $bendahara)->get(array('nama_pemangku', 'nip'));
		foreach ($in['total'] as $key => $value) {
			$tahun = date('Y');
			$uang = number_format($in['total'][$key],2,',','.');
			$toter = strtoupper(Terbilang($in['total'][$key]));
			$assigning[$key] = array("#TAHUN#"=>$tahun,"#MAK#"=>$in['mak'],"#MAKSUD#"=>$in['maksud'],"#TOTAL#"=>$uang,"#TOTAL TERBILANG#"=>$toter,"#NAMA#"=>$in['nama'][$key],"#NIP#"=>Nipin($in['nip'][$key]),"#TANGGAL KWITANSI#"=>Tglin($in['tanggalkwitansi']),"#TANGGAL SURAT#"=>Tglin($in['tanggalkwitansi']),"#BENDAHARA#"=>$ben[0]->nama_pemangku,"#NIP BENDAHARA#"=>Nipin($ben[0]->nip),"#NAMA KEPALA#"=>$kep[0]->nama_pemangku,"#NIP KEPALA#"=>Nipin($kep[0]->nip));
			$phpdocx->assignBlock("kwitansi", $assigning);
		}
		$time = date('d-m-Y');
		$phpdocx->download("Kwitansi_".$id."_".$time.".docx");
	}


	public function lampiranSppd($id, $sumber){

		require("phpDocx.php");
		
		$in = Input::all();
		$tahun = date('Y');
		$phpdocx = new phpdocx("template_lampiran_sppd.docx");
		
		$spd_setting = DB::table('spd_setting')->get(array('ppk','nama_skpd','alamat','kode_skpd','bendpengeluaran','bendprov','nipprov'));
		foreach ($spd_setting as $key) {
			$ppk = $key->ppk;
			$nama_skpd = $key->nama_skpd;
			$alamat = $key->alamat;
			$kode_skpd = $key->kode_skpd;
			$bendprov = $key->bendprov;
			$nipprov = $key->nipprov;
			$bendpengeluaran = $key->bendpengeluaran;
		}

		$spd_pemangku = DB::table('spd_pemangku')->where('nip', $ppk)->get(array('nama_pemangku', 'nip','golongan_ruang','jabatan'));
		foreach ($spd_pemangku as $key) {
			$nama_kepala = $key->nama_pemangku;
			$jabatan = $key->jabatan;
			$nip_kepala = $key->nip;
			$golongan_ruang_kepala = $key->golongan_ruang;
		}
		$uh = 0;

	$tanggalsurat = strftime("%d-%B-%Y",strtotime($in['tgl_berangkat']));
	$tanggalberangkat = strftime("%d-%m-%Y", strtotime($in['tgl_berangkat']));
	$tanggalkembali = strftime("%d-%m-%Y", strtotime($in['tgl_kembali']));
		foreach ($in['nip'] as $key => $value) {
			$uh++;

			$tempel[$key] = array(
				"#NO#"=> $uh,
				"#NAMA#"=> $in['nama'][$key],
				"#GOLONGAN#"=> $in['golongan'][$key],
				"#PANGKAT#"=> $in['pangkat'][$key],
				"#JABATAN#"=> $in['jabatan'][$key],
				"#TINGKAT BIAYA#"=> $in['tingkat_biaya'],
				"#TRANS#"=> $in['transportasi'],
				"#KODE SPD#"=> $id,
				"#KODE SKPD#"=> $kode_skpd,
				"#TAHUN#"=> $tahun,
				"#TANGGAL SURAT#"=> $tanggalberangkat,
				"#TANGGAL BERANGKAT#"=> $tanggalberangkat,
				"#TANGGAL KEMBALI#"=> $tanggalkembali);

			$phpdocx->assignBlock("petugas", $tempel);
		}
		
			$time = date('d-m-Y');
			
			$phpdocx->assign("#KODE SPD#", $id);
			$phpdocx->assign("#KODE SKPD#", $kode_skpd);
			$phpdocx->assign("#TAHUN#", $tahun);
			$phpdocx->assign("#TANGGAL SURAT#", $tanggalsurat);
			$phpdocx->assign("#NAMA SKPD#", $nama_skpd);
			$phpdocx->assign("#NAMA KEPALA#", $nama_kepala);
			$phpdocx->assign("#GOLONGAN#", $golongan_ruang_kepala);
			$phpdocx->assign("#NIP KEPALA#", $nip_kepala);
			$phpdocx->assign("#TANGGAL BERANGKAT#", $tanggalberangkat);
			$phpdocx->assign("#TUJUAN#", $in['tujuan']);

			$phpdocx->download("Lampiran_SPPD_".$id."_".$time.".docx");

		$phpdocx->download("Lampiran_SPPD_")->with('success', 'Lampiran SPPD berhasil terekspor dengan nama');
	}

	public function wow($id,$sumber){
		require("class.terbilang.php");
		require("phpDocx.php");
		require("class.nip.php");

		$spd = Spd_spd::where('kode_spd', $id)->get(array('mak','nip','kode_spd','maksud','tujuan','tgl_berangkat','tgl_kembali','waktu_mulai','waktu_selesai','dasar_penugasan','tgl_terbit'));
		foreach ($spd as $x) {
			$mksd = $x->maksud;
			$tgl_berangkat = $x->tgl_berangkat;
			$tgl_terbit = $x->tgl_terbit;
			$mak = $x->mak;
		}

		$spd_setting = DB::table('spd_setting')->get(array('ppk','nama_skpd','alamat','kode_skpd','bendpengeluaran','bendprov','nipprov'));
		foreach ($spd_setting as $key) {
			$ppk = $key->ppk;
			$nama_skpd = $key->nama_skpd;
			$alamat = $key->alamat;
			$kode_skpd = $key->kode_skpd;
			$bendprov = $key->bendprov;
			$nipprov = $key->nipprov;
			$bendpengeluaran = $key->bendpengeluaran;
		}

		$spd_pemangku = DB::table('spd_pemangku')->where('nip', $ppk)->get(array('nama_pemangku', 'nip','golongan_ruang','jabatan'));
		foreach ($spd_pemangku as $key) {
			$nama_kepala = $key->nama_pemangku;
			$jabatan = $key->jabatan;
			$nip_kepala = $key->nip;
			$golongan_ruang_kepala = $key->golongan_ruang;
		}

		$bendahara = DB::table('spd_pemangku')->where('nip', $bendpengeluaran)->get(array('nama_pemangku'));
		foreach ($bendahara as $key) {
			$nama_bendahara = $key->nama_pemangku;
		}

		$tahun = date('Y');
		$time = date('d-m-Y');
		$in = Input::all();
		$kepala = DB::table('spd_setting')->pluck('ppk');
		$kep = DB::table('spd_pemangku')->where('nip', $kepala)->get(array('nama_pemangku', 'nip'));
		$bendahara = DB::table('spd_setting')->pluck('bendpengeluaran');
		$ben = DB::table('spd_pemangku')->where('nip', $bendahara)->get(array('nama_pemangku', 'nip'));

		$nip = DB::table('spd_rincian')->where('kode_spd', $id)->distinct()->select('nip')->get();


		if ($sumber == 1) {
			$phpdocx = new phpdocx("template_rincian_biaya_1.docx");

			$i = 0;
			$ah = 0;

			setlocale(LC_ALL, 'INDONESIA');
			$tanggalsurat = date_format(date_create($tgl_berangkat),"d-F-Y");
			$tanggalasd = date_format(date_create($tgl_berangkat),"d-m-Y");
			foreach ($nip as $k => $v) {
				$i++;
				$iku[$k] = array($nip[$k]->nip => DB::table('spd_rincian')->where('kode_spd', $id)->where('nip',$nip[$k]->nip)->select('nip','komponen_biaya','jumlah')->get());

				foreach ($iku[$k][$nip[$k]->nip] as $l => $w) {
					$ah++;
					$kompjum = number_format($iku[$k][$nip[$k]->nip][$l]->jumlah,2,',','.');
					$iki[$k][$l] = array("#NO#"=> $ah,"#KOMPONEN#" => $iku[$k][$nip[$k]->nip][$l]->komponen_biaya,"#JUMLAH#" => $kompjum);
					$kompol = DB::table('spd_rincian')->where('kode_spd', $id)->where('nip', $nip[$k]->nip)->get(array('jumlah'));
					$kimpoi = count($kompol);
					if ($ah == $kimpoi) {
						$ah = 0;
					}
				}
				$phpdocx->assignNestedBlock("komponen", $iki[$k],array("nip"=>$i));

				foreach ($in['total'] as $key => $value) {
					$tahun = date('Y');
					$toter = strtoupper(Terbilang($in['total'][$key]));
					$uang = number_format($in['total'][$key],2,',','.');
					$assigning[$key] = array(
						"#TOTAL#"=>$uang,
						"#TERBILANG#"=>$toter,
						"#NAMA#"=>$in['nama'][$key],
						"#NIP#"=> Nipin($nip[$k]->nip),
						"#NAMA SKPD#"=> $nama_skpd,
						"#ALAMAT SKPD#"=> $alamat,
						"#KODE SPD#"=> $id,
						"#KODE SKPD#"=> $kode_skpd,
						"#TAHUN#"=> $tahun,
						"TANGGAL SURAT"=> $tanggalasd,
						"#TANGGAL RINCIAN#"=> $tanggalsurat,
						"#NAMA KEPALA#"=> $nama_kepala,
						"GOLONGAN"=> $golongan_ruang_kepala,
						"#NIP KEPALA#"=> Nipin($nip_kepala),
						"#NAMA BENDAHARA#"=> $nama_bendahara,
						"#NIP BENDAHARA#"=> Nipin($bendpengeluaran));
					$phpdocx->assignBlock("nip", $assigning);
				}
			}

		}else{
			$phpdocx = new phpdocx("template_rincian_biaya_2.docx");
			$i = 0;
			$ah = 1;

			setlocale(LC_ALL, 'INDONESIA');
			$tanggalsurat = date_format(date_create($tgl_berangkat),"d-F-Y");
			$tanggalasd = date_format(date_create($tgl_berangkat),"d-m-Y");
			foreach ($nip as $k => $v) {
				$i++;
				$iku[$k] = array($nip[$k]->nip => DB::table('spd_rincian')->where('kode_spd', $id)->where('nip',$nip[$k]->nip)->select('nip','komponen_biaya','jumlah')->get());

				foreach ($iku[$k][$nip[$k]->nip] as $l => $w) {

					$kompjum = number_format($iku[$k][$nip[$k]->nip][$l]->jumlah,2,',','.');
					$iki[$k][$l] = array("#KOMPONEN#" => $iku[$k][$nip[$k]->nip][$l]->komponen_biaya,"#JUMLAH#" => $kompjum);
					$ah++;
				}
				$phpdocx->assignNestedBlock("komponen", $iki[$k],array("nip"=>$i));

				foreach ($in['total'] as $key => $value) {
					$tahun = date('Y');
					$toter = strtoupper(Terbilang($in['total'][$key]));
					$uang = number_format($in['total'][$key],2,',','.');
					$assigning[$key] = array(
						"#TOTAL#"=>$uang,
						"#TERBILANG#"=>$toter,
						"#NAMA#"=>$in['nama'][$key],
						"#NIP#"=> Nipin($nip[$k]->nip),
						"#NAMA SKPD#"=> $nama_skpd,
						"#ALAMAT SKPD#"=> $alamat,
						"#KODE SPD#"=> $id,
						"#KODE SKPD#"=> $kode_skpd,
						"#TAHUN#"=> $tahun,		
						"TANGGAL SURAT"=> $tanggalasd,
						"#TANGGAL RINCIAN#"=> $tanggalsurat,
						"#NAMA KEPALA#"=> $nama_kepala,
						"GOLONGAN"=> $golongan_ruang_kepala,
						"#NIP KEPALA#"=> Nipin($nip_kepala),
						"#NAMA BENDAHARA#"=> $nama_bendahara,
						"#NIP BENDAHARA#"=> Nipin($bendpengeluaran));
					$phpdocx->assignBlock("nip", $assigning);
				}
			}
		}

		$phpdocx->download("Rincian_Biaya_".$id."_".$time.".docx");
	}


	public function wiw($bln){
		require("phpDocx.php");
		$phpdocx = new phpdocx("template_monitor.docx");
		$a = Spd_pemangku::join('spd_spd','spd_pemangku.nip','=','spd_spd.nip')->whereBetween('tgl_berangkat', array('01-'.$bln.'-2014', date_format(date_create('01-'.$bln.'-2014'),"t").'-'.$bln.'-2014'))->where('jenis','umum')->orderBy('id_spd','asc')->get();
		$b = Spd_spd::whereBetween('tgl_berangkat', array('01-'.$bln.'-2014', date_format(date_create('01-'.$bln.'-2014'),"t").'-'.$bln.'-2014'))->where('jenis','khusus')->orderBy('id_spd','asc')->get();

		foreach ($b as $key => $value) {
			$d = explode(',',$b[$key]->nip);
			$i = 0;
			foreach ($d as $k => $v) {
				$f[$key][$i] = DB::table('spd_pemangku')->where('nip',$v)->select('nama_pemangku')->get();
				$i++;
			}
		}
		if(isset($f)){
			$i =0;
			foreach ($f as $m => $n) {
				foreach ($f[$m] as $o => $p) {
					foreach ($f[$m][$o] as $q => $r) {
						$rs[$i][] = $r->nama_pemangku;
					}
				}
				$i++;
			}
			$i=0;
			foreach ($rs[$i] as $key => $value) {
				$g[$i] = implode(';', $rs[$i]);
				$e[$i] = $b[$key]->toArray();
	    		$e[$i]['nama_pemangku'] = $g[$i];
				$i++;
			}
			foreach ($e as $z => $y) {
				$val[$z]['tb'] = date_format(date_create($e[$z]['tgl_berangkat']),"j"); //intine mek nggoleki iki
				$val[$z]['tk'] = date_format(date_create($e[$z]['tgl_kembali']),"j");
				$val[$z]['tj'] = $val[$z]['tk'] - $val[$z]['tb'];
				$val[$z]['nm'] = $e[$z]['nama_pemangku'];
				$val[$z]['np'] = $e[$z]['nip'];
				$val[$z]['ns'] = $e[$z]['kode_spd'];
				$val[$z]['tt'] = $e[$z]['tgl_terbit'];
				$val[$z]['br'] = $e[$z]['tgl_berangkat'];
				$val[$z]['sl'] = $e[$z]['tgl_kembali'];
				$val[$z]['ct'] = $e[$z]['tujuan'];
				$val[$z]['rs'] = $e[$z]['reason'];
			}
			foreach($a as $b => $c){
				$vil[$b]['tb'] = date_format(date_create($a[$b]['tgl_berangkat']),"j");
				$vil[$b]['tk'] = date_format(date_create($a[$b]['tgl_kembali']),"j");
				$vil[$b]['tj'] = $vil[$b]['tk'] - $vil[$b]['tb'];
				$vil[$b]['nm'] = $a[$b]['nama_pemangku'];
				$vil[$b]['np'] = $a[$b]['nip'];
				$vil[$b]['ns'] = $a[$z]['kode_spd'];
				$vil[$b]['tt'] = $a[$z]['tgl_terbit'];
				$vil[$b]['br'] = $a[$z]['tgl_berangkat'];
				$vil[$b]['sl'] = $a[$z]['tgl_kembali'];
				$vil[$b]['ct'] = $a[$z]['tujuan'];
				$vil[$b]['rs'] = $a[$z]['reason'];
			}
		}
		$dayscount = date_format(date_create('01-'.$bln.'-2014'),"t");
		$year = date_format(date_create('01-'.$bln.'-2014'),"Y");
		$month = date_format(date_create('01-'.$bln.'-2014'),"F");
		$docdt["#TAHUN#"] = $year;
		$docdt["#BULAN#"] = $month;
		$veil = array();
		if(isset($val) && isset($vil)){
			$vail = array_merge($val,$vil);
			foreach ($vail as $x => $w) {
					$veil[$x]['put'] = '';
				$wizard = explode(";", $vail[$x]['nm']);
				$wazird = explode(",", $vail[$x]['np']);
				foreach ($wazird as $y => $z) {
					$veil[$x]['out'] = $wizard[$y]."<w:br/>".$wazird[$y]."<w:br/>";
					$veil[$x]['put'] = $veil[$x]['put'].$veil[$x]['out'];
				}
				$veil[$x]['dat'] = $vail[$x]['tb'];
				$veil[$x]['dif'] = $vail[$x]['tj'];
				$veil[$x]['mac'] = $vail[$x]['ns'];
				$veil[$x]['pub'] = $vail[$x]['tt'];
				$veil[$x]['dep'] = $vail[$x]['br'];
				$veil[$x]['arv'] = $vail[$x]['sl'];
				$veil[$x]['tuj'] = $vail[$x]['ct'];
				$veil[$x]['rea'] = $vail[$x]['rs'];
				for($c = 1; $c < 32; $c++){
					$assignal[$x]["#NO#"] = ($x+1);
					$assignal[$x]["#NAMANIP#"] = $veil[$x]['put'];
					$assignul[$x]["#NO#"] = ($x+1);
					$assignul[$x]["#NAMANIP#"] = $veil[$x]['put'];
					$assignul[$x]["#NO SURAT#"] = $veil[$x]['mac'];
					$assignul[$x]["#TGL SURAT#"] = $veil[$x]['pub'];
					$assignul[$x]["#TGL MULAI#"] = $veil[$x]['dep'];
					$assignul[$x]["#TGL SELESAI#"] = $veil[$x]['arv'];
					$assignul[$x]["#TUJUAN#"] = $veil[$x]['tuj'];
					$assignul[$x]["#KET#"] = $veil[$x]['rea'];
					if(($c+1) == $veil[$x]['dat']){
						for($t = 0; $t < $veil[$x]['dif']; $t++){
							$assignal[$x]["#".$c."#"] = "x";
							$c++;
						}
						$assignal[$x]["#".$c."#"] = "x";
					}else{
						$assignal[$x]["#".$c."#"] = "";
					}
				}
				$phpdocx->assignBlock("monitoring",$assignal);
				$phpdocx->assignBlock("pdj",$assignul);
			}
		}
		$phpdocx->assign("#TAHUN#",$docdt["#TAHUN#"]);
		$phpdocx->assign("#BULAN#",$docdt["#BULAN#"]);
		$time = date('d-m-Y');
		$phpdocx->download("monitoring_".$bln."_".$time.".docx");
		return $vail;
	}

}