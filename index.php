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

if (strpos($path, 'tutorials/') !== false) {
    $itemstr = substr($path, strpos($path, "tutorials/") + 10);
    if (strpos($itemstr, '/') !== false) {
      if (isset($_SESSION['datafetched_XX'])) {
         $title = $_SESSION['webTitle'];
         $description = $_SESSION['webDesc'] ;
         //$image_url = "https://itcodescanner.com/getimage/".$_SESSION['image_nm'];
         $keywords = $_SESSION['webKeywords'];
      } else {
         $dummy = $database->getTutorial($itemstr);
         if ($dummy != "Err in DB call") {
            $title = $_SESSION['webTitle'];
            $description = $_SESSION['webDesc'] ;
            //$image_url = "https://itcodescanner.com/getimage/".$_SESSION['image_nm'];
            $keywords = $_SESSION['webKeywords'];
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
   <link href="/itcodescanner/css/codemirror.css" rel="stylesheet" />
   <link href="/itcodescanner/css/slidestyles.css" rel="stylesheet" />
   <link href="/itcodescanner/css/smtheme-v1.02.css" rel="stylesheet" />
   <!--  
         <link href="/itcodescanner/css/bootstrap.min.css" rel="stylesheet" />
         -->
   <link href="/itcodescanner/css/codescriber-v0.2.css" rel="stylesheet" />
   <link href="/itcodescanner/css/smstylegtlimit.css" rel="stylesheet" />
   <link href="/itcodescanner/css/smstyleltlimit.css" rel="stylesheet" />   
   <!-- 
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
         
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type='text/css'>
         -->
   <script src="https://kit.fontawesome.com/2e937192fc.js" crossorigin="anonymous"></script>
   <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
      integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
   <link rel="stylesheet" href="/itcodescanner/web/common-style.css">
   <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=default&flags=gated"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.min.js"
      integrity="sha256-dPTL2a+npIonoK5i0Tyes0txCMUWZBf8cfKRfACRotc=" crossorigin="anonymous"></script>
   <!-- Codemirror Modes -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/mode/xml/xml.min.js"
      integrity="sha256-cphnEddX56MtGJsi1PoCPLds+dlnDj1QQkAlCWeJYDo=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/mode/javascript/javascript.min.js"
      integrity="sha256-7AjEsHnW7cpq2raC/uxnGCP2G4zIKmCdz7OAv6LN00o=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/mode/css/css.min.js"
      integrity="sha256-mjhvNBMExwa2AtP0mBlK9NkzJ7sgRSyZdgw9sPhhtb0=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/mode/htmlmixed/htmlmixed.min.js"
      integrity="sha256-qfS6ZUe6JhPU75/Sc1ftiWzC2N9IxGEjlRwpKB78Ico=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/addon/search/search.js"
      integrity="sha256-iUnNlgkrU5Jj8oKl2zBBCTmESI2xpXwZrTX+arxSEKc=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/addon/search/searchcursor.min.js"
      integrity="sha256-y7nxCQ9bT6p4fEq9ylGxWfMQBpL6ingXkav6Nr1AcZ8=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/addon/dialog/dialog.min.js"
      integrity="sha256-G+QhvxjUNi5P5cyQqjROwriSUy2lZtCFUQh+8W1o6I0=" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/addon/dialog/dialog.css"
      integrity="sha256-XfaQ13HxIRg0hWLdKpAGBDOuLt7M0JCKvKpEgLHj5Gg=" crossorigin="anonymous" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script src="/itcodescanner/js/jquery-resizable-delit.js"></script>
   <!--REF: https://medium.com/@petehouston/remove-tinymce-warning-notification-on-cloud-api-key-70a4a352b8b0 -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.2/tinymce.min.js" referrerpolicy="origin"></script>

   <!--REF: https://highlightjs.org/usage/ -->
   <link rel="stylesheet" href="/itcodescanner/css/default.min.css">
   <script src="/itcodescanner/js/highlight.min.js"></script>
   
    <script>
      tinymce.init({
         selector: '.tiny',
         menubar: false,
         plugins: "textcolor, lists, autoresize",
         toolbar: 'undo redo | styleselect | forecolor backcolor | numlist bullist '

      });
   </script>
   <!--
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
         -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"
      integrity="sha256-oE03O+I6Pzff4fiMqwEGHbdfcW7a3GRRxlL+U49L5sA=" crossorigin="anonymous"></script>
    <!-- <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>  -->
   <!--
         <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js" integrity="sha256-1fEPhSsRKlFKGfK3eO710tEweHh1fwokU5wFGDHO+vg=" crossorigin="anonymous"></script>
         -->
   <script src="/itcodescanner/js/lib/unpackers/javascriptobfuscator_unpacker.js"></script>
   <script src="/itcodescanner/js/lib/unpackers/urlencode_unpacker.js"></script>
   <script src="/itcodescanner/js/lib/unpackers/p_a_c_k_e_r_unpacker.js"></script>
   <script src="/itcodescanner/js/lib/unpackers/myobfuscate_unpacker.js"></script>
   <!---->
   <!-- <script src="/itcodescanner/web/common-editor-function.js"></script> -->
   <script src="/itcodescanner/web/common-function-v0.7.js"></script>
   <!-----
         <script src="/itcodescanner/web/common-function-mini.js"></script>
         -->

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
         <div class="topnav" id="myTopnav">
            <a id="homeLinkId" href="/itcodescanner/?target=home">HOME</a>

            <a id="tutorialLinkId" href="/itcodescanner/?target=tutorial">TUTORIALS <i  class="fa fa-caret-down"></i></a> 
            <div id="dropDownTutListId" class="dropdown-content">
               <a href="#">Link 1</a>
               <a href="#">Link 2</a>
               <a href="#">Link 3</a>
            </div>   
                     

            <a id="projectscannerLinkId" href="/itcodescanner/?target=projectscanner">PROJECT SCANNER</a>
            <a id="filescannerLinkId" href="/itcodescanner/?target=filescanner">FILE SCANNER</a>
            <a id="HelpTopicsLinkId" style="display:none" href="/itcodescanner/?target=HelpTopics">HELP TOPICS</a>
            <a id="howtoLinkId" href="/itcodescanner/?target=howto">HOW TO VIDEOS</a>
            <a id="contactusLinkId" href="/itcodescanner/?target=contactus">CONTACT US</a>
            <a id="loginLinkId" href="/itcodescanner/?target=login">LOG IN</a>
            <a id="logoutLinkId" style="display:none" href="javascript:Logout()">LOGOUT</a>
            <a id="profileLinkId" style="display:none" href="/itcodescanner/?target=profile"">PROFILE</a>
            <a id="buymecoffee" href="https://www.buymeacoffee.com/smah" target="_blank">
               <i id="coffeeBtn" class="fas fa-coffee"
                  style=" font-size: 12px; border-radius: 5px; padding: 2px; ">&nbsp; <span
                     style="font-family: var(--bs-font-sans-serif); font-size: 14px; font-weight: 300;">Buy me a coffee
                     <span></i>
            </a>

            <a class="searchWrapper"><span id="itemsearchDivId">
               <form autocomplete="off" class="dummyForm">
                  <input id='tutorial-search-box' data-dropdownset='n' type='text' name='item' autocomplete='off'
                     placeholder='search' />
                  <button id="itemsearchBtnId" class='' onclick='searchTutorial(); return false;'><i
                        class="fas fa-search"></i></button>
               </form>
               </span>
            </a>

            <a href="javascript:void(0);" class="icon" style="margin-right: 20px" onclick="myTopNavFunction()">
               <i class="fa fa-bars"></i>
            </a>
         </div>
         
         <!-- End of Top navigation-->
         <!-- Page content-->
         <div id="loaderDivId">
            <div class="loader2">
               <span></span>
               <span></span>
               <span></span>
               <span></span>
            </div>

            <!-- SM:DONOTDELETE -->
            <!-- <div class="loader">
               <i class="loaderDot"></i>
               <i class="loaderDot"></i>
               <i class="loaderDot"></i>
            </div> -->
         </div>
         <div id="containerNHelpDivId" >
            <svg id="bgSVGId" class="bgSVG displayNone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7559DA" fill-opacity="1" d="M0,224L30,197.3C60,171,120,117,180,117.3C240,117,300,171,360,197.3C420,224,480,224,540,208C600,192,660,160,720,165.3C780,171,840,213,900,245.3C960,277,1020,299,1080,272C1140,245,1200,171,1260,165.3C1320,160,1380,224,1410,256L1440,288L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>

            <div id="mainContainer" class="panel-container panel-left">

               <!--*************************************************************--->
               <!--***********************START - HOME DIV**********************--->
               <!--*************************************************************--->
               <div id="homeDivId">
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
                        <div class="menucard" onclick="Show('tutorial')"">
                           <img src="/itcodescanner/images/tutorials.png" alt="Tutorials" class="homeCardImg">
                           <div class="homeCardText">Tutorials</div>
                           <hr>
                           <div class="cardMsg">Tutorials and sample programs.</div>
                           <!-- <p><button onclick="Show('tutorial')">Go</button></p> -->
                        </div>
                        <!-- <div class="menucard" onclick="Show('projectscanner')">
                           <img src="/itcodescanner/images/prjscan.png" alt="Project Scan" class="homeCardImg">
                           <div class="homeCardText">Project Scanner</div>
                           <hr>
                           <div class="cardMsg">Scan all the files in the project folder and see the help content for
                              easy interpretation.</div>
                        </div>
                        <div class="menucard" onclick="Show('filescanner')">
                           <img src="/itcodescanner/images/filescan.png" alt="File Scan" class="homeCardImg">
                           <div class="homeCardText">File Scanner</div>
                           <hr>
                           <div class="cardMsg">Scan single file or program and see the help content</div>
                        </div>
                        <div class="menucard" onclick="Show('howto')">
                           <img src="/itcodescanner/images/howto.png" alt="File Scan" class="homeCardImg">
                           <div class="homeCardText">How to use</div>
                           <hr>
                           <div class="cardMsg">Video guides</div>
                        </div> -->


                        <div class="menucard" onclick="Show('contactus')">
                           <img src="/itcodescanner/images/howto.png" alt="File Scan" class="homeCardImg">
                           <div class="homeCardText">Question or Comments</div>
                           <hr>
                           <div class="cardMsg">Contact Us</div>
                           <!-- <p><button onclick="Show('howto')">Go</button></p> -->
                        </div>

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
               <!--*************************************************************--->
               <!--***********************END - HOME DIV**********************--->
               <!--*************************************************************--->
               
               <!--*************************************************************--->
               <!--***********************START - TUTORIALS LIST DIV************--->
               <!--*************************************************************--->

               <div class='showTutorialListDiv'>Show List
               </div>

               <div id="tutorialListDivId">
                  <!-- <div id="tutorialSearchDivId"><input id='tutorial-search-box' type='text' name='tutorial'
                        autocomplete='off' placeholder='search' />
                     <button id="tutorialSearchBtnId" class='searchButtonCls'
                        onclick='searchTutorial(); return false;'>Search</button>
                  </div> -->
                  <div id="tutorialListInnerDivId"></div>

               </div>
               <div id="tutorialDivId">
               </div>

               <div id="tutorialEditDivId">
               </div>

               <!--*************************************************************--->
               <!--***********************END - TUTORIALS LIST DIV**************--->
               <!--*************************************************************--->

               <!--*************************************************************--->
               <!--***********************START - PROJECT SCANNER DIV***********--->
               <!--*************************************************************--->
               <div id="projectscannerDivId">
                  <!--
                        <input type="file" id="ctrl" onchange="handleFolderSelect(this)" webkitdirectory directory multiple/>
                        -->
                  <div id="StoredPrjDivId">
                     <div id="StoredPrjInnerDivId" >
                        <!--* ***TEMPORARY**SM-T001***Refer User Guide**
                              <button class="buttonClsClose" type="button" style="float: right;  margin-left: 5px; margin-right: 5px; " onclick="hideDiv('projectscannerDivId')">Close</button>	
                              
                              <button class="buttonCls" type="button" style="float: right" onclick="addNewProject()">Add Project</button>
                              -->
                        <button id="addNewProjBtnId" class="buttonCls" type="button" 
                           onclick="addNewProject()">Add Project</button>
                     </div>
                     <!--* ***TEMPORARY**SM-T001***Refer User Guide**
                           <div id="prjSelectionMsg" style=" padding: 5px; text-align: justify; text-justify: inter-word; border: 1px solid #ccc; margin: 0px; margin-bottom: 0px; color: #545454; font-family: 'Roboto-Bold', Verdana, Sans-serif !important; font-weight: 500; background: #e6e0e7;">Project Scanner
                              
                              <br>
                              Click on the 'Add Project' button at the top right to store the project for future reference.
                              
                           </div>
                           -->
                     <div id="srcCodeDivId" >
                        <!--
                              <div class="headerDivCls">Select source code folder </div>
                              
                              <input id="pickers" type="file" onchange="handleFolderSelectTwo(this)" webkitdirectory multiple />		
                              -->
                        <input  id="pickers" type="file"
                           onchange="handleFolderSelectTwo(this)" webkitdirectory multiple>
                        <label for="pickers" id="pickersLabel"><i
                              class='fas fa-folder-open' id='pickersLabelTxt'
                              ></i>&nbsp; Select source code
                           folder</label>
                        <span class="menuBtn" onclick="expandContractProjectDiv()" id="menuBtnSpan"
                           >
                           <i class="leftTip fa fa-adjust" id="menuBtnSpanI" ><span id="menuBtnSpanISpan"
                                 >Expand/Shrink<span></i>
                        </span>
                        <div id="NewProjectStructureDisplayIdTwo" class="ProjectFilesListDiv">
                        </div>
                     </div>
                     <div id="projectList">
                        <div id="savedProjectList" >
                        </div>
                     </div>
                  </div>
                  <!--
                        //http://jsfiddle.net/xozvprdj/
                        https://makandracards.com/makandra/54804-html-file-inputs-support-picking-directories
                        -->
                  <div id="AddNewProjectDivId"
                     >
                     <input id="project-language-box" type="text"  name="language" autocomplete="off"
                        placeholder="Language" />
                     <input id="project-sub-tech-box" type="text"  name="sub-tech" autocomplete="off"
                        placeholder="Technology (Optional)" />
                     <div>
                        <input id="project-name-box" type="text" autocomplete="off"
                           placeholder="Project Name" />
                        <input id="project-path-box" type="text" autocomplete="off"
                           placeholder="Project Root Path" />
                     </div>
                     <div>
                        <p id="addProjectP" >Details
                           <i class="tip fa" id="addProjectPI" >&#xf05a;<span>Details to help
                                 understand the project <br>e.g. Front End, Back End, Database, <br> Key functionalies,
                                 How and where it <br>is deployed, Recurring Costs, When to <br>use, How to
                                 use.</span></i>
                        </p>
                        <textarea id="project_details" class="fullWidth tiny" rows="5"></textarea>
                     </div>
                     <!--
                           <input id="project-sub-folder-box" type="text"	name="sub-folder" autocomplete="off" placeholder="Subfolder (Optional)"/>							
                           <input type="file" id="ctrl" onchange="handleFolderSelect(this)" directory multiple/>
                           -->
                     <br>
                     <input id="picker" type="file" onchange="handleFolderSelect(this)" webkitdirectory multiple />
                     <div id="NewProjectStructureDisplayId" class="ProjectFilesListDiv">
                     </div>
                     <div id="prjCustDiv1" >
                        <button class="buttonCls" type="button" onclick="resetProjectFiles()">Reset Files</button>
                        <button class="buttonCls" type="button" onclick="saveProject()">Save Project</button>
                        <button class="buttonClsClose"  type="button"
                           onclick="cancelNewProjectAdd()">Close</button>
                     </div>
                     <div>
                        <label id="saveProjectMsg" ></label>
                     </div>
                  </div>
               </div>

               <!--*************************************************************--->
               <!--***********************END - PROJECT SCANNER DIV*************--->
               <!--*************************************************************--->

               <!--*************************************************************--->
               <!--***********************START - FILE SCANNER DIV**************--->
               <!--*************************************************************--->
               <div id="filescannerDivId">
                  <div id="filescannerInnerDivId" >
                     <!--	
                           <div id="prjSelectionMsg" style=" padding: 5px; text-align: justify; text-justify: inter-word; border: 1px solid #ccc; color: #545454; font-family: 'Roboto-Bold', Verdana, Sans-serif !important; font-weight: 500; background: #e6e0e7; margin-bottom: 0px;">File Scanner
                           </div>	
                           -->
                     <div id="filescannerInner2DivId"  >
                        <input style="display:none;" type="file" id="files" onchange="changeToFileContent(this)">
                        <label id="selectfile" for="files"><i id="selectfileI"
                              class='fas fa-folder-open' ></i>&nbsp; Open
                           file</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="menuBtn" id="scanEditbtnId" onclick="scan()"
                           >
                           <i class="smalltip fa fa-search"
                              style="cursor:pointer; font-size:16px; color:blue"><span>Scan</span></i>
                        </span>
                        <span class="menuBtn" id="addHelpSpan" onclick="addHelp()" >
                           <i class="smalltip fa fa-plus-square" id="addHelpSpanI"><span>Add Help</span></i>
                        </span>
                        <span class="menuBtn" id="btnCloseFileScanner" 
                           onclick="hideDiv('filescannerDivId')">
                           <i class="tip fa fa-close" id="btnCloseFileScannerI" ><span>Hide this
                                 section</span></i>
                        </span>
                        <span class="menuBtn" id="expandContractSpan" onclick="expandContractFileDiv()"
                           >
                           <!---							 
                              <i class="tip fa fa-arrows-alt" style="cursor:pointer; font-size:16px; color:black"></i>
                              -->
                           <i class="leftTip fa fa-adjust" id="expandContractSpanI" ><span id="expandContractSpanISpan">Expand/Shrink<span></i>
                        </span>


                        <div id="displayFileLoaderDivId" >
                           Loading..
                           <!--
                                 <i class="loaderDot" ></i>
                                 <i class="loaderDot" ></i>
                                 <i class="loaderDot" ></i>
                                 -->
                        </div>
                     </div>
                     <div id="sourceDiv" >
                        <textarea id="source" style="overflow:auto;"></textarea>
                     </div>
                     <!-- <div id="targetX" style="height: 400px; width: 100%; white-space: nowrap; overflow-y: scroll; overflow-x: scroll" >xx</div>
                           -->
                     <div id="destinationDiv" class="CodeMirror cm-s-default">
                        <div id="destinationInnerDiv" class="CodeMirror-scroll" tabindex="-1" draggable="false" >
                           <div class="CodeMirror-sizer" id="destinationInnerDiv2" >
                              <div id="destinationInnerDiv3" >
                                 <div class="CodeMirror-lines" role="presentation">
                                    <div id="destinationInnerDiv4" role="presentation" >
                                       <div id="target" class="CodeMirror-code" role="presentation">
                                          <div style="position: relative;">
                                             <div id="destinationInnerDiv6" class="CodeMirror-gutter-wrapper" >
                                                <div id="destinationInnerDiv7" contenteditable="false"
                                                   class="CodeMirror-linenumber CodeMirror-gutter-elt">1</div>
                                             </div>
                                             <!--***SM: Expanding pre in multi line messes the display ***-->
                                             <pre class=" CodeMirror-line "
                                                role="presentation"><span class="presentationSpanCls" role="presentation" ><span class="cm-meta">&lt;!DOCTYPE html&gt;</span></span></pre>
                                          </div>
                                          <div style="position: relative;">
                                             <div class="CodeMirror-gutter-wrapper" style="left: -30px;">
                                                <div class="CodeMirror-linenumber CodeMirror-gutter-elt"
                                                   style="left: 0px; width: 21px;">2</div>
                                             </div>
                                             <pre class=" CodeMirror-line "
                                                role="presentation"><span class="presentationSpanCls" role="presentation" ><span class="cm-tag cm-bracket">&lt;</span><span class="cm-tag"><a href="#">html</a></span> <span class="cm-attribute">lang</span>=<span class="cm-string">"en"</span><span class="cm-tag cm-bracket">&gt;</span></span></pre>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div id="presentationDiv43Id">
                           </div>
                           <div id="presentationDiv44Id" class="CodeMirror-gutters" >
                              <div id="presentationDiv45Id" class="CodeMirror-gutter CodeMirror-linenumbers" ></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <!--*************************************************************--->
               <!--***********************END - FILE SCANNER DIV****************--->
               <!--*************************************************************--->

               <!--*************************************************************--->
               <!--***********************START - HELP TOPICS ******************--->
               <!--*************************************************************--->

               <div id="HelpTopicsDivId">
                  <div id="HelpTopicsDivInn1Id" >
                     <div id="HelpTopicsDivInn2Id"  >
                        <input id="helpTopics-lang-box" type="text" name="language" autocomplete="off"
                           placeholder="Language" />
                        <button class="buttonCls" onclick="overrideHelpTopicsLanguage(); return false;">Update</button>
                        <span class="menuBtn" id="addHelpSpan" onclick="addHelp()">
                           <i class="tip fa fa-plus-square" id="addHelpSpanI" ><span>Add
                                 Help</span></i>
                        </span>
                     </div>
                     <label id="helpLangoverrideMsg" ></label>
                  </div>
                  <div id="HelpTopicsList" >
                     <div id ="helpMsgDivId">
                        Enter the language in the box above and click on update button to view the list of help contents
                        available.
                        <br>
                        Help button at the top right can be used to add new help content.
                     </div>
                  </div>
               </div>

               <!--*************************************************************--->
               <!--***********************END - HELP TOPICS ********************--->
               <!--*************************************************************--->
               <div id="profileDivId" class="profile" >

               </div>
               <!--*************************************************************--->
               <!--**START - LOGIN, REGISTER, FORGOT PASSWORD, ACTIVATE ACC*****--->
               <!--*************************************************************--->

               <div id="loginDivId" class="login displayNone" >
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
               <!--*************************************************************--->
               <!--****END - LOGIN, REGISTER, FORGOT PASSWORD, ACTIVATE ACC*****--->
               <!--*************************************************************--->               

               <div id="contactusDivId" class="displayNone">
                  <div id="contactusSecDivId" style="margin: 0 auto;   padding: 20px; ">
                     <label style="font-size: 14px; font-weight: 900; color: #333 "> CONTACT US </label>
                     
                     <div id="sndmsgdivid">
                     <hr>
                     <input class="un formInputText " style='width: calc(100% - 8px);' id='contactusname' type="text"
                        placeholder="Your full name">
                     <input class="un formInputText  " style='width: calc(100% - 8px);' id='contactusemailid'
                        type="text" placeholder="Email Id">
                     <textarea id="contactus_msg" class="fullWidth" style="border: 1px solid rgba(0, 0, 0, 0.3);"
                        placeholder="Your message" rows="3"></textarea>
                     <br>
                     <div style=" width: 220px; background-color: #C8C8C8; border-radius: 5px; ">
                        <ul class="captchaList" style="padding: 5px;">
                           <li style="margin: 5px;">
                              <div class="captchaBackground" style="position: relative; ">
                                 <canvas id="captcha">captcha text</canvas>
                                 <i class="fa fa-refresh" id="refreshButton"
                                    style="float: right;  position: absolute; top:1px; right: 1px; color:white; cursor: pointer"
                                    onclick="refreshCaptcha();"></i>
                              </div>
                           </li>
                           <li style="margin: 5px;">
                              <div><input id="enteredCaptchaText" style="width: 188px; height:30px"
                                    placeholder="Enter displayed code" type="text" autocomplete="off" name="text"></div>
                           </li>
                        </ul>
                     </div>
                     <label id="contactuserrormsg" style="color: #cc0000; font-size: 14px"></label>
                     <br> <br>
                     <button class="helper btnCenterAlign" align="center" onclick="contactus();">Submit</button>
                     </div>
                  </div>
               </div>
               <div id="onMobileMsgDivId" class="displayNone" style="margin:10px; padding:10px; text-align: justify">
                  Because the code upload and scanning limitations, the site has restricted functionality on mobile
                  device.
               </div>
               <div id="howtoDivId" class="displayNone" style="margin:auto;">
                  Coming soon
               </div>
            </div>
            <!-- *****END OF MAIN CONTAINER DIV -->
            <div class="splitter">
            </div>
            <div class="border-end bg-white panel-right" id="helpDisplayDivId"
               style="resize: horizontal; max-height: 90vh; overflow: hidden; padding: 0px; ">
               <div id="helpboxDivId" class="helpbox">
                  <form action="/">
                     <div class="root">
                        <span class="menuBtn" onclick="expandContractHelpDiv()"
                           style="cursor:pointer; float: right; position: absolute; top:-2px; right: 8px; ">
                           <!---							 
                              <i class="tip fa fa-arrows-alt" style="cursor:pointer; font-size:16px; color:black"></i>
                              -->
                           <i class="leftTip fa fa-adjust" style="cursor:pointer; font-size:16px; color:black"><span
                                 style="font-family: var(--bs-font-sans-serif); font-size: 16px; font-weight: 600;">Expand/Shrink<span></i>
                        </span>
                        <div class="helpcontent" id="helpDivMessage"
                           style="text-align: justify; text-justify: inter-word;">
                           Enter the code in the text area on the left or select a file using "Open File" button. <br>
                           Click on the scan button to view the help codes available.
                        </div>
                        <!--
                              <i class="fa fa-info-circle" style="float: left;  position: absolute; top:10px; left: 10px; color:purple;" ></i>
                              -->
                     </div>
                     <!-- *********Below div will be used to display the results of language identified/not identified after scan***** -->
                     <div id="languageScanResultDivId">
                        <div id="languageDeterminedDivId" style="display:none;">
                           <div id="msgForLanguageDetermined" class="fullWidth"
                              style=" background-color: #CEEEFC; padding: 5px; text-align: justify; text-justify: inter-word;margin-bottom: 5px;">
                           </div>
                           <div class="itemX">
                              <p style="margin-left:5px; margin-bottom:2px;">Language
                                 <i class="tip fa" style="font-size:14px; color:grey">&#xf05a;<span>Code language
                                       identified</span></i>
                              </p>
                              <div class="name-item" style="margin-top: 5px">
                                 <input class="fullWidth" type="text" id="code_language" placeholder="Language" />
                              </div>
                           </div>
                           <div class="itemX">
                              <p style="margin-left:5px; margin-bottom:2px;">Scanned Codes
                                 <i class="tip fa" style="font-size:14px; color:grey">&#xf05a;<span>Keywords/codes used
                                       to identify the code language</span></i>
                              </p>
                              <div class="name-item" style="margin-top: 5px">
                                 <textarea class="fullWidth" id="id_by_file_content">
                                    </textarea>
                              </div>
                           </div>
                           <div class="itemX">
                              <p style="margin-left:5px; margin-bottom:2px;">File Extension
                                 <i class="tip fa" style="font-size:14px; color:grey">&#xf05a;<span>File extension to
                                       identify the code language</span></i>
                              </p>
                              <div class="name-item">
                                 <input class="fullWidth" type="text" id="id_by_file_extension" />
                              </div>
                           </div>
                           <div class="btn-block" style="margin-top: 5px">
                              <button class="helper" type="submit">Update</button>
                           </div>
                           <div id="msgForLanguageNotDetermined"
                              style="margin-top: 5px; background-color: #CEEEFC; padding: 5px; text-align: justify; text-justify: inter-word;margin-bottom: 5px;">
                              Alternatively, you can enter the right language in the box below and click on the override
                              button.
                           </div>
                        </div>
                     </div>
                     <!-- *********Below div is displayed for both language scan results and help details.***** -->
                     <div id="languageOverride" style="display:none;">
                        <div style="margin-top: 5px"><input id="language-box" type="text" name="language"
                              autocomplete="off" placeholder="Language" /></div>
                        <div id="sub-tech-div-id" style="display:none; margin-top: 5px"><input id="sub-tech-box"
                              type="text" name="sub-tech" autocomplete="off" placeholder="Technology (Optional)" />
                        </div>
                        <div id="languageScanResultActionDivId" style="display:none">
                           <div class="btn-block" style="margin-top: 5px">
                              <button class="helper" onclick="overrideLanguage(); return false;">Override</button>
                           </div>
                           <label id="overrideMsg" style="color:#D36905; font-size: 14px"></label>
                           <div id="filelvlhelpdivid"
                              style="border: 1px solid #ccc; border-radius: 5px; display:none; height: 300px; overflow: auto;">
                           </div>
                        </div>
                     </div>
                     <!-- *********Below div will be used to display/edit/add help details for a code***** -->
                     <div id="helpDetailsDivId" style="display:none; ">
                        <button class="buttonClsClose" type="button"
                           style="float: right;  margin-left: 5px; margin-right: 13px; margin-bottom: 5px; display: none"
                           onclick="hideDiv('helpDetailsDivId')">Close</button>
                        <div class="itemX">
                           <p style="margin-left:5px; margin-bottom:2px; margin-top:5px;">Help Code
                              <i class="tip fa" style="font-size:14px; color:grey">&#xf05a;<span>Code for which help
                                    information needs to be displayed. There can be only one record for a help code
                                    under a language.</span></i>
                           </p>
                           <div class="name-item">
                              <input class="fullWidth" type="text" id="help_code" autocomplete="off" />
                           </div>
                        </div>
                        <div class="itemX">
                           <p style="margin-left:5px; margin-bottom:2px;">Details
                              <i class="tip fa" style="font-size:14px; color:grey">&#xf05a;<span>Details to help
                                    understand the code. Such as when this code is used, how it works, sample
                                    usage.</span></i>
                           </p>
                           <textarea id="help_details" class="fullWidth tiny" rows="5"></textarea>
                        </div>
                        <div class="itemX">
                           <p style="margin-left:5px; margin-bottom:2px; margin-top:5px;">Additional Information
                              <i class="tip fa" style="font-size:14px; color:grey">&#xf05a;<span>Additional information
                                    related to code.</span></i>
                           </p>
                           <textarea id="additional_info" class="fullWidth tiny" rows="5"></textarea>
                        </div>
                        <div id="helpDisplayLoggedInOnly">
                           <div class="itemx">
                              <p style="margin-left:5px; margin-bottom:2px;">Help code group
                                 <i class="tip fa" style="font-size:14px; color:grey">&#xf05a;<span>Help code group is
                                       to club similar type of help codes. For example Spring annotations should go
                                       under one group, loops releted help codes should go under one group. Decision
                                       making help codes should go under one group</span></i>
                              </p>
                              <input class="fullWidth" type="text" id="help_code_group" />
                           </div>
                           <div class="itemX">
                              <p style="margin-left:5px; margin-bottom:2px; margin-top:5px;">Tags to search this help
                                 <i class="tip fa" style="font-size:14px; color:grey">&#xf05a;<span>Language,
                                       Technology, Help Code, Help Code Group would already be included as tags for the
                                       search. Add if any additional tag should be added to help search.</span></i>
                              </p>
                              <div class="name-item">
                                 <input class="fullWidth" type="text" id="help_search_tags" />
                              </div>
                           </div>
                           <div
                              style="width: calc(100% - 10px); background-color: #026569 ; padding: 3px; border-radius: 5px; color: white ; margin-bottom:10px;">
                              Help Code Classification
                           </div>
                           <div class="itemX">
                              <p style="margin-left:5px; margin-bottom:2px;">Shared help content tag
                                 <i class="tip fa" style="font-size:14px; color:grey">&#xf05a;<span>When multiple help
                                       codes have exactly same help details, use this field to tag them together so that
                                       updates can be done to all of those together</span></i>
                              </p>
                              <input class="fullWidth" type="text" id="shared_help_content_key" />
                           </div>
                           <div class="preferred-metod-item">
                              <label><input type="checkbox" id="copyright_check"> <span>Copyright check
                                    <i class="tip fa" style="font-size:14px; color:grey">&#xf05a;<span>Content copyright
                                          checked</span></i>
                                 </span></label>
                           </div>
                           <div class="preferred-metod-item">
                              <label><input type="checkbox" id="do_not_use_for_scan"> <span>Do not use for scan
                                    <i class="tip fa" style="font-size:14px; color:grey">&#xf05a;<span>This help code
                                          will not be marked when code is scanned</span></i>
                                 </span></label>
                           </div>
                        </div>
                        <!--
                              *******DO NOT DELETE********
                              <div style="display:flex; flex-direction: column; width: 200px; margin-top: 10px; margin-bottom: 10px;">
                              	<div class="captchaBackground" style="position: relative">
                              		<canvas id="captchatwo">captcha text</canvas>								
                              		<i class="fa fa-refresh" id="refreshButtontwo" style="float: right;  position: absolute; top:1px; right: 1px; color:white; cursor: pointer" onclick="refreshCaptchatwo();"></i>
                              	</div>		
                              	<input id="enteredCaptchaTexttwo" placeholder="Enter displayed code" type="text" autocomplete="off" name="text">
                              </div>
                              -->
                        <label><input type="checkbox" id="terms_conditions"></label>
                        <label for="menu1-toggle" style="font: 12px verdana; "><u>Agree to terms and
                              conditions</u></label> <input type="checkbox" id="menu1-toggle" />
                        <div id="menu1">
                           <p style="text-align: center;"><strong><u>TERMS AND CONDITIONS</u></strong></p>
                           <p>These terms and conditions (the "Terms and Conditions") govern the use <strong>of
                              </strong>the Site. This Site is owned and operated by NumeroUnoDeveloper.</p>
                           <p>&nbsp;</p>
                           <p>By using this Site, you indicate that you have read and understand these Terms and
                              Conditions and agree to abide by them at all times.</p>
                           <p>&nbsp;</p>
                           <p><strong><u>Intellectual Property</u></strong></p>
                           <p>All content published and made available on our Site is the property of NumeroUnoDeveloper
                              and the Site's creators. This includes, but &nbsp;&nbsp;is not limited to images, text,
                              logos, documents, downloadable le files and anything that contributes to the composition
                              of our Site.</p>
                           <p>&nbsp;</p>
                           <p><strong><u>Use</u></strong><strong><u>r
                                 </u></strong><strong><u>Con</u></strong><strong><u>t</u></strong><strong><u>rib</u></strong><strong><u>u</u></strong><strong><u>t</u></strong><strong><u>io</u></strong><strong><u>n</u></strong><strong><u>s</u></strong>
                           </p>
                           <p>Users may post the following information on our site:
                              <br><br>
                              Technical/Educational content.
                              <br>
                           </p>
                           <p>&nbsp;</p>
                           <p>Your contribution is original, completely voluntary, non-abusive and does not violate
                              anyone&rsquo;s rights on the content. The site can use the content without any
                              restrictions. By posting publicly on our Site, you agree not to act illegally or violate
                              any Terms and Conditions.</p>
                           <p>&nbsp;</p>
                           <p><strong><u>Ac</u></strong><strong><u>c</u></strong><strong><u>o</u></strong><strong><u>un</u></strong><strong><u>t</u></strong><strong><u>s</u></strong>
                           </p>
                           <p>When yon create an account on our Site, you agree to the following:
                              <br><br>
                              - You are solely responsible for your account and the security and privacy of your
                              account, including passwords or sensitive information attached to that account.
                              <br>
                              - All personal information you provide to us through your account is up to date, accurate,
                              and truthful and that you will update your personal information if it changes.
                           </p>
                           <p>We reserve the right to suspend or terminate your account if you are using our Site
                              illegally or if you violate these Terms and Conditions.</p>
                           <p>&nbsp;</p>
                           <p><strong><u>User
                                 </u></strong><strong><u>G</u></strong><strong><u>o</u></strong><strong><u>o</u></strong><strong><u>ds
                                    a</u></strong><strong><u>nd
                                    S</u></strong><strong><u>e</u></strong><strong><u>r</u></strong><strong><u>vi</u></strong><strong><u>ces</u></strong>
                           </p>
                           <p>Our Site allows users to sell goods and services. We do not assume any responsibility for
                              the goods and services users sell on our Site. We carn1ot guarantee the quality or
                              accuracy of any goods and services sold by users on our Site. However, if we are made
                              aware that a user is violating these Terms and Conditions, we reserve the right to suspend
                              or prohibit the user from selling goods and services on our Site.</p>
                           <p>&nbsp;</p>
                           <p><strong><u>L </u></strong><strong><u>ink</u></strong><strong><u>s
                                 </u></strong><strong><u>t</u></strong><strong><u>o
                                 </u></strong><strong><u>O</u></strong><strong><u>t</u></strong><strong><u>h</u></strong><strong><u>e</u></strong><strong><u>r
                                 </u></strong><strong><u>We</u></strong><strong><u>bs</u></strong><strong><u>i</u></strong><strong><u>t</u></strong><strong><u>es</u></strong>
                           </p>
                           <p>Our Site contains links to third party websites or services that we do not own or control.
                              We are not responsible for the content, policies, or practices of any third party website
                              or service linked to on our Site. It is your responsibility to read the terms and
                              condition s and privacy policies of these third party websites before using these sites.
                           </p>
                           <p>&nbsp;</p>
                           <p><strong><u>L</u></strong><strong><u>i</u></strong><strong><u>mi</u></strong><strong><u>t</u></strong><strong><u>a</u></strong><strong><u>ti</u></strong><strong><u>on
                                 </u></strong><strong><u>of
                                    L</u></strong><strong><u>i</u></strong><strong><u>a</u></strong><strong><u>b</u></strong><strong><u>ili</u></strong><strong><u>ty</u></strong>
                           </p>
                           <p>NumeroUnoDeveloper and our directors, officers, agents, employees, subsidiaries, and
                              affiliates will not be liable for any actions, claims , losses, damages , liabilities and
                              expenses including legal fees from your use of the Site.</p>
                           <p>&nbsp;</p>
                           <p><strong><u>I</u></strong><strong><u>n</u></strong><strong><u>d</u></strong><strong><u>e</u></strong><strong><u>m</u></strong><strong><u>nity</u></strong>
                           </p>
                           <p>Except where prohibited by law, by using this Site you indemnify and hold harmless
                              NumeroUnoDeveloper and our directors, officers, agents, employees, subsidiaries, and
                              affiliates from any actions, claims, losses, damages, liabilities and expenses including
                              legal fees arising out t of your use of our Site or your violation of these Terms and
                              Conditions.</p>
                           <p style="text-align: center;">&nbsp;</p>
                           <p><strong><u>Applicable Law</u></strong></p>
                           <p>These Terms and Conditions are governed by the laws of the Province of Ontario.</p>
                           <p>&nbsp;</p>
                           <p><strong><u>Se</u></strong><strong><u>v</u></strong><strong><u>erability</u></strong><strong>.</strong>
                           </p>
                           <p>If a t any time any of the provisions set forth in these Terms and Conditions are found to
                              be inconsistent or invalid under applicable laws, those provisions will be deemed void and
                              will be removed from these Terms and Conditions. All other provisions will not be affected
                              by the removal and the rest of these Terms and Conditions will still be considered valid.
                           </p>
                           <p>&nbsp;</p>
                           <p><strong><u>Change</u></strong></p>
                           <p>These Terms and Conditions may be amended from time to time in order to maintain
                              compliance with the law and to reflect any changes to tl1e way we operate our Site and the
                              way we expect users to behave on our Site. We will notify users by email of changes to
                              these Terms and Conditions or post a notice on our Site.</p>
                           <p>&nbsp;</p>
                           <p><strong><u>Contact
                                 </u></strong><strong><u>D</u></strong><strong><u>e</u></strong><strong><u>tail</u></strong><strong><u>s</u></strong>
                           </p>
                           <p>Please contact us through contact form on the site if you have any questions or concerns.
                           </p>
                        </div>
                        <div class="btn-block" style="margin-top: 5px; margin-bottom: 25px">
                           <button class="helper" onclick="addOrUpdateHelpDetails(); return false;">Save
                              Changes</button>
                           <br>
                           <div id="helpAddUpdateMsgLoaderDivId" class="loader"
                              style="display:none; width: 200px; height:30px; float: left; padding: 0px; margin: 0px;">
                              <i class="loaderDot"></i>
                              <i class="loaderDot"></i>
                              <i class="loaderDot"></i>
                           </div>
                           <div><label id="helpAddUpdateMsg" style="color:#D36905; font-size: 14px"></label></div>
                           <div id="SubloginDivId" class="login"
                              style="display:none; max-height: 90vh; min-height: 90vh; overflow: auto; padding: 20px; background-color: #fff">
                              <div id="SubloginSecDivId">
                                 <label style="font-size: 20px; font-weight: 900; color: #333 "> Login </label>
                                 <hr>
                                 <input class="un " id='Subemailid' type="text" align="center"
                                    placeholder="Login Email Id">
                                 <input class="pass" id='Subpassword' type="password" align="center"
                                    placeholder="Password">
                                 <br>
                                 <label id="Subloginerrormsg" style="color: #cc0000; font-size: 14px; "></label>
                                 <br>
                                 <br>
                                 <button class="helper" style="width: 300px"
                                    onclick="loginWithoutRefresh(); return false;">Log in</button>
                                 <br>
                                 <br>
                                 <a href="#!" style="color: #888;  " onMouseOver="this.style.color='#000'"
                                    onMouseOut="this.style.color='#888'" onclick="SubshowCreateAccount();">Not
                                    registered? Create account</a>
                              </div>
                              <div id="SubregisterSecDivId"  class="displayNone" >
                                 <label style="font-size: 20px; font-weight: 900; color: #333 "> Register </label>
                                 <hr>
                                 <input class="un" id='Subregisterusname' type="text" placeholder="Your full name">
                                 <input class="un " id='Subregisteremailid' type="text" align="center"
                                    placeholder="Login Email Id">
                                 <input class="pass" id='Subregisterpassword' type="password" align="center"
                                    placeholder="Set Password">
                                 <input class="pass" id='Subregisterpasswordre' type="password" align="center"
                                    placeholder="Re-enter Password">
                                 <br>
                                 <label id="Subregistererrormsg" style="color: #cc0000; font-size: 14px"></label>
                                 <br>
                                 <br>
                                 <button class="helper" style="width: 300px"
                                    onclick="Subregister(); return false;">Register</button>
                                 <br>
                                 <br>
                                 <a href="#!" style="color: #888;  " onMouseOver="this.style.color='#000'"
                                    onMouseOut="this.style.color='#888'" onclick="SubshowLogin();">Go back to Login</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- Right Sidebar
               <div class="splitter"  ></div>
                           -->
         <!--**************START: HELP DISPLAY DIV**************-->
      </div>
   </div>
   <div class="footerDiv">
   <footer>
      <div class="footer-main">
        <div class="footer-col1">
          <ul>
            <li>
               <img src="/itcodescanner/assets/favicon-1.png" alt="IT Code Scanner" class="languageicon">
            </li>
    
          </ul>
        </div>
    
        <div class="footer-col2">
          <h3 class="footer-heading">
            KEY LINKS
          </h3>
          <div class="footer-languages">
            <a href="/itcodescanner/?target=home">Home</a>
            <a href="/itcodescanner/?target=tutorial">Tutorials</a>
            <!-- <a href="/itcodescanner/?target=projectscanner">Project Scanner</a>
            <a href="/itcodescanner/?target=filescanner">File Scanner</a> -->
            <a href="/itcodescanner/?target=contactus">Contact Us</a>
          </div>
        </div>
    
        <div class="footer-col3">
          <h3 class="footer-heading">
            FOLLOW US
          </h3>
          <div class="footer-social">
            <a href="https://www.facebook.com/profile.php?id=100077594436233">
               <i class="fa fa-facebook-square" style="font-size:48px;color:white"></i>
            </a>
     
          </div>
        </div>
      </div>
    
      <p class="footer-terms">
        <a href="#">© 2022 IT Code Scanner. All rights reserved</a>
    
      </p>
    </footer>
    </div>

   <div id="cookie-div-id" class="cookie-consent-banner">
      <div class="cookie-consent-banner__inner">
         <div class="cookie-consent-banner__copy">
            <div class="cookie-consent-banner__header">We USE COOKIES</div>
            <div class="cookie-consent-banner__description">We use cookies and other tracking technologies to improve
               your browsing experience on our website, to show you personalized content and targeted ads, to analyze
               our website traffic, and to understand where our visitors are coming from. You consent to our cookies if
               you continue to use our website.</div>
         </div>
         <div class="cookie-consent-banner__actions">
            <a href="#" onclick="cookieAccepted()" class="cookie-consent-banner__cta">
               Understood
            </a>
         </div>
      </div>
   </div>
   <!--
         </div>
         -->
   <!-- Bootstrap core JS-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Core theme JS-->
   <script src="/itcodescanner/js/scripts.js"></script>
   <!--
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
         
         
         -->
   <script>
      $(".panel-left").resizable({
         handleSelector: ".splitter",
         resizeHeight: false
      });



   </script>
   <script>
      // setTimeout(() => {
      //    setInfo();
      // }, 0);
      getConditionsToIdentifyCodeLanguage();
      getDistinctCommentsCombination();
      getLanguageHelpCodeAndIds();
      getEnvironmentSetUpDetails();
      getCodeCommentsConditions();
      getLaguagesSubCatgHelpCodeGroups();
      getHelpCodeGroupDisplayOrder();
      /* ***TEMPORARY**SM-T001***Refer User Guide**
      getStoredProjectList();
      */
      getStoredProjectList();
      getLangForFileExtension();
      getHowToVideos();
      getTutorialList();
      getSpecialFiles();
      checkURL();
   </script>
   <script src="/itcodescanner/web/onload.js"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-63324d242f787b67"></script>


</body>

</html>