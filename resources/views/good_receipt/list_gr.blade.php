{{-- extend ke indexnya --}}
@extends('layouts.master')

<!-- isi bagian judul halaman -->
@section('title', 'Good Receipt')
@section('breadcumb')

<li class="breadcrumb-item active">List Good Receipt
</li>

@endsection

@section('btn_right')
<button class="btn btn-success btn-glow px-2"
type="button" data-toggle="dropdown" aria-haspopup="true" onclick="window.location.href='{{ route('goodreceipt.create') }}'" aria-expanded="false">Transaksi</button>
@endsection
<!-- isi bagian konten -->
@section('contents')

<section id="file-export">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">List Good Receipt</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
              <table class="table table-striped table-bordered file-export" id="example">
                <thead>
                  <tr>
                    <th>Kode PO</th>
                    <th>Customer Name</th>
                    <th>Tanggal</th>
                    <th>Checker</th>
                    <th>PIC</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                  <tr>
                    <th>Kode PO</th>
                    <th>Customer Name</th>
                    <th>Tanggal</th>
                    <th>Checker</th>
                    <th>PIC</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('addon-script')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js"></script>
<script src="{{ asset('/app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/app-assets/vendors/js/tables/jszip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/app-assets/vendors/js/tables/pdfmake.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/app-assets/vendors/js/tables/vfs_fonts.js') }}" type="text/javascript"></script>
<script src="{{ asset('/app-assets/vendors/js/tables/buttons.html5.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/app-assets/vendors/js/tables/buttons.print.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/app-assets/vendors/js/tables/buttons.colVis.min.js') }}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        $('#example').dataTable().fnDestroy();

        $('#example').DataTable( {
        processing: true,
        serverSide: true,
        ordering: true,
        dom: 'Bfrtip',
        buttons: [
          {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
          {extend: 'csv'},
          {extend: 'excel', title: 'Contoh File Excel List Good Receipt'},
          {extend: 'pdf', title:'Contoh File PDF List Good Receipt'},
          {extend:'print',title: 'Contoh Print List Good Receipt'},
          {
            text: '<i class="ft-rotate-cw"></i>',
            action: function (e, dt, node, config) {
                dt.ajax.reload()
            },
            titleAttr: 'Refresh'
          },
        ],
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [
            { data: 'id_po', name: 'id_po'},
            { data: 'customer.name', name: 'customer.name'},
            { data: 'created_at', name: 'created_at' },
            { data: 'checker.name', name: 'checker.name' },
            { data: 'personinc.name', name: 'personinc.name' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        "order": [[ 0, 'desc' ], [ 1, 'desc']]
    });

    });
</script>
@endpush