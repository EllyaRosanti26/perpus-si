<h3>
    {{-- @dd($peminjaman) --}}
    <center>Laporan Riwayat Peminjaman Buku {{ $bulan ?? '' }} {{ $tahun ?? '' }}
    </center>
</h3>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Wajib Pengembalian</th>
        <th>Tanggal Pengembalian</th>
        <th>Denda</th>
    </tr>
    @foreach ($peminjaman as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->buku->judul }}</td>
            <td>{{ $item->tanggal_pinjam }}</td>
            <td>{{ $item->tanggal_wajib_kembali }}</td>
            <td>{{ $item->tanggal_pengembalian }}</td>
            <td>Rp. {{ number_format($item->denda) }}</td>
        </tr>
    @endforeach
</table>
