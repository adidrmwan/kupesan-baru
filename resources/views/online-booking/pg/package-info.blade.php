<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 side-bar left-side-bar">
    <div class="row">
    
        <div class="col-xs-12 col-sm-6 col-md-12">
            <div class="side-bar-block detail-block style2 text-center">
                <div class="col-xs-12 col-sm-6 col-md-12">
                    <div class="side-bar-block detail-block style2 text-center">
                        @foreach($package as $data)
                        <div class="detail-slider" style="padding-bottom: 20px;">
                          <div class="feature-slider">
                              <div> 
                                    @if(File::exists(public_path("img_pkg/".$data->pg_img_1.".jpg")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.jpg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".jpeg")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.jpeg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".png")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.png')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".JPG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.JPG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".JPEG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.JPEG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".PNG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.PNG')  }}" alt= "Package Image" />
                                    @endif
                              </div>
                              <div>
                                    @if(File::exists(public_path("img_pkg/".$data->pg_img_2.".jpg")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.jpg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".jpeg")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.jpeg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".png")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.png')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".JPG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.JPG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".JPEG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.JPEG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".PNG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.PNG')  }}" alt= "Package Image" />
                                    @endif
                              </div>
                              <div>
                                    @if(File::exists(public_path("img_pkg/".$data->pg_img_3.".jpg")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.jpg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".jpeg")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.jpeg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".png")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.png')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".JPG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.JPG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".JPEG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.JPEG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".PNG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.PNG')  }}" alt= "Package Image" />
                                    @endif
                              </div>
                              <div>
                                    @if(File::exists(public_path("img_pkg/".$data->pg_img_4.".jpg")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.jpg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".jpeg")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.jpeg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".png")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.png')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".JPG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.JPG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".JPEG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.JPEG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".PNG")))
                                    <img style="height: 250px; width: auto; margin: 0 auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.PNG')  }}" alt= "Package Image" />
                                    @endif
                              </div>
                          </div>
                        
                          <div class="feature-slider-nav">
                            <div>
                                    @if(File::exists(public_path("img_pkg/".$data->pg_img_1.".jpg")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.jpg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".jpeg")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.jpeg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".png")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.png')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".JPG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.JPG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".JPEG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.JPEG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".PNG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.PNG')  }}" alt= "Package Image" />
                                    @endif
                              </div>
                              <div>
                                    @if(File::exists(public_path("img_pkg/".$data->pg_img_2.".jpg")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.jpg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".jpeg")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.jpeg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".png")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.png')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".JPG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.JPG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".JPEG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.JPEG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".PNG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.PNG')  }}" alt= "Package Image" />
                                    @endif
                              </div>
                              
                              <div>
                                    @if(File::exists(public_path("img_pkg/".$data->pg_img_3.".jpg")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.jpg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".jpeg")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.jpeg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".png")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.png')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".JPG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.JPG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".JPEG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.JPEG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".PNG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.PNG')  }}" alt= "Package Image" />
                                    @endif
                              </div>
                              <div>
                                    @if(File::exists(public_path("img_pkg/".$data->pg_img_4.".jpg")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.jpg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".jpeg")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.jpeg')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".png")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.png')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".JPG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.JPG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".JPEG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.JPEG')  }}" alt= "Package Image" />
                                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".PNG")))
                                    <img style="height: 55px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.PNG')  }}" alt= "Package Image" />
                                    @endif
                              </div>           
                          </div>
                        </div>
                        <div class="detail-img text-center">
                            
                        </div>
                                
                        <div class="table">
                            <table class="table table-responsive">
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;" colspan="2"><b>{{$data->pg_name}}</b></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">MUA</td>
                                        <td style="text-align: right;">{{$data->pg_mua}}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">Stylist</td>
                                        <td style="text-align: right;">{{$data->pg_stylist}}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">Price (1 Day)</td>
                                        @if(Auth::check())
                                        <td style="text-align: right;">
                                            <p>Rp {{number_format($durasiPaket->durasi_harga,0,',','.')}}<br>({{$durasiPaket->durasi_jam}} Hour)</p>
                                        </td>
                                        @else
                                        <td style="text-align: right;">
                                        <p>Biaya Sewa dapat dilihat jika sudah melakukan login</p>
                                        </td>
                                        @endif
                                        
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">Lokasi</td>
                                        <td style="text-align: right;">{{$data->pg_location_jumlah}} Lokasi</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">Exclusive Album</td>
                                        @if($data->pg_album_kolase == 'Include')
                                        <td style="text-align: right;">Include</td>
                                        @else
                                        <td style="text-align: right;">Exclude</td>
                                        @endif
                                    </tr>
                                    @if($data->pg_album_kolase == 'Include')
                                    <tr>
                                        <td colspan="2">{{$data->pg_album_ukuran}}, {{$data->pg_album_jumlah_foto}} Sheets, {{$data->pg_album_jumlah_hal}} Pages</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td style="text-align: left;">Printed Photo</td>
                                        @if($data->pg_printed == 'Include')
                                        <td style="text-align: right;">Include</td>
                                        @else
                                        <td style="text-align: right;">Exclude</td>
                                        @endif
                                    </tr>
                                    @if($data->pg_printed == 'Include')
                                    <tr>
                                        <td colspan="2">{{$data->pg_printed_size}}, {{$data->pg_printed_jumlah}} Photos, @if($data->pg_album_jumlah_frame == 'Include') + Frame
                                        @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td style="text-align: left;">Edited Photo</td>
                                        @if($data->pg_edited == 'Include')
                                        <td style="text-align: right;">Include</td>
                                        @else
                                        <td style="text-align: right;">Exclude</td>
                                        @endif
                                    </tr>
                                    @if($data->pg_edited == 'Include')
                                    <tr>
                                        <td colspan="2">{{$data->jumlah}} Photos, {{$data->pg_edited_saved}}
                                        </td>
                                    </tr>
                                    @endif
                                    <tr></tr>
                                </tbody>
                            </table>
                        </div><!-- end table-responsive -->
                        @endforeach
                    </div><!-- end side-bar-block -->
                </div><!-- end columns -->                                
            </div><!-- end row -->
        </div><!-- end columns -->                                
    </div><!-- end row -->

</div>