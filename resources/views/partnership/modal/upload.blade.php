@foreach($data as $value)
    <div class="modal fade" id="detailModal{{ $value->code }}" tabindex="-1" aria-labelledby="orderViewModalLabel{{ $value->code }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header py-4" style="background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);">
                    <div class="d-flex align-items-center w-100">
                        <div class="me-3">
                            <i class="bi bi-receipt text-primary fs-3"></i>
                        </div>
                        <div>
                            <h5 class="modal-title text-white mb-0" id="orderViewModalLabel{{ $value->code }}">
                                Partner Code #{{ $value->code }}
                            </h5>
                        </div>
                    </div>
                    <button type="button"
                            class="btn-close btn-close-white"
                            data-dismiss="modal"
                            aria-label="Close"
                            style="margin-left: auto; margin-right: 10px;">
                    </button>
                </div>
                <div class="modal-body bg-light">

                    <!-- Upload Form Section -->
                    <div class="bg-white rounded-3 p-3 shadow-sm mb-3">
                        <div class="mb-2 fw-semibold">Upload Surat Balasan & Bukti Pembayaran</div>

                        <form action="{{route('partnership.replyFile.upload')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $value->id }}">
                            <div class="mb-3">
                                <label for="response_letter{{ $value->code }}" class="form-label fw-semibold">File Surat Balasan</label>
                                <div class="custom-file-container">
                                    <div class="custom-file-input">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="response_letter{{ $value->code }}" name="reply_file" accept="application/pdf">
                                            <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('response_letter{{ $value->code }}').value = ''">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mt-1">
                                        <i class="bi bi-info-circle me-1"></i>Format: PDF saja (Maks. 5MB)
                                    </small>

                                    @if(isset($value->reply_file))
                                        <div class="file-preview">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3"><i class="bi bi-file-earmark-pdf text-danger fs-4"></i></div>
                                                <div>
                                                    <p class="mb-1 fw-medium">Surat Balasan</p>
                                                    <a href="{{ asset($value->reply_file) }}" class="btn btn-sm btn-info" target="_blank">
                                                        <i class="bi bi-eye me-1"></i> Lihat Dokumen
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="payment_proof{{ $value->code }}" class="form-label fw-semibold">Bukti Pembayaran</label>
                                <div class="custom-file-container">
                                    <div class="custom-file-input">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="payment_proof{{ $value->code }}" name="payment_proof" accept="image/jpeg,image/png,image/jpg">
                                            <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('payment_proof{{ $value->code }}').value = ''">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mt-1">
                                        <i class="bi bi-info-circle me-1"></i>Format: JPG, JPEG, atau PNG (Maks. 2MB)
                                    </small>

                                    @if(isset($value->payment_proof))
                                        <div class="file-preview">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3"><i class="bi bi-image text-success fs-4"></i></div>
                                                <div>
                                                    <p class="mb-1 fw-medium">Bukti Pembayaran</p>
                                                    <img src="{{ asset($value->payment_proof) }}"
                                                         class="img-fluid rounded border"
                                                         style="max-height: 100px; cursor: pointer;"
                                                         onclick="window.open(this.src, '_blank')"
                                                         alt="Bukti Pembayaran">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="action-buttons">
                                <a href="{{asset('surat-balasan.pdf')}}" target="_blank" class="btn btn-primary">
                                    <i class="bi bi-download me-1"></i> Download Template
                                </a>
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="bi bi-cloud-upload me-1"></i> Upload Files
                                </button>
                            </div>

                            <div class="alert alert-info mt-3 mb-0">
                                <i class="bi bi-info-circle me-2"></i>
                                <small>
                                    Silahkan download template surat balasan terlebih dahulu. Isi sesuai dengan data yang diperlukan,
                                    kemudian upload kembali dalam format PDF.
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<style>
    .badge-status.pending { background: #ffe082; color: #856404; }
    .badge-status.success { background: #c8e6c9; color: #256029; }
    .badge-status.cancel { background: #ffcdd2; color: #b71c1c; }
    .badge-status.other { background: #e3e3e3; color: #333; }
    .badge-status.packaged { background: #0da8ee; color: #0a568c; }
    .badge-status.sending { background: #00bb00; color: #0a001f; }
    .badge-status.done { background: #9fcdff; color: #0f253c; }
    .bg-primary-subtle { background: #e7e9fd !important; }
    @media (max-width: 576px) {
        .modal-lg { max-width: 98vw; }
        .modal-body .row > [class^="col-"] { flex: 0 0 100%; max-width: 100%; }
    }

    /* Custom file input styling */
    .custom-file-container {
        position: relative;
        margin-bottom: 15px;
    }

    .custom-file-input {
        position: relative;
        z-index: 2;
        width: 100%;
        height: calc(1.5em + 0.75rem + 10px);
        margin: 0;
        overflow: hidden;
    }

    .custom-file-input .form-control {
        border: 2px dashed #ced4da;
        border-radius: 8px;
        transition: all 0.3s ease;
        padding: 10px;
        background-color: #f8f9fa;
    }

    .custom-file-input:hover .form-control {
        border-color: #adb5bd;
        background-color: #f0f0f0;
    }

    .custom-file-input .form-control:focus {
        border-color: #4e54c8;
        box-shadow: 0 0 0 0.2rem rgba(78, 84, 200, 0.15);
        background-color: #f0f0f0;
    }

    /* File preview container */
    .file-preview {
        margin-top: 12px;
        padding: 12px;
        border-radius: 8px;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .file-preview:hover {
        border-color: #ced4da;
        background-color: #f0f0f0;
    }

    /* File input button styling */
    .input-group .btn-outline-secondary {
        border-color: #ced4da;
        color: #495057;
    }

    .input-group .btn-outline-secondary:hover {
        background-color: #e9ecef;
        color: #212529;
    }

    /* Action buttons */
    .action-buttons {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .action-buttons .btn-primary {
        background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
        border: none;
        transition: all 0.3s;
    }

    .action-buttons .btn-primary:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .action-buttons .btn-success {
        background: linear-gradient(90deg, #00b09b 0%, #96c93d 100%);
        border: none;
        transition: all 0.3s;
    }

    .action-buttons .btn-success:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
