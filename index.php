<?php
include_once("php/session.php");

$title = "IT Tutorials";
$description = "Easy to understand tutorials with lots of sample codes in programming languages Java,
 Python, JavaScript, PHP, HTML, CSS, C++, C#. Also providing
 feature to scan and help understand the programming code";
//$image_url = "Your Image URL";
$keywords = "Software, IT, Tutorials, Code Samples";

//SM-TODONE-Revert below
$page_url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
//$page_url = $_SERVER["REQUEST_URI"];

$path = urldecode($_SERVER["REQUEST_URI"]);
$path = substr($path, 1);

$isCrawler = isset($_SERVER['HTTP_USER_AGENT'])
&& preg_match('/bot|crawl|slurp|spider|mediapartners|InspectionTool/i', $_SERVER['HTTP_USER_AGENT']);

if (strpos($path, 'tutorials/') !== false) {
    $itemstr = substr($path, strpos($path, "tutorials/") + 10);
    if (strpos($itemstr, '/') !== false) {
      if (isset($_SESSION['datafetched_XX'])) {
         $title = $_SESSION['webTitle'];
         $description = $_SESSION['webDesc'] ;
         //$image_url = "https://itcodescanner.com/getimage/".$_SESSION['image_nm'];
         $keywords = $_SESSION['webKeywords'];
         $webFullDesc = $_SESSION['webFullDesc'];
      } else {
         $dummy = $database->getTutorial($itemstr);
         if ($dummy != "Err in DB call") {
            $title = $_SESSION['webTitle'];
            $description = $_SESSION['webDesc'] ;
            //$image_url = "https://itcodescanner.com/getimage/".$_SESSION['image_nm'];
            $keywords = $_SESSION['webKeywords'];
            $webFullDesc = $_SESSION['webFullDesc'];
         }
      }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Google tag (gtag.js) -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-JMD8K2RLDE"></script>
   <script>
   window.dataLayer = window.dataLayer || [];
   function gtag(){dataLayer.push(arguments);}
   gtag('js', new Date());

   gtag('config', 'G-JMD8K2RLDE');
   </script>

   <meta charset="utf-8" />
   <title><?php echo $title; ?></title>
   <meta name="description" content="<?php echo $description; ?>">
   <meta property="og:title" content="<?php echo $title; ?>">
   <meta property="og:description" content="<?php echo $description; ?>">

   <meta property="og:url" content="<?php echo $page_url; ?>">
   <meta name="keywords" content="<?php echo $keywords; ?>">

   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <meta name="author" content="Numerouno" />
   <title>IT Tutorials</title>
   <!-- Favicon-->
   <link rel="icon" type="image/x-icon" href="/itcodescanner/assets/favicon.ico" />
   <!-- Core theme CSS (includes Bootstrap)-->
   <link href="/itcodescanner/css/styles.css" rel="stylesheet" />
   <link href="/itcodescanner/css/smtheme-v1.02.css" rel="stylesheet" />
   <!--  
         <link href="/itcodescanner/css/bootstrap.min.css" rel="stylesheet" />
         -->
   <link href="/itcodescanner/css/codescriber-v0.2.css" rel="stylesheet" />

   <link href="/itcodescanner/css/codemirror.css" rel="stylesheet" />
   <link href="/itcodescanner/css/slidestyles.css" rel="stylesheet" />
   <link href="/itcodescanner/css/smstylegtlimit.css" rel="stylesheet" />
   <link href="/itcodescanner/css/smstyleltlimit.css" rel="stylesheet" /> 
   <link rel="stylesheet" href="/itcodescanner/web/common-style.css">

   <script src="/itcodescanner/web/common-function-v0.7.js"></script>
   <!-----
         <script src="/itcodescanner/web/common-function-mini.js"></script>
         -->


   
   <link rel="stylesheet" href="/itcodescanner/css/default.min.css">
   <!--REF: https://highlightjs.org/usage/ -->
   <script src="/itcodescanner/js/highlight.min.js"></script>

   <?php if (!$isCrawler):  ?>
      <?php include 'head-add.html'; ?>
   <?php endif; ?>

   <script type="application/ld+json">{
			"@context": "https://schema.org/",
			"@type":"WebSite","url":"https://itcodescanner.com/",
			"name": "IT Code Scanner - Tutorials and Code Samples",
			"datePublished": "2022-07-10",
			"description": "IT Code Scanner - Tutorials and Code Samples.",
			"thumbnailUrl": "https://itcodescanner.com/images/banner.png"         
		 }
		 </script>

</head>

<body>
<?php if (!$isCrawler):  ?>
   <?php include 'body-main.html'; ?>
<?php else: ?>
   <h1> <?=$_SESSION['webTitle']?> </h1><br>
   
   
   <div style="margin: auto; padding:10px">
   <?= $_SESSION['webFullDesc'] ?>
   </div>
<?php endif; ?>
<?= $_SERVER['HTTP_USER_AGENT'] ?>
</body>

</html>