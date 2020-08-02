@extends("layouts.admin_app")
@section("title")
Tambah Data Dokter
@endsection
@section("content")
<div class="container" style="width: 700px">
	<div class="card">
		<div class="card-body">
			<h4 style="text-align:center">Tambah Data Dokter</h4>
			<br/>
			<form action="{{ route('store.dokter') }}" method="POST">
				@csrf
				<div class="form-group">
					<label for="exampleInputEmail1">Kode Dokter <span class="text-danger">*</span></label>
					@if($errors->has("kodeDokter"))
					<input type="text" class="form-control is-invalid" value="{{ old('kodeDokter') }}" id="exampleInputEmail1" name="kodeDokter">
					<small class="text-danger">{{ $errors->first("kodeDokter") }}</small>
					@else 
					<input type="text" class="form-control" value="{{ old('kodeDokter') }}" id="exampleInputEmail1" name="kodeDokter">
					@endif
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Nama Dokter <span class="text-danger">*</span></label>
					@if($errors->has("namaDokter"))
					<input type="text" class="form-control is-invalid" id="exampleInputPassword1" value="{{ old('namaDokter') }}" name="namaDokter">
					<small class="text-danger">{{ $errors->first("namaDokter") }}</small>
					@else
					<input type="text" class="form-control" id="exampleInputPassword1" value="{{ old('namaDokter') }}" name="namaDokter">
					@endif
				</div>
				
				<div class="row">
					<div class="form-group  col-sm-6" style="width: 250px">
						<label for="exampleFormControlSelect1">Poliklinik <span class="text-danger">*</span></label>
						<select class="form-control" id="exampleFormControlSelect1" name="poli">
							@foreach($poliList as $poli)
							<option value="{{ $poli->noPoli }}">{{ $poli->namaPoli }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group  col-sm-6" style="width: 250px">
						<label for="exampleFormControlSelect1">Status <span class="text-danger">*</span></label>
						<select class="form-control" id="exampleFormControlSelect1" name="status">
							<option value="Tetap">Tetap</option>
							<option value="Tidak Tetap">Tidak Tetap</option>
						</select>
					</div>
				</div>
				<button type="submit" class="btn btn-primary float-right" id="no_shadow">Simpan</button>
				<a href="{{ URL::previous() }}" class="btn btn-danger float-right" id="no_shadow" style="margin-right: 10px">Batal</a>
			</form>
		</div>
	</div>
</div>
@endsection