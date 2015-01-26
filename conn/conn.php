<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>conn</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>

<?php

/**this function is used to connect the database with the php**/
	function connectToDB()
	{
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dataBaseName="jerryBlogData";
		// Create connection
		$conn = new mysqli($servername, $username, $password,$dataBaseName);

		// Check connection
		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
			} 
		return $conn;
	}
	
	
	/**this funciton search the number of tubles in the tables**/
	function searchNum($tableName,$columnName)
	{
		//create the connection
		$conn = connectToDB();
		if($conn!=null){
		$sql="SELECT COUNT(\"".$columnName."\") FROM ".$tableName."";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_row($result);
		if($row ==NULL){
			mysqli_free_result($result);
			mysqli_close($conn);
			return "error";
				}
		else
		{
			mysqli_free_result($result);
			mysqli_close($conn);
			return $row[0];
		}
		}
		return -1;
	}
	
	/**this funciton update the diary in dataBase**/
	function updateDiary($title,$authorName,$content,$imgURL,$year,$month,$day)
	{
	$conn = connectToDB();	
	$sql_1= "select dateID from DateRecord where yearNum=".$year." AND monthNum=".$month." AND dayNum=".$day."";
	$result_1=mysqli_query($conn,$sql_1);
	$row = mysqli_fetch_row($result_1);
	mysqli_free_result($result_1);
	if($row==NULL)
	{
		$row=insertDate($day,$month,$year,$conn);
	}
	$sql ="INSERT INTO Diary(title,authorName,dateID,content,imgURL) VALUES(\"".$title."\",\"".$authorName."\",".intval($row[0]).",\"".$content."\",\"".$imgURL."\")";
	$result=mysqli_query($conn,$sql);
	mysqli_free_result($result);
	mysqli_close($conn);
	return 0;
	}
	
	/**this function is used to insert into the dateRecord if the record is not in the table **/ 
	function insertDate($day, $month,$year,$conn)
	{
		$sql_2="INSERT INTO DateRecord(dayNum,monthNum,yearNum) VALUES(".$day.",".$month.",".$year.")";
		$result_2=mysqli_query($conn,$sql_2);
		$sql_3 ="select dateID from DateRecord where yearNum=".$year." AND monthNum=".$month." AND dayNum=".$day."";
		$result_3=mysqli_query($conn,$sql_3);
		$row =mysqli_fetch_row($result_3);
		mysqli_free_result($result_2);
		mysqli_free_result($result_3);
		return $row;
	}


	/**this funciton is used to fetch the  specified several number of diaries which are edited recently **/
	function fetchDiaries($num,$startNum)
	{
		$rows=array();
		$conn= connectToDB();
		$sql="select * from Diary join DateRecord where Diary.dateID=DateRecord.dateID and Diary.visiable=1 limit ".$startNum.",".$num."";
		if(!$result=mysqli_query($conn,$sql))
		{
			mysqli_free_result($result);
			mysqli_close($conn);
			return NULL;
		}
		else{
			while($row=mysqli_fetch_row($result)){
				$rows[]=$row;
			}
			mysqli_free_result($result);
			mysqli_close($conn);
			return $rows;
			}
			
	}
	/**this function is used to search the specific diary through passing the diary ID**/
	function fetchDiaryByID($diaryID)
	{
		$conn=connectToDB();
		$sql="select * from Diary join DateRecord where Diary.dateID=DateRecord.dateID and Diary.diaryID=".$diaryID." and Diary.visiable=1";
		$result=mysqli_query($conn,$sql);
		if($result==false)
		{
			mysqli_free_result($result);
			mysqli_close($conn);
			return NULL;
		}
		else
		{
		$row=mysqli_fetch_row($result);
		mysqli_free_result($result);
			mysqli_close($conn);
			return $row;
		}
	}
	
	/* This function is used to fetch the fisrt categorial comments under this diary by its diaryID*/
	
		function fetchParentCommentByID($diaryID,$dateID)
	{

		$conn=connectToDB();
		$sql="select * from Comments join DateRecord where Comments.dateID=DateRecord.dateID and diaryID=".$diaryID." and replyID=0";
		$result=mysqli_query($conn,$sql);
		if($result==false)
		{
			mysqli_free_result($result);
			mysqli_close($conn);
			return NULL;
		}
		else
		{
			$rows=array();
			while($row=mysqli_fetch_row($result)){
				$rows[]=$row;
			}
		mysqli_free_result($result);
			mysqli_close($conn);

			return $rows;
		}
	}
	/* This function is to fetch the reply to the comment by passing the parameters of commentID and diaryID*/
	function fetchChildCommentByID($diaryID,$commentID)
	{
		$rows=array();
		$conn=connectToDB();
		$sql="select * from Comments join DateRecord where diaryID=".$diaryID." and Comments.dateID=DateRecord.dateID and replyID=".$commentID."";
		$result=mysqli_query($conn,$sql);
		if($result==false)
		{
			mysqli_free_result($result);
			mysqli_close($conn);
			return NULL;
		}
		else
		{
			while($row=mysqli_fetch_row($result)){
				$rows[]=$row;}
		mysqli_free_result($result);
			mysqli_close($conn);
			return $rows;
		}
	}
	
	
	/**THIS function is used to insert the comments**/
	function insertComment($diaryID,$replyID,$content,$year,$month,$day)
	{
		$conn=connectToDB();
		$sql_1= "select dateID from DateRecord where yearNum=".$year." AND monthNum=".$month." AND dayNum=".$day."";
		$result_1=mysqli_query($conn,$sql_1);
		$row = mysqli_fetch_row($result_1);
		mysqli_free_result($result_1);
		if($row==NULL)
		{
			$row=insertDate($day,$month,$year,$conn);
		}
			$sql="INSERT INTO Comments(diaryID,replyID,content,dateID) VALUES(".$diaryID.",".$replyID.",\"".$content."\",".intval($row[0]).")";
		$result=mysqli_query($conn,$sql);

		if($result==false)
		{
			mysqli_free_result($result);
			mysqli_close($conn);
			return -1;
		}
		else 
		{
			mysqli_free_result($result);
			mysqli_close($conn);
			return 0;
		}
	}

?>
</body>
</html>