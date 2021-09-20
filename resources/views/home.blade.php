@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="main-wrapper">
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Pegawai</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $user }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-circle"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Hadir</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $presensi }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Alpha</h4>
                                    </div>
                                    <div class="card-body">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="far fa-file"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Reports</h4>
                                    </div>
                                    <div class="card-body">
                                        1,201
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">User</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Masuk</th>
                                        <th class="text-center">Pulang</th>
                                        <th></th>
                                    </tr>
                                    {{-- @foreach ($presensi as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->id }}</td>
                                            <td class="text-center">{{ $item->user->nama }}</td>
                                            <td class="text-center">
                                                {{ $item->status ? 'Masuk' : '-' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                                            <td class="text-center">
                                                {{ $item->updated_at->format('d-m-Y H:i:s') }}</td>
                                            <td class="text-center">
                                                <a href="{{ Route('presensi.show', $item->id) }}"
                                                    class="btn btn-icon icon-left btn-info"><i
                                                        class="far fa-user"></i>Tampil</a>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </thead>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
