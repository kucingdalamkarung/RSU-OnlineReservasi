<table border="1">
    <thead>
        <tr>
            <th colspan="6" style="text-align:center"><strong>Laporan Penjamin</strong></th>
        </tr>
        <tr>
            <th colspan="6" style="text-align:center"><strong>Rumah Sakit Muhammadiyah Bandung</strong></th>
        </tr>
        <tr>
            <th colspan="6" style="text-align:center">Jl.KH.Ahmad Dahlan No.53 Bandung</th>
        </tr>
        <tr>
                <th colspan="6" style="text-align:center"></th>
            </tr>
        <tr>
            <th style="text-align:center; width: 7px">No.</th>
            <th style="text-align:center; width: 20px">Penjamin</th>
            <th style="text-align:center; width: 30px">Nama Pasien</th>
            <th style="text-align:center; width: 30px">Nama Dokter</th>
            <th style="text-align:center; width: 20px">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @isset($data)
        @foreach ($data as $index=>$a)
        <tr>
            <td style="text-align:center">{{$index+1}}</td>
            <td style="text-align:center">{{$a->penjamin}}</td>
            <td style="text-align:center">{{$a->nama}}</td>
            <td style="text-align:center">dr. {{$a->namaDokter}}</td>
            <td style="text-align:center">{{Carbon::parse($a->tanggalKunjungan)->format("d M Y")}}</td>
        </tr>
        @endforeach
        @endisset
    </tbody>
</table>
