<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
class TicketController extends Controller
{
    public function boardPassenger($id){
        $passenger = Ticket::findOrFail($id);
        // Cek kalau belum boarding, baru update
        if ($passenger->boarding_time === null) {
            $passenger->boarding_time = now();
            $passenger->is_boarding = 1;
            $passenger->save();
        }
        return back()->with('success', 'Passenger has boarded.');
    }

    public function deletePassenger($id)
    {
        $ticket = Ticket::findOrFail($id);

        // Hanya boleh hapus kalau belum boarding
        if ($ticket->boarding_time === null) {
            $ticket->delete();
            return back()->with('success', 'Passenger deleted successfully.');
        }

        return back()->with('error', 'Cannot delete. Passenger already boarded.');
    }
    public function submit(Request $request)
        {
            $validated = $request->validate([
                'flight_id' => 'required|exists:flights,id',
                'passenger_name' => 'required|string',
                'passenger_phone' => 'required|string',
                'seat_number' => 'required|string',
            ]);

            // Simpan data ke database
            $ticket = new Ticket();
            $ticket->flight_id = $validated['flight_id'];
            $ticket->passenger_name = $validated['passenger_name'];
            $ticket->passenger_phone = $validated['passenger_phone'];
            $ticket->seat_number = $validated['seat_number'];
            $ticket->save();

            // Redirect ke halaman sukses atau detail tiket
            return redirect('/flights')->with('success', 'Ticket successfully booked!');
        }
}