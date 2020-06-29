<?php
require_once("includes/config.php");
$content='home.php';
$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';

switch ($view) {
 
	case 'department' :
        $title="Department";	
		$content='menu.php';		
		break;
	case 'contact' :
        $title="Contact Us";	
		$content='contact.php';		
		break;

	case 'about' :
        $title="About Us";	
		$content='about.php';		
		break;	
	case 'blogs' :
        $title="News & Notice";	
		$content='blogs.php';		
		break;
	case 'singleblog' :
        $title="View News & Notice";	
		$content='single-blog.php';		
		break;
	case 'intro' :
        $title="Choose Student Or Teacher";	
		$content='intro.php';		
		break;
	case 'studentLogin' :
        $title="Student Login Page";	
		$content='login.php';		
		break;
	case 'staffLogin' :
        $title="Staff Login Page";	
		$content='login.php';		
		break;
	case 'studentSignup' :
        $title="Student Signup Page";	
		$content='signUp.php';		
		break;
	case 'staffSignup' :
        $title="Staff Signup Page";	
		$content='signUp.php';		
		break;
	default :
	    $title="Home";	
		$content ='home.php';		
}
require_once("theme/templates.php");
?>