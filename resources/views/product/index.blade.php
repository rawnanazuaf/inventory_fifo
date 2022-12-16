@extends('layout.master')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DATA PRODUK</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/index">MENU</a></li>
                    <li class="breadcrumb-item active">DATA PRODUK</li>
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
                        <h3 class="card-title">Table Data Produk</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product as $val)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $val->nama_product }}</td>
                                    <td>Rp. {{ number_format($val->harga) }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning edit">Edit</a>
                                        <br> </br>
                                        <a href="/product/{{$val->id}}/delete" class="btn btn-danger"
                                            onclick="return confirm('Yakin mau dihapus?')">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Aksi</th>
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
                <h3 class="card-title">Tambah Produk Baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('product.create')}}" method="POST">
                {{csrf_field()}}
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" name="nama_product" id="nama_product"
                            placeholder="Masukkan Nama Produk Dengan Benar">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="harga" id="harga"
                            placeholder="Masukkan harga Dengan Benar">
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
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="md_nama_product" id="md_nama_product"
                                    placeholder="Masukkan Nama Produk Dengan Benar">
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="md_harga" id="md_harga"
                                    placeholder="Masukkan Harga Dengan Benar">
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
            $('#md_nama_product').val(data[1]);
            $('#md_harga').val(data[2]);
            $('#editForm').attr('action', '/product/' + data[0] + '/edit');
            $('#editModal').modal('show');
        })
    });
</script>
@stop