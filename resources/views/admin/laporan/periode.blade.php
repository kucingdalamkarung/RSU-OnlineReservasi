@extends("layouts.admin_app")

@section("title")
Laporan Periode
@endsection

@section("content")
<div class="container" style="width:800px">
    <div class="card">
        <div class="card-body">
            <h4 style="text-align:center">Laporan Periode</h4>
            <hr>
            
            <p>Cari data berdasarkan tanggal</p>
            <form action="{{ route('laporan_periode_cari') }}" class="form-inline" method="GET">
                <div class="float-left" style="margin-right: 20px">
                    <input id="datepicker" style="width: 180px; margin-right: 10px" type="date" class="form-control"
                        name="dateFrom" />
                    <input id="datepicker" style="width: 180px; margin-right: 10px" type="date" class="form-control"
                        name="dateTo" />
                    <button type="submit" class="btn btn-outline-secondary"><span class="fa fa-search"></span>
                        Cari</button>
                </div>
                {{-- <a href="{{ route('laporan_periode') }}" class="btn btn-outline-secondary"><span
                    class="fa fa-search"></span> Cari</a> --}}

                <div class="justify-content-right">
                    <a href="{{ route('export_perioder_excel')."?dateFrom=".Request::get("dateFrom")."&dateTo=".Request::get("dateTo") }}" class="btn btn-outline-secondary" style="margin-right: 3px">Excel</a>
                    <a href="{{ route('export_perioder_pdf')."?dateFrom=".Request::get("dateFrom")."&dateTo=".Request::get("dateTo") }}" class="btn btn-outline-secondary" style="margin-right: 3px">PDF</a>
                    <a href="{{ route('export_perioder_print')."?dateFrom=".Request::get("dateFrom")."&dateTo=".Request::get("dateTo") }} " class="btn btn-outline-secondary" style="margin-right: 3px">Print</a>
                </div><br /><br /><br />
            </form>

            <table class="table table-striped" style="margin-top: 25px">
                <thead>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama Pasien</th>
                    <th>Poliklinik</th>
                    <th>Dokter</th>
                    <th>Penjamin</th>
                </thead>
                <tbody>
                    @foreach ($data as $index=>$d)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{Carbon::parse($d->tanggalKunjungan)->format("d M Y")}}</td>
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->namaPoli }}</td>
                        <td>{{ $d->namaDokter }}</td>
                        <td>{{ $d->penjamin }}</td>
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
