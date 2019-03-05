@extends('layouts.app')
@section('title', 'Partner-Ku Profile')
@section('content')
@foreach($detail as $data)
<section class="page-cover section-padding" id="cover-hotel-detail" style="margin-top: 3.5%;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-12 col-md-2">
                <div id="abt-cnt-2-img">
                    @if(File::exists(public_path("logo/".$data->pr_logo.".jpg")))
                    <img src="{{ asset('logo/'.$data->pr_logo.'.jpg')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                    @elseif(File::exists(public_path("logo/".$data->pr_logo.".png")))
                    <img src="{{ asset('logo/'.$data->pr_logo.'.png')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                    @elseif(File::exists(public_path("logo/".$data->pr_logo.".jpeg")))
                    <img src="{{ asset('logo/'.$data->pr_logo.'.jpeg')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                    @elseif(File::exists(public_path("logo/".$data->pr_logo.".JPG")))
                    <img src="{{ asset('logo/'.$data->pr_logo.'.JPG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                    @elseif(File::exists(public_path("logo/".$data->pr_logo.".PNG")))
                    <img src="{{ asset('logo/'.$data->pr_logo.'.PNG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                    @elseif(File::exists(public_path("logo/".$data->pr_logo.".JPEG")))
                    <img src="{{ asset('logo/'.$data->pr_logo.'.JPEG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                    @else
                    <img src="{{asset('dist/images/spot-logo.png')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                    @endif
                </div>
              </div>
              <div class="col-sm-12 col-md-10">
                <br><br>  
                <h1 class="page-title">{{$data->pr_name}}</h1>
                <!--@if(Auth::check())-->
                <!--<ul class="breadcrumb">-->
                <!--    <li class="active">{{$data->pr_addr}}, {{$data->pr_kel}}, {{$kecamatan->name}}, {{$kota->name}}, {{$provinsi->name}}, {{$data->pr_postal_code}}</li>-->
                <!--</ul>-->
                <!--@endif-->
              </div>
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end page-cover -->

<section id="studio" class="section-padding">
            <!-- <div class="container"> -->
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
                                </div><!-- end page-heading -->
                                
                                <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-portofolio">
                                    @foreach($album as $listalbum)
                                        @if(!empty($listalbum->album_img_1))
                                        <div class="item">
                                            <div class="main-block hotel-block ">
                                                <div class=" main-img img-hover ">
                                                    @if(File::exists(public_path("album/".$listalbum->album_img_1.".jpg")))
                                                    <a href="{{ asset('album/'.$listalbum->album_img_1.'.jpg')  }}" title="image-1" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_1.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @elseif(File::exists(public_path("album/".$listalbum->album_img_1.".png")))
                                                    <a href="{{ asset('album/'.$listalbum->album_img_1.'.png')  }}" title="image-1" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('album/'.$listalbum->album_img_1.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @elseif(File::exists(public_path("album/".$listalbum->album_img_1.".jpeg")))
                                                    <a href="{{ asset('album/'.$listalbum->album_img_1.'.jpeg')  }}" title="image-1" class="with-caption gallery image-link">
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
                                </div><!-- end owl-hotel-offers -->
                            </div><!-- end columns -->
                    </section><!-- end hotel-offers -->                           
                </div>
            </div>
                 
            <div class="col-sm-6 col-md-6">
                @if(!empty($allspot[0])) 
                <section id="alacarte-offers" class="">
                    <div class="col-lg-12">
                        <div class="page-heading">
                            <h2 style="font-family: 'Italianno', cursive; font-size: 50px; background: linear-gradient(#FFBD54, #FF6E6D);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;">Spot Foto</h2>
                            <hr class="heading-line" />
                        </div>
                        <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-alacarte-offers">
                          <!-- <ul class="list-unstyled list-inline offer-price-1"> -->
                          @foreach($allspot as $listthem)    
                            <!-- <li class="price"> -->
                                @include('partner-profile.freespot.paket')
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