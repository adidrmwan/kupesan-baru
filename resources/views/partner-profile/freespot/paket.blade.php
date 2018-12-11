<div class="item col-md-12 col-sm-12" style="padding: 10px;">
  <div class="main-block hotel-block " style="outline:1px solid #C9CACA;;box-shadow: 5px 10px 8px #C9CACA;">
      <div class="main-img img-hover" style="height: 150px;">
          
            @if(File::exists(public_path("img_pkg/".$listthem->pkg_img_them.".jpg")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.jpg')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.jpg')  }}" id="myImg" alt= "Package Image"  />
              </a>
            @elseif(File::exists(public_path("img_pkg/".$listthem->pkg_img_them.".jpeg")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.jpeg')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.jpeg')  }}" id="myImg" alt= "Package Image"  />
              </a>
            @elseif(File::exists(public_path("img_pkg/".$listthem->pkg_img_them.".png")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.png')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.png')  }}" id="myImg" alt= "Package Image" />
              </a>
            @elseif(File::exists(public_path("img_pkg/".$listthem->pkg_img_them.".JPG")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.JPG')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.JPG')  }}" id="myImg" alt= "Package Image" />
              </a>
            @elseif(File::exists(public_path("img_pkg/".$listthem->pkg_img_them.".JPEG")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.JPEG')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.JPEG')  }}" id="myImg" alt= "Package Image" />
              </a>
            @elseif(File::exists(public_path("img_pkg/".$listthem->pkg_img_them.".PNG")))
            <a class="image-popup-fit-width" href="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.PNG')  }}" >
              <img style="height: auto; width: auto; margin: 0 auto; float: none;display: block;position: relative;" class="img-responsive" src="{{ URL::asset('img_pkg/'.$listthem->pkg_img_them.'.PNG')  }}" id="myImg" alt= "Package Image" />
              </a>
              @endif
          
          <div class="main-mask">
            <ul class="list-unstyled list-inline offer-price-1" style="text-align:center;">
                <li class="price" style="color: white;">{{$listthem->pkg_name_them}}</li>
            </ul>
          </div>
      </div>
      
      <div class="main-info hotel-info">
          <div class="main-title hotel-title">
            <a href="{{route('detail.paket.spot', ['id' => $listthem->id])}}">
              <button type="submit" class="btn btn-orange" style=" padding: 5px 15px; margin:0 auto; position:relative; float:none; display:block; margin-top:10px;"><span style="color: white; text-decoration: none;">View More</span>
              </button>
            </a>
            
          </div>
      </div>
  </div>
</div>