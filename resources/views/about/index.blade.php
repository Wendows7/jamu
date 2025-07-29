@extends('layouts.main')

@section('body')
<style>
    .mission-section {
        text-align: left;
        margin: 20px 0;
    }

    .mission-title {
        font-weight: bold;
        margin-bottom: 15px;
    }

    .mission-list {
        padding-left: 20px;
    }

    .mission-list li {
        margin-bottom: 10px;
    }
</style>
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">About Us</h2>
                </div>
            </div>
            <div class="ec-common-wrapper">
                <div class="row">
                    <div class="col-md-6 ec-cms-block ec-abcms-block text-center">
                        <div class="ec-cms-block-inner">
                            <img class="a-img" src="{{asset('img/about.png')}}" alt="about">
                        </div>
                    </div>
                    <div class="col-md-6 ec-cms-block ec-abcms-block">
                        <div class="ec-cms-block-inner">
                            <h3 class="ec-cms-block-title">Apa itu Dapoer Jamu Niswah ?</h3>
                            <p>
                                Jamu Dapoer Niswah adalah salah satu UMKM yang bergerak di bidang produksi
                                minuman tradisional yang didirikan di Medan pada tanggal 27 Maret 2017.
                                Jamu Dapoer Niswah menggunakan bahan-bahan herbal pilihan berkualitas tinggi,
                                dipetik segar dari alam, tanpa bahan kimia berbahaya. Dan Jamu Dapoer Niswah juga
                                diproses dengan higienis dan teliti, untuk menjaga kualitas dan keamanan produk.
                                Dengan Tagline "Sehat Tanpa Obat".
                            </p>

                            <div class="vision-section mb-4">
                                <h5 class="vision-title fw-bold">Visi</h5>
                                <p>
                                    Menjadi perusahaan minuman tradisional yang paling diminati dengan memimpin
                                    modernisasi minuman tradisional melalui inovasi, penelitian perintis, dan
                                    kreatifitas, sambil menawarkan produk yang efektif, aman, halal, dan dapat diandalkan.
                                </p>
                            </div>

                            <div class="mission-section">
                                <h5 class="mission-title">Misi</h5>
                                <ol class="mission-list">
                                    <li>1. Mengedukasi masyarakat tentang pentingnya gaya hidup sehat dengan memperkenalkan kembali manfaat minuman tradisional Indonesia.</li>
                                    <li>2. Menghadirkan inovasi dalam produk jamu agar lebih praktis, higienis, dan sesuai dengan selera masyarakat modern tanpa mengurangi khasiat alaminya.</li>
                                    <li>3. Melestarikan warisan budaya melalui pengembangan minuman tradisional yang diwariskan secara turun-temurun, sekaligus memodernisasinya agar relevan dengan kebutuhan masa kini.</li>
                                    <li>4. Memberikan solusi kesehatan alami bagi masyarakat luas melalui produk berkualitas yang terbuat dari bahan alami pilihan, aman, dan bermanfaat.</li>
                                    <li>5. Mendukung terciptanya kehidupan yang lebih sehat dan bahagia dengan menjadi mitra terpercaya dalam menyediakan minuman herbal berkualitas tinggi.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!--  services Section Start -->
{{--    <section class="section ec-services-section section-space-p" id="services">--}}
{{--        <h2 class="d-none">Services</h2>--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="ec_ser_content ec_ser_content_1 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">--}}
{{--                    <div class="ec_ser_inner">--}}
{{--                        <div class="ec-service-image">--}}
{{--                            <i class="fi fi-ts-truck-moving"></i>--}}
{{--                        </div>--}}
{{--                        <div class="ec-service-desc">--}}
{{--                            <h2>Free Shipping</h2>--}}
{{--                            <p>Free shipping on all US order or order above $200</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="ec_ser_content ec_ser_content_2 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">--}}
{{--                    <div class="ec_ser_inner">--}}
{{--                        <div class="ec-service-image">--}}
{{--                            <i class="fi fi-ts-hand-holding-seeding"></i>--}}
{{--                        </div>--}}
{{--                        <div class="ec-service-desc">--}}
{{--                            <h2>24X7 Support</h2>--}}
{{--                            <p>Contact us 24 hours a day, 7 days a week</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="ec_ser_content ec_ser_content_3 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">--}}
{{--                    <div class="ec_ser_inner">--}}
{{--                        <div class="ec-service-image">--}}
{{--                            <i class="fi fi-ts-badge-percent"></i>--}}
{{--                        </div>--}}
{{--                        <div class="ec-service-desc">--}}
{{--                            <h2>30 Days Return</h2>--}}
{{--                            <p>Simply return it within 30 days for an exchange</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="ec_ser_content ec_ser_content_4 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">--}}
{{--                    <div class="ec_ser_inner">--}}
{{--                        <div class="ec-service-image">--}}
{{--                            <i class="fi fi-ts-donate"></i>--}}
{{--                        </div>--}}
{{--                        <div class="ec-service-desc">--}}
{{--                            <h2>Payment Secure</h2>--}}
{{--                            <p>Contact us 24 hours a day, 7 days a week</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection
