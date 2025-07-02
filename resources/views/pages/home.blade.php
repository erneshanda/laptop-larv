@extends('layouts.app-public')
@section('title', 'Home')
@section('content')
    <div class="site-wrapper-reveal">
        <div class="hero-box-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Hero Slider Area Start -->
                        <div class="hero-area" id="product-preview">
                        </div>
                        <!-- Hero Slider Area End -->
                    </div>
                </div>
            </div>
        </div>

        <div class="about-us-area section-space--ptb_120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-us-content_6 text-center">
                            <h2>Bakul Laptop&nbsp;&nbsp;Store</h2>
                            <p>
                                <small>
                                    Kisah kami bermula pada tahun 1993. Lahir sebagai pelopor e-commerce, Bakul Laptop B2B eCommerce menciptakan ekosistem bisnis yang memudahkan korporasi dan pemerintah dalam menjalankan bisnis. Melalui tiga kategori utama unggulan Kami dalam memenuhi kebutuhan berbagai industri dan skala usaha, yaitu kategori IT, MRO (Maintenance, Repair, Operation), Solution & Services, kami telah membantu jutaan konsumen untuk mengelola bisnis mereka. 
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="banner-video-area overflow-hidden mb-8">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-video-box">
                        <img src="{{asset('assets/images/A7207805-2.webp')}}" alt="">
                        <div class="video-icon">
                            <a href="https://youtu.be/Na5KPnx0u58?si=PPoJfum8xG-Jt8h9" class="popup-youtube">
                                <i class="linear-ic-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('addtion_cs')
@endsection
@section('addition_script')
    <script src="{{asset('pages/js/home.js')}}"></script>
@endsection
