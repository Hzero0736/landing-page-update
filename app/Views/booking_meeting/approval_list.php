<div class="container-fluid mt-4">
    <div class="mb-3">
        <a href="/booking" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Menu Utama
        </a>
    </div>

    <div class="card shadow">
        <div class="card-header" style="background: linear-gradient(to right, rgb(53, 133, 95), rgb(40, 100, 70));">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-white mb-0">
                    <i class="fas fa-list-check me-2"></i>Daftar Persetujuan Meeting
                </h5>
            </div>
        </div>
        <div class="card-body">
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" id="approvalTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
                        <i class="fas fa-clock me-2"></i>Menunggu
                        <span class="badge bg-warning ms-2"><?= count(array_filter($meetings, fn($m) => $m['status'] === 'pending')) ?></span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button" role="tab">
                        <i class="fas fa-check me-2"></i>Disetujui
                        <span class="badge bg-success ms-2"><?= count(array_filter($meetings, fn($m) => $m['status'] === 'approved')) ?></span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab">
                        <i class="fas fa-times me-2"></i>Ditolak
                        <span class="badge bg-danger ms-2"><?= count(array_filter($meetings, fn($m) => $m['status'] === 'rejected')) ?></span>
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="approvalTabContent">
                <!-- Pending Tab -->
                <div class="tab-pane fade show active" id="pending" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover" id="pendingTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Ruangan</th>
                                    <th>Penyelenggara</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $pendingMeetings = array_filter($meetings, fn($m) => $m['status'] === 'pending');
                                foreach ($pendingMeetings as $key => $meeting):
                                ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $meeting['title'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($meeting['date'])) ?></td>
                                        <td><?= date('H:i', strtotime($meeting['start_time'])) ?> - <?= date('H:i', strtotime($meeting['end_time'])) ?></td>
                                        <td><?= $meeting['room_name'] ?></td>
                                        <td><?= $meeting['nama_penyelenggara'] ?></td>
                                        <td><span class="badge bg-warning">Menunggu</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-info" onclick="showDetail(<?= htmlspecialchars(json_encode($meeting)) ?>)">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                                <a href="/booking/approve/<?= $meeting['id'] ?>" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger" onclick="showRejectModal(<?= $meeting['id'] ?>)">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Approved Tab -->
                <div class="tab-pane fade" id="approved" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover" id="approvedTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Ruangan</th>
                                    <th>Penyelenggara</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $approvedMeetings = array_filter($meetings, fn($m) => $m['status'] === 'approved');
                                foreach ($approvedMeetings as $key => $meeting):
                                ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $meeting['title'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($meeting['date'])) ?></td>
                                        <td><?= date('H:i', strtotime($meeting['start_time'])) ?> - <?= date('H:i', strtotime($meeting['end_time'])) ?></td>
                                        <td><?= $meeting['room_name'] ?></td>
                                        <td><?= $meeting['nama_penyelenggara'] ?></td>
                                        <td><span class="badge bg-success">Disetujui</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-info" onclick="showDetail(<?= htmlspecialchars(json_encode($meeting)) ?>)">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Rejected Tab -->
                <div class="tab-pane fade" id="rejected" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover" id="rejectedTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Ruangan</th>
                                    <th>Penyelenggara</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $rejectedMeetings = array_filter($meetings, fn($m) => $m['status'] === 'rejected');
                                foreach ($rejectedMeetings as $key => $meeting):
                                ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $meeting['title'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($meeting['date'])) ?></td>
                                        <td><?= date('H:i', strtotime($meeting['start_time'])) ?> - <?= date('H:i', strtotime($meeting['end_time'])) ?></td>
                                        <td><?= $meeting['room_name'] ?></td>
                                        <td><?= $meeting['nama_penyelenggara'] ?></td>
                                        <td><span class="badge bg-danger">Ditolak</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-info" onclick="showDetail(<?= htmlspecialchars(json_encode($meeting)) ?>)">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reject Reason -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alasan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST" id="rejectForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Alasan</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Meeting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="fw-bold">Judul:</label>
                    <p id="detail_title"></p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Deskripsi:</label>
                    <p id="detail_description"></p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Tanggal & Waktu:</label>
                    <p id="detail_datetime"></p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Ruangan:</label>
                    <p id="detail_room"></p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Penyelenggara:</label>
                    <p id="detail_penyelenggara"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTables for each status
        ['pending', 'approved', 'rejected'].forEach(status => {
            $(`#${status}Table`).DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                }
            });
        });
    });

    function showDetail(meeting) {
        $('#detail_title').text(meeting.title);
        $('#detail_description').text(meeting.description);
        $('#detail_datetime').text(`${meeting.date} ${meeting.start_time} - ${meeting.end_time}`);
        $('#detail_room').text(meeting.room_name);
        $('#detail_penyelenggara').text(meeting.nama_penyelenggara);
        $('#detailModal').modal('show');
    }

    function showRejectModal(id) {
        $('#rejectForm').attr('action', `/booking/reject/${id}`);
        $('#rejectModal').modal('show');
    }
</script>