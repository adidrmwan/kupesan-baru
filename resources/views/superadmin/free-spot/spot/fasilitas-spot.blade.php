<hr>
<div class="row">
    <div class="col-md-12 col-lg-12">
      <h4 class="title">Fasilitas Spot</h4>
    </div>
    <hr>
</div>  
 <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-2">
        <div class="form-check">
            @if(!empty($fasilitas->toilet))
            <input class="form-check-input" type="checkbox" value="1" name="toilet" id="defaultCheck1" checked="">
            @else
            <input class="form-check-input" type="checkbox" value="1" name="toilet" id="defaultCheck1">
            @endif
            <label class="form-check-label" for="defaultCheck4" style="text-align: center;"></label>
                <img style='height:100px; width: auto;' class="img-responsive" src="{{ asset('dist/images/amenities/toilet.png')  }}"alt= "amenities" />
        </div>  
    </div>
    <div class="col-md-2">
        <div class="form-check">
            @if(!empty($fasilitas->wifi))
            <input class="form-check-input" type="checkbox" value="1" name="wifi" id="defaultCheck2" checked="">
            @else
            <input class="form-check-input" type="checkbox" value="1" name="wifi" id="defaultCheck2">
            @endif
            <label class="form-check-label" for="defaultCheck4" style="text-align: center;"></label>
                <img style='height:100px; width: auto;' class="img-responsive" src="{{ asset('dist/images/amenities/wifi.png')  }}"alt= "amenities" />
        </div>  
    </div>
    <div class="col-md-2">
        <div class="form-check">
            @if(!empty($fasilitas->rganti))
            <input class="form-check-input" type="checkbox" value="1" name="rganti" id="defaultCheck3" checked="">
            @else
            <input class="form-check-input" type="checkbox" value="1" name="rganti" id="defaultCheck3">
            @endif
            <label class="form-check-label" for="defaultCheck4" style="text-align: center;"></label>
                <img style='height:100px; width: auto;' class="img-responsive" src="{{ asset('dist/images/amenities/dressroom.png')  }}"alt= "amenities" />
        </div>  
    </div>
    <div class="col-md-2">
        <div class="form-check">
            @if(!empty($fasilitas->ac))
            <input class="form-check-input" type="checkbox" value="1" name="ac" id="defaultCheck4" checked="">
            @else
            <input class="form-check-input" type="checkbox" value="1" name="ac" id="defaultCheck4">
            @endif
            <label class="form-check-label" for="defaultCheck4" style="text-align: center;"></label>
                <img style='height:100px; width: auto;' class="img-responsive" src="{{ asset('dist/images/amenities/ac.png')  }}"alt= "amenities" />
        </div>  
    </div>
    <div class="col-md-2">
        <div class="form-check">
            @if(!empty($fasilitas->parkir))
            <input class="form-check-input" type="checkbox" value="1" name="parkir" id="defaultCheck5" checked="">
            @else
            <input class="form-check-input" type="checkbox" value="1" name="parkir" id="defaultCheck5">
            @endif
            <label class="form-check-label" for="defaultCheck4" style="text-align: center;"></label>
                <img style='height:100px; width: auto;' class="img-responsive" src="{{ asset('dist/images/amenities/parking.png')  }}"alt= "amenities" />
        </div>  
    </div>
    <div class="col-md-1"></div>
</div>