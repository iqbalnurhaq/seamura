@extends('layouts.admin')

@section('title')
    Category
@endsection

@section('content')
    <!-- Section Content -->

          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
            id="locations"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Category</h2>
                <p class="dashboard-subtitle">List of categories</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="branchs_id">Cabang</label>
                                            <select name="branchs_id" id="branchs_id" class="form-control" v-if="branchs" v-model="branchs_id">
                                                <option v-for="branch in branchs" :value="branch.id">@{{ branch.name }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="regencies_id">Buka Cabang</label>
                                                    <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
                                                        <option v-for="regency in regencies" :value="{id : regency.id, name :regency.name}">@{{ regency.name }}</option>
                                                    </select>
                                                    <select v-else class="form-control"></select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-auto d-flex justify-content-center align-items-center">
                                                <button class="btn btn-primary" @click="getAddBranch()"><img src="/images/plus.svg" alt=""></button>
                                            </div>
                                          
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="branchs_id">Hapus Cabang</label>
                                                    <select name="branchs_id" id="branchs_id" class="form-control" v-if="branchs" v-model="branchs_id">
                                                        <option v-for="branch in branchs" :value="branch.id">@{{ branch.name }}</option>
                                                    </select>
                                                    <select v-else class="form-control"></select>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex justify-content-center align-items-center">
                                                <button class="btn btn-danger" @click="deleteBranch()"><img src="/images/trash.svg" alt=""></button>
                                            </div>
                                        </div>
                                       
                                     
                                        
                                    </div>
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
       
      var locations = new Vue({
        el: "#locations",
        mounted() {
          this.getRegenciesData();
          this.getBranchsData();
        
        },
        data: {
         regencies : null,
         regencies_id : null,
         branchs : null,
         branchs_id : null
        },
      
        methods: {
          getRegenciesData(){
            var self = this;
            axios.get('{{ route('api-open-branchs') }}')
              .then(function(response){
                self.regencies = response.data;
              })
          },
          getBranchsData(){
            var self = this;
            axios.get('{{ route('api-branchs') }}')
              .then(function(response){
                self.branchs = response.data;
              })
          },
          getAddBranch(){
              var self = this;
              if (self.regencies_id === undefined) {
                  self.$toasted.error(
                            "Maaf, Pilih Kota terlebih dahulu.",
                            {
                              position: "top-center",
                              className: "rounded",
                              duration: 3000,
                            }
                          );
              }else{
                const add = {id_re : self.regencies_id.id, name : self.regencies_id.name}
                axios.post('{{ route('api-add-branchs') }}', add)
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
             
              }
          },
          deleteBranch(){
             var self = this;
              if (self.branchs_id === undefined) {
                  self.$toasted.error(
                            "Maaf, Pilih Kota terlebih dahulu.",
                            {
                              position: "top-center",
                              className: "rounded",
                              duration: 3000,
                            }
                          );
              }else{
                axios.delete('{{ url('api/open_branchs') }}/' + self.branchs_id)
                  .then(function(response){
                    self.$toasted.success(
                            "Behasil hapus cabang",
                            {
                              position: "top-center",
                              className: "rounded",
                              duration: 3000,
                            }
                          );
                          window.location.reload();
                  })
             
              }
          }
        },
      });
    </script>

@endpush