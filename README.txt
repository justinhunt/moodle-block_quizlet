25/09/2011 10:08:33
-------------------------------------------
How to install on a moodle 2.0 or 2.1 site.
-------------------------------------------
If you downloaded this zip archive from the new moodle.org plugins page
1.- Unzip the zip archive to your local computer.
2.- This will give you a folder named "quizletquiz".
3.- GO TO STEP 4 below
---
If you downloaded this zip archive from https://github.com/rezeau
1.- Unzip the zip archive you downloaded from github to your local computer.
2.- This will give you a folder named something like "rezeau-moodle-block_quizletquiz-ff8c6a1". The end of the name may vary.
3.- ***Rename*** that folder to "quizletquiz".
---
4.- Upload the "quizletquiz" folder to your moodle/blocks/ folder.
5.- Visit your Admin/Notifications page so that the block gets installed. This does not create any tables in your moodle database, just a version reference.

--------------------------------------------------------------
HOW TO USE block Export Glossary to Quiz for Moodle 2.0 or 2.1
--------------------------------------------------------------

A. Export from Glossary to moodle quiz XML file
***********************************************

   1. Go into Edit mode and click on the Configuration icon to configure the Export_Glossary_to_Quiz block.

   2. Use the dropdown list to select the glossary that you want to use to export its entries to the quiz questions bank. If that glossary contains categories, you can select only one category to export its entries. To cancel your choice or to reset the block, simply leave the dropdown list on the Choose... position. 

   3. Maximum number of entries to export. Leave empty to export all entries from selected Glossary or Category. This option can be useful for exporting a limited number of entries from very large glossaries.
 
   4. Glossary entries can be exported to the Quiz Questions bank either as multiple choice or short answer questions.
Multiple choice questions will consist of the following elements:
    * question text = glossary entry definition
    * correct answer = glossary entry concept
    * distracters = 3 glossary entry concepts randomly selected from the glossary (or glossary category) that you have selected.
You have a choice of 4 types of numbering for the exported multiple choice questions:
* a., b., c. (the default numbering type)
* A., B., C., D.
* 1., 2., 3.
* no numbering

Short answer questions
    * Case insensitive. Student responses will be accepted as correct regardless of the original glossary entry concept case (uppercase or lowercase).
          o Example: original entry "Moodle". Accepted correct responses: "Moodle", "moodle".
    * Case sensitive. Student responses will be only be accepted as correct it the case of the original glossary entry concept is used..
          o Example: original entry "Moodle". Accepted correct response: "Moodle".

   5. When done, click OK.

   6. You are back in the course homepage, but now the block displays the settings you have selected.

   7. Click on the [Export n entries] link.

   8. Now you are on page Your course -> Glossaries -> (e.g.) Demo -> Glossary -> Export entries to Quiz (XML)

   9. Click on the Export entries to file button.

  10. At the prompt, save file to your computer. Its name is e.g. Demo_Glossary.xml.

  11. Go back to the course's homepage. You see that the the Export Glossary to Quiz block has been reset.


B. Import to the quiz questions bank
************************************

   1. Turn editing on

   2. In Administration block, click Questions

   3. On the Edit questions page, Click the Import tab

   4. Set these settings:
      File format : Moodle XML format
      General
      Category Default
      Get category from file (check it)
      Import from file upload...

   5. Go to the file you saved to your computer in step A 10 (Demo_Glossary.xml. and click Upload this file button.

   6. If all goes well, the imported questions should get displayed on the next screen.

   7. Click Continue.

   8. On the next page, the Question bank displays the new category name (formed on the name of the exported Glossary, plus the name of its category if you selected one of the glossary's categories) and of course all the questions that were imported (of the SHORTANSWER type).

   9. You can use the SHORTANSWER or the MULTICHOICE questions in a quiz.

  10. You can use the SHORTANSWER questions to create one or more Random Short-Answer MATCHING questions.
  Note.- At the time of writing, the Random Short-Answer MATCHING question type is working in Moodle 2.0 but not working in Moodle 2.1.
  
-----------
ONLINE HELP
-----------
Online help is available when editing the block. Unfortunately, due to bug MDL-26072, in Moodle 2.0 the Help text is displayed inside the window, instead of in a popup as it does in Moodle 2.1.   

Enjoy!
--------------------------
contact: moodle@rezeau.org
--------------------------