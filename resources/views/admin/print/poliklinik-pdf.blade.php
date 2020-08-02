<style>
    table {
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    .center {
  margin: auto;
  width: 80%;
  padding: 10px;
}

</style>

<p style="text-align: center"><strong>Laporan Poliklinik</strong></p>
<p style="text-align: center"><strong>Rumah Sakit Muhammadiyah Bandung</strong></p>
<p style="text-align: center">Jl.KH.Ahmad Dahlan No.53 Bandung</p><hr/>

<div class="center">
    <table>
        <thead>
            <tr>
                <th style="text-align:center; width: 50px">No.</th>
                <th style="text-align:center; width: 100px">Poliklinik</th>
                <th style="text-align:center; width: 150px">Nama Dokter</th>
                <th style="text-align:center; width: 150px">Nama Pasien</th>
                <th style="text-align:center; width: 120px">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @isset($data)
            @foreach ($data as $index=>$a)
            <tr>
                <td style="text-align:center">{{$index+1}}</td>
                <td style="text-align:center">{{$a->namaPoli}}</td>
                <td style="text-align:center">dr. {{$a->namaDokter}}</td>
                <td style="text-align:center">{{$a->nama}}</td>
                <td style="text-align:center">{{Carbon::parse($a->tanggalKunjungan)->format("d M Y")}}</td>
            </tr>
            @endforeach
            @endisset
        </tbody>
    </table>
</div>
<script>
        window.print();
    </script>