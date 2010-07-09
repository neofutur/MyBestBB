<?php
define('PUN_ROOT', './');
require PUN_ROOT.'include/common.php';

function quote($pid)
{
  global $db, $pun_user;
  $objResponse = new xajaxResponse();
  $ret = "";
  $result = $db->query('SELECT poster, message FROM '.$db->prefix.'posts WHERE id='.$pid) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());
  $cur_post = $db->fetch_assoc($result);
//  $quotemsg = utf8_encode("[quote=" . $cur_post['poster'] . "]" . $cur_post['message'] . "[/quote]\n");
  $quotemsg = "[quote=" . $cur_post['poster'] . "]" . $cur_post['message'] . "[/quote]\n";
  $objResponse->addAppend("req_message", "value", $quotemsg);
  $objResponse->addAssign("req_message", "style.height", "300px");
  return $objResponse->getXML();
}
require("quote.common.php");
$xajax->processRequests();
?>
