<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Form for editing HTML block instances.
 *
 * @package   quizletquiz
 * @copyright 2014 Justin Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Form for exporting quizlet sets to Moodle quizzes.
 *
 * @copyright 2014 Justin Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot.'/mod/quizletimport/quizlet.php');

class block_quizletquiz_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $DB, $SESSION;
        //$SESSION->block_quizletquiz->status = 'defined';
        
        //Initialize Quizlet and deal with oauth etc
        //i  - send off to auth screen
        //ii - arrive back unauth, but with oauth2code
        //iii - complete auth by getting access token
        $args = array('api_scope' => 'read');
        $qiz  = new quizlet($args);
        $oauth2code = optional_param('oauth2code', 0, PARAM_RAW);
        $qmessage = false;
        if(!$qiz->is_authenticated() && $oauth2code){
                $result  = $qiz->get_access_token($oauth2code);
                if(!$result['success']){
                        $qmessage = $result['error'];
                }
        }


        //if authenticated fill our select box with users sets
        //otherwise show a login/authorize link
        if($qiz->is_authenticated()){
            $endpoint = 'users/@username@/sets';
            $params = null;
            /*
            $params=array();
            $params['term']='silla';
            $params['q']='spanish';
            $endpoint = '/search/sets';
            */

            $mysets = $qiz->request($endpoint,$params);
            if($mysets['success']){
                    $options = array();
                    foreach ($mysets['data'] as $quizletset){
                            $options[$quizletset->id] = $quizletset->title;
                    }
                    //$attributes = array('size'=>5);
                    $selectset = $mform->addElement('select', 'quizletset', get_string('usersets', 'quizletimport'), $options);
                    $selectset->setMultiple(false);
            }else{
                    $qmessage =  $mysets['error'];
            }
         }else{
             //show a login button
            $mform->addElement('static', 'quizletauthorize', get_string('quizletloginlabel', 'quizletimport'), '<a href="' . $qiz->fetch_auth_url() . '">' . get_string('quizletlogin', 'quizletimport') . '</a>');
            $mform->addElement('text', 'quizletset', get_string('quizletsetinput', 'quizletimport'),array('size' => '64'));
            $mform->setType('quizletset', PARAM_TEXT);                             
              
         }
         
        //if along the way we got an error back from quizlet, lets display it.
        if($qmessage){
                $mform->addElement('static', 'quizleterror', get_string('quizleterror', 'quizletimport'), $qmessage);
        }
        
       }//end of if
    }//end of func
