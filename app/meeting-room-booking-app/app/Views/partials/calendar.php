<div class="card h-100">
    <div class="card-header d-flex justify-content-between align-items-center py-2 py-md-3">
        <div class="d-flex align-items-center">
            <i class="fas fa-calendar-alt me-2"></i>
            <span class="fw-bold fs-6 fs-md-5">Kalender Booking</span>
        </div>
        <button class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1 gap-md-2" data-bs-toggle="modal" data-bs-target="#bookingModal">
            <i class="fas fa-plus"></i>
            <span class="d-none d-sm-inline">Buat Booking</span>
        </button>
    </div>
    <div class="card-body p-2 p-md-3" style="height: calc(100vh - 160px);">
        <div id="calendar" class="w-100 h-100"></div>
    </div>
</div>
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
            editable: true,
            selectable: true,
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
                                <span class="small">${arg.event.extendedProps.user}</span>
                            </div>
                        </div>
                    </div>
                `;
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
                const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const timeOptions = { hour: '2-digit', minute: '2-digit', hour12: false };
                $('#detail_date').text(startDateTime.toLocaleDateString('id-ID', dateOptions));
                $('#detail_start').text(startDateTime.toLocaleTimeString('id-ID', timeOptions) + ' WIB');
                $('#detail_end').text(endDateTime.toLocaleTimeString('id-ID', timeOptions) + ' WIB');
                $('#detail_room').text(info.event.extendedProps.room);
                $('#detail_description').text(info.event.extendedProps.description || 'Tidak ada deskripsi');
                $('#detail_user').text(info.event.extendedProps.user);
                $('#detailModal').data('eventId', info.event.id);
            }
        });

        calendar.render();

        window.addEventListener('resize', function() {
            calendar.setOption('aspectRatio', window.innerWidth < 768 ? 1.2 : 1.8);
        });
    });
</script>