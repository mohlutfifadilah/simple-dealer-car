<!-- Topbar Start -->
        <div class="container-fluid topbar bg-secondary d-none d-xl-block w-100" id="beranda">
            <div class="container">
                <div class="row gx-0 align-items-center" style="height: 45px;">
                    <div class="col-lg-6 text-center text-lg-start mb-lg-0">
                        <div class="d-flex flex-wrap">
                            <a href="#" class="text-muted me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Suzuki Mobil Pemuda</a>
                            <a href="tel:tel:+62813 8082 9259" class="text-muted me-4"><i class="fas fa-phone-alt text-primary me-2"></i>{{ $no }}</a>
                            <a href="https://wa.me/ {{ $no }}" target="_blank" rel="noopener noreferrer" class="text-muted me-4"><i class="fab fa-whatsapp text-primary me-2"></i>+{{ $no }}</a>
                            <!-- <a href="mailto:suzukiindomobilsemarang@gmail.com" class="text-muted me-0"><i class="fas fa-envelope text-primary me-2"></i>suzukiindomobilsemarang@gmail.com</a> -->
                        </div>
                    </div>
                    <div class="col-lg-6 text-center text-lg-end">
                        <div class="d-flex align-items-center justify-content-end">
                            <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i class="fab fa-facebook-f"></i></a>
                            <!-- <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i class="fab fa-twitter"></i></a> -->
                            <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i class="fab fa-instagram"></i></a>
                            <!-- <a href="#" class="btn btn-light btn-sm-square rounded-circle me-0"><i class="fab fa-linkedin-in"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid nav-bar sticky-top px-0 px-lg-4 py-2 py-lg-0">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a href="" class="navbar-brand p-0">
                        <!-- <h1 class="display-6 text-primary"><i class="fas fa-car-alt me-3"></i></i>Cental</h1> -->
                        <img src="{{ asset('main/img/logo.png') }}" alt="Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav mx-auto py-0">
                            <a href="/#beranda" class="nav-item nav-link">Beranda</a>
                            <a href="/#tentang" class="nav-item nav-link">Tentang</a>
                            <a href="/#layanan" class="nav-item nav-link">Layanan</a>
                            <a href="/#produk" class="nav-item nav-link">Produk</a>
                            <!-- <a href="blog.html" class="nav-item nav-link">Blog</a> -->

                            <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu m-0">
                                    <a href="feature.html" class="dropdown-item">Our Feature</a>
                                    <a href="cars.html" class="dropdown-item">Our Cars</a>
                                    <a href="team.html" class="dropdown-item">Our Team</a>
                                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                    <a href="404.html" class="dropdown-item">404 Page</a>
                                </div>
                            </div> -->
                            <a href="/kontak" class="nav-item nav-link {{ Request::segment(1) === 'kontak' ? 'active' : '' }}">Kontak</a>
                        </div>
                        <!-- <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Get Started</a> -->
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar & Hero End -->
