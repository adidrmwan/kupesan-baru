@extends('layouts.app')
@section('title', 'Partner-Ku Profile')
@section('content')
<section class="page-cover section-padding" id="cover-hotel-detail" style="margin-top: 3.5%;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-12 col-md-2">
                <div id="abt-cnt-2-img">
                        @if(File::exists(public_path("logo/".$partner->pr_logo.".jpg")))
                        <img src="{{ asset('logo/'.$partner->pr_logo.'.jpg')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                        @elseif(File::exists(public_path("logo/".$partner->pr_logo.".png")))
                        <img src="{{ asset('logo/'.$partner->pr_logo.'.png')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                        @elseif(File::exists(public_path("logo/".$partner->pr_logo.".jpeg")))
                        <img src="{{ asset('logo/'.$partner->pr_logo.'.jpeg')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                        @elseif(File::exists(public_path("logo/".$partner->pr_logo.".JPG")))
                        <img src="{{ asset('logo/'.$partner->pr_logo.'.JPG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                        @elseif(File::exists(public_path("logo/".$partner->pr_logo.".PNG")))
                        <img src="{{ asset('logo/'.$partner->pr_logo.'.PNG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                        @elseif(File::exists(public_path("logo/".$partner->pr_logo.".JPEG")))
                        <img src="{{ asset('logo/'.$partner->pr_logo.'.JPEG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                        @else
                        <img src="{{asset('dist/images/spot-logo.png')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
                        @endif
                </div>
              </div>
              <div class="col-sm-12 col-md-10">
                <br><br>  
                <h1 class="page-title text-capitalize">{{$package2->pkg_name_them}}</h1>
                <ul class="breadcrumb">
                    <li class="active text-capitalize">{{$address2->pr_addr}}, {{$address2->pr_kel}}, {{$kecamatan->name}}, {{$kota->name}}, {{$provinsi->name}}, {{$address2->pr_postal_code}}</li>
                </ul>
              </div>
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end page-cover -->

<section id="studio" class="section-padding bottom-padding">
            <!-- <div class="container"> -->
      <div class="row">
        <div class="col-sm-1 col-md-1"></div>
            <div class="col-sm-4 col-md-4">
                <div class="row">
                    <section id="thematic-offers" class="">
                            <div class="col-sm-12">
                                <div class="page-heading">
                                    <h2 style="font-family: 'Italianno', cursive; font-size: 50px; background: linear-gradient(#FE9321, #FF6E6D);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;">Portofolio</h2>
                                    <hr class="heading-line" />
                                </div><!-- end page-heading -->
                                
                                <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-portofolio">
                                    @foreach($package as $listalbum)
                                        @if(!empty($listalbum->pkg_img_them))
                                        <div class="item">
                                            <div class="main-block hotel-block ">
                                                <div class=" main-img img-hover ">
                                                    @if(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them.".jpg")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them.'.jpg')  }}" title="image-1" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @elseif(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them.".png")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them.'.png')  }}" title="image-1" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @elseif(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them.".jpeg")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them.'.jpeg')  }}" title="image-1" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @endif
                                                </div>
                                            </div><!-- end hotel-block -->
                                        </div><!-- end item -->
                                        @endif
                                        @if(!empty($listalbum->pkg_img_them2))
                                        <div class="item">
                                            <div class="main-block hotel-block ">
                                                <div class=" main-img img-hover">
                                                    @if(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them2.".jpg")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them2.'.jpg')  }}" title="image-2" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them2.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @elseif(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them2.".png")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them2.'.png')  }}" title="image-2" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them2.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @elseif(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them2.".jpeg")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them2.'.jpeg')  }}" title="image-2" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them2.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @endif
                                                </div>
                                            </div><!-- end hotel-block -->
                                        </div><!-- end item -->
                                        @endif
                                        @if(!empty($listalbum->pkg_img_them3))
                                        <div class="item">
                                            <div class="main-block hotel-block ">
                                                <div class=" main-img img-hover">
                                                    @if(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them3.".jpg")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them3.'.jpg')  }}" title="image-3" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them3.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @elseif(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them3.".png")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them3.'.png')  }}" title="image-3" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them3.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @elseif(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them3.".jpeg")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them3.'.jpeg')  }}" title="image-3" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them3.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @endif
                                              </div>
                                            </div><!-- end hotel-block -->
                                        </div><!-- end item -->
                                        @endif
                                        @if(!empty($listalbum->pkg_img_them4))
                                        <div class="item">
                                            <div class="main-block hotel-block ">
                                                <div class=" main-img img-hover">
                                                    @if(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them4.".jpg")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them4.'.jpg')  }}" title="image-4" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them4.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @elseif(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them4.".png")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them4.'.png')  }}" title="image-4" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them4.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
                                                    </a>
                                                    @elseif(File::exists(public_path("img_pkg/".$listalbum->pkg_img_them4.".jpeg")))
                                                    <a href="{{ asset('img_pkg/'.$listalbum->pkg_img_them4.'.jpeg')  }}" title="image-4" class="with-caption gallery image-link">
                                                    <img style="width: 500px; height: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$listalbum->pkg_img_them4.'.jpg')  }}" alt= "Album / Portofolio Bisnis" />
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
                    
                    <div class="col-sm-12 col-md-12">
                        <div class="page-heading white-heading">
                          <h3 style="font-family: 'Italianno', cursive; font-size: 50px; background: linear-gradient(#FE9321, #FF6E6D);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;">Feature / Amenities</h3>
                        </div>
                        <div class="row">
                          @foreach($fasilitas as $listfasil)
                          @if(!empty($listfasil->wifi))  
                          <div class="col-xs-6 col-md-4">
                            <img style="height:100px; width: auto; position:relative; margin: 0 auto; float: none; display:block;" class="img-responsive" src="{{ asset('dist/images/amenities/wifi.png')  }}"alt= "amenities" />
                          </div>
                          @endif
                          @if(!empty($listfasil->toilet))
                          <div class="col-xs-6 col-md-4">
                            <img style="height:100px; width: auto; position:relative; margin: 0 auto; float: none; display:block;" class="img-responsive" src="{{ asset('dist/images/amenities/toilet.png')  }}"alt= "amenities" />
                          </div><!-- end columns -->
                          @endif
                          @if(!empty($listfasil->parkir))
                          <div class="col-xs-6 col-md-4">
                            <img style="height:100px; width: auto; position:relative; margin: 0 auto; float: none; display:block;" class="img-responsive" src="{{ asset('dist/images/amenities/parking.png')  }}"alt= "amenities" />
                          </div><!-- end columns -->
                          @endif
                          @if(!empty($listfasil->rganti))
                          <div class="col-xs-6 col-md-4">
                            <img style="height:100px; width: auto; position:relative; margin: 0 auto; float: none; display:block;" class="img-responsive" src="{{ asset('dist/images/amenities/dressroom.png')  }}"alt= "amenities" />
                          </div><!-- end columns -->
                          @endif
                          @if(!empty($listfasil->ac))
                          <div class="col-xs-6 col-md-4">
                            <img style="height:100px; width: auto; position:relative; margin: 0 auto; float: none; display:block;" class="img-responsive" src="{{ asset('dist/images/amenities/ac.png')  }}"alt= "amenities" />
                          </div><!-- end columns -->
                          @endif
                          @endforeach
                        </div>
                    </div>  
                    
                </div>
            </div>
                 
            <div class="col-sm-6 col-md-6">
                <div class="col-sm-12 col-md-12">
                    <div class="page-heading white-heading">
                      <h3 style="font-family: 'Italianno', cursive; font-size: 50px; background: linear-gradient(#FE9321, #FF6E6D);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;">Description</h3>
                    </div>
                    @include('partner-profile.freespot.spot.paket')
                    
                </div>
                @if(!empty($spack[0])) 
                <section id="alacarte-offers" class="">
                    <div class="col-lg-12">
                        <div class="page-heading">
                            <h2>SPECIAL PACKAGE </h2>
                            <hr class="heading-line" />
                        </div>
                        <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-alacarte-offers">
                          <!-- <ul class="list-unstyled list-inline offer-price-1"> -->
                          @foreach($spack as $listthem)    
                            <!-- <li class="price"> -->
                                @include('partner-profile.fotostudio.paket')
                            <!-- </li> -->
                            @endforeach
                          <!-- </ul> -->
                        </div>
                    </div>
                </section>
                @endif
                
                @if(!empty($studio[0])) 
                <section id="special-offers" class="">
                    <div class="col-lg-12">
                        <div class="page-heading">
                            <h2>SPECIAL STUDIO</h2>
                            <hr class="heading-line" />
                        </div><!-- end page-heading -->
                        
                        <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-special-offers">
                              <!-- <ul class="list-unstyled list-inline offer-price-1"> -->
                              @foreach($studio as $listthem)    
                                <!-- <li class="price"> -->
                                  @include('partner-profile.fotostudio.paket')
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
@include('layouts.footer')
@endsection