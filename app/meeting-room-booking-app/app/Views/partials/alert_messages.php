<div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-check-circle me-2"></i>
        <span><?= session()->get('success') ?></span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-exclamation-circle me-2"></i>
        <span><?= session()->get('error') ?></span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>