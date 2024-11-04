<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
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
            editable: false,
            selectable: false,
            events: <?= json_encode($meetings) ?>,
            eventColor: '#3788d8',
            eventBorderColor: '#2C3E50',
            eventTextColor: '#ffffff',
            slotMinTime: '08:00:00',
            slotMaxTime: '18:00:00',
            height: 'auto',
            contentHeight: 'auto',
            aspectRatio: 1.8,
            eventClick: function(info) {
                $('#detailModal').modal('show');
                $('#detail_title').text(info.event.title);

                // Format tanggal dan waktu
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
            }
        });

        calendar.render();
    });
</script>

<div class="col-md-10 mx-auto">
    <div class="card shadow-lg rounded-3 border-0 hover-lift">
        <div class="card-header bg-dark bg-gradient text-white py-2" style="background: linear-gradient(45deg, #4e73df, #224abe);">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-calendar-alt fa-lg me-2 animate__animated animate__pulse animate__infinite"></i>
                    <span class="fw-bold fs-5">Jadwal Rapat</span>
                </div>
                <a href="<?= base_url('/') ?>" class="btn btn-light btn-sm rounded-pill hover-shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
        <div class="card-body p-3">
            <div id="calendar" class="shadow-sm rounded-3 border border-light p-2 bg-white"></div>
        </div>
    </div>
</div>

<!-- Modal Detail Meeting -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient text-white" style="background-color: #4e73df;">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-calendar-check me-2"></i> Detail Meeting
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="card mb-3 border-0">
                    <div class="card-body p-0">
                        <h4 class="card-title mb-4 text-primary" id="detail_title"></h4>

                        <div class="d-flex align-items-center mb-3 p-2 rounded hover-bg-light">
                            <div class="icon-box rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                <i class="fas fa-calendar-day text-primary"></i>
                            </div>
                            <span id="detail_date" class="fs-6"></span>
                        </div>

                        <div class="d-flex align-items-center mb-3 p-2 rounded hover-bg-light">
                            <div class="icon-box rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                <i class="fas fa-clock text-primary"></i>
                            </div>
                            <div>
                                <span id="detail_start"></span>
                                <span class="mx-2">-</span>
                                <span id="detail_end"></span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3 p-2 rounded hover-bg-light">
                            <div class="icon-box rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                <i class="fas fa-door-open text-primary"></i>
                            </div>
                            <span id="detail_room" class="fs-6"></span>
                        </div>

                        <div class="d-flex align-items-center mb-4 p-2 rounded hover-bg-light">
                            <div class="icon-box rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <span id="detail_user" class="fs-6"></span>
                        </div>

                        <div class="mt-4 p-3 bg-light rounded-3">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-file-alt text-primary me-2"></i> Deskripsi
                            </h6>
                            <p class="text-muted mb-0" id="detail_description"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-bg-light:hover {
        background-color: rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
    }

    .btn-light-primary {
        color: #4e73df;
        background-color: #eef2ff;
        border: none;
    }

    .btn-light-primary:hover {
        background-color: #4e73df;
        color: white;
        transition: all 0.3s ease;
    }

    .icon-box {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>