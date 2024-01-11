@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <h1 class="text-primary">Tambah Anggota</h1>
@endsection

@section('content')
    <form action="/anggota" method="post">
        @csrf

        <div class="card pb-5">
            <div class="form-group mx-4 my-2">
                <label for="nama" class="text-md text-primary font-weight-bold mt-2">Nama Lengkap</label>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}">
            </div>

            @error('name')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="nisn" class="text-md text-primary font-weight-bold">Nomor Induk Siswa Nasional</label>
                <input type="text" id="nisn" class="form-control @error('nisn') is-invalid @enderror" name="nisn"
                    value="{{ old('nisn') }}">
            </div>

            @error('nisn')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="no_anggota" class="text-md text-primary font-weight-bold">No Anggota</label>
                <input type="text" id="no_anggota" class="form-control @error('no_anggota') is-invalid @enderror"
                    name="no_anggota" value="{{ old('no_anggota') }}">
            </div>

            @error('no_anggota')
                <div class="alert-danger mx-2"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="nama" class="text-md text-primary font-weight-bold">Alamat</label>
                <input type="text" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                    name="alamat" value="{{ old('alamat') }}">
            </div>

            @error('alamat')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="no_telp" class="text-md text-primary font-weight-bold">Nomor Telepon</label>
                <input type="text" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror"
                    name="no_telp" value="{{ old('no_telp') }}">
            </div>

            @error('no_telp')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="username" class="text-md text-primary font-weight-bold">username</label>
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                    name="username" value="{{ old('username') }}">
            </div>

            @error('username')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="password" class="text-md text-primary font-weight-bold">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password">
            </div>

            @error('password')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror


            <div class="button-save d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mt-4 mx-4 px-5 py-1">Simpan</button>
    </form>
    </div>
    </div>
@endsection
