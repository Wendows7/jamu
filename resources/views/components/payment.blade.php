@extends('layouts.main')
@section('body')
    <style>
        .paypage-wrapper {
            min-height: 85vh;
            background: #f7f8fb;
            padding: 44px 0 30px 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }
        .paypage-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 6px 36px rgba(0,0,0,0.10);
            padding: 44px 34px 28px 34px;
            max-width: 500px;
            width: 98vw;
            margin: 0 auto;
            margin-top: 24px;
        }
        .paypage-title {
            color: #ff9000;
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: .5px;
            text-align: center;
            margin-bottom: 14px;
        }
        .paypage-info {
            margin-bottom: 26px;
            background: #fffaf1;
            border: 1.6px solid #ffe3b0;
            border-radius: 13px;
            padding: 19px 18px 9px 18px;
        }
        .pay-method-row {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 10px;
        }
        .pay-method-logo {
            width: 29px; height: 29px;
            border-radius: 50%;
            background: #f6f8fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.12rem;
            box-shadow: 0 0 0 1.3px #ffe2b0;
        }
        .pay-method-name {
            font-weight: 700;
            color: #222;
            font-size: 1.11rem;
            letter-spacing: .1px;
        }
        .rekening-label {
            display: block;
            color: #838383;
            font-size: .98rem;
            margin-bottom: 4px;
            margin-top: 10px;
        }
        .rekening-box {
            display: flex;
            align-items: center;
            background: #fff8ec;
            border: 1.6px solid #ffe2b0;
            border-radius: 11px;
            padding: 14px 14px;
            gap: 10px;
            font-size: 1.23rem;
            font-family: 'Menlo','Consolas',monospace;
            color: #ff9000;
            font-weight: 600;
            margin-bottom: 7px;
            transition: box-shadow .15s;
            position: relative;
        }
        .rekening-box:active, .rekening-box:focus-within { box-shadow: 0 2px 12px #fff4c2; }
        .copy-btn2 {
            border: none;
            background: #ffe2b0;
            color: #e38900;
            border-radius: 50%;
            width: 34px; height: 34px;
            display: flex;
            align-items: center; justify-content: center;
            font-size: 1.15rem;
            cursor: pointer;
            transition: background .14s;
            margin-left: 3px;
            position: relative;
            z-index: 2;
        }
        .copy-btn2:active, .copy-btn2.copied { background: #ffd591; color: #fff;}
        .copy-btn2 svg { width: 17px; height: 17px; }
        .copied-text {
            color: #23a05b;
            font-weight: 500;
            font-size: .97rem;
            margin-left: 8px;
            opacity: 0; transition: opacity .21s;
        }
        .rekening-box.copied .copied-text { opacity: 1;}
        .paypage-instructions {
            margin-top: 18px;
            margin-bottom: 23px;
            background: #fff8ef;
            border-radius: 10px;
            padding: 12px 16px;
            color: #684a00;
            font-size: .98rem;
            border-left: 5px solid #ff9000;
        }
        /* File Upload Custom */
        .paypage-form label[for="bukti_pembayaran"] {
            display: block;
            color: #232323;
            font-weight: 600;
            margin-bottom: 8px;
            margin-top: 7px;
        }
        .file-upload-group {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }
        .file-input-payment {
            display: none;
        }
        .file-label {
            background: #fffaf1;
            border: 1.5px solid #ffe3b0;
            color: #ff9000;
            padding: 11px 24px;
            border-radius: 7px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background .15s, color .15s;
        }
        .file-label:hover {
            background: #ffefd0;
            color: #d47b00;
        }
        .file-name {
            font-size: .96rem;
            color: #888;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 145px;
        }
        .paypage-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 9px;
        }
        .paypage-btn {
            border: none;
            border-radius: 8px;
            font-size: 1.11rem;
            padding: 13px 34px;
            font-weight: 700;
            cursor: pointer;
            transition: background .14s, color .14s;
            box-shadow: 0 1.5px 8px #fff4de40;
            letter-spacing: .2px;
        }
        .paypage-btn-primary {
            background: linear-gradient(90deg,#ffa726 0%, #ff9000 100%);
            color: #fff;
        }
        .paypage-btn-primary:hover { background: #ffb64d;}
        .paypage-btn-secondary {
            background: #f7f7f7;
            color: #444;
        }
        .paypage-btn-secondary:hover { background: #fff0db;}
        @media (max-width: 600px) {
            .paypage-card { width: 99vw; border-radius: 11px; padding: 14px 5vw 18px 5vw;}
            .paypage-title { font-size: 1.09rem;}
            .paypage-info { font-size: 1rem; padding: 12px 6vw 7px 6vw;}
            .file-name { max-width: 90px; }
        }
        /* Toast */
        .toast-copy {
            position: fixed;
            left: 50%;
            top: 28px;
            transform: translateX(-50%);
            background: #ff9000;
            color: #fff;
            font-size: .99rem;
            border-radius: 8px;
            padding: 11px 30px;
            z-index: 99999;
            opacity: 0;
            pointer-events: none;
            transition: opacity .21s;
            box-shadow: 0 2px 16px #ffe2b0;
        }
        .toast-copy.show { opacity: 1; pointer-events: all; }
    </style>

    <div class="paypage-wrapper">
        <div class="paypage-card">
            <div class="paypage-title">Bukti Pembayaran</div>
            <div class="paypage-info">
                <div class="pay-method-row">
{{--                    <span class="pay-method-logo">--}}
{{--                    <img src="{{ asset('img/BCA.png') }}" alt="logo" style="height:22px;width:auto;display:block;">--}}
{{--                </span>--}}
                    <span class="pay-method-name">
                    {{ strtoupper($paymentMethod->name ?? '-') }}
                </span>
                </div>
                <!-- No. Rekening / Akun -->
                <span class="rekening-label">No. Rekening / Akun</span>
                <div class="rekening-box" id="rekeningBox1">
                    <span id="rekeningText1">{{ $paymentMethod->number ?? '-' }}</span>
                    <button type="button" class="copy-btn2" id="copyBtn1" onclick="copyToClipboard('rekeningText1','rekeningBox1','copyBtn1','copiedText1')">
                        <svg viewBox="0 0 20 20" fill="none"><rect x="7" y="7" width="10" height="10" rx="2" stroke="currentColor" stroke-width="1.7"/><rect x="3" y="3" width="10" height="10" rx="2" fill="none" stroke="currentColor" stroke-width="1.7"/></svg>
                    </button>
                    <span class="copied-text" id="copiedText1">Tersalin!</span>
                </div>
                <!-- Total Tagihan -->
                <span class="rekening-label">Total Tagihan</span>
                <div class="rekening-box" id="rekeningBox2">
                    <span id="rekeningText2">Rp.{{ number_format($totalPrice) ?? '-' }}</span>
                    <button type="button" class="copy-btn2" id="copyBtn2" onclick="copyToClipboard('rekeningText2','rekeningBox2','copyBtn2','copiedText2')">
                        <svg viewBox="0 0 20 20" fill="none"><rect x="7" y="7" width="10" height="10" rx="2" stroke="currentColor" stroke-width="1.7"/><rect x="3" y="3" width="10" height="10" rx="2" fill="none" stroke="currentColor" stroke-width="1.7"/></svg>
                    </button>
                    <span class="copied-text" id="copiedText2">Tersalin!</span>
                </div>

            </div>
            <div class="paypage-instructions">
                Silakan transfer sesuai nominal ke rekening di atas, lalu upload bukti pembayaran Anda di bawah ini.<br>
                <b>Catatan:</b> Pastikan nominal sesuai & pembayaran dilakukan sebelum {{ now()->addDays(1)->format('d M Y H:i') }}.
            </div>
            <form action="{{route('cart.payment')}}" method="POST" enctype="multipart/form-data" class="paypage-form">
                @csrf
                <input type="hidden" name="orderCode" value="{{ $orderCode }}">
                <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
                <div class="file-upload-group">
                    <label for="bukti_pembayaran" class="file-label" tabindex="0">
                        Pilih File
                    </label>
                    <span class="file-name" id="fileName">Belum ada file</span>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="file-input-payment"  required accept="image/*">
                </div>
                <div class="paypage-actions">
                    <button type="submit" class="paypage-btn paypage-btn-primary">Upload</button>
                    <a href="{{ url()->previous() }}" class="paypage-btn paypage-btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
    <div id="toastCopy" class="toast-copy">Nomor berhasil disalin!</div>
    <script>
        // Tombol copy rekening (benar-benar jalan di semua browser modern)
        function copyRekening2() {
            var rekening = document.getElementById('rekeningText').textContent.trim();
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(rekening).then(success, errorFallback);
            } else {
                // Fallback: execCommand (untuk HTTP/non-https/non-localhost)
                let textarea = document.createElement("textarea");
                textarea.value = rekening;
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    document.execCommand('copy');
                    success();
                } catch (err) {
                    alert('Gagal copy!');
                }
                document.body.removeChild(textarea);
            }
            function success() {
                var box = document.getElementById('rekeningBox');
                var btn = document.getElementById('copyBtn2');
                var copied = document.getElementById('copiedText');
                box.classList.add('copied');
                btn.classList.add('copied');
                copied.style.opacity = 1;
                showToastCopy();
                setTimeout(() => {
                    box.classList.remove('copied');
                    btn.classList.remove('copied');
                    copied.style.opacity = 0;
                }, 1200);
            }
            function errorFallback() {
                alert('Gagal menyalin nomor rekening. Silakan salin manual.');
            }
        }

        function showToastCopy() {
            var toast = document.getElementById('toastCopy');
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 1600);
        }
        // File input custom
        document.addEventListener('DOMContentLoaded', function(){
            const input = document.getElementById('bukti_pembayaran');
            const label = document.querySelector('.file-label');
            const fileName = document.getElementById('fileName');
            label.addEventListener('keydown', function(e){
                if (e.key === 'Enter' || e.key === ' ') input.click();
            });
            // label.addEventListener('click', function(){ input.click(); });
            input.addEventListener('change', function(){
                fileName.textContent = input.files.length ? input.files[0].name : 'Belum ada file';
            });
        });

        function copyToClipboard(textId, boxId, btnId, copiedId) {
            var text = document.getElementById(textId).textContent.trim();

            // Hanya khusus untuk total tagihan, strip Rp. dan titik
            if (textId === 'rekeningText2') {
                text = text.replace(/rp\.?/i, '') // hilangkan "Rp." atau "Rp"
                    .replace(/[. ]/g, '')   // hilangkan titik pemisah ribuan & spasi
                    .replace(/,/g, '')      // hilangkan koma (jika ada)
                    .trim();
            }

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(success, errorFallback);
            } else {
                let textarea = document.createElement("textarea");
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    document.execCommand('copy');
                    success();
                } catch (err) {
                    alert('Gagal copy!');
                }
                document.body.removeChild(textarea);
            }
            function success() {
                var box = document.getElementById(boxId);
                var btn = document.getElementById(btnId);
                var copied = document.getElementById(copiedId);
                box.classList.add('copied');
                btn.classList.add('copied');
                copied.style.opacity = 1;
                showToastCopy();
                setTimeout(() => {
                    box.classList.remove('copied');
                    btn.classList.remove('copied');
                    copied.style.opacity = 0;
                }, 1200);
            }
            function errorFallback() {
                alert('Gagal menyalin. Silakan salin manual.');
            }
        }


    </script>
@endsection
