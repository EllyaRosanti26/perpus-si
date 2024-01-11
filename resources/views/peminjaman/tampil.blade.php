@extends('layouts.master')

@section('sidebar')
@include('part.sidebar')
@endsection

@section('topbar')
@include('part.topbar')
@endsection

@section('judul')
<h1 class="text-primary">Daftar Riwayat Peminjaman</h1>
@endsection


@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/date-1.1.2/fc-4.1.0/r-2.3.0/sc-2.0.7/datatables.min.css" />
@endpush


@push('scripts')
<script src="{{ '/template/vendor/datatables/jquery.dataTables.min.js' }}"></script>
<script src="{{ '/template/vendor/datatables/dataTables.bootstrap4.min.js' }}"></script>


<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable(); // ID From dataTable
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover

    });
</script>
@endpush

@section('content')
@if (Auth::user()->isAdmin == 1)
<div class="container">
    <a href="/peminjaman/create" class="btn btn-info mb-3 "><i class="fa-solid fa-plus"></i> tambah</a>
    <a href="/cetaklaporan" class="btn btn-info mb-3 mx-2"><i class="fa-solid fa-print"></i> Cetak seluruh</a>
    <a href="/cetaklaporan?bulanIni=true" class="btn btn-info mb-3 mx-2"><i class="fa-solid fa-print"></i> Cetak
        bulan
        ini</a>

</div>
<div class="col-lg-auto">
    <div class="card mb-4">
        <div class="table-responsive p-3">
            <table class="table align-items-center justify-content-center table-flush table-hover" id="dataTableHover" style="font-size: .7rem">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Wajib Pengembalian</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        {{-- <th scope="col">Status</th> --}}
                        <th scope="col">denda</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($peminjam as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->buku->judul }}</td>
                        <td>{{ $item->buku->kode_buku }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_wajib_kembali)->translatedFormat('d M Y') }}
                        </td>

                        @isset($item->tanggal_pengembalian)
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->translatedFormat('d M Y') }}
                        </td>
                        <td>Rp. {{ number_format($item->denda) }}</td>
                        @endisset
                        @empty($item->tanggal_pengembalian)
                        <td></td>
                        <td>Rp. {{ number_format($item->denda()) }}</td>
                        @endempty
                        <td>

                            <form method="POST" action="{{ route('pengembalian') }}">
                                @csrf
                                <input type="hidden" name="buku_id" value="{{ $item->buku->id }}">
                                <input type="hidden" name="users_id" value="{{ $item->user->id }}">
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <button type="submit" class="btn btn-success btn-sm" @if ($item->tanggal_pengembalian != null) disabled @endif>Kembalikan</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@if (Auth::user()->isAdmin == 0)
<div class="col-lg-auto">
    <div class="card mb-4">
        <div class="table-responsive p-3">
            <table class="table align-items-center justify-content-center table-flush table-hover" id="dataTableHover" style="font-size: .7rem">
                <thead class="thead-light">
                    <tr class="">
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Wajib Pengembalian</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pinjamanUser as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->buku->judul }}</td>
                        <td>{{ $item->buku->kode_buku }}</td>
                        <td>{{ $item->tanggal_pinjam }}</td>
                        <td>{{ $item->tanggal_wajib_kembali }}</td>
                        <td>{{ $item->tanggal_pengembalian }}</td>
                        <td>Rp. {{ number_format($item->denda) }}</td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@endsection