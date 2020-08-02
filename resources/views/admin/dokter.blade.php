@extends("layouts.admin_app")

@section("title")
Selamat Datang
@endsection

@section("content")

@if(\Session::has("messages"))
<div class="alert alert-success alert-dismissible">
    {!! \Session::get('messages') !!}
</div>
@endif

<div class="card">
    <div class="card-body">
        <!-- <div class="d-flex">
            <div class="col-8">
                <a href="{{ route('new.dokter') }}" class="btn btn-outline-primary" id="no_shadow"><span class="fa fa-plus"></span> Tambah Dokter</a>
            </div>
            <div class="col-4">
                <div class="justify-content-right">
                    <a href="{{ route('new.dokter') }}" class="btn btn-outline-primary float-right" id="no_shadow"><span class="fa fa-plus"></span> Tambah Dokter</a>
                </div>
            </div>
        </div> -->

        <div class="d-flex">
            <a href="{{ route('new.dokter') }}" class="btn btn-outline-primary ml-auto p2" id="no_shadow"><span class="fa fa-plus"></span> Tambah Dokter</a>
        </div>

        <div>
            <h3 style="text-align: center;">Daftar Dokter</h3>
        </div>
        <br />

        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No. </th>
                        <th scope="col">Kode Dokter</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">Poliklinik</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listDokter as $index => $dokter)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $dokter->kodeDokter }}</td>
                        <td>{{ $dokter->namaDokter }}</td>
                        <td>{{ $dokter->namaPoli == null || $dokter->namaPoli == "" ? "-" : $dokter->namaPoli }}</td>
                        <td>{{ $dokter->status }}</td>
                        <td style="text-align:center">
                            <div>
                                <a href="{{ route('edit.dokter', $dokter->kodeDokter) }}" class="btn btn-outline-success btn-sm" id="no_shadow"><span class="fa fa-pencil"></span> Edit</a>
                                <a href="{{ route('delete.dokter', $dokter->kodeDokter) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="btn btn-outline-danger btn-sm" id="no_shadow"><span class="fa fa-trash"></span> Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm justify-content-center">
                    {{ $listDokter->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
