<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Slot Management - City Pair Slot Allocation System</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #1a1c2e 0%, #2d3748 100%);
                min-height: 100vh;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .table-container {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(10px);
            }
            .form-input {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .form-input:focus {
                background: rgba(255, 255, 255, 0.1);
                border-color: rgba(255, 255, 255, 0.2);
            }
            /* Add styles for select dropdowns */
            select.form-input {
                color: white;
                background-color: rgba(17, 24, 39, 0.7);
            }
            select.form-input option {
                background-color: #1f2937;
                color: white;
                padding: 8px;
            }
            select.form-input:focus {
                background-color: rgba(17, 24, 39, 0.9);
            }
            /* Style for the select arrow */
            select.form-input {
                appearance: none;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
                background-position: right 0.5rem center;
                background-repeat: no-repeat;
                background-size: 1.5em 1.5em;
                padding-right: 2.5rem;
            }
            /* Style for time inputs */
            input[type="text"].form-input {
                color: white;
                background-color: rgba(17, 24, 39, 0.7);
            }
            /* Style for Flatpickr calendar */
            .flatpickr-calendar {
                background: #1f2937 !important;
                border: 1px solid rgba(255, 255, 255, 0.1) !important;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
            }
            .flatpickr-day {
                color: #e5e7eb !important;
            }
            .flatpickr-day:hover {
                background: rgba(255, 255, 255, 0.1) !important;
            }
            .flatpickr-day.selected {
                background: #3b82f6 !important;
                border-color: #3b82f6 !important;
            }
            .flatpickr-time {
                background: #1f2937 !important;
                border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            }
            .flatpickr-time input {
                color: #e5e7eb !important;
            }
            .flatpickr-time input:hover {
                background: rgba(255, 255, 255, 0.1) !important;
            }
            .flatpickr-time input:focus {
                background: rgba(255, 255, 255, 0.15) !important;
            }
            .flatpickr-current-month {
                color: #e5e7eb !important;
            }
            .flatpickr-months .flatpickr-month {
                background: #1f2937 !important;
                color: #e5e7eb !important;
            }
            .flatpickr-months .flatpickr-prev-month,
            .flatpickr-months .flatpickr-next-month {
                color: #e5e7eb !important;
                fill: #e5e7eb !important;
            }
            .flatpickr-months .flatpickr-prev-month:hover,
            .flatpickr-months .flatpickr-next-month:hover {
                color: #3b82f6 !important;
                fill: #3b82f6 !important;
            }
        </style>
    </head>
    <body class="text-gray-100">
        <nav class="bg-gray-900/50 backdrop-blur-lg border-b border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="/" class="text-xl font-semibold text-white">City Pair Slot System</a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Slot Management</h1>
                <p class="text-gray-400">Manage flight slots and block times between city pairs</p>
            </div>

            <!-- Add New Slot Form -->
            <div class="glass-card rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">Add New Slot</h2>
                
                @if(session('error'))
                    <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-500/20 border border-green-500 text-green-300 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('slots.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">From City</label>
                            <select name="from_city" class="form-input w-full rounded-lg px-3 py-2 text-white @error('from_city') border-red-500 @enderror" required>
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->airport_code }}" {{ old('from_city') == $city->airport_code ? 'selected' : '' }}>
                                        {{ $city->name }} ({{ $city->airport_code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('from_city')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">To City</label>
                            <select name="to_city" class="form-input w-full rounded-lg px-3 py-2 text-white @error('to_city') border-red-500 @enderror" required>
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->airport_code }}" {{ old('to_city') == $city->airport_code ? 'selected' : '' }}>
                                        {{ $city->name }} ({{ $city->airport_code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('to_city')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Airline</label>
                            <select name="airline" class="form-input w-full rounded-lg px-3 py-2 text-white @error('airline') border-red-500 @enderror" required>
                                <option value="">Select Airline</option>
                                @foreach($airlines as $airline)
                                    <option value="{{ $airline->code }}" {{ old('airline') == $airline->code ? 'selected' : '' }}>
                                        {{ $airline->name }} ({{ $airline->code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('airline')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Slot Time</label>
                            <input type="text" name="slot_time" value="{{ old('slot_time') }}" class="form-input w-full rounded-lg px-3 py-2 text-white @error('slot_time') border-red-500 @enderror" required>
                            @error('slot_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Block Time</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="auto_duration" value="1" class="form-radio" {{ old('auto_duration', '1') == '1' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-300">Auto-calculate</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="auto_duration" value="0" class="form-radio" {{ old('auto_duration') == '0' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-300">Manual</span>
                                </label>
                            </div>
                        </div>
                        <div id="manual_duration" class="{{ old('auto_duration') == '0' ? '' : 'hidden' }}">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Manual Duration</label>
                            <input type="text" name="block_time" value="{{ old('block_time') }}" class="form-input w-full rounded-lg px-3 py-2 text-white @error('block_time') border-red-500 @enderror" placeholder="HH:mm">
                            @error('block_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                            Add Slot
                        </button>
                    </div>
                </form>
            </div>

            <!-- Existing Slots Table -->
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Existing Slot Allocations</h2>
                </div>
                <div class="table-container overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-800/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Airline</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">From</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">To</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Slot Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Block Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($slots as $slot)
                            <tr class="hover:bg-gray-800/30" data-slot-id="{{ $slot['id'] }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $slot['airline'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $slot['from_city'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $slot['to_city'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $slot['slot_time'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $slot['block_time'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    <button onclick="editSlot({{ $slot['id'] }})" class="text-blue-400 hover:text-blue-300 mr-3">Edit</button>
                                    <form action="{{ route('slots.destroy', $slot['id']) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- Edit Modal -->
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
            <div class="glass-card rounded-lg p-6 max-w-md w-full mx-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">Edit Slot</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="editForm" action="" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Slot Time</label>
                        <input type="text" name="slot_time" id="edit_slot_time" class="form-input w-full rounded-lg px-3 py-2 text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Block Time</label>
                        <input type="text" name="block_time" id="edit_block_time" class="form-input w-full rounded-lg px-3 py-2 text-white" required>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-300 hover:text-white">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <footer class="mt-12 py-6 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-400 text-sm">
                    © {{ date('Y') }} City Pair Slot Allocation System. All rights reserved.
                </p>
            </div>
        </footer>

        <script>
            // Initialize time pickers
            flatpickr("input[name='slot_time']", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                minuteIncrement: 5
            });

            flatpickr("input[name='block_time']", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                minuteIncrement: 5
            });

            // Initialize edit modal time pickers
            flatpickr("#edit_slot_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                minuteIncrement: 5
            });

            flatpickr("#edit_block_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                minuteIncrement: 5
            });

            // Toggle manual duration input
            document.querySelectorAll('input[name="auto_duration"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const manualDuration = document.getElementById('manual_duration');
                    manualDuration.classList.toggle('hidden', this.value === '1');
                    if (this.value === '0') {
                        document.querySelector('input[name="block_time"]').required = true;
                    } else {
                        document.querySelector('input[name="block_time"]').required = false;
                    }
                });
            });

            // Edit slot function
            function editSlot(id) {
                const modal = document.getElementById('editModal');
                const form = document.getElementById('editForm');
                const slotTimeInput = document.getElementById('edit_slot_time');
                const blockTimeInput = document.getElementById('edit_block_time');

                // Get the slot data from the table row
                const row = document.querySelector(`tr[data-slot-id="${id}"]`);
                const slotTime = row.querySelector('td:nth-child(4)').textContent;
                const blockTime = row.querySelector('td:nth-child(5)').textContent;

                // Set the form action URL
                form.action = `/slots/${id}`;

                // Set the input values
                slotTimeInput.value = slotTime;
                blockTimeInput.value = blockTime;

                // Show the modal
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeEditModal() {
                const modal = document.getElementById('editModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            // Close modal when clicking outside
            document.getElementById('editModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeEditModal();
                }
            });
        </script>
    </body>
</html> 