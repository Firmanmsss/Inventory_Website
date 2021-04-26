{{-- extend ke indexnya --}}
@extends('layouts.master')

<!-- isi bagian judul halaman -->
@section('title', 'Part Name')

<!-- isi bagian konten -->
@section('contents')

<section id="file-export">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">List Part Name</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
              <p class="card-text">
                  Keseluruhan List Part Name
              </p>
              <table class="table table-striped table-bordered file-export">
                <thead>
                  <tr>
                    <th>Part Name</th>
                    <th>Unit</th>
                    <th>Stock</th>
                    <th>Buy Price / Unit</th>
                    <th>Sell Price / Unit</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Beras</td>
                    <td>KG</td>
                    <td>10</td>
                    <td>Rp.50.000</td>
                    <td>Rp.60.000</td>
                  </tr>
                  <tr>
                    <td>Sayur</td>
                    <td>Gram</td>
                    <td>100</td>
                    <td>Rp.8.000</td>
                    <td>Rp.12.000</td>
                  </tr>
                  <tr>
                    <td>Rokok</td>
                    <td>Pcs</td>
                    <td>15</td>
                    <td>Rp.25.000</td>
                    <td>Rp.45.000</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Part Name</th>
                    <th>Unit</th>
                    <th>Stock</th>
                    <th>Buy Price / Unit</th>
                    <th>Sell Price / Unit</th>
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