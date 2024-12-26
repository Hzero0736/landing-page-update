<link rel="stylesheet" href="../assets/css/login.css">

<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-5">
            <div class="login-container shadow rounded p-4">
                <div class="login-header text-center mb-4">
                    <h2 class="fw-bold">Login</h2>
                    <p class="text-muted">Silahkan Masukkan NIK dan Password Anda</p>
                </div>

                <form action="<?= base_url('login/auth') ?>" method="POST">
                    <?= csrf_field() ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" id="nik" name="nik" required
                                placeholder="Masukkan NIK Anda">
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password"
                                required placeholder="Masukkan kata sandi Anda">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</div>