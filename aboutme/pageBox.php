<!doctype html>
<html>
<head>
<?php include '../conn/conn.php';
$duplicate=false;
if(isset($_POST["content_parent"]))
{
		$duplicate=true;
	}?>
<meta charset="UTF-8">
<title>page</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/style-pages.css">
<link href='http://fonts.googleapis.com/css?family=Cabin+Sketch' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
<script language="javascript" type="text/javascript">

function addEmotion(a)
{
	str="<img src=\"../emotions/"+a+".png\">";
	document.getElementById("txtInput").value+=str;
}
function reply(str,str1)
{
	myWindow = window.open("replyComment.php?commentID="+str+"&diaryID="+str1+"","replyComment","width=1000,height=500");
}
</script>
</head>

<body>


<?php
if(isset($_GET['diaryID']))
{
	$result=fetchDiaryByID($_GET['diaryID']);
}
$passage[0]=substr($result[4],0,1);
$passage[1]=substr($result[4],1);

echo "
<div class=\"page-header\" style=\"text-align:center\">
<h1 id=\"pageTitle\">".$result[1]."&nbsp;&nbsp;<small>".$result[2]."</small></h1>
</div>
<div class=\"container\"><p><img id=\"img\" src=\"".$result[5]."\" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-family: 'Tangerine', serif;font-size:500%;text-shadow: 4px 4px 4px #aaa;\">".$passage[0]."</span>".$passage[1]."</p>
<br>
<p id=\"editDate\">".$result[9]."-".$result[10]."-".$result[11]."&nbsp;&nbsp;edited by:&nbsp;&nbsp;&nbsp;".$result[2]."</p>
</div>";
?>


<?php
if(!empty($_GET["diaryID"]))
{
	$diaryID=$_GET["diaryID"];
	}
else $diaryID=0;

	$result_comment=fetchParentCommentByID(intval($diaryID));
	if($result_comment==NULL)
		$row=0;
	else 
	$row=count($result_comment);
	echo $row;

echo "
<div class=\"container\" id=\"cmments\">
<br><br>
<h3 id=\"diffTitle\">comments</h3>";
	if($result_comment==NULL){
		echo "<p>Do you want to be the first visitor to leave words?</p>";
	}
for($i=0;$i<$row;$i++){
	echo var_dump($result_comment[$i][5]);
	if($result_comment[$i][5]=="0")
		continue;
	echo var_dump($result_comment[$i]);
	 $comment=$result_comment[$i][3];
	echo "
		<h4>someone said on ".$result_comment[$i][7]."-".$result_comment[$i][8]."-".$result_comment[$i][9].":</h4>
			<div id=\"oneComment\" class=\"container-fluid\">   
			<blockquote>
			<p id=\"comment\">".$comment."
			</p>";
			$result_reply=fetchChildCommentByID($diaryID,$result_comment[$i][0]);
			if($result_reply==NULL)
				$numOfReply=0;
			else 
				$numOfReply=count($result_reply);
			for ($j=0;$j<$numOfReply;$j++)
			{
				if($result_reply[$j][5]=="0")
				continue;
				echo "
		<h4>someone reply on ".$result_comment[$j][7]."-".$result_comment[$j][8]."-".$result_comment[$j][9].":</h4>   
			<blockquote>
			".$result_reply[$j][3]."</blockquote>";
			}
			echo "
			<button type=\"button\" on onClick=\"reply(".$result_comment[$i][0].",".$diaryID.")\" class=\"btn btn-default btn-lg\">reply</button>
	</div><br><br>";}
	echo"
</div>";
?>
<div class="container">

<?php if(!$duplicate) echo "<h3 id=\"leaveWords\" style=\"text-align:center\">Leave words</h3>
<form action=\"pageBox.php?diaryID=".$_GET['diaryID']."\" method=\"post\">
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
</div>
<!--for text-->

<?php
if(isset($_POST["content_parent"])&&isset($_GET["diaryID"]))
{
	$day=intval(date("d"));
	$month=intval(date("m"));
	$year =intval(date("Y"));
	$content=$_POST["content_parent"];
$content=str_replace("\"","\\\"",$content);
	$result =insertComment(intval($diaryID),0,$content,$year,$month,$day);
	if($result=="0")
	echo "<div class=\"alert alert-success\" role=\"alert\">Well done ! You have Successfully commented! please reopen this page to see the result, please don't reflash it, otherwise it will be submitted twices</div>";
	else "<div class=\"alert alert-danger\" role=\"alert\">Ooops, you failed to comment </div>";
	
}
?>
</body>


</html>