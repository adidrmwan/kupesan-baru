@extends('partner.layouts.app-add')
@section('title', 'Add Package')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"><b>Add Package</b></h4>
                        
                    </div>

                    <div class="content">
                        <form role="form" action="{{route('mua-package.store')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                {{ csrf_field() }}
                            <div class="row">
                              <div class="col-md-8">
                                <div class="row">
                                  <div class="col-md-12 col-lg-12">
                                    <div class="alert alert-info alert-dismissible">
                                      <h4>Upload Foto</h4>
                                      Minimal upload 1(satu) foto dengan perbandingan <b>1:1</b><br>dalam format file <b>JPG, JPEG, atau PNG.</b> <br>
                                        Ukuran Maksimal <b>512 KB</b>
                                    </div>
                                  </div>
                                </div>                                
                                <div class="row">
                                  <div class="col-md-2 col-lg-2">
                                  </div>
                                  <div class="col-md-8 col-lg-8">
                                  <h4 style="text-align: center;">Foto Utama <span style="font-size: 15px;">*Wajib Diisi</span></h4> 
                                    <div class="file-loading">
                                      <input id="file-0a" class="file" type="file" name="pg_img_1" required >
                                    </div>
                                  </div>
                                  
                                </div>
                                <hr>
                                <h4 style="text-align: center; padding: 10px;">Foto Pendukung</h4>
                                <div class="row">

                                  
                                  <div class="col-md-4 col-lg-4">
                                    <div class="file-loading">
                                      <input id="file-0a" class="file" type="file" name="pg_img_2">
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-lg-4">
                                    <div class="file-loading">
                                      <input id="file-0a" class="file" type="file" name="pg_img_3">
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-lg-4">
                                    <div class="file-loading">
                                      <input id="file-0a" class="file" type="file" name="pg_img_4">
                                    </div>
                                  </div>
                                </div>
                              </div>
                                <div class="col-md-4">
                                  <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Paket<small><b style="color:red;"> * </b></small></label>
                                            <input type="text" class="form-control" placeholder="Nama Paket" required="" name="pg_name" value="{{ old('pg_name') }}">
                                            <div class="invalid-feedback">Wajib diisi.</div>
                                        </div>
                                    </div> 
                                  </div>
                                  <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Kategori Paket<small><b style="color:red;"> * </b></small></label>
                                            <select  class="form-control" id="inlineFormCustomSelectPref" name="pkg_category_them" >
                                                <option selected value="">Pilih Kategori Paket</option>
                                                <option value="A La Carte">A La Carte</option>
                                                <option value="Special Package">Special Package</option>
                                                <option value="Special Studio">Special Studio</option>
                                            </select>
                                            <div class="invalid-feedback">Wajib diisi.</div>
                                        </div>
                                    </div>
                                  </div> -->
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <!-- <button type="button" class="btn btn-info addPaket">Tambah Durasi Paket</button> -->
                                      <div class="row">
                                        <div class="col-lg-5 col-xs-4">
                                            <div class="form-group">
                                              <label>Durasi Paket (1 hari)<small><b style="color:red;"> * </b></small></label>
                                              <select  class="form-control" id="inlineFormCustomSelectPref" value="{{ old('pg_duration') }}" name="durasi_jam[]" required>
                                                <option selected value="">Pilih Durasi Paket</option>
                                                <option value="1">1 Jam</option>
                                                <option value="2">2 Jam</option>
                                                <option value="3">3 Jam</option>
                                                <option value="4">4 Jam</option>
                                                <option value="5">5 Jam</option>
                                                <option value="6">6 Jam</option>
                                                <option value="7">7 Jam</option>
                                                <option value="8">8 Jam</option>
                                                <option value="9">9 Jam</option>
                                                <option value="10">10 Jam</option>
                                                <option value="11">11 Jam</option>
                                                <option value="12">12 Jam</option>
                                                <option value="13">13 Jam</option>
                                                <option value="14">14 Jam</option>
                                                <option value="15">15 Jam</option>
                                                <option value="16">16 Jam</option>
                                                <option value="17">17 Jam</option>
                                                <option value="18">18 Jam</option>
                                                <option value="19">19 Jam</option>
                                                <option value="20">20 Jam</option>
                                                <option value="21">21 Jam</option>
                                                <option value="22">22 Jam</option>
                                                <option value="23">23 Jam</option>
                                                <option value="24">1 Hari</option>
                                              </select>
                                              <div class="invalid-feedback">Wajib diisi.</div> 
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-xs-8">
                                          <div class="form-group">
                                            <label>Harga Paket<small><b style="color:red;"> * </b></small></label>
                                            <div class="input-group mb-4">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                              </div>
                                              <input class="form-control number" placeholder="Harga Paket" min="1000" value="{{ old('pg_price') }}" name="durasi_harga[]" required>
                                            <div class="invalid-feedback">Wajib diisi.</div>
                                            </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>  
                                  </div>
                                  <!-- <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                            <label>Harga Overtime (Per Jam)<small><b style="color:red;"> * </b></small></label>
                                            <div class="input-group mb-4">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                              </div>
                                              <input class="form-control number" placeholder="Harga Overtime" min="1000" name="pkg_overtime_them">
                                            </div>
                                        </div>
                                    </div>
                                  </div> -->
                                  <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Jumlah Lokasi Pemotretan<small><b style="color:red;"> * </b></small></label>
                                            <input type="number" min="1" max="100" class="form-control" placeholder="Jumlah Lokasi Pemotretan" required="" name="pg_location_jumlah" value="{{ old('pg_location_jumlah') }}">
                                            <div class="invalid-feedback">Wajib diisi.</div>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>MUA/Penata Rias<small><b style="color:red;"> * </b></small></label>
                                            <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_mua"  required>
                                                <option selected value="">Pilih</option>
                                                <option value="Include">Include</option>
                                                <option value="Exclude">Exclude</option>
                                            </select>
                                            <div class="invalid-feedback">Wajib diisi.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Stylist<small><b style="color:red;"> * </b></small></label>
                                            <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_stylist" required>
                                                <option selected value="">Pilih</option>
                                                <option value="Include">Include</option>
                                                <option value="Exclude">Exclude</option>
                                            </select>
                                            <div class="invalid-feedback">Wajib diisi.</div>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                  </div>
<!-- ALBUM KOLASE -->
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
  <div class="col-md-6">
      <div class="form-group">
          <label>Album Kolase<small><b style="color:red;"> * </b></small></label>
          <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_album_kolase" required>
              <option selected value="">Pilih</option>
              <option value="Include">Include</option>
              <option value="Exclude">Exclude</option>
          </select>
          <div class="invalid-feedback">Wajib diisi.</div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label>Ukuran<small><b style="color:red;"> * </b></small></label>
          <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_album_ukuran" required>
              <option selected value="">Pilih</option>
              <option value="-">Exclude</option>
              <option value="15 x 10">15 x 10</option>
              <option value="20 x 20">20 x 20</option>
              <option value="20 x 25">20 x 25</option>
              <option value="20 x 30">20 x 30</option>
              <option value="25 x 30">25 x 30</option>
              <option value="30 x 20">30 x 20</option>
              <option value="30 x 40">30 x 40</option>
          </select>
          <div class="invalid-feedback">Pilih Exclude, jika Exclude Album Kolase.</div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Jumlah Halaman<small><b style="color:red;"> * </b></small></label>
          <input type="number" min="0" max="1000" class="form-control" placeholder="Jumlah Halaman" required="" name="pg_album_jumlah_hal">
          <div class="invalid-feedback">Isi 0, jika Exclude Album Kolase.</div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label>Jumlah Foto<small><b style="color:red;"> * </b></small></label>
          <input type="number" min="0" max="1000" class="form-control" placeholder="Jumlah Halaman" required="" name="pg_album_jumlah_foto">
          <div class="invalid-feedback">Isi 0, jika Exclude Album Kolase.</div>
      </div>
  </div>
</div>
<!-- ALBUM KOLASE -->
<!-- FOTO CETAK -->
<hr>
<h5 style="text-align: center; ">Foto Cetak</h5>
<small style="color: grey;">Jika Exclude Foto Cetak:
  <ul>
    <li>Ukuran: Exclude.</li>
    <li>Jumlah Foto: 0</li>
  </ul>
</small>
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Foto Cetak<small><b style="color:red;"> * </b></small></label>
          <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_printed" required>
              <option selected value="">Pilih</option>
              <option value="Include">Include</option>
              <option value="Exclude">Exclude</option>
          </select>
          <div class="invalid-feedback">Wajib diisi.</div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label>Ukuran<small><b style="color:red;"> * </b></small></label>
          <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_printed_size" required>
              <option selected value="">Pilih</option>
              <option value="-">Exclude</option>
              <option value="15 x 10">15 x 10</option>
              <option value="20 x 20">20 x 20</option>
              <option value="20 x 25">20 x 25</option>
              <option value="20 x 30">20 x 30</option>
              <option value="25 x 30">25 x 30</option>
              <option value="30 x 20">30 x 20</option>
              <option value="30 x 40">30 x 40</option>
              <option value="40 x 60">40 x 60</option>
              <option value="50 x 40">50 x 40</option>
          </select>
          <div class="invalid-feedback">Pilih Exclude, jika Exclude Foto Cetak.</div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Frame<small><b style="color:red;"> * </b></small></label>
          <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_printed_frame" required>
              <option selected value="">Pilih</option>
              <option value="Include">Include</option>
              <option value="Exclude">Exclude</option>
          </select>
          <div class="invalid-feedback">Pilih Exclude, jika Exclude Foto Cetak.</div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label>Jumlah Foto<small><b style="color:red;"> * </b></small></label>
          <input type="number" min="0" max="1000" class="form-control" placeholder="Jumlah Halaman" required="" name="pg_printed_jumlah">
          <div class="invalid-feedback">Isi 0, jika Exclude Foto Cetak.</div>
      </div>
  </div>
</div>
<!-- FOTO CETAK -->
<!-- FOTO EDIT -->
<hr>
<h5 style="text-align: center; ">Foto Edit</h5>
<small style="color: grey;">Jika Exclude Foto Edit:
  <ul>
    <li>Jumlah Foto: 0</li>
  </ul>
</small>
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Foto Edit<small><b style="color:red;"> * </b></small></label>
          <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_edited" required>
              <option selected value="">Pilih</option>
              <option value="Include">Include</option>
              <option value="Exclude">Exclude</option>
          </select>
          <div class="invalid-feedback">Wajib diisi.</div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label>Jumlah Foto<small><b style="color:red;"> * </b></small></label>
          <input type="number" min="0" max="1000" class="form-control" placeholder="Jumlah Foto" required="" name="pg_edited_jumlah">
          <div class="invalid-feedback">Isi 0, jika Exclude Foto Edit.</div>
      </div>
  </div>
</div>
<div class="row">
  <!-- <div class="col-md-6">
      <div class="form-group">
          <label>Format<small><b style="color:red;"> * </b></small></label>
          <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_edited" required>
              <option selected value="">Pilih</option>
              <option value="Include">Include</option>
              <option value="Exclude">Exclude</option>
          </select>
          <div class="invalid-feedback">Isi 0, jika Exclude Foto Edit.</div>
      </div>
  </div> -->
  <div class="col-md-6">
      <div class="form-group">
          <label>Disimpan di<small><b style="color:red;"> * </b></small></label>
          <select  class="form-control" id="inlineFormCustomSelectPref" name="pg_edited_saved" required>
              <option selected value="">Pilih</option>
              <option value="-">Exclude</option>
              <option value="CD/DVD">CD/DVD</option>
              <option value="Flashdisk">Flashdisk</option>
              <option value="CD/DVD/Flashdisk">CD/DVD/Flashdisk</option>
          </select>
          <div class="invalid-feedback">Pilih Exclude, jika Exclude Foto Edit.</div>
      </div>
  </div>
</div>
<!-- FOTO EDIT -->
<hr>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label>Tags<small><b style="color:red;"> * </b></small></label>
      <select id="tags-photographer" class="form-control" name="tag[]" required=""></select>
          <div class="invalid-feedback">Wajib diisi.</div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label>Deskripsi Paket/Informasi Tambahan (Opsional)</label>
      <textarea class="form-control" name="pg_desc" style="height: 100px;"></textarea>
    </div>
  </div>
</div>

                              </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Add Package</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
@endsection

@section('script')
<script type="text/javascript">
  var pg_duration = $('#durasi');
    $(pg_duration).select2({
      data:[
        {id:1,text:"1 Jam"},
        {id:2,text:"2 Jam"},
        {id:3,text:"3 Jam"},
        {id:4,text:"4 Jam"},
        {id:5,text:"5 Jam"},
      ],
      multiple: true,
      placeholder: "Pilih Durasi Paket",
      required: true,
      width: "100%"
    });
</script>
<script type="text/javascript">
$(document).on('click', '.addPaket', function(){
    var html = '<div class="row"><div class="col-md-5"><label>Durasi Paket</label><select  class="form-control" id="inlineFormCustomSelectPref" name="durasi_jam[]" required><option selected value="">Pilih Durasi Paket</option><option value="1">1 Jam</option><option value="2">2 Jam</option><option value="3">3 Jam</option><option value="4">4 Jam</option><option value="5">5 Jam</option></select><div class="invalid-feedback">Wajib diisi.</div></div><div class="col-md-7"><label>Harga Paket</label><div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Rp</span></div><input class="form-control number2" placeholder="Harga Paket" min="1000" name="durasi_harga[]" required><div class="invalid-feedback">Wajib diisi.</div></div></div></div>';
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
<script type="text/javascript">
    $('input.number2').keyup(function(event) {

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

