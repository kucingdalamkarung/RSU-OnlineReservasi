<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Poliklinik;
use App\Dokter;

class DokterController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $listDokter = DB::table("dokter")
                    ->leftJoin("poliklinik", "poliklinik.noPoli", "=", "dokter.poli")
                    ->select()->paginate(25);
        return view("admin.dokter")->with(compact("listDokter"));
    }

    public function addDokter()
    {
        $poliList = DB::table("poliklinik")->get();
        return view("admin.dokter.add")->with(compact("poliList"));
    }

    public function storeDokter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodeDokter" => "required|unique:dokter",
            "namaDokter" => "required"
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $dokter = new Dokter();
        $dokter->kodeDokter = htmlspecialchars($request->get("kodeDokter"));
        $dokter->namaDokter = htmlspecialchars($request->get("namaDokter"));
        $dokter->poli = htmlspecialchars($request->poli);
        $dokter->status = htmlspecialchars($request->status);

        if ($dokter->save()) {
            \Session::flash("messages", "Berhasil menambahkan data dokter");
            return redirect(route("admin_dokter"));
        }
        else {
            \Session::flash("messages", "Gagal menambahkan data dokter");
            return back();
        }
    }

    public function editDokter($id)
    {
        $dokter = DB::table("dokter")->where("kodeDokter", $id)->get();
        $poliList = DB::table("poliklinik")->get();
        return view("admin.dokter.edit")->with(compact("dokter", "poliList"));
    }

    public function updateDokter(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "namaDokter" => "required"
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $dokter = DB::table("dokter") 
                ->where("kodeDokter", $id)
                ->update([
                    "namaDokter" => htmlspecialchars($request->namaDokter),
                    "status" => htmlspecialchars($request->status),
                    "poli" => htmlspecialchars($request->poli)
                ]);

        if($dokter) {
            \Session::flash("messages", "Berhasil mengupdate data dokter");
            return redirect(route("admin_dokter"));
        }
        else {
            \Session::flash("messages", "Gagal mengupdate data dokter");
            return back();
        }
    }

    public function destroy(Request $request, $id)
    {
        if(DB::table("dokter")->where("kodeDokter", $id)->delete()) {
            \Session::flash("messages", "Berhasil menghapus data dokter");
            return redirect('/admin/dokter');
        }
    }
}
