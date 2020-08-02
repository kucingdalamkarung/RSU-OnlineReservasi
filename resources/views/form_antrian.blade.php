@extends("layouts.app")

@section("title")
Online Reservasi
@endsection

@section("content")
<div class="container" id="register-div">
    <div class="card">
        <div class="card-header" style="text-align:center;">
            Form Pasien
        </div>
        <div class="card-body">
            <form action="{{ route('store.antrian') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">No. Kartu Berobat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="noKartu" value="{{ old('noKartu') }}" name="noKartu">
                    @if($errors->has("noKartu"))
                        <p class="text-danger">{{ $errors->first("noKartu") }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pasien <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="namaPasien" name="namaPasien" value="{{ old('namaPasien') }}">
                    @if($errors->has("namaPasien"))
                        <p class="text-danger">{{ $errors->first("namaPasien") }}</p>
                    @endif
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="tempatLahir" name="tempatLahir">
                        @if($errors->has("tempatLahir"))
                            <p class="text-danger">{{ $errors->first("tempatLahir") }}</p>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input id="datepicker" type="date" class="form-control" name="tglLahir" />
                        @if($errors->has("tglLahir"))
                            <p class="text-danger">{{ $errors->first("tglLahir") }}</p>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
                    @if($errors->has("alamat"))
                        <p class="text-danger">{{ $errors->first("alamat") }}</p>
                    @endif
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">No. Telepon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="noTelp">
                        @if($errors->has("noTelp"))
                            <p class="text-danger">{{ $errors->first("noTelp") }}</p>
                        @endif
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-control" name="jKelamin">
                            <option>Pria</option>
                            <option>Wanita</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Poliklinik <span class="text-danger">*</span></label>
                        <select class="form-control" name="poli">
                            @foreach ($listPoli as $poli)
                            <option value="{{ $poli->noPoli }}">{{ $poli->namaPoli }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Dokter <span class="text-danger">*</span></label>
                        <select class="form-control" name="dokter">
                            @foreach ($listDokter as $dokter)
                            <option value="{{ $dokter->kodeDokter }}">{{ $dokter->namaDokter }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Penjamin <span class="text-danger">*</span></label>
                        <select class="form-control" name="penjamin">
                            <option value="BPJS">BPJS</option>
                            <option value="Kontraktor">Kontraktor</option>
                            <option value="Umum">Umum</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Tanggal Berobat <span class="text-danger">*</span></label>
                        <input id="datepicker" type="date" class="form-control" name="tglBerobat"/>
                        @if($errors->has("tglBerobat"))
                            <p class="text-danger">{{ $errors->first("tglBerobat") }}</p>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right" id="no_shadow" style="margin: 10px">Simpan</button>
                <a href="{{ URL::previous() }}" class="btn btn-danger float-right" id="no_shadow" style="margin: 10px">Batal</a>
            </form>
        </div>
</div>

<script>
</script>
</div>
@endsection
