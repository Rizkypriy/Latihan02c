<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .table-container {
            margin-top: 30px;
            margin-bottom: 50px;
        }
        .table-header {
            background-color: #343a40;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
        }
        .btn-add {
            float: right;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        .btn-edit {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-edit:hover, .btn-delete:hover {
            opacity: 0.9;
        }
        .no-data {
            text-align: center;
            padding: 50px;
            color: #6c757d;
        }
        .badge-kelas {
            font-size: 0.85em;
            padding: 5px 10px;
        }
        /* Style untuk alert */
        .alert-container {
            margin-top: 20px;
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container table-container">
        
        <!-- TAMBAHKAN KODE INI DI SINI -->
        <!-- Pesan Session (Alert) -->
        <div class="alert-container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <strong>Peringatan!</strong> {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>Informasi!</strong> {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <!-- AKHIR DARI KODE TAMBAHAN -->

        <div class="navigation-bar mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="bi bi-people"></i> Mahasiswa
                        </li>
                    </ol>
                </nav>
                <div class="btn-group">
                    <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-book me-1"></i> Ke Mata Kuliah
                    </a>
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Mahasiswa
                    </a>
                </div>
            </div>
        </div>

        <!-- Header -->
        <div class="table-header">
            <h3 class="mb-0">
                <i class="bi bi-people-fill"></i> Data Mahasiswa
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-success btn-sm btn-add">
                    <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
                </a>
            </h3>
            <p class="mb-0 mt-1 text-light" style="opacity: 0.8;">
                Total: {{ $mahasiswas->count() }} mahasiswa
            </p>
        </div>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">NIM</th>
                        <th width="25%">Nama</th>
                        <th width="15%">Kelas</th>
                        <th width="25%"></th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $index => $mahasiswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $mahasiswa->nim }}</strong>
                        </td>
                        <td>{{ $mahasiswa->nama }}</td>
                        <td>
                            <span class="badge bg-primary badge-kelas">
                                {{ $mahasiswa->kelas }}
                            </span>
                        </td>
                        <td>{{ $mahasiswa->matakuliah }}</td>
                        <td class="text-center">
                            <div class="action-buttons justify-content-center">
                                <!-- Tombol Edit -->
                                <a href="{{ route('mahasiswa.edit', $mahasiswa->nim) }}" 
                                   class="btn btn-warning btn-sm btn-edit" 
                                   title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('mahasiswa.destroy', $mahasiswa->nim) }}" 
                                      method="POST" 
                                      style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm btn-delete" 
                                            title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa {{ $mahasiswa->nama }}?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                
                                <!-- Tombol Detail -->
                                <a href="{{ route('mahasiswa.show', $mahasiswa->nim) }}" 
                                   class="btn btn-info btn-sm" 
                                   title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="no-data">
                            <i class="bi bi-database-exclamation" style="font-size: 3rem;"></i>
                            <h4 class="mt-3">Tidak Ada Data</h4>
                            <p>Belum ada data mahasiswa. Silakan tambah data terlebih dahulu.</p>
                            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Tambah Mahasiswa Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Info Tambahan -->
        @if($mahasiswas->count() > 0)
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> 
                    Total: <strong>{{ $mahasiswas->count() }}</strong> mahasiswa terdaftar
                </div>
            </div>
            <div class="col-md-6 text-end">
                <small class="text-muted">
                    Terakhir diperbarui: {{ now()->format('d F Y H:i') }}
                </small>
            </div>
        </div>
        @endif
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script untuk konfirmasi hapus -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sweet konfirmasi hapus
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                        e.preventDefault();
                    }
                });
            });
            
            // Efek hover pada tabel
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f8f9fa';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });
            
            // Auto-hide alert setelah 5 detik
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
</body>
</html>