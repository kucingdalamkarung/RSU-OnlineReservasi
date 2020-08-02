<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;

class PenjaminExport implements FromView
{
    use Exportable;

    public function __construct($penjamin)
    {
        $this->penjamin = $penjamin;
    }

    public function view() : View
    {
        if($this->penjamin != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("penjamin", "like", "%".$this->penjamin."%")
                ->get();

            return view('exports.penjamin', ["data" => $data]);
        }
        else {  
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->get();

            return view('exports.penjamin', ["data" => $data]);
        }
    }
}
