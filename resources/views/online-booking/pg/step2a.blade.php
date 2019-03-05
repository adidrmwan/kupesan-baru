@extends('layouts.app')
@section('title', 'Booking')
@section('content')
@include('online-booking.pg.cover-partner')

<!--===== STEP 2 : PILIH TANGGAL BOOKING ====-->

<section class="innerpage-wrapper">
    <div id="booking" class="innerpage-section-padding">
        <div class="container">
            <div class="row">
                @include('online-booking.pg.package-info')
                <form role="form" action="{{ route('pg.submit.step2a') }}" method="post" enctype="multipart/form-data" class="lg-booking-form">
                {{ csrf_field() }}
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-5 content-side">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4>Pesanan-KU</h4></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12  user-detail">
                                        <div class="row">
                                            <div class="row">
                                                @if ($message = Session::get('warning'))
                                                    <div class="alert alert-danger"> 
                                                      {{ $message }} <b>Jam Operasional {{$partner->pr_name}}</b> dari Jam <b>{{$partner->open_hour}}:00 - {{$partner->close_hour}}:00 WIB</b>
                                                    </div>
                                                @elseif ($message = Session::get('not-available'))
                                                    <div class="alert alert-danger"> 
                                                      {{ $message }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                              <div class="col-md-12"> 
                                                <div class="form-group">
                                                  <label>Tanggal Pemesanan</label>
                                                  <input type="text" class="form-control text-center" value="{{ date('d M Y', strtotime($tanggalPenyewaan)) }}" disabled="">
                                                </div>
                                              </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                              <div class="col-md-12">
                                                <p style="text-align: center;">Masukkan lokasi, maksimal <b style="color: #EA410C;">{{$makslokasi}} lokasi.</b></p>
                                              </div>
                                            </div>
            @for ($i = 1; $i <= $makslokasi; $i++)
              @if($i == 1)
              <div class="row">
                  <div class="col-md-12">
                    <h5><span class="label label-default">Lokasi {{ $i }}</span></h5>
                      <div class="form-group">
                          <label>Nama Lokasi<small><b style="color: red;"> *</b></small></label>
                          <input type="text" class="form-control text-center" placeholder="Nama lokasi pemotretan" name="location_name_1" required="">
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Provinsi<small><b style="color: red;"> *</b></small></label>
                        <select class="form-control" name="loc_prov" id="provinces" required="">
                            <option value="" disable="true" selected="true">Pilih Provinsi</option>
                            @foreach ($provinces as $key => $value)
                            <option value="{{$value->id}}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Kota/Kabupaten<small><b style="color: red;"> *</b></small></label>
                        <select class="form-control" name="loc_kota" id="regencies" required="">
                          <option value="" disable="true" selected="true">Pilih Kota/Kabupaten</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Kecamatan<small><b style="color: red;"> *</b></small></label>
                        <select class="form-control" name="loc_kec" id="districts" required="">
                          <option value="" disable="true" selected="true">Pilih Kecamatan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Kelurahan<small><b style="color: red;"> *</b></small></label>
                        <select class="form-control" name="loc_kel" id="villages" required="">
                          <option value="" disable="true" selected="true">Pilih Kelurahan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Kode Pos<small><b style="color: red;"> *</b></small></label>
                        <input type="text" class="form-control text-center" placeholder="Kode Pos" name="loc_postal_code" required="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Alamat Lengkap<small><b style="color: red;"> *</b></small></label>
                        <textarea class="form-control text-center" placeholder="Tuliskan lokasi pemotretan dengan lengkap" name="location_detail_1"  style="resize: none; height: 100px;" required=""></textarea>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-12">
                  <h5><span class="label label-default">Lokasi {{ $i }}</span></h5>
                    <div class="form-group">
                        <label>Nama Lokasi<small><b style="color: red;"> </b></small></label>
                        <input type="text" class="form-control text-center" placeholder="Nama lokasi pemotretan" name="location_name[]">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Alamat Lengkap<small><b style="color: red;"> </b></small></label>
                        <textarea class="form-control text-center" placeholder="Tuliskan lokasi pemotretan dengan lengkap" name="location_detail[]"  style="resize: none; height: 100px;" ></textarea>
                    </div>
                </div>
            </div>
            @endif
            @endfor
                    <hr>
                </div>          
            </div>
        </div>
    </div>
</div>

                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table">
                                <tr>
                                    <th>Informasi Tambahan</th>
                                </tr>
                                @foreach($package as $value)
                                <tr>
                                    @if(empty($value->description))
                                    <td>Tidak ada informasi tambahan.</td>
                                    @else
                                    <td>{{$value->description}}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="lg-booking-form">
                        <input type="text" name="booking_id" value="{{$booking_id}}" hidden="">
                        <div class="checkbox col-xs-12 col-sm-12 col-md-12 col-lg-12"  >
                            <label> By continuing, you are agree to the <a href="{{ route('term') }}">Terms & Condition</a></label>
                            <button type="submit" class="btn btn-orange" style="float: right;">Lanjutkan</button>
                        </div><!-- end checkbox -->
                    </div> 
                </div>
                </form> 
            </div>
        </div><!-- end container -->         
    </div><!-- end flight-booking -->
</section>

@include('layouts.footer')
@endsection

@section('script')
<link href=" {{ URL::asset('partners/css/jquery-ui.css ') }}" rel="stylesheet"/>
<script src=" {{ URL::asset('partners/js/jquery-ui.min.js') }} " type="text/javascript"></script>

@endsection


