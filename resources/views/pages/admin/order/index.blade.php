@extends('layouts.admin')

@section('title')
    Product
@endsection

@section('content')
    <!-- Section Content -->

          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Product</h2>
                <p class="dashboard-subtitle">List of products</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">+ Tambah Product Baru</a> --}}
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Total Harga</th>
                                            <th>No Tlp</th>
                                            <th>Kota</th>
                                            <th>Kecamatan</th>
                                            <th>Kelurahan</th>
                                            <th>Detail Alamat</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div> 
@endsection

@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing : true,
            serverSide : true,
            ordering : true,
            ajax: {
                url : '{!! url()->current() !!}',
            },
             columnDefs: [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": 0
              } ],
            columns : [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data : 'name', name : 'name'},
                {data : 'total_price', name : 'total_price'},
                {data : 'no_tlp', name : 'no_tlp'},
                {data : 'regency.name', name : 'regency.name'},
                {data : 'district.name', name : 'district.name'},
                {data : 'village.name', name : 'village.name'},
                {data : 'detail_alamat', name : 'detail_alamat'},
                {
                    data : 'action', 
                    name : 'action',
                    orderable : false,
                    searcable : false,
                },
            ]
        })
    </script>

@endpush