<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
	protected $table = 'dokter';

    public function poli() {
        return $this->belongsTo("poliklinik", "noPoli");
    }

    public function jadwal() {
        return $this->belongsTo("jadwal", "id");
    }
}
