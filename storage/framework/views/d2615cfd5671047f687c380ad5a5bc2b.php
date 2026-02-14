<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa - <?php echo e($mahasiswa->nama); ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .detail-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .detail-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .detail-avatar {
            width: 120px;
            height: 120px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 50px;
        }
        .detail-body {
            padding: 40px;
        }
        .detail-item {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .detail-label {
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .detail-value {
            font-size: 1.1rem;
            color: #333;
        }
        .badge-status {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .action-buttons {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .btn-action {
            min-width: 120px;
        }
        .card-info {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Pesan Session -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="detail-container mt-4">
            <!-- Header dengan avatar -->
            <div class="detail-header">
                <div class="detail-avatar">
                    <i class="bi bi-person-circle"></i>
                </div>
                <h1 class="mb-2"><?php echo e($mahasiswa->nama); ?></h1>
                <p class="mb-0 opacity-75">
                    <i class="bi bi-card-text"></i> NIM: <?php echo e($mahasiswa->nim); ?>

                </p>
            </div>

            <!-- Body dengan informasi detail -->
            <div class="detail-body">
                <!-- Info Card -->
                <div class="card-info">
                    <h5 class="mb-2">
                        <i class="bi bi-info-circle me-2"></i>Informasi Mahasiswa
                    </h5>
                    <p class="mb-0 text-muted">
                        Data lengkap mahasiswa <?php echo e($mahasiswa->nama); ?> dengan NIM <?php echo e($mahasiswa->nim); ?>

                    </p>
                </div>

                <!-- Data Detail dalam Grid -->
                <div class="row">
                    <!-- Kolom 1 -->
                    <div class="col-md-6">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-card-text me-1"></i> NIM
                            </div>
                            <div class="detail-value">
                                <strong class="text-primary"><?php echo e($mahasiswa->nim); ?></strong>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-person me-1"></i> Nama Lengkap
                            </div>
                            <div class="detail-value">
                                <?php echo e($mahasiswa->nama); ?>

                            </div>
                        </div>
                    </div>

                    <!-- Kolom 2 -->
                    <div class="col-md-6">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-building me-1"></i> Kelas
                            </div>
                            <div class="detail-value">
                                <span class="badge bg-primary badge-status">
                                    <?php echo e($mahasiswa->kelas); ?>

                                </span>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-book me-1"></i> Mata Kuliah
                            </div>
                            <div class="detail-value">
                                <span class="badge bg-success badge-status">
                                    <?php echo e($mahasiswa->matakuliah); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Sistem -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-clock-history me-1"></i> Informasi Sistem
                            </div>
                            <div class="row">
                                <?php if($mahasiswa->created_at): ?>
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <i class="bi bi-plus-circle me-1"></i>
                                        Ditambahkan: 
                                        <strong><?php echo e($mahasiswa->created_at->format('d F Y H:i')); ?></strong>
                                    </small>
                                </div>
                                <?php endif; ?>
                                
                                <?php if($mahasiswa->updated_at): ?>
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <i class="bi bi-arrow-clockwise me-1"></i>
                                        Terakhir diupdate: 
                                        <strong><?php echo e($mahasiswa->updated_at->format('d F Y H:i')); ?></strong>
                                    </small>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="action-buttons">
                    <a href="<?php echo e(route('mahasiswa.index')); ?>" 
                       class="btn btn-secondary btn-action">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    
                    <a href="<?php echo e(route('mahasiswa.edit', $mahasiswa->nim)); ?>" 
                       class="btn btn-warning btn-action">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>
                    
                    <!-- Tombol Hapus dengan Konfirmasi -->
                    <button type="button" 
                            class="btn btn-danger btn-action" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteModal">
                        <i class="bi bi-trash me-1"></i> Hapus
                    </button>
                </div>
            </div>
        </div>

        <!-- QR Code atau info tambahan (opsional) -->
        <div class="text-center mt-4">
            <small class="text-muted">
                <i class="bi bi-shield-check me-1"></i>
                Data ini aman dan hanya dapat diakses oleh pengguna yang berwenang.
            </small>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                        Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data mahasiswa ini?</p>
                    <div class="alert alert-warning">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Data yang dihapus tidak dapat dikembalikan!</strong>
                        <ul class="mt-2 mb-0">
                            <li>Nama: <strong><?php echo e($mahasiswa->nama); ?></strong></li>
                            <li>NIM: <strong><?php echo e($mahasiswa->nim); ?></strong></li>
                            <li>Kelas: <strong><?php echo e($mahasiswa->kelas); ?></strong></li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </button>
                    <form action="<?php echo e(route('mahasiswa.destroy', $mahasiswa->nim)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i> Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide alert setelah 5 detik
            const alert = document.querySelector('.alert');
            if (alert) {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            }
            
            // Print functionality (opsional)
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 'p') {
                    e.preventDefault();
                    alert('Gunakan tombol print di browser untuk mencetak halaman ini.');
                }
            });
            
            // Copy NIM ke clipboard (opsional)
            const copyNIM = document.getElementById('copyNIM');
            if (copyNIM) {
                copyNIM.addEventListener('click', function() {
                    navigator.clipboard.writeText('<?php echo e($mahasiswa->nim); ?>')
                        .then(() => {
                            alert('NIM berhasil disalin ke clipboard!');
                        });
                });
            }
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Latihan02c\resources\views/mahasiswa/show.blade.php ENDPATH**/ ?>