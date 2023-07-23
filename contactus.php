<?php
include_once("php/session.php");

$title = "IT Tutorials";
$description = "Easy to understand tutorials with lots of sample codes in programming languages Java,
 Python, JavaScript, PHP, HTML, CSS, C++, C# etc.";
//$image_url = "Your Image URL";
$keywords = "Software, IT, Tutorials, Code Samples";

//SM-TODONE-Revert below
$page_url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$path = urldecode($_SERVER["REQUEST_URI"]);
$path = substr($path, 1);

$isPHPUrl = false;

$isCrawler = isset($_SERVER['HTTP_USER_AGENT'])
   && preg_match('/bot|crawl|slurp|spider|mediapartners|InspectionTool|GoogleOther/i', $_SERVER['HTTP_USER_AGENT']);



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
   <meta name="description" content="<?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>">
   <meta property="og:title" content="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>">
   <meta property="og:description" content="<?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>">

   <meta property="og:url" content="<?php echo $page_url; ?>">
   <meta name="keywords" content="<?php echo $keywords; ?>">

   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <meta name="author" content="Numerouno" />
   <title>IT Tutorials</title>
   <!-- Favicon-->
   <link rel="icon" type="image/x-icon" href="/itcodescanner/assets/favicon.ico" />
   <link rel="canonical" href="https://itcodescanner.com" />
   <?php include 'main-links.html'; ?>
   <?php include 'head-add.html'; ?>
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
<div class="d-flex" id="wrapper">
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
       <!-- Top navigation-->

         <?php include 'topnav.php'; ?>

       <!-- End of Top navigation-->
       <!-- Page content-->


       <div id="containerNHelpDivId" >
          <svg id="bgSVGId" class="bgSVG displayNone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7559DA" fill-opacity="1" d="M0,224L30,197.3C60,171,120,117,180,117.3C240,117,300,171,360,197.3C420,224,480,224,540,208C600,192,660,160,720,165.3C780,171,840,213,900,245.3C960,277,1020,299,1080,272C1140,245,1200,171,1260,165.3C1320,160,1380,224,1410,256L1440,288L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>

          <div id="mainContainer" class="panel-container panel-left">
            <div id="contactusDivId" >
                <div id="contactusSecDivId" style="margin: 0 auto;   padding: 20px; ">
                   <label style="font-size: 14px; font-weight: 900; color: #333 "> CONTACT US </label>
                   
                   <?php include 'sendMsg.html'; ?>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>

<?php include 'footer.html'; ?>
</body>
<script>
   setTimeout(function () {
    refreshCaptcha();
   }, 100);
</script>
</html>