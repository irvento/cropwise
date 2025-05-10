<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Delete Supplier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Are you sure you want to delete this supplier?</p>
                    <dl class="mt-4">
                        <dt class="font-medium">Name:</dt>
                        <dd>{{ $supplier->name }}</dd>
                        <dt class="font-medium">Contact Person:</dt>
                        <dd>{{ $supplier->contact_person }}</dd>
                        <dt class="font-medium">Email:</dt>
                        <dd>{{ $supplier->email }}</dd>
                    </dl>
                    <form action="{{ route('admin.supplier.destroy', $supplier) }}" method="POST" class="mt-6">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Yes, Delete
                        </button>
                        <a href="{{ route('admin.supplier.index') }}" class="ml-4 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 