<?php

if($_POST['pswd']!="tuan2017"){die("密码错误");}

$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");;}
$con->query("set names utf8");

if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(7)");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
    if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(11)");}


$tj =new mysqli("localhost","push","5TPlpIGEX9Hy8xCC","PUSH");/*connect mysql*/
if ($tj->connect_error){die("Could not connect!");} 
$tj->query('set names utf8');

$xs =new mysqli("localhost","zyfz","zyfzalwayswithyou","ZYFZ");/*connect mysql*/
if ($xs->connect_error){die("Could not connect!");} 
$xs->query('set names utf8');

// 允许上传的图片后缀
$allowedExts = array("txt", "csv","");
$temp = explode(".", $_FILES["file"]["name"]);
echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ($_FILES["file"]["size"] < 2048000  and in_array($extension, $allowedExts))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "错误(31)：: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
		echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
		echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
		echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
		echo "文件内容:<br />";
		
		// 读取文件并开始批量导入
		
		$file = fopen($_FILES["file"]["tmp_name"], "r") or exit("无法打开文件!");
		// 读取文件每一行，直到文件结尾
		while(!feof($file))
		{
			$in=str_getcsv(fgets($file));
			if(!$in[0]){break;}
		    print_r($in);
			$sqltj="DELETE FROM `PUSHMAIN` WHERE UID='".$in[0]."'";
			$sqlxs="DELETE FROM `ZYFZMAIN` WHERE UID='".$in[0]."'";
			$sqllogin="DELETE FROM `LOGIN` WHERE UID='".$in[0]."'";
		$resulttj=$tj->query($sqltj);
		$resultxs=$xs->query($sqlxs);
		$resultlogin=$con->query($sqllogin);
		if($resultlogin and $resulttj and $resultxs){echo $in[0]."设置成功<br />";}else{echo $in[0]."设置失败<br />xs:".$resultxs."push:".$resulttj."login:".$resultlogin;;}
		}
		fclose($file);

			}
}
else
{
	echo "非法的文件格式或文件过大";
}
?>
