<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            border-bottom: 2px solid #ffc107;
            padding-bottom: 10px;
        }
        .btn-back {
            margin-right: 10px;
        }
        .form-label {
            font-weight: 500;
        }
        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255,193,7,.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">
                <i class="bi bi-pencil-square"></i> Edit Data Mahasiswa
            </h2>

            <!-- Pesan Error Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Edit Data -->
            <form action="{{ route('mahasiswa.update', $mahasiswa->nim) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nim" class="form-label">
                        <i class="bi bi-card-text"></i> NIM
                    </label>
                    <input type="text" 
                           class="form-control @error('nim') is-invalid @enderror" 
                           id="nim" 
                           name="nim" 
                           value="{{ old('nim', $mahasiswa->nim) }}"
                           required>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">
                        <i class="bi bi-person"></i> Nama Lengkap
                    </label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama', $mahasiswa->nama) }}"
                           required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kelas" class="form-label">
                        <i class="bi bi-building"></i> Kelas
                    </label>
                    <input type="text" 
                           class="form-control @error('kelas') is-invalid @enderror" 
                           id="kelas" 
                           name="kelas" 
                           value="{{ old('kelas', $mahasiswa->kelas) }}"
                           required>
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="matakuliah" class="form-label">
                        <i class="bi bi-book"></i> Mata Kuliah
                    </label>
                    <input type="text" 
                           class="form-control @error('matakuliah') is-invalid @enderror" 
                           id="matakuliah" 
                           name="matakuliah" 
                           value="{{ old('matakuliah', $mahasiswa->matakuliah) }}"
                           required>
                    @error('matakuliah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <div>
                        <button type="reset" class="btn btn-warning me-2">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Update Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-focus ke field pertama
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nim').focus();
            document.getElementById('nim').select();
        });
        
        // Konfirmasi sebelum meninggalkan halaman jika ada perubahan
        let formChanged = false;
        const formInputs = document.querySelectorAll('input, select, textarea');
        
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                formChanged = true;
            });
        });
        
        window.addEventListener('beforeunload', function(e) {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = 'Perubahan yang belum disimpan akan hilang. Yakin ingin meninggalkan halaman?';
            }
        });
        
        // Reset formChanged saat form submit
        document.querySelector('form').addEventListener('submit', function() {
            formChanged = false;
        });
    </script>
</body>
</html>