<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mata Kuliah</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 40px;
        }
        .form-card {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }
        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }
        .form-body {
            padding: 30px;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }
        .form-help {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 4px;
        }
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px 30px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <!-- Header -->
            <div class="form-header">
                <h2 class="mb-3">
                    <i class="bi bi-bookmark-plus me-2"></i>Tambah Mata Kuliah
                </h2>
                <p class="mb-0 opacity-75">
                    Isi form berikut untuk menambahkan mata kuliah baru
                </p>
            </div>

            <!-- Form Body -->
            <div class="form-body">
                <!-- Validation Errors -->
                @if($errors->any())
                <div class="alert alert-danger">
                    <h6 class="alert-heading">
                        <i class="bi bi-exclamation-triangle me-1"></i>Perbaiki kesalahan berikut:
                    </h6>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Form -->
                <form action="{{ route('matakuliah.store') }}" method="POST">
                    @csrf

                    <!-- Kode MK -->
                    <div class="mb-4">
                        <label for="kode_mk" class="form-label">
                            <i class="bi bi-key me-1"></i>Kode Mata Kuliah
                        </label>
                        <input type="text" 
                               class="form-control @error('kode_mk') is-invalid @enderror" 
                               id="kode_mk" 
                               name="kode_mk" 
                               value="{{ old('kode_mk') }}"
                               placeholder="Contoh: MK001, TI101"
                               maxlength="10"
                               required
                               autofocus>
                        @error('kode_mk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-help">
                            Kode unik untuk mata kuliah (maks. 10 karakter)
                        </div>
                    </div>

                    <!-- Nama MK -->
                    <div class="mb-4">
                        <label for="nama_mk" class="form-label">
                            <i class="bi bi-journal-text me-1"></i>Nama Mata Kuliah
                        </label>
                        <input type="text" 
                               class="form-control @error('nama_mk') is-invalid @enderror" 
                               id="nama_mk" 
                               name="nama_mk" 
                               value="{{ old('nama_mk') }}"
                               placeholder="Contoh: Pemrograman Web, Basis Data"
                               maxlength="100"
                               required>
                        @error('nama_mk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-help">
                            Nama lengkap mata kuliah (maks. 100 karakter)
                        </div>
                    </div>

                    <!-- SKS -->
                    <div class="mb-4">
                        <label for="sks" class="form-label">
                            <i class="bi bi-clock me-1"></i>SKS (Satuan Kredit Semester)
                        </label>
                        <input type="number" 
                               class="form-control @error('sks') is-invalid @enderror" 
                               id="sks" 
                               name="sks" 
                               value="{{ old('sks') }}"
                               placeholder="1-6"
                               min="1" 
                               max="6"
                               required>
                        @error('sks')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-help">
                            Jumlah SKS (1-6)
                        </div>
                    </div>

                    <!-- Semester -->
                    <div class="mb-4">
                        <label for="semester" class="form-label">
                            <i class="bi bi-calendar-week me-1"></i>Semester
                        </label>
                        <select class="form-select @error('semester') is-invalid @enderror" 
                                id="semester" 
                                name="semester"
                                required>
                            <option value="" disabled selected>Pilih Semester</option>
                            @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>
                                Semester {{ $i }}
                            </option>
                            @endfor
                        </select>
                        @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-help">
                            Semester dimana mata kuliah ini diajarkan
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                        <div>
                            <button type="reset" class="btn btn-outline-danger me-2">
                                <i class="bi bi-arrow-clockwise me-1"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-submit text-white">
                                <i class="bi bi-save me-1"></i>Simpan Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-focus on first field
        document.getElementById('kode_mk').focus();
        
        // Prevent form reset without confirmation
        document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin mengosongkan semua field?')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>