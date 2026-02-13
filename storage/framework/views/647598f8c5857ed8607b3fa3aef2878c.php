<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mata Kuliah</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .header-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 25px;
            margin-bottom: 0;
        }
        .table-container {
            background: white;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 30px;
        }
        .badge-sks {
            font-size: 0.85em;
            padding: 6px 12px;
            border-radius: 20px;
        }
        .badge-semester {
            font-size: 0.85em;
            padding: 6px 12px;
            border-radius: 20px;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }
        .btn-action {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #6c757d;
        }
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Alert Messages -->
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <!-- Header -->
        <div class="header-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2">
                        <i class="bi bi-book-half me-2"></i>Data Mata Kuliah
                    </h1>
                    <p class="mb-0 opacity-75">
                        <i class="bi bi-info-circle me-1"></i>
                        Total: <?php echo e($matakuliahs->count()); ?> mata kuliah
                    </p>
                </div>
                <a href="<?php echo e(route('matakuliah.create')); ?>" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Baru
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">Kode MK</th>
                            <th width="35%">Nama Mata Kuliah</th>
                            <th width="15%">SKS</th>
                            <th width="15%">Semester</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $matakuliahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td>
                                <span class="fw-bold text-primary"><?php echo e($mk->kode_mk); ?></span>
                            </td>
                            <td><?php echo e($mk->nama_mk); ?></td>
                            <td>
                                <span class="badge bg-info badge-sks">
                                    <i class="bi bi-clock me-1"></i><?php echo e($mk->sks); ?> SKS
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary badge-semester">
                                    Semester <?php echo e($mk->semester); ?>

                                </span>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <!-- Detail -->
                                    <a href="<?php echo e(route('matakuliah.show', $mk->kode_mk)); ?>" 
                                       class="btn btn-info btn-action" 
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    
                                    <!-- Edit -->
                                    <a href="<?php echo e(route('matakuliah.edit', $mk->kode_mk)); ?>" 
                                       class="btn btn-warning btn-action" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    <!-- Delete -->
                                    <form action="<?php echo e(route('matakuliah.destroy', $mk->kode_mk)); ?>" 
                                          method="POST" 
                                          style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                                class="btn btn-danger btn-action" 
                                                title="Hapus"
                                                onclick="return confirm('Hapus <?php echo e($mk->nama_mk); ?>?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="empty-state">
                                <i class="bi bi-journal-x"></i>
                                <h4 class="mt-3">Belum Ada Data</h4>
                                <p class="mb-4">Mulai dengan menambahkan mata kuliah pertama Anda.</p>
                                <a href="<?php echo e(route('matakuliah.create')); ?>" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i>Tambah Mata Kuliah
                                </a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Info -->
        <?php if($matakuliahs->count() > 0): ?>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="alert alert-info d-flex align-items-center">
                    <i class="bi bi-info-circle me-2" style="font-size: 1.5rem;"></i>
                    <div>
                        <strong>Total SKS:</strong> <?php echo e($matakuliahs->sum('sks')); ?> SKS<br>
                        <small class="text-muted"><?php echo e($matakuliahs->count()); ?> mata kuliah terdaftar</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <small class="text-muted">
                    <i class="bi bi-clock-history me-1"></i>
                    Terakhir diperbarui: <?php echo e(now()->format('d M Y H:i')); ?>

                </small>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Latihan02c\resources\views/matakuliah/index.blade.php ENDPATH**/ ?>