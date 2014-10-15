<?php 
$string['allentries'] = 'All entries';
$string['clicktoexport'] = 'Click to export this quizlet sets entries to quiz (XML)';
$string['concept'] = 'Alphabetical order';
$string['emptyglossaries'] = 'These quizlet sets are empty (no entries)';
$string['emptyglossary'] = 'This quizlet set is empty (no entries)';
$string['exportentriestoxml'] = 'Export entries to Quiz (XML)';
$string['firstmodified'] = 'Oldest entries first';
$string['lastmodified'] = 'Most recent entries first';
$string['limitnum'] = 'Maximum number of entries to export';
$string['limitnum_help'] = 'Leave empty to export all entries from selected quizlet set. 
This option can be useful for exporting a limited number of entries from very large sets.';
$string['multichoice'] = 'Multiple Choice';
$string['notenoughentries'] = 'Not enough entries (<b>{$a->numentries}</b>) in <b>Glossary</b> <em>{$a->varnotenough}</em> for Multichoice questions.'; 
$string['numentries'] = 'Export {$a} entries';
$string['noglossaries'] = 'No glossaries in this course';
$string['nolink'] = 'Remove glossary autolinks';
$string['notyetconfigured'] = 'Please <b>Turn editing on</b> to configure this block.';
$string['notyetconfiguredediting'] = 'Please configure this block using the edit icon.';
$string['pluginname'] = 'QuizletQuiz';
$string['questiontype'] = 'Question type:';
$string['questiontype_help'] = 'Quizlet entries can be exported to the Quiz Questions bank either as multiple choice or short answer questions.
Multiple choice questions will consist of the following elements:

* question text = quizlet entry definition
* correct answer = quizlet entry concept
* distracters = 3 quizlet entry concepts randomly selected from the glossary (or glossary category) that you have selected.

Short answer questions

* Case insensitive. Student responses will be accepted as correct regardless of the original glossary entry concept case (uppercase or lowercase).
** Example: original entry "Moodle". Accepted correct responses: "Moodle", "moodle".
* Case sensitive. Student responses will be only be accepted as correct it the case of the original glossary entry concept is used..
** Example: original entry "Moodle". Accepted correct response: "Moodle".';
$string['random'] = 'Randomly';
$string['selectquizletset'] = 'Select Quizlet Set to export from';
$string['selectquizletset_help'] = 'Use the dropdown list to select the quizlet set that you want to use to export its entries to the quiz questions bank. 
To cancel your choice or to reset the block, simply leave the dropdown list on the Choose... position.';
$string['shortanswer'] = 'Short answer';
$string['shortanswer_0'] = 'Short answer (Case insensitive)';
$string['shortanswer_1'] = 'Short answer (Case sensitive)';
$string['sortingorder'] = 'Sorting Order';
$string['sortingorder_help'] = 'Use this setting to determine how the exported quizlet set entries will be ordered when you import them to your questions data bank.
This can be used, in combination with the Maximum number of entries, for creating a quiz to test the latest entries to your glossary (especially a fairly large one). ';
$string['quizlettoquizzes'] = 'Quizlet to Quizzes';
$string['noquizletsets'] = 'No Quizlet Sets';

$string['displayoptions'] = 'qi display options';
$string['configdisplayoptions'] = 'qi cfg display options';
$string['printheading'] = 'qi printheading';
$string['printheadingexplain'] = 'qi printheading expl';

$string['apikey'] = 'API Key';
$string['apisecret'] = 'API Secret';
$string['apikeyexplain'] = 'This can be generated over at quizlet.com';
$string['apisecretexplain'] = 'This can be generated over at quizlet.com';

$string['usersets'] = 'Users Quizlet Sets';
$string['availablesets'] = 'Quizlet Sets';
$string['quizletloginlabel'] = 'Quizlet Login';
$string['quizletlogin'] = 'Login and confirm with quizlet to access your quizlet sets';
$string['quizleterror'] = 'Quizlet Error';
$string['activitytype'] = 'Activity Type';
$string['acttype_flashcards'] = 'Flashcards';
$string['acttype_scatter'] = 'Scatter';
$string['acttype_speller'] = 'Speller';
$string['acttype_learn'] = 'Learn';
$string['acttype_spacerace'] = 'Space Race';
$string['acttype_test'] = 'Test';
$string['acttype_moodlequiz'] = 'Moodle Quiz';

$string['mintime'] = 'Minimum Time Required';
$string['mintimedetails'] = 'If set to 0, the minimum time will be taken from the default settings on the configuration page for the Quizlet Import module in site administration.';
$string['width'] = 'width';
$string['height'] = 'height';
$string['completed'] = 'Activity Complete';
$string['timeleft'] = 'Time till complete:';
$string['showcountdown'] = 'Show Countdown to Completion';
$string['showcompletion'] = 'Show Completion Label when Complete';
$string['createquizletimport'] = 'Create Quizlet Activity';
$string['quizletsetinput'] = 'Quizlet Set ID';
$string['exporttofileheader'] = 'Export Quizlet Sets';
$string['exportqqfile'] = 'Export quizlet set(s) to question import file';
$string['exportqqdirect'] = 'Export quizlet set(s) to question bank';
$string['exportddfile'] = 'Export quizlet set(s) to drag and drop file';
$string['exportdddirect'] = 'Export quizlet set(s) to Quizlet Import activities';
$string['createmquiz'] = 'Create Moodle Quiz';
$string['shortanswer'] = 'Short answer';
$string['shortanswer_0'] = 'Short answer (Case insensitive)';
$string['shortanswer_1'] = 'Short answer (Case sensitive)';
$string['multichoice'] = 'Multiple Choice';
$string['defmintime_heading'] = 'Default Minimum Time Per activity (seconds)';
$string['defcompletion_heading'] = 'Default Completion Settings';
$string['searchtitles'] = 'Search by Title and Subject';
$string['searchterms'] = 'Search by Term';
$string['searchusers'] = 'Search by User';
$string['searchmysets'] = 'Fetch My Sets';
$string['exporttofileheader'] = 'Export Quizlet Sets';
$string['exporttoquestionsheader'] = 'Export To Moodle Questions File(XML Format)';
$string['exporttoddropheader'] = 'Export To Moodle Drag and Drop File';
$string['exporttoquestionsdirectheader'] = 'Export To Moodle Question Bank';
$string['exporttoddropdirectheader'] = 'Export To Moodle QuizletImport Activity';
$string['selectforexport'] = 'Select Quizlet Set(s) to perform exports from.';
$string['searchdetails'] = 'Search for Quizlet Sets to perform exports from.';
$string['exporttoquestions'] = 'Select quizlet set(s) and question options. Press the button to export to questions that can be imported into Moodle. <br />';
$string['exporttoddrop'] = 'Select quizlet set(s) and activity types. Press the button to export to questions to strings that can be dragged and dropped onto a course page to create quizlet activities quickly.<br />';
$string['previewset'] = 'Preview selected set (below)';
$string['noshortanswer'] = 'No Short Answer Questions';
$string['nomultichoice'] = 'No Multiple Choice Questions';
$string['answernumberingnone'] = 'Un-numbered';
$string['activitytypes'] = 'Activity Types';
$string['selectinstructions'] = 'Select one or more quizlet sets from the list below for export. If no lists are shown, use the search form above to search for Quizlet sets.';
$string['qchoiceinstructions'] = 'Select at least one question option from the question types below for export.';
$string['actchoiceinstructions'] = 'Select at least one activity type from the question types below for export.';
$string['dd_exportlink'] = 'Export to Activity Import File<br />';
$string['qq_exportlink'] = 'Export to Question Import File<br />';
$string['dd_direct_exportlink'] = 'Export Activities to Current Course<br />';
$string['qq_direct_exportlink'] = 'Export Questions to Question Bank<br />';
$string['nomatching'] = 'No Matching Questions';
$string['yesmatching'] = 'Make Matching Questions';
$string['matching'] = 'Matching Questions';
$string['noquestiontype'] = 'You did not select any question types to export.';
$string['noactivitytype'] = 'You did not select any activity types to export.';
$string['noselectedset'] = 'You did not select any quizlet sets to export.';
$string['matchingquestiontext'] = 'Match the items on the left hand side, with the correct items from the right hand side.';
$string['matchingsubcount'] = 'Matching Question Sub-Question Count';
$string['matchingsubcount_details'] = 'The number of matching-pairs to be contained within a single generated matching question.';


$string['searchtitles'] = 'Search by Title and Subject';
$string['searchterms'] = 'Search by Term';
$string['searchusers'] = 'Search by User';
$string['searchmysets'] = 'Fetch My Sets';
$string['searchtext'] = 'Search Terms';
$string['answerside'] = 'Answer Side';
$string['termasanswer'] = 'The front side/term of the card.(default)';
$string['definitionasanswer'] = 'The reverse side/definition of the card.';
$string['answersideinstructions'] = 'The front face of a flashcard is by default the "term" and the reverse side the "definition." When exporting as questions, usually the term is the question answer. Some quizlet sets may not suit this. In that case it is possible here to select the "definition" as the answer. NB Images will not be used as question answers, so the default is the best option for Quizlet sets with images.';

$string['quizletquiz:addinstance'] = 'Add Quizlet Quiz block';
$string['quizletquiz:myaddinstance'] = 'Add Quizlet Quiz block to MyHome';
$string['quizletquiz:view'] = 'View Quizlet Quiz block';
$string['quizletquiz:export'] = 'Export Quizlet Quiz block';