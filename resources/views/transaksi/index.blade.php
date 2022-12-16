@extends('layout.master')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DATA TRANSAKSI</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/index">MENU</a></li>
                    <li class="breadcrumb-item active">DATA TRANSAKSI</li>
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
                        <h3 class="card-title">Table Data Transaksi</h3>
                        <div style="text-align: right;">
                           <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">Tambah Data</button> 
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Transaksi</th>
                                    <th scope="col">Nama Product</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksi as $val)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $val->nama_transaksi}}</td>
                                    <td>{{ $val->product->nama_product}}</td>
                                    <td>{{ $val->unit}}</td>
                                    <td>Rp. {{ number_format($val->harga) }}</td>
                                    <td>Rp. {{ number_format($val->total_harga) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Transaksi</th>
                                        <th scope="col">Nama Product</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                    </tr>
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

<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambah_data" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_data">Tambah Data</h5>
                </button>
            </div>
            <div class="modal-body">
                <button style="width: 300px" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataPembelianPersediaan">Transaksi Pembelian / Persediaan Awal</button>
                <br><br>                
                <button style="width: 300px" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataPenjualan">Transaksi Penjualan</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahDataPembelianPersediaan" tabindex="-1" role="dialog" aria-labelledby="upload_data" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('transaksi.createPembelianPersediaan') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="upload_data">Tambah Data Transaksi Pembelian dan Persediaan Awal</h5>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Transaksi</label>
                            <select name="tpp_nama_transaksi" id="tpp_nama_transaksi" class="form-control">
                                <option value="null">Silahkan Pilih Transaksi</option>
                                <option value="persediaan_awal">Persediaan Awal</option>
                                <option value="pembelian">Pembelian</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Produk</label>
                            <select name="tpp_id_product" id="tpp_id_product" class="form-control">
                                <option value="null" selected>Pilih salah satu produk</option>
                                @foreach ($product as $val)
                                    <option value="{{$val->id}}">{{$val->nama_product}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" class="form-control" name="tpp_harga" id="tpp_harga">
                        </div>
                        <div class="form-group">
                            <label>Unit</label>
                            <input type="number" class="form-control" name="tpp_unit" id="tpp_unit">
                        </div>
                        <div class="form-group">
                            <label>Total Harga</label>
                            <input type="number" class="form-control" name="tpp_total_harga" id="tpp_total_harga">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="Close">Batal</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="tambahDataPenjualan" tabindex="-1" role="dialog" aria-labelledby="upload_data" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('transaksi.createPenjualan') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="upload_data">Tambah Data Transaksi Penjualan</h5>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Transaksi</label>
                            <select name="tp_nama_transaksi" id="tp_nama_transaksi" class="form-control">
                                <option value="null">Silahkan Pilih Transaksi</option>
                                <option value="penjualan">Penjualan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Persediaan</label>
                            <select name="tp_id_ledger" id="tp_id_ledger" class="form-control">
                                <option value="null" selected>Pilih salah satu persediaan</option>
                                @foreach ($ledger as $val)
                                    <option value="{{$val->id}}">{{$val->created_at->format("d/M/Y")}} - {{$val->product->nama_product}} - Unit {{$val->unit_persediaan}} - Harga Satuan Rp. {{number_format($val->harga_satuan_persediaan)}} - Jumlah Rp. {{ number_format($val->total_harga_persediaan) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" class="form-control" name="tp_id_product" id="tp_id_product">
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" class="form-control" name="tp_harga" id="tp_harga">
                        </div>
                        <div class="form-group">
                            <label>Unit</label>
                            <input type="number" class="form-control" name="tp_unit" id="tp_unit">
                        </div>
                        <div class="form-group">
                            <label>Total Harga</label>
                            <input type="number" class="form-control" name="tp_total_harga" id="tp_total_harga">
                        </div>
                        <div class="form-group mb-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms2" class="custom-control-input" id="exampleCheck2"
                                    required>
                                <label class="custom-control-label" for="exampleCheck2">SAYA SETUJU UNTUK MEMODIFIKASI
                                    DATA.</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="Close">Batal</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
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

        $('#tpp_id_product').on('change', function() {
            $.ajax({
                type: "get",
                dataType: "json",
                url: "{{ url('transaksi/id_product') }}/"+$('#tpp_id_product').val(),
                success: function(data){
                    $('#tpp_harga').val(data.harga);
                    alert("Harga automatis terisi!");
                }
            });
        });

        $('#tpp_unit').on('change', function() {
            let unit = $('#tpp_unit').val();
            let harga = $('#tpp_harga').val();
            let total_harga = (unit*harga);

            $('#tpp_total_harga').val(total_harga);
        });
        
        $('#tp_id_ledger').on('change', function() {
            $.ajax({
                type: "get",
                dataType: "json",
                url: "{{ url('transaksi/id_ledger') }}/"+$('#tp_id_ledger').val(),
                success: function(data){
                    $('#tp_harga').val(data.harga_satuan_persediaan);
                    $('#tp_id_product').val(data.id_product);
                    console.log(data.id_product);
                    alert("Harga automatis terisi!");
                }
            });
        });

        $('#tp_unit').on('change', function() {
            let unit = $('#tp_unit').val();
            let harga = $('#tp_harga').val();
            let total_harga = (unit*harga);

            $('#tp_total_harga').val(total_harga);
        });
    });
</script>
@stop