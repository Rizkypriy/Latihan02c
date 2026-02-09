<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mata Kuliah - {{ $matakuliah->nama_mk }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 40px;
        }
        .detail-card {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }
        .detail-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .detail-body {
            padding: 30px;
        }
        .info-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #4facfe;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 15px;
        }
        .badge-detail {
            font-size: 0.9rem;
            padding: 8px 15px;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Detail Card -->
        <div class="detail-card">
            <!-- Header -->
            <div class="detail-header">
                <div class="mb-3">
                    <i class="bi bi-book" style="font-size: 3rem;"></i>
                </div>
                <h1 class="h3 mb-2">{{ $matakuliah->nama_mk }}</h1>
                <p class="mb-0 opacity-75">
                    <code>{{ $matakuliah->kode_mk }}</code>
                </p>
            </div>

            <!-- Body -->
            <div class="detail-body">
                <!-- Info Boxes -->
                <div class="row">
                    <!-- Kode MK -->
                    <div class="col-md-6 mb-4">
                        <div class="info-box">
                            <div class="info-label">
                                <i class="bi bi-key me-1"></i>Kode Mata Kuliah
                            </div>
                            <div class="info-value">
                                <span class="badge bg-primary badge-detail">
                                    {{ $matakuliah->kode_mk }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Semester -->
                    <div class="col-md-6 mb-4">
                        <div class="info-box">
                            <div class="info-label">
                                <i class="bi bi-calendar-week me-1"></i>Semester
                            </div>
                            <div class="info-value">
                                <span class="badge bg-success badge-detail">
                                    Semester {{ $matakuliah->semester }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Nama MK -->
                    <div class="col-12 mb-4">
                        <div class="info-box">
                            <div class="info-label">
                                <i class="bi bi-journal-text me-1"></i>Nama Mata Kuliah
                            </div>
                            <div class="info-value">
                                {{ $matakuliah->nama_mk }}
                            </div>
                        </div>
                    </div>

                    <!-- SKS -->
                    <div class="col-12 mb-4">
                        <div class="info-box">
                            <div class="info-label">
                                <i class="bi bi-clock me-1"></i>SKS (Satuan Kredit Semester)
                            </div>
                            <div class="info-value">
                                <span class="badge bg-info badge-detail">
                                    <i class="bi bi-clock me-1"></i>{{ $matakuliah->sks }} SKS
                                </span>
                                <small class="text-muted ms-2">
                                    ({{ $matakuliah->sks * 50 }} menit per minggu)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metadata -->
                <div class="alert alert-light border">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="bi bi-calendar-plus me-1"></i>
                                <strong>Dibuat:</strong><br>
                                {{ $matakuliah->created_at->format('d F Y, H:i') }}
                            </small>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="bi bi-calendar-check me-1"></i>
                                <strong>Diupdate:</strong><br>
                                {{ $matakuliah->updated_at->format('d F Y, H:i') }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                    <a href="{{ route('matakuliah.edit', $matakuliah->kode_mk) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square me-1"></i>Edit
                    </a>
                    
                    <!-- Delete Button with Modal Trigger -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="bi bi-trash me-1"></i>Hapus
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-4">
            <small class="text-muted">
                <i class="bi bi-shield-check me-1"></i>
                Data ini hanya dapat diakses oleh pengguna terotorisasi.
            </small>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus mata kuliah ini?</p>
                    <div class="alert alert-warning">
                        <strong>{{ $matakuliah->kode_mk }} - {{ $matakuliah->nama_mk }}</strong><br>
                        <small>Data yang dihapus tidak dapat dikembalikan!</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Batal
                    </button>
                    <form action="{{ route('matakuliah.destroy', $matakuliah->kode_mk) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i>Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Print functionality
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'p') {
                e.preventDefault();
                window.print();
            }
        });
    </script>
</body>
</html>