<!-- resources/views/customer/modal/checkout.blade.php -->
@foreach($orders as $order)
    <div id="popupForm{{ $order['order_code'] }}" class="popup-modal hidden">
        <div class="popup-content animate__animated animate__zoomIn" style="max-width:600px;width:90%;padding:40px 32px;">
            <span class="close-btn" id="closePopupBtn{{ $order['order_code'] }}" style="font-size:32px;top:18px;right:28px;">&times;</span>
            <h2 style="margin-bottom:10px;">Form Data Pembelian</h2>
            <p style="font-size:1.1em;color:#555;margin-bottom:24px;">
                Silakan isi form di bawah ini untuk melanjutkan proses pembelian.<br>
                <b>Pastikan semua informasi yang diberikan akurat dan lengkap.</b>
            </p>
            <form method="POST" action="{{route('user.createOrderDetail')}}">
                @csrf
                <input type="hidden" name="orderCode" value="{{ $order['order_code'] }}">
                <div class="form-group" style="margin-bottom:18px;">
                    <label for="first_name" style="font-weight:600;">Nama Depan</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Masukkan nama depan anda" required>
                </div>
                <div class="form-group" style="margin-bottom:18px;">
                    <label for="last_name" style="font-weight:600;">Nama Belakang</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Masukkan nama belakang Anda" required>
                </div>
                <div class="form-group" style="margin-bottom:18px;">
                    <label for="address" style="font-weight:600;">Alamat Pengiriman</label>
                    <textarea name="address" class="form-control" rows="4" placeholder="Masukkan alamat lengkap pengiriman" required></textarea>
                </div>
                <div class="form-group" style="margin-bottom:24px;">
                    <label for="phone" style="font-weight:600;">Nomor Telepon</label>
                    <input type="tel" name="phone_number" class="form-control" placeholder="Contoh: 081234567890" required>
                </div>
                <div class="alert alert-info" style="background:#e7f3fe;color:#31708f;padding:12px 18px;border-radius:6px;margin-bottom:24px;">
                    <b>Catatan:</b> Data ini akan digunakan untuk pengiriman pesanan dan
                    konfirmasi pembelian. Pastikan informasi yang diberikan akurat.
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;padding:12px 20px;font-size:1.1em;">Kirim Data</button>
            </form>
        </div>
    </div>
@endforeach

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    .popup-modal.hidden { display: none; }
    .popup-modal { position: fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:9999; display:flex; align-items:center; justify-content:center; }
    .popup-content { background:#fff; border-radius:12px; box-shadow:0 2px 16px rgba(0,0,0,0.07); }
    .close-btn { cursor:pointer; position:absolute; right:20px; top:20px; }
</style>

<style>
    .popup-content {
        max-width: 500px !important;
        width: 98vw !important;
        padding: 40px 32px !important;
        position: relative;
        max-height: 500px; /* adjust as needed */
        overflow-y: auto;
    }
    @media (max-width: 400px) {
        .popup-content {
            max-width: 99vw !important;
            width: 99vw !important;
            padding: 10px 4px !important;
            max-height: 340px; /* adjust for mobile */
        }
    }
</style>
