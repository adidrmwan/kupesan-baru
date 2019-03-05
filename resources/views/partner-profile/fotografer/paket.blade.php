<div class="item col-md-12 col-sm-12" style="padding: 10px; margin-bottom: 30px;">
  <div class="main-block hotel-block " style="outline:1px solid #C9CACA;;box-shadow: 5px 10px 8px #C9CACA;">
      <div class="main-img img-hover">
          
            @if(File::exists(public_path("img_pkg/".$listthem->pg_img_1.".jpg")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.jpg')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.jpg')  }}" id="myImg" alt= "Package Image"  />
              </a>
            @elseif(File::exists(public_path("img_pkg/".$listthem->pg_img_1.".jpeg")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.jpeg')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.jpeg')  }}" id="myImg" alt= "Package Image"  />
              </a>
            @elseif(File::exists(public_path("img_pkg/".$listthem->pg_img_1.".png")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.png')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.png')  }}" id="myImg" alt= "Package Image" />
              </a>
            @elseif(File::exists(public_path("img_pkg/".$listthem->pg_img_1.".JPG")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.JPG')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.JPG')  }}" id="myImg" alt= "Package Image" />
              </a>
            @elseif(File::exists(public_path("img_pkg/".$listthem->pg_img_1.".JPEG")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.JPEG')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.JPEG')  }}" id="myImg" alt= "Package Image" />
              </a>
            @elseif(File::exists(public_path("img_pkg/".$listthem->pg_img_1.".PNG")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.PNG')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pg_img_1.'.PNG')  }}" id="myImg" alt= "Package Image" />
              </a>
              @endif
          
          <div class="main-mask">
            <ul class="list-unstyled list-inline offer-price-1" style="text-align:center;">
                <li class="price" style="color: white;">{{$listthem->pg_name}}</li>
            </ul>
          </div>
      </div>
      
      <div class="main-info hotel-info">
          <div class="main-title hotel-title">
            @if(Auth::check())  
            <p style="text-align:center;"><span>Rp</span>&nbsp;&nbsp;{{number_format($listthem->pkg_price_them, 0, ',', '.')}} / Paket </p>
            @endif
            <a href="{{route('pg.step1', ['package_id' => $listthem->id])}}">
              <button type="submit" class="btn btn-pink" style=" padding: 5px 15px; margin:0 auto; position:relative; float:none; display:block; margin-top:10px;"><span style="color: white; text-decoration: none;">Pesan</span>
              </button>
            </a>
            
          </div>
      </div>
  </div>
</div>