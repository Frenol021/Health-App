<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Client Profile</h1>

            <div class="mb-4">
                <h2 class="text-xl font-semibold">Client Details</h2>
                <p><strong>Name:</strong> {{ $client->name }}</p>
                <p><strong>Email:</strong> {{ $client->email }}</p>
                <p><strong>Phone:</strong> {{ $client->phone }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold">Programs Enrolled</h2>
                @if($client->programs->isEmpty())
                    <p>No programs enrolled.</p>
                @else
                    <ul>
                        @foreach($client->programs as $program)
                            <li>{{ $program->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="flex justify-end">
                <a href="{{ route('clients.profile', ['id' => $client->id]) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit Client</a>
            </div>

        </div>
    </div>
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('clientModal');
            modal.classList.toggle('hidden', !show);
        }
        function toggleEnrollModal(show) {
            const modal = document.getElementById('enrollModal');
            modal.classList.toggle('hidden', !show);
        }
    </script>
</x-app-layout>
