ini page show product
<h1>Detail roduk Hotel</h1>
<br>
<h3>Nama Produk : {{ $data->name }}</h3>
<h3>Dimiliki Hotel: {{ $data->hotel->name }}</h3>
<h3>Tarif: Rp. {{ $data->price }}</h3>



<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card" style="border-radius: 15px;">
                    <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light"
                        data-mdb-ripple-color="light">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/12.webp"
                            style="border-top-left-radius: 15px; border-top-right-radius: 15px;" class="img-fluid"
                            alt="Laptop" />
                        <a href="#!">
                            <div class="mask"></div>
                        </a>
                    </div>
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p><a href="#!" class="text-dark">Dell Xtreme 270</a></p>
                                <p class="small text-muted">Laptops</p>
                            </div>
                            <div>
                                <div class="d-flex flex-row justify-content-end mt-1 mb-4 text-danger">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="small text-muted">Rated 4.0/5</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between">
                            <p><a href="#!" class="text-dark">$3,999</a></p>
                            <p class="text-dark">#### 8787</p>
                        </div>
                        <p class="small text-muted">VISA Platinum</p>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center pb-2 mb-1">
                            <a href="#!" class="text-dark fw-bold">Cancel</a>
                            <button type="button" class="btn btn-primary">Buy now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
