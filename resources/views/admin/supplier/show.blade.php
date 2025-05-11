<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Supplier Details') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('admin.supplier.edit', $supplier) }}" 
                   class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit Supplier
                </a>
                <a href="{{ route('admin.supplier.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Suppliers
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $supplier->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Contact Person</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $supplier->contact_person }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $supplier->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $supplier->phone }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $supplier->address }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tax ID</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $supplier->tax_id ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Terms</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $supplier->payment_terms ?? '-' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Notes</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $supplier->notes ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 