<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Kuliah - {{ $matakuliah->nama_mk }}</title>
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
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }
        .form-body {
            padding: 30px;
        }
        .current-value {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
            margin-top: 5px;
        }
        .btn-update {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
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
                    <i class="bi bi-pencil-square me-2"></i>Edit Mata Kuliah
                </h2>
                <p class="mb-0 opacity-75">
                    {{ $matakuliah->kode_mk }} - {{ $matakuliah->nama_mk }}
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
                <form action="{{ route('matakuliah.update', $matakuliah->kode_mk) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Kode MK (Readonly) -->
                    <div class="mb-4">
                        <label for="kode_mk" class="form-label">
                            <i class="bi bi-key me-1"></i>Kode Mata Kuliah
                        </label>
                        <input type="text" 
                               class="form-control bg-light" 
                               id="kode_mk" 
                               value="{{ $matakuliah->kode_mk }}"
                               readonly>
                        <input type="hidden" name="kode_mk" value="{{ $matakuliah->kode_mk }}">
                        <div class="form-help">
                            Kode mata kuliah tidak dapat diubah
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
                               value="{{ old('nama_mk', $matakuliah->nama_mk) }}"
                               maxlength="100"
                               required>
                        @error('nama_mk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SKS -->
                    <div class="mb-4">
                        <label for="sks" class="form-label">
                            <i class="bi bi-clock me-1"></i>SKS
                        </label>
                        <input type="number" 
                               class="form-control @error('sks') is-invalid @enderror" 
                               id="sks" 
                               name="sks" 
                               value="{{ old('sks', $matakuliah->sks) }}"
                               min="1" 
                               max="6"
                               required>
                        @error('sks')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                            @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" 
                                {{ old('semester', $matakuliah->semester) == $i ? 'selected' : '' }}>
                                Semester {{ $i }}
                            </option>
                            @endfor
                        </select>
                        @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Info Tambahan -->
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col-md-6">
                                <small>
                                    <i class="bi bi-calendar-plus me-1"></i>
                                    <strong>Dibuat:</strong><br>
                                    {{ $matakuliah->created_at->format('d M Y H:i') }}
                                </small>
                            </div>
                            <div class="col-md-6">
                                <small>
                                    <i class="bi bi-calendar-check me-1"></i>
                                    <strong>Diupdate:</strong><br>
                                    {{ $matakuliah->updated_at->format('d M Y H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i>Batal
                        </a>
                        <div>
                            <a href="{{ route('matakuliah.show', $matakuliah->kode_mk) }}" 
                               class="btn btn-info me-2">
                                <i class="bi bi-eye me-1"></i>Lihat
                            </a>
                            <button type="submit" class="btn btn-update text-white">
                                <i class="bi bi-check-circle me-1"></i>Update Data
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
        // Prevent leaving page if form has changes
        let formChanged = false;
        const inputs = document.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('input', () => formChanged = true);
        });
        
        window.addEventListener('beforeunload', (e) => {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = 'Perubahan belum disimpan. Yakin ingin meninggalkan halaman?';
            }
        });
        
        document.querySelector('form').addEventListener('submit', () => {
            formChanged = false;
        });
    </script>
</body>
</html>