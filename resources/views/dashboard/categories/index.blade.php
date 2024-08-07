@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Alert Notifikasi Berhasil/Gagal -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <strong>Sukses!</strong> {{ session('success') }}
                    </div>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <strong>Terjadi Kesalahan!</strong> {{ session('error') }}
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <h3>Ini Halaman Kategori</h3>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Kategori</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Taksnya</th>
                            <th>Dibuat Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration + $datas->firstItem()-1}}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    @foreach($data->tasks as $tasks)
                                    {{$tasks->nama}} <br>
                                    @endforeach
                                </td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    <form method="POST" action="{{ route('categories.destroy', $data->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-success" href="{{ route('categories.edit', $data->id) }}">Edit</a>
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apa anda yakin ingin menghapus data?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-center">
                {{ $datas->links() }} <!-- Pagination links -->
            </div>
        </div>
    </div>
@endsection