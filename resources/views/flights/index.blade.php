@extends('base')
@section('content')
  <h1 class="font-bold text-center text-white pt-4 mb-6">Airplane Booking System</h1>

    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-center justify-between bg-green-600 text-white px-4 py-3 rounded shadow">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-white hover:text-gray-200 text-lg leading-none">&times;</button>
    </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-center justify-between bg-red-600 text-white px-4 py-3 rounded shadow">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
            <button @click="show = false" class="text-white hover:text-gray-200 text-lg leading-none">&times;</button>
        </div>
    @endif
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ">
    @if($flights->isEmpty())
    <p class="text-white text-center col-span-full">No flights available at the moment.</p>
    @else
        @foreach ($flights as $flight)
                <div class="bg-transparent p-5 rounded-lg border-2 border-white">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg text-white font-bold">{{ $flight->flight_code }}</h3>
                        <span class="text-sm text-white italic font-semibold">{{ $flight->origin }} → {{ $flight->destination }}</span>
                    </div>

                    <div class="mt-4 text-sm">
                        <p class="text-orange-500">Departure</p>
                        <p class="font-semibold italic text-white">
                            {{ \Carbon\Carbon::parse($flight->departure_time)->translatedFormat('l, d F Y, H:i') }}
                        </p>

                        <p class="mt-2 text-orange-500">Arrived</p>
                        <p class="font-semibold italic text-white">
                            {{ \Carbon\Carbon::parse($flight->arrival_time)->translatedFormat('l, d F Y, H:i') }}
                        </p>
                    </div>

                    <div class="mt-5 flex justify-between">
                        <a href="{{ url('/flights/book/'.$flight->id) }}"
                            class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 text-sm">
                            Book Ticket
                        </a>
                        <a href="{{ url('/flights/ticket/'.$flight->id) }}"
                            class="bg-white text-black px-4 py-2 rounded hover:bg-gray-400 text-sm">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
  </div>
@endsection