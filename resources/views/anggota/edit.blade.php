@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <h1 class="text-primary">Edit Data Anggota</h1>
@endsection

@section('content')
    <form action="/anggota/{{ $user->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="card pb-5">
            <div class="form-group mx-4 my-2">
                <label for="nama" class="text-md text-primary font-weight-bold mt-2">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            </div>

            @error('name')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror
            {{-- @dd($user) --}}
            <div class="form-group mx-4 my-2">
                <label for="nisn" class="text-md text-primary font-weight-bold">Nomor Induk Siswa Nasional</label>
                <input type="text" id="nisn" class="form-control @error('nisn') is-invalid @enderror" name="nisn"
                    value="{{ old('nisn', $profile->nisn) }}">
            </div>

            @error('nisn')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="no_anggota" class="text-md text-primary font-weight-bold">No Anggota</label>
                <input type="text" id="no_anggota" class="form-control @error('no_anggota') is-invalid @enderror"
                    name="no_anggota" value="{{ old('no_anggota', $profile->no_anggota) }}">
            </div>

            @error('no_anggota')
                <div class="alert-danger mx-2"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="nama" class="text-md text-primary font-weight-bold">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $profile->alamat) }}">
            </div>

            @error('alamat')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="no_telp" class="text-md text-primary font-weight-bold">Nomor Telepon</label>
                <input type="text" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror"
                    name="no_telp" value="{{ old('no_telp', $profile->no_telp) }}">
            </div>
            {{-- @dd($profile) --}}
            @error('no_telp')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="form-group mx-4 my-2">
                <label for="kelas" class="text-md text-primary font-weight-bold">Username</label>
                <input name="username" class="form-control" value="{{ old('username', $user->username) }}">
            </div>
            <div class="form-group mx-4 my-2">
                <label for="kelas" class="text-md text-primary font-weight-bold">Perbarui Password</label>
                <input name="password" class="form-control">
            </div>
            {{-- @dd($profile->photoProfile) --}}
            <div class="col-2">
                <img src="{{ asset('/images/photoProfile/' . $profile->photoProfile) }}"
                    style="width:150px;height:150px;border-radius:100px">
            </div>
            <div class="form-group mx-4 my-2">
                <label for="gambar" class="text-md text-primary font-weight-bold">Tambah Photo Profile</label>
                <div class="custom-file">
                    <input type="file" name="photoProfile" value="{{ old('photoProfile', $profile->photoProfile) }}">
                </div>
            </div>

            @error('photoProfile')
                <div class="alert-danger"> {{ $message }}</div>
            @enderror

            <div class="button-save d-flex justify-content-end">
                <a href="/anggota" class="btn btn-danger mt-4 px-3 py-1">Batal</a>
                <button type="submit" class="btn btn-primary mt-4 mx-2 px-4 py-1">Simpan</button>
    </form>
    </div>
    </div>
@endsection
