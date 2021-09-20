@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="section-header">
                <h1>Data Kehadiran Pegawai</h1>
            </div>
            <div class="section-body">
                <div class="btn-group mb-4" role="group" aria-label="Basic example">
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                        Kembali</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                presensi
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">User</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Masuk</th>
                                        <th class="text-center">Pulang</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $presensi->user->nama }}</td>
                                        <td class="text-center">{{ $presensi->status ? 'Pulang' : 'Masuk' }}</td>
                                        <td class="text-center">{{ $presensi->jammasuk }}</td>
                                        <td class="text-center">{{ $presensi->jamkeluar }}</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                    @foreach ($presensi->detail as $detail)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    presensi {{ $detail->type }}
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table" id="datatable">
                                    <tbody>
                                        <tr>
                                            <th>Long, lat</th>
                                            <td>{{ $detail->long }}, {{ $detail->lat }}</td>
                                        </tr>
                                        <tr>
                                            <th>lokasi</th>
                                            <td>{{ $detail->lokasi }}</td>
                                        </tr>
                                        <tr>
                                            <th>Location</th>
                                            <td>
                                                <div style="width: 100%">
                                                    <iframe width="100%" height="300" frameborder="0" scrolling="no"
                                                        marginheight="0" marginwidth="0"
                                                        src="https://maps.google.com/maps?q={{ $detail->long }},{{ $detail->lat }}&hl=en&z=14&amp;output=embed">
                                                    </iframe>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Foto</th>
                                            <td><img width="350" src="{{ asset('/storage/presensi/' . $detail->foto) }}"
                                                    alt="">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    </div>
    </section>
@endsection
