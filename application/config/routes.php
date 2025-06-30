<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'AdminLogin';
 
// Route for the login page
$route['login'] = 'AdminLogin/login'; 
$route['ForgetPwdIndex'] = 'AdminLogin/ForgetPwdIndex'; 
$route['SendResetLink'] = 'AdminLogin/SendResetLink'; 
$route['ResetPassword'] = 'AdminLogin/ResetPassword'; 
$route['update_password'] = 'AdminLogin/update_password'; 
$route['logout'] = 'AdminLogin/logout'; 


//route for Dashboard page
$route['DashboardIndex'] = 'Dashboard_Controller/DashboardIndex';
$route['EditProfileIndex'] = 'Dashboard_Controller/EditProfileIndex';
$route['UpdateEditProfileData'] = 'Dashboard_Controller/UpdateEditProfileData';

	/****Routes for Masjid Management:****/
$route['MasjidIndex'] = 'Masjid_Controller/MasjidIndex';
$route['AddMasjid'] = 'Masjid_Controller/AddMasjid';
$route['DeleteMasjid'] = 'Masjid_Controller/DeleteMasjid';
$route['getMasjidData'] = 'Masjid_Controller/getMasjidData';
$route['UpdateMasjidData'] = 'Masjid_Controller/UpdateMasjidData';
$route['upd'] = 'Masjid_Controller/upd';
$route['MasjidDetails'] = 'Masjid_Controller/MasjidDetails';

	/****Routes for Admin Management:****/
$route['AdminIndex'] = 'Admin_Controller/AdminIndex';
$route['AddAdmin'] = 'Admin_Controller/AddAdmin';
$route['DeleteAdmin'] = 'Admin_Controller/DeleteAdmin';
$route['getAdminData'] = 'Admin_Controller/getAdminData';
$route['UpdateAdminData'] = 'Admin_Controller/UpdateAdminData';
$route['UpdateAdmin'] = 'Admin_Controller/UpdateAdmin';
$route['AdminDetails'] = 'Admin_Controller/AdminDetails';

/****Routes for Teachers Management:****/
$route['TeacherIndex'] = 'Teacher_Controller/TeacherIndex';
$route['addTeacher'] = 'Teacher_Controller/addTeacher';
$route['getTeacherData'] = 'Teacher_Controller/getTeacherData';
$route['UpdateTeacherData'] = 'Teacher_Controller/UpdateTeacherData';
$route['DeleteTeacher'] = 'Teacher_Controller/DeleteTeacher';

/****Routes for Courses Management:****/
$route['CourseIndex'] = 'Course_Controller/CourseIndex';
$route['AddCourse'] = 'Course_Controller/AddCourse';
$route['DeleteCourse'] = 'Course_Controller/DeleteCourse';
$route['getCourseData'] = 'Course_Controller/getCourseData';
$route['UpdateCourseData'] = 'Course_Controller/UpdateCourseData';
$route['CourseDetails'] = 'Course_Controller/CourseDetails';

/****Routes for Student Management:****/
$route['StudentIndex1'] = 'Student_Controller/StudentIndex1';
$route['StudentIndex'] = 'Student_Controller/StudentIndex';
$route['AddStudent'] = 'Student_Controller/AddStudent';
$route['DeleteStudent'] = 'Student_Controller/DeleteStudent';
$route['UpdateStudentData'] = 'Student_Controller/UpdateStudentData';
$route['getStudentData'] = 'Student_Controller/getStudentData';
$route['StudentDetails'] = 'Student_Controller/StudentDetails';
$route['GetParentData'] = 'Student_Controller/GetParentData';
$route['CheckEmailExist'] = 'Student_Controller/CheckEmailExist';

/****Routes for Assign Classes:****/
$route['AssignClassIndex'] = 'AssignClass_Controller/AssignClassIndex';
$route['AssignClass'] = 'AssignClass_Controller/AssignClass';
$route['DeleteClass'] = 'AssignClass_Controller/DeleteClass';
$route['UpdateAssignClassData'] = 'AssignClass_Controller/UpdateAssignClassData';
$route['getAssignClassData'] = 'AssignClass_Controller/getAssignClassData';


$route['ClearAttendanceIndex'] = 'ClearAttendance_Controller/ClearAttendanceIndex';
$route['DeleteAttendanceData'] = 'ClearAttendance_Controller/DeleteAttendanceData';
$route['AttendanceReports'] = 'AttendanceReportsController/AttendanceReports'; 
$route['AttendanceResult'] = 'AttendanceReportsController/AttendanceResult';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
