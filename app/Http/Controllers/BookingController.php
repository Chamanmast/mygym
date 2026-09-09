<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ScheduledClass;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    private $paginate;
    public function __construct()
    {
        $this->paginate =10;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scheduled = ScheduledClass::Upcoming()
            ->with('instructor:id,name', 'classType:id,name,description', 'booking:id,scheduled_class_id')
            ->whereHas('members', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->paginate($this->paginate);

        return view('member.index', compact('scheduled'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $scheduled = ScheduledClass::Upcoming()
            ->with('instructor:id,name', 'classType:id,name,description',)
            ->notBooked()
            ->paginate($this->paginate);

        return view('member.book', compact('scheduled'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->bookings()->attach($request->scheduled_class_id);
        return redirect()->back()->with('success', 'Booking Confirm');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
         /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->bookings()->detach($booking->scheduled_class_id);
        return redirect()->back()->with('success', 'Booking cancle Successfully');
    }
}
