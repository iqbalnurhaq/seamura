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
                                <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">+ Tambah Product Baru</a>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Photo</th>
                                            <th>Stok</th>
                                            <th>Ukuran</th>
                                            <th>Diskon</th>
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
                {data : 'category.name', name : 'category.name'},
                {data : 'price', name : 'price'},
                {data : 'photo', name : 'photo'},
                {data : 'stok', name : 'stok'},
                {data : 'size', name : 'size'},
                {
                    data : 'diskon', 
                    name : 'diskon',
                    orderable : false,
                    searcable : false,
                },
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