<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Delete Livestock') }}
            </h2>
            <a href="{{ route('admin.farm.livestock.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Are you sure you want to delete this livestock record?</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">This action cannot be undone.</p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $livestock->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Animal Variety</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $livestock->animalvariety }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Age</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $livestock->age }} months</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Weight</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $livestock->weight }} kg</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Health Status</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ ucfirst($livestock->health_status) }}</dd>
                            </div>
                        </dl>
                    </div>

                    <form action="{{ route('admin.farm.livestock.destroy', $livestock) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('admin.farm.livestock.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete Livestock
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
