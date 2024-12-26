<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <i class="fas fa-door-open me-2"></i>
            <span class="fw-bold">Daftar Ruangan</span>
        </div>
        <button class="btn btn-sm btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#addRoomModal">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <div class="card-body" style="max-height: 40vh; overflow-y: auto;">
        <?php if (isset($rooms) && is_array($rooms)): ?>
            <?php foreach ($rooms as $room): ?>
                <div class="d-flex justify-content-between align-items-center p-2 border rounded mb-2">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-door-open text-primary me-2"></i>
                        <span><?= $room['name'] ?></span>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRoomModal"
                            data-id="<?= $room['id'] ?>" data-name="<?= $room['name'] ?>" data-description="<?= $room['description'] ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteRoomModal"
                            data-id="<?= $room['id'] ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>