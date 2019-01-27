@extends('partner.layouts.app-ps')
@section('title', 'Day Off')
@section('content')
<div class="content">
    <div class="container-fluid">   
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                  <form role="form" action="{{ route('kebaya.form.dayoff.submit') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                  {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header">
                                <h4 class="title">Form Day Off (Hari Libur)</h4>
                            </div>
                            
                            <div class="content">
                                @if ($message = Session::get('error'))
                                  <div class="alert alert-danger" style="text-align: center;">
                                    {{ $message }}
                                  </div>
                                @elseif ($message = Session::get('success'))
                                  <div class="alert alert-success" style="text-align: center;">
                                    {{ $message }}
                                  </div>
                                @endif
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Pilih Tanggal Mulai Libur</label>
                                                    <div id="datepicker"></div>            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding: 0 15px;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Tanggal Terpilih</label>
                                                    <input type="text" class="form-control" id="datepicker2" name="Tanggal_libur">   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Judul</label>
                                                    <input type="text" class="form-control" placeholder="Judul" name="judul"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Durasi Waktu</label>
                                                    <select  class="form-control" id="inlineFormCustomSelectPref" name="durasi_libur" required>
                                                        <option selected value="">Pilih Durasi Waktu</option>
                                                        <option value="1">1 Hari</option>
                                                        <option value="3">3 Hari</option>
                                                        <option value="5">5 Hari</option>
                                                        <option value="7">7 Hari</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Silahkan isi Durasi Waktu.
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                            <button type="submit" class="btn btn-block btn-info pull-right">Submit</button> 
                                    </div>
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

@section('script')
<script src="{{ URL::asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ URL::asset('dist/js/custom-date-picker.js') }} "></script>
<script src="{{ URL::asset('dist/js/bootstrap-datepicker.js') }} "></script>

@endsection