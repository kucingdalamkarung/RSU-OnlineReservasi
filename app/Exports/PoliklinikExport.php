<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;

class PoliklinikExport implements FromView
{
    use Exportable;

    public function __construct($poli)
    {
        $this->poli = $poli;
    }

    public function view() : View
    {
        if($this->poli != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("poliklinik.namaPoli", "like", "%".$this->poli."%")
                ->get();

            return view('exports.poliklinik', ["data" => $data]);
        }
        else {  
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->get();

            return view('exports.poliklinik', ["data" => $data]);
        }
    }
}
