@extends('layouts.app-partner')
@section('title', 'Schedule')
@section('content')
<section class="content">
<div class="container-fluid " style="padding: 25px;">
  <div class="row">
    <div class="col-md-12">
      <div class="card" >
        <div class="header">
          <h3 class="title">Booking Schedule</h3>
        </div>
        <div class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="bd-example bd-example-tabs">
                <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#daftarBooking" role="tab" aria-controls="home" aria-expanded="true">Calendar</a>
                  <a class="nav-item nav-link " id="nav-profile-tab" data-toggle="tab" href="#jadwalBooking" role="tab" aria-controls="profile" aria-expanded="false">List</a>
                </nav>
              </div>
            </div>
          </div>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade active show" id="daftarBooking" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
              <br>  
              <div class="row">
                <div class="col-md-9">
                  {!! $calendar->calendar() !!}  
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                  <div class="card">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="header">
                          <h4>Keterangan</h4>
                        </div>
                        <div class="content">
                          <h5><span class="badge badge-pill badge-success">Online Booking</span></h5>
                          <h5><span class="badge badge-pill badge-warning">Offline Booking</span></h5>
                          <h5><span class="badge badge-pill badge-danger">Day-Off (Libur)</span></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade " id="jadwalBooking" role="tabpanel" aria-labelledby="nav-profile-tab" aria-expanded="false">
              <br>
              <table class="table table-bordered table-striped table-responsive table-condensed" id="list-package3">
              <thead>
                <th>No</th>
                <th>Kode Booking</th>
                <th>Package Name</th>
                <th>MUA</th>
                <th>Stylist</th>
                <th>Start Date</th>
                <th>Start Time</th>
                <th>Name (Customer)</th> 
                <th>Phone (Customer)</th> 
                <th>Harga Paket (Rp)</th>
                <th>Total (Rp)</th>
                <th>Status</th>
                <th>Action</th>
              </thead>
              <tbody>
                @foreach($booking as $key => $data)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td class="text-uppercase">{{$data->kode_booking}}</td>
                  <td>{{$data->pg_name}}</td>
                  <td>{{$data->pg_mua}}</td>
                  <td>{{$data->pg_stylist}}</td>
                  <td>{{ date('l, d F Y', strtotime($data->start_date)) }}</td>
                  <td>{{ date('H:i A', strtotime($data->start_date)) }}</td>
                  <td>{{$data->user_name}}</td> 
                  <td>{{$data->user_nohp}}</td> 
                  <td>{{number_format($data->booking_price, 0, ',', '.')}}</td>
                  <td>{{number_format($data->booking_total, 0, ',', '.')}}</td>
                  @if($data->booking_status == 'offline-booking')
                  <td><h5><span class="badge badge-pill badge-warning">Off</span></h5></td> 
                  <td style="text-align: center;">
                    <a href="{{route('pg.booking.cancel', ['id' => $data->booking_id])}}">
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to cancel this booking?')"><i class="fa fa-close"></i> Cancel</button>
                    </a>
                    <a href="{{route('pg.detail.booking', ['booking_id' => $data->booking_id])}}">
                      <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Complete</button>
                    </a>
                  </td> 
                  @elseif($data->booking_status == 'confirmed')
                  <td><h5><span class="badge badge-pill badge-success">On</span></h5></td> 
                  <td style="text-align: center;">
                    <a href="{{route('pg.detail.booking', ['booking_id' => $data->booking_id])}}">
                      <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Complete</button>
                    </a>
                  </td>
                  @endif
                  
                </tr>
                @endforeach
              </tbody>
          </table>
            </div>
          </div>
        </div>
      </div>   
    </div>
  </div>
</div>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

</section>     
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
{!! $calendar->script() !!}

@endsection




