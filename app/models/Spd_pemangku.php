<?php

class Spd_pemangku extends Eloquent {
	protected $table = 'spd_pemangku';

	public function nip()
    {
        return $this->belongsTo('spd_spd.nip');
    }
}
