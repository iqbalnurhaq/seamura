@extends('layouts.app')

@section('title')
    Store Cart Page 
@endsection

@push('prepend-style')
  <style>
    .diskon::before {
      content: '';
      position: absolute;
      width: 80%;
      height: 2px;
      top: 10px;
      right: 0;
      left: 8px;
      bottom: 0;
      background-color: red;
    }
    .meta-diskon{
      position: absolute;
      top: 0;
      right: 0;
      padding: 7px;
     
      background-color: blue;
      color: white;
      font-size: 15px;
      font-weight: bold;
      border-radius: 5px;
    }

    .meta-satuan{
      position: absolute;
      bottom: 0;
      left: 0;
      padding: 7px;
     
      background-color: blue;
      color: white;
      font-size: 14px;
      font-weight: bold;
      border-radius: 5px;
    }
  </style>
@endpush

@section('content')
    <!-- Page Content -->
    <div class="page-content page-cart" id="locations">
      <section
        class="store-breadcrumbs"
        data-aos="fade-down"
        data-aos-delay="100"
      >
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Cart</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="store-cart">
        <div class="container">
          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive">
              <table class="table table-borderless table-cart">
                <thead>
                  <tr>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Jumlah</td>
                    <td>Satuan</td>
                  </tr>
                </thead>
                <tbody>
                    <tr v-for="(product,index) in products">
                      <td style="width: 25%">

                        <div class="col">

                          <div v-if="product.diskon" class="meta-diskon">Diskon @{{ product.diskon  }}%</div>
                        </div>
                        
                        <img
                          :src="product.photo"
                          :alt="product.name"
                          class="cart-image"
                        />

                        
                          
                          <div class="product-title">@{{ product.name }}</div>
                       
                      </td>

                 
                  
                      <td style="width: 20%">
                          <div class="col">
                            <div class="products-title" :class="{'diskon' : product.diskon > 0}">Rp.@{{ product.price | formatCurrency}}</div>
                            <div v-if="product.diskon" class="products-title">Rp.@{{ product.price - ((product.diskon/100) * product.price)  | formatCurrency }}</div>
                          </div>

                      </td>
                      <td style="width: 15%">  
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-danger" @click="minus(product,index)" type="button" id="button-addon1"><img src="/images/minus.svg" alt="" /></button>
                            </div>
                            <input type="text" class="form-control text-center" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" :value="product.qty" disabled>
                             <div class="input-group-append">
                                <button class="btn btn-success" @click="plus(product,index)" type="button" id="button-addon2"><img src="/images/plus.svg" alt="" /></button>
                            </div>
                        </div>

                  
                        </td>



                        <td style="width: 15%">

                          <div class="products-title">@{{ product.size }}</div>
                        
                      </td>


                      <td style="width: 15%">

                          <button type="submit" class="btn btn-sm btn-danger"><img src="/images/trash.svg" alt="" /></button>
                        
                      </td>
                    </tr>
                  
                    <tr style="border-top: 1px solid rgb(187, 180, 180)"> 
                        <td style="font-size: 20px">Ongkir</td>
                        <td> <div style="font-size: 20px;">Rp.@{{ this.ongkir | formatCurrency}}</div></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr> 
                        <td style="font-size: 20px">Total Harga</td>
                        <td> <div class="text-success" style="font-size: 20px;">Rp. @{{ Total  | formatCurrency }}</div></td>
                        <td></td>
                        <td></td>
                    </tr>
                  
                </tbody>
              </table>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr />
            </div>

            <div class="col-12">
              <h2 class="mb-4">Shipping Details</h2>
            </div>
          </div>
        
            <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="pemesan" class="">Nama Pemesan</label>
                  <input
                    type="text"
                    id="pemesan"
                    name="pemesan"
                    class="form-control"
                    v-model="pemesan"

               
                  />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone_number" class="">Nomor Hp (Whatsapp)</label>
                  <input
                    type="number"
                    id="phone_number"
                    name="phone_number"
                    class="form-control"
                    value=""
                    v-model="no_tlp"
                  />
                </div>
              </div>

            <div class="col-md-12">
              <div class="form-group">
                 <label for="exampleFormControlTextarea1">Detail Alamat</label>
                 <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Detail Alamat (Ex: cat pagar rumah, dll)" v-model="detail_alamat"></textarea>
              </div>
            </div>
            

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
            
            <div class="col-md-4">
              <div class="form-group">
                <label for="villages_id">Kelurahan</label>
                 <select name="villages_id" id="villages_id" class="form-control" v-if="villages" v-model="villages_id">
                    <option value="default_villages">Pilih Kelurahan</option>
                  <option v-for="village in villages" :value="village.id">@{{ village.name }}</option>
                </select>
                <select v-else class="form-control"></select>
              </div>
            </div>


          </div>

          <div class="row">
            <div class="col-12">
              <hr />
            </div>
            <div class="col-12"><h2 class="mb-2">Checkout</h2></div>
          </div>

          <div class="row justify-content-center">
           
          
            <div class="col-8 col-md-5">
              <button
             
                class="btn btn-success mt-4 px-4 btn-block"
                @click=ordernow()
                :disabled="isDisable()"
                >Order Now</button
              >
            </div>
          </div>
        


        </div>
      </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
      var locations = new Vue({
        el: "#locations",
        mounted() {
          AOS.init();
          this.getRegenciesData();
          // console.log(this.isDisable())
        //  console.log();
        
        },
        data: {
         products: window.localStorage.getItem('cart') ? JSON.parse(window.localStorage.getItem('cart')) : [],
         cartLength: window.localStorage.getItem('jml') ? JSON.parse(window.localStorage.getItem('jml')) : 0,
         regencies : null,
         districts: null,
         villages: null,
         regencies_id : "default_regencies",
         districts_id: "default_districts",
         villages_id: "default_villages",
         pemesan: "",
         detail_alamat : "",
         no_tlp : "",
         ongkir : null
        },
        computed: {
            Total() {
            let total = 0;
            this.products.forEach(item => {
                if (item.diskon > 0) {
                  let diskon = (item.diskon / 100 * item.price)
                  total += (item.price - diskon) *  item.qty 
                }else{

                  total += (item.price * item.qty);
                }
            });
            return total + this.ongkir;
            }
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
            axios.get('{{ url('api/districts') }}/' + self.regencies_id)
              .then(function(response){
                self.districts = response.data;
              })
          },

          getVillagesData(){
            var self = this;
            axios.get('{{ url('api/villages') }}/' + self.districts_id)
              .then(function(response){
                self.villages = response.data;
              })
          },

          plus(itemToAdd,index) {

            // let found = false; 
            let itemFound = this.products.filter(item => item.id===itemToAdd.id);
              
              if (itemFound[0].qty >= 1) {
                  itemFound[0].qty += 1;
                    this.cartLength += 1;
              }
              window.localStorage.setItem('cart', JSON.stringify(this.products));
                 window.localStorage.setItem('jml', this.cartLength);
          },
          minus(itemToAdd,index) {

            // let found = false; 
            let itemFound = this.products.filter(item => item.id===itemToAdd.id);
              if (itemFound[0].qty == 1) {
                 this.cartLength -= 1;
                 this.products.splice(index, 1)
              }else if (itemFound[0].qty > 1) {
                  itemFound[0].qty -= 1;
                   this.cartLength -= 1;
              }
                window.localStorage.setItem('jml', this.cartLength);
               window.localStorage.setItem('cart', JSON.stringify(this.products));
          },

          isDisable() {
            return this.pemesan == "" || this.regencies_id == "default_regencies" || this.districts_id == "default_districts" || this.villages_id == "default_villages" || this.detail_alamat == "" || this.no_tlp == "";
          },
          ordernow(){
                        
            location.href = "https://wa.me/6289520306937?text="+ this.getDataOrder();
          },
             
          getDataOrder(){
            var text = "";
            var no = 1;
            text += "=================Assalamualaikum=============== "  + "\n" 
            text += "nama saya " + this.pemesan + "\n";
            text += "saya ingin memesan : " + "\n"
            for (let i = 0; i < this.products.length; i++) {
             text += no++ + ". ";
             text += this.products[i].name + " ";
             var slc = parseInt(this.products[i].size.slice(0,this.products[i].size.indexOf(" ")))  * this.products[i].qty;
            //  console.log(slc);
             this.products[i].size.indexOf("gram") > -1 ? text+= slc / 1000 + " Kg" : text += slc + " Kg";
            //  text += this.products[i].qty + " KG";
             text += "\n";
              // text += this.products[i].name;
              slc = 0;
            }

            text += "======================" + "\n";
              let total = 0;
            this.products.forEach(item => {
                let disonProduct = item.diskon > 0 ? (item.diskon / 100) * item.price : null;
                item.diskon > 0 ?  total += (item.price - disonProduct) *  item.qty : total += item.price * item.qty;
                
            });
            text += "Total : " + "Rp. " + total;
            return encodeURI(text);
          },
        },

        watch: {
          regencies_id : function(va, oldVal){
            this.districts_id = "default_districts";
            this.getDistrictsData();
          },
          districts_id : function(va, oldVal){
            this.villages_id = "default_villages";
            this.getVillagesData();
            var self = this;
            axios.get('{{ url('api/get_ongkir') }}/' + self.districts_id)
              .then(function(response){
                if (response.data.length == 0) {
                  self.ongkir = 0;
                }else{
                  response.data.forEach(item => {
                    self.ongkir = item.ongkir;
                  });
                }
              })
          }
        },
      });
    </script>
    
@endpush