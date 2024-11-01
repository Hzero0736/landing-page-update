        <!-- Modal Booking -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="bookingModalLabel"><i class="fas fa-calendar-plus"></i> Form Booking Ruangan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/booking/save" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label><i class="fas fa-user"></i> Nama User</label>
                                        <input type="text" class="form-control" name="user" required placeholder="Masukkan nama user">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><i class="fas fa-heading"></i> Judul Meeting</label>
                                        <input type="text" class="form-control" name="title" required placeholder="Masukkan judul meeting">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><i class="fas fa-door-open"></i> Pilih Ruangan</label>
                                        <select class="form-control" name="room_id" required>
                                            <option value="">-- Pilih Ruangan --</option>
                                            <?php foreach ($rooms as $room): ?>
                                                <option value="<?= $room['id'] ?>"><?= $room['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><i class="fas fa-file-alt"></i> Deskripsi</label>
                                        <textarea class="form-control" name="description" rows="3" placeholder="Masukkan deskripsi meeting"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label><i class="fas fa-calendar"></i> Tanggal</label>
                                        <input type="date" class="form-control" name="date" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><i class="fas fa-clock"></i> Waktu Mulai</label>
                                        <input type="time" class="form-control" name="start_time" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><i class="fas fa-clock"></i> Waktu Selesai</label>
                                        <input type="time" class="form-control" name="end_time" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><i class="fas fa-repeat"></i> Pengulangan</label>
                                        <select class="form-control" name="repeat">
                                            <option value="none">Tidak ada</option>
                                            <option value="daily">Setiap Hari</option>
                                            <option value="weekly">Per-Minggu (4 minggu)</option>
                                            <option value="monthly">Per-Bulan (12 bulan)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Booking</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title" id="editModalLabel">
                            <i class="fas fa-edit"></i> Edit Booking Meeting
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editBookingForm" action="/booking/edit/" method="POST">
                        <div class="modal-body">
                            <input type="hidden" id="edit_id" name="id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="edit_title" class="form-label"><i class="fas fa-heading"></i> Judul Meeting</label>
                                        <input type="text" class="form-control" id="edit_title" name="title" required placeholder="Masukkan judul meeting">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="edit_user" class="form-label"><i class="fas fa-user"></i> Nama User</label>
                                        <input type="text" class="form-control" id="edit_user" name="user" required placeholder="Masukkan nama user">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="edit_room" class="form-label"><i class="fas fa-door-open"></i> Ruangan</label>
                                        <select class="form-select" id="edit_room" name="room_id" required>
                                            <option value="">-- Pilih Ruangan --</option>
                                            <?php foreach ($rooms as $room): ?>
                                                <option value="<?= $room['id'] ?>"><?= $room['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="edit_description" class="form-label"><i class="fas fa-file-alt"></i> Deskripsi</label>
                                        <textarea class="form-control" id="edit_description" name="description" rows="3" placeholder="Masukkan deskripsi meeting"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="edit_date" class="form-label"><i class="fas fa-calendar"></i> Tanggal</label>
                                        <input type="date" class="form-control" id="edit_date" name="date" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="edit_start" class="form-label"><i class="fas fa-clock"></i> Waktu Mulai</label>
                                        <input type="time" class="form-control" id="edit_start" name="start_time" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="edit_end" class="form-label"><i class="fas fa-clock"></i> Waktu Selesai</label>
                                        <input type="time" class="form-control" id="edit_end" name="end_time" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-warning text-white" id="saveEditBtn">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal Detail -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="detailModalLabel">
                            <i class="fas fa-info-circle"></i> Detail Booking Meeting
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-3 border-0">
                            <div class="card-body p-0">
                                <h4 class="card-title mb-3" id="detail_title"></h4>

                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-calendar-day text-primary me-2"></i>
                                    <span id="detail_date"></span>
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <span>
                                        <span id="detail_start"></span> - <span id="detail_end"></span>
                                    </span>
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-door-open text-primary me-2"></i>
                                    <span id="detail_room"></span>
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-user text-primary me-2"></i>
                                    <span id="detail_user"></span>
                                </div>

                                <div class="mt-4">
                                    <h6 class="fw-bold">
                                        <i class="fas fa-file-alt text-primary me-2"></i> Deskripsi
                                    </h6>
                                    <p class="ms-4" id="detail_description"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning me-2" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-danger me-2" onclick="deleteBooking()">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Delete -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus booking meeting ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <a href="#" class="btn btn-danger" id="confirmDeleteBtn">
                            <i class="fas fa-trash"></i> Ya, Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>