<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Livestock Details') }}
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Basic Information</h3>
                            <dl class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $livestock->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Animal Variety</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $livestock->animalvariety }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Growth Duration</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $livestock->growthduration }} months</dd>
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
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($livestock->health_status === 'healthy') bg-green-100 text-green-800
                                            @elseif($livestock->health_status === 'sick') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            {{ str_replace('_', ' ', ucfirst($livestock->health_status)) }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Additional Information</h3>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Conditions/Notes</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $livestock->conditions ?: 'No additional notes.' }}
                                </dd>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('admin.farm.livestock.edit', $livestock) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit Livestock
                        </a>
                        <form action="{{ route('admin.farm.livestock.destroy', $livestock) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this livestock record?')">
                                Delete Livestock
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 