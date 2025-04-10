<?php

namespace App\Http\Controllers;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(){
        // $flights = Flight::orderBy('id','asc')->get(); // atau 'desc' kalau mau data terbaru
        // return view('flights.index', [
        //     "flights" => $flights
        // ]);
        
        $flights = Flight::orderBy('id', 'asc')->get();
        return view('flights.index', compact('flights'));
  /* Cara ke 2
        $flight = Flight::orderBy('id','asc')->get(); //kalo mau data terbaru 'desc'
        return view('flights.index',compact('flight');
  */
    }
    public function show($id) {
        $flights = Flight::findOrFail($id);
        $passengers = Ticket::where('flight_id', $id)->get();
        $boardedCount = $passengers->whereNotNull('boarding_time')->count();
    
        return view('flights.show', [
            'flights' => $flights,
            'passengers' => $passengers,
            'boardedCount' => $boardedCount
        ]);
    }

    public function book($id)
    {
        $flights = Flight::findOrFail($id);
    
        // Ambil kursi yang sudah digunakan
        $usedSeats = $flights->tickets()->pluck('seat_number')->toArray();
    
        // Coba cari seat yang belum dipakai dengan format A01–Z30
        $availableSeat = null;
        $tries = 0;
        do {
            $tries++;
            $seat = strtoupper(fake()->randomLetter) . str_pad(fake()->numberBetween(1, 30), 2, '0', STR_PAD_LEFT);
            if (!in_array($seat, $usedSeats)) {
                $availableSeat = $seat;
                break;
            }
        } while ($tries < 50); // batasi looping agar tidak infinite
    
        return view('flights.book', compact('flights', 'availableSeat'));
    }
    
}