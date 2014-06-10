<?php
/// original file: mod/glossary/export.php
/// modified by JR 17 JAN 2011
	global  $USER, $COURSE;	

require_once("../../config.php");
require_once($CFG->dirroot.'/mod/quizletimport/quizlet.php');

require_login();
if (isguestuser()) {
    die();
}

//Set up page
$context = context_user::instance($USER->id);
//require_capability('moodle/user:viewalldetails', $context);
$PAGE->set_context($context);


//get quizlet search form
$search_form = new quizlet_search_form();
$data = $search_form->get_data();


//make double sure we have the course id in id
if(empty($data->courseid)){
	$courseid = optional_param('courseid',$COURSE->id, PARAM_INT);
}else{
	$courseid = $data->courseid;
}

//prepare rest of page and data
$oauth2code = optional_param('oauth2code', 0, PARAM_RAW);
$url = new moodle_url('/blocks/quizletquiz/export_to_quiz.php', array('courseid'=>$courseid));
$PAGE->set_url($url);
$PAGE->set_pagelayout('standard');



  //Initialize Quizlet and deal with oauth etc
	//i  - send off to auth screen
	//ii - arrive back unauth, but with oauth2code
	//iii - complete auth by getting access token
	 $args = array(
		'api_scope' => 'read'
	);
	$qiz  = new quizlet($args);
	
	$qmessage = false;
	if(!$qiz->is_authenticated() && $oauth2code){
                $result  = $qiz->get_access_token($oauth2code);
                if(!$result['success']){
                        $qmessage = $result['error'];
                }   
     }
	
echo $OUTPUT->header();

	if($qmessage){
		qdisplayerror($qmessage);
	}elseif(!$qiz->is_authenticated()){
		$authlink= '<a href="' . $qiz->fetch_auth_url() . '">' . get_string('quizletlogin', 'block_quizletquiz') . '</a>';
         qdisplayerror($authlink);
	}else{
		qdisplayforms($qiz, $courseid, $search_form, $data);
	}

echo $OUTPUT->footer();

function qdisplayerror($qmessage) {
     echo $qmessage;
}//end of func

function qdisplayforms($qiz, $courseid, $search_form, $data){

global $OUTPUT;

	$param_searchtext = '';
	$param_searchtype = '';
	if(!empty($data->searchtext)){
		$param_searchtext = $data->searchtext;
	}
	if(!empty($data->searchtype)){
		$param_searchtype = $data->searchtype;
	}
	
	//if authenticated fill our select box with users sets
	//otherwise show a login/authorize link
	$select = "";
	if($qiz->is_authenticated()){
		//default is to list our sets
		$searchresult = $qiz->do_search($param_searchtext,$param_searchtype);
	
		if($searchresult['success']){
			if(is_array($searchresult['data'])){
				$setdata = $searchresult['data'];	
			}else{
				$setdata = $searchresult['data']->sets;
			}
			$select_qexport = $qiz->fetch_set_selectlist($setdata,'quizletset_qexport',true);
			$select_ddrop = $qiz->fetch_set_selectlist($setdata,'quizletset_ddrop',true);
			
		}else{
			//complain that we got no sets here
			echo "NO SETS!!!";
		}
	}
	

	//create question types
	$qtypes = array();
	$qtypes['multichoice_abc'] =get_string('multichoice', 'block_quizletquiz').
    					' ('. get_string('answernumberingabc', 'qtype_multichoice').')';
    $qtypes['multichoice_ABCD'] =get_string('multichoice', 'block_quizletquiz').
    					' ('. get_string('answernumberingABCD', 'qtype_multichoice').')'; 
	$qtypes['multichoice_123'] =get_string('multichoice', 'block_quizletquiz').
    					' ('. get_string('answernumbering123', 'qtype_multichoice').')';
    $qtypes['multichoice_none'] =get_string('multichoice', 'block_quizletquiz').
    					' ('. get_string('answernumberingnone', 'qtype_multichoice').')';
    $qtypes['shortanswer_0'] =get_string('shortanswer_0', 'block_quizletquiz');
	$qtypes['shortanswer_1'] =get_string('shortanswer_1', 'block_quizletquiz');



$strexportfile = get_string("exportfile", "block_quizletquiz");
$strexportdragdrop = get_string("exportdragdrop", "block_quizletquiz");
$strexportentries = get_string('exporttofileheader', 'block_quizletquiz');

echo $OUTPUT->heading(get_string('exporttofileheader', 'block_quizletquiz'));
echo get_string('exporttofile', 'block_quizletquiz');
echo $OUTPUT->box_start('generalbox');
//echo $searchform;
$search_form->display();
echo $OUTPUT->box_end();
echo "<hr />";
echo $OUTPUT->heading(get_string('exporttoquestionsheader', 'block_quizletquiz'));
echo $OUTPUT->box_start('generalbox');
echo get_string('exporttoquestions', 'block_quizletquiz');
?>
    <form action="exportfile_to_quiz.php" method="post">
    
     <div>
    <input type="hidden" name="courseid" value="<?php p($courseid) ?>" />
    <input type="hidden" name="exporttype" value="quiz" />
    
    <?php
    //question types
    foreach ($qtypes as $qcode=>$qname){
			echo("<input type='checkbox' name='questiontype[]' value='$qcode'>$qname</input><br />");
		}
	?>
	  
    </div>
    <?php
    echo get_string('availablesets', 'block_quizletquiz') . '<br />'  . $select_qexport;
    ?>
<table border="0" cellpadding="6" cellspacing="6" width="100%">
    <tr><td align="center">
        <input type="submit" value="<?php p($strexportfile)?>" />
    </td></tr></table>
    </form>
 <?php
    echo $OUTPUT->box_end();
	echo "<hr />";
	echo $OUTPUT->heading(get_string('exporttoddropheader', 'block_quizletquiz'));
	echo $OUTPUT->box_start('generalbox');
	echo get_string('exporttoddrop', 'block_quizletquiz');
?> 
   <form action="exportfile_to_quiz.php" method="post">
 
     <div>
    <input type="hidden" name="courseid" value="<?php p($courseid) ?>" />
    <input type="hidden" name="exporttype" value="dragdrop" />
<?php
   //what kind of quizlet activity are we going to display
		$activities = array('flashcards' => get_string('acttype_flashcards', 'block_quizletquiz'),
				'scatter'=>get_string('acttype_scatter', 'block_quizletquiz'),
				'spacerace'=>get_string('acttype_spacerace', 'block_quizletquiz'),
				'test'=>get_string('acttype_test', 'block_quizletquiz'),
				'speller'=>get_string('acttype_speller', 'block_quizletquiz'),
				'learn'=>get_string('acttype_learn', 'block_quizletquiz'));
		foreach ($activities as $aid=>$atitle){
			echo("<input type='checkbox' name='activitytype[]' value='$aid'>$atitle</input><br />");
		}
		 echo get_string('availablesets', 'block_quizletquiz') . '<br />' . $select_ddrop;
	
?>
    </div>
       <table border="0" cellpadding="6" cellspacing="6" width="100%">
    <tr><td align="center">
        <input type="submit" value="<?php p($strexportdragdrop)?>" />
    </td></tr></table>
 
	</form>
<?php
    echo $OUTPUT->box_end();
	echo "<hr />";
}
?>
