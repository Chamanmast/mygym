<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateScheduleRequest;
use App\Models\ClassType;
use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

use Carbon\Carbon;

class ScheduledClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scheduledClasses  = ScheduledClass::paginate(5);
        return view('instructor.index', compact('scheduledClasses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classTypes  = ClassType::pluck('name', 'id');
        $times = $this->times();
        return view('instructor.create', compact('classTypes', 'times'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateScheduleRequest $request)
    {

        $validated = $request->validated();

        $dateTime = Carbon::createFromFormat(
            'Y-m-d H:i',
            $validated->date . ' ' . $validated->time
        );

        if ($dateTime->isPast()) {
            return back()
                ->withErrors([
                    'date' => 'The scheduled class must be in the future.',
                ])
                ->withInput();
        }

        $cl = new ScheduledClass();

        $cl->class_type_id = $request->class_type_id;
        $cl->date_time = $dateTime;
        $cl->instructor_id = Auth::id();
        $cl->save();

        return redirect()
            ->back()
            ->with('success', 'Schedule Class Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(ScheduledClass $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScheduledClass $schedule)
    {
        $classTypes  = ClassType::pluck('name', 'id');
        $times = $this->times();
        return view('instructor.edit', compact('classTypes', 'schedule', 'times'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidateScheduleRequest $request, ScheduledClass $schedule)
    {

        $validated = $request->validated();


        $dateTime = Carbon::createFromFormat(
            'Y-m-d H:i',
            $validated->date . ' ' . $validated->time
        );

        if ($dateTime->isPast()) {
            return back()
                ->withErrors([
                    'date' => 'The scheduled class must be in the future.',
                ])
                ->withInput();
        }


        $schedule->class_type_id = $request->class_type_id;
        $schedule->date_time = $dateTime;
        $schedule->instructor_id = Auth::id();
        $schedule->update();

        return redirect()
            ->back()
            ->with('success', 'Schedule Class Created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduledClass $schedule)
    {
       abort_if(Gate::denies('delete', $schedule), 403);
       // abort_unless(Gate::allows('delete', $schedule), 403);
        $schedule->delete();
        return redirect()
            ->back()
            ->with('success', 'Schedule Class Deleted');
    }

    public function times()
    {
        $times = [];

        $start = \Carbon\Carbon::createFromTime(6, 0);
        $end = \Carbon\Carbon::createFromTime(22, 0);

        while ($start <= $end) {
            $times[$start->format('H:i')] = $start->format('h:i A');
            $start->addMinutes(30);
        }

        return $times;
    }
}
