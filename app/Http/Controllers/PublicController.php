<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Pasien;
use App\Antrian;
use \Carbon;

class PublicController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function profile() {
        return view('profile');
    }

    public function poliklinik() {
        $listPoli = DB::table("dokter")
                    ->join("poliklinik", "dokter.poli", '=', "poliklinik.noPoli")
                    ->orderBy("poliklinik.noPoli", "ASC")
                    ->select()
                    ->paginate(25);
        $countPoli = DB::table("dokter")->count();
        return view('poliklinik')->with(compact("listPoli", "countPoli"));
    }

    public function jadwal() {
        $listJadwal = DB::table("jadwal")
                    ->select(DB::raw("jadwal.id, poliklinik.namaPoli as poli, dokter.namaDokter as dokter, jadwal.jam as jam, jadwal.hari hari"))
                    ->join("dokter", "dokter.kodeDokter", '=', "jadwal.dokter")
                    ->join("poliklinik", "dokter.poli", '=', "poliklinik.noPoli")
                    ->paginate(25);

        $countJadwal = DB::table("jadwal")->count();

        return view('jadwal')->with(compact("listJadwal", 'countJadwal'));
    }

    public function antrian() {
        $antrian = DB::table("antrian")
                ->leftJoin("poliklinik", "poliklinik.noPoli", '=', "antrian.poli")
                ->leftJoin("dokter", "dokter.kodeDokter", '=', "antrian.dokter")
                ->leftJoin("pasien", "pasien.medrec", '=', "antrian.medrec")
                ->paginate(25);
        return view('antrian')->with(compact("antrian"));
    }

    public function registerAntrian() {
        $listDokter = DB::table("dokter")->get();
        $listPoli = DB::table("poliklinik")->get();
        return view('form_antrian')->with(compact("listDokter", "listPoli"));
    }

    public function storeAntrian(Request $request) {
        $lastAntrian = DB::table("antrian")
                    ->select()
                    ->orderBy("id", "DESC")
                    ->limit(1)
                    ->get();

        $data = explode('-', $lastAntrian[0]->noAntri);

        $validator = Validator::make($request->all(), [
            "noKartu" => "required",
            "namaPasien" => "required",
            "alamat" => "required",
            "tempatLahir" => "required",
            "tglLahir" => "required",
            "noTelp" => "required",
            "jKelamin" => "required",
            "poli" => "required",
            "dokter" => "required",
            "penjamin" => "required",
            "tglBerobat" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //echo Carbon::parse($lastAntrian[0]->created_at)->format("Y-m-d");

        // $antrian = new Antrian();

        if($this->isExist($request->noKartu)) {
            $antrian = new Antrian();
            $antrian->medrec = $request->noKartu;
            
            if(Carbon::parse($lastAntrian[0]->created_at)->format("Y-m-d") != Carbon::now()->format("Y-m-d")) {
                $data[1] = 1;
                echo "BL-".str_pad($data[1], 3, '0', STR_PAD_LEFT);
            }
            else {
                $data[1] += 1;
                echo "BL-".str_pad($data[1], 3, '0', STR_PAD_LEFT);
            }

            $antrian->noAntri = "BL-".str_pad($data[1], 3, '0', STR_PAD_LEFT);
            $antrian->poli = $request->poli;
            $antrian->dokter = $request->dokter;
            $antrian->penjamin = $request->penjamin;
            $antrian->tanggalKunjungan = Carbon::parse($request->tglBerobat)->format("Y-m-d");

            if ($antrian->save()) {
                \Session::flash("messages", "Berhasil menambahkan data antrian");
                return redirect(route("antrian"));
            }
            else {
                \Session::flash("messages", "Gagal menambahkan data antrian");
                return back();
            }   
        }
        else {
            $pasien = new Pasien();
            $pasien->medrec = $request->noKartu;
            $pasien->nama = $request->namaPasien;
            $pasien->tempatLahir = $request->tempatLahir;
            $pasien->tanggalLahir = $request->tglLahir;
            $pasien->alamat = $request->alamat;
            $pasien->telepon = $request->noTelp;
            $pasien->jenisKelamin = $request->jKelamin;

            if($pasien->save()) {
                $antrian = new Antrian();
                $antrian->medrec = $request->noKartu;
                
                if(Carbon::parse($lastAntrian[0]->created_at)->format("Y-m-d") != Carbon::now()->format("Y-m-d")) {
                    $data[1] = 1;
                    echo "BL-".str_pad($data[1], 3, '0', STR_PAD_LEFT);
                }
                else {
                    $data[1] += 1;
                    echo "BL-".str_pad($data[1], 3, '0', STR_PAD_LEFT);
                }

                $antrian->noAntri = "BL-".str_pad($data[1], 3, '0', STR_PAD_LEFT);
                $antrian->poli = $request->poli;
                $antrian->dokter = $request->dokter;
                $antrian->penjamin = $request->penjamin;
                $antrian->tanggalKunjungan = Carbon::parse($request->tglBerobat)->format("Y-m-d");

                if ($antrian->save()) {
                    \Session::flash("messages", "Berhasil menambahkan data antrian");
                    return redirect(route("antrian"));
                }
                else {
                    \Session::flash("messages", "Gagal menambahkan data antrian");
                    return back();
                }
            } 
            else {
                \Session::flash("messages", "Gagal menambahkan data antrian");
                return back();
            }   
        }
    }

    public function isExist($id) {
        $rm = DB::table("pasien")
            ->where("medrec", $id)
            ->count();

        if($rm > 0) {
            return true;
        }

        return false;
    }
}
