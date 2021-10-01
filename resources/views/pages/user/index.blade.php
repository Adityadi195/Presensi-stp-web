@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pegawai</h1>
            </div>
            @if (session('message'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>x</span>
                        </button>
                        {{ session('message') }}
                    </div>
                </div>
            @endif
            <div class="section-body">

            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="card ">
                        <div class="card-header">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                {{-- Button untuk tambah data pegawai --}}
                                <a href={{ route('user.create') }} class="btn btn-success"><i class="fas fa-plus"></i>
                                    Tambah
                                    Data</a>
                            </div>
                            <h4></h4>
                            <div class="card-header-action">
                                <form action="{{ url('cari') }}" method="GET">
                                    <div class="input-group">
                                        <input name="keyword" type="text" class="form-control" placeholder="Cari">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card col-12">
                            <div class="card-body">
                                <table class="table table-striped " id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        {{-- field database dari inputan tambah data --}}
                                        @foreach ($user as $id => $users)
                                            <tr>
                                                <td class="text-center"> {{ ++$i }}</td>
                                                <td class="text-center">{{ $users->nama }}</td>
                                                <td class="text-center">{{ $users->level }}</td>
                                                <td class="text-center ">

                                                    {{-- Button untuk action data pegawai --}}
                                                    <form action="{{ route('user.destroy', $users->id) }}" method="post">
                                                        @csrf @method('DELETE')
                                                        <a href="{{ Route('user.show', $users->id) }}"
                                                            class="btn btn-icon icon-left btn-info"><i
                                                                class="far fa-user"></i>Tampil</a>
                                                        <a href="{{ Route('user.edit', $users->id) }}"
                                                            class="btn btn-icon icon-left btn-primary"><i
                                                                class="far fa-edit"></i>Ubah</a>
                                                        <a href="#" class="swal-confirm">
                                                            @if ($users)
                                                                <button type="submit"
                                                                    class="btn btn-icon icon-left btn-danger swal-confirm "
                                                                    onclick="return confirm('Are you sure want to delete this data ?')">
                                                                    <i class="fas fa-times"></i>
                                                                    Hapus</button>
                                                            @endif
                                                    </form>
                                                    <a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </thead>
                                </table>
                                {{-- pagination --}}
                                {{ $user->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
