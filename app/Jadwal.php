<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    public function dokter() {
      return $this->belongsTo("dokter", "kodeDokter");
    }
}
