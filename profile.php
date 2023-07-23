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

$userObjs = [];
$scoresList = [];
$latestScores = [];

$isPHPUrl = false;
$isLoggedin = $_SESSION['isLoggedin'];
$latestScoresHTML = "";
$allScoresHTML = "";

if ($isLoggedin) {
    $latestScoresHTML = getLatestScoresHTML();
    $allScoresHTML = getAllScoresHTML();
}
$isCrawler = isset($_SERVER['HTTP_USER_AGENT'])
    && preg_match('/bot|crawl|slurp|spider|mediapartners|InspectionTool|GoogleOther/i', $_SERVER['HTTP_USER_AGENT']);


function getLatestScoresHTML()
{
    global $database;
    global $userObjs;
    global $scoresList;
    global $latestScores;

    $userdata = isset($_SESSION['userdata']) ? $_SESSION['userdata'] : null;


    $newHTML = "";
    $tf = $database->gettutorials();
    $quizRows = $tf;
    $quizRows = array_filter($quizRows, function ($entry) {
        return stripos($entry['title'], 'QUIZ') !== false;
    });

    if (isset($_SESSION['smusr']) && $_SESSION['smusr']) {
        // Do nothing for the smusr case
    } else {
        $quizRows = array_filter($quizRows, function ($entry) {
            return $entry['discontinue'] == "0";
        });
    }
    $quizRows = array_values($quizRows);
    $itemNameOrig = "";
    $itemName = "";
    $subpath = "";
    $technologyOrig = "";
    $technology = "";
    $path = $_SERVER['REQUEST_URI'];
    $myUrl = substr($path, 0, strpos($path, '/', strpos($path, 'itcodescanner')) + 1);

    if ($userdata != null && $userdata !== "") {
        $userObjs = json_decode($userdata, true);
        $scoresList = isset($userObjs['scores']) ? $userObjs['scores'] : [];

        // Iterate over the scoresList array to find the maximum timedate for each score
        foreach ($scoresList as $obj) {
            $quiz = $obj['quiz'];
            $time = $obj['time'];
            if (!isset($latestScores[$quiz]) || strtotime($time) > strtotime($latestScores[$quiz])) {
                $latestScores[$quiz] = $time;
            }
        }

        // Filter the scoresList array to include only objects with the maximum timedate for each name
        $latestUserScoresData = array_filter($scoresList, function ($obj) use ($latestScores) {
            return $obj['time'] === $latestScores[$obj['quiz']];
        });

        $quizURL = "";

        $newHTML .= "<div class='scoresheader'>Quiz Scores</div>";
        $newHTML .= "<table class='scorestablecls'><tr><th>Quiz</th><th>Score</th><th>Time</th></tr>";

        foreach ($quizRows as $i => $quizRow) {
            $itemNameOrig = $quizRow['title'];
            $itemName = str_replace(" ", "-", $itemNameOrig);
            $subpath = $quizRow['subpath'];
            $technologyOrig = $quizRow['technology'];
            $technology = str_replace(" ", "-", $technologyOrig);

            $quizURL = $myUrl . "tutorials/" . strtolower($technology) . "/" . strtolower($itemName);

            if ($i == 0 || $quizRows[$i]['technology'] !== $quizRows[$i - 1]['technology']) {
                $newHTML .= "<tr style='background-color:#4d6981; color:white'><td colspan='3'>" . $technologyOrig . "</td></tr>";
            }

            $latestResultForQuiz = "";
            $latestTestTime = "";

            $resultForQuiz = array_filter($latestUserScoresData, function ($obj) use ($technology, $itemName) {
                $qzURL = explode("/tutorials/", $obj['quiz']);
                $link = $qzURL[1];
                $dummy1 = explode("/", $link);
                return strtoupper($technology) === strtoupper($dummy1[0]) && strtoupper($itemName) === strtoupper($dummy1[1]);
            });

            if (count($resultForQuiz) !== 0) {
                $obj = reset($resultForQuiz);
                $latestResultForQuiz = $obj['percent'];
                $latestTestTime = $obj['time'];

                $newHTML .= "<tr><td> <a class='tutorialLink' href='" . $quizURL . "'> " . $subpath . " </a></td><td>" . $latestResultForQuiz . "% </td><td>" . $latestTestTime . "</td></tr>";
            } else {
                $newHTML .= "<tr><td> <a class='tutorialLink' href='" . $quizURL . "'> " . $subpath . " </a></td><td>" . "" . " </td><td>" . "" . "</td></tr>";
            }
        }

        $newHTML .= "</table>";
    } else {
        $newHTML .= "<div class='scoresheader'>Quiz Scores</div> No scores found";
    }

    return $newHTML;
}

function getAllScoresHTML()
{
    $userdata = isset($_SESSION['userdata']) ? $_SESSION['userdata'] : null;
    $userObjs = [];
    $scoresList = [];

    $newHTML = "";
    if ($userdata != null && $userdata !== "") {
        $userObjs = json_decode($userdata, true);
        $scoresList = isset($userObjs['scores']) ? $userObjs['scores'] : [];

        // Sort the array based on multiple fields: 'quiz' in ascending order and 'time' in descending order
        usort($scoresList, function ($a, $b) {
            if ($a['quiz'] !== $b['quiz']) {
                // Sort by 'quiz' field in ascending order
                return strnatcasecmp($a['quiz'], $b['quiz']);
            } else {
                // Sort by 'time' field in descending order
                return strtotime($b['time']) - strtotime($a['time']);
            }
        });

        $newHTML .= "<div class='scoresheader'>Quiz Scores</div>";
        $newHTML .= "<table class ='scorestablecls' ><tr><th>Quiz</th><th>Score</th><th>Time</th></tr>";
        $lastSubject = "";
        foreach ($scoresList as $key => $obj) {
            $qzURL = explode("/tutorials/", $obj['quiz']);
            $link = $qzURL[1];

            $title = isset($obj['title']) ? $obj['title'] : $qzURL[1];
            $dummy1 = explode("/", $link);
            $subject = $dummy1[0];

            if ($lastSubject !== "") {
                if ($lastSubject !== $subject) {
                    $newHTML .= "<tr style='background-color:#4d6981; color:white'><td colspan='3'>" . $subject . "</td></tr>";
                }
            } else {
                $newHTML .= "<tr style='background-color:#4d6981; color:white'><td colspan='3'>" . $subject . "</td></tr>";
            }
            $newHTML .= "<tr><td> <a class= 'tutorialLink' href='" . $obj['quiz'] . "'> " . $title . " </a></td><td>" . $obj['percent'] . "% </td><td>" . $obj['time'] . "</td></tr>";
            $lastSubject = $subject;
        }
        $newHTML .= "</table>";
    } else {
        $newHTML .= "<div class='scoresheader'>Quiz Scores</div> No scores found";
    }

    return $newHTML;
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
                <div id="profileDivId" class="profile" >
                    <div id="tabContentParent">
                        <div class="tabContainer">
                            <ul class="tabs">
                            <li><a src="latestScoresTab" href="javascript:void(0);" class="active">Latest Scores</a></li>
                            <li><a src="allScoresTab" href="javascript:void(0);">All Scores</a></li>
                            </ul>
                            <div class="tabContent">
                            <div id="latestScoresTab">
                                <?php echo $latestScoresHTML; ?>
                            </div>
                            <div id="allScoresTab">
                                <?php echo $allScoresHTML; ?>
                            </div>
                            </div>
                            <!-- /tabContent -->
                        </div>
                        <!-- /tabContainer -->
                        </div>
                        <!-- /content -->
                    </div>
          </div>
       </div>

       <?php include 'footer.html'; ?>
    </div>
</div>

<script>
    setTimeout(function () {
    $("#tabContentParent").on("click", ".tabContainer .tabs a", function (e) {
        e.preventDefault(),
            $(this)
                .parents(".tabContainer")
                .find(".tabContent > div")
                .each(function () {
                    $(this).hide();
                });

        $(this)
            .parents(".tabs")
            .find("a")
            .removeClass("active"),
            $(this).toggleClass("active"), $("#" + $(this).attr("src")).show();
    });
}, 800);
</script>
</body>

</html>
