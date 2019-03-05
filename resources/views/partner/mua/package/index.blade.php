@extends('layouts.app-partner')
@section('title', 'List Package')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                  <h3 class="title">List Package</h3>
                </div>
                <div class="content">
                    <table class="table table-bordered table-striped table-responsive table-condensed" id="list-package">
                        <thead>
                            <th>No</th>
                            <th>Nama Paket</th>
                            <th>Kategori Paket</th>
                            <th>Mua</th>
                            <th>Print Size</th>
                            <th>Edited Photo (pcs)</th>
                            <th>Durasi Paket</th>
                            <th>Harga Paket</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach($package as $key => $data)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td class="text-uppercase">{{$data->pg_name}}</td>
                                <td>{{$data->pg_category}}</td>
                                <td>{{$data->pg_mua}}</td>
                                <td>{{$data->pg_printed_size}} R</td>
                                <td>{{$data->pg_edited_jumlah}} lembar</td>
                                <td>
                                    @foreach($hargaPaket as $harga)
                                        @if($data->id == $harga->package_id)
                                        {{$harga->durasi_jam}} Jam<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($hargaPaket as $harga)
                                        @if($data->id == $harga->package_id)
                                        Rp {{number_format($harga->durasi_harga,0,',','.')}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('pg-package.show', ['id' => $data->id])}}">
                                              <button type="submit" class="btn btn-primary "><i class="fa fa-pencil-square-o"></i>Edit</button>
                                    </a>
                                </td>   
                                <td>
                                    <a href="{{route('delete.pg.package', ['package_id' => $data->id])}}" class="btn btn-info btn-sm pull-right" onclick="return confirm('Are you sure want to Delete?')">Delete</a>


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
        
@endsection