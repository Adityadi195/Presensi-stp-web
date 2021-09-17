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
                <h1>Data Pegawai</h1>
            </div>
            {{-- Button kembali --}}
            <div class="section-body">
                <div class="btn-group mb-4" role="group" aria-label="Basic example">
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                        Kembali</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile</h4>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td><b>Nama</b></td>
                                    <td>{{ $user->nama }}</td>
                                </tr>
                                <tr>
                                    <td><b>Alamat</b></td>
                                    <td class="text-justify" data-height="50">{{ $user->alamat }}</td>
                                </tr>
                                <tr>
                                    <td><b>Email</b></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td><b>Telepon</b></td>
                                    <td>{{ $user->telepon }}</td>
                                </tr>
                                <tr>
                                    <td><b>Jabatan</b></td>
                                    <td>{{ $user->level }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card">
                    </div>
                </div>
                <div class="col-8 col-md-8 col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr class="text-center">
                                        <td><img width="300" src="{{ asset('/storage/profile/' . $user->foto) }}" alt="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
