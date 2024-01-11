@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <h1 class="text-primary">Form Pinjam Buku</h1>
@endsection
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').select2();
        });
    </script>
@endpush
@section('content')
    <div class="card">

        <div class="card-body">

            <form action="/peminjaman" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama" class="text-primary font-weight-bold">Nama Peminjam</label>
                    @if (Auth::user()->isAdmin == 1)
                        <select name="users_id" id="" class="form-control">
                            <option value=""></option>
                            @forelse ($peminjam as $item)
                                <option value="{{ $item->id }}">{{ $item->user->name }} ( {{ $item->npm }} )</option>
                            @empty
                                tidak ada user
                            @endforelse
                        </select>
                    @endif

                    @if (Auth::user()->isAdmin == 0)
                        <select name="users_id" id="" class="form-control">
                            <option value="{{ $peminjam->users_id }}">{{ $peminjam->user->name }} ( {{ $peminjam->npm }} )
                            </option>
                        </select>
                    @endif

                    @error('users_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>


                <div class="fom-group">
                    <label for="buku" class="text-primary font-weight-bold">Buku yang akan dipinjam</label>
                    <select name="buku_id" id="" class="form-control">
                        <option value=""></option>
                        @forelse ($buku as $item)
                            <option value="{{ $item->id }}">{{ $item->judul }} ( {{ $item->kode_buku }} ) -
                                {{ $item->status }}</option>
                        @empty
                            tidak ada buku yang tersedia
                        @endforelse
                    </select>
                </div>

                @error('buku_id')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-end mt-5">
                    <a href="/peminjaman" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary mx-1 px-4">Submit</button>
                </div>


            </form>

        </div>
    </div>
@endsection
