@extends('layouts.admin')

@section('title')
    Ongkir
@endsection

@section('content')
    <!-- Section Content -->

          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Category</h2>
                <p class="dashboard-subtitle">List of categories</p>
              </div>
              <div class="dashboard-content">
                 
                      <div class="card" id="ongkir">
                          <div class="card-body">
                               <div class="row">
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="regencies_id">City</label>
                                            <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
                                            <option value="default_regencies">Pilih Kota</option>
                                            <option v-for="regency in regencies" :value="regency.id_re">@{{ regency.name }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="districts_id">Kecamatan</label>
                                            <select name="districts_id" id="districts_id" class="form-control" v-if="districts" v-model="districts_id">
                                                <option value="default_districts">Pilih Kecamatan</option>
                                            <option v-for="district in districts" :value="district.id">@{{ district.name }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                               <label>Ongkir</label>
                                                <input type="number" name="ongkir" class="form-control" required v-model="ongkir">
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-4">
                                        <button type="submit" :disabled="isDisable()" class="btn btn-success" @click="addOngkir()">Save Now</button>
                                    </div>

                                </div>
                          </div>
                      </div>


                     

                       
                        <hr>
                 
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                               
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <th>No</th>
                                            <th>Kota/Kabupaten</th>
                                            <th>Kelurahan</th>
                                            <th>Ongkir</th>
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
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
       Vue.use(Toasted);
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
                {data : 'district.regency.name', name : 'district.regency.name'},
                {data : 'district.name', name : 'district.name'},
                {data : 'ongkir', name : 'ongkir'},
                {
                    data : 'action', 
                    name : 'action',
                    orderable : false,
                    searcable : false,
                    width : '15%'
                },
            ]
        })
    </script>
     <script>
         function formatNumber(n, c, d, t){
          var c = isNaN(c = Math.abs(c)) ? 2 : c, 
              d = d === undefined ? '.' : d, 
              t = t === undefined ? ',' : t, 
              s = n < 0 ? '-' : '', 
              i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
              j = (j = i.length) > 3 ? j % 3 : 0;
          return s + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '');
        };

        // Allow the formatNumber function to be used as a filter
        Vue.filter('formatCurrency', function (value) {
          return formatNumber(value, 2, '.', ',');
        });
      var ongkir = new Vue({
        el: "#ongkir",
        mounted() {
          AOS.init();
          this.getRegenciesData();
          console.log(this.isDisable())
        },
        data: {
         regencies : null,
         districts: null,
         regencies_id : "default_regencies",
         districts_id: "default_districts",
         ongkir : "",
        },
        
        methods: {
          getRegenciesData(){
            var self = this;
            axios.get('{{ route('api-branchs') }}')
              .then(function(response){
                self.regencies = response.data;
              })
          },
          getDistrictsData(){
            var self = this;
            axios.get('{{ url('api/districts-ongkir') }}/' + self.regencies_id)
              .then(function(response){
                self.districts = response.data;
              })
          },

         

          isDisable() {
            return this.regencies_id == "default_regencies" || this.districts_id == "default_districts" || this.ongkir == "";
          },
          
          addOngkir(){
              var self = this;
            const add = {district_id : self. districts_id, ongkir : self.ongkir}
                axios.post('{{ route('api-add-ongkir') }}', add)
                  .then(function(response){
                    self.$toasted.success(
                            "Behasil membuka cabang baru",
                            {
                              position: "top-center",
                              className: "rounded",
                              duration: 3000,
                            }
                          );
                          window.location.reload();
                  })
          },
        
        },

        watch: {
          regencies_id : function(va, oldVal){
            this.districts_id = "default_districts";
            this.getDistrictsData();
          },
        },
      });
    </script>

@endpush