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
            events: <?= json_encode(array_filter($meetings, fn($m) => $m['status'] === 'approved')) ?>,
            eventColor: '#3788d8',
            eventBorderColor: '#2C3E50',
            eventTextColor: '#ffffff',
            slotMinTime: '08:00:00',
            slotMaxTime: '18:00:00',
            height: '100vh',
            contentHeight: 'calc(100vh - 150px)',
            aspectRatio: 1.5,
            eventContent: function(arg) {
                return {
                    html: `
                        <div class="fc-event-main-frame p-2">
                            <div class="fc-event-title-container">
                                <div class="fc-event-title fw-bold">
                                    <i class="fas fa-bookmark me-1 text-warning"></i> ${arg.event.title}
                                </div>
                            </div>
                            <div class="fc-event-description small mt-1">
                                <i class="fas fa-clock me-1 text-light"></i> ${new Date(arg.event.start).toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})} WIB
                                <br>
                                <i class="fas fa-door-open me-1 text-success"></i> ${arg.event.extendedProps.room}
                                <br>
                                <i class="fas fa-user me-1 text-info"></i> ${arg.event.extendedProps.nama_penyelenggara}
                            </div>
                        </div>
                    `
                }
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
            }
        });

        calendar.render();
    });
</script>

<div class="dashboard-container">
    <div class="calendar-wrapper">
        <div class="card shadow border-0">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #1a237e 0%, #283593 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white bg-opacity-10 p-2">
                            <i class="fas fa-calendar-alt text-white"></i>
                        </div>
                        <h5 class="text-white mb-0">Jadwal Rapat</h5>
                    </div>
                    <a href="<?= base_url('/') ?>" class="btn btn-light rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-3">
                <div id="calendar" class="shadow-sm rounded bg-white"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Meeting -->
<div class="modal fade" id="detailModal" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header py-3" style="background: linear-gradient(135deg, #1a237e 0%, #283593 100%);">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-check text-white fa-lg"></i>
                    <h5 class="modal-title text-white mb-0">Detail Meeting</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <h5 class="fw-bold text-primary mb-4" id="detail_title"></h5>

                <div class="row g-4">
                    <div class="col-12">
                        <div class="info-card bg-light">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-calendar-day text-primary fa-lg"></i>
                                <span id="detail_date" class="fw-medium"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="info-card bg-light">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-clock text-success fa-lg"></i>
                                <span class="fw-medium">
                                    <span id="detail_start"></span> - <span id="detail_end"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="info-card bg-light">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-door-open text-warning fa-lg"></i>
                                <span id="detail_room" class="fw-medium"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="info-card bg-light">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-user text-info fa-lg"></i>
                                <span id="detail_penyelenggara" class="fw-medium"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="info-card bg-light">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fas fa-file-alt text-primary fa-lg"></i>
                                <h6 class="fw-bold mb-0">Deskripsi</h6>
                            </div>
                            <p class="text-muted mb-0" id="detail_description"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --header-height: 60px;
        --footer-height: 40px;
        --primary-color: #1a237e;
        --secondary-color: #283593;
        --accent-color: #3949ab;
    }

    .dashboard-container {
        height: 100vh;
        padding: 1rem;
        background-color: #f8f9fa;
        overflow: hidden;
    }

    .calendar-wrapper {
        width: 100%;
        height: calc(100vh - 2rem);
        margin: 0 auto;
    }

    .card {
        height: 100%;
    }

    .card-body {
        height: calc(100% - 70px);
        overflow: hidden;
    }

    #calendar {
        height: 100% !important;
        padding: 1rem !important;
        background-color: white;
        border-radius: 8px;
    }

    .fc {
        height: 100% !important;
    }

    .fc-view-harness {
        height: calc(100% - 50px) !important;
    }

    .fc-event {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
        border-left: 4px solid var(--accent-color) !important;
        margin: 3px 0 !important;
        padding: 4px !important;
        border-radius: 6px !important;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .fc-event:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .fc-header-toolbar {
        padding: 0.5rem !important;
        margin-bottom: 1rem !important;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border-radius: 10px;
    }

    .fc-toolbar-title {
        color: white !important;
        font-size: 1.25rem !important;
        font-weight: bold !important;
    }

    .fc-button {
        background-color: rgba(255, 255, 255, 0.1) !important;
        border: none !important;
        padding: 8px 16px !important;
        transition: all 0.3s ease !important;
    }

    .fc-button:hover {
        background-color: rgba(255, 255, 255, 0.2) !important;
        transform: translateY(-1px);
    }

    .info-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        background-color: #e9ecef;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .fc-header-toolbar {
            flex-direction: column;
            gap: 0.5rem;
        }

        .fc-toolbar-chunk {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .modal-dialog {
            margin: 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .dashboard-container {
            padding: 0.5rem;
        }

        .fc-button {
            padding: 6px 12px !important;
            font-size: 0.875rem !important;
        }

        .info-card {
            padding: 0.75rem;
        }
    }
</style>