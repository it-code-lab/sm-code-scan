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
       <body>
         <?php include 'topnav.php'; ?>
         </body>
       <!-- End of Top navigation-->
       <!-- Page content-->
       <body>

       <div id="containerNHelpDivId" >
          <svg id="bgSVGId" class="bgSVG displayNone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7559DA" fill-opacity="1" d="M0,224L30,197.3C60,171,120,117,180,117.3C240,117,300,171,360,197.3C420,224,480,224,540,208C600,192,660,160,720,165.3C780,171,840,213,900,245.3C960,277,1020,299,1080,272C1140,245,1200,171,1260,165.3C1320,160,1380,224,1410,256L1440,288L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>

          <div id="mainContainer" class="panel-container panel-left">

             <!--*************************************************************--->
             <!--***********************START - HOME DIV**********************--->
             <!--*************************************************************--->
             <div id="homeDivId" classXX="displayNone">
                <div class="bannerParent">
                   <div class="bannerContainer">
                      <div class="bannerContent" >
                         <!-- <div class="bannerinner">
                            <i class='fas fa-desktop desktop-icon'></i> <i class="divider"></i> IT CODE SCANNER
                         </div> -->
                         <label class="bannerLargeText scale-in-center" style="animation-delay: 0.8s; animation-duration: 0.5s;">IT Code Scanner</label>
                         <br>
                         <hr class="slide-in-left" style="animation-delay: 0.2s">
                         <label class="bannerSmallText scale-in-center" style="animation-delay: 1.2s; animation-duration: 1s;">Spend
                            less time in learning the code</label>
                      </div>
                   </div>
                   
                   <div id="homeCardsContainerDivId">
                   <a href="/itcodescanner/tutorials">
                      <div class="menucard" >
                         <img src="/itcodescanner/images/tutorials.png" alt="Tutorials" class="homeCardImg">
                         <div class="homeCardText">Tutorials</div>
                         <hr>
                         <div class="cardMsg">Tutorials and sample programs.</div>
                      </div>
                      </a>
                      <a href="/itcodescanner/contactus">
                      <div class="menucard" onclick="Show('contactus')">
                         <img src="/itcodescanner/images/howto.png" alt="File Scan" class="homeCardImg">
                         <div class="homeCardText">Question or Comments</div>
                         <hr>
                         <div class="cardMsg">Contact Us</div>
                      </div>
                    </a>
                   </div>
                 

                   <div  style="display:none; background-color: rgba(9, 84, 132); width: 100%; margin: 0px; padding: 20px; ">
                      <label style="color: white"> Lots of programming languages supported. Some of them are listed
                         below. </label>
                      <hr style="color: #ccc">
                      <div style="display: flex; flex-direction: row; width: 100%; margin: auto; overflow: auto">
                         <img src="/itcodescanner/images/java.png" alt="Java" class="languageicon">
                         <img src="/itcodescanner/images/python.png" alt="python" class="languageicon">
                         <img src="/itcodescanner/images/javascript.png" alt="JavaScript" class="languageicon">
                         <img src="/itcodescanner/images/php.png" alt="php" class="languageicon">
                         <img src="/itcodescanner/images/html.png" alt="html" class="languageicon">
                         <img src="/itcodescanner/images/csharp.png" alt="c#" class="languageicon">
                         <img src="/itcodescanner/images/cobol.png" alt="cobol" class="languageicon">
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>

       <?php include 'footer.html'; ?>
</body>

</html>