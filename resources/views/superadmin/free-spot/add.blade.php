@extends('superadmin.layouts.master-admin')
@section('title', 'Dashboard Admin')
@section('content')

  <section class="content">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="header">
                <h4 class="title">Partner Form <span class="badge" style='background-color:orange;'>Free Spot</span></h4>
            </div>
        <div class="box">
          <div class="box-body">
                <div class="header">
                    <h4 class="title">Detail Partner</h4>
                </div>
                  <form role="form" action="{{ route('store.free-spot') }}" method="post" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-8">
                        
                        <div class="content">
                                <div class="row">
                                <!-- pr_name -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Partner<small><b style="color: red;"> *</b></small></label>
                                              <input type="text" class="form-control" placeholder="Nama Usaha"
                                              name="pr_name" value="" required="">
                                        </div>
                                    </div>
                                <!-- ./pr_name -->
                                <!-- pr_typr -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kategori<small><b style="color: red;"> *</b></small></label>
                                                <!--<select class="form-control" required="" id="provinces4" name="pr_type">-->
                                                <!--    <option value="" disable="true" selected="true">Pilih Kategori Usaha</option>-->
                                                <!--    @foreach($type as $list)-->
                                                <!--    @if($list->id == '1' || $list->id == '4')-->
                                                <!--    <option value="{{$list->id}}">{{$list->type_name}}</option>-->
                                                <!--    @endif-->
                                                <!--    @endforeach-->
                                                <!--</select>-->
                                                <input type="text" class="form-control" placeholder="Spot Foto"
                                              name="pr_type" value="" required="" disabled="">
                                        </div>
                                    </div>
                                <!-- ./pr_type -->
                                
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sub Kategori<small><b style="color: red;"> *</b></small></label>
                                            <select class="form-control" required="" name="pr_subtype">
                                                    <option value="" disable="true" selected="true">Pilih Sub Kategori</option>
                                                    @foreach($type as $list)
                                                    @if($list->id == '5' || $list->id == '6' || $list->id == '7' || $list->id == '8')
                                                    <option value="{{$list->id}}">{{$list->type_name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>HP (1)</label>
                                              <input type="text" class="form-control" placeholder="Telepon/HP" aria-label="Username" aria-describedby="basic-addon1" name="pr_phone">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>HP (2)</label>
                                              <input type="text" class="form-control" placeholder="Telepon/HP" aria-label="Username" name="pr_phone2" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                <!-- ./close_hour -->
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Deskripsi Partner<small><b style="color: red;"> *</b></small></label>
                                            <textarea  class="form-control" placeholder="Deskripsikan usaha anda secara detail kepada customer." name="pr_desc" required style="resize: none; height: 100px;"></textarea>
                                        </div>
                                    </div>
                                </div>    
                        </div>
                        @include('superadmin.free-spot.alamat-free-spot')       
                      </div>
                      <div class="col-md-4">
                        <!-- upload ktp -->
                        <div class="header">
                            <h4 class="title">Upload Logo Partner</h4>
                        </div>
                        @include('superadmin.free-spot.upload-logo')     
                      </div>
                      @include('superadmin.free-spot.album-portofolio')     
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
              
            <hr>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection