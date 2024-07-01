<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use App\Http\Responses\ApiResponse;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Student $student;
    private Course $course;
    public function __construct(Student $student, Course $course)
    {
        $this->student = $student;
        $this->course = $course;
    }
    public function addCourse(Request $request){
        $student1 = $this->student->find($request->student_id);
        // $student1->courses()->attach($request->courses); // add course to student1
        // $student1->courses()->detach($request->courses); // delete course to student1
        // $student1->courses()->sync($request->courses); // delete course of student1 and add new course to student1
        // $student1->courses()->syncWithoutDetaching($request->courses); // add course but not delete
        // $student1->courses()->toggle($request->courses); // add if not exist else delete
        // $student1->courses()->attach($request->courses,['createBy'=> "1"]); // add course to student1 and createBy (can use auth()->user()->id)
        // $student1->courses()->updateExistingPivot($request->courses, ['createBy' => "1"]);// update createBy in DB. only update data in request, if no exist => skip
    }

    public function searchName(Request $request)
    {
        //
        $students = $this->student->searchName($request->name);
        if(!$students){
            return ApiResponse::error("Student not found!!!",404);
        }
        return ApiResponse::success(new StudentCollection($students),"Get student by name successful");
    }
    public function index()
    {
        //
        $students = $this->student::paginate(10); // Paginate with each page having 10 items and call = url?page=1
        if(count($students) == 0){
            return ApiResponse::error("Student not found!!!",404);
        }
        return ApiResponse::success(new StudentCollection($students),"Get all student successful");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $student = $this->student->find($request->student);
        if(!$student){
            return ApiResponse::error("Student not found!!!",404);
        }
        return ApiResponse::success(new StudentResource($student),"Get student successful");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
