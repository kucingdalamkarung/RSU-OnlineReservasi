<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;

class PasienExport implements FromView
{
    use Exportable;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function view() : View
    {
        if($this->name != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("pasien.nama", "like", "%".$this->name."%")
                ->get();

            return view('exports.pasien', ["data" => $data]);
        }
        else {  
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->get();

            return view('exports.pasien', ["data" => $data]);
        }
    }
}
