{{-- extend ke indexnya --}}
@extends('layouts.master')

@push('addon-link')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
<!-- isi bagian judul halaman -->
@section('title', 'Purchase Order')
@section('breadcumb')

<li class="breadcrumb-item active">Create Purchase Order
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
              <form class="form" id="validateform" action="{{ route('purchaseorder.store') }}" method="POST">
                @csrf
                <div class="form-body">
                  <h4 class="form-section"><i class="ft-user"></i> Data Purchase Order</h4>
                  <div class="form-group row">
                    <div class="col-md-6">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">PO/INV/</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor PO" id="nomor_po" value="{{ old('nomor_po') }}" name="nomor_po">
                        {{-- <div class="input-group-append">
                          <span class="input-group-text">.00</span>
                        </div> --}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="table-responsive">
                          <table class="table" id="t_item">
                            <thead>
                              <tr>
                                <th>Partname</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th><div class="button btn btn-danger btn-sm" type="button" id="btn_delete_all"><i class="ft-x"></i> Delete All</div></th>
                              </tr>
                            </thead>
                            <tbody>
                              @if(old('_token'))
                                @foreach (old('product') as $key => $val)
                                <tr>
                                  <td>
                                    <select name="product[{{ $key }}]" id="product_{{ $key }}" class="form-control">
                                      <option value="" disabled selected>--Choose Partname--</option>
                                      @foreach ($partname as $pn)
                                          <option value="{{ $pn->id ?? '' }}">{{ $pn->partname ?? '' }}</option>
                                      @endforeach 
                                    </select>
                                  </td>
                                  <td>
                                    <input class="form-control border-primary" onkeyup="TotalPurchase();" name="price[{{ $key }}]" value="{{ old('price')[$key] }}" type="number" placeholder="Price" id="price_{{ $key }}">
                                  </td>
                                  <td>
                                    <input class="form-control border-primary" onkeyup="TotalPurchase();" name="qty[{{ $key }}]" value="{{ old('qty')[$key] }}" type="number" placeholder="Qty" id="qty_{{ $key}}">
                                  </td>
                                  <td>
                                    <input class="form-control border-primary" readonly name="total[{{ $key }}]" value="{{ old('total')[$key] }}" type="number" placeholder="Total" id="total_{{ $key }}">
                                  </td>
                                  <td>
                                      {!! $key !==0 ? '<button type="button" class="btn btn-sm btn-danger btn-delete" >X</button> ' : '' !!}
                                  </td>
                                </tr>
                                @endforeach
                              @else
                              <tr>
                                <td>
                                  <select name="product[0]" id="product_0" class="form-control">
                                    <option value="" disabled selected>--Choose Partname--</option>
                                    @foreach ($partname as $pn)
                                        <option value="{{ $pn->id ?? '' }}">{{ $pn->partname ?? '' }}</option>
                                    @endforeach
                                  </select>
                                </td>
                                <td>
                                  <input type="number" onkeyup="TotalPurchase(0);" name="price[0]" id="price_0" placeholder="Price" class="form-control">
                                </td>
                                <td>
                                  <input type="number" onkeyup="TotalPurchase(0);" name="qty[0]" id="qty_0" placeholder="Qty" class="form-control">
                                </td>
                                <td>
                                  <input type="number" readonly name="total[0]" id="total_0" placeholder="Total" class="form-control">
                                </td>
                                <td></td>
                              </tr>
                              @endif
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="7">
                                    <button class="btn btn-sm btn-info" type="button" id="btn_add"><i class="la la-plus-circle"></i>  Add</button>
                                </td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>                
                </div>
                <div class="form-actions">
                  <button type="button" class="btn btn-warning mr-1" onclick="window.location.href='{{ route('purchaseorder.index') }}'">
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
  $(document).ready(function(){
    let count = {{ old('_token') ? count(old('product')) : 0 }};
    $('#btn_add').on('click', function(){
        count += 1
        let row =`
        <tr>
            <td>
              <select name="product[${count}]" id="product_${count}" class="form-control select2">
                <option value="" disabled selected>--Choose Partname--</option>
                @foreach ($partname as $pn)
                    <option value="{{ $pn->id ?? '' }}">{{ $pn->partname ?? '' }}</option>
                @endforeach
              </select>
            </td>
              <td>
                <input type="number" onkeyup="TotalPurchase(${count});" name="price[${count}]" id="price_${count}" placeholder="Price" class="form-control">
              </td>
              <td>
                <input type="number" onkeyup="TotalPurchase(${count});" name="qty[${count}]" id="qty_${count}" placeholder="Qty" class="form-control">
              </td>
              <td>
                <input type="number" readonly name="total[${count}]" id="total_${count}" placeholder="Total" class="form-control">
              </td>
              <td>
                <button type="button" class="btn btn-sm btn-danger btn-delete"><i class="ft-x"></i></button>
              </td>
          </tr>
        `
        $('#t_item tbody').append(row)
    })
      
    $('#t_item').on('click','.btn-delete',function(){
        $(this).closest('tr').remove()
    })
  
    $('#t_item').on('click','#btn_delete_all',function(){
        $('#validateform')[0].reset()
        $('#t_item tbody tr').not(':first').remove()
    })
  
    $('#validateform').validate();
  })
  </script>
@endpush