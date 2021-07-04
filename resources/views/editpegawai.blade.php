@extends('layout.template')
@section('title', 'Ubah Data')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="/updatepegawai/{{$data->id}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama lengkap</label>
                            <input type="text" class="form-control" value={{$data->nama}} id="nama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="jeniskelamin" class="form-label">Jenis kelamin</label>
                            <select class="form-control" name="jeniskelamin" id="jeniskelamin">
                                <option selected>{{$data->jeniskelamin}}</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nohp" class="form-label">No HP</label>
                            <input type="text" class="form-control" value="{{$data->nohp}}" name="nohp" id="nohp">
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection