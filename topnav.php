<?php
include_once("php/session.php");

$the['hosturl'] = "/itcodescanner";

$tutorialList = $database->gettutorials();

$path = urldecode($_SERVER["REQUEST_URI"]);
$path = substr($path, 1);

$tutorialsPageFlag = false;

$isLoggedin = $_SESSION['isLoggedin'];

if (strpos($path, 'tutorials') !== false) {
   $tutorialsPageFlag = true;
}
//$rows = $tutorialList;
// Filter the array to include only entries with 'discontinue' value equal to "0"
$rows = array_filter($tutorialList, function ($entry) {
   return $entry['discontinue'] == "0";
});

//SM-Needed to reindex the elements in order
$rows = array_values($rows);

$innHTML = "";
$temp = "";
for ($i = 0; $i < count($rows); $i++) {
   if ($rows[$i]['technology']) {
      if (($i == 0) || ($rows[$i]['technology'] != $rows[$i - 1]['technology'])) {
         $innHTML .= "<a href='" . $the['hosturl'] . "/tutorials/" . $rows[$i]['technology'] . "'>" . $rows[$i]['technology'] . "</a>";
      }
   }
}

?>
<div class="topnav" id="myTopnav">
      <a id="homeLinkId" href="/itcodescanner/home">HOME</a>

      <a id="tutorialsLinkId" href="/itcodescanner/tutorials">TUTORIALS <i  class="fa fa-caret-down"></i></a>
      <div id="dropDownTutListId" class="dropdown-content">
      <?php echo $innHTML; ?>
      </div>
               

      <a id="projectscannerLinkId" href="/itcodescanner/?target=projectscanner">PROJECT SCANNER</a>
      <a id="filescannerLinkId" href="/itcodescanner/?target=filescanner">FILE SCANNER</a>
      <a id="HelpTopicsLinkId" style="display:none" href="/itcodescanner/?target=HelpTopics">HELP TOPICS</a>
      <a id="howtoLinkId" href="/itcodescanner/?target=howto">HOW TO VIDEOS</a>
      <a id="contactusLinkId" href="/itcodescanner/contactus">CONTACT US</a>

      <?php if ($isLoggedin): ?>
         <a id="loginLinkId" style="display:none" href="/itcodescanner/login">LOG IN</a>
         <a id="logoutLinkId"  href="javascript:Logout()">LOGOUT</a>
         <a id="profileLinkId" href="/itcodescanner/profile"">PROFILE</a>
      <?php else: ?>
         <a id="loginLinkId" href="/itcodescanner/login">LOG IN</a>
         <a id="logoutLinkId"  style="display:none" href="javascript:Logout()">LOGOUT</a>
         <a id="profileLinkId" style="display:none" href="/itcodescanner/profile"">PROFILE</a>
      <?php endif; ?>
      
      
      <a id="buymecoffee" href="https://www.buymeacoffee.com/smah" target="_blank">
         <i id="coffeeBtn" class="fas fa-coffee"
            style=" font-size: 12px; border-radius: 5px; padding: 2px; ">&nbsp; <span
               style="font-family: var(--bs-font-sans-serif); font-size: 14px; font-weight: 300;">Buy me a coffee
               <span></i>
      </a>
      <?php if ($tutorialsPageFlag): ?>
         <a class="searchWrapper"><span id="itemsearchDivId">
            <form autocomplete="off" class="dummyForm">
               <input id='tutorial-search-box' data-dropdownset='n' type='text' name='item' autocomplete='off'
                  placeholder='search' />
               <button id="itemsearchBtnId" class='' onclick='searchTutorial(); return false;'><i
                     class="fas fa-search"></i></button>
            </form>
            </span>
         </a>
      <?php endif; ?>
      
      <a href="javascript:void(0);" class="icon" style="margin-right: 20px" onclick="myTopNavFunction()">
            <i class="fa fa-bars"></i>
      </a>
</div>
<script>
   //console.log("<?php echo $isLoggedin ?>");
   let pageName = "";
   if ("<?php echo $tutorialsPageFlag ?>"){
      pageName = "tutorials";
   }else {
      var path = window.location.pathname;
      pageName =path.replaceAll("/itcodescanner/", "");
   }
   if (pageName == ""){
      pageName = "tutorials";
   }
   x = document.getElementById(pageName + "LinkId");
   x.className += " active";
</script>