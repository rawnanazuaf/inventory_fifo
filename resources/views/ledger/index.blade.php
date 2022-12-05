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
                                    <th rowspan="2">Tanggal</th>
                                    <th colspan="3" style="text-align: center;">Masuk/Penambah</th>
                                    <th colspan="3" style="text-align: center;">Keluar/Pengurang</th>
                                    <th colspan="3" style="text-align: center;">Saldo/Persediaan</th>
                                </tr>
                                <tr>
                                    <th>Unit</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                    <th>Unit</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                    <th>Unit</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ledger as $val)
                                <tr>
                                    <td>{{ $val->created_at->format("d/M/Y")}}</td>
                                    <td>{{ $val->unit_penambahan}}</td>
                                    <td>{{ $val->harga_satuan_penambahan}}</td>
                                    <td>{{ $val->total_harga_penambahan}}</td>
                                    <td>{{ $val->unit_pengurangan}}</td>
                                    <td>{{ $val->harga_satuan_pengurangan}}</td>
                                    <td>{{ $val->total_harga_pengurangan}}</td>
                                    <td>{{ $val->unit_persediaan}}</td>
                                    <td>{{ $val->harga_satuan_persediaan}}</td>
                                    <td>{{ $val->total_harga_persediaan}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="2">Tanggal</th>
                                    <th colspan="3" style="text-align: center;">Masuk/Penambah</th>
                                    <th colspan="3" style="text-align: center;">Keluar/Pengurang</th>
                                    <th colspan="3" style="text-align: center;">Saldo/Persediaan</th>
                                </tr>
                                <tr>
                                    <th>Unit</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                    <th>Unit</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                    <th>Unit</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
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
    });
</script>
@stop