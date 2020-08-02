@extends("layouts.app")

@section("title")
Daftar Antrian
@endsection

@section("content")
<div class="container" style="width: 850px">
    @if(\Session::has("messages"))
    <div class="alert alert-success alert-dismissible">
        {!! \Session::get('messages') !!}
    </div>
    @endif
    <div class="card">
        <div class="card-body">
        <div class="d-flex">
            <a href="{{ route('daftarAntri') }}" class="btn btn-outline-primary ml-auto p2" id="no_shadow"><span class="fa fa-plus"></span> Daftar Antrian Baru</a>
        </div>
        <br/>
        <h4 style="text-align:center">Daftar Antrian Pasien</h4>
        <br/>
        <table id="dtOrderExample" class="table table-striped">
          <thead>
            <tr>
              <th class="th-sm" scope="col">No. Antrian</th>
              <th class="th-sm" scope="col">Tanggal</th>
              <th class="th-sm" scope="col">Nama Pasien</th>
              <th class="th-sm" scope="col">Poliklinik</th>
              <th class="th-sm" scope="col">Nama Dokter</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($antrian as $index=>$a)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{Carbon::parse($a->tanggalKunjungan)->format("d M Y")}}</td>
                  <td>{{$a->nama}}</td>
                  <td>{{$a->namaPoli}}</td>
                  <td>dr. {{$a->namaDokter}}</td>
                </tr>
            @endforeach
          </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm justify-content-center">
                {{ $antrian->links() }}
            </ul>
        </nav>
        </div>
    </div>

    <script>
    </script>
</div>

<script>
$(document).ready(function () {
$('#dtOrderExample').DataTable({
"order": [[ 3, "desc" ]]
});
$('.dataTables_length').addClass('bs-select');
});
</script>
@endsection
