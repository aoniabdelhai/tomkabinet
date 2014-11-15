<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title><?php echo $title; ?></title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #555555;">

<table width="565" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td bgcolor="#000000"><img src="<?php echo HTTP_SERVER; ?>image/data/emails/tom-kabinet-header.jpg" width="565" height="38" /></td>
  </tr>
  <tr>
    <td bgcolor="#efefef" style="padding: 40px 50px;"><?php echo $message; ?></td>
  </tr>
  <tr>
    <td bgcolor="#efefef" align="center" style="padding: 20px 0;">
    	<a href="<?php echo $url_website; ?>"><img src="<?php echo HTTP_SERVER; ?>image/data/emails/klik-hier.jpg" width="249" height="47" /></a>
    </td>
  </tr>
  <tr>
    <td bgcolor="#ee6c3a">
    	<a href="<?php echo $url_more; ?>"><img src="<?php echo HTTP_SERVER; ?>image/data/emails/meer-over-tom.jpg" width="565" height="208" /></a>
    </td>
  </tr>
</table>

</body>
</html>