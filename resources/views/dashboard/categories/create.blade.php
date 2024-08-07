@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{-- validasi kesalahan --}}
            @if ($errors->any())
            {{-- eror  --}}

            <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row">
            <h3>Tambah Kategori Baru</h3>
        </div>


        <div class="row mt-3">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Nama Kategori</td>
                            <td>
                                {{-- old data lama masih tersimpan di for --}}
                                <input autocomplete="off" value="{{ old('name') }}" class="form-control" type="text"
                                    name="kategori">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button class="btn btn-success" type="submit">Tambah Data</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection
