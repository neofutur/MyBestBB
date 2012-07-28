<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Converter - Done!</title>
		<link rel="stylesheet" type="text/css" href="Sulfur.css">
		<style>
			.red { font: 10px Verdana, Arial, Helvetica, sans-serif; color: #FF0000; }
		</style>
		<script type="text/javascript">
			function duffusers(type){	
<?php
	// Check for MSIE, beqause IE don't understand "table-row"
	$type = (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) ? 'block' : 'table-row';
?>

				if(type == 'same')
				{
					document.getElementById('diff1').style.display = 'none';
					document.getElementById('diff2').style.display = 'none';
					document.getElementById('diff3').style.display = 'none';
					document.getElementById('diff4').style.display = 'none';
					document.getElementById('same').style.display = '<?php echo $type; ?>';
				}
				
				else
				{
					document.getElementById('same').style.display = 'none';
					document.getElementById('diff1').style.display = '<?php echo $type; ?>';
					document.getElementById('diff2').style.display = '<?php echo $type; ?>';
					document.getElementById('diff3').style.display = '<?php echo $type; ?>';
					document.getElementById('diff4').style.display = '<?php echo $type; ?>';
				}

			}
		</script>
	</head>
	<body>

	<br><br><br><br>
