@extends('layout.template')
@section('title', 'Tambah Data Pegawai')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="/insertpegawai" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="jeniskelamin" class="form-label">Jenis kelamin</label>
                                <select class="form-control" name="jeniskelamin" id="jeniskelamin">
                                    <option selected>--Pilih Jenis Kelamin--</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nohp" class="form-label">No HP</label>
                                <input type="text" class="form-control" name="nohp" id="nohp" autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <label for="foto" class="form-label">Upload Foto</label><br>
                                <input type="file" name="foto" id="foto">
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection