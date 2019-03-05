@extends('superadmin.layouts.master-admin')
@section('title', 'Dashboard Admin')
@section('content')

  <section class="content">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Partner Spot<span class='badge' style='background-color:orange;'></span></h3>
          </div>
          <div class="box-body">
            <div class="btn-group">
                <a href="{{route('add.partner-spot',['user_id' => $user_id]) }}">
                    <button type="button" class="btn btn-primary"><i class='fa fa-plus'></i>&nbsp;&nbsp;&nbsp;Add Spot</button>
                </a>
            </div>
            <hr>
            <div class="nav-tabs-custom">
                
              <ul class="nav nav-tabs">
                <!--<li class="active"><a href="#revenue-chart" data-toggle="tab">Cek Ketersediaan <i class="glyphicon glyphicon-remove-circle"></i></a></li>-->
                <!--<li><a href="#unconfirmed" data-toggle="tab">Sudah Bayar <i class="glyphicon glyphicon-remove-circle"></i></a></li>-->
                <!--<li><a href="#sales-chart" data-toggle="tab">Confirmed <i class="glyphicon glyphicon-ok-circle"></i></a></li>-->
              </ul>
              <div class="tab-content no-padding">
                <div class="tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                  <table id="example1" class="table table-bordered table-striped table-condensed">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Partner</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($freespot as $key => $value)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$value->pkg_name_them}}</td>
                            <td>
                                <a href="{{route('show.partner.spot',['id' => $value->user_id]) }}">
                                    <button class="btn btn-primary">Lihat Spot</button>
                                </a>
                                <a href="">
                                    <button class="btn btn-warning">Edit</button>
                                </a>
                                <a href="">
                                    <button class="btn btn-danger">Hapus</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="unconfirmed" style="position: relative; height: 300px;">
                  <table id="example3" class="table table-bordered table-striped table-condensed">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pemesan</th>
                      <th>No HP Pemesan</th>
                      <th>Tanggal Pesan</th>
                      <th>Jadwal Pesan</th>
                      <th>Total</th>
                      <!-- <th>Status</th> -->
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                  <table id="example9" class="table table-bordered table-striped table-condensed">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Booking</th>
                      <th>User ID</th>
                      <!-- <th>Paket ID</th> -->
                      <th>Date</th>
                      <th>Time</th>
                      <th>Total</th>
                      <!-- <th>Status</th> -->
                      <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection