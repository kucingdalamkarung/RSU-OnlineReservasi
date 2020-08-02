@extends("layouts.admin_app")

@section("title")
Tambah Jadwal Dokter
@endsection

@section("content")
<div class="container" style="width: 650px">
    <div class="card">
        <div class="card-body">
            <h4 style="text-align: center">Tambah Jadwal</h4>
            <br/>

            <form action="{{ route('store.jadwal') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputPassword1">Dokter</label>
                    <select class="form-control" name="dokter">
                    @foreach ($listDokter as $dokter)
                        <option value="{{ $dokter->kodeDokter }}">dr. {{$dokter->namaDokter}}</option>
                    @endforeach
                    </select>
                </div>

                <div class="row">
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">Hari Prakter</label>
                            @if($errors->has("hari"))
                                <input type="text" class="form-control is-invalid" id="hari" name="hari">
                                <small class="text-danger">{{ $errors->first("hari") }}</small>
                            @else 
                                <input type="text" class="form-control" id="hari" name="hari">
                            @endif
                        </div>
    
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">Jam Prakter</label>
                            @if($errors->has("jam"))
                                <input type="text" class="form-control is-invalid" id="jam" name="jam">
                                <small class="text-danger">{{ $errors->first("jam") }}</small>
                            @else 
                            <input type="text" class="form-control" id="jam" name="jam">
                            @endif
                        </div>
                </div>
                <button type="submit" class="btn btn-primary float-right" id="no_shadow">Simpan</button>
                <a href="{{ URL::previous() }}" class="btn btn-danger float-right" style="margin-right: 10px" id="no_shadow">Batal</a>
            </form>
        </div>
    </div>  
</div>
@endsection
