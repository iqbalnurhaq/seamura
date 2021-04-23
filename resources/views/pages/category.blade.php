@extends('layouts.app')

@section('title')
    Store Category Page 
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
  </style>
@endpush

@section('content')

<div id="cart">
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
  <div class="page-content page-home">
      
      <section class="store-new-products">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5 class="mb-3">{{ $category->name }}</h5>
            </div>
          </div>
          <div class="row">
            {{-- @php
              $incrementProduct = 0;
              @endphp --}}
            {{-- @forelse ($products as $product) --}}
            <div
                class="col-10 col-md-4 col-lg-3"
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
                  <hr>
                  <p class="text-center" style="font-size: 14px">Hanya Tesedia di:</p>
                 <p style="font-size: 14px">kota malang, Kota Surakarta</p>

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

      var cart = new Vue({
        el: "#cart",
        mounted() {
          AOS.init();
          this.getProductsData();
         
        },
        data: {
         products: null,
         products_id: null,
        cartItems: window.localStorage.getItem('cart') ? JSON.parse(window.localStorage.getItem('cart')) : [],
        cartLength: window.localStorage.getItem('jml') ? JSON.parse(window.localStorage.getItem('jml')) : 0,
         
        },
        methods: {
          getProductsData(){
            var self = this;
            axios.get('{{ url('api/products') }}/@php echo $category->slug @endphp')
              .then(function(response){
                // for (let i = 0; i < response.data.length; i++) {
                //   response.data[i].photo = "{{ Storage::url(" + response.data[i].photo + ") }}"
                // }
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
          
            // if (this.cartItems.diskon > 0) {
            //   let diskon = this.cartItems.diskon / 100 * this.cartItems.price;
            //   let coba = this.cartItems.price - diskon;
            //   console.log("wkwkwkw");
            //   window.localStorage.setItem('coba', coba);
            // }

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
          }
        },

       
      });
    </script>
@endpush