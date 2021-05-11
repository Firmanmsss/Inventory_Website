{{-- extend ke indexnya --}}
@extends('layouts.master')

@push('addon-link')

@endpush
<!-- isi bagian judul halaman -->
@section('title', 'Customer')
@section('breadcumb')

<li class="breadcrumb-item active">Create Customer
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
              <form class="form" novalidate action="{{ route('customer.store') }}" method="POST">
                @csrf
                <div class="form-body">
                  <h4 class="form-section"><i class="ft-user"></i> Data Customer</h4>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="partname" class="form-control" placeholder="Name" name="name">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="no_telp">No. Telp</label>
                        <input type="text" id="no_telp" class="form-control" placeholder="No. Telp" name="no_telp">
                      </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" rows="5" class="form-control" name="alamat" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="button" class="btn btn-warning mr-1" onclick="window.location.href='{{ route('customer.index') }}'">
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

@endpush