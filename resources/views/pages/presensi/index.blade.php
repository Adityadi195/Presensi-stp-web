@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Hadir</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card col-12">
                        <div class="card-header">
                            <div class="form-group ">
                                <a>Dari</a>
                                <input type="date" name="fromdate" id="fromdate" class="form-control">
                            </div>
                            <h4></h4>
                            <div class="form-group">
                                <a>Sampai</a>
                                <input type="date" name="todate" id="todate" class="form-control">
                            </div>
                            <h4></h4>
                            <div class="form-group mt-4">
                                <a href=""
                                    onclick="this.href='/cetak-presensi-pertanggal/'+document.getElementById('fromdate').value + '/' + document.getElementById('todate').value"
                                    target="_blank" class="btn btn-success btn-lg btn-block"><i class="fas fa-print"></i>
                                    Print</a>
                            </div>
                            <h4> </h4>
                            {{-- <div class="card-header-action">
                                <form method="GET" action="{{ url('/search') }}">
                                    <div class="input-group" id="searchable">
                                        <input name="keyword" type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Id</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Jabatan</th>
                                            {{-- <th class="text-center">Status</th> --}}
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Masuk</th>
                                            <th class="text-center">Pulang</th>
                                            <th class="text-center">Durasi Kerja</th>
                                            <th></th>
                                        </tr>
                                        @foreach ($presensi as $presensis => $item)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td class="text-center">{{ $item->user_id }}</td>
                                                <td class="text-center">{{ $item->user->nama }}</td>
                                                <td class="text-center">{{ $item->user->level }}</td>
                                                {{-- <td class="text-center">
                                                    {{ $item->status ? 'Masuk' : '-' }}
                                                </td> --}}
                                                <td class="text-center">
                                                    {{ $item->tgl }}</td>
                                                <td class="text-center"><a>Pukul</a>
                                                    {{ $item->jammasuk }}</td>
                                                <td class="text-center">
                                                    {{ $item->jamkeluar }}</td>
                                                <td class="text-center">
                                                    {{ $item->jamkerja }}<a> menit</a></td>
                                                <td class="text-center">
                                                    <a href="{{ Route('presensi.show', $item->id) }}"
                                                        class="btn btn-icon icon-left btn-info">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </thead>
                                </table>
                                {{ $presensi->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
