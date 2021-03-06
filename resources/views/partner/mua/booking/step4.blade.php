@extends('partner.layouts.app-form')
@section('title', 'Offline Booking')
@section('content')
<div class="content">
    <div class="container-fluid">   
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                  <form role="form" action="{{ route('kebaya.off-booking.step4.submit') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                  {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header">
                                <h4 class="title">Offline Booking</h4>
                                <p>
                                  <span class="badge badge-secondary">Step 1</span> <i class="fa fa-arrow-right"></i> 
                                  <span class="badge badge-secondary">Step 2</span> <i class="fa fa-arrow-right"></i> 
                                  <span class="badge badge-secondary">Step 3</span> <i class="fa fa-arrow-right"></i> 
                                  <span class="badge badge-primary">Step 4 : Konfirmasi Pesanan</span></p>
                                <p></p>
                            </div>
                            <div class="content">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <h5>Detail Pesanan</h5>
                                      </div>
                                    </div>
                                    @foreach($detail_pesanan as $data)
                                    <div class="row">
                                      <div class="col-md-12">
                                        <table class="table">
                                          <tr>
                                            <td>Tanggal Sewa</td>
                                            <td>{{ date('d F Y', strtotime($data->start_date)) }} - {{ date('d F Y', strtotime($data->end_date)) }}</td>
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
                                            <td>Kuantitas</td>
                                            <td>{{$data->kuantitas}} Barang</td>
                                          </tr>
                                        </table>
                                      </div>
                                    </div>


                                    <div class="row">
                                      <div class="col-md-12">
                                        <h5>Harga</h5>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <table class="table">
                                          <tr>
                                            <td>Harga Paket</td>
                                            <td>Rp. {{number_format($data->booking_price, 0, ',', '.')}}</td>
                                          </tr>
                                          <tr>
                                            <td>Deposit</td>
                                            <td>Rp. {{number_format($data->deposit, 0, ',', '.')}}</td>
                                          </tr>
                                          <tr>
                                            <td>Dryclean</td>
                                            <td>Rp. {{number_format($data->biaya_dry_clean, 0, ',', '.')}}</td>
                                          </tr>
                                          <tr>
                                            <th>Total</th>
                                            <th>Rp. {{number_format($data->booking_total, 0, ',', '.')}}</th>
                                          </tr>
                                        </table>
                                      </div>
                                    </div>
                                    @endforeach
                                  </div>
                                </div> 
                                <div class="row">
                                  <div class="col-md-12">
                                    <small>Dengan menekan tombol dibawah, berarti Anda sudah yakin dengan pesanan Anda.</small>
                                    <br>
                                    <input type="text" name="booking_id" value="{{$booking_id}}" hidden="">
                                    <button type="submit" class="btn btn-block btn-info pull-right" onclick="return confirm('Are you sure want to confirm this booking?')">Booking Offline</button> 
                                  </div>
                                </div> 
                            </div>   
                        </div>     
                    </div>
                      
                  </form>
                </div>
            </div>
            <div class="col-md-4">
              @foreach($package as $data)
                @include('partner.kebaya.booking.kebaya-paket')
              @endforeach
            </div>
        </div>
    </div>
</div>  
@endsection

@section('script')
<script src="{{ URL::asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ URL::asset('dist/js/custom-date-picker.js') }} "></script>
<script src="{{ URL::asset('dist/js/bootstrap-datepicker.js') }} "></script>


<link href=" {{ URL::asset('partners/css/jquery-ui.css ') }}" rel="stylesheet"/>
<script src=" {{ URL::asset('partners/js/jquery-ui.min.js') }} " type="text/javascript"></script>

@endsection