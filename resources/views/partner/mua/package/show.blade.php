@extends('partner.layouts.app-add')
@section('title', 'Edit Package')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Package</h4>
                    </div>
                    <div class="content">
                        @foreach($package as $data)
                        <form role="form" action="{{route('pg-package.update', ['id' => $data->id])}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        
                           
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Update Foto Paket (1)</label>
                                                <div class="file-loading">
                                                    <input id="file-0a" class="file" type="file" name="pg_img_1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Foto Paket (1)</label><br>
                                                @if(File::exists(public_path("img_pkg/".$data->pg_img_1.".jpg")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.jpg')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".jpeg")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.jpeg')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".png")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.png')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".JPG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.JPG')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".JPEG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.JPEG')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".PNG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_1.'.PNG')  }}" alt= "Package Image" />
                                                @else
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/upload-photo.PNG')  }}" alt= "Package Image" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Update Foto Paket (2)</label>
                                                <div class="file-loading">
                                                    <input id="file-0a" class="file" type="file" name="pg_img_2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Foto Paket (2)</label><br>
                                                @if(File::exists(public_path("img_pkg/".$data->pg_img_2.".jpg")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.jpg')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".jpeg")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.jpeg')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".png")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.png')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".JPG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.JPG')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".JPEG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.JPEG')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_2.".PNG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_2.'.PNG')  }}" alt= "Package Image" />
                                                @else
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/upload_photo.png')  }}" alt= "Package Image" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Update Foto Paket (3)</label>
                                                <div class="file-loading">
                                                    <input id="file-0a" class="file" type="file" name="pg_img_3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Foto Paket (3)</label><br>
                                                @if(File::exists(public_path("img_pkg/".$data->pg_img_3.".jpg")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.jpg')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".jpeg")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.jpeg')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".png")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.png')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".JPG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.JPG')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".JPEG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.JPEG')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_3.".PNG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_3.'.PNG')  }}" alt= "Package Image" />
                                                @else
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/upload_photo.png')  }}" alt= "Package Image" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Update Foto Paket (4)</label>
                                                <div class="file-loading">
                                                    <input id="file-0a" class="file" type="file" name="pg_img_4">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Foto Paket (4)</label><br>
                                                @if(File::exists(public_path("img_pkg/".$data->pg_img_4.".jpg")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.jpg')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".jpeg")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.jpeg')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".png")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.png')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".JPG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.JPG')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".JPEG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.JPEG')  }}" alt= "Package Image" />
                                                @elseif(File::exists(public_path("img_pkg/".$data->pg_img_4.".PNG")))
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/'.$data->pg_img_4.'.PNG')  }}" alt= "Package Image" />
                                                @else
                                                <img style="height: 270px; width: auto;" class="img-responsive" src="{{ asset('img_pkg/upload_photo.png')  }}" alt= "Package Image" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Paket</label>
                                                <input type="text" class="form-control" placeholder="Nama Paket" required="" name="pg_name" value="{{$data->pg_name}}">
                                                <div class="invalid-feedback">
                                                    Wajib diisi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <th>Durasi Paket</th>
                                                    <th>Harga Paket</th>
                                                    <th>Delete</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($durasiPaket as $paket)
                                                    <tr>
                                                        <td>{{$paket->durasi_jam}} Jam</td>
                                                        <td>Rp {{number_format($paket->durasi_harga,0,',','.')}}</td>
                                                        <td><a href="{{route('durasi.delete', ['id' => $paket->id])}}" class="btn btn-info btn-sm">Delete</a></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-info addJam">Tambah Durasi Paket</button>
                                            <br><br>    
                                        </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>MUA/Penata Rias</label>
                                                <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_mua" required>
                                                    <option selected value="{{$data->pg_mua}}">{{$data->pg_mua}}</option>
                                                    @if($data->pg_mua != 'Include')
                                                    <option value="Include">Include</option>
                                                    @endif
                                                    @if($data->pg_mua != 'Exclude')
                                                    <option value="Exclude">Exclude</option>
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback">Wajib diisi.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Stylist</label>
                                                <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_stylist" required>
                                                    <option selected value="{{$data->pg_stylist}}">{{$data->pg_stylist}}</option>
                                                    @if($data->pg_stylist != 'Include')
                                                    <option value="Include">Include</option>
                                                    @endif
                                                    @if($data->pg_stylist != 'Exclude')
                                                    <option value="Exclude">Exclude</option>
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback">Wajib diisi.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 style="text-align: center; ">Album Kolase</h5>
                                    <small style="color: grey;">Jika Exclude Album Kolase:
                                      <ul>
                                        <li>Ukuran: Exclude.</li>
                                        <li>Jumlah Halaman: 0.</li>
                                        <li>Jumlah Foto: 0</li>
                                      </ul>
                                    </small>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Album Kolase</label>
                                                <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_album_kolase" required>
                                                    <option selected value="{{$data->pg_album_kolase}}">{{$data->pg_album_kolase}}</option>
                                                    @if($data->pg_album_kolase != 'Include')
                                                    <option value="Include">Include</option>
                                                    @endif
                                                    @if($data->pg_album_kolase != 'Exclude')
                                                    <option value="Exclude">Exclude</option>
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback">Wajib diisi.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <label>Tags</label>
                                            <select id="tags-photographer" class="form-control" name="tag[]"></select>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach($partnerTag as $tag)
                                                <span class="badge badge-info">{{$tag->type_name}}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" name="id" value="{{$data->id}}" hidden="">
                                            <button type="submit" class="btn btn-info btn-fill btn-block">Update</button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>        
@endsection
@section('script')
<script type="text/javascript">
$(document).on('click', '.addJam', function(){
    var html = '<div class="row"><div class="col-md-5"><select  class="form-control" id="inlineFormCustomSelectPref" name="durasi_jam[]" required><option selected value="">Pilih Durasi Paket</option><option value="1">1 Jam</option><option value="2">2 Jam</option><option value="3">3 Jam</option><option value="4">4 Jam</option><option value="5">5 Jam</option><option value="6">6 Jam</option><option value="7">7 Jam</option><option value="8">8 Jam</option><option value="9">9 Jam</option><option value="10">10 Jam</option><option value="11">11 Jam</option><option value="12">12 Jam</option><option value="13">13 Jam</option><option value="14">14 Jam</option><option value="15">15 Jam</option><option value="16">16 Jam</option><option value="17">17 Jam</option><option value="18">18 Jam</option><option value="19">19 Jam</option><option value="20">20 Jam</option><option value="20">20 Jam</option><option value="21">21 Jam</option><option value="22">22 Jam</option><option value="23">23 Jam</option><option value="24">1 Hari</option></select><div class="invalid-feedback">Wajib diisi.</div></div><div class="col-md-7"><div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Rp</span></div><input class="form-control number" placeholder="Harga Paket" min="1000" name="durasi_harga[]" required><div class="invalid-feedback">Wajib diisi.</div></div></div></div>';
  $(this).parent().append(html);
});
</script>
<script type="text/javascript">
    $('input.number').keyup(function(event) {

      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40) return;

      // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        ;
      });
    });
</script>
@endsection

