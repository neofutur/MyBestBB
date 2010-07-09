<?PHP
/*
Human signup validator for punnBB written by Mirko Kaiser http://www.Network-Technologies.org
Download the latest version at:
http://www.network-technologies.org/Projects/Virtual_Brain_Online/article/spam_bot_registration_mod_punbb/

This is Open Source software, this is not a license which allows to steal ideas and use them in your own code. Give credit where credit is due and make sure you understand the license before you claim the code as your own!

Notes:
I would also suggest to disable the javascript which disabled the Submit button as it creates problems if the user has to go back and fix a mistake (with Firefox). 
	Change this:
 		<form id="register" method="post" action="register.php?action=register" onsubmit="this.register.disabled=true;if(process_form(this)){return true;}else{this.register.disabled=false;return false;}">
	To this:
		<form id="register" method="post" action="register.php?action=register">

History:
- 19.April.2008 - Wrote manual and released version 1.0
- 18.April.2008 - Idea and first implementation

License:
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

-----------------------------------------------------------------------------------------------------
*/

//Questions and Answers
// You should define your own questions and answers below. All questions and answers are stored in a
// multidimensional array. Index 0 is the question, the rest can be used for multiple possible answers
// case does not matter with written answers because the script turns all answers into lower case

$hum_qna = array();

$hum_qna[0][0] = 'What is five plus three?';
$hum_qna[0][1] = '8';
$hum_qna[0][2] = 'eight';

$hum_qna[1][0] = 'How many letters e are in the word: free?';
$hum_qna[1][1] = '2';
$hum_qna[1][2] = 'two';

$hum_qna[2][0] = 'Find the value of  x in x + 6 = 9';
$hum_qna[2][1] = '3';
$hum_qna[2][2] = 'three';

$hum_qna[3][0] = 'What is the value of x in x + 15 = 25';
$hum_qna[3][1] = '10';
$hum_qna[3][2] = 'ten';

$hum_qna[4][0] = 'Please write the word "black" without quotes into the field below';
$hum_qna[4][1] = 'black';

$hum_qna[5][0] = 'Please write the word "blue" without quotes into the field below';
$hum_qna[5][1] = 'blue';

$hum_qna[6][0] = 'Please write the word "green" without quotes into the field below';
$hum_qna[6][1] = 'green';







?>

