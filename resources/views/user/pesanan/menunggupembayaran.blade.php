<div class="dashboard-listing booking-listing">
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
                @foreach($pesanan_pembayaran as $listpesanan)
                <tr>

                    <td class="dash-list-text booking-list-detail">
                        <h3 style="padding:10px; ">{{$listpesanan->partner_name}}<span><p><b>Batas Waktu Pembayaran</b> <b style="color: #EA410C;">{{ date('l,', strtotime($listpesanan->booking_at)) }}, {{ date('H:i:s', strtotime($listpesanan->booking_at)) }} WIB</b></p></span></h3>
                        <ul class="list-unstyled booking-info">
                            <div class="col-md-6 col-sm-12">
                                <li>Tanggal :<span class="pull-right">{{ date('l, d F Y', strtotime($listpesanan->booking_start_date)) }}</span></li>
                                <li>Waktu :<span class="pull-right">{{$listpesanan->booking_start_time}}:00 - {{$listpesanan->booking_end_time + $listpesanan->booking_overtime}}:00</span></li>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <ul class="list-unstyled booking-info">
                                    <li>Nama Paket :<span class="pull-right">{{ $listpesanan->pkg_name_them }}</span></li>
                                    <li>Total Harga :<span class="pull-right"> Rp {{number_format($listpesanan->booking_total, 0, ',','.')}}</span></li>
                                    <li>
                                        <form role="form" action="{{ route('form.step7') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                            <button type="submit" class="btn btn-orange" style="float: right; color: white;"><b>Lanjutkan Pembayaran</b></button>
                                            <input type="text" name="bid" value="{{$listpesanan->booking_id}}" hidden="">
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </ul>
                    </td>
                    <!-- <td class="dash-list-text booking-list-detail"></td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="dashboard-listing booking-listing">
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
                @foreach($kebaya_pembayaran as $listpesanan)
                <tr>
                    <td class="dash-list-text booking-list-detail">
                        <h3 style="padding:10px; ">{{$listpesanan->partner_name}}<span>
                            <p><b>Batas Waktu Pembayaran</b> <b style="color: #EA410C;">{{ date('l, d F Y', strtotime($listpesanan->booking_at)) }}, {{ date('H:i:s', strtotime($listpesanan->booking_at)) }} WIB</b></p></span></h3>
                        <ul class="list-unstyled booking-info">
                            <div class="col-md-6 col-sm-12" style="margin-bottom: 25px;">
                                <li>Nama Paket :<span class="pull-right">{{ $listpesanan->name }}</span></li>
                                <li>Tanggal Pesan:<span class="pull-right">{{ date('l, d F Y', strtotime($listpesanan->start_date)) }}</span></li>
                                <li>Tanggal Pengembalian :<span class="pull-right">{{ date('l, d F Y', strtotime($listpesanan->end_date)) }}</span></li>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <ul class="list-unstyled booking-info">
                                    @include('user.detail-harga-kebaya')
                                    <li>
                                        <form role="form" action="{{ route('kebaya.step7') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                            <button type="submit" class="btn btn-orange" style="float: right; color: white;"><b>Bayar</b></button>
                                            <input type="text" name="bid" value="{{$listpesanan->booking_id}}" hidden="">
                                        </form>
                                    </li>
                                </ul>
                            </div> 
                        </ul>
                    </td>
                    <!-- <td class="dash-list-text booking-list-detail"></td> -->
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="dashboard-listing booking-listing">
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
                @foreach($pg_pembayaran as $listpesanan)
                <tr>
                    <td class="dash-list-text booking-list-detail">
                        <h3 style="padding:10px; ">{{$listpesanan->partner_name}}<span>
                            <p><b>Batas Waktu Pembayaran</b> <b style="color: #EA410C;">{{ date('l, d F Y', strtotime($listpesanan->booking_at)) }}, {{ date('H:i:s', strtotime($listpesanan->booking_at)) }} WIB</b></p></span></h3>
                        <ul class="list-unstyled booking-info">
                            <div class="col-md-6 col-sm-12" style="margin-bottom: 25px;">
                                <li>Nama Paket :<span class="pull-right">{{ $listpesanan->pg_name }}</span></li>
                                <li>Tanggal Pesan:<span class="pull-right">{{ date('l, d F Y', strtotime($listpesanan->start_date)) }}</span></li>
                                <li>Waktu Pesan :<span class="pull-right">{{ date('H:i A', strtotime($listpesanan->start_date)) }}</span></li>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <ul class="list-unstyled booking-info">
                                    <li>Total Harga :<span class="pull-right">Rp {{number_format($listpesanan->booking_total, 0, ',', '.')}}</span></li>
                                    <li>
                                        <form role="form" action="{{ route('pg.step7') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                            <button type="submit" class="btn btn-orange" style="float: right; color: white;"><b>Bayar</b></button>
                                            <input type="text" name="bid" value="{{$listpesanan->booking_id}}" hidden="">
                                        </form>
                                    </li>
                                </ul>
                            </div> 
                        </ul>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>
