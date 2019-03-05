<div class="header">
    <h4 class="title">Alamat</h4>
</div>
<div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Provinsi<small><b style="color: red;"> *</b></small></label>
                    <select class="form-control" name="pr_prov" id="provinces" required>
                        <option value="" disable="true" selected="true">Pilih Provinsi</option>
                        @foreach ($provinces as $key => $value)
                        <option value="{{$value->id}}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kota/Kabupaten<small><b style="color: red;"> *</b></small></label>
                    <select class="form-control" name="pr_kota" id="regencies" required>
                      <option value="" disable="true" selected="true">Pilih Kota/Kabupaten</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kecamatan<small><b style="color: red;"> *</b></small></label>
                    <select class="form-control" name="pr_kec" id="districts" required>
                      <option value="" disable="true" selected="true">Pilih Kecamatan</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kelurahan<small><b style="color: red;"> *</b></small></label>
                    <select class="form-control" name="pr_kel" id="villages" required>
                      <option value="" disable="true" selected="true">Pilih Kelurahan</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kode Pos<small><b style="color: red;"> *</b></small></label>
                    <input type="text" class="form-control" placeholder="Kode Pos" name="pr_postal_code" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Alamat Lengkap<small><b style="color: red;"> *</b></small></label>
                    <textarea class="form-control" placeholder="Tuliskan alamat usaha anda secara lengkap." name="pr_addr" required style="resize: none; height: 100px;"></textarea>
                </div>
            </div>
        </div>
         
</div>