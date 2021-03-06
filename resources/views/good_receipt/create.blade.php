{{-- extend ke indexnya --}}
@extends('layouts.master')

@push('addon-link')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
<!-- isi bagian judul halaman -->
@section('title', 'Good Receipt')
@section('breadcumb')

<li class="breadcrumb-item active">Create Good Receipt
</li>

@endsection
<!-- isi bagian konten -->
@section('contents')
<section id="basic-form-layouts">
    <div class="row justify-content-md-center">
      <div class="col-md-12">
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
              <form class="form" id="validateform" action="{{ route('goodreceipt.store') }}" method="POST">
                @csrf
                <div class="form-body">
                  <h4 class="form-section"><i class="ft-user"></i> Data Good Receipt</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="id_po">PO Number</label>
                              <select name="id_po" id="id_po" required class="select2 form-control">
                                <option value="none" selected="" disabled="">Choose PO Number</option>
                                {{-- <option value="2">PO/123/456</option> --}}
                                @foreach ($puchaseorders as $po)
                                <option value="{{ $po->nomor_po }}" {{ old('id_po') === ''. $po->nomor_po .'' ? 'selected' : '' }} >{{ 'PO/INV/'.$po->nomor_po }}</option>
                                @endforeach
                              </select>
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
                              @endforeach
                            </select>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="po_supplier">PO Supplier Number </label>
                                <input type="text" id="po_supplier" value="{{ old('po_supplier') }}" class="form-control" placeholder="PO Supplier Number" name="po_supplier">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="pic">PIC</label>
                              <select name="pic" id="pic" required class="select2 form-control">
                                <option value="none" selected="" disabled="">Choose PIC</option>
                                {{-- <option value="2">Firman</option> --}}
                                @foreach ($personinc as $pic)
                                <option value="{{ $pic->id }}" {{ old('pic') === ''. $pic->id .'' ? 'selected' : '' }}>{{ $pic->name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="checker">Checker</label>
                              <select name="checker" id="checker" required class="select2 form-control">
                                <option value="none" selected="" disabled="">Choose Checker</option>
                                {{-- <option value="2">Firman</option> --}}
                                @foreach ($checker as $chkr)
                                <option value="{{ $chkr->id }}" {{ old('checker') === ''. $chkr->id .'' ? 'selected' : '' }}>{{ $chkr->name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="all_qty">All Qty </label>
                                <input type="text" id="all_qty" value="{{ old('all_qty') }}" class="form-control" placeholder="Qty" name="all_qty">
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="location_name">Location</label>
                              <select name="location_name" id="location_name" required class="select2 form-control">
                                <option value="none" selected="" disabled="">Choose Location</option>
                                {{-- <option value="2">A001A</option> --}}
                                @foreach ($locat as $lct)
                                <option value="{{ $lct->id }}" {{ old('location_name') === ''. $lct->id .'' ? 'selected' : '' }}>{{ $lct->location_name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered" id="example">
                      <thead>
                        <tr>
                          <th>Product Code</th>
                          <th>Product Name</th>
                          <th>Price</th>
                          <th>QTY</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                  </table>          
                </div>
                <div class="form-actions">
                  <button type="button" class="btn btn-warning mr-1" onclick="window.location.href='{{ route('goodreceipt.index') }}'">
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
<script src="../../../app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
  function TotalPurchase(id) {
      var qty = document.getElementById('qty_'+id).value;
      var price = document.getElementById('price_'+id).value;
      var result = 0;
      var totalharga = 0;

      result = parseFloat(qty) * parseFloat(price);
      totalharga = parseFloat(result).toFixed(2);

      document.getElementById('total_'+id).value = totalharga;

      console.log(result);

  }
</script>

<script>

    function po_number(data={}){
      $.ajax({
        url: '/ponumber',
        type: 'get',
        data:data,
        dataType: 'json',
        beforeSend: function(){

        },
        success:function(res){

            console.log(res)
            $('#example tbody').empty()
            var len = res['array'].length

            for(var i=0; i<len; i++){
              var id = res['array'][i].id_partname;
              var partname = res['array'][i].namepart.partname;
              var price = res['array'][i].price;
              var qty = res['array'][i].qty;
              var total = res['array'][i].total;
              
            let html = ''

            html= "<tr>"+
                        "<td  class='text-center' id='kode' name='kode'>" + id + "</td>" +
                        "<td  class='text-center' id='partname' name='partname'>" + partname + "</td>" +
                        "<td  class='text-center' id='price' name='price'>" + price + "</td>" +
                        "<td  class='text-center' id='qty' name='qty'>" + qty + "</td>" +
                        "<td  class='text-center' id='total' name='total'>" + total + "</td>" +
                    "</tr>";
                
            $('#example tbody').append(html)
            }
            
            
            
        },
        complete:function(){

        }
      })
    }

  $(document).ready(function(){
      
    $('#id_po').on('change',function(){
        let data = {
            id_po:$('#id_po').val()
        }
        po_number(data)
    })
  });
</script>
@endpush