@extends("layouts.admin_app")

@section("title")
Laporan Dokter
@endsection

@section("content")
<div class="container" style="width:800px">
    <div class="card">
        <div class="card-body">
            <h4 style="text-align:center">Laporan Dokter</h4>
            <hr>
            
            <form action="{{ route('laporan_dokter_cari') }}" class="form-inline" method="GET">
                <div class="float-left" style="margin-right: 20px">
                    <input id="datepicker" style="width: 180px; margin-right: 10px" type="input" class="form-control"
                        name="nama" placeholder="Nama Dokter"/>
                    <button type="submit" class="btn btn-outline-secondary"><span class="fa fa-search"></span>
                        Cari</button>
                </div>
                {{-- <a href="{{ route('laporan_periode') }}" class="btn btn-outline-secondary"><span
                    class="fa fa-search"></span> Cari</a> --}}

                <div class="justify-content-right">
                    <a href="{{ route('export_dokter_excel')."?nama=".Request::get("nama") }}" class="btn btn-outline-secondary" style="margin-right: 3px">Excel</a>
                    <a href="{{ route('export_dokter_pdf')."?nama=".Request::get("nama") }}" class="btn btn-outline-secondary" style="margin-right: 3px">PDF</a>
                    <a href="{{ route('export_dokter_print')."?nama=".Request::get("nama") }}" class="btn btn-outline-secondary" style="margin-right: 3px">Print</a>
                </div><br /><br /><br />
            </form>

            <table class="table table-striped" style="margin-top: 25px">
                <thead>
                    <th style="text-align:center">No.</th>
                    <th style="text-align:center">Dokter</th>
                    <th style="text-align:center">Nama Pasien</th>
                    <th style="text-align:center">Tanggal</th>
                </thead>
                <tbody>
                    @foreach ($data as $index=>$d)
                    <tr>
                        <td style="text-align:center">{{ $index+1 }}</td>
                        <td style="text-align:center">dr. {{ $d->namaDokter }}</td>
                        <td style="text-align:center">{{ $d->nama }}</td>
                        <td style="text-align:center">{{Carbon::parse($d->tanggalKunjungan)->format("d M Y")}}</td>
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
