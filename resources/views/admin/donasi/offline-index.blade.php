<h2>Daftar Donasi Offline</h2>

<a href="/admin/donasi/offline/create" class="btn btn-success">
    + Donasi Cash
</a>

<table class="table mt-3">
    <tr>
        <th>ID</th>
        <th>Donatur</th>
        <th>Program</th>
        <th>Nominal</th>
        <th>Aksi</th>
    </tr>

    @foreach ($donasiOffline as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->nama_donatur }}</td>
            <td>{{ $d->program->judul ?? '-' }}</td>
            <td>{{ number_format($d->nominal) }}</td>
            <td>
                <a href="{{ route('admin.donasi.offline.show', $d->id) }}" class="btn btn-info">Detail</a>
                <a href="{{ route('admin.donasi.offline.edit', $d->id) }}" class="btn btn-warning">Edit</a>
            </td>
        </tr>
    @endforeach
</table>
