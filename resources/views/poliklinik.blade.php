@extends("layouts.app")

@section("title")
Daftar Poliklinik
@endsection

@section("content")
<div class="container" style="width: 800px">
    <div class="card">
        <div class="card-body">
            <h2 style="text-align:center; margin:20px">Daftar Poliklinik</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Poliklinik</th>
                        <th>Nama Dokter</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listPoli as $index => $poli)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $poli->namaPoli }}</td>
                        <td>{{ $poli->namaDokter }}</td>
                        <td>{{ $poli->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm justify-content-center">
                    {{ $listPoli->links() }}
                </ul>
            </nav>

            <p>Jumlah Data: {{ $countPoli }}</p>
        </div>
    </div>
</div>
</div>
@endsection
