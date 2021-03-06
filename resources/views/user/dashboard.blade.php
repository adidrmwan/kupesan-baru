@extends('user.layouts.app')
@section('title', 'Dashboard')
@section('content')

<section class="innerpage-wrapper">
	<div id="dashboard" class="innerpage-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                	<div class="dashboard-heading">
                        @foreach($user as $data)
                        <p>Hai <b class="text-uppercase">{{$data->first_name}} {{$data->last_name}}</b>, Selamat Datang di  <span style="color: #EA410C"><b>KUPESAN.ID</b></span> </p>
                        @endforeach
                        <p>Semoga harimu indah</p>
                    </div>
                    <div id="dashboard-tabs">
                    	<ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#dsh-booking" data-toggle="tab"><span><i class="fa fa-user"></i></span>Pesanan</a></li>
                            <li><a href="#dsh-wishlist" data-toggle="tab"><span><i class="fa fa-history"></i></span>Histori</a></li>
                            <li><a href="#dsh-profile" data-toggle="tab"><span><i class="fa fa-briefcase"></i></span>Profil</a></li>
                        </ul>
                        <div class="tab-content">                            
                            <div id="dsh-profile" class="tab-pane fade">
                            	<div class="dashboard-content user-profile">
                                    <h2 class="dash-content-title" style="color: #EA410C">PROFIL-KU</h2>
                                    <div class="panel panel-default ">
                                        <div class="panel-heading">
                                            <h4 style="text-align: center;">Detail Profil
                                            <!-- <span class="pull-right">
                                                <a href="">
                                                  <button type="submit" class="btn btn-orange" style="color: white;"><b>Edit</b></button>
                                                </a>
                                            </span> -->
                                            </h4>
                                            
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">                                                
                                                <div class="col-sm-12 col-md-12  user-detail">
                                                    <ul class="list-unstyled">
                                                        @foreach($user as $data)
                                                        <li><span>Nama  :</span> <br> {{$data->first_name}} {{$data->last_name}}</li>
                                                        <li><span>Email :</span> <br> {{$data->email}}</li>
                                                        <li><span>No Hp :</span> <br> {{$data->phone_number}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>                                      
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="dsh-booking" class="tab-pane fade in active">
                            	<div class="dashboard-content booking-trips col-xs-12 col-sm-10 col-md-10">
                                    <h2 class="dash-content-title" style="color: #EA410C">PESANAN-KU</h2>
                                    <h3><span class="label label-warning">SEDANG DIPROSES</span></h3>
                                    @include('user.pesanan.sedangproses')
                                    <br>
                                    <h3><span class="label label-warning">PESANAN TERSEDIA</span></h3>
                                    @include('user.pesanan.pesanantersedia')
                                    <br>
                                    <h3><span class="label label-warning">MENUNGGU PEMBAYARAN</span></h3>
                                    @include('user.pesanan.menunggupembayaran')
                                    <br>
                                    <h3><span class="label label-warning">MENUNGGU KONFIRMASI</span></h3>
                                    @include('user.pesanan.menunggukonfirmasi')
                                    <br>
                                    <h3><span class="label label-success">PESANAN BERHASIL</span></h3>
                                    @include('user.pesanan.pesananberhasil')
                                </div>
                            </div>
                            <div id="dsh-wishlist" class="tab-pane fade">
                            	<div class="dashboard-content wishlist">
                                    <h2 class="dash-content-title" style="color: #EA410C">HISTORI-KU</h2>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                @foreach($riwayat as $data)
                                                <tr class="list-content">
                                                    <td class="list-text wishlist-text">
                                                        <h3 >{{$data->partner_name}}</h3>
                                                        <p>
                                                            <span>Nama Pemesan :</span> {{$data->booking_user_name}}<br>
                                                            <span>Tanggal :</span> {{ date('d F Y', strtotime($data->booking_start_date)) }}
                                                        </p>
                                                        <p class="order"><span>Total:</span> Rp {{$data->booking_total}}</p>
                                                    </td>
                                                    <td class="list-text wishlist-text">
                                                        <br>
                                                            <ul class="list-unstyled booking-info">
                                                                <li><span>Detail Pemesanan</span></li>
                                                                <li>Jam Pesan :<span class="pull-right-booking">{{$data->booking_start_time}}:00 - {{$data->booking_end_time + $data->booking_overtime}}:00</span></li>
                                                                <li>Tamu :<span class="pull-right-booking">{{$data->booking_capacities}} Orang</span></li>
                                                                <li>Total Harga :<span class="pull-right-booking"> Rp {{$data->booking_total}}</span></li>
                                                            </ul>
                                                    </td>
                                                </tr>
                                                @endforeach
                                             </tbody>
                                         </table>
                                    </div>
                                </div>
                                <div class="dashboard-content wishlist">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                @foreach($kebaya_riwayat as $data)
                                                <tr class="list-content">
                                                    <td class="list-text wishlist-text" style="padding: 5px;">
                                                        <h3>{{$data->partner_name}}</h3>
                                                        <p>
                                                            <span>Nama Pemesan :</span> {{$data->user_name}}<br>
                                                            <span>Tanggal Pesan:</span> {{ date('d F Y', strtotime($data->start_date)) }}<br>
                                                            <span>Tanggal Pengambilan:</span> {{ date('d F Y', strtotime($data->end_date)) }}
                                                        </p>
                                                        <p class="order"><span>Total:</span> Rp {{number_format($data->booking_total,0,',','.')}}</p>
                                                    </td>
                                                    <td class="list-text wishlist-text">
                                                        <br>
                                                            <ul class="list-unstyled booking-info">
                                                                <li><span>Detail Pemesanan</span></li>
                                                                <li>Jam Pesan :<span class="pull-right-booking">{{$data->booking_start_time}}:00 - {{$data->booking_end_time + $data->booking_overtime}}:00</span></li>
                                                                <li>Tamu :<span class="pull-right-booking">{{$data->booking_capacities}} Orang</span></li>
                                                                <li>Total Harga :<span class="pull-right-booking"> Rp {{$data->booking_total}}</span></li>
                                                            </ul>
                                                    </td>
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
        </div>   
    </div>
</section>

<div id="edit-profile" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Edit Profile</h3>
            </div><!-- end modal-header -->
            
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Your Name</label>
                        <input type="text" class="form-control" placeholder="Name"/>
                    </div><!-- end form-group -->
                    
                    <div class="form-group">
                        <label>Your Email</label>
                        <input type="email" class="form-control" placeholder="Email" />
                    </div><!-- end form-group -->
                    
                    <div class="form-group">
                        <label>Your Phone</label>
                        <input type="text" class="form-control" placeholder="Phone Number" />
                    </div><!-- end form-group -->
                    <button class="btn btn-orange">Save Changes</button>
                </form>
            </div><!-- end modal-bpdy -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end edit-profile -->

@include('layouts.footer')
@endsection