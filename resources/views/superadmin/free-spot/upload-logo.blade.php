<div class="content">
    @if(empty($partner->pr_logo))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning" style="text-align: center;">
                Upload logo partner di sini<br>dalam format file: JPG, JPEG, atau PNG. <br>
                Maximum size: 512 KB dan <b>Rasio 1:1</b>
            </div>
        </div>
    </div>
        <img style="height: 200px; width: auto; margin:0 auto; position:relative; float:none; display:block;border-radius: 100%;" class="img-responsive" src="{{asset('dist/images/upload-logo-sp.png')  }}" alt= "logo" />
    @else
        @if(File::exists(public_path("logo/".$partner->pr_logo.".jpg")))
        <img src="{{ asset('logo/'.$partner->pr_logo.'.jpg')  }}" class="img-responsive" alt="logo" style="height: 200px; width: auto; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
        @elseif(File::exists(public_path("logo/".$partner->pr_logo.".png")))
        <img src="{{ asset('logo/'.$partner->pr_logo.'.png')  }}" class="img-responsive" alt="logo" style="height: 200px; width: auto; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
        @elseif(File::exists(public_path("logo/".$partner->pr_logo.".jpeg")))
        <img src="{{ asset('logo/'.$partner->pr_logo.'.jpeg')  }}" class="img-responsive" alt="logo" style="height: 200px; width: auto; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
        @elseif(File::exists(public_path("logo/".$partner->pr_logo.".JPG")))
        <img src="{{ asset('logo/'.$partner->pr_logo.'.JPG')  }}" class="img-responsive" alt="logo" style="height: 200px; width: auto; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
        @elseif(File::exists(public_path("logo/".$partner->pr_logo.".PNG")))
        <img src="{{ asset('logo/'.$partner->pr_logo.'.PNG')  }}" class="img-responsive" alt="logo" style="height: 200px; width: auto; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
        @elseif(File::exists(public_path("logo/".$partner->pr_logo.".JPEG")))
        <img src="{{ asset('logo/'.$partner->pr_logo.'.JPEG')  }}" class="img-responsive" alt="logo" style="height: 200px; width: auto; margin: 0 auto; float: none; display: block;position: relative; border-radius: 100%;" />
        @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" style="text-align: center;">
                    Upload logo usaha Anda di sini<br>dalam format file: JPG, JPEG, atau PNG. <br>
                    Maximum size: 512 KB dan <b>Rasio 1:1</b>
                </div>
            </div>
        </div>
        <img style="height: 200px; width: auto; margin:0 auto; position:relative; float:none; display:block;border-radius: 100%;" class="img-responsive" src="{{asset('dist/images/upload-logo-sp.png')  }}" alt= "logo" />
        @endif
    @endif
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="file-loading">
                <input id="file-0a" class="file" type="file" name="pr_logo" required>
            </div>
        </div>
    </div>
</div>