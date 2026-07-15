<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $courses = Course::withCount('lessons')->get();
        return view('student.dashboard', compact('courses'));
    }

    public function showCourse(Course $course, Request $request): View
    {
        $course->load('lessons');

        $activeLessonId = $request->query('lesson');
        $activeLesson = $activeLessonId 
            ? $course->lessons->where('id', $activeLessonId)->first() 
            : $course->lessons->first();

        if (!$activeLesson && $course->lessons->isNotEmpty()) {
            $activeLesson = $course->lessons->first();
        }

        return view('student.course_view', compact('course', 'activeLesson'));
    }
}
