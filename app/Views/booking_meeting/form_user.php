<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-2 border-primary rounded-3">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fa-solid fa-user-plus me-2"></i>Tambah User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/users/add" method="post">
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="nik" class="form-label">
                            <i class="fa-solid fa-id-badge me-2"></i>NIK
                        </label>
                        <input type="text" id="nik" class="form-control" name="nik" placeholder="Masukkan NIK" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password" class="form-label">
                            <i class="fa-solid fa-key me-2"></i>Password
                        </label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan password" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="name" class="form-label">
                            <i class="fa-solid fa-user me-2"></i>Nama
                        </label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Masukkan nama" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="role" class="form-label">
                            <i class="fa-solid fa-shield me-2"></i>Role
                        </label>
                        <select id="role" class="form-select" name="role" required>
                            <option value="">-- Pilih Role User --</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-circle-xmark me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-2 border-warning rounded-3">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fa-solid fa-pen-to-square me-2"></i>Edit User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/users/edit" method="post">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="edit_nik" class="form-label">
                            <i class="fa-solid fa-id-badge me-2"></i>NIK
                        </label>
                        <input type="text" id="edit_nik" class="form-control" name="nik" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="edit_password" class="form-label">
                            <i class="fa-solid fa-key me-2"></i>Password
                        </label>
                        <input type="password" id="edit_password" class="form-control" name="password" placeholder="Masukkan password baru">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                    <div class="form-group mb-4">
                        <label for="edit_name_user" class="form-label">
                            <i class="fa-solid fa-user me-2"></i>Nama
                        </label>
                        <input type="text" id="edit_name_user" class="form-control" name="name" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="edit_role" class="form-label">
                            <i class="fa-solid fa-shield me-2"></i>Role
                        </label>
                        <select id="edit_role" class="form-select" name="role" required>
                            <option value="">-- Pilih Role User --</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-circle-xmark me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa-solid fa-circle-check me-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail User Modal -->
<div class="modal fade" id="detailUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0 rounded-4">
            <!-- Header -->
            <div class="modal-header bg-info text-white py-4">
                <h5 class="modal-title fw-bold d-flex align-items-center">
                    <i class="fa-solid fa-circle-info fa-lg me-3"></i>
                    Detail Informasi User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4">
                <div class="row g-4">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-primary mb-3">
                                        <i class="fa-solid fa-id-badge me-2"></i>NIK
                                    </label>
                                    <div id="detail_nik" class="bg-light rounded-3 p-3 fs-5"></div>
                                </div>
                                <div>
                                    <label class="form-label fw-bold text-primary mb-3">
                                        <i class="fa-solid fa-user me-2"></i>Nama Lengkap
                                    </label>
                                    <div id="detail_name" class="bg-light rounded-3 p-3 fs-5"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-primary mb-3">
                                        <i class="fa-solid fa-shield me-2"></i>Role User
                                    </label>
                                    <div id="detail_role" class="bg-light rounded-3 p-3 fs-5 text-capitalize"></div>
                                </div>
                                <div>
                                    <label class="form-label fw-bold text-primary mb-3">
                                        <i class="fa-solid fa-key me-2"></i>Password
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <input type="password" id="detail_password"
                                            class="form-control bg-light border-0" readonly>
                                        <button class="btn btn-primary px-4" type="button"
                                            onclick="togglePasswordVisibility()">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer bg-light py-4">
                <button type="button" class="btn btn-lg btn-secondary px-5" data-bs-dismiss="modal">
                    <i class="fa-solid fa-circle-xmark me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>



<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-2 border-danger rounded-3">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-trash-alt me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                <p>Apakah Anda yakin ingin menghapus user ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <a href="#" id="deleteUserBtn" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-2"></i>Hapus
                </a>
            </div>
        </div>
    </div>
</div>