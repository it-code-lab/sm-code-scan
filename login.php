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
          <div id="loginDivId" class="login" >
                <div id="loginSecDivId" style="margin-top: 20px;">
                   <label style="font-size: 14px; font-weight: 900; color: #333 "> LOGIN </label>
                   <hr>
                   <input class="un " id='emailid' type="text" align="center" placeholder="Login Email Id">
                   <input class="pass" id='password' type="password" align="center" placeholder="Password">
                   <br>
                   <label id="loginerrormsg" style="color: #cc0000; font-size: 14px;"></label>
                   <br>
                   <br>
                   <button class="helper btnCenterAlign" style="width: 60%" onclick="login();">Log in</button>
                   <br>
                   <br>
                   <a href="#!" style="color: #888;  " onMouseOver="this.style.color='#000'"
                      onMouseOut="this.style.color='#888'" onclick="showCreateAccount();">Not registered? Create
                      account</a>
                   <br>
                   <a href="#!" style="color: #888;  " onMouseOver="this.style.color='#000'"
                      onMouseOut="this.style.color='#888'" onclick="showForgotPassword();">Forgot Password? Reset</a>
                </div>
                <div id="registerSecDivId" class="displayNone" style="margin-top: 20px;">
                   <label style="font-size: 14px; font-weight: 900; color: #333 "> REGISTER </label>
                   <hr>
                   <input class="un" id='registerusname' type="text" placeholder="Your full name">
                   <input class="un " id='registeremailid' type="text" align="center" placeholder="Login Email Id">
                   <input class="pass" id='registerpassword' type="password" align="center"
                      placeholder="Set Password">
                   <input class="pass" id='registerpasswordre' type="password" align="center"
                      placeholder="Re-enter Password">
                   <br>
                   <label id="registererrormsg" style="color: #cc0000; font-size: 14px"></label>
                   <br>
                   <br>
                   <button class="helper btnCenterAlign" style="width: 300px" onclick="register();">Register</button>
                   <!---->
                   <br>
                   <br>
                   <a href="#!" style="color: #888;  " onMouseOver="this.style.color='#000'"
                      onMouseOut="this.style.color='#888'" onclick="showLogin();">Go back to Login</a>
                </div>
                <div id="forgotPasswordSecDivId" class="displayNone" style=" margin-top: 20px; ">
                   <label style="font-size: 14px; font-weight: 900; color: #333 "> FORGOT PASSWORD </label>
                   <hr>
                   <label>Enter your email address and we will email you instructions on password reset</label>
                   <br>
                   <br>
                   <input class="un " id='forgotpwemailid' type="text" align="center" placeholder="Login Email Id">
                   <br>
                   <label id="forgotpwerrormsg" style="color: #cc0000; font-size: 14px"></label>
                   <br>
                   <br>
                   <button class="helper btnCenterAlign" style="width: 300px" align="center" onclick="forgotpw();">Send</button>
                   <!---->
                   <br>
                   <br>
                   <a href="#!" style="color: #888;  " onMouseOver="this.style.color='#000'"
                      onMouseOut="this.style.color='#888'" onclick="showLogin();">Go back to Login</a>
                </div>
                <div id="accActivatedDivId" class="displayNone" style="margin-top: 20px;">
                   <label style="font-size: 14px; font-weight: 900; color: #333 "> ACCOUNT ACTIVATED </label>
                   <hr>
                   <label>Your account has been activated successfully. You can proceed to login</label>
                   <!---->
                   <br>
                   <br>
                   <a href="#!" style="color: #888;  " onMouseOver="this.style.color='#000'"
                      onMouseOut="this.style.color='#888'" onclick="showLogin();">Login</a>
                </div>
                <div id="forgotPWDivId" class="displayNone" style="margin-top: 20px; ">
                   <label style="font-size: 14px; font-weight: 900; color: #333 "> SET PASSWORD </label>
                   <hr>
                   <!---->
                   <br>
                   <input class="pass" id='newpassword' type="password" align="center" placeholder="Set New Password">
                   <br>
                   <input class="pass" id='newpasswordRe' type="password" align="center"
                      placeholder="Re-enter New Password">
                   <br>
                   <label id="newpwerrormsg" style="color: #cc0000; font-size: 14px"></label>
                   <br>
                   <div id="setPwDivId">
                      <button class="helper btnCenterAlign" style="width: 300px" align="center" onclick="setPassword();">Set
                         Password</button>
                   </div>
                   <div id="setPwSuccessDivId" style="display: none">
                      <label style="color: orange">Your account password has been set successfully. You can proceed to
                         login</label>
                      <!---->
                      <br>
                      <br>
                      <a href="#!" style="color: #888;  " onMouseOver="this.style.color='#000'"
                         onMouseOut="this.style.color='#888'" onclick="showLogin();">Login</a>
                   </div>
                </div>
             </div>
          </div>
       </div>

       <?php include 'footer.html'; ?>
</body>

</html>