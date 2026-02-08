<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
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
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .btn-back {
            margin-right: 10px;
        }
        .form-label {
            font-weight: 500;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">
                <i class="bi bi-person-plus"></i> Tambah Data Mahasiswa
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

            <!-- Pesan Sukses -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Tambah Data -->
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nim" class="form-label">
                        <i class="bi bi-card-text"></i> NIM
                    </label>
                    <input type="text" 
                           class="form-control @error('nim') is-invalid @enderror" 
                           id="nim" 
                           name="nim" 
                           value="{{ old('nim') }}"
                           placeholder="Masukkan NIM (Contoh: 20210001)"
                           required>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">NIM harus unik dan tidak boleh duplikat</small>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">
                        <i class="bi bi-person"></i> Nama Lengkap
                    </label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}"
                           placeholder="Masukkan nama lengkap"
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
                           value="{{ old('kelas') }}"
                           placeholder="Masukkan kelas (Contoh: TI-A, SI-B)"
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
                           value="{{ old('matakuliah') }}"
                           placeholder="Masukkan mata kuliah"
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
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Data
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
        });
        
        // Konfirmasi reset form
        document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin mengosongkan form?')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>