<?php
/***********************************************************************

  Caleb Champlin (med_mediator@hotmail.com)

************************************************************************/
class ran
{
	var $text; // the random text used in the image

	function ran()
	{
		srand((double)microtime()*1000000^getmypid());
	}


	function createImage($width=135,$height=45)
	{
		// send header for our image
		header("Content-type:image/jpeg");

		// create an image 
		$im=imagecreate($width,$height);

		// white background
		$black=imagecolorallocate($im,0,0,0);


		// black text and grid
		$white=imagecolorallocate($im,255,255,255);
            $other=imagecolorallocate($im,0,0,255);
		// get a random number to start drawing out grid from
		$num=rand(0,5);

		// draw vertical bars
		for($i=$num;$i<=$width;$i+=10)
			imageline($im,$i,0,$i,45,$other);

		// draw horizontal bars
		for($i=$num;$i<=$height+10;$i+=10)
			imageline($im,0,$i,135,$i,$other);

		// generate a random string
		$string=substr(strtolower(md5(uniqid(rand(),1))),0,7);
		
		$string=str_replace('2','a',$string);
		$string=str_replace('l','p',$string);
		$string=str_replace('1','h',$string);
		$string=str_replace('0','y',$string);
		$string=str_replace('o','y',$string);

		// place this string into the image
		$font = imageloadfont('anticlimax.gdf'); 

          imagestring($im,$font,10,10,$string, $white);
		// create the image and send to browser
		imagejpeg($im);
		// destroy the image
		imagedestroy($im);

		// return the random text generated
		return $this->text=$string;
	}
}