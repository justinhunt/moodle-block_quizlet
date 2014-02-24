<?php   // $Id: exportfile.php,v 1.8 2007/08/17 12:49:31 skodak Exp $
	define('BGETQ_CONCEPT',      '0');
	define('BGETQ_FIRSTMODIFIED', '2');
	define('BGETQ_LASTMODIFIED', '1');
	define('BGETQ_RANDOMLY',     '3');

	global $SESSION, $DB;	
	
    require_once("../../config.php");
    require_once("../../lib/filelib.php");
	//
	//
	//
	//
    $id = required_param('id', PARAM_INT);      // Course Module ID
    $cat = optional_param('cat',0, PARAM_ALPHANUM);
    $limitnum = optional_param('limitnum',0, PARAM_ALPHANUM);
    $sortorder = optional_param('sortorder',0, PARAM_ALPHANUM);
    $entriescount = optional_param('entriescount',0, PARAM_ALPHANUM);
    $questiontype =  optional_param('questiontype',0, PARAM_ALPHANUMEXT);  
    if (! $cm = get_coursemodule_from_id('glossary', $id)) {
        error("Course Module ID was incorrect");
    }

    if (! $course = $DB->get_record("course", array('id' => $cm->course))) {
        error("Course is misconfigured");
    }

    if (! $glossary = $DB->get_record("glossary", array('id'=>$cm->instance))) {
        error("Course module is incorrect");
    }

    require_login($course->id, false, $cm);
    
    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
    require_capability('block/quizletquiz:export', $context);

    $filename = clean_filename(strip_tags(format_string($glossary->name,true)).'.xml');
    $giftcategoryname = $glossary->name;
    
    $limitfrom = 0;
    switch ($sortorder) {
			case BGETQ_RANDOMLY:
				if (!isset($limitnum)) {
					$limitnum = 0;
				}
				$i = rand(1,$entriescount - $limitnum);
                $limitfrom = $i-1;
				$sortorder = '';
				break;
			case BGETQ_CONCEPT:
				$sortorder = 'ORDER BY concept ASC';
				break;
			case BGETQ_FIRSTMODIFIED:
				$sortorder = 'ORDER BY timemodified ASC';
				break;
			case BGETQ_LASTMODIFIED:
				$sortorder = 'ORDER BY timemodified DESC';
				break;
	}
    if ($limitnum) {
    	$limit = "LIMIT $limitfrom, $limitnum ";
    } else {
    	$limit = '';
    }
	
    $catfrom = "";
    $catwhere = "";
	
	if ($cat) {
		$category = $DB->get_record('glossary_categories', array('id'=>$cat));
        $categoryname = $category->name;     	
    	$giftcategoryname .= '_'.$categoryname;
    	$catfrom = ", mdl_glossary_entries_categories c ";
    	$catwhere = "and ge.id = c.entryid and c.categoryid = $cat";
	}    	
	$sql = "SELECT * FROM ".$CFG->prefix."glossary_entries ge $catfrom "
    . "WHERE ge.glossaryid = $glossary->id "
    . "AND ge.approved "
    . "$catwhere "
    . "$sortorder "
    . "$limit";
    
    // build XML file - based on moodle/question/xml/format.php
    // add opening tag
    $expout = "";
    $counter=0;

    $expout .= "\n\n<!-- question: $counter  -->\n";
            
           $categorypath = writetext( $giftcategoryname );
           $expout .= "  <question type=\"category\">\n";
           $expout .= "    <category>\n";
           $expout .= "        $categorypath\n";
           $expout .= "    </category>\n";
           $expout .= "  </question>\n";        
    	$context = get_context_instance(CONTEXT_MODULE, $cm->id);
           
    if ( $entries = $DB->get_records_sql($sql) ) {
        $questiontype_params = explode("_", $questiontype);
    	$questiontype = $questiontype_params[0];
        if ($questiontype == 'multichoice') {
            $answernumbering = $questiontype_params[1]; 
        	$concepts = array();    
            foreach ($entries as $entry) {
                $concepts[] = $entry->concept;          
            }
        } else {
        	$usecase = $questiontype_params[1];
        }
		foreach ($entries as $entry) {
    		$counter++;
            $definition = trusttext_strip($entry->definition);
            $fs = get_file_storage();            
            $entryfiles = $fs->get_area_files($context->id, 'mod_glossary', 'entry', $entry->id);
            $concept = trusttext_strip($entry->concept);
        	$expout .= "\n\n<!-- question: $counter  -->\n";            
    		$name_text = writetext( $concept );
            $qtformat = "html";
            $expout .= "  <question type=\"$questiontype\">\n";
            $expout .= "    <name>$name_text</name>\n";
            $expout .= "    <questiontext format=\"$qtformat\">\n";
            $expout .= writetext( $definition );;
            $expout .= writefiles($entryfiles);
            $expout .= "    </questiontext>\n";

		if ($questiontype == 'multichoice') {
                $expout .= "    <shuffleanswers>true</shuffleanswers>\n";
                $expout .= "    <answernumbering>".$answernumbering."</answernumbering>\n";
                $concepts2 = $concepts;
                foreach ($concepts2 as $key => $value) {
                   if ($value == $concept) {
                       unset($concepts2[$key]);
                    }
                }
                $rand_keys = array_rand($concepts2, 3);
                for ($i=0; $i<4; $i++) {
                    if ($i === 0) {
                        $percent = 100;
                        $expout .= "      <answer fraction=\"$percent\">\n";
                        $expout .= writetext( $concept,3,false )."\n";
                        $expout .= "      <feedback>\n";
                        $expout .= "      <text>\n";
                        $expout .= "      </text>\n";
                        $expout .= "      </feedback>\n";                    
                        $expout .= "    </answer>\n";
                    } else {
                        $percent = 0;
                        $distracter = $concepts2[$rand_keys[$i-1]];
                        $expout .= "      <answer fraction=\"$percent\">\n";
                        $expout .= writetext( $distracter,3,false )."\n";
                        $expout .= "      <feedback>\n";
                        $expout .= "      <text>\n";
                        $expout .= "      </text>\n";
                        $expout .= "      </feedback>\n";
                        $expout .= "    </answer>\n";
                    }
                }
            } else { // shortanswer
                
                $expout .= "    <usecase>$usecase</usecase>\n ";
                $percent = 100;
                $expout .= "    <answer fraction=\"$percent\">\n";
                $expout .= writetext( $concept,3,false );
                $expout .= "    </answer>\n";
            }
            // close the question tag
            $expout .= "</question>\n";
        }
    }
        // initial string;
        // add the xml headers and footers
        $content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
                       "<quiz>\n" .
                       $expout . "\n" .
                       "</quiz>";

        // make the xml look nice
	$content = xmltidy( $content );	
	// reset glossary export	
	$SESSION->block_quizletquiz->status = '';
	
	send_file($content, $filename, 0, 0, true, true);    
	
    /**
     * generates <text></text> tags, processing raw text therein
     * @param int ilev the current indent level
     * @param boolean short stick it on one line
     * @return string formatted text
     */
    function writetext($raw, $ilev = 0, $short = true) {
        $indent = str_repeat('  ', $ilev);

        // if required add CDATA tags
        if (!empty($raw) and (htmlspecialchars($raw) != $raw)) {
            $raw = "<![CDATA[$raw]]>";
        }

        if ($short) {
            $xml = "$indent<text>$raw</text>";
        } else {
            $xml = "$indent<text>\n$raw\n$indent</text>\n";
        }

        return $xml;
    }

    function writefiles($files, $encoding='base64') {
        if (empty($files)) {
            return '';
        }
        $string = '';
        foreach ($files as $file) {
            if ($file->is_directory()) {
                continue;
            }
            $string .= '<file name="' . $file->get_filename() . '" encoding="' . $encoding . '">';
            $string .= base64_encode($file->get_content());
            $string .= '</file>';
        }
        return $string;
    }
    
	function xmltidy( $content ) {
        // can only do this if tidy is installed
        if (extension_loaded('tidy')) {
            $config = array( 'input-xml'=>true, 'output-xml'=>true, 'indent'=>true, 'wrap'=>0 );
            $tidy = new tidy;
            $tidy->parseString($content, $config, 'utf8');
            $tidy->cleanRepair();
            return $tidy->value;
        }
        else {
            return $content;
        }
    }	
?>