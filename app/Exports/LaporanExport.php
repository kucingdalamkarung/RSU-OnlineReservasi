<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromView
{
    use Exportable;

    public function __construct($dateFrom, $dateTo)
    {
        $this->dataFrom = $dateFrom;
        $this->dataTo = $dateTo;
    }

    public function view() : View
    {
        if($this->dataFrom != null & $this->dataTo != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->whereBetween("antrian.created_at", [$this->dateFrom, $this->dateTo])
                ->get();

            return view('exports.periode', ["data" => $data]);
        }
        else {  
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->get();

            return view('exports.periode', ["data" => $data]);
        }
    }
}
