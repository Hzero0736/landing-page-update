<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header" style="background: linear-gradient(to right, rgb(53, 133, 95), rgb(40, 100, 70));">
            <h5 class="text-white mb-0">
                <i class="fas fa-list-check me-2"></i>Daftar Persetujuan Meeting
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="approvalTable">
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
                        <?php foreach ($meetings as $key => $meeting): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $meeting['title'] ?></td>
                                <td><?= date('d/m/Y', strtotime($meeting['date'])) ?></td>
                                <td>
                                    <?= date('H:i', strtotime($meeting['start_time'])) ?> -
                                    <?= date('H:i', strtotime($meeting['end_time'])) ?>
                                </td>
                                <td><?= $meeting['room_name'] ?></td>
                                <td><?= $meeting['nama_penyelenggara'] ?></td>
                                <td>
                                    <span class="badge bg-warning">Menunggu</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-info"
                                            onclick="showDetail(<?= htmlspecialchars(json_encode($meeting)) ?>)">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <a href="/booking/approve/<?= $meeting['id'] ?>"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="showRejectModal(<?= $meeting['id'] ?>)">
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

<!-- Modal Reject -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alasan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST" id="rejectForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Alasan Penolakan</label>
                        <textarea class="form-control" name="reason" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#approvalTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });
    });

    function showRejectModal(id) {
        $('#rejectForm').attr('action', '/booking/reject/' + id);
        var rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'), {
            backdrop: 'static',
            keyboard: false
        });
        rejectModal.show();
    }

    function showDetail(meeting) {
        $('#detail_title').text(meeting.title);
        $('#detail_description').text(meeting.description);
        $('#detail_datetime').text(`${meeting.date} ${meeting.start_time} - ${meeting.end_time}`);
        $('#detail_room').text(meeting.room_name);
        $('#detail_penyelenggara').text(meeting.nama_penyelenggara);
        var detailModal = new bootstrap.Modal(document.getElementById('detailModal'), {
            backdrop: 'static',
            keyboard: false
        });
        detailModal.show();
    }
</script>