<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Employee
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8">
            <form action="{{ route('hr.update', $employee->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm focus:border-amber-400 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm focus:border-amber-400 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Position</label>
                    <input type="text" name="position" value="{{ old('position', $employee->position) }}" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm focus:border-amber-400 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contact Number</label>
                    <input type="text" name="contact_number" value="{{ old('contact_number', $employee->contact_number) }}" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm focus:border-amber-400 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label>
                    <input type="text" name="address" value="{{ old('address', $employee->address) }}" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm focus:border-amber-400 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select name="status" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm focus:border-amber-400 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                        <option value="active" {{ $employee->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $employee->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-amber-400 hover:bg-amber-500 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-amber-300">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> 