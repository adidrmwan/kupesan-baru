@extends('superadmin.layouts.master-admin')
@section('title', 'Dashboard Admin')
@section('content')

  <section class="content">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="header">
                <h4 class="title">Spot Form <span class="badge" style='background-color:orange;'>Free Spot</span></h4>
            </div>
        <div class="box">
          <div class="box-body">
                <div class="header">
                    
                </div>
                  <form role="form" action="{{ route('store.partner-spot') }}" method="post" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-12">
                        <div class="content">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                      <h4 class="title">Upload Foto Spot</h4>
                                    </div>
                                    <hr>
                                </div>      
                                <div class="row">
                                  <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                      <label style="text-align: left;">Foto Utama <b style='color:red;'>*</b></label> 
                                        <div class="file-loading">
                                          <input id="file-0a" class="file" type="file" name="pkg_img_them" required >
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-md-3 col-lg-3">
                                      <div class="form-group">
                                        <label style="text-align: left;">Foto Pendukung (1)</label>
                                        <div class="file-loading">
                                          <input id="file-0a" class="file" type="file" name="pkg_img_them2">
                                        </div>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-lg-3">
                                        <label style="text-align: left;">Foto Pendukung (2)</label>
                                    <div class="file-loading">
                                      <input id="file-0a" class="file" type="file" name="pkg_img_them3">
                                    </div>
                                  </div>
                                  <div class="col-md-3 col-lg-3">
                                        <label style="text-align: left;">Foto Pendukung (3)</label>
                                    <div class="file-loading">
                                      <input id="file-0a" class="file" type="file" name="pkg_img_them4">
                                    </div>
                                  </div>
                                </div>
                                <hr>
                                
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                      <h4 class="title">Detail Spot</h4>
                                    </div>
                                    <hr>
                                </div>  
                                
                              </div class="row">
                                <div class="col-md-12">
                                  <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Spot<small><b style="color:red;"> * </b></small></label>
                                            <input type="text" class="form-control" placeholder="Nama Spot" required="" name="pkg_name_them">
                                        </div>
                                    </div> 
                                  </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Deskripsi Spot</label>
                                            <textarea class="form-control" placeholder="Deskripsikan spot secara lengkap." name="pr_desc" required style="resize: none; height: 100px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                </div> 
                                
                            </div>
                            @include('superadmin.free-spot.spot.alamat-spot')
                            @include('superadmin.free-spot.spot.fasilitas-spot')
                            <hr>
                            <input type="hidden" class="form-control" name="user_id"  value="{{$user_id}}">
                            <button type="submit" class="btn btn-info btn-fill btn-block">Submit</button>
                            <div class="clearfix"></div>

                    </div>  
                      </div>
                    </div>
                  </form>
              
            <hr>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection