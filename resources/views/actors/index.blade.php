@extends('layout')

@section('content')
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6 space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Actors list</h1>
            <a
                href="{{ route('home') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md shadow-sm hover:bg-gray-200 transition"
            >
                ← Back to Home
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">#</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Email</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Name</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Address</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Height</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Weight</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Gender</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Age</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($actors as $actor)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 text-gray-600">{{ $actor->id }}</td>
                            <td class="px-4 py-2">{{ $actor->email }}</td>
                            <td class="px-4 py-2">{{ $actor->first_name }} {{ $actor->last_name }}</td>
                            <td class="px-4 py-2">{{ $actor->address }}</td>
                            <td class="px-4 py-2">{{ $actor->height ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $actor->weight ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $actor->gender ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $actor->age ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-6 text-center text-gray-500">
                                No actors found.
                            </td>
                        </tr>
                   @endforelse
                </tbody>
            </table>
        </div>

        @if ($actors->hasPages())
            <div class="mt-6">
                {{ $actors->links() }}
            </div>
        @endif
    </div>
@endsection
