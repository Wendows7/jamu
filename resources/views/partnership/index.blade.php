@extends('layouts.main')

@section('body')
    <style>
        /* Partnership Page Styling */
        .ec-page-content {
            padding: 80px 0;
            background-color: #f7f7f7;
        }

        .ec-common-wrapper {
            display: flex;
            flex-wrap: wrap;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* Left Side - Contact Form */
        .ec-contact-leftside {
            flex: 1;
            min-width: 300px;
            padding: 30px;
        }

        .ec-contact-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .ec-contact-form form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .ec-contact-wrap {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .ec-contact-wrap label {
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .ec-contact-wrap input,
        .ec-contact-wrap textarea {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .ec-contact-wrap input:focus,
        .ec-contact-wrap textarea:focus {
            border-color: #FF8C00;
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 140, 0, 0.2);
        }

        .ec-contact-wrap textarea {
            min-height: 120px;
            resize: vertical;
        }

        .ec-contact-btn .btn-primary {
            background-color: #FF8C00;
            border-color: #FF8C00;
            /*padding: 12px 25px;*/
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .ec-contact-btn .btn-primary:hover {
            background-color: #e67e00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 140, 0, 0.3);
        }

        /* Right Side - Map and Contact Info */
        .ec-contact-rightside {
            flex: 1;
            min-width: 300px;
            background-color: #f9f9f9;
        }

        .ec_map_canvas {
            height: 300px;
            width: 100%;
        }

        .ec_map_canvas iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .ec_contact_info {
            padding: 30px;
        }

        .ec_contact_info_head {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
        }

        .ec_contact_info ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .ec_contact_info .ec-contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            color: #666;
        }

        .ec_contact_info .ec-contact-item i {
            margin-right: 12px;
            color: #FF8C00;
            font-size: 18px;
            margin-top: 4px;
        }

        .ec_contact_info .ec-contact-item span {
            font-weight: 500;
            margin-right: 8px;
            color: #333;
        }

        .ec_contact_info .ec-contact-item a {
            color: #FF8C00;
            text-decoration: none;
            transition: color 0.2s;
        }

        .ec_contact_info .ec-contact-item a:hover {
            color: #e67e00;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .ec-common-wrapper {
                flex-direction: column;
            }

            .ec-contact-leftside,
            .ec-contact-rightside {
                width: 100%;
            }
        }

        /* File Input Styling */
        .ec-contact-wrap input[type="file"] {
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            width: 100%;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .ec-contact-wrap input[type="file"]:hover {
            background-color: #f0f0f0;
            border-color: #ccc;
        }

        .ec-contact-wrap input[type="file"]:focus {
            border-color: #FF8C00;
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 140, 0, 0.2);
        }

        /* Custom file input styling */
        .ec-file-wrapper {
            position: relative;
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .ec-file-btn {
            display: inline-block;
            position: relative;
            overflow: hidden;
            padding: 12px 15px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .ec-file-btn:hover {
            background-color: #f0f0f0;
            border-color: #ccc;
        }

        .ec-file-btn span {
            display: inline-block;
            color: #666;
        }

        .ec-file-btn input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .ec-file-name {
            margin-top: 8px;
            font-size: 14px;
            color: #666;
            word-break: break-all;
        }
    </style>
    <body>
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-common-wrapper">
                    <div class="ec-contact-leftside">
                        <div class="ec-contact-container">
                            <div class="ec-contact-form">
                                <form action="{{route('partnership.create')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <span class="ec-contact-wrap">
                                        <label>Full Name*</label>
                                        <input type="text" name="name" placeholder="Enter your first name"
                                               required />
                                    </span>
                                    <span class="ec-contact-wrap">
                                        <label>Email*</label>
                                        <input type="email" name="email" placeholder="Enter your email address"
                                               required />
                                    </span>
                                    <span class="ec-contact-wrap">
                                        <label>Phone Number*</label>
                                        <input type="text" name="phone" placeholder="Enter your phone number"
                                               required />
                                    </span>
                                    <span class="ec-contact-wrap">
                                        <label>Your Proposal* (PDF files only)</label>
                                        <div class="ec-file-wrapper">
                                            <div class="ec-file-btn">
                                                <span>Choose PDF File</span>
                                                <input type="file" name="file" required accept="application/pdf" onchange="validatePdfFile(this)"/>
                                            </div>
                                            <div class="ec-file-name" id="file-name">No file chosen</div>
                                            <div class="file-error" id="file-error" style="color: #e74c3c; font-size: 12px; margin-top: 5px; display: none;">
                                                Please select a PDF file only
                                            </div>
                                        </div>
                                    </span>
                                    <span class="ec-contact-wrap ec-contact-btn">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="ec-contact-rightside">
                        <div class="ec_contact_map">
                            <div class="ec_map_canvas">
                                <iframe id="ec_map_canvas"
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.4882567425966!2d98.6632663758934!3d3.7030605962709084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3036cd47d0fa573d%3A0xe3a96146b0ca56f9!2sJAMU%20DAPOER%20NISWAH!5e0!3m2!1sid!2sid!4v1751995190268!5m2!1sid!2sid"></iframe>
                                <a href="https://sites.google.com/view/maps-api-v2/mapv2"></a>
                            </div>
                        </div>
                        <div class="ec_contact_info">
                            <h1 class="ec_contact_info_head">Contact us</h1>
                            <ul class="align-items-center">
                                <li class="ec-contact-item"><i class="ecicon eci-map-marker"
                                                               aria-hidden="true"></i><span>Address:</span>Gg. Karya, Rengas Pulau, Kec. Medan Marelan, Kota Medan, Sumatera Utara 20252</li>
                                <li class="ec-contact-item align-items-center"><i class="ecicon eci-phone"
                                                                                  aria-hidden="true"></i><span>Call Us:</span><a href="tel:+6285370473384">+62 8537 0473 384</a></li>
                                <li class="ec-contact-item align-items-center"><i class="ecicon eci-envelope"
                                                                                  aria-hidden="true"></i><span>Email:</span><a
                                        href="mailto:admin@jamudapoerniswah.shop">admin@jamudapoerniswah.shop</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>

    <script>
        function updateFileName(input) {
            const fileName = input.files[0] ? input.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        }

        function validatePdfFile(input) {
            const fileError = document.getElementById('file-error');
            const fileName = document.getElementById('file-name');

            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Check if file is a PDF (by extension and MIME type)
                const validExtension = file.name.toLowerCase().endsWith('.pdf');
                const validMimeType = file.type === 'application/pdf';

                if (validExtension && validMimeType) {
                    fileName.textContent = file.name;
                    fileError.style.display = 'none';
                } else {
                    // Reset the file input
                    input.value = '';
                    fileName.textContent = 'No file chosen';
                    fileError.style.display = 'block';
                }
            } else {
                fileName.textContent = 'No file chosen';
                fileError.style.display = 'none';
            }
        }
    </script>
@endsection
