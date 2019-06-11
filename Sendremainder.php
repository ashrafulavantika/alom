<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Sendremainder extends Alom {
    
    function __construct() {
        parent::__construct();
        //$this->isloggedin();
        $this->load->model(ADMIN_DIR."teachers_model");
        $this->load->model(ADMIN_DIR."students_model");
        $this->load->model(SITE_DIR."feedbacks_model");
        $this->load->helper("sendsms");
        $this->load->helper("sendmail");
    }//End of __construct()
    
    function index() {
        $stdRows = $this->students_model->get_rows("std_status", 1);
        if ($stdRows) {
            $counter=0;
            foreach ($stdRows as $rows) {
                $std_id = $rows->std_id;
                $acyr_id = $rows->acyr_id;                
                $dept_id = $rows->dept_id;
                $course_id = $rows->course_id;           
                $sem_id = $rows->sem_id;
                $teachers = $this->teachers_model->get_myrows($acyr_id, $dept_id, $course_id, $sem_id);
                $myFeedbacks = $this->feedbacks_model->get_myrows($acyr_id, $dept_id, $course_id, $sem_id, $std_id);
                $totTeachers = $teachers?count((array)$teachers):0;
                $totFeedbacks =  $myFeedbacks?count((array)$myFeedbacks):0;
                //echo $std_id." : ".$totFeedbacks." out of ".$totTeachers;
                if($totFeedbacks < $totTeachers) {
                    $counter++;
                    $remFedbacks = $totTeachers-$totFeedbacks;
                    $std_name = $rows->std_fname." ".$rows->std_mname." ".$rows->std_lname;
                    $std_mobile = $rows->std_mobile;            
                    $std_email = $rows->std_email;                    
                    $msg = "Dear ".$std_name." To complete your registration for RGU CET 2019 use OTP  ".$remFedbacks.". Regards Rajiv Gandhi University Doimukh (A.P.)";
                    //sendmsg($msg, $mobile);
                    //sendmail($msg, $std_email);
                    echo " => Remaining : ".$remFedbacks;
                }//End of if
                echo "<br>";
            }//End of foreach()
            echo $counter." Remainder(s) has been sent";
        }//End of if
    }//End of index()
}//End of Sendremainder