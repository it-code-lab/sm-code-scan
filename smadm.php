<?php
include_once("php/session.php");

$title = "IT Tutorials";
$description = "Easy to understand tutorials with lots of sample codes in programming languages Java,
 Python, JavaScript, PHP, HTML, CSS, C++, C# etc.";
//$image_url = "Your Image URL";
$keywords = "Software, IT, Tutorials, Code Samples";

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

//SM-TODONE-Revert below
$page_url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$path = urldecode($_SERVER["REQUEST_URI"]);
$path = substr($path, 1);

$isPHPUrl = false;
$technologyNItemstr = "";
$technology = "";
$tutTitle = "";
$tutTitleItemId = "";
$tutDivHTML = "";
$tutListHTML = "";
$mobileDevice = isMobileDevice();
$smusr = $_SESSION['smusr'];
$userlevel = $_SESSION['userlevel'];
$isLoggedin = $_SESSION['isLoggedin'];
$sessionDesc = "";

$userObjs = [];
$quizScores = [];
$thisQuizResults = [];
$lastResult = "";

$isCrawler = isset($_SERVER['HTTP_USER_AGENT'])
    && preg_match('/bot|crawl|slurp|spider|mediapartners|InspectionTool|GoogleOther/i', $_SERVER['HTTP_USER_AGENT']);

//$isCrawler = true;

if (strpos($path, 'tutorials/') !== false) {
    $technologyNItemstr = substr($path, strpos($path, "tutorials/") + 10);

    if (strpos($technologyNItemstr, '/') !== false) {
        $tutTitle = substr($technologyNItemstr, strpos($technologyNItemstr, "/") + 1);
        $tutData = $database->getTutorial($technologyNItemstr);
        $tutDivHTML = populateTutorialHTML($tutData, $database);
        $tutListHTML = getTutorialsListHTML($database, $technology, $tutTitle);
    } else {
        $technology = urldecode($technologyNItemstr);
        $tutListHTML = getTutorialsListHTML($database, $technology, $tutTitle);
    }

    if (strpos($technologyNItemstr, '/') !== false) {
        $isPHPUrl = true;

        $title = $_SESSION['webTitle'];
        $description = $_SESSION['webDesc'];
        //$image_url = "https://itcodescanner.com/getimage/".$_SESSION['image_nm'];
        $keywords = $_SESSION['webKeywords'];
        $webFullDesc = $_SESSION['webFullDesc'];

    }
} else {
    $tutListHTML = getTutorialsListHTML($database, "", "");
}

function populateTutorialHTML($tutData, $database)
{

    global $technology;
    global $tutTitleItemId;

    global $userObjs;
    global $quizScores;
    global $thisQuizResults;
    global $lastResult;

    // Assuming $response contains the JSON response similar to JavaScript 'response' variable
    if ($tutData == "Err in DB call") {
        return "<div class='songContainer'>Page not found</div>";
    }
    $tags = $tutData;

    $itemid = $tags[0]['itemid'];

    $tutTitleItemId = $itemid;

    $technology = $tags[0]['technology'];
    $technologyseq = $tags[0]['technologyseq'];
    $subpath = $tags[0]['subpath'];
    $subpathseq = $tags[0]['subpathseq'];
    $title = $tags[0]['title'];
    $titleseq = $tags[0]['titleseq'];
    $shortdescription = $tags[0]['shortdescription'];
    $description = $tags[0]['description'];
    $writer = $tags[0]['writer'];
    $keywords = $tags[0]['keywords'];
    $discontinue = $tags[0]['discontinue'];

    $path = $_SERVER['REQUEST_URI'];
    $myUrl = substr($path, 0, strpos($path, '/', strpos($path, 'itcodescanner')) + 1);

    // START: Find the next tutorial to be put at the bottom of the page

    $tf = $database->gettutorials();
    $nextTutorialTitle = "";
    $nextTutorialTitleURL = "";
    $rows = $tf;

    $rows = array_filter($rows, function ($entry) use ($technology) {
        return $entry['discontinue'] == "0" && $entry['technology'] == $technology;
    });

    //SM-Needed to reindex the elements in order
    $rows = array_values($rows);

    for ($i = 0; $i < count($rows); $i++) {
        if ($rows[$i]['itemid'] == $itemid) {
            if (isset($rows[$i + 1])) {
                $itemName = str_replace(" ", "-", $rows[$i + 1]['title']);
                //$nextSubpath = str_replace(" ", "-", $rows[$i + 1]['subpath']);
                $nextTechnology = strtolower(str_replace(" ", "-", $rows[$i + 1]['technology']));
                $nextTutorialTitleURL = $myUrl . "tutorials/" . $nextTechnology . "/" . $itemName;
                $nextTutorialTitle = $rows[$i + 1]['subpath'];
            }
            break;
        }
    }
    // END: Find the next tutorial to be put at the bottom of the page

    $tutorialUrl = substr($path, 0, strpos($path, '/', strpos($path, 'itcodescanner')) + 1) . "tutorials";
    $technologyUrl = substr($path, 0, strpos($path, '/', strpos($path, 'itcodescanner')) + 1) . "tutorials/" . $technology;

    $newHTML = "<div class='songContainer'><div class='topNavDivCls'>" .
        '<a href="' . $tutorialUrl . '" class="tutorialTopLinkCls">' . "Tutorials</a>" . " > " .
        '<a href="' . $technologyUrl . '" class="tutorialTopLinkCls">' . $technology . "</a>" . " > " .
        '<a href="' . $_SERVER['REQUEST_URI'] . '" class="tutorialTopLinkCls">' . $title . "</a></div>";
    $newHTML .= "<div class='curvedBox bgcolor_11 padding_50px color_white text_align_center'><h1 id='docHeader'>" . $subpath . "</h1></div>";

    if (!$_SESSION['isLoggedin']) {
        // Do something if user is not logged in
    } elseif ($_SESSION['smusr']) {
        global $sessionDesc;
        $_SESSION["data-description"] = $description;
        $sessionDesc = $description;
        $newHTML .= '<button class="btn" data-itemid="' . $itemid . '" data-technology="' . $technology . '" data-technologyseq="' . $technologyseq . '" data-subpath="' . $subpath . '" data-subpathseq="' . $subpathseq . '" data-title="' . $title . '" data-titleseq="' . $titleseq . '" data-shortdescription="' . $shortdescription . '"  data-writer="' . $writer . '" data-keywords="' . $keywords . '" data-discontinue="' . $discontinue . '" onclick="editItem(this)">Edit</button>';
    }

    $newHTML .= '<div class="printBtnDivCls"><button class="printBtn" onclick="window.print()">Printable</button></div>';
    $newHTML .= '<div class="songDeltsNImg">';
    $newHTML .= '<div class="songDelts">';

    $max = 80;
    $min = 50;
    $percentNumber = rand($min, $max);

    if (!empty($subpathseq) && is_numeric($subpathseq) && $subpathseq !== "0") {
        $percentNumber = $subpathseq;
    }


    $pageHdr = $subpath;
    $lastResult = "";

    try {
        if (isset($_SESSION["userdata"])) {
            $userdata = $_SESSION["userdata"];
            $userObjs = json_decode($userdata, true);

            //$quizScores = $userObjs["scores"];
            $quizScores = isset($userObjs['scores']) ? $userObjs['scores'] : [];

            $thisQuizResults = array_filter($quizScores, function ($quizDet) use ($path) {
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                return $quizDet["quiz"] === $protocol . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
            });

            usort($thisQuizResults, function ($a, $b) {
                return strtotime($b["time"]) - strtotime($a["time"]);
            });

            $lastResult = isset($thisQuizResults[0]["percent"]) ? $thisQuizResults[0]["percent"] : "";
        }
    } catch (Exception $e) {
        // Handle the exception if needed
    }

    try {
        if (strpos($description, "sbmtqzdivid") !== false) {
            $newHTML .= '<div class="scoresPie"><div id="avgResultsDivId" class="resultsPie chartDiv text_align_center margin_10px_auto padding_10px slide-in-left" style="animation-duration: 0.2;  background:none; border: none">'
                . '<div class="pie" style="--p:' . $percentNumber . ';--b:20px;--w:130px; --c:green;">' . $percentNumber . '%</div><br><span class="scoreText">Public Average Score</span>'
                . '</div>';

            if (!empty($lastResult)) {
                $newHTML .= '<div id="lastResultsDivId" class="resultsPie chartDiv text_align_center margin_10px_auto padding_10px slide-in-left" style="animation-duration: 0.2;  background:none; border: none">'
                    . '<div class="pie" style="--p:' . $lastResult . ';--b:20px;--w:130px; --c:green;">' . $lastResult . '%</div><br><span class="scoreText">My Previous Score</span>'
                    . '</div>';
            }

            $newHTML .= '</div>';
        }
    } catch (Exception $e) {
        // Handle the exception if needed
    }

    if (!empty($description)) {
        $newHTML .= "<div class='songLyrics'>" . $description . "</div>";
    }

    $newHTML .= "</div>";
    $newHTML .= "</div>";

    if (empty($description)) {
        $newHTML = "<div class='songContainer'>Page not found</div>";
    }

    if (!empty($nextTutorialTitle)) {
        $newHTML .= '<div class="bottomNavDivCls"><br><br>' . 'Next: <a href="' . $nextTutorialTitleURL . '" class="tutorialTopLinkCls">' . $nextTutorialTitle . "</a> <br> <br></div>";
    }


    $newHTML .= '</div>';
    // Now you can use $newHTML as needed, such as echoing it or assigning it to some other variable.
    //echo $newHTML;
    return $newHTML;
}

// Function to replace space with hyphen in a string
function replaceSpacesWithHyphen($str)
{
    return str_replace(" ", "-", $str);
}

function filterByTechnology($entry, $tech)
{
    return strtoupper($entry['technology']) == strtoupper($tech);
}

function getTutorialsListHTML($database, $technologyFilter, $tutTitle)
{
    global $tutTitleItemId;

    $rows = $database->gettutorials();

    // Initialize the variables
    $innerHTML = "";
    $itemName = "";
    $path = $_SERVER['REQUEST_URI'];
    $myUrl = substr($path, 0, strpos($path, '/', strpos($path, 'itcodescanner')) + 1);
    $technologySqueezed = "";
    $technologyOrig = "";
    $technologyUrl = "";
    //$defaultDisplayCount = 1000;
    //$technologyMaxCount = 0;
    //$currDisplayCount = 0;

    // Filter the rows based on 'discontinue' property if 'the.smusr' is not set
    if (!($_SESSION['smusr'])) {
        $rows = array_filter($rows, function ($entry) {
            return $entry['discontinue'] == "0";
        });
    }

    if ($technologyFilter != "") {
        $rows = array_filter($rows, function ($entry) use ($technologyFilter) {
            return filterByTechnology($entry, $technologyFilter);
        });
    }
    //SM-Needed to reindex the elements in order
    $rows = array_values($rows);

    // Loop through the rows array
    for ($i = 0; $i < count($rows); $i++) {
        $itemName = replaceSpacesWithHyphen($rows[$i]['title']);
        $subpath = $rows[$i]['subpath'];
        $technologyOrig = $rows[$i]['technology'];
        $technology = replaceSpacesWithHyphen($rows[$i]['technology']);

        $technology = replaceSpacesWithHyphen($technology);

        $tutorialTitleURL = $myUrl . "tutorials/" . strtolower($technology) . "/" . strtolower($itemName);

        $itemStr = strtolower($technology) . "/" . strtolower($itemName);

        $technologyUrl = $myUrl . "tutorials/" . $technologyOrig;

        $technologySqueezed = $rows[$i]['technology'];
        $technologySqueezed = str_replace(' ', '', $technologySqueezed);

        //$technologyMaxCount = (int) sessionStorage . getItem("max-count-" . $technologySqueezed);

        if ($i == 0) {
            if ($technologyFilter != "") {
                $innerHTML .= '<div id="menucardparent-' . $technologySqueezed . '" style="width:95%; max-width:1200px; float:none; top:20px; margin:auto; overflow:expand" class="cardsContainerDivClassPadd"><a class="technologyHeader" href="' . $technologyUrl . '">';

            } else {
                $innerHTML .= '<div id="menucardparent-' . $technologySqueezed . '" style="height:200px" class="cardsContainerDivClassPadd"><a class="technologyHeader" href="' . $technologyUrl . '">';

            }

            if ($_SESSION['smusr']) {
                $innerHTML .= $rows[$i]['technologyseq'] . '. ';
            }
            $innerHTML .= $rows[$i]['technology'] . '</a>';
            $startingCharURL = $myUrl . "starting/bollywood-tutorials-starting-with-" . $rows[$i]['technology'];
        } else if ($rows[$i]['technology'] != $rows[$i - 1]['technology']) {

            $innerHTML .= '<div id="tutorialDiv-' . $rows[$i - 1]['itemid'] . '" class="tutorialDiv ' . $technologySqueezed . '">';
            $innerHTML .= '</div>';

            $innerHTML .= '</div><div id="menucardparent-' . $technologySqueezed . '" style="height:200px" class="cardsContainerDivClassPadd"><a class="technologyHeader" href="' . $technologyUrl . '">';
            if ($_SESSION['smusr']) {
                $innerHTML .= $rows[$i]['technologyseq'] . '. ';
            }
            $innerHTML .= $rows[$i]['technology'] . '</a>';
            $startingCharURL = $myUrl . "starting/bollywood-tutorials-starting-with-" . $rows[$i]['technology'];
        }

        //$currDisplayCount++;


        if ($i == 0) {
            $previousSubpath = "";
        } else {
            $previousSubpath = $rows[$i - 1]['subpath'];
        }

        $currentSubpath = $rows[$i]['subpath'];

        if ($i == count($rows) - 1) {
            $nextSubPath = "";
        } else {
            $nextSubPath = $rows[$i + 1]['subpath'];
        }

        $discontinuedFlgCls = "";

        if ($rows[$i]['discontinue'] == "1") {
            $discontinuedFlgCls = " discontinued ";
        }

        $subPathQzRepl = $rows[$i]['subpath'];
        $subPathQzRepl = str_replace('quiz', "<span class='quizTxt'>Quiz</span>", $subPathQzRepl);

        if ($previousSubpath == $currentSubpath) {
            $innerHTML .= '<div id="tutorialDiv-' . $rows[$i]['itemid'] . '" class="tutorialDiv tutorialChild ' . $discontinuedFlgCls . $technologySqueezed . '">';
            $innerHTML .= '<a class="tutorialLink"  href="' . $tutorialTitleURL . '"><span class="tutorialTitleSpan"><h2 class="tutorialTitleH2">';
            if ($_SESSION['smusr']) {
                $innerHTML .= $rows[$i]['titleseq'] . '. ';
            }
            $innerHTML .= $subPathQzRepl . '</h2></span></a>';
            $innerHTML .= '</div>';
        } else if ($nextSubPath == $currentSubpath) {
            $innerHTML .= '<div class="tutorialParent ' . $technologySqueezed . '">';
            $innerHTML .= $currentSubpath;
            $innerHTML .= '</div>';
            $innerHTML .= '<div id="tutorialDiv-' . $rows[$i]['itemid'] . '" class="tutorialDiv tutorialChild ' . $discontinuedFlgCls . $technologySqueezed . '">';
            $innerHTML .= '<a class="tutorialLink"  href="' . $tutorialTitleURL . '"><span class="tutorialTitleSpan"><h2 class="tutorialTitleH2">';
            if ($_SESSION['smusr']) {
                $innerHTML .= $rows[$i]['titleseq'] . '. ';
            }
            $innerHTML .= $subPathQzRepl . '</h2></span></a>';
            $innerHTML .= '</div>';
        } else {
            $innerHTML .= '<div id="tutorialDiv-' . $rows[$i]['itemid'] . '" class="tutorialDiv ' . $discontinuedFlgCls . $technologySqueezed . '">';
            $innerHTML .= '<a class="tutorialLink"  href="' . $tutorialTitleURL . '"><span class="tutorialTitleSpan"><h2 class="tutorialTitleH2">';
            if ($_SESSION['smusr']) {
                $innerHTML .= $rows[$i]['titleseq'] . '. ';
            }
            $innerHTML .= $subPathQzRepl . '</h2></span></a>';
            $innerHTML .= '</div>';
        }

        if ($i == count($rows) - 1) {

            $innerHTML .= '<div id="tutorialDiv-' . $rows[$i]['itemid'] . '" class="tutorialDiv ' . $technologySqueezed . '">';
            $innerHTML .= '</div>';

            $innerHTML .= '</div>';
        }
    }

    // Now you can use $innerHTML as needed, such as echoing it or assigning it to some other variable.
    return $innerHTML;
}

function isMobileDevice()
{
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $pattern = '/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i';

    // Check if the User-Agent contains any of the mobile device keywords
    if (preg_match($pattern, $userAgent)) {
        // True for mobile device
        return true;
    } else {
        // Not a mobile device
        return false;
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

    <!-- ****SM-TO-SMADM******* -->
    <script src="/itcodescanner/web/smadm-common-function0.15.js"></script>

    <script src='https://cdn.jsdelivr.net/npm/sanitize-html@1.18.2/dist/sanitize-html.min.js'></script><script  src="./script.js"></script>


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

         <?php include 'admtopnav.php'; ?>

       <!-- End of Top navigation-->
       <!-- Page content-->

       <div id="containerNHelpDivId" >
          <svg id="bgSVGId" class="bgSVG displayNone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7559DA" fill-opacity="1" d="M0,224L30,197.3C60,171,120,117,180,117.3C240,117,300,171,360,197.3C420,224,480,224,540,208C600,192,660,160,720,165.3C780,171,840,213,900,245.3C960,277,1020,299,1080,272C1140,245,1200,171,1260,165.3C1320,160,1380,224,1410,256L1440,288L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>

          <div id="mainContainer" style="min-height: 700px; width: 100%;" class="panel-container panel-left">

                <div class='showTutorialListDiv'>Show List </div>

                   
                    <?php if ($mobileDevice): ?>
                        <div id="tutorialListDivId" style="min-width: 0px;">
                        <div id="slideInDivId" class="slideIn cursor_pointer" onclick="toggleLeftSideMenu(); return false;" ><i class="fa fa-list" ></i></div>

                        <div id="tutorialListInnerDivId" style="display: none;" >
                            <?php echo $tutListHTML; ?>
                        </div>
                        </div>

                        <div id="tutorialDivId">
                            <?php echo $tutDivHTML; ?>
                            <hr>&nbsp;&nbsp;&nbsp;&nbsp; <span class="noPrint"><b>Leave a Comment</b></span>
                            <?php include 'sendMsg.html'; ?>
                        </div>

                        <div id="tutorialEditDivId" style="display: block; width: 10%;">
                        </div>
                    <?php else: ?>
                        <div id="tutorialListDivId">
                        <div id="slideInDivId" class="slideIn cursor_pointer" onclick="toggleLeftSideMenu(); return false;" ><i class="fa fa-list" ></i></div>

                        <div id="tutorialListInnerDivId">                
                            <?php echo $tutListHTML; ?>
                        </div>  
                        </div>

                        <div id="tutorialDivId">
                            <?php echo $tutDivHTML; ?>
                            <hr>&nbsp;&nbsp;&nbsp;&nbsp;<span class="noPrint"><b>Leave a Comment</b></span>
                            <?php include 'sendMsg.html'; ?>
                        </div>

                        <div id="tutorialEditDivId" style="display: block; width: 20%;">
                        </div>                     
                    <?php endif; ?>



            </div>

        </div>
    </div>
    
</div>
       <?php include 'footer.html'; ?>
       <div id="toastsnackbar" class="shadow_1"></div>
       <script>
            if ("<?php echo $tutTitle; ?>" != ""){
                setTimeout(function () {
                    refreshCaptcha();
                }, 100);

                sessionStorage.setItem("data-description", <?php echo json_encode($_SESSION["data-description"]) ?> )
            }
            

            

            // ****SM-TO-SMADM*******
            

            setTimeout(function () {
                admGetIntQTechs();
            }, 10);

            setTimeout(function () {
                admcheckURL();
            }, 1000);

        </script>
        <script src="/itcodescanner/web/onload-v0.03.js"></script>
</body>

</html>