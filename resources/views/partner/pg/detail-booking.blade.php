@extends('layouts.app-partner')

@section('content')
<section class="content">
    <div class="container-fluid">
        @foreach($booking as $data)
        @if($data->booking_status == 'libur')
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">{{$data->partner_name}}</h4>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Mulai tanggal <em>{{\Carbon\Carbon::parse($data->booking_start_date)->format('d M Y')}}</em> sampai tanggal <em>{{\Carbon\Carbon::parse($data->booking_end_date)->format('d M Y')}}</em></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-8">
               <div class="card">
                    <div class="header">
                        <h3 class="title"><b class="text-uppercase">Booking Code : {{$data->kode_booking}}</b></h3>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box">
                                    <div class="box-body">
                                        <table class="table table-sm table-hover ">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th colspan="2" style="text-align: center;">Detail Booking</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td colspan="2" style="text-align: center;"><b>{{$package->pg_name}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Pemesanan</td>
                                                <td>{{ date('l, d F Y', strtotime($booking2->start_date)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Waktu Pemesanan</td>
                                                <td>{{ date('H:i A', strtotime($booking2->start_date)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>MUA / Stylist</td>
                                                <td>{{$package->pg_mua}} / {{$package->pg_stylist}}</td>
                                            </tr>
                                              <tr>
                                                <td>Lokasi</td>
                                                <td>
                                                    @foreach($pglog as $key => $value)
                                                    <small>{{$key+1}} : {{$value->loc_name}} - {{$value->loc_addr}}</small><br>
                                                    @endforeach
                                                </td>
                                              </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box">
                                    <div class="box-body">
                                        <table class="table table-sm table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th colspan="2" style="text-align: center;">Customer Details</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td style="width: 10%;"><i class="fa fa-user"></i> Nama</td>
                                                <td style="width: 90%;">{{$data->user_name}}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-phone"></i> HP</td>
                                                <td>{{$data->user_nohp}}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-envelope"></i> Email</td>
                                                <td>{{$data->user_email}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if($flag_date == '0')
                                    <small>* Anda dapat menyetujui pesanan ini pada tanggal <b>{{ date('d F Y', strtotime($data->start_date)) }}</b>.</small>
                                    <button type="submit" class="btn btn-block pull-right" onclick="return confirm('Are you sure want to complete this booking?')" disabled=""><i class="fa fa-check" ></i> Order Complete</button>
                                @elseif($flag_date == '1')
                                    @if($data->booking_status == 'offline-booking')
                                    <small>* Jika pesanan ini sudah selesai, klik tombol dibawah ini.</small>
                                    <a href="{{route('pg.booking.finished', ['id' => $data->booking_id])}}">
                                        <button type="submit" class="btn btn-block btn-info pull-right" onclick="return confirm('Are you sure want to complete this booking?')"><i class="fa fa-check"></i> Order Complete</button>
                                    </a>
                                    @elseif($data->booking_status == 'confirmed')
                                    <small>* Jika pesanan ini sudah selesai, klik tombol dibawah ini.</small>
                                    <a href="{{route('pg.booking.finished.online', ['id' => $data->booking_id])}}">
                                        <button type="submit" class="btn btn-block btn-info pull-right" onclick="return confirm('Are you sure want to complete this booking?')"><i class="fa fa-check"></i> Order Complete</button>
                                    </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
        @endif
        @endforeach  
    </div>
        
</section>
        
@endsection