<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Schedule Management') }}
        </h2>
            <a href="{{ route('admin.schedule.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Schedule
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search Form -->
            <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                <form action="{{ route('admin.schedule.index') }}" method="GET" class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            placeholder="Search by task title, description, status, priority, employee name, crop name, or field name...">
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.schedule.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:bg-gray-400 dark:focus:bg-gray-500 active:bg-gray-500 dark:active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Reset
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:bg-indigo-700 dark:focus:bg-indigo-600 active:bg-indigo-900 dark:active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Schedule Lists -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tasks List -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Tasks</h3>
                    <div class="space-y-4">
                        @forelse($tasks as $task)
                            <div class="border dark:border-gray-700 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $task->title }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                                        <div class="mt-2 flex items-center space-x-2">
                                            <span class="px-2 py-1 text-xs rounded-full {{ $task->priority === 'high' ? 'bg-red-100 text-red-800' : ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                            <span class="px-2 py-1 text-xs rounded-full {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : ($task->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ ucfirst($task->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.schedule.edit', ['id' => $task->id, 'type' => 'task']) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Edit</a>
                                        <form action="{{ route('admin.schedule.destroy', ['id' => $task->id, 'type' => 'task']) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Due: {{ $task->due_date->format('M d, Y') }} | Assigned to: {{ $task->employee ? $task->employee->first_name . ' ' . $task->employee->last_name : 'Unassigned' }}
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">No tasks found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Planting Schedules List -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Planting Schedules</h3>
                    <div class="space-y-4">
                        @forelse($plantingSchedules as $schedule)
                            <div class="border dark:border-gray-700 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $schedule->crop->name }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Field: {{ $schedule->field->name }}</p>
                                        <div class="mt-2">
                                            <span class="px-2 py-1 text-xs rounded-full {{ $schedule->status === 'completed' ? 'bg-green-100 text-green-800' : ($schedule->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ ucfirst($schedule->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.schedule.edit', ['id' => $schedule->id, 'type' => 'planting']) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Edit</a>
                                        <form action="{{ route('admin.schedule.destroy', ['id' => $schedule->id, 'type' => 'planting']) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400" onclick="return confirm('Are you sure you want to delete this planting schedule?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Planting: {{ $schedule->planting_date->format('M d, Y') }} | Harvest: {{ $schedule->expected_harvest_date->format('M d, Y') }}
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">No planting schedules found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css' rel='stylesheet' />
    <style>
        .calendar-container {
            height: 800px;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        .fc-event {
            cursor: pointer;
            padding: 4px 8px;
            margin: 1px 0;
            border-radius: 4px;
            border: none;
            font-size: 0.875rem;
            transition: all 0.2s ease-in-out;
        }
        .fc-event:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .fc-event-title {
            font-weight: 500;
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .fc-daygrid-event {
            white-space: normal;
            overflow: hidden;
            background: transparent;
        }
        .fc-toolbar-title {
            font-size: 1.25rem !important;
            font-weight: 600;
            color: #1F2937;
        }
        .fc-button {
            background-color: #4F46E5 !important;
            border-color: #4F46E5 !important;
            padding: 0.5rem 1rem !important;
            font-weight: 500 !important;
            border-radius: 0.375rem !important;
            transition: all 0.2s ease-in-out !important;
        }
        .fc-button:hover {
            background-color: #4338CA !important;
            border-color: #4338CA !important;
            transform: translateY(-1px);
        }
        .fc-button-active {
            background-color: #3730A3 !important;
            border-color: #3730A3 !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .fc-daygrid-day {
            transition: background-color 0.2s ease-in-out;
        }
        .fc-daygrid-day:hover {
            background-color: #F9FAFB;
        }
        .fc-daygrid-day.fc-day-today {
            background-color: #EEF2FF !important;
        }
        .fc-daygrid-day-number {
            font-size: 0.875rem;
            font-weight: 500;
            padding: 8px !important;
        }
        .fc-col-header-cell {
            padding: 8px 0;
            background-color: #F9FAFB;
            font-weight: 600;
        }
        .fc-theme-standard td, .fc-theme-standard th {
            border-color: #E5E7EB;
        }
        .fc-theme-standard .fc-scrollgrid {
            border-color: #E5E7EB;
        }
        .fc-daygrid-event-dot {
            border-color: currentColor !important;
        }
        .fc-event.priority-high {
            background-color: #FEE2E2;
            color: #991B1B;
            border-left: 4px solid #EF4444;
        }
        .fc-event.priority-medium {
            background-color: #FEF3C7;
            color: #92400E;
            border-left: 4px solid #F59E0B;
        }
        .fc-event.priority-low {
            background-color: #DCFCE7;
            color: #166534;
            border-left: 4px solid #22C55E;
        }
        .fc-event.planting-schedule {
            background-color: #EFF6FF;
            color: #1E40AF;
            border-left: 4px solid #3B82F6;
        }
        .fc-event.completed {
            opacity: 0.7;
            text-decoration: line-through;
        }
        .fc-event.in-progress {
            border-style: dashed;
        }
        .dark .calendar-container {
            background: #1F2937;
        }
        .dark .fc-toolbar-title {
            color: #F9FAFB;
        }
        .dark .fc-button {
            background-color: #4F46E5 !important;
            border-color: #4F46E5 !important;
        }
        .dark .fc-daygrid-day:hover {
            background-color: #374151;
        }
        .dark .fc-daygrid-day.fc-day-today {
            background-color: #312E81 !important;
        }
        .dark .fc-col-header-cell {
            background-color: #374151;
            color: #F9FAFB;
        }
        .dark .fc-theme-standard td, .dark .fc-theme-standard th {
            border-color: #374151;
        }
        .dark .fc-theme-standard .fc-scrollgrid {
            border-color: #374151;
        }
        .dark .fc-daygrid-day {
            background-color: #1F2937;
        }
        .dark .fc-daygrid-day-number {
            color: #F9FAFB;
        }
        .dark .fc-event.priority-high {
            background-color: #7F1D1D;
            color: #FEE2E2;
            border-left: 4px solid #EF4444;
        }
        .dark .fc-event.priority-medium {
            background-color: #78350F;
            color: #FEF3C7;
            border-left: 4px solid #F59E0B;
        }
        .dark .fc-event.priority-low {
            background-color: #14532D;
            color: #DCFCE7;
            border-left: 4px solid #22C55E;
        }
        .dark .fc-event.planting-schedule {
            background-color: #1E3A8A;
            color: #EFF6FF;
            border-left: 4px solid #3B82F6;
        }
    </style>
    @endpush

    @push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: "{{ route('fullcalender') }}",
                editable: true,
                selectable: true,
                selectHelper: true,
                eventDrop: function(info) {
                    var start = info.event.start.toISOString();
                    var end = info.event.end ? info.event.end.toISOString() : start;
                    
                    $.ajax({
                        url: "{{ route('fullcalenderAjax') }}",
                        type: "POST",
                        data: {
                            id: info.event.id,
                            title: info.event.title,
                            start: start,
                            end: end,
                            type: 'update'
                        },
                        success: function(response) {
                            toastr.success('Event updated successfully');
                        },
                        error: function(error) {
                            toastr.error('Error updating event');
                            info.revert();
                        }
                    });
                },
                eventResize: function(info) {
                    var start = info.event.start.toISOString();
                    var end = info.event.end.toISOString();
                    
                    $.ajax({
                        url: "{{ route('fullcalenderAjax') }}",
                        type: "POST",
                        data: {
                            id: info.event.id,
                            title: info.event.title,
                            start: start,
                            end: end,
                            type: 'update'
                        },
                        success: function(response) {
                            toastr.success('Event updated successfully');
                        },
                        error: function(error) {
                            toastr.error('Error updating event');
                            info.revert();
                        }
                    });
                },
                select: function(info) {
                    var title = prompt('Event Title:');
                    if (title) {
                        $.ajax({
                            url: "{{ route('fullcalenderAjax') }}",
                            type: "POST",
                            data: {
                                title: title,
                                start: info.startStr,
                                end: info.endStr,
                                type: 'add'
                            },
                            success: function(response) {
                                calendar.addEvent({
                                    id: response.id,
                                    title: title,
                                    start: info.startStr,
                                    end: info.endStr
                                });
                                toastr.success('Event created successfully');
                            },
                            error: function(error) {
                                toastr.error('Error creating event');
                            }
                        });
                    }
                    calendar.unselect();
                },
                eventClick: function(info) {
                    if (confirm('Are you sure you want to delete this event?')) {
                        $.ajax({
                            url: "{{ route('fullcalenderAjax') }}",
                            type: "POST",
                            data: {
                                id: info.event.id,
                                type: 'delete'
                            },
                            success: function(response) {
                                info.event.remove();
                                toastr.success('Event deleted successfully');
                            },
                            error: function(error) {
                                toastr.error('Error deleting event');
                            }
                        });
                    }
                }
            });
            calendar.render();
        });
    </script>
    @endpush
</x-app-layout>