<?php

class Calendar
{
    protected $currentDay;

    public function calendar()
    {
        return $this->currentDay = $this->date("Y-m-j");
    }

    public function date($format)
    {
        date_default_timezone_set('Europe/Warsaw');

        return date($format);
    }
    public function getDateForDayName(string $dayName): string
    {
        $dayMap = [
            'Poniedziałek' => 'Monday',
            'Wtorek'       => 'Tuesday',
            'Środa'        => 'Wednesday',
            'Czwartek'     => 'Thursday',
            'Piątek'       => 'Friday',
            'Sobota'       => 'Saturday',
            'Niedziela'    => 'Sunday',
        ];

        $englishDayName = $dayMap[$dayName] ?? null;

        if ($englishDayName) {
            $timestamp = strtotime("next {$englishDayName}");
            return date("Y-m-j", $timestamp);
        }
        return $this->date("Y-m-j"); 
    }
}

abstract class Human
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function sayHello();
}

class Teacher extends Human
{
    public function sayHello()
    {
        echo "Jestem profesorem $this->name";
    }
}

class Subject
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

class Student extends Human
{
    public function sayHello()
    {
        echo "Jestem uczniem $this->name";
    }
}

class StudentsClass
{
    protected array $students = [];
    protected string $className;

    public function __construct($className)
    {
        $this->className = $className;
    }

    public function addStudent(Student $student)
    {   
        $this->students[] = $student;
    }
}

class Lesson
{
    protected StudentsClass $studentClass;
    protected Teacher $teacher;
    protected Subject $subject;
    protected int $room;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function saveTeacher(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    public function saveStudentClass(StudentsClass $studentClass)
    {
        $this->studentClass = $studentClass;
    }

    public function addStudent(Student $student)
    {
        $this->studentClass->addStudent($student);
    }

    public function setClassRoom(int $room)
    {
        $this->room = $room;
    }
}

class Day
{
    protected string $name;
    protected array $lesson;
    protected string $calendar;
    protected string $time;

    public function __construct(string $time, string $name)
    {
        $this->time = $time;
        $this->name = $name;
    }

    public function addLesson(Lesson $lesson)
    {
        $this->lesson[] = $lesson;
    }

    public function dateTime(Calendar $calendar)
    {
        $this->calendar = $calendar->getDateForDayName($this->name);
    }
}

$calendar = new Calendar();

$teacher1 = new Teacher("Marcin");
$teacher2 = new Teacher("Anna");
$teacher3 = new Teacher("Katarzyna");


$student1 = new Student("Mateusz");
$student2 = new Student("Kamil");
$student3 = new Student("Irenka");
$student4 = new Student("Zbigniew");


$classA = new StudentsClass("A");
$classA->addStudent($student1);
$classA->addStudent($student2);

$classB = new StudentsClass("B");
$classB->addStudent($student3);
$classB->addStudent($student4);

$subjectPolish = new Subject("Polski");

$lessonPolish = new Lesson($subjectPolish);
$lessonPolish->saveTeacher($teacher1);
$lessonPolish->saveStudentClass($classA);
$lessonPolish->addStudent(new Student("Janek"));
$lessonPolish->setClassRoom(1);

$subjectEnglish = new Subject("Angielski");
$lessonEnglish = new Lesson($subjectEnglish);
$lessonEnglish->saveTeacher($teacher2);
$lessonEnglish->saveStudentClass($classB);
$lessonEnglish->setClassRoom(4);

$subjectEnglish2 = new Subject("Angielski");
$lessonEnglish2 = new Lesson($subjectEnglish2);
$lessonEnglish2->saveTeacher($teacher2);
$lessonEnglish2->saveStudentClass($classB);
$lessonEnglish2->setClassRoom(3);

$day = new Day("8:00", "Poniedziałek");
$day->dateTime($calendar);
$day->addLesson($lessonPolish);
$day->addLesson($lessonEnglish);

$day2 = new Day("9:00", "Wtorek");
$day2->dateTime($calendar);
$day2->addLesson($lessonPolish);
$day2->addLesson($lessonEnglish);

$day3 = new Day("11:00", "Czwartek");
$day3->dateTime($calendar);
$day3->addLesson($lessonPolish);
$day3->addLesson($lessonEnglish2);

?>
<pre>
<?php 

var_dump($day);
var_dump($day2);
var_dump($day3);
?>
</pre>