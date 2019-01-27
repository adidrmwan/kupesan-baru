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
                                                <td colspan="2" style="text-align: center;"><b>{{$package->pkg_name_them}}</b></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">Tanggal Sewa</td>
                                                <td style="width: 50%;">{{ date('d F Y', strtotime($data->start_date)) }} s/d<br> {{ date('d F Y', strtotime($data->end_date)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tipe / Set Paket</td>
                                                <td>{{$data->category_name}} / {{$data->set}}</td>
                                            </tr>
                                            <tr>
                                                <td>Ukuran</td>
                                                <td>{{$data->size}}</td>
                                            </tr>
                                            <tr>
                                                <td>Kuantitas Pesanan</td>
                                                <td>{{$data->kuantitas}} pcs</td>
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
                                    <a href="{{route('kebaya.booking.finished', ['id' => $data->booking_id])}}">
                                        <button type="submit" class="btn btn-block btn-info pull-right" onclick="return confirm('Are you sure want to complete this booking?')"><i class="fa fa-check"></i> Order Complete</button>
                                    </a>
                                    @elseif($data->booking_status == 'confirmed')
                                    <small>* Jika pesanan ini sudah selesai, klik tombol dibawah ini.</small>
                                    <a href="{{route('kebaya.booking.finished.online', ['id' => $data->booking_id])}}">
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