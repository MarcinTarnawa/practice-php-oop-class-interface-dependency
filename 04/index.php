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
}

class Teacher
{
    protected $teachers = [];

    public function addTeacher(string $name): array
    {
        $newTeacher = [
            'name' => $name
        ];

        $this->teachers[] = $newTeacher; 
        
        return $this->teachers;
    }

    public function getTeachers(): array
    {
        return $this->teachers;
    }

    public function getTeacherName(string $name): ?array
    {
        foreach ($this->teachers as $teacher) {
            if (stripos($teacher['name'], $name) !== false) {
                return $teacher;
            }
        }
        return null;
    }
}

class Subject
{
    protected $subjects = [];

    public function addSubject(string $name): array
    {
        $this->subjects[] = $name;
        return $this->subjects;
    }

    public function getSubjects(): array
    {
        return $this->subjects;
    }

    public function getSubjectName(string $name)
    {
        foreach ($this->subjects as $subject) {
            if (stripos($subject, $name) !== false) {
                return $subject;
            }
        }
        return null;
    }
}

class ClassGroup
{
    protected $classGroup = [];

    public function addClassGroup(string $name)
    {
        $this->classGroup[] = $name;
        return $this->classGroup;
    }

    public function getClass(): array
    {
        return $this->classGroup;
    }
    
    public function getClassName(string $name)
    {
        foreach ($this->classGroup as $className) {
            if (stripos($className, $name) !== false) {
                return $className;
            }
        }
        return null;
    }
}

class Lesson
{
    protected $lesson = [];
    
    public function addLesson(
        string $classGroupName, 
        string $subjectName, 
        string $teacherName, 
        string $dateTime,
        ClassGroup $classGroupManager,
        Subject $subjectManager,
        Teacher $teacherManager
    ): ?array
    {
        $foundClass = $classGroupManager->getClassName($classGroupName);
        $foundSubject = $subjectManager->getSubjectName($subjectName);
        $foundTeacher = $teacherManager->getTeacherName($teacherName);
        
        if (!$foundClass || !$foundSubject || !$foundTeacher) {
            echo "Error: Can't add new lesson. (Looking for: {$classGroupName}, {$subjectName}, {$teacherName})<br>";
            return null;
        }

        $newLesson = [
            'class' => $foundClass,
            'subject' => $foundSubject,
            'teacher' => $foundTeacher['name'],
            'date' => $dateTime,
        ];
        
        $this->lesson[] = $newLesson;
        
        return $newLesson;
    }

    public function getLessons(): array
    {
        return $this->lesson;
    }
}

class Harmonogram
{
    protected $lessons = [];

    public function __construct(Lesson $lesson)
    {
        $this->lessons = $lesson->getLessons(); 
    }

    public function getHarmonogram(): array
    {
        return $this->lessons;
    }
}

$calendar = new Calendar;
$currentDate = $calendar->calendar(); 
echo $currentDate . "<br>";

$teacher = new Teacher();
$teacher->addTeacher('Marcin T');
$teacher->addTeacher('Anna Kowal');
$teacher->addTeacher('Anna Stec');
$teacher->addTeacher('Robert Nowak');

$courseList = new Subject();
$courseList->addSubject('Matematyka');
$courseList->addSubject('Informatyka');
$courseList->addSubject('Historia');

$classGroup = new ClassGroup();
$classGroup->addClassGroup('3A');
$classGroup->addClassGroup('3B');
$classGroup->addClassGroup('1C');

$lesson = new Lesson();

$newLesson1 = $lesson->addLesson(
    '3B',
    'Matematyka',
    'Anna Stec',
    '2025-09-13 08:00',
    $classGroup,
    $courseList,
    $teacher
);

$newLesson2 = $lesson->addLesson(
    '3A',
    'Historia',
    'Robert',
    '2025-09-13 09:15',
    $classGroup,
    $courseList,
    $teacher
);

$newLesson3 = $lesson->addLesson(
    '1C', 
    'Informatyka',
    'Marcin',
    '2025-09-13 10:45',
    $classGroup,
    $courseList,
    $teacher
);

$harmonogram = new Harmonogram($lesson);
$harmonogramData = $harmonogram->getHarmonogram();

?>

<pre>
<?php
echo "Harmonogram Data (Lessons Table):\n";
var_dump($harmonogramData);
?>
</pre>