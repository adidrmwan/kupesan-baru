@extends('partner.layouts.app-form')
@section('title', 'Application Form')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible">
                    <h4>Selamat Datang, Partner-KU!</h4>
                    Silahkan mengisi <em><b>Application Form</b></em> dibawah ini dengan lengkap untuk melanjutkan ke<b> tahap selanjutnya.</b>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <form role="form" action="{{ route('partner.profile.form.submit') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                  {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-7">
                        <div class="header">
                            <h4 class="title">Application Form</h4>
                        </div>
                        <div class="content">
                                <div class="row">
                                <!-- pr_name -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Usaha<small><b style="color: red;"> *</b></small></label>
                                              <input type="text" class="form-control" placeholder="Nama Usaha"
                                              name="pr_name" value="" required="">
                                            <div class="invalid-feedback">
                                              Wajib diisi. 
                                            </div>
                                        </div>
                                    </div>
                                <!-- ./pr_name -->
                                <!-- pr_typr -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kategori usaha<small><b style="color: red;"> *</b></small></label>
                                                <select class="form-control" required="" id="provinces4" name="pr_type">
                                                    <option value="" disable="true" selected="true">Pilih Kategori Usaha</option>
                                                    @foreach($type as $list)
                                                    @if($list->id == '1' || $list->id == '4' || $list->id == '2' || $list->id == '3')
                                                    <option value="{{$list->id}}">{{$list->type_name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                  Wajib diisi.
                                                </div>
                                        </div>
                                    </div>
                                <!-- ./pr_type -->
                                
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sub Kategori<small><b style="color: red;"> *</b></small></label>
                                            <select class="form-control" name="pr_subtype" id="regencies4" required="">
                                              <option value="" disable="true" selected="true">Pilih Sub Kategori</option>
                                            </select>
                                            <div class="invalid-feedback">
                                              Wajib diisi. 
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-4">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label>Sub Kategori<small><b style="color: red;"> *</b> khusus kategori spot foto</small></label>-->
                                    <!--            <select class="form-control" name="pr_subtype">-->
                                    <!--                <option value="">Pilih Sub Kategori</option>-->
                                                    <!--@foreach($type as $list)-->
                                                    <!--@if($list->id == '5' || $list->id == '6' || $list->id == '7' || $list->id == '8' )-->
                                                    <!--<option value="{{$list->id}}">{{$list->type_name}}</option>-->
                                                    <!--@endif-->
                                                    <!--@endforeach-->
                                    <!--            </select>-->
                                    <!--            <div class="invalid-feedback">Silahkan pilih kategori usaha Anda.</div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                                <div class="row">
                                <!-- pr_owner_name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name Pemilik<small><b style="color: red;"> *</b></small></label>
                                            <input type="text" class="form-control" placeholder="Nama Pemilik" name="pr_owner_name" required>
                                            <div class="invalid-feedback">
                                              Wajib diisi.
                                            </div>
                                        </div>
                                    </div>
                                <!-- ./pr_owner_name -->
                                <!-- open_hour -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Jam Buka<small><b style="color: red;"> *</b></small></label>
                                            <select  class="form-control" id="inlineFormCustomSelectPref" name="open_hour" required>
                                                <option selected value="">Pilih Jam Buka</option>
                                                @foreach($jam as $key => $value)
                                                @if($value->id < 10)
                                                <option value="{{$value->id}}">0{{$value->num_hour}}:00</option>
                                                @elseif($value->id >= 10)
                                                <option value="{{$value->id}}">{{$value->num_hour}}:00</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                              Wajib diisi.
                                            </div>
                                        </div>
                                    </div>
                                <!-- ./open_hour -->
                                <!-- close_hour -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Jam Tutup<small><b style="color: red;"> *</b></small></label>
                                            <select  class="form-control" id="inlineFormCustomSelectPref" name="close_hour" required>
                                                <option selected value="">Pilih Jam Tutup</option>
                                                @foreach($jam as $key => $value)
                                                @if($value->id < 10)
                                                <option value="{{$value->id}}">0{{$value->num_hour}}:00</option>
                                                @elseif($value->id >= 10)
                                                <option value="{{$value->id}}">{{$value->num_hour}}:00</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                              Wajib diisi.
                                            </div>
                                        </div>
                                    </div>
                                <!-- ./close_hour -->
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Deskripsi Usaha<small><b style="color: red;"> *</b></small></label>
                                            <textarea  class="form-control" placeholder="Deskripsikan usaha anda secara detail kepada customer." name="pr_desc" required style="resize: none; height: 100px;"></textarea>
                                            <div class="invalid-feedback">
                                              Wajib diisi.
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                        </div>
                        @include('partner.form.alamat-mitra')       
                        <div class="header">
                            <h4 class="title">Kontak</h4>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" class="form-control" placeholder="Tuliskan alamat usaha"
                                              disabled="" value="{{$email}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>HP (Aktif Whatsapp)<small><b style="color: red;"> *</b></small></label>
                                          <input type="text" class="form-control" placeholder="Telepon/HP" aria-label="Username" aria-describedby="basic-addon1" name="pr_phone" value="{{$phone_number}}" required>
                                            <div class="invalid-feedback">
                                              Wajib diisi.
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>HP (2)</label>
                                          <input type="text" class="form-control" placeholder="Telepon/HP" aria-label="Username" name="pr_phone2" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <!-- upload ktp -->
                        <div class="header">
                            <h4 class="title">Upload Identitas (KTP)</h4>
                            <small>Kartu Tanda Penduduk</small>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" style="text-align: center;">
                                        Upload dalam format file: <b>JPG, JPEG, atau PNG.</b> <br>
                                        Maximum size: <b>3 MB (megabytes)</b>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="file-loading">
                                        <input id="file-detail-mitra" class="file" type="file" name="ktp" required="">
                                        <div class="invalid-feedback">
                                          Wajib diisi.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <div class="header">
                            <h4 class="title">Upload Fisik Bangunan</h4>
                            <small>Tampak depan dari tempat usaha</small>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" style="text-align: center;">
                                        Upload dalam format file: <b>JPG, JPEG, atau PNG.</b> <br>
                                        Maximum size: <b>3 MB (megabytes)</b>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="file-loading">
                                        <input id="file-detail-mitra" class="file" type="file" name="bangunan" required="">
                                        <div class="invalid-feedback">
                                          Wajib diisi.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-md-12">
                           <div class="content">
                              <div class="row">
                                  <div class="col-md-12">
                                    <button type="submit" class="btn btn-block btn-info" style="">Submit Application Form</button>
                                </div>
                                <div class="clearfix"></div> 
                              </div>  
                          </div>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection