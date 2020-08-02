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
        <div class="d-flex">
            <a href="{{ route('new.poli') }}" class="btn btn-outline-primary ml-auto p-2" id="no_shadow"><span class="fa fa-plus"></span> Tambah Poli</a>
        </div>

        <div>
            <h3 style="text-align: center;">Daftar Poliklinik</h3>
        </div>
        <br />

        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Kode Poli</th>
                        <th scope="col">Poliklinik</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col" style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listPoli as $index=>$poli)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $poli->noPoli }}</td>
                        <td>{{ $poli->namaPoli }}</td>
                        <td>{{ $poli->namaDokter == "" ? "-" : $poli->namaDokter }}</td>
                        <td style="text-align:center">
                            <div>
                                <a href="{{ route('edit.poli', $poli->noPoli) }}" class="btn btn-outline-success btn-sm" id="no_shadow"><span class="fa fa-pencil"></span> Edit</a>
                                <a href="{{ route('delete.poli', $poli->noPoli) }}" class="btn btn-outline-danger btn-sm" id="no_shadow" onclick="return confirm('Apakah anda yakin ingin menghapus data?')"><span class="fa fa-trash"></span> Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm justify-content-center">
                    {{ $listPoli->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>

<script type="text/javascript">
$(".alert").alert('close');
</script>
@endsection
