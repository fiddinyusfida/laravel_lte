<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Toastr CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>CRUD</title>
</head>

<body style="margin-top:3rem">
    <div class="container">
        <h4 class="mb-4">Data Pegawai</h4>
        <div class="row">
            <div class="col">
                <a href="/tambahpegawai" class="btn btn-outline-primary btn-sm">Tambah data</a>
                <a href="/exportpdf" class="btn btn-outline-secondary btn-sm">Export to PDF</a>
                <a href="/exportexcel" class="btn btn-outline-secondary btn-sm">Export to Excel</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import data from Excel
                </button>

            </div>
            <div class="col-md-3">
                <form action="/pegawai" method="GET">
                    <input type="search" id="search" class="form-control" name="search" autocomplete="off" placeholder="Cari data...">
                </form>
            </div>
        </div>

        <div class="row mt-2">
            <!-- @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif -->
            <div class="col">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">No HP</th>
                            <th scope="col">Tanggal Daftar</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach ($data as $index => $row)
                        <tr>
                            <th scope="row">{{$index + $data -> firstitem()}}</th>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->jeniskelamin}}</td>
                            <td>{{$row->nohp}}</td>
                            <td>{{$row->created_at->format('D, d M Y')}}</td>
                            <td>
                                <img src="{{asset('fotopegawai/'.$row->foto)}}" style="width:50px">
                            </td>
                            <td>
                                <a href="/editpegawai/{{$row->id}}" class="btn btn-outline-success btn-sm">ubah</a>
                                <!-- <a href="/deletepegawai/{{$row->id}}" class="btn btn-outline-danger btn-sm">hapus</a> -->
                                <a href="#" class="btn btn-outline-danger btn-sm delete" data-id="{{$row->id}}" data-nama="{{$row->nama}}">hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$data->links()}}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Browse Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/importexcel" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="file" id="excel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- JQuery  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Toast JS  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom Script for Sweet alert -->
    <script>
        $('.delete').click(function() {
            var pegawaiid = $(this).attr('data-id')
            var pegawainama = $(this).attr('data-nama')

            swal({
                    title: "Yakin?",
                    text: "Apakah anda yakin akan menghapus data dengan nama= " + pegawainama + " ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/deletepegawai/" + pegawaiid + ""
                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });
                    } else {
                        swal("Data tidak jadi dihapus");
                    }
                });
        });
    </script>

    <!-- Custom script for Toastr  -->
    <script>
        @if(Session::has('success'))
        toastr.success("{{ Session::get('success')}}")
        @endif
    </script>


</body>

</html>