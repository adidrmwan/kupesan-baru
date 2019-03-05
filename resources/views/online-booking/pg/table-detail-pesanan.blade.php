<div class="row">
  <div class="col-md-12">
    <h5><b>Detail Pemesanan</b></h5>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <tr>
        <td>Tanggal Pemesanan</td>
        <td>{{ date('l, d F Y', strtotime($data->start_date)) }}</td>
      </tr>
      <tr>
        <td>Waktu Pemesanan</td>
        <td>{{ date('H:i A', strtotime($data->start_date)) }}</td>
      </tr>
      <tr>
        <td>Nama Paket</td>
        <td>{{$package2->pg_name}}</td>
      </tr>
      <tr>
        <td>MUA / Stylist</td>
        <td>{{$package2->pg_mua}} / {{$package2->pg_stylist}}</td>
      </tr>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <h5><b>Detail Lokasi</b></h5>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      @foreach($pglog as $key => $value)
      <tr>
        <td><small>Lokasi {{$key+1}} : {{$value->loc_name}} - {{$value->loc_addr}}</small></td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <h5><b>Harga</b></h5>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <tr>
        <td>Harga Paket ({{$durasiPaket->durasi_jam}} Jam)</td>
        <td>Rp. {{number_format($data->booking_price, 0, ',', '.')}}</td>
      </tr>
      <tr>
        <th>Total</th>
        <th>Rp. {{number_format($data->booking_total, 0, ',', '.')}}</th>
      </tr>
    </table>
  </div>
</div>