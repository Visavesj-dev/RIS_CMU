<?php

namespace App\Http\Controllers;

use App\OutboundStudent;
use App\StudentType;
use App\Department;
use App\Lecturer;
use App\Http\Requests\OutboundStudentStoreRequest;
use Illuminate\Support\Facades\DB;
use App\File;
use App\OutboundStudentChecklist;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\OutboundStudentIndexRequest;
use App\StudentFundType;

class OutboundStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param \App\Http\Requests\OutboundStudentIndexRequest   $request
     * @return \Illuminate\Http\Response
     */
    public function index(OutboundStudentIndexRequest $request)
    {
        $studentTypes = StudentType::all();
        $departments = Department::primitive()->get();

        $outboundStudents = OutboundStudent::orderBy('id');

        if ($request->filled('type')) {
            $outboundStudents = $outboundStudents->where('student_type_id', '=', $request->type);
        }

        if ($request->filled('department')) {
            $outboundStudents = $outboundStudents->whereHas('departments', function ($query) use ($request) {
                $query->where('departments.id', $request->department);
            });
        }

        if ($request->filled('status')) {
            if ($request->status == 'not-travelled') {
                $outboundStudents = $outboundStudents->notTravelle();
            }
            if ($request->status == 'not-returned') {
                $outboundStudents = $outboundStudents->notReturned();
            }
        }

        if ($request->filled('search')) {
            $outboundStudents = $outboundStudents->where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('telephone', 'like', '%' . $request->search . '%')
                    ->orWhere('cooperation_name', 'like', '%' . $request->search . '%')
                    ->orWhere('project', 'like', '%' . $request->search . '%')
                    ->orWhere('accommodation', 'like', '%' . $request->search . '%')
                    ->orWhere('subject', 'like', '%' . $request->search . '%')
                    ->orWhereHas('country', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('advisor', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $outboundStudents = $outboundStudents->get();

        return view('outbound-student.index', compact(
            'studentTypes', 
            'departments', 
            'outboundStudents'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studentTypes = StudentType::all();
        $departments = Department::primitive()->get();
        $lecturers = Lecturer::all();
        $universities = OutboundStudent::select('university')->distinct()->get();

        return view('outbound-student.create', compact(
            'studentTypes', 
            'departments', 
            'lecturers', 
            'universities'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OutboundStudentStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutboundStudentStoreRequest $request)
    {
        return DB::transaction(function() use ($request) {
            $outboundStudent = OutboundStudent::create($request->all());
            
            $files = [];

            if ($request->hasFile('attachment_photo')) {
                $path = $request->attachment_photo->store('files');
                $file = new File([
                    'name' => 'photo_' . $request->attachment_photo->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_passport')) {
                $path = $request->attachment_passport->store('files');
                $file = new File([
                    'name' => 'passport_' . $request->attachment_passport->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_activity_report')) {
                $path = $request->attachment_activity_report->store('files');
                $file = new File([
                    'name' => 'activity_report_' . $request->attachment_activity_report->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_travelling_report')) {
                $path = $request->attachment_travelling_report->store('files');
                $file = new File([
                    'name' => 'travelling_report_' . $request->attachment_travelling_report->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_other')) {
                $path = $request->attachment_other->store('files');
                $file = new File([
                    'name' => 'other_' . $request->attachment_other->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            $outboundStudent->attachments()->saveMany($files);

            $outboundStudent->save();

            return redirect()->route('outbound-student.show', $outboundStudent);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OutboundStudent  $outboundStudent
     * @return \Illuminate\Http\Response
     */
    public function show(OutboundStudent $outboundStudent)
    {
        $checklist = OutboundStudentChecklist::all();
        $studentFundTypes = StudentFundType::all();

        return view('outbound-student.show', compact(
            'outboundStudent',
            'checklist',
            'studentFundTypes'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OutboundStudent  $outboundStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(OutboundStudent $outboundStudent)
    {
        $studentTypes = StudentType::all();
        $departments = Department::primitive()->get();
        $lecturers = Lecturer::all();
        $universities = OutboundStudent::select('university')->distinct()->get();

        return view('outbound-student.edit', compact(
            'studentTypes', 
            'departments', 
            'lecturers', 
            'universities',
            'outboundStudent'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\OutboundStudentStoreRequest  $request
     * @param  \App\OutboundStudent  $outboundStudent
     * @return \Illuminate\Http\Response
     */
    public function update(OutboundStudentStoreRequest $request, OutboundStudent $outboundStudent)
    {
        return DB::transaction(function() use ($request, $outboundStudent) {
            $outboundStudent = $outboundStudent->fill($request->all());
            
            $files = [];
            
            if ($request->hasFile('attachment_photo')) {
                $photo = $outboundStudent->photo();
                if ($photo) {
                    Storage::delete($photo->path);
                    $photo->delete();
                }
                $path = $request->attachment_photo->store('files');
                $file = new File([
                    'name' => 'photo_' . $request->attachment_photo->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }
                
            if ($request->hasFile('attachment_passport')) {
                $passport = $outboundStudent->passport();
                if ($passport) {
                    Storage::delete($passport->path);
                    $passport->delete();
                }

                $path = $request->attachment_passport->store('files');
                $file = new File([
                    'name' => 'passport_' . $request->attachment_passport->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_activity_report')) {
                $passport = $outboundStudent->activityReport();
                if ($passport) {
                    Storage::delete($passport->path);
                    $passport->delete();
                }

                $path = $request->attachment_activity_report->store('files');
                $file = new File([
                    'name' => 'activity_report_' . $request->attachment_activity_report->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_travelling_report')) {
                $passport = $outboundStudent->travellingReport();
                if ($passport) {
                    Storage::delete($passport->path);
                    $passport->delete();
                }

                $path = $request->attachment_travelling_report->store('files');
                $file = new File([
                    'name' => 'travelling_report_' . $request->attachment_travelling_report->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_other')) {
                $attachment = $outboundStudent->attachment();
                if ($passport) {
                    Storage::delete($attachment->path);
                    $attachment->delete();
                }

                $path = $request->attachment_other->store('files');
                $file = new File([
                    'name' => 'other_' . $request->attachment_other->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            $outboundStudent->attachments()->saveMany($files);

            $outboundStudent->save();

            return redirect()->route('outbound-student.show', $outboundStudent);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OutboundStudent  $outboundStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutboundStudent $outboundStudent)
    {
        foreach ($outboundStudent->attachments as $attachment) {
            $attachment->delete();
        }

        $outboundStudent->checklist()->sync([]);
        $outboundStudent->funds()->delete();
        $outboundStudent->delete();

        return back();
    }
}
