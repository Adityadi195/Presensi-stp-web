@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Hadir</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4> </h4>
                            <div class="card-header-action">
                                <form method="GET" action="{{ url('cari') }}">
                                    <div class="input-group" id="searchable">
                                        <input name="keyword" type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
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
                                        @foreach ($presensi as $item)
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
                                        @endforeach
                                    </thead>
                                </table>
                                {{-- {{ $presensi->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
