{{-- extend ke indexnya --}}
@extends('layouts.master')

@push('addon-link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
@endpush
<!-- isi bagian judul halaman -->
@section('title', 'Part Name')
@section('breadcumb')

<li class="breadcrumb-item active">Create Part Name
</li>

@endsection
<!-- isi bagian konten -->
@section('contents')
<section id="basic-form-layouts">
    <div class="row justify-content-md-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="basic-layout-form-center">Create</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="card-content collapse show">
            <div class="card-body">
              @if ($errors->any())
                <div class="alert alert-danger alert-notif" id="alert_error">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Failed</h3>
                    
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
              <form class="form" action="{{ route('partnamectr.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                  <h4 class="form-section"><i class="ft-box"></i> Data Part Name</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="partname">Part Name</label>
                        <input type="text" id="partname" value="{{ old('partname') }}" class="form-control" placeholder="Part Name" name="partname">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_unit">Unit</label>
                        <select name="id_unit" id="id_unit" required class="select2 form-control">
                          <option value="none" selected="" disabled="">Choose Unit</option>
                          {{-- <option value="2">Firman</option> --}}
                          @foreach ($satuan as $unt)
                          <option value="{{ $unt->id }}" {{ old('id_unit') === ''. $unt->id .'' ? 'selected' : '' }}>{{ $unt->name }}</option>
                            {{-- <option value="{{ $cst->id }}">{{ $cst->name }}</option> --}}
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="std_qty">Std. Qty</label>
                        <input type="text" id="std_qty" value="{{ old('std_qty') }}" class="form-control" placeholder="Std. Qty" name="std_qty">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_cust">Customer</label>
                        <select name="id_cust" id="id_cust" required class="select2 form-control">
                          <option value="none" selected="" disabled="">Choose Customer</option>
                          {{-- <option value="2">Firman</option> --}}
                          @foreach ($customers as $cst)
                          <option value="{{ $cst->id }}" {{ old('id_cust') === ''. $cst->id .'' ? 'selected' : '' }}>{{ $cst->name }}</option>
                            {{-- <option value="{{ $cst->id }}">{{ $cst->name }}</option> --}}
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="id_category">Category</label>
                        <select name="id_category" id="id_category" required class="select2 form-control">
                          <option value="none" selected="" disabled="">Choose Category</option>
                          {{-- <option value="2">Firman</option> --}}
                          @foreach ($category as $ctg)
                          <option value="{{ $ctg->id }}" {{ old('id_category') === ''. $ctg->id .'' ? 'selected' : '' }}>{{ $ctg->category_name }}</option>
                            {{-- <option value="{{ $cst->id }}">{{ $cst->name }}</option> --}}
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <h5>Foto</h5>
                        <div class="controls">
                          <input type="file" name="foto" value="{{ old('foto') }}" class="form-control dropify" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="button" class="btn btn-warning mr-1" onclick="window.location.href='{{ route('partnamectr.index') }}'">
                    <i class="ft-x"></i> Cancel
                  </button>
                  <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('addon-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script>
  $('.dropify').dropify();
</script>

<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
@endpush