@extends('layouts.app')

@section('title')
    Store Homepage 
@endsection

@push('prepend-style')
  <style>
    .diskon::before {
      content: '';
      position: absolute;
      width: 80%;
      height: 1.5px;
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
    <div class="page-content page-home" id="home">


      <nav class="navbar navbar-dark navbar-expand fixed-bottom bg-white" style="border: 1px solid rgb(243, 138, 112)">
    <ul class="navbar-nav nav-justified w-100">
        {{-- <li class="nav-item">
            <a href="#" class="nav-link text-center">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                    <path fill-rule="evenodd"
                        d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                </svg>
                <span class="small d-block">Home</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="{{ route('checkout') }}" class="nav-link text-center">
                  <img src="/images/shopping_cart.svg" alt="" />
                <span class="lg d-block" style="color: black">Cart @{{ cartLength }}</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="#" class="nav-link text-center">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                </svg>
                <span class="small d-block">Profile</span>
            </a>
        </li> --}}
    </ul>
</nav>


      <section class="store-carousel d-none d-lg-block d-xl-block">
        <div class="container">
          <div class="row">
            <div class="col-lg-12" data-aos="zoom-in">
              <div
                id="storeCarousel"
                class="carousel slide"
                data-ride="carousel"
              >
                <ol class="carousel-indicators">
                  <li
                    class="active"
                    data-target="#storeCarousel"
                    data-slide-to="0"
                  ></li>
                  <li data-target="#storeCarousel" data-slide-to="1"></li>
                  <li data-target="#storeCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img
                      src="/images/banner1.jpg"
                      alt="Carousel Image"
                      class="d-block w-100"
                      height="500px"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      src="/images/banner2.jpg"
                      alt="Carousel Image"
                      class="d-block w-100"
                      height="500px"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      src="/images/banner3.jpg"
                      alt="Carousel Image"
                      class="d-block w-100"
                      height="500px"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      {{-- <section class="mt-4">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>Pembukaan</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-2"></div>
            <div class="col-8 text-center">
              Atas berkat Rahmat Alloh SWT Kami Putra Indonesia mempersembahkan  SeaMura  (Seafood Murah) merupakan Hasil Perikanan Laut yang sudah dibekukan dengan standar sterilisasi dan uji kelayakan yang bagus dan tetap berkualitas Ekspor siap masak lengkap dg aneka pilihan bumbunya. Anda tidak perlu menghadapi Bau Amis, Kotor, Repot dalam pemasakan, dan juga tidak perlu repot untuk menakar bumbu olahan Hail Laut ini, kami sudah memberikan beserta dengan Bumbunya agar Memasak menjadi praktis, mudah, cepat, murah dan nikmat untuk Nusantara tercinta.
            </div>
            <div class="col-2"></div>
          </div>
        </div>
      </section> --}}
      <section class="mt-4">
        <div class="container">
        
           
            <div class="row">
                <div class="col-md-9" style="margin-bottom: -2rem;">
                    <div class="form-group">
                       <h5>Cari Product</h5>
                     
                        <input type="text" name="datacari" v-model="datacari" id="datacari" class="form-control" required>
                    </div>
                </div>
                {{-- <div class="col-md-5">
                    <div class="form-group">
                        <label for="branchs_id">Cabang</label>
                        <select name="branchs_id" id="branchs_id" class="form-control" v-if="branchs" v-model="branchs_id">
                            <option v-for="branch in branchs" :value="branch.id">@{{ branch.name }}</option>
                        </select>
                        <select v-else class="form-control"></select>
                    </div>
                </div> --}}
                <div class="col-md-3 mt-2">
                  <button class="btn btn-success btn-block mt-4" @click="cariproducts">Cari</button>
                </div>

              </div>
           
        </div>
        
      </section>
      <section class="store-trend-categories mt-5">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>Categories</h5>
            </div>
          </div>
          <div class="row">
            @php
              $incrementCategory = 0  
            @endphp
            
            @forelse ($categories as $category)
              <div
              class="col-6 col-md-3 col-lg-2"
              data-aos="fade-up"
              data-aos-delay="{{ $incrementCategory += 100 }}"
            >
              <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
                <div class="categories-image">
                  <img
                    src="{{ Storage::url($category->photo) }}"
                    alt=""
                    class="w-100"
                  />
                </div>
                <p class="categories-text">{{ $category->name }}</p>
              </a>
            </div>
            @empty
              <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">No Categories Found</div>
            @endforelse
            
            
          </div>
        </div>
      </section>

         <section class="store-new-products">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5 class="mb-3">New Products</h5>
            </div>
          </div>
          <div class="row">
            {{-- @php
              $incrementProduct = 0;
              @endphp --}}
            {{-- @forelse ($products as $product) --}}
            <div
                class="col-10 col-md-4 col-lg-3 mb-3"
                data-aos="fade-up"
                {{-- data-aos-delay="{{ $incrementProduct += 100 }}" --}}
                v-for="product in products"
                >
              <div class="card">
                <div class="card-body">
                  <div href="" class="component-products d-block"
                  ><div class="products-thumbnail">
                    {{-- <div
                      class="products-image"
                      style="background-image: url('{{ Storage::url(product.photo) }}')"
                    ></div> --}}
                    <img :src="product.photo"  class="products-image" alt="">
                    <div class="meta-satuan">@{{ product.size }}</div>
                    <div v-if="product.diskon" class="meta-diskon">Diskon @{{ product.diskon  }}%</div>
                  </div>
                  <div class="products-text">@{{ product.name }}</div>
                  <hr>
                  
                  <div class="row d-flex justify-content-center align-items-cente">
                    <div class="col">
                      <div class="products-price" :class="{'diskon' : product.diskon > 0}">Rp.@{{ product.price | formatCurrency}}</div>
                      <div v-if="product.diskon" class="products-price">Rp.@{{ product.price - ((product.diskon/100) * product.price)  | formatCurrency }}</div>
                    </div>
                    <div class="col-auto">
                      <button class="btn btn-cart text-right" @click="addToCart(product)"><img src="/images/icon-cart-empty.svg" alt="" /></button>
                    </div>
                  </div>

                </div>
                </div>
                
              </div>
                
              </div>


            {{-- @empty
              <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                No Products Found
              </div>
            @endforelse --}}
          </div>
          {{-- <div class="row">
            <div class="col-12 mt-4">
              {{ $products->links() }}
            </div>
          </div> --}}
        </div>
      </section>

     
    </div>
@endsection


@push('addon-script')
 <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
       Vue.use(Toasted);
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


      
       var home = new Vue({
        el: "#home",
        mounted() {
          AOS.init();
          this.getProductsData();
         
        },
        data: {
         products: null,
         products_id: null,
         datacari: null,
        cartItems: window.localStorage.getItem('cart') ? JSON.parse(window.localStorage.getItem('cart')) : [],
        cartLength: window.localStorage.getItem('jml') ? JSON.parse(window.localStorage.getItem('jml')) : 0,
         
        },
        methods: {
          getProductsData(){
            var self = this;
            axios.get('{{ route('api-getproductshome') }}')
              .then(function(response){
                self.products = response.data;
              })
          },

          addToCart(itemToAdd) {
            let found = false;

            // Add the item or increase qty
            let itemInCart = this.cartItems.filter(item => item.id===itemToAdd.id);
            let isItemInCart = itemInCart.length > 0;

            if (isItemInCart === false) {

               

              this.cartItems.push(Vue.util.extend({}, itemToAdd));
              
            } else {
              itemInCart[0].qty += itemToAdd.qty;
            }

            
            
            itemToAdd.qty = 1;
            this.cartLength += 1;
            window.localStorage.setItem('cart', JSON.stringify(this.cartItems));
            window.localStorage.setItem('jml', this.cartLength);
            this.$toasted.show(
              "Barang berhasil ditambahkan, silahkan klik cart untuk checkout",
              {
                position: "top-center",
                className: "rounded",
                duration: 3500,
              }
            );
          },
          cariproducts(){
            window.localStorage.setItem('cari', this.datacari);
            location.href = "http://fish.test/search";
          }
        },

       
      });
  </script>
@endpush