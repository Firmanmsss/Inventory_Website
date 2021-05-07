{{-- extend ke indexnya --}}
@extends('layouts.master')

@push('addon-link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
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
              <form class="form">
                <div class="form-body">
                  <h4 class="form-section"><i class="ft-user"></i> Data Part Name</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="partname">Name</label>
                        <input type="text" id="partname" class="form-control" placeholder="Part Name" name="name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" id="unit" class="form-control" placeholder="Unit" name="satuan">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="std_qty">Std. Qty</label>
                        <input type="text" id="std_qty" class="form-control" placeholder="Std. Qty" name="std_qty">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput5">Customers</label>
                        <select id="projectinput5" name="interested" class="form-control">
                          <option value="none" selected="" disabled="">Customers</option>
                          @foreach ($customers as $cst)
                            <option value="{{ $cst->id }}" {{ old('course_id') === ''. $cst->id .'' ? 'selected' : '' }}>{{ $cst->title }}</option>
                            {{-- <option value="{{ $course->id }}">{{ $course->name }}</option> --}}
                          @endforeach
                          {{-- <option value="Kalbe Group">Kalbe Group</option>
                          <option value="PT. AIAM">PT. AIAM</option>
                          <option value="Creatsign">Creatsign</option> --}}
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <h5>Image
                    </h5>
                    <div class="controls">
                      <input type="file" name="file" class="form-control dropify" required>
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

@endpush