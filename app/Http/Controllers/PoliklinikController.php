<?php

namespace App\Http\Controllers;

use DB;
use App\Poliklinik;
use Validator;

use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $listPoli = DB::table("poliklinik")
                    ->leftJoin("dokter", "dokter.poli", '=', "poliklinik.noPoli")
                    ->orderBy("poliklinik.noPoli", "ASC")
                    ->select()
                    ->paginate(25);
        $countPoli = DB::table("poliklinik")->count();
        $countDokter = DB::table("dokter")->count();

        return view("admin.poliklinik")->with(compact("listPoli", "countPoli", "countDokter"));
    }

    public function addPoli()
    {
        return view("admin.poli.add");
    }

    public function storePoli(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "noPoli" => "required|unique:poliklinik",
            "namaPoli" => "required"
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $poli = new Poliklinik();
        $poli->noPoli = htmlspecialchars($request->get("noPoli"));
        $poli->namaPoli = htmlspecialchars($request->get("namaPoli"));

        if ($poli->save()) {
            \Session::flash("messages", "Berhasil menambahkan data poliklinik");
            return redirect(route("admin_poli"));
        }
        else {
            \Session::flash("messages", "Gagal menambahkan data poliklinik");
            return back();
        }
    }

    public function getPoli($id)
    {
        $poli = DB::table("poliklinik")->where("noPoli", $id)->get();
        return view("admin.poli.edit")->with(compact("poli"));
    }

    public function updatePoli(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "namaPoli" => "required"
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $poli = DB::table("poliklinik")
                ->where("noPoli", $id)
                ->update([
                    "namaPoli" => $request->get("namaPoli")
                ]);

        if($poli) {
            \Session::flash("messages", "Berhasil mengupdate data poliklinik");
            return redirect(route("admin_poli"));
        }
        else {
            \Session::flash("messages", "Gagal mengupdate data poliklinik");
            return back();
        }
    }

    public function destroy(Request $request, $id)
    {
        if (DB::table("poliklinik")->where("noPoli", $id)->delete()) {
            \Session::flash("messages", "Berhasil menghapus poliklinik");
            return redirect('/admin/poliklinik');
        }
    }
}
