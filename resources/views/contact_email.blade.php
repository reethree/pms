@extends('print')

@section('title')
    {{ 'Pricing Calculation' }}
@stop

@section('content')

<style>
table.table th {
    border: 1px solid #CCC;
    text-align: left;
}
table.table td {
    border: 1px solid #CCC !important;
    padding: 10px;
}
</style>

<div class="wrap">
    <div class="container">
        <div class="red-line">
            <div></div>
        </div>
        <div class="content">                
            <div class="message">  
                <p><a href="{{route('contact-edit', $id)}}">EDIT CONTACT</a></p>
                <div>
                    <table class="table">
                        <tr>
                            <td colspan="2"><h3>Contact Information</h3></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{$nama}}</td>
                        </tr>
                        <tr>
                            <th>Perusahaan</th>
                            <td>{{$perusahaan}}</td>
                        </tr>
                        <tr>
                            <th>No. HP/Tlp</th>
                            <td>{{$phone}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$email}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><h3>Detail Inquiry</h3></td>
                        </tr>
                        <tr>
                            <th>Barang</th>
                            <td>{{$barang}}</td>
                        </tr>
                        <tr>
                            <th>Fungsi Barang</th>
                            <td>{{$fungsi_barang}}</td>
                        </tr>
                        <tr>
                            <th>Material</th>
                            <td>{{$material}}</td>
                        </tr>
                        <tr>
                            <th>Warna</th>
                            <td>{{$warna}}</td>
                        </tr>
                        <tr>
                            <th>Mold</th>
                            <td>{{$mold}}</td>
                        </tr>
                        <tr>
                            <th>Quantity / Bulan</th>
                            <td>{{number_format($quantity).' PCS'}}</td>
                        </tr>
                        <tr>
                            <th>Rutin</th>
                            <td>{{ ($rutin == 1) ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <th>Target Harga /PCS</th>
                            <td>{{'IDR '.number_format($target_harga)}}</td>
                        </tr>
                        <tr>
                            <th>Target Tgl. Produksi</th>
                            <td>{{date("d F Y", strtotime($target_produksi))}}</td>
                        </tr>
                        <tr>
                            <th>Packaging</th>
                            <td>{{$packaging}}</td>
                        </tr>
                        <tr>
                            <th>Alamat Pengiriman</th>
                            <td>{{$alamat}}</td>
                        </tr>
                        <tr>
                            <th style="width: 150px;">Darimana anda mengetahui<br />tentang PT. Dunamika Polimerindo ?</th>
                            <td>{{$referensi}}</td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td>{{$catatan}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Tanggal Kontak</th>
                            <td>{{date("d F Y", strtotime($tgl_tlp))}}</td>
                        </tr>
                        <tr>
                            <th>Penerima Kontak</th>
                            <td>{{$penerima_tlp}}</td>
                        </tr>
                    </table>
                </div>
                <p><a href="{{route('contact-edit', $id)}}">EDIT CONTACT</a></p>
            </div>            
        </div>
        <div class="red-line">
            <div></div>
        </div>
    </div>
</div>
@stop