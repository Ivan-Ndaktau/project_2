@extends('base')
@section('content')
<h2 class="text-xl font-bold text-center mb-6 text-white">Airplane Booking System</h2>
<div class="min-h-[calc(100vh-80px)] flex flex-col items-center justify-center bg-transparent text-white p-6">
    <div class="max-w-3xl w-full bg-transparent p-6 rounded-md border border-white border-2 shadow-md">
        <div class="mb-4">
            <div class="flex justify-between items-center border-b border-gray-300 pb-2">
                <div>
                    <p class="text-lg font-semibold text-white">Ticket Booking for</p>
                    <p class="text-sm mt-1 italic font-semibold">{{ $flights->origin }} → {{ $flights->destination }}</p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold">{{ $flights->flight_code }}</p>
                </div>
            </div>

            <div class="flex justify-between text-sm text-white mt-2">
                <div>
                    <p class="font-semibold">Departure</p>
                    <p><em> {{ \Carbon\Carbon::parse($flights->departure_time)->translatedFormat('l, d F Y, H:i') }}</em></p>
                </div>
                <div class="text-right">
                    <p class="font-semibold">Arrived</p>
                    <p><em> {{ \Carbon\Carbon::parse($flights->arrival_time)->translatedFormat('l, d F Y, H:i') }}</em></p>
                </div>
            </div>
        </div>

        <form action="{{ url('/ticket/submit') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="flight_id" value="{{ $flights->id }}">

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Passenger Name</label>
                <input type="text" name="passenger_name" value="{{ old('passenger_name') }}"
                       class="w-full p-2 border border-transparent rounded-md border-white border-2" required>
                @error('passenger_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Passenger Phone</label>
                <input type="text" name="passenger_phone" value="{{ old('passenger_phone') }}"
                       class="w-full p-2 border border-transparent rounded-md border-white border-2" required>
                @error('passenger_phone')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Seat Number</label>
                <input type="text" name="seat_number" value="{{ old('seat_number', $availableSeat) }}"
                       class="w-full p-2 border border-transparent rounded-md border-white border-2" required>
                @error('seat_number')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="flex justify-center gap-4">
                <a href="{{ url('/flights') }}" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-sm">
                    Cancel
                </a>
                <form action="{{ url('/ticket/submit') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                            Book Ticket
                    </button>
                </form>
            </div>
        </form>
    </div>
</div>
@endsection