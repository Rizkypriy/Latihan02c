<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peserta <?php echo e($matakuliah->nama_mk); ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
        }
        
        .header-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 25px;
        }
        
        .table-container {
            background: white;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            padding: 25px;
        }
        
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 0 8px 8px 0;
        }
        
        /* Grade colors */
        .grade-A { background-color: #28a745; color: white; }
        .grade-B { background-color: #17a2b8; color: white; }
        .grade-C { background-color: #ffc107; color: black; }
        .grade-D { background-color: #fd7e14; color: white; }
        .grade-E { background-color: #dc3545; color: white; }
        
        .badge-grade {
            font-size: 0.9rem;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border: none;
            border-radius: 10px;
        }
        
        .btn-back {
            transition: all 0.3s;
        }
        
        .btn-back:hover {
            transform: translateX(-3px);
        }
        
        .participant-link {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }
        
        .participant-link:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigasi -->
        <div class="mb-3">
            <a href="<?php echo e(route('matakuliah.index')); ?>" class="btn btn-outline-secondary btn-back">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Mata Kuliah
            </a>
        </div>

        <!-- Header Info Mata Kuliah -->
        <div class="header-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h3 mb-2">
                        <i class="bi bi-book me-2"></i><?php echo e($matakuliah->nama_mk); ?>

                    </h1>
                    <p class="mb-0 opacity-75">
                        <code class="bg-dark bg-opacity-25 p-1 rounded"><?php echo e($matakuliah->kode_mk); ?></code> | 
                        <span class="badge bg-light text-dark"><?php echo e($matakuliah->sks); ?> SKS</span> | 
                        <span class="badge bg-light text-dark">Semester <?php echo e($matakuliah->semester); ?></span>
                    </p>
                </div>
                <div class="mt-2 mt-md-0">
                    <span class="badge bg-light text-dark p-3">
                        <i class="bi bi-people-fill me-1"></i>
                        <?php echo e($matakuliah->transkrips->count()); ?> Peserta
                    </span>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Mahasiswa Peserta -->
        <div class="table-container">
            <h4 class="mb-4">
                <i class="bi bi-people-fill me-2 text-primary"></i>Daftar Mahasiswa Peserta
            </h4>

            <?php if($matakuliah->transkrips->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%" class="text-center">#</th>
                                <th width="15%">NIM</th>
                                <th width="25%">Nama Mahasiswa</th>
                                <th width="15%">Kelas</th>
                                <th width="15%">Semester Ambil</th>
                                <th width="15%">Nilai</th>
                                <th width="10%" class="text-center">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $matakuliah->transkrips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transkrip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($index + 1); ?></td>
                                <td>
                                    <code><strong><?php echo e($transkrip->mahasiswa->nim ?? 'N/A'); ?></strong></code>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('mahasiswa.show', $transkrip->nim)); ?>" 
                                       class="participant-link">
                                        <i class="bi bi-person-badge me-1"></i>
                                        <?php echo e($transkrip->mahasiswa->nama ?? 'N/A'); ?>

                                    </a>
                                </td>
                                <td>
                                    <?php if($transkrip->mahasiswa->kelas): ?>
                                        <span class="badge bg-info">
                                            <i class="bi bi-building me-1"></i><?php echo e($transkrip->mahasiswa->kelas); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-calendar-week me-1"></i>Semester <?php echo e($transkrip->semester_ambil); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php if($transkrip->nilai): ?>
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i><?php echo e($transkrip->nilai); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-clock-history me-1"></i>Belum dinilai
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                        $grade = $transkrip->grade_from_nilai ?? '-';
                                        $gradeClass = 'grade-' . $grade;
                                    ?>
                                    <?php if($grade != '-'): ?>
                                        <span class="badge <?php echo e($gradeClass); ?> badge-grade">
                                            <?php echo e($grade); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="5" class="text-end">Total Peserta:</th>
                                <th colspan="2">
                                    <span class="badge bg-primary p-2">
                                        <i class="bi bi-people me-1"></i>
                                        <?php echo e($matakuliah->transkrips->count()); ?> Mahasiswa
                                    </span>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center py-5" role="alert">
                    <i class="bi bi-info-circle" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">Belum Ada Peserta</h4>
                    <p class="mb-4">Mata kuliah ini belum diambil oleh mahasiswa manapun.</p>
                    <a href="<?php echo e(route('mahasiswa.index')); ?>" class="btn btn-primary">
                        <i class="bi bi-people me-1"></i> Lihat Mahasiswa
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Info Tambahan - Statistik Nilai -->
        <?php if($matakuliah->transkrips->count() > 0): ?>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="info-box">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-bar-chart-fill text-primary me-3" style="font-size: 2rem;"></i>
                        <div>
                            <h5 class="mb-2">Statistik Nilai</h5>
                            <?php
                                $total = $matakuliah->transkrips->count();
                                $withNilai = $matakuliah->transkrips->filter(fn($t) => !is_null($t->nilai))->count();
                                $avgNilai = $matakuliah->transkrips->avg('nilai');
                            ?>
                            <p class="mb-1">
                                <strong>Sudah dinilai:</strong> <?php echo e($withNilai); ?> dari <?php echo e($total); ?> mahasiswa
                            </p>
                            <?php if($withNilai > 0): ?>
                                <p class="mb-0">
                                    <strong>Rata-rata nilai:</strong> 
                                    <span class="badge bg-primary"><?php echo e(number_format($avgNilai, 2)); ?></span>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-pie-chart-fill text-success me-3" style="font-size: 2rem;"></i>
                        <div>
                            <h5 class="mb-2">Distribusi Grade</h5>
                            <?php
                                $grades = $matakuliah->transkrips->groupBy('grade')->map->count();
                            ?>
                            <div class="d-flex gap-2 flex-wrap">
                                <?php $__currentLoopData = ['A', 'B', 'C', 'D', 'E']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(isset($grades[$g])): ?>
                                        <span class="badge grade-<?php echo e($g); ?>"><?php echo e($g); ?>: <?php echo e($grades[$g]); ?></span>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($grades->isEmpty()): ?>
                                    <span class="text-muted">Belum ada grade</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="row mt-4">
            <div class="col-12 text-end">
                <small class="text-muted">
                    <i class="bi bi-clock-history me-1"></i>
                    Terakhir diperbarui: <?php echo e(now()->format('d M Y H:i')); ?>

                </small>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Tooltip initialization
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Latihan02c\resources\views/matakuliah/peserta.blade.php ENDPATH**/ ?>