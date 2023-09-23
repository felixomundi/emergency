<?php

namespace App\Models;


use App\Models\Units;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_as',
        "status",
        "branch_id",
        "image",
        "phone",
        "gender",
        "dob",
        "father_name",
        "father_occupation",
        "father_phone_number",
        "mother_name",
        "mother_occupation",
        "mother_phone_number",
        "county",
        "district",
        "division",
        "location",
        "sub_location",

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  

    public function branch(){
        return $this->belongsTo(Branches::class, "branch_id","id");
    }


static public function getAllTeacherStudents($user){
     $return  = self::select("users.name as name", "users.email as email", "courses.title as course", "users.phone as phone")
                ->join("students", "students.user_id", "=", "users.id")
                ->join("courses", "courses.id", "=", "students.courses_id")
                ->join("assigned_courses","assigned_courses.courses_id","=","courses.id")
                ->where("assigned_courses.user_id","=", $user)
                ->where("users.role_as","=", 2);
         $return = $return ->orderBy("users.id", "desc")->get();
         return $return;
}


static public function getStudentsByCourse($user, $course){
    $return  = self::select("users.name as name", "users.email as email", "courses.title as course", "users.phone as phone")
               ->join("students", "students.user_id", "=", "users.id")
               ->join("courses", "courses.id","=", "students.courses_id")
               ->join("assigned_courses","assigned_courses.courses_id","=","courses.id")
               ->where("assigned_courses.user_id","=", $user)
               ->where("assigned_courses.courses_id","=", $course)
               ->where("users.role_as","=", 2);
        $return = $return ->orderBy("users.id", "desc")->get();
        return $return;
}


static public function staffGetStudentsByCourse($user, $course){
    $return  = self::select("users.id as id", "users.name as name", "students.admission_number as ad_no", "students.id as student_id")
               ->join("students", "students.user_id", "=", "users.id")
               ->join("courses", "courses.id","=", "students.courses_id")
               ->join("assigned_courses","assigned_courses.courses_id", "=", "courses.id")
               ->where("assigned_courses.user_id", "=", $user)
               ->where("assigned_courses.courses_id", "=", $course)
               ->where("courses.id", "=", [$course])
               ->where("users.role_as","=", 2);
        $return = $return ->orderBy("users.id", "desc")->get();
        return $return;
}

static public function getStudentCourse($id){
    return self::select("courses.title as title")
    ->join("students","students.user_id" ,"=","users.id")
    ->join("courses","courses.id","=","students.courses_id")
    ->where("students.id","=",  $id)
    ->get();
}

static public function staffgetStudentResult($unit, $course){
return self::select("users.id as id",  "users.name as name", "students.id as student_id", "students.admission_number as ad_no" ,"exam_results.marks as marks")
->join("students","students.user_id","=", "users.id")
->join("courses","courses.id", "=", "students.courses_id")
->join("units", "units.courses_id", "=","courses.id")
->join("exam_results","exam_results.student_id", "=", "students.id")
->where("exam_results.unit_id", "=", $unit)
->where("units.id","=", $unit)
->where("courses.id","=", $course)
->where("users.role_as","=","2")
->where("users.status","=","0")
->get();
}


static public function  fetchTutors(){
return User::select("users.id as id", "users.name as name")
->join("staff","staff.user_id", "=","users.id")
->where("users.role_as", "=",3)
->where("users.status", "=", 0)
->get();
}



static public function getStaffUnits($user){
    return self::join('staff', 'staff.user_id', '=', 'users.id')
    ->join('units', 'units.staff_id', '=', 'staff.id')
   ->where('users.id', '=', $user)
   ->where('units.status',0)
    ->get(["units.unit_code", 'units.title',"units.created_at", "units.courses_id"]);
  }

  static public function adminfetchStudentsByCourse($id){
    return User::select("users.id as id", "users.name as name")
    ->join("students", "students.user_id", "=", "users.id")
    ->join("courses", "courses.id","=", "students.courses_id")
    ->where("users.role_as","=",[2])
    ->where("users.status","=",[0])
    ->where("courses.id","=",$id)
    ->get();
  }

  static public function _adminFetchStudentResults($unit, $course){
    return self::select(
    "users.name as name",
    "users.id as id",
    "students.admission_number as ad_no",
    "students.id as student_id",
    "exam_results.marks as marks")
    ->join("students","students.user_id","=", "users.id")
    ->join("courses","courses.id", "=", "students.courses_id")
    ->join("units", "units.courses_id", "=","courses.id")
    ->join("exam_results", "exam_results.student_id", "=", "students.id")
    ->where("exam_results.unit_id","=",[$unit])
    ->where("exam_results.courses_id", "=", [$course])
    ->where("units.id", "=", [$unit])
    ->where("courses.id", "=", [$course])
    ->where("users.role_as","=",2)
    ->where("users.status","=", "0")
    ->orderBy("exam_results.id")
    ->get()
    ->toArray();
}

static public function accountFetchStudents(){
    return User::select("users.name as name","users.created_at as created_at", "users.id as id", "students.admission_number as ad_no", "courses.title as course","branches.title as branch")
    ->join("students", "students.user_id", "=", "users.id")
    ->join("courses", "students.courses_id", "=", "courses.id")
    ->join("branches", "branches.id", "=", "students.branch_id")
    ->where("users.role_as", "=", [2])
    ->where("users.status", "=", [0])
    ->get();
}


static public function accountgetStudentsByCourseId($courseId){
    return self::select(
        "users.name as name",
        "users.id as id",)
        ->join("students","students.user_id","=", "users.id")
        ->join("courses","courses.id", "=", "students.courses_id")
        ->where("courses.id", "=", [$courseId])
        ->where("users.role_as", "=", 2)
        ->where("users.status","=", "0")
        ->orderBy("users.name")
        ->get()
        ->toArray();
}


}

