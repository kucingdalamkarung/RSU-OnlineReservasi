<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use App\Dokter;
use DB;
use Validator;

class JadwalController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function index() {
        $listJadwal = DB::table("jadwal")
                    ->select(DB::raw("jadwal.id, poliklinik.namaPoli as poli, dokter.namaDokter as dokter, jadwal.jam as jam, jadwal.hari hari"))
                    ->join("dokter", "dokter.kodeDokter", '=', "jadwal.dokter")
                    ->join("poliklinik", "dokter.poli", '=', "poliklinik.noPoli")
                    ->paginate(25);
        return view("admin.jadwal")->with(compact("listJadwal"));
    }

    public function addJadwal() {
        $listDokter = DB::table("dokter")->get();
        return view("admin.jadwal.add")->with(compact("listDokter"));
    }

    public function storeJadwal(Request $request) {
        $validator = Validator::make($request->all(), [
            "hari" => "required",
            "jam" => "required"
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $jadwal = new Jadwal();
        $jadwal->dokter = htmlspecialchars($request->dokter);
        $jadwal->jam = htmlspecialchars($request->jam);
        $jadwal->hari = htmlspecialchars($request->hari);

        if ($jadwal->save()) {
            \Session::flash("messages", "Berhasil menambahkan data jadwal");
            return redirect(route("admin_jadwal"));
        }
        else {
            \Session::flash("messages", "Gagal menambahkan data jadwal");
            return back();
        }
    }

    public function destroy(Request $request, $id) {
        if(DB::table("jadwal")->where("id", $id)->delete()) {
            \Session::flash("messages", "Berhasil menghapus jadwal dokter");
            return redirect('/admin/jadwal');
        }
    }

    public function editJadwal(Request $request, $id)
    {
        $listDokter = DB::table("dokter")->get();
        $jadwal = DB::table("jadwal")->where("id", $id)->get();
        return view("admin.jadwal.edit")->with(compact("listDokter", "jadwal"));
    }

    public function updateJadwal(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "hari" => "required",
            "jam" => "required"
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $update = DB::table("jadwal")->where("id", $id)
                ->update([
                    "hari" => htmlspecialchars($request->hari),
                    "jam" => htmlspecialchars($request->jam)
                ]);

        if($update) {
            \Session::flash("messages", "Berhasil mengupdate data jadwal dokter");
            return redirect(route("admin_jadwal"));
        }
        else {
            \Session::flash("messages", "Gagal mengupdate data jadwal dokter");
            return back();
        }
    }
}
