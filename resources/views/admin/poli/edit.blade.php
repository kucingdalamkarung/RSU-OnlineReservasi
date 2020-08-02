@extends("layouts.admin_app")

@section("title")
Edit Data Poliklinik
@endsection

@section("content")
<div class="container" style="width: 600px">
    <div class="card">
        <div class="card-body">
            <h4 style="text-align:center">Tambah Data Poliklinik</h4>
            <br />

            @foreach($poli as $p)
            <form action="{{ route('update.poli', $p->noPoli) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Kode Poliklinik <span class="text-danger">*</span></label>
                    @if($errors->has("noPoli"))
                    <input type="text" class="form-control is-invalid" id="noPoli" value="{{ old('noPoli') }}" name="noPoli" placeholder="" disabled>
                    <small class="text-danger">{{ $errors->first("noPoli") }}</small>
                    @else
                    <input type="text" class="form-control" id="noPoli" value="{{ $p->noPoli }}" name="noPoli" placeholder="" disabled>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Poliklinik <span class="text-danger">*</span></label>
                    @if($errors->has("namaPoli"))
                    <input type="text" class="form-control is-invalid" value="{{ old('namaPoli') }}" id="nPoli" name="namaPoli">
                    <small class="text-danger">{{ $errors->first("namaPoli") }}</small>
                    @else
                    <input type="text" class="form-control" id="nPoli" value="{{ $p->namaPoli }}" name="namaPoli">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary float-right" id="no_shadow">Simpan</button>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection
