<?php require_once('../Connections/localhost.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


$colname2_lablist = date ('Y-m-d');

  $colname_lablist = $_GET['en'];

mysql_select_db($database_localhost, $localhost);
$query_lablist = sprintf("SELECT service.Short      , visit_procedure.Enrolee      , visit_procedure.Created      , visit_procedure.Creator      , visit_procedure.Visit      , visit_procedure.Provider      , visit_procedure.Appointment      , visit_procedure.Specific_Request      , visit_procedure.Specimen      , visit_procedure.Status      , procedure.Procedure     , service.Task_FK     , task.Task     , task.Sequence     , procedure.Procedure     , procedure.Id     , service.Service     , task.Id     , visit_procedure.Status FROM     newmed06.procedure     INNER JOIN newmed06.service          ON (procedure.Service_direction_FK = service.Id)     INNER JOIN newmed06.task          ON (service.Task_FK = task.Id)     INNER JOIN newmed06.visit_procedure          ON (visit_procedure.Procedure = procedure.Id)         WHERE Enrolee = %s AND visit_procedure.Status = 1 AND service.Task_FK = 25", GetSQLValueString($colname_lablist, "int"));
$lablist = mysql_query($query_lablist, $localhost) or die(mysql_error());
$row_lablist = mysql_fetch_assoc($lablist);
$totalRows_lablist = mysql_num_rows($lablist);


  $colname_lablisttwo = $_GET['en'];
  $colname2_lablisttwo = date ('Y-m-d');

mysql_select_db($database_localhost, $localhost);
$query_lablisttwo = sprintf("SELECT service.Short      , visit_procedure.Enrolee      , visit_procedure.Created      , visit_procedure.Creator      , visit_procedure.Visit      , visit_procedure.Provider      , visit_procedure.Appointment      , visit_procedure.Specific_Request      , visit_procedure.Specimen      , visit_procedure.Status      , procedure.Procedure     , service.Task_FK     , task.Task     , task.Sequence     , procedure.Procedure     , procedure.Id     , service.Service     , task.Id     , visit_procedure.Status FROM     newmed06.procedure     INNER JOIN newmed06.service          ON (procedure.Service_direction_FK = service.Id)     INNER JOIN newmed06.task          ON (service.Task_FK = task.Id)     INNER JOIN newmed06.visit_procedure          ON (visit_procedure.Procedure = procedure.Id) WHERE visit_procedure.Status > 1 AND Enrolee = %s AND visit_procedure.Visit LIKE %s AND service.Task_FK = 24", GetSQLValueString($colname_lablisttwo, "int"),GetSQLValueString("%" . $colname2_lablisttwo . "%", "date"));
$lablisttwo = mysql_query($query_lablisttwo, $localhost) or die(mysql_error());
$row_lablisttwo = mysql_fetch_assoc($lablisttwo);
$totalRows_lablisttwo = mysql_num_rows($lablisttwo);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="1" style="border:thin; border-color:#000; border-collapse:collapse;">
  <tr>
    <td width="90%"><strong>Procedure</strong></td>
    <td width="10%">&nbsp;</td>
  </tr>
   <?php if ($totalRows_lablist > 0) { ?>
  <?php do { ?>
    <tr>
      <td align="left" style="background-color:#DAF4FC; border-top:1px solid #7c7c7c;
	border-left:1px solid #c3c3c3;
	border-right:1px solid #c3c3c3;
	border-bottom:1px solid #ddd;"><?php echo $row_lablist['Short']; ?> - <?php echo $row_lablist['Procedure']; ?></td>
      <td><?php if ($row_lablist['Status'] == 1) {
	  echo "Waiting";
  }else if ($row_lablist['Status'] == 0){ echo "Canceled"; }
  else if ($row_lablist['Status'] == 2){ echo "Done"; }
  else{ echo "Canceled"; }
	  ?></td>
    </tr>
    <?php } while ($row_lablist = mysql_fetch_assoc($lablist)); ?>
     <?php } ?>
</table>
<table width="100%" border="1" style="border:thin; border-color:#000; border-collapse:collapse;">
<?php if ($totalRows_lablisttwo > 0) { ?>
  <?php do { ?>
    <tr>
      <td align="left" width="90%" style="background-color:#DAF4FC; border-top:1px solid #7c7c7c;
	border-left:1px solid #c3c3c3;
	border-right:1px solid #c3c3c3;
	border-bottom:1px solid #ddd;"><?php echo $row_lablisttwo['Short']; ?> - <?php echo $row_lablisttwo['Procedure']; ?></td>
      <td><?php if ($row_lablisttwo['Status'] == 1) {
	  echo "Waiting";
  }else if ($row_lablisttwo['Status'] == 0){ echo "Canceled"; }
  else if ($row_lablisttwo['Status'] == 2){ echo "Done"; }
  else{ echo "Canceled"; }
	  ?></td>
    </tr>
    <?php } while ($row_lablisttwo = mysql_fetch_assoc($lablisttwo)); ?>
     <?php } ?>
</table>
</body>
</html>
<?php
mysql_free_result($lablist);

mysql_free_result($lablisttwo);
?>
