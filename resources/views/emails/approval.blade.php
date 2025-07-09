<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Proposal</title>
    <style>
        body {
            background-color: #f2f4f8;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.06);
        }

        .header {
            background-color: {{ $data->status == 'approved' ? '#4CAF50' : '#F44336' }};
            padding: 24px 32px;
            color: #ffffff;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
        }

        .content {
            padding: 32px;
        }

        .content p {
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .status-box {
            background-color: #f8f9fa;
            border-left: 6px solid {{ $data->status == 'approved' ? '#4CAF50' : '#F44336' }};
            padding: 20px 25px;
            margin: 25px 0;
            border-radius: 8px;
        }

        .status-box p {
            margin: 0 0 10px;
            font-size: 14.5px;
        }

        .footer {
            padding: 20px 32px;
            text-align: center;
            font-size: 13px;
            color: #999;
            background-color: #fafafa;
            border-top: 1px solid #eee;
        }

        strong {
            color: #222;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>&nbsp;Status Proposal Anda</h2>
    </div>

    <div class="content">
        <p>&nbsp;Halo <strong>{{ $data->name }}</strong>,</p>

        <p>&nbsp;Terima kasih telah mengajukan dan mengirimkan proposal kerja sama dengan kami pada
            &nbsp;<strong>{{ $data->created_at->format('d M Y, H:i') }}</strong>.
        </p>

        <div class="status-box">
            <p><strong>Status:</strong> {{ strtoupper($data->status == 'approved' ? 'diterima' : 'ditolak') }}</p>
            @if($data->status == 'approved')
                <p>Selamat! Proposal Anda telah diterima untuk proses selanjutnya.</p>
            @else
                <p>Mohon maaf, proposal Anda belum dapat diterima pada saat ini.</p>
            @endif
        </div>

        @if(!empty($data->catatan))
            <p><strong>Catatan dari reviewer:</strong><br>
                {{ $data->catatan }}
            </p>
        @endif
    @if($data->status == 'approved')
            <p>Team kami akan menghubungi kamu melalui nomor telepon yang telah anda berikan.</p>

    @endif
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} {{env('APP_NAME')}}<br>
        Email ini dikirim secara otomatis. Mohon untuk tidak membalas.
    </div>
</div>
</body>
</html>
