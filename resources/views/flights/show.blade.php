@extends('base')
@section('content')
<div class="bg-black text-white p-4 sm:p-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-center mb-6">Airplane Booking System</h1>
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
    <div class="min-h-[calc(100vh-80px)] bg-transparent border border-white border-2 p-6 rounded-lg flex flex-col">
        <div class="flex-grow">
            <div class="flex flex-wrap justify-between items-center mb-4 gap-2">
                <h2 class="text-lg sm:text-xl text-white font-semibold ">Ticket Details for {{ $flights->flight_code }}</h2>
                <span class="text-xs sm:text-sm text-gray-300">
                    {{ $passengers->count() }} passengers • {{ $boardedCount }} boardings
                </span>
            </div>

            <p class="text-sm text-white italic font-semibold mb-2">{{ $flights->origin }} → {{ $flights->destination }}</p>
            <p class="text-sm mb-2">Departure: 
                <span class="italic text-white">
                    {{ \Carbon\Carbon::parse($flights->departure_time)->translatedFormat('l, d F Y, H:i') }}
                </span>
            </p>
            <p class="text-sm mb-6">Arrived: 
                <span class="italic text-white">
                    {{ \Carbon\Carbon::parse($flights->arrival_time)->translatedFormat('l, d F Y, H:i') }}
                </span>
            </p>

            <h3 class="text-base sm:text-lg font-semibold mb-3">Passengers list</h3>

            <div class="overflow-x-auto">
                <table class="min-w-[900px] w-full text-xs sm:text-sm text-left">
                    <thead class="text-white">
                        <tr>
                            <th class="px-4 py-3">No.</th>
                            <th class="px-4 py-3">Passenger Name</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Seat</th>
                            <th class="px-4 py-3 text-center">Boarding</th>
                            <th class="px-4 py-3 text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($passengers as $index => $p)
                        <tr>
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $p->passenger_name }}</td>
                            <td class="px-4 py-3">{{ $p->passenger_phone }}</td>
                            <td class="px-4 py-3">{{ $p->seat_number }}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($p->boarding_time == null)
                                <form action="{{ url('/ticket/board/' . $p->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600 text-xs">
                                        Confirm
                                    </button>
                                </form>
                                @else
                                {{ \Carbon\Carbon::parse($p->boarding_time)->format('d-m-Y, H:i') }}
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <form action="{{ url('/ticket/delete/' . $p->id) }}" method="POST" onsubmit="return confirm('Delete this passenger?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 rounded text-xs text-white
                                        @if($p->is_boarding == 1)
                                            bg-gray-500 opacity-50 cursor-not-allowed
                                        @else
                                            bg-red-700 hover:bg-red-600
                                        @endif"
                                        @if($p->is_boarding == 1) disabled @endif>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-20 text-center">
                <a href="{{ url('/flights') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">Back</a>
            </div>
        </div>
    </div>

    <p class="mt-6 text-center text-xs text-gray-500 italic">by Web Framework and Deployment - 2024</p>
</div>
@endsection