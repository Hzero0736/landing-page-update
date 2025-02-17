        <!-- Modal Booking -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white py-3">
                        <h5 class="modal-title fw-bold" id="bookingModalLabel">
                            <i class="fas fa-calendar-plus me-2"></i> Form Booking Ruangan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/booking/save" method="post" class="needs-validation" novalidate>
                        <div class="modal-body p-4">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control shadow-sm" id="nama_penyelenggara" name="nama_penyelenggara" required placeholder="Nama Penyelenggara">
                                        <label for="nama_penyelenggara"><i class="fas fa-user me-2"></i> Nama Penyelenggara</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control shadow-sm" id="title" name="title" required placeholder="Judul Meeting">
                                        <label for="title"><i class="fas fa-heading me-2"></i> Judul Meeting</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select shadow-sm" id="room_id" name="room_id" required>
                                            <option value="">Pilih Ruangan</option>
                                            <?php foreach ($rooms as $room): ?>
                                                <option value="<?= $room['id'] ?>"><?= $room['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="room_id"><i class="fas fa-door-open me-2"></i> Ruangan</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control shadow-sm" id="description" name="description" style="height: 100px" placeholder="Deskripsi"></textarea>
                                        <label for="description"><i class="fas fa-file-alt me-2"></i> Deskripsi</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control shadow-sm" id="date" name="date" required>
                                        <label for="date"><i class="fas fa-calendar me-2"></i> Tanggal</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control shadow-sm" id="start_time" name="start_time" required>
                                        <label for="start_time"><i class="fas fa-clock me-2"></i> Waktu Mulai</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control shadow-sm" id="end_time" name="end_time" required>
                                        <label for="end_time"><i class="fas fa-clock me-2"></i> Waktu Selesai</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select shadow-sm" id="repeat" name="repeat">
                                            <option value="none">Tidak ada</option>
                                            <option value="daily">Setiap Hari</option>
                                            <option value="weekly">Per-Minggu (4 minggu)</option>
                                            <option value="monthly">Per-Bulan (12 bulan)</option>
                                        </select>
                                        <label for="repeat"><i class="fas fa-repeat me-2"></i> Pengulangan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light py-3">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-save me-2"></i> Simpan Booking
                            </button>
                            <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i> Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-warning text-white py-3">
                        <h5 class="modal-title fw-bold" id="editModalLabel">
                            <i class="fas fa-edit me-2"></i> Edit Booking Meeting
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editBookingForm" action="/booking/edit/" method="POST" class="needs-validation" novalidate>
                        <div class="modal-body p-4">
                            <input type="hidden" id="edit_id" name="id">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control shadow-sm" id="edit_title" name="title" required placeholder="Judul Meeting">
                                        <label for="edit_title"><i class="fas fa-heading me-2"></i> Judul Meeting</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control shadow-sm" id="edit_nama_penyelenggara" name="nama_penyelenggara" required placeholder="Nama Penyelenggara">
                                        <label for="edit_nama_penyelenggara"><i class="fas fa-user me-2"></i> Nama Penyelenggara</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select shadow-sm" id="edit_room" name="room_id" required>
                                            <option value="">Pilih Ruangan</option>
                                            <?php foreach ($rooms as $room): ?>
                                                <option value="<?= $room['id'] ?>"><?= $room['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="edit_room"><i class="fas fa-door-open me-2"></i> Ruangan</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control shadow-sm" id="edit_description" name="description" style="height: 100px" placeholder="Deskripsi"></textarea>
                                        <label for="edit_description"><i class="fas fa-file-alt me-2"></i> Deskripsi</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control shadow-sm" id="edit_date" name="date" required>
                                        <label for="edit_date"><i class="fas fa-calendar me-2"></i> Tanggal</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control shadow-sm" id="edit_start" name="start_time" required>
                                        <label for="edit_start"><i class="fas fa-clock me-2"></i> Waktu Mulai</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control shadow-sm" id="edit_end" name="end_time" required>
                                        <label for="edit_end"><i class="fas fa-clock me-2"></i> Waktu Selesai</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light py-3">
                            <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-warning text-white px-4 py-2" id="saveEditBtn">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Detail -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white py-3">
                        <h5 class="modal-title fw-bold" id="detailModalLabel">
                            <i class="fas fa-info-circle me-2"></i> Detail Booking Meeting
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4">
                            <div class="col-md-8">
                                <div class="card shadow-sm h-100 border-0">
                                    <div class="card-body p-4">
                                        <h4 class="card-title text-primary mb-4 fw-bold" id="detail_title"></h4>
                                        <div class="description-section mb-4">
                                            <h6 class="text-primary mb-3 fw-bold">
                                                <i class="fas fa-file-alt me-2"></i> Deskripsi
                                            </h6>
                                            <p class="text-muted lh-base" id="detail_description"></p>
                                        </div>
                                        <div class="organizer-section mb-4">
                                            <h6 class="text-primary mb-3 fw-bold">
                                                <i class="fas fa-user me-2"></i> Penyelenggara
                                            </h6>
                                            <p class="text-muted" id="detail_penyelenggara"></p>
                                        </div>
                                        <div class="creator-section">
                                            <h6 class="text-primary mb-3 fw-bold">
                                                <i class="fas fa-user-plus me-2"></i> Dibuat Oleh
                                            </h6>
                                            <div class="text-muted">
                                                <span id="detail_user_name"></span> (<span id="detail_user_nik"></span>)
                                            </div>
                                        </div>
                                        <div class="rejection-section mt-4" id="rejection_section" style="display: none;">
                                            <div class="alert alert-danger">
                                                <h6 class="text-danger mb-2 fw-bold">
                                                    <i class="fas fa-exclamation-circle me-2"></i> Alasan Penolakan
                                                </h6>
                                                <p class="mb-0" id="detail_reason"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm h-100 border-0 bg-light">
                                    <div class="card-body p-4">
                                        <h6 class="text-primary mb-4 fw-bold">Informasi Meeting</h6>
                                        <div class="meeting-info">
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                                    <i class="fas fa-calendar-day text-primary"></i>
                                                </div>
                                                <span class="fw-medium" id="detail_date"></span>
                                            </div>
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                                    <i class="fas fa-clock text-primary"></i>
                                                </div>
                                                <span class="fw-medium">
                                                    <span id="detail_start"></span> - <span id="detail_end"></span>
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                                    <i class="fas fa-door-open text-primary"></i>
                                                </div>
                                                <span class="fw-medium" id="detail_room"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light py-3 justify-content-between">
                        <div>
                            <button type="button" class="btn btn-warning px-4 py-2 me-2" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="fas fa-edit me-2"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger px-4 py-2" onclick="deleteBooking()">
                                <i class="fas fa-trash me-2"></i> Hapus
                            </button>
                        </div>
                        <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal