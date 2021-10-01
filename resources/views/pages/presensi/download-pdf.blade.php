<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php
echo 'Presensi Pegawai ' . date('d-m-Y') . '<br>';
?></title>
</head>

<body>

    <p style="font-size: 30px ; text-align: center">PT. Sugih Teknik
        Perkasa</p>
    <p style="font-size: 10px ; text-align: justify"> Ruko Grand Sipon No. 94D-94E Jl. Irigasi
        Sipon RT.004/002
        Kel.Poris Plawad Utara Kec.Cipondoh kabupaten Kota Tangerang - Banten (15141) Telp: (021) 5549099,
        Fax (021) 55700736<br>Ruko Permata Niaga 15 Taman Royal Jl. Irigasi Sipon, RT.005/RW.002, Tanah Tinggi, Kec.
        Tangerang, Kota Tangerang
        15119 Tangerang Banten (15119) Telp: (021) 55746954 - 70280962 Fax. (021) 55746954 Email sugihteknik@ymail.com
    </p>
    <hr style="border: 1px solid rgb(0, 0, 0);">

    <p style="font-size: 20px ;text-align: center ">Rekap Absensi Pegawai</p>

    <div class="invoice col-12">
        <div class="invoice-print">
            <table border="1" width="100%" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <td class="text-center" align="center">No</td>
                        <td class="text-center" align="center">Id</td>
                        <td class="text-center" align="center">Nama</td>
                        <td class="text-center" align="center">Status</td>
                        <td class="text-center" align="center">Tanggal</td>
                        <td class="text-center" align="center">Masuk</td>
                        <td class="text-center" align="center">Pulang</td>
                        <td class="text-center" align="center">Durasi Kerja</td>
                    </tr>
                    @foreach ($cetakPertanggal as $item)
                        <tr>
                            <td class="text-center" align="center">{{ ++$i }}</td>
                            <td class="text-center" align="center">{{ $item->user_id }}</td>
                            <td class="text-center" align="center">{{ $item->user->nama }}</td>
                            <td class="text-center" align="center">
                                {{ $item->status ? 'Masuk' : '-' }}
                            <td class="text-center" align="center">
                                {{ $item->tgl }}</td>
                            <td class="text-center" align="center"><a>Pukul</a>
                                {{ $item->jammasuk }}</td>
                            <td class="text-center" align="center">
                                {{ $item->jamkeluar }}</td>
                            <td class="text-center" align="center">
                                {{ $item->jamkerja }}<a> menit</a></td>
                        </tr>
                    @endforeach
                </thead>
            </table>
            <p></p>
            <footer class="main-footer">
                <div style="width: 30%; text-align: left; float:right;">
                    <?php
                    echo 'Tangerang ' . date('d-m-Y') . '<br>';
                    ?>
                </div><br><br>
                <div style="width: 35%; text-align: left; float:right;">
                    Yang bertanda tangan dibawah ini,
                </div>
                <br><br><br><br><br>
                <div style="width: 26%; text-align: left; float:right;">
                    Kuwat Sugiharto
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
