<div class="card">
  <div class="row">
    <div class="col-md-12">
      <div class="header">
        <h4 class="title" style="text-align: center;">{{$data->pg_name}}</h4>
      </div>
      <div class="content">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            @if(File::exists(public_path("img_pkg/".$data->pg_img_1.".jpg")))
            <img style="height: auto; width: 150px; margin: 0 auto; float: none; position: relative;display: flex;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.jpg')  }}" alt= "Package Image" />
            @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".jpeg")))
            <img style="height: auto; width: 150px; margin: 0 auto; float: none; position: relative;display: flex;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.jpeg')  }}" alt= "Package Image" />
            @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".png")))
            <img style="height: auto; width: 150px; margin: 0 auto; float: none; position: relative;display: flex;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.png')  }}" alt= "Package Image" />
            @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".JPG")))
            <img style="height: auto; width: 150px; margin: 0 auto; float: none; position: relative;display: flex;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.JPG')  }}" alt= "Package Image" />
            @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".JPEG")))
            <img style="height: auto; width: 150px; margin: 0 auto; float: none; position: relative;display: flex;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.JPEG')  }}" alt= "Package Image" />
            @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".PNG")))
            <img style="height: auto; width: 150px; margin: 0 auto; float: none; position: relative;display: flex;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.PNG')  }}" alt= "Package Image" />
            @endif
          </div>
          <div class="col-sm-12 col-md-12" style="padding: 25px;">
            <table class="table">
              <tbody>
                <tr>
                    <td style="text-align: left;">MUA</td>
                    <td style="text-align: right;">{{$data->pg_mua}}</td>
                </tr>
                <tr>
                    <td style="text-align: left;">Stylist</td>
                    <td style="text-align: right;">{{$data->pg_stylist}}</td>
                </tr>
                    @if(Auth::check())
                <tr>
                    <td style="text-align: left;">Price (1 Day)</td>
                    <td style="text-align: right;">
                        <p>Rp {{number_format($durasiPaket->durasi_harga,0,',','.')}}<br>({{$durasiPaket->durasi_jam}} Hour)</p>
                    </td>
                </tr>
                    @else
                <tr>
                    <td style="text-align: left;" colspan="2">Price (Full Day)</td>
                </tr>
                <tr>
                    <td style="text-align: center;" colspan="2"><small>Harga dapat dilihat jika sudah melakukan login</small></td>
                </tr>
                    @endif
                    <td style="text-align: left;">Location</td>
                    <td style="text-align: right;">Max {{$data->pg_location_jumlah}} Location</td>
                </tr>
                <tr>
                    @if($data->pg_album_kolase == 'Include')
                    <td style="text-align: left;" colspan="2">Exclusive Album</td>
                    @else
                    <td style="text-align: left;">Exclusive Album</td>
                    <td style="text-align: right;">Exclude</td>
                    @endif
                </tr>
                @if($data->pg_album_kolase == 'Include')
                <tr>
                    <td colspan="2" ><small>Include. ({{$data->pg_album_ukuran}} cm, {{$data->pg_album_jumlah_foto}} Photos, {{$data->pg_album_jumlah_hal}} Sheets)</small></td>
                </tr>
                @endif
                <tr>
                    @if($data->pg_printed == 'Include')
                    <td style="text-align: left;" colspan="2">Printed Photo</td>
                    @else
                    <td style="text-align: left;">Printed Photo</td>
                    <td style="text-align: right;">Exclude</td>
                    @endif
                </tr>
                @if($data->pg_printed == 'Include')
                <tr>
                    <td colspan="2"><small>Include. ({{$data->pg_printed_size}}, {{$data->pg_printed_jumlah}} Photos @if($data->pg_album_jumlah_frame == 'Include') + Frame
                    @endif)</small>
                    </td>
                </tr>
                @endif
                <tr>
                    @if($data->pg_edited == 'Include')
                    <td style="text-align: left;" colspan="2">Edited Photo</td>
                    @else
                    <td style="text-align: left;">Edited Photo</td>
                    <td style="text-align: right;">Exclude</td>
                    @endif
                </tr>
                @if($data->pg_edited == 'Include')
                <tr>
                    <td colspan="2"><small>Include. ({{$data->pg_edited_jumlah}} Photos, {{$data->pg_edited_saved}})</small>
                    </td>
                </tr>
                @endif
                <tr></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>