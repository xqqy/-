<?php echo "Welcome!".$_COOKIE['UID'];
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error)
  {
  die('Could not connect: ' . mysql_error());
  }
$con->query('set names utf8');

$sql = "SELECT * FROM LOGIN WHERE UID=".$_COOKIE["UID"];
$result = $con->query($sql);
$row =  $result->fetch_assoc();

echo $row['NAME'];
?>

<!DOCTYPE html>
<title>服务目录</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<html>
<br /><a href="zyfz.php" target="iframe_a"><button>查看志愿者学时</button></a><br />
<a href="zhtj.php" target="iframe_a"><button>查看团籍信息</button></a>
<br />

<div style="float=’left‘;width=‘370px';height=‘370px’;">
<iframe src="zyfz.php" width="370" height="370" name="iframe_a"></iframe>
</div>
</html>
</meta>
