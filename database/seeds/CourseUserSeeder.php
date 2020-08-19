<?php
use App\Course;
use App\User;
use Illuminate\Database\Seeder;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(User::where('type', 'Student')->get() as $user) {
            $numberOfCourses = 5;

            foreach(Course::all() as $key=>$course) {
                if ($key <= $numberOfCourses) {
                    $course->users()->attach($user->id);
                }
            }

            $course->save();
        }
    }
}
