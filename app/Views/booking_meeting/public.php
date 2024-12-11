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
            eventContent: function(arg) {
                return {
                    html: `
                        <div class="fc-event-main-frame p-2">
                            <div class="fc-event-title-container">
                                <div class="fc-event-title font-weight-bold">
                                    <i class="fas fa-bookmark me-1 text-warning"></i> ${arg.event.title}
                                </div>
                            </div>
                            <div class="fc-event-description small mt-1">
                                <i class="fas fa-clock me-1 text-light"></i> ${new Date(arg.event.start).toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})} WIB
                                <br>
                                <i class="fas fa-door-open me-1 text-success"></i> ${arg.event.extendedProps.room}
                                <br>
                                <i class="fas fa-user me-1 text-info"></i> ${arg.event.extendedProps.user}
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
                $('#detail_user').text(info.event.extendedProps.user);
            }
        });

        calendar.render();
    });
</script>

<div class="dashboard-container py-2">
    <div class="calendar-wrapper">
        <div class="card shadow-sm rounded-3 border-0">
            <!-- Header Card yang lebih compact -->
            <div class="card-header py-2 px-3" style="background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-white bg-opacity-10 p-1" style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-calendar-alt text-white small"></i>
                        </div>
                        <div>
                            <h6 class="text-white mb-0 small">Jadwal Rapat</h6>
                        </div>
                    </div>
                    <a href="<?= base_url('/') ?>" class="btn btn-light btn-sm rounded-pill py-1 px-2" style="font-size: 0.75rem;">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-2">
                <div id="calendar" class="shadow-sm rounded-3 bg-white"></div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Detail Meeting -->
<div class="modal fade" id="detailModal" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm rounded-3">
            <!-- Header -->
            <div class="modal-header py-2 px-3" style="background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-check text-white"></i>
                    <h6 class="modal-title text-white mb-0">Detail Meeting</h6>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-3">
                <h6 class="fw-bold text-primary mb-3" id="detail_title"></h6>

                <div class="row g-3">
                    <!-- Date & Time -->
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-calendar-day text-primary"></i>
                            <span id="detail_date" class="small"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-clock text-success"></i>
                            <span class="small">
                                <span id="detail_start"></span> - <span id="detail_end"></span>
                            </span>
                        </div>
                    </div>

                    <!-- Room & User -->
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-door-open text-warning"></i>
                            <span id="detail_room" class="small"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-user text-info"></i>
                            <span id="detail_user" class="small"></span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <div class="bg-light rounded-2 p-2">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fas fa-file-alt text-primary"></i>
                                <small class="fw-bold">Deskripsi</small>
                            </div>
                            <p class="small text-muted mb-0" id="detail_description"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<style>
    :root {
        --header-height: 60px;
        --footer-height: 40px;
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --accent-color: #16a085;
    }

    /* Layout & Container */
    .dashboard-container {
        min-height: calc(100vh - var(--header-height) - var(--footer-height));
        padding: 1rem;
        display: flex;
        align-items: center;
    }

    .calendar-wrapper {
        width: 100%;
        max-width: 900px;
        margin: 0 auto;
    }

    /* Calendar Styles */
    #calendar {
        height: 100%;
        padding: 0.8rem !important;
    }

    .fc {
        height: 100% !important;
    }

    .fc-view-harness {
        height: calc(100% - 50px) !important;
    }

    .fc-event {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
        border-left: 3px solid var(--accent-color) !important;
        margin: 2px 0 !important;
        padding: 3px !important;
        border-radius: 4px !important;
        transition: all 0.2s ease;
    }

    .fc-event:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
    }

    .fc-header-toolbar {
        padding: 12px !important;
        margin-bottom: 15px !important;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border-radius: 8px;
    }

    .fc-toolbar-title {
        color: white !important;
        font-size: 1.1rem !important;
    }

    /* Icon Styles */
    .header-icon-wrapper {
        position: relative;
        width: 35px;
        height: 35px;
    }

    .icon-pulse {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 12px;
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        padding: 1rem;
    }

    .info-card {
        padding: 0.8rem;
        border-radius: 8px;
        background: #f8f9fa;
        margin-bottom: 0.8rem;
    }

    /* Animations */
    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.3);
            opacity: 0;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-height: 768px) {
        .card {
            height: calc(100vh - 1rem);
        }

        .card-header {
            padding: 0.6rem 1rem !important;
        }

        .fc-header-toolbar {
            padding: 8px !important;
            margin-bottom: 8px !important;
        }

        .fc-toolbar-title {
            font-size: 1rem !important;
        }
    }

    @media (max-width: 576px) {
        .dashboard-container {
            padding: 0.5rem;
        }

        .calendar-wrapper {
            max-width: 100%;
        }

        .fc-toolbar-chunk {
            display: flex;
            gap: 5px;
        }

        .fc-button {
            padding: 4px 8px !important;
            font-size: 0.8rem !important;
        }
    }
</style>