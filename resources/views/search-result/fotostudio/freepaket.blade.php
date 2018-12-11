<div class="main-block flight-block" style="box-shadow: 5px 10px 8px #C9CACA;">
    <div class="frame" style="outline: 1px solid #C9CACA;;" >
        <div class="img-hover" >
            

                    @if(File::exists(public_path("img_pkg/".$data->pkg_img_them.".jpg")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pkg_img_them.'.jpg')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pkg_img_them.'.jpg')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;" />
            </a>
        </div>
        <div class="img-hover" >
            
                    @elseif(File::exists(public_path("img_pkg/".$data->pkg_img_them.".jpeg")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pkg_img_them.'.jpeg')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pkg_img_them.'.jpeg')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;"/>
            </a>
        </div>
        <div class="img-hover" >
            
                    @elseif(File::exists(public_path("img_pkg/".$data->pkg_img_them.".png")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pkg_img_them.'.png')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pkg_img_them.'.png')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;" />
            </a>
        </div>
        <div class="img-hover" >
            
                    @elseif(File::exists(public_path("img_pkg/".$data->pkg_img_them.".JPG")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pkg_img_them.'.JPG')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pkg_img_them.'.JPG')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;" />
            </a>
        </div>
        <div class="img-hover" >
            
                    @elseif(File::exists(public_path("img_pkg/".$data->pkg_img_them.".JPEG")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pkg_img_them.'.JPEG')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pkg_img_them.'.JPEG')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;" />
            </a>
        </div>
        <div class="img-hover" >
            
                    @elseif(File::exists(public_path("img_pkg/".$data->pkg_img_them.".PNG")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pkg_img_them.'.PNG')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pkg_img_them.'.PNG')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;" />
                    @endif
            </a>
        </div>
        <!--<div class = "details" >-->
        <!--    <br>-->
        <!--    <br>-->
        <!--    <p style="text-align:center; color: white;">-->
        <!--        <b>Type :</b> {{$data->pkg_category_them}} <br>-->
        <!--        <b>Photografer :</b> {{$data->pkg_fotografer}}   <br>-->
        <!--        <b>Print Size :</b> {{$data->pkg_print_size}} <b>R</b><br> -->
        <!--        <b>Edited Photo :</b> {{$data->pkg_edited_photo}} <b>Photo</b><br>-->
        <!--        <b>Frame :</b> {{$data->pkg_frame}}<br>-->
        <!--        <b>Capacity :</b> {{$data->pkg_capacity}} <b>Person</b>-->
        <!--    </p>-->
        <!--</div>-->
    </div>
    
    
    <div class="flight-info" style="outline:1px solid grey; ">
        <div class="flight-title" style="text-align: center;">
            <h3 class="text-uppercase" style="font-size:15px;">{{$data->partner_name}}</h3>
        </div><!-- end flight-title -->
        
        <ul class="list-unstyled list-inline offer-price-1">
            <li class="price">{{$data->pkg_name_them}}</li><br>
            <li>
                <span class="btn btn-success" style=" padding: 5px 15px; margin-top: 6px;"><span style="color: white; text-decoration: none;">Free</span></span>
            </li><br>
            <li >
                <a href="{{ route('detail.freespot',['id' => $data->user_id]) }}">
                    <button type="submit" class="btn btn-pink" style=" padding: 5px 15px; margin-top: 6px;"><span style="color: white; text-decoration: none;">View More</span>
                    </button>
                </a>
            </li>
        </ul>
    </div>
</div>