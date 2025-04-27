<x-app-layout>
  @include('sweetalert::alert')
    <div py-12>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-2xl font-bold mt-4">Available Programs</h2>

                    <button
                        type="button"
                        onclick="toggleModal(true)"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
                        Create program
                    </button>

                    <button
                        type="button"
                        onclick="toggleEnrollModal(true)"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
                        enroll program
                    </button>

                    <div class="container mt-6">
                        <h2 class="text-2xl font-bold mb-4">Programs</h2>
                        @if($programs->isEmpty())
                            <p>No programs found.</p>
                        @else
                            <table class="table-auto w-full border">
                                <thead>
                                    <tr>
                                        <th class="border px-4 py-2">#</th>
                                        <th class="border px-4 py-2">Name</th>
                                        <th class="border px-4 py-2">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($programs as $program)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                            <td class="border px-4 py-2">{{ $program->name }}</td>
                                            <td class="border px-4 py-2">{{ $program->description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>

                </div>
            </div>
        Welcome to Dashboard



                 <div id="clientModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                                <h2 class="text-xl font-bold mb-4">Register New Programs</h2>
                                <form method="POST" action="{{ route('programs.create') }}">
                                    {{-- CSRF Token --}}
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" name="name" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Description</label>
                                        <input type="text" name="description" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>


                                    <div class="flex justify-end">
                                        <button type="button" onclick="toggleModal(false)" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Modal (hidden by default) -->
                        <div id="enrollModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                                <h2 class="text-xl font-bold mb-4">Enroll Client in Program</h2>

                                <form method="POST" action="{{ route('enrollments.create') }}">
                                    @csrf

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Select Client</label>
                                        <select name="client_id" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Select Program</label>
                                        <select name="program_id" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                            @foreach($programs as $program)
                                                <option value="{{ $program->id }}">{{ $program->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="button" onclick="toggleEnrollModal(false)" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Enroll</button>
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
                                   function toggleEnrollModal(show) {
                                        const modal = document.getElementById('enrollModal');
                                        if (show) {
                                            modal.classList.remove('hidden');
                                        } else {
                                            modal.classList.add('hidden');
                                        }
                                    }
                            </script>
    </div>
</x-app-layout>
