<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>blogBox</title>
<?php include '../conn/conn.php'?>
</head>
<link rel="icon" href="images/favicon.ico">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="stylesheet" href="css/stuck.css">
<link rel="stylesheet" href="css/style.css">
<body>
   <?php
   $startNum=0;
   if(isset($_GET['pageNum']))
  	 $startNum=$_GET['pageNum'];
	$limitNum=3;
	$rows=fetchDiaries($limitNum,$startNum);


	if(!$rows==NULL)
	{
	for($i=0;$i<count($rows);$i++)
	{	
		$content = substr($rows[$i][4],0,200)."&nbsp;......";
        echo "<div class=\"blog\">
            <div class=\"text1\"><a href=\"pageBox.php?diaryID=".$rows[$i][0]."\">".$rows[$i][1]."</a></div>
            <div class=\"blog_links\">Submitted by
              <a href=\"#\">".$rows[$i][2]."</a> on
              <time datetime=\"".$rows[$i][9]."-".$rows[$i][10]."-".$rows[$i][11]."\">".$rows[$i][9]."-".$rows[$i][10]."-".$rows[$i][11]."</time>
            </div>
            <p><img src=\"".$rows[$i][5]."\" id=\"img_1\"  style=\"width:170px;height:120px;float:left\">
            <span  id=\"words\" class=\"extra_wrapper\">
              ".$content."            </span>
              <br>
              <a href=\"pageBox.php?diaryID=".$rows[$i][0]."\" target=\"_blank\"  class=\"btn\">more</a></p>

          </div>";}
	}
	else echo "error !";
      ?>
  
</body>
</html>