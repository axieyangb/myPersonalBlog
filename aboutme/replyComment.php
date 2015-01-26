<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="css/style-pages.css">
<?php include '../conn/conn.php'?>;
</head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script language="javascript" type="text/javascript">

function addEmotion(a)
{
	str="<img src=\"../emotions/"+a+".png\">";
	document.getElementById("txtInput").value+=str;
}
</script>
<body>

<?php 


 echo "<h3 id=\"Reply to some one\" style=\"text-align:center\">Reply</h3>
<form action=\"replyComment.php?commentID=".$_GET["commentID"]."&diaryID=".$_GET["diaryID"]."\" method=\"post\">
<textarea name=\"content_parent\" class=\"form-control\" id=\"txtInput\"rows=\"3\" ></textarea>
<br>

     <div id=\"buttons\">
         <button type=\"button\" class=\"btn btn-default\" data-toggle=\"collapse\" data-target=\"#emotions\" >emotions</button>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <button type=\"input\" class=\"btn btn-info\" id=\"submitContent\">Submit</button>
    </div>
  </form>";
  //<!--this is emotion package--> 

    echo "  <div id=\"emotions\" class=\"collapse\">
       <table id=\"table\" class=\"table table-bordered\">";
	   for($i=0;$i<5;$i++){
		   echo "<tr>";
		   for ($j=0;$j<6;$j++)
		   {
			   echo "<td><div id=\"oneEmo\" style=\"background-image:url(../emotions/".($i*5+$j+1).".png);background-size:100%;\") onClick=\"addEmotion(".($i*5+$j+1).")\"></div></td>";
		   }
		   echo "</tr>";
	   }
      echo"
       </table>
      </div>"
 ?>
 
 <?php
if(isset($_POST["content_parent"])&&isset($_GET["diaryID"])&&isset($_GET["commentID"]))
{
	$day=intval(date("d"));
	$month=intval(date("m"));
	$year =intval(date("Y"));
	$content=$_POST["content_parent"];
	$replyID=$_GET["commentID"];
	$diaryID=$_GET["diaryID"];
$content=str_replace("\"","\\\"",$content);
$conn=connectToDB();
	$result =insertComment(intval($diaryID),intval($replyID),$content,$year,$month,$day);
	if($result=="0")
	echo "<div class=\"alert alert-success\" role=\"alert\">Well done ! You have Successfully commented! please reopen this page to see the result, please don't reflash it, otherwise it will be submitted twices</div>";
	else "<div class=\"alert alert-danger\" role=\"alert\">Ooops, you failed to comment </div>";
	
}
?>
</body>
</html>