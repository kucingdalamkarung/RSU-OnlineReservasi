<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    protected $table = "poliklinik";
    protected $primaryKey = "noPoli";
    protected $fillable = ["noPoli", "namaPoli"];

    public function dokter()
    {
        return $this->belongsTo("dokter", "kodeDokter");
    }
}
