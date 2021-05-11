{{-- extend ke indexnya --}}
@extends('layouts.master')

@push('addon-link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
@endpush
<!-- isi bagian judul halaman -->
@section('title', 'Part Name')
@section('breadcumb')

<li class="breadcrumb-item active">Edit Part Name
</li>

@endsection
<!-- isi bagian konten -->
@section('contents')
<section id="basic-form-layouts">
    <div class="row justify-content-md-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="basic-layout-form-center">Edit</h4>
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
              <form class="form" novalidate action="{{ route('partname.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
                  <h4 class="form-section"><i class="ft-box"></i> Data Part Name</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Part Name</label>
                        <input type="text" id="name" value="{{ $item->name }}" class="form-control" placeholder="Part Name" name="name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" id="unit" value="{{ $item->satuan }}" class="form-control" placeholder="Unit" name="unit">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="std_qty">Std. Qty</label>
                        <input type="text" id="std_qty" value="{{ $item->std_qty }}" class="form-control" placeholder="Std. Qty" name="std_qty">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_cust">Customer</label>
                        <select name="id_cust" id="select" required class="select2 form-control">
                          {{-- <option value="none" selected="">Choose Customer</option> --}}
                          <option value="{{ $item->id_cust }}" disabled="" selected="" >{{ $item->customer->name }}</option>
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
                        <h5>Foto</h5>
                        <div class="controls">
                          <input type="file" name="foto" value="{{ $item->foto }}" class="form-control dropify" required>
                        </div>
                      </div>
                         <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                          <a href="{{ Storage::url('assets/partname/'.$item->foto ?? '') }}" itemprop="contentUrl" data-size="480x360">
                            <img class="img-thumbnail img-fluid w-50" src="{{ Storage::url('assets/partname/'.$item->foto ?? '') }}"
                            itemprop="thumbnail" alt="Image description" />
                          </a>
                        </figure>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="button" class="btn btn-warning mr-1" onclick="window.location.href='{{ route('partname.index') }}'">
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