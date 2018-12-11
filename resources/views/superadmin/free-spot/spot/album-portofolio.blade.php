<div class="content">  
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                    <div class="header">
                        <h4 class="title">Portofolio</h4>
                        <small>Upload Portofolio Terbaik</small>
                    </div>  
                    <div class="content">
                        <form role="form" action="{{ route('partner.update.portofolio') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <label>#1 Best Portfolio</label>
                                    <div class="file-loading">
                                        <input id="file-0a" class="file" type="file" name="album_img_1">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label>#2 Best Portfolio</label>
                                    <div class="file-loading">
                                        <input id="file-0a" class="file" type="file" name="album_img_2">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label>#3 Best Portfolio</label>
                                    <div class="file-loading">
                                        <input id="file-0a" class="file" type="file" name="album_img_3">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label>#4 Best Portfolio</label>
                                    <div class="file-loading">
                                        <input id="file-0a" class="file" type="file" name="album_img_4">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>     