<nav
    class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
    data-aos="fade-down"
    style="border-bottom: 1px solid rgba(194, 188, 188, 0.74)"
>
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand d-none d-lg-block d-xl-block"
            ><img src="/images/logo.svg" alt=""
        />Fish</a>

        <div class="d-xl-none d-lg-none">
             <button onclick="goBack()" class="btn navbar-brand">
                <img src="/images/back.svg" alt="" />
            </button>
        </div>

         <a href="{{ route('home') }}" class="navbar-brand d-xl-none d-lg-none"
            ><img src="/images/logo.svg" alt=""
        />Fish</a>
        

        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('search') }}" class="nav-link">Cari Produk</a>
                </li>
            

        
            </ul>
        </div>
    </div>
</nav>

