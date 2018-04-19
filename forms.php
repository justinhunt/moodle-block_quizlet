<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// This file is part of Moodle - http://moodle.org/                      //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//                                                                       //
// Moodle is free software: you can redistribute it and/or modify        //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation, either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// Moodle is distributed in the hope that it will be useful,             //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details.                          //
//                                                                       //
// You should have received a copy of the GNU General Public License     //
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.       //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * Forms for Quizlet Quiz Block
 *
 * @package    Quizlet Quiz
 * @author     Justin Hunt <poodllsupport@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Justin Hunt  http://poodll.com
 */

require_once($CFG->libdir . '/formslib.php');
require_once(dirname(__FILE__).'/quizlet.php');

define('BLOCK_QUIZLET_NO','0');
define('BLOCK_QUIZLET_MC_ABCSMALL','multichoice_abc');
define('BLOCK_QUIZLET_MC_ABCBIG','multichoice_ABCD');
define('BLOCK_QUIZLET_MC_123','multichoice_123');
define('BLOCK_QUIZLET_MC_NONE','multichoice_none');
define('BLOCK_QUIZLET_SA_CASE','shortanswer_1');
define('BLOCK_QUIZLET_SA_NOCASE','shortanswer_0');
define('BLOCK_QUIZLET_MATCHING','matching_0');


define ('BLOCK_QUIZLET_QQ_SELECTSET','block_quizlet_qq_selectset');
define ('BLOCK_QUIZLET_DD_SELECTSET', 'block_quizlet_dd_selectset');
define ('BLOCK_QUIZLET_IFRAME_NAME','block_quizlet_iframepreview');



abstract class block_quizlet_qq_form extends moodleform {

    function tablify($elarray, $colcount, $id, $haveheader=true){
		$mform = & $this->_form;
		
		$starttable =  html_writer::start_tag('table',array('class'=>'block_quizlet_form_table'));
		//$startheadrow=html_writer::start_tag('th'); 
		//$endheadrow=html_writer::end_tag('th'); 
		$startrow=html_writer::start_tag('tr'); 
		$startcell = html_writer::start_tag('td',array('class'=>'block_quizlet_form_cell block_quizlet_' . $id .'_col_@@'));
		$startheadcell = html_writer::start_tag('th',array('class'=>'block_quizlet_form_cell block_quizlet_' . $id .'_col_@@'));
		$endcell=html_writer::end_tag('td');
		$endheadcell=html_writer::end_tag('th');
		$endrow=html_writer::end_tag('tr');
		$endtable = html_writer::end_tag('table');
		
		//start the table 
		$tabledelements = array();
		$tabledelements[]=& $mform->createElement('static', 'table_start_' . $id, '', $starttable);
	
		
		//loop through rows
		for($row=0;$row<count($elarray);$row= $row+$colcount){
			//loop through cols
			for($col=0;$col<$colcount;$col++){
				//addrowstart
				if($col==0){
					$tabledelements[]=& $mform->createElement('static', 'tablerow_start_' . $id . '_' . $row, '', $startrow);
				}
				//add a th cell if this is first row, otherwise a td
				if($row==0 && $haveheader){
					$thestartcell = str_replace('@@', $col,$startheadcell);
					$theendcell = $endheadcell;
				}else{
					$thestartcell = str_replace('@@', $col,$startcell);
					$theendcell = $endcell;
				}
				$tabledelements[]=& $mform->createElement('static', 'tablecell_start_' . $id . '_' . $row .'_'. $col, '', $thestartcell);
				$tabledelements[]=& $elarray[$row+$col];
				$tabledelements[]=& $mform->createElement('static', 'tablecell_end_' . $id . '_' . $row .'_'. $col, '', $theendcell);

				//add row end
				if($col==$colcount-1){
					$tabledelements[]=& $mform->createElement('static', 'tablerow_end_' . $id . '_' . $row, '', $endrow);
				}
			}//end of col loop	
		}//end of row loop
		
		//close out our table and return it
		$tabledelements[]=& $mform->createElement('static', 'table_end_' . $id, '', $endtable);
		return $tabledelements;
	}
}


class block_quizlet_export_form extends block_quizlet_qq_form  {

    public function definition() {
        global $CFG, $USER, $OUTPUT, $PAGE,$COURSE;
        $strrequired = get_string('required');
        $mform = & $this->_form;  
        $exporttype= $this->_customdata['exporttype'];
        $qsets = $this->_customdata['qsets'];
		$sections = $this->_customdata['sections'];
        
        //add a little explanation
         $mform->addElement('static','qq_selectexplanation','',get_string('selectinstructions','block_quizlet'));
        
       //Get a list of quizlets
       $selectedsets = $mform->addElement('select', 'selectedsets', 
                get_string('availablesets','block_quizlet'),$qsets,array('id'=>BLOCK_QUIZLET_QQ_SELECTSET));
       
       //$mform->setType('selectedsets', PARAM_TEXT);
       $selectedsets->setMultiple(true);
      //$previewlink = html_writer::link('',get_string('previewset','block_quizlet'),array('onclick'=>''));
       $previewbutton = html_writer::tag('input',null,
                array('type'=>'button',
                    'value'=>get_string('previewset','block_quizlet'),
                    'class'=>'block_quizlet_previewbutton',
                    'name'=>'selectsetsubmit',
                    'onClick'=>'M.block_quizlet.iframehelper.update(\'' . BLOCK_QUIZLET_QQ_SELECTSET . '\')'));
       $mform->addElement('static','qq_preview_button','',$previewbutton);
       
        //show preview iframe inform
       $renderer = $PAGE->get_renderer('block_quizlet');
       $previewiframe = $renderer->display_preview_iframe(BLOCK_QUIZLET_IFRAME_NAME);
       $mform->addElement('static','dd_preview_iframe','',$previewiframe);
       

       //activity types
        $attributes = array();
        $act_array=array();
        $activities = array('flashcards' => get_string('acttype_flashcards', 'block_quizlet'),
				'scatter'=>get_string('acttype_scatter', 'block_quizlet'),
				'spacerace'=>get_string('acttype_spacerace', 'block_quizlet'),
				'test'=>get_string('acttype_test', 'block_quizlet'),
				'speller'=>get_string('acttype_speller', 'block_quizlet'),
				'learn'=>get_string('acttype_learn', 'block_quizlet'));
        foreach ($activities as $aid=>$atitle){
                 $act_array[] =& $mform->createElement('advcheckbox', $aid,'',$atitle,array('group'=>1),array(0, $aid));
        }	
        $act_arraytable = $this->tablify($act_array,1, 'act_table',false);
    
      
         //multichoice questions
        $attributes = array();
        $mc_array=array();
        $mc_array[] =& $mform->createElement('radio', 'multichoice', '', get_string('nomultichoice','block_quizlet'), BLOCK_QUIZLET_NO, $attributes);
        $mc_array[] =& $mform->createElement('radio', 'multichoice', '', get_string('answernumberingabc', 'qtype_multichoice'), BLOCK_QUIZLET_MC_ABCSMALL, $attributes);
        $mc_array[] =& $mform->createElement('radio', 'multichoice', '', get_string('answernumberingABCD', 'qtype_multichoice'), BLOCK_QUIZLET_MC_ABCBIG, $attributes);
        $mc_array[] =& $mform->createElement('radio', 'multichoice', '', get_string('answernumbering123', 'qtype_multichoice'), BLOCK_QUIZLET_MC_123, $attributes);
        $mc_array[] =& $mform->createElement('radio', 'multichoice', '', get_string('answernumberingnone', 'qtype_multichoice'), BLOCK_QUIZLET_MC_NONE, $attributes);
        $mc_arraytable = $this->tablify($mc_array,1, 'mc_table',false);
         
        //short answer questions
         $attributes = array();
        $sa_array=array();
        $sa_array[] =& $mform->createElement('radio', 'shortanswer', '', get_string('noshortanswer', 'block_quizlet'), BLOCK_QUIZLET_NO, $attributes);
        $sa_array[] =& $mform->createElement('radio', 'shortanswer', '', get_string('shortanswer_1', 'block_quizlet'), BLOCK_QUIZLET_SA_CASE, $attributes);
        $sa_array[] =& $mform->createElement('radio', 'shortanswer', '', get_string('shortanswer_0', 'block_quizlet'), BLOCK_QUIZLET_SA_NOCASE, $attributes);
        $sa_arraytable = $this->tablify($sa_array,1, 'sa_table',false);
        
        //matching question
        $attributes = array();
        $matching_array=array();
        $matching_array[] =& $mform->createElement('radio', 'matching', '', get_string('nomatching','block_quizlet'), BLOCK_QUIZLET_NO, $attributes);
        $matching_array[] =& $mform->createElement('radio', 'matching', '', get_string('yesmatching', 'block_quizlet'), BLOCK_QUIZLET_MATCHING, $attributes);
        $matching_arraytable = $this->tablify($matching_array,1, 'matching_table',false);


        switch($exporttype){
            case 'qq':
            case 'qq_direct':
                $mform->addElement('static','qq_qchoiceexplanation','',get_string('qchoiceinstructions','block_quizlet'));
                $mform->addGroup($sa_arraytable, 'shortanswer_group',get_string('shortanswer','block_quizlet'), array(' '), false);
                $mform->addGroup($mc_arraytable, 'multichoice_group',get_string('multichoice','block_quizlet'), array(' '), false);
                $mform->addGroup($matching_arraytable, 'matching_group',get_string('matching','block_quizlet'), array(' '), false);
                
                $answerside_array=array('0'=>get_string('termasanswer','block_quizlet'),'1'=>get_string('definitionasanswer','block_quizlet'));
                
                //add a little explanation
                $mform->addElement('static','answersideinstructions',get_string('answerside','block_quizlet'),get_string('answersideinstructions','block_quizlet'));
                $mform->addElement('select','answerside','',$answerside_array);
        
                        
                
                break;
            case 'dd':
            case 'dd_direct':
               //add a little explanation
                $mform->addElement('static','qq_actchoiceexplanation','',get_string('actchoiceinstructions','block_quizlet'));
                $mform->addGroup($act_arraytable, 'activitytype_group', get_string('activitytypes','block_quizlet'), array(' '), false);
           }
		   
		//Course Sections   
        if($exporttype=='dd_direct'){
			 //Get a list of course sections, explain the deal first
			$mform->addElement('static','qq_sectionchoiceexplanation','',get_string('sectionchoiceinstructions','block_quizlet'));
			
			$mform->addElement('select', 'section', 
                get_string('coursesection','block_quizlet'),$sections);
		}
		
		
        //courseid
        $mform->addElement('hidden', 'courseid');
        $mform->setType('courseid', PARAM_INT);
       
        //export type
	$mform->addElement('hidden', 'exporttype',$exporttype);
        $mform->setType('exporttype', PARAM_TEXT);
        
        //cm id
        $mform->addElement('hidden', 'id', 0);
        $mform->setType('id', PARAM_INT);
        
	$mform->addElement('hidden', 'action','qq_dataexport');
        $mform->setType('action', PARAM_TEXT);
       switch($exporttype){
           case 'qq':
                $this->add_action_buttons(true,get_string('exporttoquestionsheader','block_quizlet'));
               break;
           case 'qq_direct':
                $this->add_action_buttons(true,get_string('exporttoquestionsdirectheader','block_quizlet'));
               break;
            case 'dd':
                $this->add_action_buttons(true,get_string('exporttoddropheader','block_quizlet'));
                break;
            case 'dd_direct':
                $this->add_action_buttons(true,get_string('exporttoddropdirectheader','block_quizlet'));
                break;
       }
    }//end of definition method
    /*
    function validation($data,$files){
        return array();
    }
    
     */
	
}//end of class


class block_quizlet_search_form extends quizlet_search_form_qq {
     public function definition() {
        $mform = & $this->_form;
	$mform->addElement('hidden', 'exporttype',$this->_customdata['exporttype']);
        $mform->setType('exporttype', PARAM_TEXT);
        parent::definition();
     }
    
}