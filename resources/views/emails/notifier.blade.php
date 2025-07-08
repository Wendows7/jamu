<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pengajuan Proposal Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .header {
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .content {
            font-size: 15px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #888;
            text-align: center;
        }
    /*    make style for button*/
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Notifikasi Pengajuan Proposal</h2>
    </div>
    <div class="content">
        <p>Halo,</p>
        <p>Anda menerima pesan baru dari calon mitra yang ingin menjalin kerja sama.
            Mohon segera cek dashboard admin untuk informasi lebih lanjut dan tindak lanjuti permintaan tersebut.</p>

        <ul>
            <li><strong>Nama Pengaju:</strong> {{$data->name}}</li>
            <li><strong>Email Pengaju:</strong> {{$data->email}}</li>
            <li><strong>Nomor Telpon Pengaju:</strong> {{$data->phone}}</li>
            <li><strong>Tanggal Pengajuan:</strong> {{ now()->format('d M Y, H:i') }}</li>
        </ul>

        <p>Silakan cek sistem untuk meninjau pengajuan ini lebih lanjut.</p>

        <a href="{{env('APP_URL')}}"><button>Kunjungi Dashboard</button></a>
    </div>
</div>
</body>
</html>
