{{-- extend ke indexnya --}}
@extends('layouts.master')

@push('addon-link')

@endpush
<!-- isi bagian judul halaman -->
@section('title', 'Location')
@section('breadcumb')

<li class="breadcrumb-item active">Create Location
</li>

@endsection
<!-- isi bagian konten -->
@section('contents')
<section id="basic-form-layouts">
    <div class="row justify-content-md-center">
      <div class="col-md-6">
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
              <form class="form" action="{{ route('locat.store') }}" method="POST">
                @csrf
                <div class="form-body">
                  <h4 class="form-section"><i class="ft-box"></i> Data Location</h4>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="location_name">Location Name</label>
                        <input type="text" id="location_name" value="{{ old('location_name') }}" class="form-control" placeholder="Location" name="location_name">
                      </div>
                    </div>
                  </div>
                    <div class="form-actions">
                    <button type="button" class="btn btn-warning mr-1" onclick="window.location.href='{{ route('locat.index') }}'">
                        <i class="ft-x"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Save
                    </button>
                    </div>
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

@endpush