<?php
/***********************************************************************
  
  Copyright (C) 2005  gilles francois (Contact me on punbb.fr forum)

  This software is free software; you can redistribute it and/or modify it
  under the terms of the GNU General Public License as published
  by the Free Software Foundation; either version 2 of the License,
  or (at your option) any later version.

  This software is distributed in the hope that it will be useful, but
  WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

Version 2
Le concept est simple. Nommez votre fichier "rigolade.gif", uploadez le dans le repertoire /punbb/img/smilies 
et ensuite accedez à la page AP_SMilies.php via la section d'aministration de punbb. Il n'y a rien a valider, 
il suffit d'afficher la page.

Des lors, si vous entrez :rigolade: dans un post, le code sera remplacé par le smiley.

les caracteres autorisé sont toutes les lettres et chiffres, underscore (_), minus (-), crochets ( [ et ] ), parentheses et slahes ( \ et / )
Tous les autres caracteres sont ignorés.

L'interface d'admin permet de renommer les smilies. Elle permet aussi de les effacer, ou de les cacher (ils sont toujours dans l'admin, mais non utilisables)

    Installation :
    0 - Uploader le fichier Ap_Smileys.php dans le repertoire /punbb/plugins
    1 - Créer un fichier vide smiley.inc.php dans /punbb/ avec un chmod 777 (= autoriser les droits d'écriture)
    2 - dans /punbb/include/parser.php , commenter les lignes 31 et 32. ajouter juste apres ces lignes la ligne suivante



		include_once("smiley.inc.php");

    les lignes à commenter (commenter signifiant mettre // au debut de la ligne) sont les lignes commencant par



		$smiley_text = array ...

    et



		$smiley_img = array ...

    Enfin, rechercher l'expression suivante :


		width="15" height="15"

    et l'effacer.

    3 et 4 : Si vous avez le mod easy_bbcode ( http://www.punres.org/desc.php?pid=50 )

    3 - Dans mod_easy_bbcode.php, chercher


                <?php

                // Display the smiley set
                require_once PUN_ROOT.'include/parser.php';

    et ajouter juste avant la ligne :


                <div id="smileys" class="punbbSmilies">

    Puis fermer le </div> a la derniere ligne


    4 - Ajouter dans le feuille de style de base


		.punbbSmilies { style="padding-top: 4px;width:99%;height:80px;overflow:auto; }


************************************************************************/

// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
    exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);
define('PLUGIN_VERSION',1.0);

# Script d'upload
if($_POST["action"]=="upload" && isset($_POST["nom_fichier"]) && !empty($_POST["nom_fichier"]))
	{
		$nom_fichier=$_POST["nom_fichier"];
	if(isset($_FILES["filename"]) && !empty($_FILES["filename"]["tmp_name"]))
		{
		$filename=$_FILES["filename"]["tmp_name"];	
	$out="";
	$out.="< OK -> 1 > ";
			$maxsize=filesize($filename);
			$ok=false;
			if ($filenum=fopen($filename,"rb")) 
			{
	$out.="< OK -> 2 > ";

				$ok=true;
				$img=@fread($filenum,$maxsize);
				@fclose($filenum);
			}
		} else if(isset($_POST["urlfichier"])) {
			$ok=true;
			$tabfile=file($_POST["urlfichier"]);
			$img="";
			while(list($key,$val) = each($tabfile)) {
				$img.=$val;
			}
		} else {
			$ok=false;
		}

		if($ok)
		{
			$nom_fichier=remplace($nom_fichier);

$out.="< OK -> 3 > ";
		if ($id=fopen("img/smilies/".$nom_fichier,"w+")) 
			{
				if (!fwrite($id,$img)) 
					{
					$out.="Unknown error ($nom_fichier)";
					exit;
					}
				@fclose($id);
$out.="< OK -> 4 > ";
			}

		if($ok)
			{
			$out=magic($nom_fichier,1)." upload successfull";
			$up="ok";
			}
		else
			{
			$out="Error : ".$out;
			$up="";
			}
		redirect('admin_loader.php?plugin=AP_Smileys.php&message='.$out, $out);

		}
		exit;
	}

# Script de delete d'un fichier
if($_GET["action"]=="del" && isset($_GET["nom_fichier"]))
{
	if(unlink("img/smilies/".$_GET["nom_fichier"])) {
		$out="File ".magic($_GET["nom_fichier"],1)." deleted";
	redirect('admin_loader.php?plugin=AP_Smileys.php&message='.$out, $out);
	}
}

# rename
if($_GET["action"]=="ren" && !empty($_GET["nom_fichier"]) && !empty($_GET["nouv_nom"]))
{
	$goback=$_GET["goback"];
	$nom_fichier=$_GET["nom_fichier"];
	$nouv_nom=$_GET["nouv_nom"];

	$out="Error renaming file ".magic($nom_fichier,1);
	$nouv_nom=remplace($nouv_nom);
	if(file_exists("img/smilies/".$nouv_nom)) {
		$out.=" : File exists !";;
		redirect('admin_loader.php?plugin=AP_Smileys.php&message='.$out, $out);
	}
	if(rename("img/smilies/".$nom_fichier, "img/smilies/".$nouv_nom)) {
		$out="File ".magic($nom_fichier,1)." renamed to ".magic($nouv_nom,1);
	}
	redirect('admin_loader.php?plugin=AP_Smileys.php&message='.$out, $out);

}
if(isset($_GET["message"]) && !empty($_GET["message"])) {
	echo "<center style='color:red;'><b>",htmlspecialchars($message),"</b><br /></center>";
}
if(true)
{
	// Display the admin navigation menu
	generate_admin_menu($plugin);

?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function hide( nom_fichier)
{
		window.open('admin_loader.php?plugin=AP_Smileys.php&action=ren&nom_fichier=' + nom_fichier + '&nouv_nom=null' + nom_fichier,'_self');
}

function unhide( nom_fichier)
{
		window.open('admin_loader.php?plugin=AP_Smileys.php&action=ren&nom_fichier=null' + nom_fichier + '&nouv_nom=' + nom_fichier,'_self');
}

function renommer ( nom_fichier, code , goback )
{
	if(nouv_nom=prompt('New code for ' + nom_fichier + '?\n: will be replaced automaticaly.',code))
	{
		window.open('admin_loader.php?plugin=AP_Smileys.php&action=ren&nom_fichier=' + nom_fichier + '&nouv_nom=' + nouv_nom + '&goback=' + goback,'_self');
	}
}

function effacer ( nom_fichier )
{
	if(confirm('Delete ' + nom_fichier + '?'))
	{
		window.open('admin_loader.php?plugin=AP_Smileys.php&action=del&nom_fichier=' + nom_fichier,'_self');
	}
}

//-->
</SCRIPT>	

	<div class="block">
		<h2><span>Smileys - v<?php echo PLUGIN_VERSION ?></span></h2>
		<div class="box">
			<div class="inbox">
				<p>This Plugin allows you to manage smileys. To add a smiley, upload it in punbb/img/smilies then display the current page.<br /> </p>
			</div>
		</div>
	</div>
	<div class="blockform">
		<h2 class="block2"><span>Images</span></h2>
		<div class="box">
				<div class="inform">
					<fieldset>
						<legend>Images files</legend>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
													<tr>
								<th scope="row">/img/smilies</th>
								<td><div _style="height:300px;overflow:auto">
<table cellpadding="0" cellspacing="0"><tr>
<?php
# Script affichant les images
$localdir="img/smilies";

chdir($localdir);
$rep = dir(".");
$rep->rewind();
$nb=0;
$i=0;
$chaine_1=$chaine_2="";
while($nomfic = $rep->read())
{
	// Elimination des fichier ., .. et noms vides éventuels
	if($nomfic=="." || $nomfic==".." || empty($nomfic))
		continue;

	$size = @GetImageSize($nomfic);
	if($size[2] != 1 && $size[2] != 2 && $size[2] != 3)
		continue;

	$tabfile[]=$nomfic;
}
sort($tabfile);
$autre=0;
while(list($key, $nomfic) = each($tabfile)) {
	$nul=substr($nomfic,0,4)=="null";
	if($nul) {
		$temp=$tabfile[$autre];
		$tabfile[$autre]=$nomfic;
		$tabfile[$key]=$temp;
		$autre++;
	}
}
$goback="0";
reset($tabfile);
while(list($key, $nomfic) = each($tabfile)) {
	
	$br='';
	$nb++;
	$i++;
	$li=6;
	if($nb==$li) {
		$br='</TR><TR>';
		$nb=0;
	}
	$ext=substr($nomfic,strlen($nomfic)-4,strlen($nomfic));
	// on enleve l'extension si il y en a une
	if(strtolower($ext) == ".gif" || strtolower($ext) == ".jpg" || strtolower($ext) == ".jpeg" || strtolower($ext) == ".png")
		$code=substr($nomfic,0,strlen($nomfic)-4);
	else
		$code=$nomfic;

	// decode the smiley
	$code=magic($code,1);

	$nul=substr($nomfic,0,4)=="null";
	if($nul)  {
		$couleur="grey";
	}
	else {
		$couleur="black";
	}
	
	echo "\n".'<td style="width:'.intval(100/$li).'%;"><div align="center" valign="middle" style="overflow:hidden"><img src="img/smilies/'.$nomfic.'"><br />';
	$tabficimg=file($nomfic);
	$cont="";
	while(list($key,$value) = each($tabficimg)) {
		$cont.=$value;
	}
	if(!$nul) {
		echo '<a name="'.$goback.'" style="color:'.$couleur.'" href="javascript:renommer(\''.$nomfic.'\',\''.$code.'\',\''.$goback.'\')">'.$code.'</a> <br />';
		echo '<a href="javascript:effacer(\''.$nomfic.'\')" title="Delete smilie" style="color:red;text-decoration:none"><b>X</b></a> &nbsp;';
		echo '<a href="javascript:hide(\''.$nomfic.'\')" title="Hide smilie" style="color:grey;text-decoration:none"><b>0</b></a>';
	} else {
		$nomtemp1=substr($code,4,strlen($code));
		$nomtemp=substr($nomfic,4,strlen($nomfic));
		echo '<a style="color:'.$couleur.'">'.$nomtemp1.'</a> <br />';
		echo '<a href="javascript:unhide(\''.$nomtemp.'\')" title="Show smilie" style="color:grey;text-decoration:none"><b>1</b></a>';

	}
	echo '</div></td>'.$br;
	$goback=md5($cont);

	if(!$nul) {
		if($chaine_1!="") {
			$chaine_1.=",";
			$chaine_2.=",";
		}
		$chaine_1.="'".$code."'";
		$chaine_2.="'".$nomfic."'";
	}
}
chdir("../..");
		$res='$smiley_text = array('.$chaine_1.');'."\n";
		$res.='$smiley_img = array('.$chaine_2.');'."\n";
//		$res.='include("psmiley.inc.php");'."\n";
//		$res.='$smiley_text_orig=$smiley_text;'."\n".'$smiley_text=array_merge($smiley_text,$psmiley_text);'."\n";
//		$res.='$smiley_img_orig=$smiley_img;'."\n".'$smiley_img=array_merge($smiley_img,$psmiley_img);'."\n";


		if($handle = fopen ("smiley.inc.php", "w+")) {
			fwrite($handle, "<?php\n".$res."?>");
			fclose($handle);
			$out=$i." smilies written correctly.";
		}  else {
			$out="Unkown error, please, try again.";
		}


?></tr></table>
</div>
								</td>
							</tr>
<tr>
<th scope="row"><?php echo $out;?></th>
<td><center><input type="button" onclick="window.open('admin_loader.php?plugin=AP_Smileys.php','_self')" value="Reload page"></center></td></tr>
<tr>
<th scope="row">Upload new</th>
<td>
<SCRIPT type="Text/JavaScript">
<!--
function remplir (obj) {
	temp=obj.value;
	last=0;
	for(i=0;i<temp.length;i++) {
		if(temp.charAt(i)=='/' || temp.charAt(i)=='\\') {
			last=i;
		}
	}
	temp=temp.substring(last+1);
	ext=temp.substring(temp.length-4,temp.length);
	// on enleve l'extension si il y en a une
	if(ext.toLowerCase() == ".gif" || ext.toLowerCase() == ".jpg" || ext.toLowerCase() == ".jpeg" || ext.toLowerCase() == ".png")
		temp=temp.substring(0,temp.length-4);
	document.getElementById('nom_fichier').value=temp;
}

//-->
</SCRIPT>

<FORM enctype="multipart/form-data" METHOD="POST" action="<?php echo $_SERVER['REQUEST_URI'] ?>" name="form_upload" id="form_upload">
<center>
	<div><div style="float:right;width:250px" align="left"><input type=file onchange="remplir(this)" size=12 name="filename" id="filename" value=""> </div>
	Upload local file : <br /><br /></div>
	<div><div style="float:right;width:250px" align="left"><input type=text name="urlfichier" onchange="remplir(this)"></div>
	or url of the file : <br /><br /></div>
	<div><div style="float:right;width:250px" align="left"><input type=text name="nom_fichier" id="nom_fichier" value=""></div>
	Smilie Code : <br /><br /></div>
<input type=hidden name=action value="upload">
<INPUT type="submit" value="Ok">
</center>
</FORM>
</td></tr>
						</table>
						</div>
					</fieldset>
				</div>
			</form>
		</div>
	</div>
<?php
}


function RoundSigDigs($number, $sigdigs) {
   $multiplier = 1;
   while ($number < 0.1) {
       $number *= 10;
       $multiplier /= 10;
   }
   while ($number >= 1) {
       $number /= 10;
       $multiplier *= 10;
   }
   return round($number, $sigdigs) * $multiplier;
}

function remplace ( $texte ) {
	$texte=strtolower($texte);
	$lettresOk=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9","_","-","]","[",")","(");
	$texte=magic($texte);
	$out="";
	for($i=0;$i<strlen($texte);$i++) {
		$c=$texte{$i};
		if(estPresent($lettresOk,$c))
			$out.=$c;
	}
	return $out;

}

function magic ( $texte , $flag=0) {
	if($flag!=1) {
		$texte=str_replace(":","[dblpt]",$texte);
		$texte=str_replace("*","[star]",$texte);
		$texte=str_replace("/","[slash]",$texte);
		$texte=str_replace("\\","[antislash]",$texte);
		$texte=str_replace(" ","[space]",$texte);
	} else {
		$texte=str_replace("[dblpt]",":",$texte);
		$texte=str_replace("[star]","*",$texte);
		$texte=str_replace("[slash]","/",$texte);
		$texte=str_replace("[antislash]","\\",$texte);
		$texte=str_replace("[space]"," ",$texte);
	}
	return $texte;
}

function estPresent($tab,$val0) {
	while(list($key,$val)=each($tab)) {
		if($val==$val0) {
			return true;
		}
	}
	return false;
}
?>