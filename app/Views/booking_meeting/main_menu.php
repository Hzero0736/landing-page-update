<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(to right, rgb(53, 133, 95), rgb(40, 100, 70));">
    <div class="container-fluid">
        <!-- Brand Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/booking">
            <img src="../assets/img/logo.png" alt="Logo" height="45" class="rounded">
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Content -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <ul class="navbar-nav me-3">
                <li class="nav-item">
                    <a class="nav-link active" href="/">
                        <i class="fas fa-home me-2"></i>Home
                    </a>
                </li>
            </ul>

            <div class="dropdown">
                <button class="btn text-white dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle fs-5"></i>
                    <span class="badge bg-light text-dark"><?= session()->get('name') ?></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <h6 class="dropdown-header">Signed in as</h6>
                    </li>
                    <li><span class="dropdown-item-text fw-bold"><?= session()->get('role') ?></span></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="/logout">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<!-- Navigation Content -->
<div class="collapse navbar-collapse justify-content-end" id="navbarContent">
    <div class="dropdown">
        <button class="btn text-white dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle fs-5"></i>
            <span class="badge bg-light text-dark"><?= session()->get('name') ?></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li>
                <h6 class="dropdown-header">Signed in as</h6>
            </li>
            <li><span class="dropdown-item-text fw-bold"><?= session()->get('role') ?></span></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item text-danger d-flex align-items-center gap-2" href="/logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
</div>
</nav>

<div class="container-fluid min-vh-100 py-3">
    <!-- Alert Messages -->
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <span><?= session()->get('success') ?></span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                <span><?= session()->get('error') ?></span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-3">
        <!-- Sidebar -->
        <div class="col-12 col-md-4 col-lg-3">
            <!-- Meeting Rooms Card -->
            <?php if (session()->get('role') === 'superadmin'): ?>
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(to right, rgb(53, 133, 95), rgb(47, 124, 86));">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-door-open me-2 text-white"></i>
                            <span class="fw-bold text-white">Daftar Ruangan</span>
                        </div>
                        <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body" style="max-height: 40vh; overflow-y: auto;">
                        <?php if (isset($rooms) && is_array($rooms)): ?>
                            <?php foreach ($rooms as $room): ?>
                                <div class="d-flex justify-content-between align-items-center p-2 border rounded mb-2">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-door-open text-primary me-2"></i>
                                            <span class="fw-bold"><?= $room['name'] ?></span>
                                        </div>
                                        <small class="text-muted ms-4"><?= $room['description'] ?></small>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editRoomModal"
                                            data-id="<?= $room['id'] ?>"
                                            data-name="<?= $room['name'] ?>"
                                            data-description="<?= $room['description'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteRoomModal"
                                            data-id="<?= $room['id'] ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Users Card -->
            <?php if (session()->get('role') === 'superadmin'): ?>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(to right, rgb(53, 133, 95), rgb(40, 100, 70));">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users me-2 text-white"></i>
                            <span class="fw-bold text-white">Daftar User</span>
                        </div>
                        <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="modal" data-bs-target="#addUserModal">
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
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailUserModal"
                                            data-nik="<?= $user['nik'] ?>" data-name="<?= $user['name'] ?>"
                                            data-role="<?= $user['role'] ?>" data-password="<?= $user['password'] ?>">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
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
            <?php endif; ?>
        </div>

        <!-- Calendar -->
        <div class="col-12 <?= session()->get('role') === 'admin' ? 'col-md-12 col-lg-12' : 'col-md-8 col-lg-9' ?>">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center py-2 py-md-3" style="background: linear-gradient(to right, rgb(53, 133, 95), rgb(40, 100, 70));">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-calendar-alt me-2 text-white"></i>
                        <span class="fw-bold fs-6 fs-md-5 text-white">Kalender Booking</span>
                    </div>
                    <button class="btn btn-light btn-sm d-inline-flex align-items-center gap-1 gap-md-2" data-bs-toggle="modal" data-bs-target="#bookingModal">
                        <i class="fas fa-plus"></i>
                        <span class="d-none d-sm-inline">Buat Booking</span>
                    </button>
                </div>
                <div class="card-body p-2 p-md-3" style="height: calc(100vh - 160px);">
                    <div id="calendar" class="w-100 h-100"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
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
            height: '100%',
            contentHeight: '100%',
            aspectRatio: window.innerWidth < 768 ? 1.2 : 1.8,
            handleWindowResize: true,
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
                            <span class="small">${arg.event.extendedProps.nama_penyelenggara}</span>
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
                $('#detail_penyelenggara').text(info.event.extendedProps.nama_penyelenggara);
                $('#detailModal').data('eventId', info.event.id);

                // Set data untuk form edit
                $('#edit_id').val(info.event.id);
                $('#edit_title').val(info.event.title);
                $('#edit_date').val(info.event.startStr.split('T')[0]);
                $('#edit_start').val(info.event.startStr.split('T')[1].slice(0, 5));
                $('#edit_end').val(info.event.endStr.split('T')[1].slice(0, 5));
                $('#edit_room').val(info.event.extendedProps.room_id);
                $('#edit_description').val(info.event.extendedProps.description || '');
                $('#edit_nama_penyelenggara').val(info.event.extendedProps.nama_penyelenggara);
            }
        });

        calendar.render();

        window.addEventListener('resize', function() {
            calendar.setOption('aspectRatio', window.innerWidth < 768 ? 1.2 : 1.8);
        });

        // Event handlers untuk modal
        $('#saveEditBtn').on('click', function(e) {
            e.preventDefault();
            const eventId = $('#edit_id').val();
            $('#editBookingForm').attr('action', `/booking/edit/${eventId}`);
            $('#editBookingForm').submit();
        });

        //modal room
        $('#deleteRoomModal').on('show.bs.modal', function(e) {
            var roomId = $(e.relatedTarget).data('id');
            $('#deleteRoomBtn').attr('href', '/room/delete/' + roomId);
        });

        $('#editRoomModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var description = button.data('description');
            $('#editRoomForm').attr('action', '/room/edit/' + id);
            $('#edit_name').val(name);
            $('#edit_description_room').val(description);
        });

        //modal user
        $('#deleteUserModal').on('show.bs.modal', function(e) {
            var userId = $(e.relatedTarget).data('id');
            $('#deleteUserBtn').attr('href', '/users/delete/' + userId);
        });

        $('#detailUserModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var nik = button.data('nik');
            var name = button.data('name');
            var role = button.data('role');
            var password = button.data('password');

            $('#detail_nik').text(nik);
            $('#detail_name').text(name);
            $('#detail_role').text(role);
            $('#detail_password').val(password);
        });

        window.togglePasswordVisibility = function() {
            const passwordField = document.getElementById('detail_password');
            const passwordFieldType = passwordField.getAttribute('type');
            passwordField.setAttribute('type', passwordFieldType === 'password' ? 'text' : 'password');
        }

        $('#editUserModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var id = button.data('id');
            var nik = button.data('nik');
            var name = button.data('name');
            var role = button.data('role');

            var form = $(this).find('form');
            form.attr('action', '/users/edit/' + id);

            $('#edit_id').val(id);
            $('#edit_nik').val(nik);
            $('#edit_name_user').val(name);
            $('#edit_role').val(role);
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