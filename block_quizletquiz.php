<?php // $Id: block_quizletquiz.php,v 1.0. 2010/11/27 01:01:01 rezeau Exp $

class block_quizletquiz extends block_base {
    function init() {
        $this->title = get_string('pluginname','block_quizletquiz');
       // $SESSION->block_quizletquiz->status = '';
    }

    function specialization() {
        global $CFG, $DB, $OUTPUT, $PAGE;
       // $this->config->title = get_string('pluginname','block_quizletquiz');
        $course = $this->page->course;
        $this->course = $course;
    }
    
    function instance_allow_multiple() {
    // Are you going to allow multiple instances of each block?
    // If yes, then it is assumed that the block WILL USE per-instance configuration
        return false;
    }
    
    function get_content() {
        global $USER, $CFG, $DB, $PAGE, $SESSION;
        $editing = $PAGE->user_is_editing();

        // set view block permission to course:mod/glossary:export to prevent students etc to view this block
        $course = $this->page->course; 
        $context = context_course::instance($course->id);
        if (!has_capability('block/quizletquiz:export', $context)) {
            return;
        }
        
        if(($this->content == null)){
            
            $this->content = new stdClass;
            $this->content->text = '';
            $this->content->footer = '';
  
        }
        
        
        // get list of all current course glossaries
        $glossaries = $DB->get_records_menu('glossary', array('course' => $this->course->id));        
        
        // no glossary available in current course -> return
        if(empty($glossaries)) {
            $strglossarys = get_string("quizlettoquizzes", "block_quizletquiz");
            $this->content->text = get_string('thereareno', 'moodle', $strglossarys);
            $this->content->footer = '';
            return $this->content;
        }
        
        if (empty($SESSION->block_quizletquiz->status) ) {
            if ($editing) {
                $this->content->text   = get_string('notyetconfiguredediting','block_quizletquiz');
        	} else {
                $this->content->text   = get_string('notyetconfigured','block_quizletquiz');
        	} 
        	
            $this->content->footer = '';
            return $this->content;
        }

        if (strpos($this->config->glossary, ',')) {
	        $glossary = explode(",",$this->config->glossary);
	        $glossaryid = $glossary[0];
	        $categoryid = $glossary[1];        	
        } else {
        	$glossaryid = $this->config->glossary;
        	$categoryid = '';
        }

        $cm = get_coursemodule_from_instance("glossary", $glossaryid);
        $cmid = $cm->id;
        $glosssaryname = "<em>$cm->name</em>"; 

        require_once($CFG->dirroot.'/course/lib.php');
        // build "content" to be displayed in block
        // user may have requested a glossary category
        $categories = explode(",",$this->config->glossary);
        $glossaryid = $categories[0];
        $entriescount = 0;
        $numentries = 0;
        if (isset ($categories[1])) {
            $categoryid = $categories[1];
            $category = $DB->get_record('glossary_categories', array('id' => $categoryid));
            $entriescount = $DB->count_records("glossary_entries_categories", array('categoryid'=>$category->id));     
            $categoryname = '<b>'.get_string('category','glossary').'</b>: <em>'.$category->name.'</em>';           
        } else {
            $categoryid = '';
            $entriescount = $DB->count_records("glossary_entries", array('glossaryid'=>$glossaryid));            
            $categoryname = '<b>'.get_string('category','glossary').'</b>: '.get_string('allentries','block_quizletquiz');
        }
        $limitnum = $this->config->limitnum;        
        
        if ($limitnum) {
            $numentries = min($limitnum, $entriescount);
            $limitnum = $numentries;            
        } else {
            $numentries = $entriescount;
        }

        $strnumentries = '<br />'.get_string('numentries', 'block_quizletquiz', $numentries);
        
        $sortorder = $this->config->sortingorder;
        $type[0] = get_string('concept','block_quizletquiz');  
        $type[1] = get_string('lastmodified','block_quizletquiz');
        $type[2] = get_string('firstmodified','block_quizletquiz');        
        $type[3] = get_string('random','block_quizletquiz');
 
        $questiontype[0] = 'multichoice_abc';
        $questiontype[1] = 'multichoice_ABCD';
        $questiontype[2] = 'multichoice_123';
        $questiontype[3] = 'multichoice_none';
        $questiontype[4] = 'shortanswer_0'; // case insensitive
        $questiontype[5] = 'shortanswer_1'; // case sensitive
        
        $questiontype = $questiontype[$this->config->questiontype];
        $actualquestiontype_params = explode('_', $questiontype);
        $actualquestiontype = $actualquestiontype_params[0];
        $actualquestionparam = $actualquestiontype_params[1];
        
        $stractualquestiontype = get_string($actualquestiontype, 'block_quizletquiz'); 
        $strsortorder = '<b>'.get_string('sortingorder','block_quizletquiz').'</b>: '.$type[$sortorder];
        $strquestiontype = '<b>'.get_string('questiontype','block_quizletquiz').'</b> '.$stractualquestiontype;
        $cm = get_coursemodule_from_instance("glossary", $glossaryid);
        $cmid = $cm->id;
        $glosssaryname = "<em>$cm->name</em>"; 
        $title = get_string('clicktoexport','block_quizletquiz');
        $strglossary = get_string('currentglossary','glossary');
        if (($actualquestiontype == 'multichoice') && $numentries < 4) {
            $varnotenough = $glosssaryname.' | '.$categoryname;
            $this->content->text = get_string('notenoughentries','block_quizletquiz', 
                array('numentries'=>$numentries, 'varnotenough'=>$varnotenough));
            return $this->content;
        }
        $this->content->text   = '<b>'.$strglossary.'</b>: '.$glosssaryname.'<br />'.$categoryname.'<br />'.
            $strsortorder. '<br />'.$strquestiontype;
        $this->content->footer = '<a title="'.$title.'" href='
            .$CFG->wwwroot.'/blocks/quizletquiz/export_to_quiz.php?id='
            .$cmid.'&amp;cat='.$categoryid.'&amp;limitnum='.$limitnum.'&amp;questiontype='.$questiontype
            .'&amp;sortorder='.$sortorder.'&amp;entriescount='.$numentries.'>'
            .'<b>'.$strnumentries.'</b></a>';
            return $this->content;
    }
}
?>