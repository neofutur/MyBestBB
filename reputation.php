<?php
/******************************************************************************************************
		Reputation Plugin for PunBB
		----------------------------
-- Version 2.2.0
-- Created by hcs on 24-04-2006  hcs@mail.ru

-- GPL:
  This software is free software; you can redistribute it and/or modify it
  under the terms of the GNU General Public License as published
  by the Free Software Foundation; either version 2 of the License,
  or (at your option) any later version.

  This software is distributed in the hope that it will be useful, but
  WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston,
  MA  02111-1307  USA
******************************************************************************************************/
//TODO
//
//ѕользователь должен иметь возможность отказатьс€ от репы.
//ќчевидно настройка персональной репы должна быть встроена в общие настройки 
// т.е. в profile.php
//ѕосмотреть подробно чужую репу должно через профиль, а не только через тему


define('PUN_ROOT', './');

require PUN_ROOT.'include/common.php';
require PUN_ROOT.'include/parser.php';



require PUN_ROOT.'lang/'.$pun_user['language'].'/reputation.php';

if ($pun_user['g_rep_enable'] == 0)
	message($lang_reputation['Group Disabled']);
if ($pun_user['reputation_enable_adm'] == 0)
	message($lang_reputation['Individual Disabled']);
if ($pun_config['o_reputation_enabled'] == 0)
	message($lang_reputation['Disabled']);
if ($pun_user['reputation_enable'] == 0)
	message($lang_reputation['Your Disabled']);
	


if (isset($_POST['form_sent']))
{

	if (isset($_POST['delete_rep_id'])) 
	{
		if ($pun_user['g_id'] == PUN_ADMIN || $pun_user['g_id'] == PUN_MOD) {
			$uid = intval($_GET['uid']);
			$p = intval($_GET['p']);
			if ($uid<2)
				message($lang_common['Bad request']);
				
			$idlist = implode(',', array_values($_POST['delete_rep_id']));
			confirm_referrer('reputation.php');
			// Delete reputation 
			$db->query('DELETE FROM '.$db->prefix.'reputation WHERE id IN('.$idlist.')') or error('Unable to delete reputation data.', __FILE__, __LINE__, $db->error());
			redirect('reputation.php?uid='.$uid.'&p='.$p, $lang_reputation['Deleted redirect']);
		}
		else
		{
		message($lang_common['No permission']);
		}
	}

	
	
	if ($pun_user['is_guest'])
	message($lang_common['No permission']);
	
	$pid = isset($_POST['pid']) ? intval($_POST['pid']) : message($lang_common['Bad request']);
	$poster = isset($_POST['poster']) ? $_POST['poster'] : message($lang_common['Bad request']);	
	$method = isset($_POST['method']) ? intval($_POST['method']) : message($lang_common['Bad request']);	
	
	if ($method!=2 && $method!=1)
		message($lang_common['Bad request']);
	
	$result = $db->query('SELECT p.poster, p.poster_id, p.posted, p.id, p.topic_id, t.subject, u.reputation_enable, r.time FROM '.$db->prefix.'posts AS p INNER JOIN '.$db->prefix.'topics AS t ON p.topic_id=t.id INNER JOIN '.$db->prefix.'users AS u ON p.poster_id = u.id LEFT JOIN '.$db->prefix.'reputation AS r ON (r.from_user_id ='.$pun_user["id"] .' AND  r.user_id = u.id) WHERE p.id='.$pid.' AND p.poster="'. $db->escape($poster) .'" ORDER BY r.time DESC LIMIT 0 , 1') or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());
	
	if (!$db->num_rows($result))
		message($lang_common['Bad request']);
	$target = $db->fetch_assoc($result);

	//Check last reputation point given timestamp
	if ($target['time'])
	{
		if($pun_config['o_reputation_timeout']*60 > (time()-$target['time']))
  			message($lang_reputation['Timeout 1'].$pun_config['o_reputation_timeout'].$lang_reputation['Timeout 2']);
	}
	

	if ($target['reputation_enable']!=1)
		message($lang_reputation['User Disable']);
	
	// Prevent people from voting for themselves via URL hacking.
	if ($pun_user["id"] == $target["poster_id"])
    	message($lang_reputation['Silly user']);	
    	
	if ((($pun_user['g_rep_minus_min'] > $pun_user['num_posts']) && ($method=2) ) || (($pun_user['g_rep_plus_min'] >  $pun_user['num_posts']) && ($method=1) ))
		message($lang_reputation['Small Number of post']);
			
	// Clean up message from POST
	$message = pun_linebreaks(pun_trim($_POST['req_message']));

	// Check message
	if ($message == '')
		message($lang_reputation['No message']);
	else if (strlen($message) > 400)
		message($lang_reputation['Too long message']);
	else if ($pun_config['p_message_all_caps'] == '0' && strtoupper($message) == $message && $pun_user['g_id'] > PUN_GUEST)
		$message = ucwords(strtolower($message));

		
	// Validate BBCode syntax
	if ($pun_config['p_message_bbcode'] == '1' && strpos($message, '[') !== false && strpos($message, ']') !== false)
		$message = preparse_bbcode($message, $errors);
			
	$message = addslashes($message);			
	if (isset($errors))
		message($errors[0]);
	if($method == 1)
	{	$rep_column="rep_plus";}
	else 
	{$rep_column="rep_minus";}
	//Add voice
	$db->query("INSERT INTO ".$db->prefix."reputation (user_id, from_user_id, time, post_id, reason, topics_id, ". $rep_column .") Values ('". $target['poster_id'] . "', '" . $pun_user["id"] ."', '" . mktime() . "', '" . $target['id'] ."', '" . $db->escape($message) . "', '". $target['topic_id'] . "', '1' )") or error('Unable to add reputation info', __FILE__, __LINE__, $db->error());
	redirect('viewtopic.php?&pid=' .$pid .'#p' .$pid , $lang_reputation['Redirect Message']);
}

if ( isset($_GET['uid']) && !isset($_GET['method'])) 
{
	require PUN_ROOT.'header.php';	
	$uid = intval($_GET['uid']);
	if ($uid<2)
		message($lang_common['Bad request']);
	
	$result = $db->query('SELECT u.username, SUM(r.rep_plus) AS count_rep_plus, SUM(r.rep_minus) AS count_rep_minus FROM '.$db->prefix.'users AS u LEFT JOIN '.$db->prefix.'reputation as r ON r.user_id=u.id WHERE u.id='.$uid.' GROUP by u.id') or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());
	if (!$db->num_rows($result))
		message($lang_common['Bad request']);
	$user_rep =$db->fetch_assoc($result);

	$result = $db->query('SELECT COUNT(*) FROM '.$db->prefix.'reputation WHERE user_id='.$uid) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());	
	list($num_rows) = $db->fetch_row($result);
	if ($num_rows>0)
	{
		$num_pages = ceil(($num_rows + 1) / $pun_user['disp_posts']);
		$p = (!isset($_GET['p']) || $_GET['p'] <= 1 || $_GET['p'] > $num_pages) ? 1 : $_GET['p'];
		$start_from = $pun_user['disp_posts'] * ($p - 1);
		$paging_links = $lang_common['Pages'].': '.paginate($num_pages, $p, 'reputation.php?uid='.$uid);
		$result = $db->query('SELECT r.id, r.time, r.reason, r.post_id, r.rep_plus, r.rep_minus, r.user_id, t.subject, u2.username as from_user_name, u2.id as from_user_id FROM '.$db->prefix.'reputation AS r LEFT JOIN '.$db->prefix.'users AS u ON r.user_id = u.id LEFT JOIN '.$db->prefix.'topics AS t ON t.id=r.topics_id LEFT JOIN '.$db->prefix.'users AS u2 ON r.from_user_id = u2.id WHERE u.id='.$uid.' ORDER BY r.time DESC LIMIT '.$start_from.','.$pun_user['disp_posts']) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());
		
		$is_admmod = ($pun_user['g_id'] == PUN_ADMIN || $pun_user['g_id'] == PUN_MOD) ? true : false;		
		$form_del = "\t\t\t\t".'<form action="reputation.php?p='.$p.'&uid='.$uid.'" method="post" name="del_rep">';
		$form_end = "\t\t\t\t".'</form>';
		if ($is_admmod)	
			echo $form_del . "\n". "\t\t\t\t".'<input type="hidden" name="form_sent" value="1" />'."\n";
///style="table-layout:fixed"
?>

<div class="postlinksb">
	<div class="inbox">
		<p class="pagelink conl"><?php echo $paging_links ?></p>
		<div class="clearer"></div>
	</div>
</div>


<div class="blockform">
	<h2><span><?php echo $lang_reputation['User reputation']. pun_htmlspecialchars($user_rep['username']) . '&nbsp;&nbsp;<strong>[+'. $user_rep['count_rep_plus'] . ' / -' . $user_rep['count_rep_minus'] .'] &nbsp;</strong>' ?></span></h2>
	<div class="box">
		<div class="inbox">
			<table "reputation change fields" cellspacing="0">
			<thead>
				<tr>
				<th class="tc3" style="width:15%"><?php echo $lang_reputation['From user'] ?></th>
				<th class="tc3" style="width:15%"><?php echo $lang_reputation['For topic'] ?></th>
				<th class="tc3"  style="width:<?php if ($is_admmod){ echo '35'; }else {echo '45';} ?>%"><?php echo $lang_reputation['Reason'] ?></th>
				<th class="tc3" style="width:10%; text-align:center;"><?php echo $lang_reputation['Estimation'] ?></th>
				<th class="tc3" style="width:15%"><?php echo $lang_reputation['Date'] ?></th>
				<?php if ($is_admmod) echo '<th class="tc3" style="width:10%">'.$lang_reputation['Delete'].'</th>'; ?>
				</tr>
				<tbody>
<?php
		while ($cur_rep = $db->fetch_assoc($result))
		{
			$cur_rep['reason']= parse_message($cur_rep['reason'], 0);
?>
					<tr>					
						<td><?php echo $cur_rep['from_user_name'] ? '<a href="reputation.php?uid=' . $cur_rep['from_user_id'] . '">'. pun_htmlspecialchars($cur_rep['from_user_name']).'</a>' :  $lang_reputation['Profile deleted'] ?></td>
						<td><?php echo $cur_rep['subject'] ? '<a href="viewtopic.php?pid=' . $cur_rep['post_id'] . '#p'. $cur_rep['post_id'] . '">'.pun_htmlspecialchars($cur_rep['subject']).'</a>' : $lang_reputation['Removed or deleted'] ?></td>
						<td><?php echo $cur_rep['reason'] ?></td>
						<td style="text-align:center;"><?php echo $cur_rep['rep_plus']==1 ? '<img src="./img/warn_add.gif" alt="+" border="0">' : '<img src="./img/warn_minus.gif" alt="-" border="0">'; ?></td>
						<td><?php echo format_time($cur_rep['time']) ?></td>
						<?php if ($is_admmod) echo '<td style="text-align:center;"><input type="checkbox" name="delete_rep_id[]" value="'.$cur_rep['id'].'" /></td>'; ?>
					</tr>
<?php
		}
	}
	else 
	{ 
?>
<div class="blockform">
	<h2><span><?php echo $lang_reputation['User reputation']. pun_htmlspecialchars($user_rep['username']) . '&nbsp;&nbsp;<strong>[+'. $user_rep['count_rep_plus'] . ' / -' . $user_rep['count_rep_minus'] .'] &nbsp;</strong>' ?></span></h2>
	<div class="box">
		<div class="inbox">
			<table summary="no reputation here" cellspacing="0" style="table-layout:fixed">
				<tbody>
					<tr><td ><?php echo $lang_reputation['No reputation'] ?></td></tr>	
<?php	
	}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="clearer"></div>
<div class="postlinksb">
	<div class="inbox">
		<p class="pagelink conl"><?php echo $paging_links ?></p>
<?php if ($is_admmod)	{ ?>
		<p class="postlink conr"><input type="submit" name="del_rep" value="Delete" onclick="return confirm('<?php echo $lang_reputation['Are you sure']; ?>')" /></p>
<?php } ?>		
		<div class="clearer"></div>
	</div>
</div>
<?php
require PUN_ROOT.'footer.php';
}

else 

{

if (empty($_GET['pid']) || 	empty($_GET['method']) || empty($_GET['uid']) )
	message($lang_common['Bad request']);
	
if ($pun_user['is_guest'])
	message($lang_common['No permission']);

$pid = intval($_GET['pid']); 
$method = intval($_GET['method']); 
$uid = intval($_GET['uid']);

// Prevent people from voting for themselves via URL hacking.
if ($pun_user["id"] == $uid)
    message($lang_reputation['Silly user']);


if (($method!=1) && ($method!=2))
	message($lang_common['Bad request']);

$result = $db->query('SELECT r.time, u.username FROM '.$db->prefix.'users AS u LEFT JOIN '.$db->prefix.'reputation AS r ON ( r.user_id='.$uid.' AND r.from_user_id='.$pun_user["id"].' ) WHERE u.id='.$uid.' ORDER BY r.time DESC LIMIT 0 , 1') or error('Unable to fetch time last voice info', __FILE__, __LINE__, $db->error());


if (!$db->num_rows($result))
	message($lang_common['Bad request']);
$target = $db->fetch_assoc($result);
//Check last reputation point given timestamp
if ($target['time'])
{
	if($pun_config['o_reputation_timeout']*60 > (time()-$target['time']))
 			message($lang_reputation['Timeout 1'].$pun_config['o_reputation_timeout'].$lang_reputation['Timeout 2']);
}

// Prevent people from voting for themselves via URL hacking.
if ($pun_user["id"] == $uid)
    message($lang_reputation['Silly user']);

if ((($pun_user['g_rep_minus_min'] > $pun_user['num_posts']) && ($method=2) ) || (($pun_user['g_rep_plus_min'] >  $pun_user['num_posts']) && ($method=1) ))
	message($lang_reputation['Small Number of post']);

$poster=pun_htmlspecialchars($target['username']);

require PUN_ROOT.'header.php';
$form = '<form action="reputation.php?" method="post" name="Reput" onSubmit="return Validate()">';
?>

<script type="text/javascript" language="javascript"><!--
	function Validate() {
		var Max = 100;
		Length = document.Reput.req_message.value.length;
		if (( Length > Max) && ( Max > 0 )) {
			alert("<?php echo $lang_reputation['Max length of message'] ?> " + Max + " <?php echo $lang_reputation['You already of use'] ?> " + Length + " <?php echo $lang_reputation['Of symbol'] ?>");
			return false;
		} else {
			document.Reput.submit.disabled = true;
			return true;
		}
	}
// --></script>
<?php echo $form."\n" ?>
<div class="blockform">
	<h2><span><?php echo $lang_reputation['Form header'] ?></span></h2>
	<div class="box">

		<div class="inbox">
			<input type="hidden" name="form_sent" value="1" />
			<input type="hidden" name="pid" value="<?php echo $pid ?>" />	
			<input type="hidden" name="poster" value="<?php echo $poster ?>" />	
			<input type="hidden" name="method" value="<?php echo $method ?>" />		
			<table summary="reputation change fields"  cellspacing="0">
				<tr>
					<td  class="tc4" style=" width: 30%;"><?php echo $lang_reputation['Form your name'] ?>:</td>
					<td  class="tc4" style=" width: 70%;"><?php echo pun_htmlspecialchars($pun_user['username']) ?></td>
				</tr>
				<tr>
					<td class="tc4" style=" width: 30%;" ><?php echo $lang_reputation['Form to name'] ?>:</td>
					<td class="tc4" style=" width: 70%;"><?php echo pun_htmlspecialchars($poster) ?></td>
				</tr>
				<tr>
					<td class="tc4" style=" width: 30%;"><?php echo $lang_reputation['Form reason'] ?>:</td>
					<td class="tc4" style=" width: 70%;"><textarea cols='60' rows='10' name="req_message" class='textinput'></textarea></td>
				</tr>				
				<tr>
					<td class="tc4" style=" width: 30%;"><?php echo $lang_reputation['Form method'] ?>:</td>
					<td class="tc4" style=" width: 70%;"><?php echo  $method==1 ? $lang_reputation['Plus'] : $lang_reputation['Minus']; ?></td>
				</tr>
			</table>
			<table summary="cancel, go back" cellspacing="0">
				<tr>
					<td  class="tc4" style="text-align:center;"><input type="submit" name="submit" value="<?php echo $lang_common['Submit'] ?>"/> : <a href="javascript:history.go(-1)"><?php echo $lang_common['Go back'] ?></a></td>
				</tr>
			</table>
		</div>
	</div>
</div>
</form>
<?php
require PUN_ROOT.'footer.php';
}
?>
