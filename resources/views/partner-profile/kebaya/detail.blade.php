@extends('layouts.app')
@section('title', 'Partner-Ku Profile')
@section('content')
@foreach($detail as $data)
<section class="page-cover section-padding" id="cover-hotel-detail" style="margin-top: 4.5%;">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="col-sm-12 col-md-2">
          <div id="abt-cnt-2-img">
              @if(File::exists(public_path("logo/".$data->pr_logo.".jpg")))
              <img src="{{ asset('logo/'.$data->pr_logo.'.jpg')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; height: 180px; 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
              @elseif(File::exists(public_path("logo/".$data->pr_logo.".png")))
              <img src="{{ asset('logo/'.$data->pr_logo.'.png')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; height: 180px; 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
              @elseif(File::exists(public_path("logo/".$data->pr_logo.".jpeg")))
              <img src="{{ asset('logo/'.$data->pr_logo.'.jpeg')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; height: 180px; 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
              @elseif(File::exists(public_path("logo/".$data->pr_logo.".JPG")))
              <img src="{{ asset('logo/'.$data->pr_logo.'.JPG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; height: 180px; 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
              @elseif(File::exists(public_path("logo/".$data->pr_logo.".PNG")))
              <img src="{{ asset('logo/'.$data->pr_logo.'.PNG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; height: 180px; 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
              @elseif(File::exists(public_path("logo/".$data->pr_logo.".JPEG")))
              <img src="{{ asset('logo/'.$data->pr_logo.'.JPEG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; height: 180px; 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
              @else
              <img src="{{ asset('dist/images/busana-logo.png')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; height: 180px; 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
              @endif
          </div>
        </div>
        <div class="col-sm-12 col-md-10">
          <br><br>  
          <h1 class="page-title">{{$data->pr_name}}</h1>
          @if(Auth::check())
          <ul class="breadcrumb">
              <li class="active">{{$data->pr_addr}}, {{$data->pr_kel}}, {{$kecamatan->name}}, {{$kota->name}}, {{$provinsi->name}}, {{$data->pr_postal_code}}</li>
          </ul>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

<section id="studio" class="section-padding">
  <div class="row">
    <div class="col-sm-1 col-md-1"></div>
    <div class="col-sm-4 col-md-4">
      <div class="row">
        <section id="thematic-offers" class="">
          <div class="col-sm-12">
            <div class="page-heading">
              <h2 style="font-family: 'Italianno', cursive; font-size: 50px; background: linear-gradient(#FFBD54, #FF6E6D);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;">Portofolio</h2>
              <hr class="heading-line" />
            </div>
            <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-portofolio">
              @foreach($album as $listalbum)
                    @if(!empty($listalbum->album_img_1))
                    <div class="item">
                        <div class="main-block hotel-block ">
                            <div class=" main-img img-hover ">
                                @if(File::exists(public_path("album/".$listalbum->album_img_1.".jpg")))
                                <a href="{{ asset('album/'.$listalbum->album_img_1.'.jpg')  }}" title="image-2" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_1.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @elseif(File::exists(public_path("album/".$listalbum->album_img_1.".png")))
                                <a href="{{ asset('album/'.$listalbum->album_img_1.'.png')  }}" title="image-2" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_1.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @elseif(File::exists(public_path("album/".$listalbum->album_img_1.".jpeg")))
                                <a href="{{ asset('album/'.$listalbum->album_img_1.'.jpeg')  }}" title="image-2" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_1.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @endif
                            </div>
                        </div><!-- end hotel-block -->
                    </div><!-- end item -->
                    @endif
                    @if(!empty($listalbum->album_img_2))
                    <div class="item">
                        <div class="main-block hotel-block ">
                            <div class=" main-img img-hover">
                                @if(File::exists(public_path("album/".$listalbum->album_img_2.".jpg")))
                                <a href="{{ asset('album/'.$listalbum->album_img_2.'.jpg')  }}" title="image-2" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_2.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @elseif(File::exists(public_path("album/".$listalbum->album_img_2.".png")))
                                <a href="{{ asset('album/'.$listalbum->album_img_2.'.png')  }}" title="image-2" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_2.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @elseif(File::exists(public_path("album/".$listalbum->album_img_2.".jpeg")))
                                <a href="{{ asset('album/'.$listalbum->album_img_2.'.jpeg')  }}" title="image-2" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_2.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @endif
                            </div>
                        </div><!-- end hotel-block -->
                    </div><!-- end item -->
                    @endif
                    @if(!empty($listalbum->album_img_3))
                    <div class="item">
                        <div class="main-block hotel-block ">
                            <div class=" main-img img-hover">
                                @if(File::exists(public_path("album/".$listalbum->album_img_3.".jpg")))
                                <a href="{{ asset('album/'.$listalbum->album_img_3.'.jpg')  }}" title="image-3" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_3.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @elseif(File::exists(public_path("album/".$listalbum->album_img_3.".png")))
                                <a href="{{ asset('album/'.$listalbum->album_img_3.'.png')  }}" title="image-3" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_3.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @elseif(File::exists(public_path("album/".$listalbum->album_img_3.".jpeg")))
                                <a href="{{ asset('album/'.$listalbum->album_img_3.'.jpeg')  }}" title="image-3" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_3.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @elseif(File::exists(public_path("album/".$listalbum->album_img_3.".JPG")))
                                <a href="{{ asset('album/'.$listalbum->album_img_3.'.JPG')  }}" title="image-3" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_3.'.JPG')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @elseif(File::exists(public_path("album/".$listalbum->album_img_3.".JPEG")))
                                <a href="{{ asset('album/'.$listalbum->album_img_3.'.JPEG')  }}" title="image-3" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_3.'.JPEG')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @elseif(File::exists(public_path("album/".$listalbum->album_img_3.".PNG")))
                                <a href="{{ asset('album/'.$listalbum->album_img_3.'.PNG')  }}" title="image-3" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_3.'.PNG')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @endif
                          </div>
                        </div><!-- end hotel-block -->
                    </div><!-- end item -->
                    @endif
                    @if(!empty($listalbum->album_img_4))
                    <div class="item">
                        <div class="main-block hotel-block ">
                            <div class=" main-img img-hover">
                                @if(File::exists(public_path("album/".$listalbum->album_img_4.".jpg")))
                                <a href="{{ asset('album/'.$listalbum->album_img_4.'.jpg')  }}" title="image-4" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_4.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @elseif(File::exists(public_path("album/".$listalbum->album_img_4.".png")))
                                <a href="{{ asset('album/'.$listalbum->album_img_4.'.png')  }}" title="image-4" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_4.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @elseif(File::exists(public_path("album/".$listalbum->album_img_4.".jpeg")))
                                <a href="{{ asset('album/'.$listalbum->album_img_4.'.jpeg')  }}" title="image-4" class="with-caption gallery image-link">
                                <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_4.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                </a>
                                @endif
                            </div>
                        </div><!-- end hotel-block -->
                    </div><!-- end item -->
                    @endif
                @endforeach
            </div>
          </div>
        </section>
        <!-- <div class="col-sm-12 col-md-12">
            <div class="page-heading white-heading">
              <h3>Feature / Amenities</h3>
            </div>
            <div class="row">
              @foreach($fasilitas as $listfasil)
              @if(!empty($listfasil->wifi))  
              <div class="col-xs-6 col-md-4">
                <div style="text-align: center;" >
                  <span ><i class="zmdi zmdi-wifi-alt zmdi-hc-5x "></i></span>
                  <h5 style="text-align: center;">Wifi</h5>
                </div>
              </div>
              @else
              @endif
              @if(!empty($listfasil->toilet))
              <div class="col-xs-6 col-md-4">
                <div style="text-align: center;" >
                  <span><i class="zmdi zmdi-male-female zmdi-hc-5x "></i></span>
                  <h5 style="text-align: center;">Toilet</h5>
                </div>
              </div>
              @else
              @endif
              @if(!empty($listfasil->parkir))
              <div class="col-xs-6 col-md-4">
                <div style="text-align: center;">
                  <span><i class="zmdi zmdi-local-parking zmdi-hc-5x "></i></span> 
                  <h5 style="text-align: center;">Parkir</h5>
                </div>
              </div>
              @else
              @endif
              @if(!empty($listfasil->rganti))
              <div class="col-xs-6 col-md-4">
                <div style="text-align: center;">
                  <span ><i class="fa fa-exchange fa-5x fa-fw"></i></span>
                  <h5 style="text-align: center;">Ruang Ganti</h5>
                </div>
              </div>
              @else
              @endif
              @if(!empty($listfasil->ac))
              <div class="col-xs-6 col-md-4">
                <div style="text-align: center;">
                  <span><i class="fa fa-snowflake-o fa-5x fa-fw"></i></span>
                   <h5 style="text-align: center;">AC</h5>
                </div>
              </div>
              @else
              @endif
              @endforeach
            </div>
        </div>   -->  
        <div class="col-sm-12 col-md-12">
          <div class="page-heading white-heading">
            <h3 style="font-family: 'Italianno', cursive; font-size: 50px; background: linear-gradient(#FFBD54, #FF6E6D);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;">Rules</h3>
          </div>
          <div class="row">
            <table class="table">
                @foreach($tnc as $key => $data)
                <tr>
                  <td><b>{{$key + 1}}</b></td>
                  <td><p>{{$data->tnc_desc}}</p></td>
                </tr>
                @endforeach
            </table>
          </div>
        </div>                           
      </div>
    </div>
    <div class="col-sm-6 col-md-6">
    @if(!empty($setelan[0])) 
      <section id="setelan-offers" class="">
        <div class="col-lg-12">
            <div class="page-heading">
              <h2 style="font-family: 'Italianno', cursive; font-size: 50px; background: linear-gradient(#FFBD54, #FF6E6D);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;">Setelan</h2>
              <hr class="heading-line" />
            </div>
            <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-setelan-offers">
              <!-- <ul class="list-unstyled list-inline offer-price-1"> -->
              @foreach($setelan as $listthem)    
                <!-- <li class="price">  -->
                    @include('partner-profile.kebaya.paket')
                <!-- </li> -->
              @endforeach
              <!-- </ul> -->
            </div>
        </div>
      </section>
    @endif
    @if(!empty($atasan[0])) 
      <section id="atasan-offers" class="">
        <div class="col-lg-12">
            <div class="page-heading">
                <h2 style="font-family: 'Italianno', cursive; font-size: 50px; background: linear-gradient(#FFBD54, #FF6E6D);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;">Atasan</h2>
                <hr class="heading-line" />
            </div>
            <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-atasan-offers">
              <!-- <ul class="list-unstyled list-inline offer-price-1"> -->
                @foreach($atasan as $listthem)    
                <!-- <li class="price">    -->
                    @include('partner-profile.kebaya.paket')                                             
                <!-- </li> -->
                @endforeach
            </div>
        </div>
      </section>
    @endif
    @if(!empty($bawahan[0])) 
      <section id="bawahan-offers" class="">
        <div class="col-lg-12">
          <div class="page-heading">
            <h2 style="font-family: 'Italianno', cursive; font-size: 50px; background: linear-gradient(#FFBD54, #FF6E6D);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;">Bawahan</h2>
            <hr class="heading-line" />
          </div>
          <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-bawahan-offers">
            <!-- <ul class="list-unstyled list-inline offer-price-1"> -->
            @foreach($bawahan as $listthem)    
              <!-- <li class="price"> -->
                @include('partner-profile.kebaya.paket')
              <!-- </li> -->
            @endforeach
            <!-- </ul> -->
          </div>
        </div>
      </section>
    @endif
    </div>
  </div>
</section>

@endforeach
@include('layouts.footer')
@endsection