<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendeeUpdateRequest;
use App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Attendee $attendee
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Attendee $attendee)
    {
        return view('attendee.show', compact('attendee'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Attendee $attendee
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Attendee $attendee)
    {
        return view('attendee.edit', compact('attendee'));
    }

    /**
     * @param \App\Http\Requests\AttendeeUpdateRequest $request
     * @param \App\Models\Attendee $attendee
     * @return \Illuminate\Http\Response
     */
    public function update(AttendeeUpdateRequest $request, Attendee $attendee)
    {
        $attendee->update($request->validated());

        $request->session()->flash('attendee.id', $attendee->id);

        return redirect()->route('attendee.index');
    }
}
