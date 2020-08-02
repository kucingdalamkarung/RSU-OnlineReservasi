@extends("layouts.admin_app")

@section("title")
Laporan Poliklinik
@endsection

@section("content")
<div class="container" style="width:800px">
    <div class="card">
        <div class="card-body">
            <h4 style="text-align:center">Laporan Poliklinik</h4>
            <hr>
            
            <form action="{{ route('laporan_poliklinik_cari') }}" class="form-inline" method="GET">
                <div class="float-left" style="margin-right: 20px">
                    <input id="datepicker" style="width: 180px; margin-right: 10px" type="input" class="form-control"
                        name="poli" placeholder="Poliklinik"/>
                    <button type="submit" class="btn btn-outline-secondary"><span class="fa fa-search"></span>
                        Cari</button>
                </div>
                {{-- <a href="{{ route('laporan_periode') }}" class="btn btn-outline-secondary"><span
                    class="fa fa-search"></span> Cari</a> --}}

                <div class="justify-content-right">
                    <a href="{{ route('export_poliklinik_excel')."?poli=".Request::get("poli") }}" class="btn btn-outline-secondary" style="margin-right: 3px">Excel</a>
                    <a href="{{ route('export_poliklinik_pdf')."?poli=".Request::get("poli") }}" class="btn btn-outline-secondary" style="margin-right: 3px">PDF</a>
                    <a href="{{ route('export_poliklinik_print')."?poli=".Request::get("poli") }}" class="btn btn-outline-secondary" style="margin-right: 3px">Print</a>
                </div><br /><br /><br />
            </form>

            <table class="table table-striped" style="margin-top: 25px">
                <thead>
                    <th>No.</th>
                    <th>Poliklinik</th>
                    <th>Dokter</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal</th>
                </thead>
                <tbody>
                    @foreach ($data as $index=>$d)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $d->namaPoli }}</td>
                        <td>{{ $d->namaDokter }}</td>
                        <td>dr. {{ $d->nama }}</td>
                        <td>{{Carbon::parse($d->tanggalKunjungan)->format("d M Y")}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm justify-content-center">
                    {{ $data->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
