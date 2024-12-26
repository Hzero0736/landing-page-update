<!-- Modal Tambah Ruangan -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-success shadow-lg rounded-3">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold" id="addRoomModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Ruang Rapat
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/room/add" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold text-success">
                            <i class="fas fa-door-open me-2"></i>Nama Ruangan
                        </label>
                        <input type="text" class="form-control shadow-sm border-success" id="name" name="name" required placeholder="Contoh: Ruang Meeting 1">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold text-success">
                            <i class="fas fa-info-circle me-2"></i>Deskripsi
                        </label>
                        <textarea class="form-control shadow-sm border-success" id="description" name="description" rows="4" placeholder="Tuliskan deskripsi ruangan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4 shadow-sm" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-success px-4 shadow-sm">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Ruangan -->
<div class="modal fade" id="deleteRoomModal" tabindex="-1" aria-labelledby="deleteRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger shadow-lg rounded-3">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteRoomModalLabel">
                    <i class="fas fa-trash-alt me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                <p class="fw-bold fs-5">Apakah Anda yakin ingin menghapus ruang rapat ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-4 shadow-sm" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <a href="#" id="deleteRoomBtn" class="btn btn-danger px-4 shadow-sm">
                    <i class="fas fa-trash-alt me-2"></i>Hapus
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Ruangan -->
<div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-warning shadow-lg rounded-3">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fw-bold" id="editRoomModalLabel">
                    <i class="fas fa-edit me-2"></i>Edit Ruang Rapat
                </h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/room/edit/" method="POST" id="editRoomForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-bold text-warning">
                            <i class="fas fa-door-open me-2"></i>Nama Ruangan
                        </label>
                        <input type="text" class="form-control shadow-sm border-warning" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description_room" class="form-label fw-bold text-warning">
                            <i class="fas fa-info-circle me-2"></i>Deskripsi
                        </label>
                        <textarea class="form-control shadow-sm border-warning" id="edit_description_room" name="description" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4 shadow-sm" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning px-4 shadow-sm">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>