<?php

namespace App\Http\Controllers;

use App\InboundStudent;
use Illuminate\Http\Request;
use App\StudentType;
use App\Department;
use App\Lecturer;
use App\Country;
use App\Http\Requests\InboundStudentStoreRequest;
use Illuminate\Support\Facades\DB;
use App\File;
use App\VisaExpirationDate;
use App\ReportAccommodationDate;
use App\InboundStudentChecklist;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\InboundStudentIndexRequest;

class InboundStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param \App\Http\Requests\InboundStudentIndexRequest   $request
     * @return \Illuminate\Http\Response
     */
    public function index(InboundStudentIndexRequest $request)
    {
        $studentTypes = StudentType::all();
        $departments = Department::primitive()->get();

        $inboundStudents = InboundStudent::orderBy('id');

        if ($request->filled('type')) {
            $inboundStudents = $inboundStudents->where('student_type_id', '=', $request->type);
        }

        if ($request->filled('department')) {
            $inboundStudents = $inboundStudents->whereHas('departments', function ($query) use ($request) {
                $query->where('departments.id', $request->department);
            });
        }

        if ($request->filled('status')) {
            if ($request->status == 'not-arrived') {
                $inboundStudents = $inboundStudents->notArrived();
            }
            if ($request->status == 'not-departed') {
                $inboundStudents = $inboundStudents->notDeparted();
            }
        }

        if ($request->filled('search')) {
            $inboundStudents = $inboundStudents->where(function ($query) use ($request) {
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

        $inboundStudents = $inboundStudents->get();

        return view('inbound-student.index', compact(
            'studentTypes', 
            'departments', 
            'inboundStudents'
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
        $countries = Country::all();
        $universities = InboundStudent::select('university')->distinct()->get();

        return view('inbound-student.create', compact(
            'studentTypes', 
            'departments', 
            'lecturers', 
            'countries', 
            'universities'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InboundStudentStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InboundStudentStoreRequest $request)
    {
        return DB::transaction(function() use ($request) {
            $inboundStudent = InboundStudent::create($request->all());
            
            $country = Country::firstOrCreate(['name' => $request->country])->id;

            $inboundStudent->country()->associate($country);

            if ($request->filled('visa_expired_at')) {
                $inboundStudent->visaExpirationDates()->create([
                    'expired_at' => $request->visa_expired_at,
                ]);
            }

            if ($request->filled('report_accommodation_at')) {
                $inboundStudent->reportAccommodationDates()->create([
                    'reported_at' => $request->report_accommodation_at,
                ]);
            }
            
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

            if ($request->hasFile('attachment_other')) {
                $path = $request->attachment_other->store('files');
                $file = new File([
                    'name' => 'other_' . $request->attachment_other->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            $inboundStudent->attachments()->saveMany($files);

            $inboundStudent->save();

            return redirect()->route('inbound-student.show', $inboundStudent);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InboundStudent  $inboundStudent
     * @return \Illuminate\Http\Response
     */
    public function show(InboundStudent $inboundStudent)
    {
        $checklist = InboundStudentChecklist::all();

        return view('inbound-student.show', compact(
            'inboundStudent',
            'checklist'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InboundStudent  $inboundStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(InboundStudent $inboundStudent)
    {
        $studentTypes = StudentType::all();
        $departments = Department::primitive()->get();
        $lecturers = Lecturer::all();
        $countries = Country::all();
        $universities = InboundStudent::select('university')->distinct()->get();

        return view('inbound-student.edit', compact(
            'studentTypes', 
            'departments', 
            'lecturers', 
            'countries', 
            'universities',
            'inboundStudent'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InboundStudentStoreRequest  $request
     * @param  \App\InboundStudent  $inboundStudent
     * @return \Illuminate\Http\Response
     */
    public function update(InboundStudentStoreRequest $request, InboundStudent $inboundStudent)
    {
        return DB::transaction(function() use ($request, $inboundStudent) {
            $inboundStudent = $inboundStudent->fill($request->all());
            
            $country = Country::firstOrCreate(['name' => $request->country])->id;

            $inboundStudent->country()->associate($country);
            
            $files = [];

            if ($request->hasFile('attachment_photo')) {
                $photo = $inboundStudent->photo();
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
                $passport = $inboundStudent->passport();
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

            if ($request->hasFile('attachment_other')) {
                $attachment = $inboundStudent->attachment();
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

            $inboundStudent->attachments()->saveMany($files);

            $inboundStudent->save();

            return redirect()->route('inbound-student.show', $inboundStudent);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InboundStudent  $inboundStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(InboundStudent $inboundStudent)
    {
        foreach ($inboundStudent->attachments as $attachment) {
            Storage::delete($attachment->path);
            $attachment->delete();
        }

        $inboundStudent->checklist()->sync([]);

        $inboundStudent->delete();

        return back();
    }
}
