<?php

namespace Tests\Unit;

use App\Course;
use App\User;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_counts_total_students()
    {
        $course = factory(Course::class)->create();
        $users  = factory(User::class, 10)->create(['type' => 'Student']);
        foreach ($users as $user)
        {
            $course->users()->attach($user);
        }

        $totalStudents = $course->totalStudents();

        $this->assertEquals(10, $totalStudents);
    }

    public function test_counts_total_male_students()
    {
        $course = factory(Course::class)->create();
        $maleStudents  = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Hombre']);
        $femaleStudents  = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Mujer']);
        $students = User::all();
        foreach ($students as $student)
        {
            $course->users()->attach($student);
        }

        $totalMales = $course->totalMaleStudents();

        $this->assertEquals(10, $totalMales);
    }

    public function test_counts_total_female_students()
    {
        $course = factory(Course::class)->create();
        $maleStudents   = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Hombre']);
        $femaleStudents = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Mujer']);
        $students = User::all();
        foreach ($students as $student)
        {
            $course->users()->attach($student);
        }

        $totalFemales = $course->totalFemaleStudents();

        $this->assertEquals(10, $totalFemales);
    }

    public function test_counts_total_other_students()
    {
        $course = factory(Course::class)->create();
        $maleStudents   = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Hombre']);
        $femaleStudents = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Mujer']);
        $otherStudents  = factory(User::class, 5)->create(['type' => 'Student', 'gender'=>'Otro']);
        $students = User::all();
        foreach ($students as $student)
        {
            $course->users()->attach($student);
        }

        $totalOther = $course->totalOtherStudents();

        $this->assertEquals(5, $totalOther);
    }

    public function test_calcs_male_students_percentage()
    {
        $course = factory(Course::class)->create();
        $maleStudents   = factory(User::class, 4)->create(['type' => 'Student', 'gender'=>'Hombre']);
        $femaleStudents = factory(User::class, 4)->create(['type' => 'Student', 'gender'=>'Mujer']);
        $otherStudents  = factory(User::class, 2)->create(['type' => 'Student', 'gender'=>'Otro']);
        $students = User::all();
        foreach ($students as $student)
        {
            $course->users()->attach($student);
        }

        $malePercentage = $course->malePercentage();

        $this->assertSame(40, $malePercentage);
    }

    public function test_calcs_female_students_percentage()
    {
        $course = factory(Course::class)->create();
        $maleStudents   = factory(User::class, 4)->create(['type' => 'Student', 'gender'=>'Hombre']);
        $femaleStudents = factory(User::class, 4)->create(['type' => 'Student', 'gender'=>'Mujer']);
        $otherStudents  = factory(User::class, 2)->create(['type' => 'Student', 'gender'=>'Otro']);
        $students = User::all();
        foreach ($students as $student)
        {
            $course->users()->attach($student);
        }

        $femalePercentage = $course->femalePercentage();

        $this->assertSame(40, $femalePercentage);
    }

    public function test_calcs_other_students_percentage()
    {
        $course = factory(Course::class)->create();
        $maleStudents   = factory(User::class, 4)->create(['type' => 'Student', 'gender'=>'Hombre']);
        $femaleStudents = factory(User::class, 4)->create(['type' => 'Student', 'gender'=>'Mujer']);
        $otherStudents  = factory(User::class, 2)->create(['type' => 'Student', 'gender'=>'Otro']);
        $students = User::all();
        foreach ($students as $student)
        {
            $course->users()->attach($student);
        }

        $otherPercentage = $course->otherPercentage();

        $this->assertSame(20, $otherPercentage);
    }

    public function test_converts_carbon_range_into_string_range()
    {
        $period = CarbonPeriod::create(date("2020-1-2"), date("2020-1-11"));
        $CarbonRange = $period->toArray();

        $StringRange = Course::convertCarbonRangeIntoStringRange($CarbonRange);

        $this->assertIsArray($StringRange);
        $this->assertIsString($StringRange[0]);
    }

    public function test_gets_range_of_dates()
    {
        $start = date("2020-01-02");
        $end = date("2020-01-11");

        $course= Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => $start,
            'end_date' => $end
        ]);

        $CourseDates = $course->getRangeOfDates();  //returns an array of Carbon Dates

        $dayInBetween = date("2020-01-04");
        $dayOutOfRange = date("2020-01-22");

        $this->assertIsArray($CourseDates);

        $StringRange = Course::convertCarbonRangeIntoStringRange($CourseDates);

        $this->assertContains($dayInBetween, $StringRange);
        $this->assertNotContains($dayOutOfRange, $StringRange);
    }

    public function test_excludes_weekends_from_range_of_dates()
    {
        $period = CarbonPeriod::create(date("2020-1-1"), date("2020-1-11"));
        $rangeAllDates = $period->toArray();

        $StringRange = Course::convertCarbonRangeIntoStringRange($rangeAllDates);

        $Friday=date("2020-01-03");
        $Saturday=date("2020-01-04");

        $this->assertContains($Friday, $StringRange);
        $this->assertContains($Saturday, $StringRange);

        $rangeWeekdaysOnly = Course::excludeWeekendsFromRange($rangeAllDates);

        $this->assertIsArray($rangeWeekdaysOnly);

        $StringRange = Course::convertCarbonRangeIntoStringRange($rangeWeekdaysOnly);

        $this->assertContains($Friday, $StringRange);
        $this->assertNotContains($Saturday, $StringRange);
    }

    public function test_gets_course_days_as_string()
    {
        $start = date("2020-01-02");
        $end = date("2020-01-11");

        $friday = date("2020-01-03");
        $saturday = date("2020-01-04");
        $sunday = date("2020-01-05");

        $course = Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => $start,
            'end_date' => $end
        ]);

        $CourseDays = $course->getCourseDaysAsString();

        $this->assertIsArray($CourseDays);
        $this->assertIsString($CourseDays[0]);
        $this->assertContains($friday, $CourseDays);
        $this->assertNotContains($saturday, $CourseDays);
        $this->assertNotContains($sunday, $CourseDays);
        $this->assertNotContains(date("2020-01-12"), $CourseDays);
    }

    public function test_gets_course_days_until_now()
    {
        $start = date("2020-01-01");
        $end = date("2020-01-31");

        $course= Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => $start,
            'end_date' => $end
        ]);

        $FakeToday = Carbon::create(2020, 1, 15, 12);
        Carbon::setTestNow($FakeToday);

        $CourseDatesUntilToday = $course->getCourseDaysUntilNow();

        $friday = date("2020-01-03");
        $saturday = date("2020-01-04");
        $weekdayAfterFakeToday = date("2020-01-17");

        $this->assertIsArray($CourseDatesUntilToday);
        $this->assertContains($friday, $CourseDatesUntilToday);
        $this->assertNotContains($saturday, $CourseDatesUntilToday);
        $this->assertNotContains($weekdayAfterFakeToday, $CourseDatesUntilToday);

        $FakeTodayAfterCourseDates = Carbon::create(2020, 26, 8, 12);
        Carbon::setTestNow($FakeTodayAfterCourseDates);

        $CourseDatesUntilToday2 = $course->getCourseDaysUntilNow();

        $dayAfterCourseRangeButBeforeFakeToday= date("2020-03-15");
        $this->assertNotContains($dayAfterCourseRangeButBeforeFakeToday, $CourseDatesUntilToday2);

    }
}
