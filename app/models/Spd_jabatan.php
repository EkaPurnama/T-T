<?php

class Spd_jabatan extends Eloquent {
	protected $table = "spd_jabatan";
	public static $rules = array(
		'kodejab' => 'required',
		'nama_jabatan' => 'required',
		);
	public static $messages = array(
		'kodejab' => 'Field Kode Jabatan harus diisi terlebih dahulu',
		);
}
