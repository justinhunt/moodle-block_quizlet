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
 * JavaScript library for the quizletimport module.
 *
 * @package    block
 * @subpackage quizlet
 * @copyright  2014 Justin Hunt  {@link http://poodll.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

M.block_quizlet = M.block_quizlet || {};


M.block_quizlet.iframehelper = {
	IF: null,
	SB: null,
        IF_width: 550,
        IF_height: 350,
	
    /**
     * @param Y the YUI object
     * @param start, the timer starting time, in seconds.
     * @param preview, is this a quiz preview?
     */
    init: function(Y,opts) {
    	// console.log('quizletimport:start:' + start +':countdown:' + showcountdown + ':showcompletion:' + showcompletion);
        M.block_quizlet.iframehelper.IF = Y.one('#' + opts['iframename']);
        M.block_quizlet.iframehelper.IF_width = opts['width'];
        M.block_quizlet.iframehelper.IF_height = opts['height'];
   
    },
    
    update: function(selectboxref){
        
    	//var quizletset = M.block_quizlet.iframehelper.SB.get('value');
        var sbr = Y.one('#' + selectboxref);
    	var quizletset = sbr.get('value');
        if(quizletset){
    		quizletset = quizletset.split('-')[0];
    	}
    	var newsrc = 'https://quizlet.com/' + quizletset + '/flashcards/embedv2';
        var IF =  M.block_quizlet.iframehelper.IF;
        IF.setAttribute('width',M.block_quizlet.iframehelper.IF_width);
        IF.setAttribute('height',M.block_quizlet.iframehelper.IF_height);
    	IF.setAttribute('src',newsrc);
    }

}; 