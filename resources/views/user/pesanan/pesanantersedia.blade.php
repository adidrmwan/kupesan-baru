<div class="dashboard-listing booking-listing">
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
                @foreach($pesanan_approved as $listpesanan)
                <tr>

                    <td class="dash-list-text booking-list-detail">
                        <h3 style="padding:10px; ">{{$listpesanan->partner_name}}</h3>
                        <ul class="list-unstyled booking-info">
                        <div class="col-md-6 col-sm-12">
                            <li>Tanggal :<span class="pull-right">{{ date('l, d F Y', strtotime($listpesanan->booking_start_date)) }}</span></li>
                            <li>Waktu :<span class="pull-right">{{$listpesanan->booking_start_time}}:00 A - {{$listpesanan->booking_end_time + $listpesanan->booking_overtime}}:00 A</span></li>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <li>Nama Paket :<span class="pull-right">{{ $listpesanan->pkg_name_them }}</span></li>
                            <li>Total Harga :<span class="pull-right"> Rp {{number_format($listpesanan->booking_total, 0, ',','.')}}</span></li>
                            <li>
                                <a href="{{ route('form.step6', ['bid' => $listpesanan->booking_id]) }}">
                                    <button type="submit" class="btn btn-orange" style="float: right; color: white;"><b>Lanjutkan</b></button>
                                </a>    
                            </li>
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
                @foreach($kebaya_approved as $listpesanan)
                <tr>

                    <td class="dash-list-text booking-list-detail">
                        <h3 style="padding:10px; ">{{$listpesanan->partner_name}}</h3>
                        <ul class="list-unstyled booking-info">
                        <div class="col-md-6 col-sm-12" style="margin-bottom: 25px;">
                            <li>Nama Paket :<span class="pull-right">{{ $listpesanan->name }}</span></li>
                            <li>Tanggal Pesan:<span class="pull-right">{{ date('l, d F Y', strtotime($listpesanan->start_date)) }}</span></li>
                            <li>Tanggal Pengembalian :<span class="pull-right">{{ date('l, d F Y', strtotime($listpesanan->end_date)) }}</span></li>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            @include('user.detail-harga-kebaya')
                            <li>
                                <a href="{{ route('kebaya.step6', ['bid' => $listpesanan->booking_id]) }}">
                                    <button type="submit" class="btn btn-orange" style="float: right; color: white;"><b>Lanjutkan</b></button>
                                </a>    
                            </li>
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
                @foreach($pg_approved as $listpesanan)
                <tr>
                    <td class="dash-list-text booking-list-detail">
                        <h3 style="padding:10px; ">{{$listpesanan->partner_name}}</h3>
                        <ul class="list-unstyled booking-info">
                        <div class="col-md-6 col-sm-12" style="margin-bottom: 25px;">
                            <li>Nama Paket :<span class="pull-right">{{ $listpesanan->pg_name }}</span></li>
                            <li>Tanggal Pesan:<span class="pull-right">{{ date('l, d F Y', strtotime($listpesanan->start_date)) }}</span></li>
                            <li>Waktu Pesan :<span class="pull-right">{{ date('H:i A', strtotime($listpesanan->start_date)) }}</span></li>
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <li>Total Harga :<span class="pull-right">Rp {{number_format($listpesanan->booking_total, 0, ',', '.')}}</span></li>
                            <li>
                                <a href="{{ route('pg.step6', ['bid' => $listpesanan->booking_id]) }}">
                                    <button type="submit" class="btn btn-orange" style="float: right; color: white;"><b>Lanjutkan</b></button>
                                </a>    
                            </li>
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