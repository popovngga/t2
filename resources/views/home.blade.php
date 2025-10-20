@extends('layout')

@section('content')
    <div class="w-full max-w-md bg-white rounded-xl shadow-md p-6 space-y-6">
        <h1 class="text-2xl font-semibold text-center">Add actor</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('actors.store') }}" method="POST" class="space-y-4" id="add-actor-form">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
                <input
                    type="text"
                    name="email"
                    id="email"
                    required
                    value="{{ old('email') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="description">Actor description</label>
                <textarea
                    type="text"
                    name="description"
                    id="description"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500"
                >{{ trim(old('description')) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">
                    Please enter your first name and last name, and also provide your address.
                </p>
            </div>

            <button
                id="add-actor-button"
                type="submit"
                class="w-full bg-gray-600 text-white py-3 rounded-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition duration-300 ease-in-out font-semibold"
                onclick="handleSubmitButtonOnClick(this)"
            >
                Add actor
            </button>
        </form>
    </div>
@stop
