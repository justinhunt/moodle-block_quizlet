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
 * quizletquiz module admin settings and defaults
 *
 * @package    blocks
 * @subpackage quizletquiz
 * @copyright  2014 Justin Hunt (http://poodll.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    require_once("$CFG->libdir/resourcelib.php");

    //$displayoptions = resourcelib_get_displayoptions(array(RESOURCELIB_DISPLAY_OPEN, RESOURCELIB_DISPLAY_POPUP));
   // $defaultdisplayoptions = array(RESOURCELIB_DISPLAY_OPEN);

    //--- general settings -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_configcheckbox('quizletquiz/requiremodintro',
        get_string('requiremodintro', 'admin'), get_string('configrequiremodintro', 'admin'), 1));


    //--- modedit defaults -----------------------------------------------------------------------------------

	  $settings->add(new admin_setting_configtext('quizletquiz/apikey',
        get_string('apikey', 'block_quizletquiz'), get_string('apikeyexplain', 'block_quizletquiz'), 'YOUR API KEY', PARAM_TEXT));
		
	 $settings->add(new admin_setting_configtext('quizletquiz/apisecret',
        get_string('apisecret', 'block_quizletquiz'), get_string('apisecretexplain', 'block_quizletquiz'), 'YOUR API SECRET', PARAM_TEXT));
	
	//flashcards dimensions
    $settings->add(new admin_setting_heading('quizletquiz/flashcardsdimensions', get_string('acttype_flashcards', 'block_quizletquiz'), ''));
	$settings->add(new admin_setting_configtext('quizletquiz/flashcardswidth', 
			get_string('width', 'block_quizletquiz'), '', '100%', PARAM_TEXT));
	$settings->add(new admin_setting_configtext('quizletquiz/flashcardsheight', 
			get_string('height', 'block_quizletquiz'), '', '410', PARAM_INT));
	
	//scatter dimensions		
	 $settings->add(new admin_setting_heading('quizletquiz/scatterdimensions', get_string('acttype_scatter', 'block_quizletquiz'), ''));
	$settings->add(new admin_setting_configtext('quizletquiz/scatterwidth', 
			get_string('width', 'block_quizletquiz'), '', '100%', PARAM_TEXT));
	$settings->add(new admin_setting_configtext('quizletquiz/scatterheight', 
			get_string('height', 'block_quizletquiz'), '', '410', PARAM_INT));
	
	//learn dimensions		
	$settings->add(new admin_setting_heading('quizletquiz/learndimensions', get_string('acttype_learn', 'block_quizletquiz'), ''));
	$settings->add(new admin_setting_configtext('quizletquiz/learnwidth', 
			get_string('width', 'block_quizletquiz'), '', '100%', PARAM_TEXT));
	$settings->add(new admin_setting_configtext('quizletquiz/learnheight', 
			get_string('height', 'block_quizletquiz'), '', '410', PARAM_INT));
	
	//spelling dimensions		
	$settings->add(new admin_setting_heading('quizletquiz/spellerdimensions', get_string('acttype_speller', 'block_quizletquiz'), ''));
	$settings->add(new admin_setting_configtext('quizletquiz/spellerwidth', 
			get_string('width', 'block_quizletquiz'), '', '100%', PARAM_TEXT));
	$settings->add(new admin_setting_configtext('quizletquiz/spellerheight', 
			get_string('height', 'block_quizletquiz'), '', '410', PARAM_INT));
	
	//spacerace dimensions		
	$settings->add(new admin_setting_heading('quizletquiz/spaceracedimensions', get_string('acttype_spacerace', 'block_quizletquiz'), ''));
	$settings->add(new admin_setting_configtext('quizletquiz/spaceracewidth', 
			get_string('width', 'block_quizletquiz'), '', '100%', PARAM_TEXT));
	$settings->add(new admin_setting_configtext('quizletquiz/spaceraceheight', 
			get_string('height', 'block_quizletquiz'), '', '410', PARAM_INT));
			
	//test dimensions		
	$settings->add(new admin_setting_heading('quizletquiz/testdimensions', get_string('acttype_test', 'block_quizletquiz'), ''));
	$settings->add(new admin_setting_configtext('quizletquiz/testwidth', 
			get_string('width', 'block_quizletquiz'), '', '100%', PARAM_TEXT));
	$settings->add(new admin_setting_configtext('quizletquiz/testheight', 
			get_string('height', 'block_quizletquiz'), '', '410', PARAM_INT));
			
	//default times	
	$settings->add(new admin_setting_heading('quizletquiz/defaultmintime', get_string('defmintime_heading', 'block_quizletquiz'), ''));	
	$settings->add(new admin_setting_configtext('quizletquiz/def_flashcards_mintime', 
			get_string('acttype_flashcards', 'block_quizletquiz') , '', 180, PARAM_INT));
	$settings->add(new admin_setting_configtext('quizletquiz/def_scatter_mintime', 
			get_string('acttype_scatter', 'block_quizletquiz') , '', 120, PARAM_INT));
	$settings->add(new admin_setting_configtext('quizletquiz/def_spacerace_mintime', 
			get_string('acttype_spacerace', 'block_quizletquiz') , '', 420, PARAM_INT));
	$settings->add(new admin_setting_configtext('quizletquiz/def_learn_mintime', 
			get_string('acttype_learn', 'block_quizletquiz') , '', 360, PARAM_INT));
	$settings->add(new admin_setting_configtext('quizletquiz/def_speller_mintime', 
			get_string('acttype_speller', 'block_quizletquiz') , '', 360, PARAM_INT));
	$settings->add(new admin_setting_configtext('quizletquiz/def_test_mintime', 
			get_string('acttype_test', 'block_quizletquiz') , '', 420, PARAM_INT));
			
	//default completion
	$settings->add(new admin_setting_heading('quizletquiz/defaultcompletion', get_string('defcompletion_heading', 'block_quizletquiz'), ''));
	//The size of the youtube player on the various screens		
	$options = array(0 => new lang_string('no'),
						   1 => new lang_string('yes'));
					
	$settings->add(new admin_setting_configselect('quizletquiz/def_showcompletion', 
						new lang_string('showcompletion', 'block_quizletquiz'),'', 1, $options));
						
	$settings->add(new admin_setting_configselect('quizletquiz/def_showcountdown', 
						new lang_string('showcountdown', 'block_quizletquiz'),'', 1, $options));

}
