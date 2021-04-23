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
|	https://codeigniter.com/user_guide/general/routing.html
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

$route['default_controller'] = 'homeController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*Admin Route START*/

$route['admin/home'] = 'admin/homeController';
$route['admin/login'] = 'admin/loginController';
$route['admin/logincheck'] = 'admin/loginController/login';
$route['admin/logout'] = 'admin/loginController/logout';

/* Student route*/
$route['admin/student'] = 'admin/studentController';
$route['admin/addstudent'] = 'admin/studentController/addStudent';
$route['admin/savestudent'] = 'admin/studentController/save';
$route['admin/getclass'] = 'admin/studentController/getClasses';
$route['admin/editStudent/getclass'] = 'admin/studentController/getClasses';
$route['admin/getStudentList'] = 'admin/studentController/getStudentList';
$route['admin/deleteStudent/(:any)'] = 'admin/studentController/deleteStudent/$1';
$route['admin/editStudent/(:any)'] = 'admin/studentController/editStudent/$1';
$route['admin/editstudent/(:any)'] = 'admin/studentController/edit/$1';
$route['admin/email_exists'] = 'admin/studentController/email_exists';
$route['admin/parent_exists'] = 'admin/studentController/parent_exists';
/* Student route*/

/*School Route*/
$route['admin/school'] = 'admin/schoolController';
$route['admin/addschool'] = 'admin/schoolController/addschool';
$route['admin/save'] = 'admin/schoolController/save';
$route['admin/editschool/(:any)'] = 'admin/schoolController/editSchool/$1';
$route['admin/edit/(:any)'] = 'admin/schoolController/edit/$1';
/*School Route*/

/*Class Route*/
$route['admin/class'] = 'admin/schoolController/classes';
$route['admin/getClassList'] = 'admin/schoolController/getClassList';
$route['admin/addclass'] = 'admin/schoolController/addclass';
$route['admin/saveclass'] = 'admin/schoolController/saveclass';
$route['admin/editclass/(:any)'] = 'admin/schoolController/editclass/$1';
$route['admin/classedit/(:any)'] = 'admin/schoolController/classedit/$1';
$route['admin/deleteclass/(:any)'] = 'admin/schoolController/deleteclass/$1';
/*Class Route*/

/*Teacher Route*/
$route['admin/teacher'] = 'admin/teacherController';
$route['admin/addteacher'] = 'admin/teacherController/addteacher';
$route['admin/teacher_email_exists'] = 'admin/teacherController/teacher_email_exists';
$route['admin/getTeacherList'] = 'admin/teacherController/getTeacherList';
$route['admin/editteacher/(:any)'] = 'admin/teacherController/editteacher/$1';
$route['admin/getclass'] = 'admin/teacherController/getClasses';
$route['admin/deleteteacher/(:any)'] = 'admin/teacherController/deleteTeacher/$1';

/*Teacher Route*/

/*Parent Route*/
$route['admin/parent'] = 'admin/parentController';
$route['admin/addparent'] = 'admin/parentController/addparent';
$route['admin/editparent/(:any)'] = 'admin/parentController/editparent/$1';
$route['admin/getParentList'] = 'admin/parentController/getParentList';
$route['admin/parent_email_exists'] = 'admin/parentController/parent_email_exists';
$route['admin/deleteparent/(:any)'] = 'admin/parentController/deleteParent/$1';
/*Parent Route*/

/*Admin Route END*/

/*Frontend Route START*/
$route['login'] = 'loginController';
$route['forgotpassword'] = 'loginController/ForgotPassword';
$route['forgotpasswordCheck'] = 'loginController/forgotpasswordCheck';
$route['resetpassword/(:any)'] = 'loginController/resetpassword/$1';
$route['parentregister'] = 'RegisterController/parentRegister';
$route['check_parent_email'] = 'AjaxController/check_parent_email';
$route['check_bracelet_id'] = 'AjaxController/check_bracelet_id';
$route['add_teacher'] = 'TeacherController/add_teacher';
$route['teacher'] = 'TeacherController';
$route['edit_teacher'] = 'TeacherController/edit_teacher';
$route['delete_teacher'] = 'TeacherController/delete_teacher';
$route['delete_student'] = 'StudentController/delete_student';
$route['classes'] = 'ClassesController/classes';
$route['add_class'] = 'ClassesController/add_class';
$route['edit_class'] = 'ClassesController/edit_class';
$route['delete_class'] = 'ClassesController/delete_class';
$route['student/(:any)'] = 'StudentController/student/$1';
$route['add_student'] = 'StudentController/add_student';
$route['edit_student'] = 'StudentController/edit_student';


$route['loginusercheck'] = 'loginController/loginusercheck';
$route['logout'] = 'loginController/logout';

$route['dashboard'] = 'HomeController';
$route['profile'] = 'HomeController/Profile';
$route['help-center'] = 'HomeController/helpCenter';
$route['about-us'] = 'HomeController/aboutus';
$route['talk-with-us'] = 'HomeController/talkWithus';
$route['support'] = 'HomeController/support';
$route['SaveSupport'] = 'HomeController/SaveSupport';

/*Frontend Route END*/
