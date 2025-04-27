<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-2xl font-bold mt-4">Welcome Healty mgmt System</h2>

                            <button
                                type="button"
                                onclick="toggleModal(true)"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
                                Create Client
                            </button>

                                        <button
                                type="button"
                                onclick="window.location.href='{{ route('programs') }}'"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4
                                 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600
                                  dark:hover:bg-blue-700 href="{{ route('programs') }}"
                            >
                                Programs
                            </button>

                    <div class="container mt-6">
                        <h2 class="text-2xl font-bold mb-4">Clients</h2>

                        @if($clients->isEmpty())
                            <p>No clients found.</p>
                        @else
                            <table class="table-auto w-full border">
                                <thead>...</thead>
                                <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->phone }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>
                  <div id="clientModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                                <h2 class="text-xl font-bold mb-4">Register New Client</h2>
                                <form method="POST" action="{{ route('clients.create') }}">
                                    {{-- CSRF Token --}}
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                        <input type="text" name="name" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                                        <input type="text" name="phone" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="button" onclick="toggleModal(false)" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                            <script>
                                function toggleModal(show) {
                                    const modal = document.getElementById('clientModal');
                                    if (show) {
                                        modal.classList.remove('hidden');
                                    } else {
                                        modal.classList.add('hidden');
                                    }
                                }
                            </script>
            </div>
        </div>
    </div>
</x-app-layout>
