
<div class="padding-price">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label style="color: white;">Min Price</label>
                <div class="input-group md-12 xs-12 sm-12"> 
                    <span class="input-group-addon">Rp</span>
                    <input class="form-control number" placeholder="Min Price" name="min_price" min="0">
                </div>

            </div>        
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label style="color: white;">Max Price</label>
                <div class="input-group"> 
                    <span class="input-group-addon">Rp</span>
                    <input class="form-control number" placeholder="Max Price" name="max_price" min="0">
                </div>
            </div> 
        </div>
    </div>
    <!-- <hr>
    <h3 style="margin-bottom: 20px;">Filter Tipe Paket</h3>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" >
                <select  class="form-control" name="type">
                    <option selected value="All_type">Semua</option>
                    <option value="A La Carte">Ala Carte</option>
                    <option value="Special Package">Special Package</option>
                    <option value="Special Studio">Special Studio</option>
                </select>
            </div>             
        </div>    
    </div> -->
    <hr>
    <h3 style="margin-bottom: 20px;">Filter Tema</h3>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" >
                <select  class="form-control" name="theme">
                    <option selected value="all">Semua</option>
                    @foreach($listtema as $value)
                    <option value="{{$value->id}}">{{$value->type_name}}</option>
                    @endforeach
                </select>
            </div>             
        </div>    
    </div>
    <hr>
    <div style="margin-top: 10px;" class="padding-price">
        <div class="col-sm-12 col-md-12">
            <input type="text" name="tag_id" value="{{$tag_id}}" hidden="">
            <button type="submit" class="btn btn-default" style="width: 100%;">Filter</button>
        </div>
    </div>
</div>