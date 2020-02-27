<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Meeting;
use App\Http\Requests\MeetingConcludeUpdateRequest;
use App\File;

class MeetingConcludeController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        return view('meeting-conclude.edit', compact('meeting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MeetingConcludeUpdateRequest $request, Meeting $meeting)
    {
        return DB::transaction(function () use ($request, $meeting) {
            $meeting->fill($request->all());

            $files = [];

            if ($request->hasFile('meeting_summary')) {
                $summary = $meeting->meetingSummary();
                if ($summary) {
                    Storage::delete($summary->path);
                    $summary->delete();
                }

                $path = $request->meeting_summary->store('files');
                $file = new File([
                    'name' => 'meeting_summary_' . $request->meeting_summary->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('meeting_financial_report')) {
                $financialReport = $meeting->meetingFinancialReport();
                if ($financialReport) {
                    Storage::delete($financialReport->path);
                    $financialReport->delete();
                }

                $path = $request->meeting_financial_report->store('files');
                $file = new File([
                    'name' => 'meeting_financial_report_' . $request->meeting_financial_report->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            $meeting->attachments()->saveMany($files);

            $meeting->save();

            return redirect()->route('meeting.show', $meeting);
        });
    }
}
