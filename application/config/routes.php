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
$route['Index'] = 'AdminLogin/Index'; 
$route['login'] = 'AdminLogin/login'; 
$route['logout'] = 'AdminLogin/logout'; 


//route for Dashboard page
$route['DashboardIndex'] = 'Dashboard_Controller/DashboardIndex';

	/****Routes for Masjid Management:****/
$route['MasjidIndex'] = 'Masjid_Controller/MasjidIndex';
$route['add'] = 'Masjid_Controller/add';
$route['GetList'] = 'Masjid_Controller/GetList';
$route['delete_id'] = 'Masjid_Controller/delete_id';
$route['updatedata'] = 'Masjid_Controller/updatedata';
$route['upd'] = 'Masjid_Controller/upd';
$route['MasjidDetails'] = 'Masjid_Controller/MasjidDetails';

/****Routes for Teachers Management:****/
$route['TeacherIndex'] = 'Teacher_Controller/TeacherIndex';
$route['addTeacher'] = 'Teacher_Controller/addTeacher';
$route['GetTeachersList'] = 'Teacher_Controller/GetTeachersList';
$route['delete_User'] = 'Teacher_Controller/delete_User';
$route['updateUser'] = 'Teacher_Controller/updateUser';
$route['upd_User'] = 'Teacher_Controller/upd_User';
$route['TeacherDetails'] = 'Teacher_Controller/TeacherDetails';

/****Routes for Courses Management:****/
$route['CourseIndex'] = 'Course_Controller/CourseIndex';
$route['addCourse'] = 'Course_Controller/addCourse';
$route['GetCoursesList'] = 'Course_Controller/GetCoursesList';
$route['delete_Course'] = 'Course_Controller/delete_Course';
$route['updateCourse'] = 'Course_Controller/updateCourse';
$route['upd_Course'] = 'Course_Controller/upd_Course';
$route['CourseDetails'] = 'Course_Controller/CourseDetails';



/****Routes for Student Management:****/
$route['StudentIndex'] = 'Student_Controller/StudentIndex';
$route['addStudent'] = 'Student_Controller/addStudent';
$route['GetStudentsList'] = 'Student_Controller/GetStudentsList';
$route['delete_Student'] = 'Student_Controller/delete_Student';
$route['updateStudent'] = 'Student_Controller/updateStudent';
$route['upd_Student'] = 'Student_Controller/upd_Student';
$route['StudentDetails'] = 'Student_Controller/StudentDetails';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
