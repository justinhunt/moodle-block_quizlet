<?php // $Id: block_quizletquiz.php,v 1.0. 2010/11/27 01:01:01 rezeau Exp $

class block_quizletquiz extends block_base {
    function init() {
        $this->title = get_string('pluginname','block_quizletquiz');
       // $SESSION->block_quizletquiz->status = '';
    }
    
    function has_config() {
        return true;
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
        
       // if(($this->content == null)){
            
            $this->content = new stdClass;
            $url = new moodle_url('/blocks/quizletquiz/export_to_quiz.php', array('courseid'=>$course->id));
            $this->content->text = "<a href='" . $url->out(false). "'>quizleting</a>";
            $this->content->footer = '';
  			return $this->content;
       // }
        
        
    }
}
?>