<div>
    <div id="calendar"></div>

    @push('styles')
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css' rel='stylesheet' />
    @endpush

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.js'></script>
        <script>
            document.addEventListener('livewire:load', function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: '/api/events', // You can customize this API
                    selectable: true,
                    select: function(info) {
                        alert('Selected: ' + info.startStr + ' to ' + info.endStr);
                        // You can trigger Livewire actions here
                    }
                });

                calendar.render();
            });
        </script>
    @endpush
</div>
