@extends('main-layout')

@section('content')  

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">NICE Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-hover" id="nice-table">
                    <thead>
                        <tr>
                            <th>#</th>            
                            <th>Nama</th>
                            <th>Perusahaan</th>
                            <th>No. HP/Tlp</th>
                            <th>Email</th>
                            <th>Barang</th>
                            <th>Fungsi Barang</th>
                            <th>Material</th>
                            <th>Warna</th>
                            <th>Mold</th>
                            <th>Quantity / Bulan</th>
                            <th>Rutin ?</th>
                            <th>Target Harga /PCS</th>
                            <th>Target Tgl. Produksi</th>
                            <th>Packaging</th>
                            <th>Alamat Pengiriman</th>
                            <th>Referensi</th>
                            <th>Catatan</th>
                            <th>Tanggal Tlp</th>
                            <th>Penerima Tlp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
    
@endsection

@section('custom_js')
<script>
    $('#nice-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("getNiceTable")}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama'},
            {data: 'perusahaan', name: 'perusahaan'},
            {data: 'phone', name: 'phone'},
            {data: 'email', name: 'email'},
            {data: 'barang', name: 'barang'},
            {data: 'fungsi_barang', name: 'fungsi_barang'},
            {data: 'material', name: 'material'},
            {data: 'warna', name: 'warna'},
            {data: 'mold', name: 'mold'},
            {data: 'quantity', name: 'quantity'},
            {data: 'rutin', name: 'rutin'},
            {data: 'target_harga', name: 'target_harga'},
            {data: 'target_produksi', name: 'target_produksi'},
            {data: 'packaging', name: 'packaging'},
            {data: 'alamat', name: 'alamat'},
            {data: 'referensi', name: 'referensi'},
            {data: 'catatan', name: 'catatan'},
            {data: 'tgl_tlp', name: 'tgl_tlp'},
            {data: 'penerima_tlp', name: 'penerima_tlp'},
            {data: 'action', name: 'Action', orderable: false, searchable: false}
        ]
    });
</script>
@endsection