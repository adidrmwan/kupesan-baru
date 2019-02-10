<div class="card">
    <div class="header">
        <h4 class="title">Event</h4>
        <small>Upcoming Event</small>
    </div>
    <div class="content">
        <h3>There is no event..</h3>
    </div>
</div>

<div class="card">
    <div class="header">
        <h4 class="title">Your Booking List</h4>
        <small>Please approve or cancel this booking quickly..</small>
    </div>
    <div class="content">
        <table class="table table-bordered table-striped table-responsive" id="list-package2">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Pemesanan</th>
              <th>Waktu Pemesanan</th>
              <th>Nama Paket</th>
              <th>Harga Paket (Rp)</th>
              <th>Total (Rp)</th>
              <th>Cancel</th>
              <th>Approve</th>
              <th>Tanggal Memesan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($booking_unapprove as $key => $value)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{date('l, d M Y', strtotime($value->start_date))}}</td>
              <td>{{date('H:i A', strtotime($value->start_date))}}</td>
              <td>{{$value->pg_name}}</td>
              <td>{{number_format($value->booking_price,0,',','.')}}</td>
              <td>{{number_format($value->booking_total,0,',','.')}}</td>
              <td>  
                <a href="{{route('pg.partner.cancel.booking', ['id' => $value->booking_id])}}">
                  <button type="submit" class="btn btn-danger btn-xs" style=" padding: 3px 15px;"><span style="color: white; text-decoration: none;" onclick="return confirm('Are you sure want to cancel?')">Cancel</span>
                  </button>
                </a>
              </td> 
              <td>
                <a href="{{route('pg.partner.approve.booking', ['id' => $value->booking_id])}}">
                  <button type="submit" class="btn btn-success btn-xs" style=" padding: 3px 15px;"><span style="color: white; text-decoration: none;" onclick="return confirm('Are you sure want to approve?')">Approve</span>
                  </button>
                </a>
              </td>
              <td>{{date('l, d M Y H:i:s A', strtotime($value->updated_at))}}</td>
            </tr> 
            @endforeach 
          </tbody>
        </table>
    </div>
</div>
