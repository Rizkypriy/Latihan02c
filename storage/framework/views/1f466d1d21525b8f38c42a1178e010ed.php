<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
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
        
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 5px;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        
        .btn-back {
            margin-right: 10px;
        }
        
        .required-field::after {
            content: " *";
            color: red;
            font-weight: bold;
        }
        
        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 4px;
        }
        
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            padding-right: 2.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">
                <i class="bi bi-person-plus-fill text-primary me-2"></i> Tambah Data Mahasiswa
            </h2>

            <!-- Pesan Error Validasi -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h6 class="alert-heading">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Terdapat kesalahan:
                    </h6>
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Pesan Sukses -->
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Form Tambah Data -->
            <form action="<?php echo e(route('mahasiswa.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <!-- NIM -->
                <div class="mb-3">
                    <label for="nim" class="form-label">
                        <i class="bi bi-card-text me-1 text-primary"></i> NIM
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control <?php $__errorArgs = ['nim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="nim" 
                           name="nim" 
                           value="<?php echo e(old('nim')); ?>"
                           placeholder="Masukkan NIM (Contoh: 20210001)"
                           maxlength="15"
                           required>
                    <?php $__errorArgs = ['nim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-text">
                        <i class="bi bi-info-circle me-1"></i> NIM harus unik dan tidak boleh duplikat
                    </div>
                </div>

                <!-- Nama Lengkap -->
                <div class="mb-3">
                    <label for="nama" class="form-label">
                        <i class="bi bi-person me-1 text-primary"></i> Nama Lengkap
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="nama" 
                           name="nama" 
                           value="<?php echo e(old('nama')); ?>"
                           placeholder="Masukkan nama lengkap"
                           maxlength="100"
                           required>
                    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Kelas -->
                <div class="mb-3">
                    <label for="kelas" class="form-label">
                        <i class="bi bi-building me-1 text-primary"></i> Kelas
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="kelas" 
                           name="kelas" 
                           value="<?php echo e(old('kelas')); ?>"
                           placeholder="Masukkan kelas (Contoh: TI-A, SI-B)"
                           maxlength="20"
                           required>
                    <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Mata Kuliah (Dropdown) -->
                <div class="mb-3">
                    <label for="kode_mk" class="form-label">
                        <i class="bi bi-book me-1 text-primary"></i> Mata Kuliah
                        <span class="text-danger">*</span>
                    </label>
                    <select name="kode_mk" id="kode_mk" class="form-control <?php $__errorArgs = ['kode_mk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        <?php $__currentLoopData = $matakuliahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($mk->kode_mk); ?>" <?php echo e(old('kode_mk') == $mk->kode_mk ? 'selected' : ''); ?>>
                            <?php echo e($mk->kode_mk); ?> - <?php echo e($mk->nama_mk); ?> 
                            (<?php echo e($mk->sks); ?> SKS, Semester <?php echo e($mk->semester); ?>)
                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['kode_mk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Semester Ambil -->
                <div class="mb-4">
                    <label for="semester_ambil" class="form-label">
                        <i class="bi bi-calendar-week me-1 text-primary"></i> Semester Ambil
                        <span class="text-danger">*</span>
                    </label>
                    <input type="number" 
                           class="form-control <?php $__errorArgs = ['semester_ambil'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="semester_ambil" 
                           name="semester_ambil" 
                           value="<?php echo e(old('semester_ambil', 1)); ?>"
                           placeholder="Contoh: 1, 2, 3, ..."
                           min="1" 
                           max="14"
                           required>
                    <?php $__errorArgs = ['semester_ambil'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-text">
                        <i class="bi bi-info-circle me-1"></i> Semester saat mahasiswa mengambil mata kuliah ini (1-14)
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="<?php echo e(route('mahasiswa.index')); ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <div>
                        <button type="reset" class="btn btn-outline-warning me-2">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-focus ke field pertama
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nim').focus();
            
            // Auto-hide alerts setelah 5 detik
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
        
        // Konfirmasi reset form
        document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin mengosongkan semua field?')) {
                e.preventDefault();
            }
        });
        
        // Validasi NIM hanya angka dan huruf
        document.getElementById('nim').addEventListener('input', function(e) {
            this.value = this.value.toUpperCase();
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Latihan02c\resources\views/mahasiswa/create.blade.php ENDPATH**/ ?>