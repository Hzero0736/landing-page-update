<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var userRole = '';

        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap5',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            initialDate: new Date(),
            navLinks: true,
            businessHours: true,
            editable: userRole === 'secretary',
            selectable: userRole === 'secretary',
            events: <?= json_encode($meetings) ?>,
            eventColor: '#2c3e50',
            eventBorderColor: '#34495e',
            eventTextColor: '#ffffff',
            slotMinTime: '08:00:00',
            slotMaxTime: '18:00:00',
            height: 'auto',
            contentHeight: 'auto',
            aspectRatio: 1.8,
            eventContent: function(arg) {
                return {
                    html: `
                        <div class="fc-event-main-frame p-1">
                            <div class="d-flex align-items-center gap-1 mb-1">
                                <i class="fas fa-bookmark text-warning small"></i>
                                <span class="fw-bold small">${arg.event.title}</span>
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fas fa-clock text-light small"></i>
                                    <span class="small">${new Date(arg.event.start).toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})} WIB</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fas fa-door-open text-success small"></i>
                                    <span class="small">${arg.event.extendedProps.room}</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fas fa-user text-info small"></i>
                                    <span class="small">${arg.event.extendedProps.user}</span>
                                </div>
                            </div>
                        </div>
                    `
                }
            },
            select: function(info) {
                $('#bookingModal').modal('show');
                $('#room_id').val(info.room_id);
                $('#date').val(info.startStr.split('T')[0]);
                $('#start_time').val(info.startStr.split('T')[1].slice(0, 5));
                $('#end_time').val(info.endStr.split('T')[1].slice(0, 5));
            },
            eventClick: function(info) {
                $('#detailModal').modal('show');
                $('#detail_title').text(info.event.title);

                const startDateTime = new Date(info.event.start);
                const endDateTime = new Date(info.event.end);

                const dateOptions = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };

                const timeOptions = {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                };

                const formattedDate = startDateTime.toLocaleDateString('id-ID', dateOptions);
                const formattedStartTime = startDateTime.toLocaleTimeString('id-ID', timeOptions);
                const formattedEndTime = endDateTime.toLocaleTimeString('id-ID', timeOptions);

                $('#detail_date').text(formattedDate);
                $('#detail_start').text(formattedStartTime + ' WIB');
                $('#detail_end').text(formattedEndTime + ' WIB');
                $('#detail_room').text(info.event.extendedProps.room);
                $('#detail_description').text(info.event.extendedProps.description || 'Tidak ada deskripsi');
                $('#detail_user').text(info.event.extendedProps.user);

                $('#detailModal').data('eventId', info.event.id);

                $('#edit_id').val(info.event.id);
                $('#edit_title').val(info.event.title);
                $('#edit_date').val(info.event.startStr.split('T')[0]);
                $('#edit_start').val(info.event.startStr.split('T')[1].slice(0, 5));
                $('#edit_end').val(info.event.endStr.split('T')[1].slice(0, 5));
                $('#edit_room').val(info.event.extendedProps.room_id);
                $('#edit_description').val(info.event.extendedProps.description || '');
                $('#edit_user').val(info.event.extendedProps.user);

                const roomId = info.event.extendedProps.room_id;
                if (roomId) {
                    $(`#edit_room option[value='${roomId}']`).prop('selected', true);
                }
            }
        });

        calendar.render();

        $('#saveEditBtn').on('click', function(e) {
            e.preventDefault();
            const eventId = $('#edit_id').val();
            $('#editBookingForm').attr('action', `/booking/edit/${eventId}`);
            $('#editBookingForm').submit();
        });
    });

    function deleteBooking() {
        const eventId = $('#detailModal').data('eventId');
        $('#detailModal').modal('hide');
        $('#confirmDeleteModal').modal('show');
        $('#confirmDeleteBtn').attr('href', `/booking/delete/${eventId}`);
    }

    $(document).on('click', '#confirmDeleteBtn', function() {
        const eventId = $(this).attr('data-id');
        window.location.href = `/booking/delete/${eventId}`;
    });
</script>

<body>
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 rounded-3 position-relative overflow-hidden" role="alert"
            style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGxpbmVhckdyYWRpZW50IGlkPSJncmFkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeD0iMCIgeT0iMCIgeDI9IjEwMCUiIHkyPSIxMDAlIj48c3RvcCBvZmZzZXQ9IjAlIiBzdHlsZT0ic3RvcC1jb2xvcjpyZ2JhKDI1NSwyNTUsMjU1LDAuMSkiLz48c3RvcCBvZmZzZXQ9IjEwMCUiIHN0eWxlPSJzdG9wLWNvbG9yOnJnYmEoMjU1LDI1NSwyNTUsMCkiLz48L2xpbmVhckdyYWRpZW50PjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4=')"></div>
            <div class="d-flex align-items-center text-white">
                <i class="fas fa-check-circle fa-lg me-2 animate__animated animate__bounceIn"></i>
                <span class="fw-bold"><?= session()->get('success') ?></span>
            </div>
            <button type="button" class="btn-close btn-close-white btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-lg border-0 rounded-3 position-relative overflow-hidden" role="alert"
            style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGxpbmVhckdyYWRpZW50IGlkPSJncmFkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeD0iMCIgeT0iMCIgeDI9IjEwMCUiIHkyPSIxMDAlIj48c3RvcCBvZmZzZXQ9IjAlIiBzdHlsZT0ic3RvcC1jb2xvcjpyZ2JhKDI1NSwyNTUsMjU1LDAuMSkiLz48c3RvcCBvZmZzZXQ9IjEwMCUiIHN0eWxlPSJzdG9wLWNvbG9yOnJnYmEoMjU1LDI1NSwyNTUsMCkiLz48L2xpbmVhckdyYWRpZW50PjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4=')"></div>
            <div class="d-flex align-items-center text-white">
                <i class="fas fa-exclamation-circle fa-lg me-2 animate__animated animate__headShake"></i>
                <span class="fw-bold"><?= session()->get('error') ?></span>
            </div>
            <button type="button" class="btn-close btn-close-white btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-start border-danger border-3" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <ul class="mb-0 small">
                <?php foreach (session()->get('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="container mt-3">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card shadow rounded-3 mb-3 border-0">
                    <div class="card-header bg-gradient text-white py-2 d-flex justify-content-between align-items-center" style="background-color: #4e73df;">
                        <div>
                            <i class="fas fa-door-open me-2"></i>
                            <span class="fw-bold">Daftar Ruangan</span>
                        </div>
                        <div>
                            <button class="btn btn-light btn-sm rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body bg-light" style="height: 350px; overflow-y: auto;">
                        <?php if (isset($rooms) && is_array($rooms)): ?>
                            <?php foreach ($rooms as $room): ?>
                                <div class="room-item mb-2 p-2 bg-white rounded-3 shadow-sm hover-lift transition-all" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $room['description'] ?>">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="room-icon bg-primary bg-opacity-10 p-1 rounded-circle me-2">
                                                <i class="fas fa-door-open text-primary small"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 small fw-bold"><?= $room['name'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btn-sm rounded-pill me-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editRoomModal"
                                                data-id="<?= $room['id']; ?>"
                                                data-name="<?= $room['name']; ?>"
                                                data-description="<?= $room['description']; ?>"
                                                title="Edit">
                                                <i class="fas fa-edit small"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm rounded-pill"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteRoomModal"
                                                data-id="<?= $room['id'] ?>"
                                                title="Hapus">
                                                <i class="fas fa-trash small"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card shadow rounded-3 border-0">
                    <div class="card-header bg-gradient text-white py-2 d-flex justify-content-between align-items-center" style="background-color: #4e73df;">
                        <div>
                            <i class="fas fa-calendar-alt me-2"></i>
                            <span class="fw-bold">Kalender Booking</span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-light btn-sm rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                <i class="fas fa-calendar-plus me-1"></i>Buat Booking
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div id="calendar" class="shadow-sm rounded-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Kode calendar yang sudah ada

            // Script untuk modal delete room
            $('#deleteRoomModal').on('show.bs.modal', function(e) {
                var roomId = $(e.relatedTarget).data('id');
                $('#deleteRoomBtn').attr('href', '/room/delete/' + roomId);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Kode calendar yang sudah ada

            // Script untuk modal edit room
            $('#editRoomModal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var description = button.data('description');

                // Set action URL dengan ID ruangan
                $('#editRoomForm').attr('action', '/room/edit/' + id);

                // Isi nilai input form
                $('#edit_name').val(name);
                $('#edit_description').val(description);
            });
        });
    </script>