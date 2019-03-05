@extends('layouts.master-studio')
@section('title', 'Search Result')
@section('content')
       
<section class="innerpage-wrapper" >
    <div id="search-result-page" class="top-section-padding">
        <div class="container"></div>
    </div>
    
	<div id="hotel-listing" class="bottom-padding">
        <div class="container">
            
            <div class="col-sm-12 col-md-12 col-lg-12 content-side" style="margin-bottom: 15px;">
                <h3><span class="label label-success">{{$word}}</span></h3>
                @if(!empty($cek_studio_data))
                <h4>Search by <b>Partner</b></h4>
                @endif
                @foreach($studio_data as $list)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                        <div class="main-block hotel-block section-padding" >
                          <div class="main-img img-hover"style="outline:1px solid #C9CACA;;box-shadow: 5px 10px 8px #C9CACA;" >
                            @if(File::exists(public_path("logo/".$list->pr_logo.".jpg")))
                            <img src="{{ asset('logo/'.$list->pr_logo.'.jpg')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; height: 150px; width: auto; float: none; display: block;position: relative; " />
                            @elseif(File::exists(public_path("logo/".$list->pr_logo.".png")))
                            <img src="{{ asset('logo/'.$list->pr_logo.'.png')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; height: 150px; width: auto; float: none; display: block;position: relative; border-radius: 25%;" />
                            @elseif(File::exists(public_path("logo/".$list->pr_logo.".jpeg")))
                            <img src="{{ asset('logo/'.$list->pr_logo.'.jpeg')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; height: 150px; width: auto; float: none; display: block;position: relative; border-radius: 25%;" />
                            @elseif(File::exists(public_path("logo/".$list->pr_logo.".JPG")))
                            <img src="{{ asset('logo/'.$list->pr_logo.'.JPG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; height: 150px; width: auto; float: none; display: block;position: relative; " />
                            @elseif(File::exists(public_path("logo/".$list->pr_logo.".PNG")))
                            <img src="{{ asset('logo/'.$list->pr_logo.'.PNG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; height: 150px; width: auto; float: none; display: block;position: relative; border-radius: 25%;" />
                            @elseif(File::exists(public_path("logo/".$list->pr_logo.".JPEG")))
                            <img src="{{ asset('logo/'.$list->pr_logo.'.JPEG')  }}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; height: 150px; width: auto; float: none; display: block;position: relative; border-radius: 25%;" />
                            @else
                            <img src="{{ asset('dist/images/studio-foto.png')}}" class="img-responsive" alt="about-img" style="max-width: 100%; margin: 0 auto; height: 150px; width: auto; float: none; display: block;position: relative;" />
                            @endif
                          </div>
                          
                          <div class="main-info hotel-info" style="outline:1px solid #C9CACA;;box-shadow: 5px 10px 8px #C9CACA;">
                              <div class="main-title hotel-title">
                                  <p style="text-align: center; padding: 10px;"><b>{{$list->pr_name}}</b></p>
                                  <p style="text-align: center; padding-bottom: 10px;">SURABAYA</p>
                                  @if($list->pr_type == '1')
                                  <a href="{{ route('detail.fotostudio',['id' => $list->user_id]) }}" style="text-align: center; ">
                                        <input type="text" name="id" value="{{$list->user_id}}" hidden>
                                        <button type="submit" class="btn btn-orange btn-lg" style="float: none;margin: 0 auto; position: relative; display: flex;">View More</button>
                                  </a>
                                  @elseif($list->pr_type == '4')
                                  <a href="{{ route('detail.kebaya',['id' => $list->user_id]) }}" style="text-align: center; ">
                                        <input type="text" name="id" value="{{$list->user_id}}" hidden>
                                        <button type="submit" class="btn btn-orange btn-lg" style="float: none;margin: 0 auto; position: relative; display: flex;">View More</button>
                                  </a>
                                  @elseif($list->pr_type == '9')
                                  <a href="{{ route('detail.freespot',['id' => $list->user_id]) }}" style="text-align: center; ">
                                        <input type="text" name="id" value="{{$list->user_id}}" hidden>
                                        <button type="submit" class="btn btn-orange btn-lg" style="float: none;margin: 0 auto; position: relative; display: flex;">View More</button>
                                  </a>
                                  @endif
                                
                              </div>
                          </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 content-side section-padding" >
                @if(empty($cek_paket) && empty($cek_tag))
                @else
                <h4>Search by <b>Package</b></h4>
                @endif
                @foreach($allThemes as $data)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    @if($data->pkg_price_them == NULL)
                        @include('search-result.fotostudio.freepaket')
                    @else
                        @include('search-result.fotostudio.paket')
                    @endif
                </div>
                @endforeach
                @foreach($allThemes2 as $data)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    @include('search-result.fotostudio.paket')
                </div>
                @endforeach
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 content-side">
                @if(!empty($cek_kebaya_data))
                <h4>Search by <b>Busana Package</b></h4>
                @endif
                @foreach($kebaya_data as $data)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    @include('search-result.kebaya.paket')
                </div>
                @endforeach
            </div>
    	</div>
    </div>
</section>
@include('layouts.footer')
@endsection