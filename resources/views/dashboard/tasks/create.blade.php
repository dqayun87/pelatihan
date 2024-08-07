@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
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
            <h3>Tambah Tasks Baru</h3>
        </div>

        <div class="row mt-3">
            <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                {{-- entype form data untuk menampilkan data --}}
                @csrf
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Nama Task</td>
                            <td>
                                <input autocomplete="off" value="{{ old('nama') }}" class="form-control" type="text"
                                    name="nama">
                            </td>
                        </tr>
                        <tr>
                            <td>Deskripsi Task</td>
                            <td>
                                <input autocomplete="off" value="{{ old('description') }}" class="form-control" type="text"
                                    name="description">
                            </td>
                        </tr>
                        <tr>
                            <td>kategory Taks</td>
                            <td>
                                <select name="category_id" class="form-control">
                                    <option value="">---pilih---</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" 
                                        {{($category->id==old('category_id')) ? 'selected':''}}>{{$category->name}}</option>
                                    @endforeach
                                    {{-- pengambilan data dari tabel category --}}
                                </select>
                                
                            </td>
                        </tr>
                        <tr>
                            
                            <td>image taks</td>
                            <td>
                                <input class="form-control" type="file" name="image"

                            </td>
                            <tr>
                                <td>
                                    <button class="btn btn-success" type="submit">Tambah Data</button>
                                </td>

                            </tr>
                            
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection
