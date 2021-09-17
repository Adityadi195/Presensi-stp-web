@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Data Pegawai</h1>
            </div>
            <div class="row">
                <section class="col-12">
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
                        <div class="btn-group mb-4" role="group" aria-label="Basic example">
                            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                    </div>
                    <div class="card">

                        <!-- Attendance Chart -->

                        <div class="card-body ml-5 mt-3">
                            <form action="{{ route('user.update', $user->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">
                                        <h5>Nama</h5>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama"
                                            class="form-control  @error('nama') is-invalid @enderror"
                                            value="{{ old('nama', $user->nama) }}">
                                        <div class="text-danger mr-1 mt-1">@error('nama')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">
                                        <h5>Alamat</h5>
                                    </label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text" name="alamat"
                                            class="form-control  @error('alamat') is-invalid @enderror" data-height="80"
                                            value="{{ old('alamat', $user->alamat) }}">
                                        <div class="text-danger mr-1 mt-1">@error('alamat')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label for="" class="col-sm-2 col-form-label">
                                        <h5>E-Mail</h5>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email"
                                            class="form-control  @error('email') is-invalid @enderror"
                                            value="{{ old('email', $user->email) }}">
                                        <div class="text-danger mr-1 mt-1">@error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">
                                        <h5>Password</h5>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password"
                                            class="form-control  @error('password') is-invalid @enderror"
                                            id="inputPassword3">
                                        <div class="text-danger mr-1 mt-1">@error('password')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">
                                        <h5>No. Telpon</h5>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="telepon"
                                            class="form-control  @error('telepon') is-invalid @enderror"
                                            value="{{ old('telepon', $user->telepon) }}">
                                        <div class="text-danger mr-1 mt-1">@error('telepon')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- {{ $errors->has('level') ? 'has-error' : null }} --}}
                                <div class="form-group row mb-4 ">
                                    <label class="col-sm-2 col-form-label" for="">
                                        <h5>Jabatan</h5>
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="level" class="form-control  @error('level') is-invalid @enderror"
                                            value="{{ old('level', $user->level) }}">
                                            <option value="" hidden selected>--Pilih Jabatan--</option>
                                            <option value="direktur">Direktur</option>
                                            <option value="admin">Admin</option>
                                            <option value="pegawai">Pegawai</option>
                                        </select>
                                        <div class="text-danger mr-1 mt-1">@error('level')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">
                                        <h5>Foto</h5>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image">
                                        @if ($user->photo)
                                            <img src="{{ asset('/storage/profile/' . $user->foto) }}" alt=""
                                                height="100">
                                        @endif
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer ml-5">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Simpan</button>
                        </div>

                    </div>
                </section>
            </div>
    </div>
    <!-- General JS Scripts -->
@endsection
