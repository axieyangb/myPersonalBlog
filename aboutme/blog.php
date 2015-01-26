<!DOCTYPE html>
<html lang="en">
<head>
<title>Blog</title>
<?php include '../conn/conn.php'?>
<meta charset="utf-8">
<meta name="format-detection" content="telephone=no">
<link rel="icon" href="images/favicon.ico">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="stylesheet" href="css/stuck.css">
<link rel="stylesheet" href="css/style.css">
<script>
 $(document).ready(function(){
  $().UItoTop({ easingType: 'easeOutQuart' });
  $('#stuck_container').tmStickUp({});
});

	


</script>
<!--[if lt IE 9]>
 <div style=' clear: both; text-align:center; position: relative;'>
   <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
     <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
   </a>
</div>
<script src="js/html5shiv.js"></script>
<link rel="stylesheet" media="screen" href="css/ie.css">
<![endif]-->
</head>
<body id="top">
<!--==============================
              header
=================================-->
<header>
<!--==============================
            Stuck menu
=================================-->
  <section id="stuck_container">
    <div class="container">
      <div class="row">
        <div class="grid_12">
        <h1>
          <a href="index.html">
            <img src="images/logo.png" alt="Logo alt">
          </a>
        </h1>
          <div class="navigation ">
            <nav>
              <ul class="sf-menu">
               <li class="current"><a href="about.html">About</a></li>
               <li class="current"><a href="blogBox.php?">Blog</a></li>
               <li class="current"><a href="../index.html">Back</a></li>
             </ul>
            </nav>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</header>
<!--=====================
          Content
======================-->
<section class="content"><div class="ic">More Website Templates @ TemplateMonster.com - June 16, 2014!</div>
  <div class="container">
    <div class="row">
      <div class="grid_7">
        <h3 class="ta__center">Blog</h3>
        
 <?php
 if(isset($_GET["pageNum"]))
 	$pageNum=$_GET["pageNum"];
 else
	 $pageNum=0;
 	echo "<div><iframe id=\"frame\" src=\"blogBox.php?pageNum=".$pageNum."\" width=\"100%\" height=\"1200px\" frameborder=\"0\"></iframe></div>";
 	?>
     <div class="pagination" id="pagination">
     
		<a href="#" class="page" style="display:none"><<</a>
        
        <?php	

		if(isset($_GET["pageNum"]))
			$currentNum=$_GET["pageNum"];
		else $currentNum=0;
		
	$numOfArticle=searchNum("Diary",diaryID);
		
		
		//echo "<a href=\"blog.php?pageNum=0\" class=\"page\" ><<</a>";
       for($i=0;$i<ceil($numOfArticle/3);$i++)
			echo "<a href=\"blog.php?pageNum=".($i*3)."\" class=
		\"page\">".($i+1)."</a>";

		//echo "<a href=\"blog.php?pageNum=".($numOfArticle-floor($numOfArticle/15)*15)."\" class=\"page\" >>></a>";
		
        ?>
   		</div>
      </div>
      
      
      <div class="grid_4 preffix_1">
        <h3>Search</h3>
        <form id="search" action="search.php" method="GET">
        <div class="rel">
          <label>
            <input type="text" name="s">
          </label>
          <a onClick="document.getElementById('search').submit()" class=""></a>
        </div>
         <div class="clear"></div>
       </form>
       <h3>Categories</h3>
       <ul class="list color1">
         <li><a href="#">Besit ametconsecteturertolom  werto monikosit </a></li>
         <li><a href="#">Amet ultricies erateroli me rutruma auctorerttu </a></li>
         <li><a href="#">Terolp sadertto mertoInteger convawertolo  </a></li>
         <li><a href="#">Amertoloolaoreetatwertlim wernom fertolom </a></li>
         <li><a href="#">Dolor sit amsecteturertolom  lid be</a></li>
         <li><a href="#">Moniko lomon dertlosit amet ultricies erater </a></li>
         <li><a href="#">Rutruma auctorert retlomoni molokintromoli</a></li>
         <li><a href="#">Convallis orci vel mi laoreetat terolo </a></li>
       </ul>
       <h3>Poll</h3>
       <ul class="rate">
         <li>
           <span>Super</span>
           <span>39%</span>
           <div class="bar">
             <div class="scale"></div>
           </div>
         </li>
         <li>
           <span>Good</span>
           <span>31%</span>
           <div class="bar">
             <div class="scale"></div>
           </div>
         </li>
         <li>
           <span>Normal</span>
           <span>20%</span>
           <div class="bar">
             <div class="scale"></div>
           </div>
         </li>
         <li>
           <span>Bad </span>
           <span>11%</span>
           <div class="bar">
             <div class="scale"></div>
           </div>
         </li>
       </ul>
      </div>
    </div>
  </div>
</section>
<!--==============================
              footer
=================================-->
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="grid_12">
        <div class="socials">
          <a href="#" class="fa fa-twitter"></a>
          <a href="#" class="fa fa-facebook"></a>
          <a href="#" class="fa fa-google-plus"></a>
          <a href="#" class="fa fa-youtube-play"></a>
        </div>
        <div class="copyright"><span class="brand">Web Design</span> &copy; <span id="copyright-year"></span> | <a href="#">Privacy Policy</a> <div>Website designed by <a href="http://www.templatemonster.com/" rel="nofollow">TemplateMonster.com</a></div>
        </div>
      </div>
    </div>
  </div>
</footer>
</body>
</html>