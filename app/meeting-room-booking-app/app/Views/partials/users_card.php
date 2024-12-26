<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <i class="fas fa-users me-2"></i>
            <span class="fw-bold">Daftar User</span>
        </div>
        <button class="btn btn-sm btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <div class="card-body" style="max-height: 40vh; overflow-y: auto;">
        <?php if (isset($users) && is_array($users)): ?>
            <?php foreach ($users as $user): ?>
                <div class="d-flex justify-content-between align-items-center p-2 border rounded mb-2">
                    <div>
                        <div class="fw-bold"><?= $user['name'] ?></div>
                        <small class="text-muted"><?= $user['nik'] ?> - <?= $user['role'] ?></small>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                data-id="<?= $user['id'] ?>" data-nik="<?= $user['nik'] ?>"
                                data-name="<?= $user['name'] ?>" data-role="<?= $user['role'] ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                data-id="<?= $user['id'] ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>