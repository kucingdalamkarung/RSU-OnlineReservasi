<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use App\Exports\LaporanExport;
use App\Exports\PasienExport;
use App\Exports\PoliklinikExport;
use App\Exports\DokterExport;
use App\Exports\PenjaminExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon;
use PDF;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function index() {
        return view("admin");
    }

    public function laporan() {
        return view("admin.laporan");
    }

    public function laporanPeriode() {
        $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->paginate(25);

        return view("admin.laporan.periode")->with(compact("data"));
    }

    public function periodeSrc(Request $request) {
        $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->whereBetween("antrian.created_at", [$request->dateFrom, $request->dateTo])
                ->paginate(25);

        return view("admin.laporan.periode")->with(compact("data"));
    }

    // export function to excel
    public function exportLaporanPeriode(Request $request) {
        return (new LaporanExport($request->dateFrom, $request->dateTo))->download("Laporan Periode-".Carbon::now()->format("d-M-Y").".xlsx");
    }

    public function exportLaporanPeriodePDF(Request $request) {
        if($request->dateFrom != null && $request->dateTo != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->whereBetween("antrian.created_at", [$request->dateFrom, $request->dateTo])
                ->paginate(25);

            $pdf = PDF::loadView('exports.periode-pdf', compact('data'));
            return $pdf->download("Laporan_Periode-".Carbon::now()->format("d-M-Y").".pdf");
        } 
        else {
            $data = DB::table("antrian")
            ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
            ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
            ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
            ->paginate(25);

            $pdf = PDF::loadView('exports.periode-pdf', compact('data'));
            return $pdf->download("Laporan_Periode-".Carbon::now()->format("d-M-Y").".pdf");
        }
    }

    public function laporanPasien() {
        $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->paginate(25);

        return view("admin.laporan.pasien")->with(compact("data"));
    }

    public function pasienSrc(Request $request) {
        $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("nama", "like", "%".htmlspecialchars($request->nama)."%")
                ->paginate(25);

        return view("admin.laporan.pasien")->with(compact("data"));
    }

    public function exportLaporanPasien(Request $request) {
        return (new PasienExport($request->nama))->download("Laporan Pasien-".Carbon::now()->format("d-M-Y").".xlsx");
    }

    public function exportLaporanPasienPDF(Request $request) {
        if($request->nama != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("pasien.nama", "like", "%".$request->nama."%")
                ->paginate(25);

            $pdf = PDF::loadView('exports.pasien-pdf', compact('data'));
            return $pdf->download("Laporan_Pasien-".Carbon::now()->format("d-M-Y").".pdf");
        } 
        else {
            $data = DB::table("antrian")
            ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
            ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
            ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
            ->paginate(25);

            $pdf = PDF::loadView('exports.pasien-pdf', compact('data'));
            return $pdf->download("Laporan_Pasien-".Carbon::now()->format("d-M-Y").".pdf");
        }
    }

    public function laporanDokter() {
        $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->paginate(25);

        return view("admin.laporan.dokter")->with(compact("data"));
    }

    public function dokterSrc(Request $request) {
        $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("namaDokter", "like", "%".htmlspecialchars($request->nama)."%")
                ->paginate(25);

        return view("admin.laporan.dokter")->with(compact("data"));
    }

    public function exportLaporanDokter(Request $request) {
        return (new DokterExport($request->nama))->download("Laporan Dokter-".Carbon::now()->format("d-M-Y").".xlsx");
    }

    public function exportLaporanDokterPDF(Request $request) {
        if($request->nama != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("dokter.namaDokter", "like", "%".$request->nama."%")
                ->paginate(25);

            $pdf = PDF::loadView('exports.dokter-pdf', compact('data'));
            return $pdf->download("Laporan_Dokter-".Carbon::now()->format("d-M-Y").".pdf");
        } 
        else {
            $data = DB::table("antrian")
            ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
            ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
            ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
            ->paginate(25);

            $pdf = PDF::loadView('exports.dokter-pdf', compact('data'));
            return $pdf->download("Laporan_Dokter-".Carbon::now()->format("d-M-Y").".pdf");
        }
    }

    public function laporanPoliklinik() {
        $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->paginate(25);

        return view("admin.laporan.poliklinik")->with(compact("data"));
    }

    public function poliklinikSrc(Request $request) {
        $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("namaPoli", "like", "%".htmlspecialchars($request->poli)."%")
                ->paginate(25);

        return view("admin.laporan.poliklinik")->with(compact("data"));
    }

    public function exportLaporanPoliklinik(Request $request) {
        return (new PoliklinikExport($request->poli))->download("Laporan Poliklinik-".Carbon::now()->format("d-M-Y").".xlsx");
    }

    public function exportLaporanPoliklinikPDF(Request $request) {
        if($request->poli != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("poliklinik.namaPoli", "like", "%".$request->poli."%")
                ->paginate(25);

            $pdf = PDF::loadView('exports.poliklinik-pdf', compact('data'));
            return $pdf->download("Laporan_Poliklinik-".Carbon::now()->format("d-M-Y").".pdf");
        } 
        else {
            $data = DB::table("antrian")
            ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
            ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
            ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
            ->paginate(25);

            $pdf = PDF::loadView('exports.poliklinik-pdf', compact('data'));
            return $pdf->download("Laporan_Poliklinik-".Carbon::now()->format("d-M-Y").".pdf");
        }
    }

    public function laporanPenjamin() {
        $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->paginate(25);

        return view("admin.laporan.penjamin")->with(compact("data"));
    }

    public function penjaminSrc(Request $request) {
        $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("penjamin", "like", "%".htmlspecialchars($request->penjamin)."%")
                ->paginate(25);

        return view("admin.laporan.penjamin")->with(compact("data"));
    }

    public function exportLaporanPenjamin(Request $request) {
        return (new PenjaminExport($request->penjamin))->download("Laporan Penjamin-".Carbon::now()->format("d-M-Y").".xlsx");
    }

    public function exportLaporanPenjaminPDF(Request $request) {
        if($request->penjamin != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("penjamin", "like", "%".$request->penjamin."%")
                ->paginate(25);

            $pdf = PDF::loadView('exports.penjamin-pdf', compact('data'));
            return $pdf->download("Laporan_Penjamin-".Carbon::now()->format("d-M-Y").".pdf");
        } 
        else {
            $data = DB::table("antrian")
            ->leftJoin("poliklinik", "penjamin.noPoli", '=', "antrian.poli")
            ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
            ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
            ->paginate(25);

            $pdf = PDF::loadView('exports.penjamin-pdf', compact('data'));
            return $pdf->download("Laporan_Penjamin-".Carbon::now()->format("d-M-Y").".pdf");
        }
    }

    public function printLaporanPeriode(Request $request)
    {
        if($request->dateFrom != null && $request->dateTo != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->whereBetween("antrian.created_at", [$request->dateFrom, $request->dateTo])
                ->get();

            return view("admin.print.periode-pdf")->with(compact("data"));
        }
        else {
            $data = DB::table("antrian")
                    ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                    ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                    ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                    ->get();

            return view("admin.print.periode-pdf")->with(compact("data"));
        }
    }

    public function printLaporanPasien(Request $request)
    {
        if($request->nama != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("nama", "like", "%".$request->nama."%")
                ->get();

            return view("admin.print.pasien-pdf")->with(compact("data"));
        }
        else {
            $data = DB::table("antrian")
                    ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                    ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                    ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                    ->get();

            return view("admin.print.pasien-pdf")->with(compact("data"));
        }
    }

    public function printLaporanDokter(Request $request)
    {
        if($request->nama != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("namaDokter", "like", "%".$request->nama."%")
                ->get();

            return view("admin.print.dokter-pdf")->with(compact("data"));
        }
        else {
            $data = DB::table("antrian")
                    ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                    ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                    ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                    ->get();

            return view("admin.print.dokter-pdf")->with(compact("data"));
        }
    }

    public function printLaporanPoliklinik(Request $request)
    {
        if($request->poli != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("namaPoli", "like", "%".$request->poli."%")
                ->get();

            return view("admin.print.poliklinik-pdf")->with(compact("data"));
        }
        else {
            $data = DB::table("antrian")
                    ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                    ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                    ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                    ->get();

            return view("admin.print.poliklinik-pdf")->with(compact("data"));
        }
    }

    public function printLaporanPenjamin(Request $request)
    {
        if($request->penjamin != null) {
            $data = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->where("penjamin", "like", "%".$request->penjamin."%")
                ->get();

            return view("admin.print.penjamin-pdf")->with(compact("data"));
        }
        else {
            $data = DB::table("antrian")
                    ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                    ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                    ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                    ->get();

            return view("admin.print.penjamin-pdf")->with(compact("data"));
        }
    }
}
