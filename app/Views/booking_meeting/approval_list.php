<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="mb-3">
        <a href="/booking" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Menu Utama
        </a>
    </div>

    <!-- Main Card -->
    <div class="card shadow">
        <div class="card-header bg-success">
            <h5 class="text-white mb-0">
                <i class="fas fa-list-check me-2"></i>Daftar Persetujuan Meeting
            </h5>
        </div>
        <div class="card-body">
            <!-- Delete Form -->
            <form action="/booking/delete-selected" method="POST" id="deleteForm">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-danger mb-3" id="deleteSelected">
                    <i class="fas fa-trash me-2"></i>Hapus Data Terpilih
                </button>


                <!-- Tabs -->
                <ul class="nav nav-tabs mb-3" id="approvalTabs" role="tablist">
                    <?php
                    $tabs = [
                        'all' => 'Semua Data',
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak'
                    ];
                    $badges = [
                        'pending' => 'bg-warning',
                        'approved' => 'bg-success',
                        'rejected' => 'bg-danger'
                    ];
                    foreach ($tabs as $key => $label) {
                        $active = $key === 'all' ? 'active' : '';
                        $count = $key === 'all' ? count($meetings) : count(array_filter($meetings, fn($m) => $m['status'] === $key));
                        $badge = isset($badges[$key]) ? "<span class='badge rounded-pill {$badges[$key]} ms-2'>{$count}</span>" : '';
                        echo "<li class='nav-item' role='presentation'>
                                <button class='nav-link $active' id='{$key}-tab' data-bs-toggle='tab' data-bs-target='#{$key}' type='button' role='tab'>
                                    <i class='fas fa-list me-2'></i>{$label}{$badge}
                                </button>
                              </li>";
                    }
                    ?>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="approvalTabContent">
                    <?php foreach ($tabs as $key => $label): ?>
                        <div class="tab-pane fade <?= $key === 'all' ? 'show active' : '' ?>" id="<?= $key ?>" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="<?= $key ?>Table">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th width="5%">
                                                <input type="checkbox" class="form-check-input select-all" data-tab="<?= $key ?>">
                                            </th>
                                            <th width="5%">No</th>
                                            <th width="20%">Judul</th>
                                            <th width="10%">Tanggal</th>
                                            <th width="15%">Waktu</th>
                                            <th width="15%">Ruangan</th>
                                            <th width="15%">Penyelenggara</th>
                                            <th width="7%">Status</th>
                                            <th width="8%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $filteredMeetings = $key === 'all' ? $meetings : array_filter($meetings, fn($m) => $m['status'] === $key);
                                        foreach ($filteredMeetings as $index => $meeting):
                                        ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" name="selected_ids[]"
                                                        value="<?= $meeting['id'] ?>"
                                                        class="form-check-input check-item"
                                                        data-tab="<?= $key ?>"
                                                        data-status="<?= $meeting['status'] ?>">
                                                </td>
                                                <td class="text-center"><?= $index + 1 ?></td>
                                                <td><?= esc($meeting['title']) ?></td>
                                                <td class="text-center"><?= date('d/m/Y', strtotime($meeting['date'])) ?></td>
                                                <td class="text-center">
                                                    <?= date('H:i', strtotime($meeting['start_time'])) ?> -
                                                    <?= date('H:i', strtotime($meeting['end_time'])) ?>
                                                </td>
                                                <td><?= esc($meeting['room_name']) ?></td>
                                                <td><?= esc($meeting['nama_penyelenggara']) ?></td>
                                                <td class="text-center">
                                                    <span class="badge rounded-pill <?= $badges[$meeting['status']] ?>">
                                                        <?= ucfirst($meeting['status']) ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-info"
                                                            onclick="showDetail(<?= htmlspecialchars(json_encode($meeting)) ?>)"
                                                            title="Detail">
                                                            <i class="fas fa-info-circle"></i>
                                                        </button>
                                                        <?php if ($meeting['status'] === 'pending'): ?>
                                                            <a href="/booking/approve/<?= $meeting['id'] ?>"
                                                                class="btn btn-sm btn-success"
                                                                title="Setujui">
                                                                <i class="fas fa-check"></i>
                                                            </a>
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="showRejectModal(<?= $meeting['id'] ?>)"
                                                                title="Tolak">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detail Meeting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6 class="fw-bold">Judul:</h6>
                    <p id="detail_title"></p>
                </div>
                <div class="mb-3">
                    <h6 class="fw-bold">Deskripsi:</h6>
                    <p id="detail_description"></p>
                </div>
                <div class="mb-3">
                    <h6 class="fw-bold">Waktu:</h6>
                    <p id="detail_datetime"></p>
                </div>
                <div class="mb-3">
                    <h6 class="fw-bold">Ruangan:</h6>
                    <p id="detail_room"></p>
                </div>
                <div class="mb-3">
                    <h6 class="fw-bold">Penyelenggara:</h6>
                    <p id="detail_penyelenggara"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Tolak Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rejectForm" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Alasan Penolakan:</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
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
        let tables = {};

        // Initialize DataTables
        ['all', 'pending', 'approved', 'rejected'].forEach(status => {
            tables[status] = $(`#${status}Table`).DataTable({
                pageLength: 10,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                order: [
                    [1, 'asc']
                ]
            });
        });

        // Function to update delete button state
        function updateDeleteButton() {
            const selectedCount = $('input[name="selected_ids[]"]:checked').length;
            $('#selectedCount').text(selectedCount);
            $('#deleteSelected').prop('disabled', selectedCount === 0);
        }

        // Handle select all checkbox for each tab
        $('.select-all').on('change', function() {
            const tab = $(this).data('tab');
            const isChecked = $(this).prop('checked');

            // Get all checkboxes in the current visible tab
            const currentTabCheckboxes = $(`#${tab} .check-item`);
            currentTabCheckboxes.prop('checked', isChecked);

            updateDeleteButton();
        });

        // Handle individual checkboxes
        $('.check-item').on('change', function() {
            const tab = $(this).data('tab');

            // Get all checkboxes in the current tab
            const currentTabCheckboxes = $(`#${tab} .check-item`);
            const checkedCheckboxes = $(`#${tab} .check-item:checked`);

            // Update select all checkbox for current tab
            $(`#${tab}Table .select-all`).prop('checked',
                currentTabCheckboxes.length === checkedCheckboxes.length && currentTabCheckboxes.length > 0
            );

            updateDeleteButton();
        });

        // Reset selection when changing tabs
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $('.select-all').prop('checked', false);
            $('.check-item').prop('checked', false);
            updateDeleteButton();
        });

        // Confirm delete
        $('#deleteForm').on('submit', function(e) {
            e.preventDefault();

            // Check if any approved meetings are selected
            const hasApproved = $('input[name="selected_ids[]"]:checked').toArray()
                .some(checkbox => $(checkbox).data('status') === 'approved');

            if (hasApproved) {
                alert('Tidak dapat menghapus meeting yang sudah disetujui. Silakan pilih kembali.');
                return false;
            }

            if (!confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')) {
                return false;
            }

            this.submit();
        });
    });

    function showDetail(meeting) {
        $('#detail_title').text(meeting.title);
        $('#detail_description').text(meeting.description);
        $('#detail_datetime').text(
            `${formatDate(meeting.date)} ${formatTime(meeting.start_time)} - ${formatTime(meeting.end_time)}`
        );
        $('#detail_room').text(meeting.room_name);
        $('#detail_penyelenggara').text(meeting.nama_penyelenggara);
        $('#detailModal').modal('show');
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    }

    function formatTime(timeString) {
        return timeString.substring(0, 5);
    }

    function showRejectModal(id) {
        $('#rejectForm').attr('action', `/booking/reject/${id}`);
        $('#rejectModal').modal('show');
    }
</script>