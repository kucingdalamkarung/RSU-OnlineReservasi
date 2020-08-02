@extends("layouts.app")

@section("title")
Jadwal Dokter
@endsection

@section("content")
<div class="container" style="width: 800px">
    <div class="card">
        <div class="card-body">
            <h2 style="text-align:center; margin:20px">Jadwal Dokter Poliklinik</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Poliklinik</th>
                        <th>Nama Dokter</th>
                        <th>Hari</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($listJadwal as $index => $jadwal)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $jadwal->poli }}</td>
                    <td>{{ $jadwal->dokter }}</td>
                    <td>{{ $jadwal->hari }}</td>
                    <td>{{ $jadwal->jam }}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm justify-content-center">
                  {{ $listJadwal->links() }}
                </ul>
            </nav>

            <p>Jumlah Data: {{ $countJadwal }}</p>
        </div>
    </div>
</div>
</div>
@endsection
