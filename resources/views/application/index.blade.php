@extends('layout.master')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>APPLICATION DATA</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/index">MENU</a></li>
                    <li class="breadcrumb-item active">APPLICATION DATA</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Application Data Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Debitur</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">No Telepon / HP</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Klasifikasi Kendaraan</th>
                                    <th scope="col">Model Kendaraan</th>
                                    <th scope="col">Tahun Kendaraan</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($application as $app)
                                <tr>
                                    <td>{{ $app->id }}</td>
                                    <td>{{ $app->nama }}</td>
                                    <td>{{ $app->nik }}</td>
                                    <td>{{ $app->no_telp }}</td>
                                    <td>{{ $app->jenis_kelamin }}</td>
                                    <td>{{ $app->alamat }}</td>
                                    <td>{{ $app->klasifikasi_kendaraan }}</td>
                                    <td>{{ $app->model_kendaraan }}</td>
                                    <td>{{ $app->tahun_kendaraan }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning edit">Edit</a>
                                        <br> </br>
                                        <a href="/application/{{$app->id}}/delete" class="btn btn-danger"
                                            onclick="return confirm('Yakin mau dihapus?')">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Debitur</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">No Telepon / HP</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Klasifikasi Kendaraan</th>
                                    <th scope="col">Model Kendaraan</th>
                                    <th scope="col">Tahun Kendaraan</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<section class="content">
    <!-- left column -->
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Tambah Aplikasi Baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/application/create" method="POST">
                {{csrf_field()}}
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Debitur</label>
                        <input type="text" class="form-control" name="nama" id="nama"
                            placeholder="Masukkan Nama Dengan Benar">
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik"
                            placeholder="Masukkan NIK Dengan Benar">
                    </div>
                    <div class="form-group">
                        <label>No Telepon / HP</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telp"
                            placeholder="Masukkan No Telepon Dengan Benar">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="custom-select" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="0" disabled="true" selected="true">--Masukkan Jenis Kelamin Dengan Benar--
                            </option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat"
                            placeholder="Masukkan Alamat Dengan Benar">
                    </div>
                    <div class="form-group">
                        <label>Klasifikasi Kendaraan</label>
                        <input type="text" class="form-control" name="klasifikasi_kendaraan" id="klasifikasi_kendaraan"
                            placeholder="Masukkan Klasifikasi Kendaraan Dengan Benar">
                    </div>
                    <div class="form-group">
                        <label>Model Kendaraan</label>
                        <input type="text" class="form-control" name="model_kendaraan" id="model_kendaraan"
                            placeholder="Masukkan Model Kendaraan Dengan Benar">
                    </div>
                    <div class="form-group">
                        <label>Tahun Kendaraan</label>
                        <input type="text" class="form-control" name="tahun_kendaraan" id="tahun_kendaraan"
                            placeholder="Masukkan Tahun Kendaraan Dengan Benar">
                    </div>
                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1"
                                required>
                            <label class="custom-control-label" for="exampleCheck1">SAYA SETUJU UNTUK MEMODIFIKASI
                                DATA.</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">

    </div>
</section>

<!-- Modal Edit-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-body bg-3">
                <div class="px-3 to-front">
                    <div class="row align-items-center">
                        <div class="col text-right">
                            <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><span class="icon-close2"></span></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="p-4 to-front">
                    <div class="text-center">
                        <div class="logo">
                            <img src="AdminLTE/dist/img/AdminLTELogo.png" alt="Image" class="img-fluid mb-4">
                        </div>
                        <h3>Edit Data</h3>

                        <form action="" method="POST" id="editForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Nama Debitur</label>
                                <input type="text" class="form-control" name="md_nama" id="md_nama"
                                    placeholder="Masukkan Nama Dengan Benar">
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" class="form-control" name="md_nik" id="md_nik"
                                    placeholder="Masukkan NIK Dengan Benar">
                            </div>
                            <div class="form-group">
                                <label>No Telepon / HP</label>
                                <input type="text" class="form-control" name="md_no_telp" id="md_no_telp"
                                    placeholder="Masukkan No Telepon Dengan Benar">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="custom-select" name="md_jenis_kelamin" id="md_jenis_kelamin">
                                    <option value="0" disabled="true" selected="true">--Masukkan Jenis Kelamin Dengan
                                        Benar--</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="md_alamat" id="md_alamat"
                                    placeholder="Masukkan Alamat Dengan Benar">
                            </div>
                            <div class="form-group">
                                <label>Klasifikasi Kendaraan</label>
                                <input type="text" class="form-control" name="md_klasifikasi_kendaraan"
                                    id="md_klasifikasi_kendaraan"
                                    placeholder="Masukkan Klasifikasi Kendaraan Dengan Benar">
                            </div>
                            <div class="form-group">
                                <label>Model Kendaraan</label>
                                <input type="text" class="form-control" name="md_model_kendaraan" id="md_model_kendaraan"
                                    placeholder="Masukkan Model Kendaraan Dengan Benar">
                            </div>
                            <div class="form-group">
                                <label>Tahun Kendaraan</label>
                                <input type="text" class="form-control" name="md_tahun_kendaraan" id="md_tahun_kendaraan"
                                    placeholder="Masukkan Tahun Kendaraan Dengan Benar">
                            </div>
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="checkEdit" class="custom-control-input" id="checkEdit"
                                        required>
                                    <label class="custom-control-label" for="checkEdit">SAYA SETUJU UNTUK MEMODIFIKASI
                                        DATA.</label>
                                </div>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-primary">Ubah Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        var table = $('#example1').DataTable();
        table.on('click', '.edit', function () {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            console.log(data);
            $('#md_nama').val(data[1]);
            $('#md_nik').val(data[2]);
            $('#md_no_telp').val(data[3]);
            $('#md_jenis_kelamin').val(data[4]);
            $('#md_alamat').val(data[5]);
            $('#md_klasifikasi_kendaraan').val(data[6]);
            $('#md_model_kendaraan').val(data[7]);
            $('#md_tahun_kendaraan').val(data[8]);
            $('#editForm').attr('action', '/application/' + data[0] + '/edit');
            $('#editModal').modal('show');
        })
    });
</script>
@stop