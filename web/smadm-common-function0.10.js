const allowedTags = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'p', 'a', 'ul', 'ol',
  'nl', 'li', 'b', 'i', 'strong', 'em', 'strike', 'code', 'hr', 'br', 'div',
  'table', 'thead', 'caption', 'tbody', 'tr', 'th', 'td', 'pre' ];

const deleteEmptyTags = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'p', 'a', 'ul', 'ol',
  'nl', 'li', 'b', 'i', 'strong', 'em', 'strike', 'code', 'hr', 'div',
  'table', 'thead', 'caption', 'tbody', 'pre' ];

const blockSelectTags = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'p' ];


function admshowAdditionalMenuItemsForLoggedIn() {
    document.getElementById("logoutLinkId").style.display = "block";
    document.getElementById("admLinkId").style.display = "block";
    //document.getElementById("intQLinkId").style.display = "block";
    document.getElementById("loginLinkId").style.display = "none";
}

function admhideMenuItemsForLoggedOut() {
    document.getElementById("logoutLinkId").style.display = "none";
    document.getElementById("admLinkId").style.display = "none";
    //document.getElementById("intQLinkId").style.display = "none";
    document.getElementById("loginLinkId").style.display = "block";
}

function admcheckURL() {

    //document.getElementById("displayFileLoaderDivId").style.display = "block";
    document.getElementById("tutorialDivId").style.display = "none";
    document.getElementById("tutorialListDivId").style.display = "none";

    var myUrl = window.location.protocol + "//" + window.location.host +
        window.location.pathname;

    var LocationSearchStr = location.search;
    var find = '%20';
    var re = new RegExp(find, 'g');
    var pageName = "tutorial";
    var path = window.location.pathname;

    LocationSearchStr = LocationSearchStr.replace(re, ' ');

    if (LocationSearchStr.indexOf('passkey=') > 0) {
        var ar = LocationSearchStr.split('passkey=');
        var accountactivationkey = ar[1];
        activateAccount(accountactivationkey);
        return;
    }

    try{
        if (localStorage.getItem("cookieAccepted") == "y") {
            document.getElementById("cookie-div-id").style.display = "none"
        } else{
            document.getElementById("cookie-div-id").style.display = "block"
        }
    }catch{

    }


    var myCookie = getCookie("cookname");

    if (myCookie == null) {
        localStorage.setItem("userLoggedIn", "n");
        admhideMenuItemsForLoggedOut();
        document.getElementById("loginLinkId").style.display = "block";
        document.getElementById("logoutLinkId").style.display = "none";
        document.getElementById("loginDivId").style.display = "block";
        return;

    } else {

        localStorage.setItem("userLoggedIn", "y");
        document.getElementById("loginLinkId").style.display = "none";
        document.getElementById("logoutLinkId").style.display = "block";
        document.getElementById("profileLinkId").style.display = "block";
        if (localStorage.getItem("userLvl") == "9") {
            the.smusr = true;
        }

        $.ajax({
            url: the.hosturl + '/php/process.php',
            data: { usrfunction: "checklogin" },
            type: 'POST',
            dataType: 'json',
            success: function (retstatus) {
                if (retstatus == "err") {
                    localStorage.setItem("userLoggedIn", "n");
                    admhideMenuItemsForLoggedOut();
                    document.getElementById("loginDivId").style.display = "block";
                    document.getElementById("loginLinkId").style.display = "block";
                    document.getElementById("logoutLinkId").style.display = "none";
                    return;
                }else {
                    admshowAdditionalMenuItemsForLoggedIn();

                    admproceedWithRequest();
                }
            },
            error: function (xhr, status, error) {

            }
        });

    }

}

function admproceedWithRequest() {

    var LocationSearchStr = location.search;
    var find = '%20';
    var re = new RegExp(find, 'g');
    var pageName = "interviewqs";
    var path = window.location.pathname;

    LocationSearchStr = LocationSearchStr.replace(re, ' ');

    if (path.indexOf('tutorials/') > 0) {
        //var songtitle = path.replaceAll("/antaksharee/lyrics/","");

        if (sessionStorage.getItem("LanguageHelpCodeAndIds") == null) {
            //document.getElementById("loaderDivId").style.display = "block";
            setTimeout(function () {
                //document.getElementById("loaderDivId").style.display = "none";
                checkURL();
            }, 500);
            return;
        }

        //document.getElementById("languageScanResultDivId").style.display = "none";
        document.getElementById("languageOverride").style.display = "none";
        document.getElementById("helpDetailsDivId").style.display = "none";
        document.getElementById("loginDivId").style.display = "none";
        document.getElementById("contactusDivId").style.display = "none";
        document.getElementById("howtoDivId").style.display = "none";
        document.getElementById("homeDivId").style.display = "none";

        document.getElementById("filescannerDivId").style.display = "none";
        document.getElementById("projectscannerDivId").style.display = "none"

        document.getElementById("HelpTopicsDivId").style.display = "none";
        document.getElementById("helpDisplayDivId").style.display = "none";

        document.getElementById("tutorialDivId").style.display = "block";

        document.getElementById("tutorialEditDivId").style.display = "block";


        var tutorialStr = path.substring(path.indexOf("tutorials/") + 10);

        if (screen.width < 700 || window.innerWidth < 700) {
            //document.getElementById("tutorialSearchDivId").style.display = "none";
            document.getElementById("tutorialEditDivId").style.display = "none";
        } else {
            //populateTutorialList();
        }

        if (tutorialStr.indexOf('/') > 0) {
            document.getElementById("mainContainer").style.width = "100%";
            document.getElementById("tutorialEditDivId").style.width = "20%";
            document.getElementById("tutorialEditDivId").innerHTML = "";
            getTutorial(tutorialStr);
            document.getElementById("loaderDivId").style.display = "none";
        } else {
            document.getElementById("slideInDivId").style.display = "none";
            tutorialStr = decodeURI(tutorialStr);
            document.getElementById("tutorialDivId").style.display = "none";
            document.getElementById("tutorialEditDivId").style.display = "none";
            document.getElementById("tutorialListDivId").style.display = "block";
            //document.getElementById("tutorialListDivId").style.width = "100%";
            //populateTutorialList();
            showTechnology(tutorialStr)
            document.getElementById("loaderDivId").style.display = "none";
        }


        return;
    }

    if (path.indexOf('interviewqs/') > 0) {

        document.getElementById("languageScanResultDivId").style.display = "none";
        document.getElementById("languageOverride").style.display = "none";
        document.getElementById("helpDetailsDivId").style.display = "none";
        document.getElementById("loginDivId").style.display = "none";
        document.getElementById("contactusDivId").style.display = "none";
        document.getElementById("howtoDivId").style.display = "none";
        document.getElementById("homeDivId").style.display = "none";

        document.getElementById("filescannerDivId").style.display = "none";
        document.getElementById("projectscannerDivId").style.display = "none"

        document.getElementById("HelpTopicsDivId").style.display = "none";
        document.getElementById("helpDisplayDivId").style.display = "none";

        document.getElementById("tutorialDivId").style.display = "block";

        document.getElementById("tutorialEditDivId").style.display = "block";


        let techStr = path.substring(path.indexOf("interviewqs/") + 12);

        if (screen.width < 700 || window.innerWidth < 700) {
            //document.getElementById("tutorialSearchDivId").style.display = "none";
            document.getElementById("tutorialEditDivId").style.display = "none";
        } else {
            //populateTutorialList();
        }


        document.getElementById("slideInDivId").style.display = "none";
        techStr = decodeURI(techStr);
        document.getElementById("tutorialDivId").style.display = "none";
        document.getElementById("tutorialEditDivId").style.display = "none";
        document.getElementById("tutorialListDivId").style.display = "block";
        //document.getElementById("tutorialListDivId").style.width = "100%";

        showInterviewQs(techStr)
        document.getElementById("loaderDivId").style.display = "none";
        return;
    }

    if (LocationSearchStr.indexOf('resetkey=') > 0) {
        var ar = LocationSearchStr.split('resetkey=');
        var passwordresetkey = ar[1];
        //resetPassword(passwordresetkey);
        sessionStorage.setItem("passwordresetkey", passwordresetkey);

        document.getElementById("helpDisplayDivId").style.display = "block";
        //Update url

        document.getElementById("languageScanResultDivId").style.display = "none";
        document.getElementById("languageOverride").style.display = "none";
        document.getElementById("helpDetailsDivId").style.display = "none";
        document.getElementById("contactusDivId").style.display = "none";
        document.getElementById("howtoDivId").style.display = "none";

        document.getElementById("filescannerDivId").style.display = "none";
        document.getElementById("HelpTopicsDivId").style.display = "none";
        document.getElementById("projectscannerDivId").style.display = "none";
        document.getElementById("loginDivId").style.display = "block";
        //document.getElementById("loginDivId").style.width = "70%";



        document.getElementById("loginerrormsg").innerHTML = "";

        //document.getElementById("helpDisplayDivId").style.width = "30%";


        showHelpDivMessage("Login to add or make updates to the help scan codes");

        document.getElementById("loginSecDivId").style.display = "none";
        document.getElementById("forgotPWDivId").style.display = "block";
        document.getElementById("loaderDivId").style.display = "none";
        return;
    }

    if (LocationSearchStr.indexOf('target=') > 0) {
        var ar = LocationSearchStr.split('target=');
        pageName = ar[1];
    }

    //if (onMobileBrowser()){
    //toggleLeftSideMenu("hide");
    //}



    //document.getElementById("filescannerDivId").style.display = "none";
    //document.getElementById("HelpTopicsDivId").style.display = "none";
    //document.getElementById("projectscannerDivId").style.display = "none";
    //document.getElementById("loginDivId").style.display = "none";
    //document.getElementById("contactusDivId").style.display = "none";
    //document.getElementById("howtoDivId").style.display = "none";
    //document.getElementById("homeDivId").style.display = "none";
    document.getElementById("tutorialDivId").style.display = "none";
    document.getElementById("tutorialListDivId").style.display = "none";
    document.getElementById("tutorialEditDivId").style.display = "none";

    document.getElementById("tutorialDivId").style.display = "block";
    //document.getElementById(pageName + "DivId").style.display = "block";


    // populateLanguages("helpTopics-lang-box");
    // try {
    //     x = document.getElementById(pageName + "LinkId");
    //     x.className += " active";
    // } catch {
    // }

    if (pageName == "HelpTopics") {

        if ((localStorage.getItem("userLoggedIn") == "n") || (localStorage.getItem("userLvl") != "9")) {
            //pageName = "projectscanner";
            Show("projectscanner");
            return
        }

        populateHelpTopics();
        document.getElementById("HelpTopicsDivId").style.width = "100%";
        document.getElementById("loaderDivId").style.display = "none";

    } else if (pageName == "projectscanner") {
        document.getElementById("bgSVGId").style.display = "none";
        populateStoredProjectList();
        if ((localStorage.getItem("userLoggedIn") == "y") && (localStorage.getItem("userLvl") == "9")) {
            document.getElementById("addNewProjBtnId").style.display = "block";
        }
        //document.getElementById("projectscannerDivId").style.width = "100%";
        document.getElementById("helpDivMessage").innerHTML = '<i class="fa fa-info-circle" style="display:none; float: left;  position: absolute; top:35px; left: 10px; color:orange;" ></i>' + "Upload project files and click on the file to scan the code"
        document.getElementById("loaderDivId").style.display = "none";
    } else if (pageName == "login") {
        document.getElementById("filescannerDivId").style.display = "none";
        document.getElementById("HelpTopicsDivId").style.display = "none";
        //document.getElementById("projectscannerDivId").style.display = "none";
        document.getElementById("loginDivId").style.display = "block";
        document.getElementById("helpDisplayDivId").style.display = "none";
        document.getElementById("loaderDivId").style.display = "none";
        //showHelpDivMessage("Login to add or make updates to the help scan codes");
    } else if (pageName == "contactus") {
        document.getElementById("filescannerDivId").style.display = "none";
        document.getElementById("HelpTopicsDivId").style.display = "none";
        //document.getElementById("projectscannerDivId").style.display = "none";
        document.getElementById("contactusDivId").style.display = "block";


        refreshCaptcha();
        document.getElementById("helpDisplayDivId").style.display = "none";
        //showHelpDivMessage("Contact us if you have any questions, feedback or are interested in purchasing the software. Some features have been disabled on the web version for security reasons. Full feature software can be used for software training/development, creating references and documentation for the software application. <br><br> If you found the site helpful, you can support our work by buying me a coffee by clicking on the coffee button at the top.");
        document.getElementById("loaderDivId").style.display = "none";
    } else if (pageName == "profile") {
        document.getElementById("bgSVGId").style.display = "none";

        showProfile();
        document.getElementById("loaderDivId").style.display = "none";
    } else if (pageName == "howto") {
        document.getElementById("bgSVGId").style.display = "none";
        document.getElementById("filescannerDivId").style.display = "none";
        document.getElementById("HelpTopicsDivId").style.display = "none";
        //document.getElementById("projectscannerDivId").style.display = "none";
        document.getElementById("helpDisplayDivId").style.display = "none";
        document.getElementById("contactusDivId").style.display = "none";
        document.getElementById("howtoDivId").style.display = "block";
        document.getElementById("howtoDivId").style.width = "95%";
        //document.getElementById("mainContainer").style.width = "100%";
        listVideos();
        document.getElementById("loaderDivId").style.display = "none";
    } else if (pageName == "filescanner") {
        document.getElementById("bgSVGId").style.display = "none";
        document.getElementById("btnCloseFileScanner").style.display = "none";
        if (localStorage.getItem("newWindowFileName") != null) {
            loadFile();

            localStorage.setItem("newWindowFileName", null);
            localStorage.setItem("newWindowFileObj", null);
        }
        document.getElementById("filescannerDivId").style.width = "100%";
        document.getElementById("loaderDivId").style.display = "none";
    } else if (pageName == "tutorial") {
        document.getElementById("filescannerDivId").style.display = "none";
        document.getElementById("HelpTopicsDivId").style.display = "none";
        //document.getElementById("projectscannerDivId").style.display = "none";
        document.getElementById("helpDisplayDivId").style.display = "none";
        document.getElementById("contactusDivId").style.display = "none";
        document.getElementById("howtoDivId").style.display = "none";
        //document.getElementById("tutorialDivId").style.width = "100%";
        document.getElementById("tutorialDivId").style.display = "none";
        document.getElementById("tutorialEditDivId").style.display = "none";
        document.getElementById("slideInDivId").style.display = "none";
        //document.getElementById("tutorialListDivId").style.width = "100%";
        populateTutorialList();
        //document.getElementById("mainContainer").style.width = "100%";
        $(".cardsContainerDivClassPadd").css("height", "200px");
        document.getElementById("loaderDivId").style.display = "none";
    }else if (pageName == "interviewqs") {
        // document.getElementById("filescannerDivId").style.display = "none";
        // document.getElementById("HelpTopicsDivId").style.display = "none";
        // //document.getElementById("projectscannerDivId").style.display = "none";
        // document.getElementById("helpDisplayDivId").style.display = "none";
        // document.getElementById("contactusDivId").style.display = "none";
        // document.getElementById("howtoDivId").style.display = "none";
        //document.getElementById("tutorialDivId").style.width = "100%";
        document.getElementById("tutorialDivId").style.display = "none";
        document.getElementById("tutorialEditDivId").style.display = "none";
        document.getElementById("slideInDivId").style.display = "none";
        //document.getElementById("tutorialListDivId").style.width = "100%";
        populateInterviewQsTechList();
        //document.getElementById("loaderDivId").style.display = "none";
    }
    else if (pageName == "home") {
        document.getElementById("filescannerDivId").style.display = "none";
        document.getElementById("HelpTopicsDivId").style.display = "none";
        //document.getElementById("projectscannerDivId").style.display = "none";
        document.getElementById("helpDisplayDivId").style.display = "none";
        document.getElementById("contactusDivId").style.display = "none";
        document.getElementById("howtoDivId").style.display = "none";
        document.getElementById("homeDivId").style.width = "100%";
        //document.getElementById("mainContainer").style.width = "100%";	
        document.getElementById("loaderDivId").style.display = "none";
    }
}

function admGetIntQTechs(){
    $.ajax({
        url: the.hosturl + '/php/process.php',
        data: { usrfunction: "admgetintqtechs" },
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            sessionStorage.setItem("intQTechList", response);
        },
        error: function (xhr, status, error) {
            //alert(xhr);
            // console.log(error);
            // console.log(xhr);
        }
    });
}

function showIntQsPage(){
    // document.getElementById("languageScanResultDivId").style.display = "none";
    // document.getElementById("languageOverride").style.display = "none";
    // document.getElementById("helpDetailsDivId").style.display = "none";
    // document.getElementById("loginDivId").style.display = "none";
    // document.getElementById("contactusDivId").style.display = "none";
    // document.getElementById("howtoDivId").style.display = "none";
    // document.getElementById("homeDivId").style.display = "none";

    // document.getElementById("filescannerDivId").style.display = "none";
    // document.getElementById("projectscannerDivId").style.display = "none"

    // document.getElementById("HelpTopicsDivId").style.display = "none";
    // document.getElementById("helpDisplayDivId").style.display = "none";

    document.getElementById("tutorialDivId").style.display = "block";

    document.getElementById("tutorialEditDivId").style.display = "block";

    if (screen.width < 700 || window.innerWidth < 700) {
        //document.getElementById("tutorialSearchDivId").style.display = "none";
        document.getElementById("tutorialEditDivId").style.display = "none";
    } else {
        //populateTutorialList();
    }




}

function populateInterviewQsTechList(){
    var tf = sessionStorage.getItem("intQTechList");
    var rows = JSON.parse(tf);


    var innHTML = "";

    for (var i = 0; i < rows.length; i++) {

            innHTML = innHTML + "<div class='tutorialDiv cursor_pointer' onclick='showInterviewQs(" + '"' + rows[i].tech + '"' + "); return false;' > <a  hrefX= '" + the.hosturl + "/interviewqs/" + rows[i].tech + "'>" + rows[i].tech + "</a></div>";
 
    }
    //document.getElementById("dropDownTutListId").innerHTML = innHTML;
    document.getElementById("tutorialListDivId").style.display = "block";
    document.getElementById("tutorialListInnerDivId").style.display = "block";
    
    document.getElementById("tutorialListInnerDivId").innerHTML = innHTML + "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";


}

function showInterviewQs(tech){
    $.ajax({
        url: the.hosturl + '/php/process.php',
        data: { tech: tech, usrfunction: "admgetinterviewqs" },
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            admlistIntQs(response);

            setTimeout(function () {
                document.getElementById("intQEasyUpdMode").checked = true;
                activateEasyUpdateMode();
            }, 800);

            if ((sessionStorage.getItem("hideLeftMenuBar") == "Y") || (onMobileBrowser())) {
                setTimeout(() => {
                    toggleLeftSideMenu("hide");
                }, 50);
            }
        },
        error: function (xhr, status, error) {
            //alert(xhr);
            // console.log(error);
            // console.log(xhr);
        }
    });
}

function admlistIntQs(rows = []){
    let innerHTML = "<div class='intQToolBox'>";
    innerHTML = innerHTML + "<label><input id='intQPracticeModeId' type='checkbox' onchange='intQPracticeMode(this);'>Practice Mode (Show questions. Hide answers which can be displayed using button. Hide other fields.)</label>";
    innerHTML = innerHTML + "<label><input id='intQEasyUpdMode' type='checkbox' onchange='intQEasyMode(this);'>Easy Update Mode (When need to update only question/answers. Hide other fields.)</label>";
    innerHTML = innerHTML + "</div>";
    
    //let path = window.location.pathname;

    for (let record of rows) {
        let questionid = record.questionid;
        let seqid = record.seqid;
        let tech = record.tech;

        let subtech = record.subtech;
        let questiontype = record.questiontype;
        let question = record.question;


        let ansdesc = record.ansdesc;
        let opt1 = record.optn1;
        let opt2 = record.optn2;
        let opt3 = record.optn3;
        let opt4 = record.optn4;
        let rtoptn = record.rtoptn;

        let complexity = record.complexity;
        let reviewed = record.reviewed;
        let discontinue = record.discontinue;

        let lastupdatedate = record.lastupdatedate;
        let writer = record.writer;

        innerHTML = innerHTML + '<div class="intq_container padding_20px shadow_3" data-questionid="' + record.questionid + '" > ';

        innerHTML = innerHTML + '<div  class="intq_questionid" data-title="questionid" >' + questionid + '</div>';
        innerHTML = innerHTML + '<div contenteditable="true" class="intq_seqid" data-title="seqid" >' + seqid + '</div>';

        innerHTML = innerHTML + '<div contenteditable="true" class="intq_tech" data-title="tech" >' + tech + '</div>';
        innerHTML = innerHTML + '<div contenteditable="true" class="intq_subtech" data-title="subtech" >' + subtech + '</div>';
        innerHTML = innerHTML + '<div contenteditable="true" class="intq_questiontype" data-title="questiontype-mcq/desc/other" >' + questiontype + '</div>';

        innerHTML = innerHTML + '<div contenteditable="true" class="intq_question"  >' + question + '</div>';
        innerHTML = innerHTML + '<div contenteditable="true" class="intq_ansdesc"  >' + ansdesc + '</div>';

        innerHTML = innerHTML + '<div contenteditable="true" class="intq_opt1" data-title="opt1" >' + opt1 + '</div>';
        innerHTML = innerHTML + '<div contenteditable="true" class="intq_opt2" data-title="opt2" >' + opt2 + '</div>';
        innerHTML = innerHTML + '<div contenteditable="true" class="intq_opt3" data-title="opt3" >' + opt3 + '</div>';
        innerHTML = innerHTML + '<div contenteditable="true" class="intq_opt4" data-title="opt4" >' + opt4 + '</div>';
        innerHTML = innerHTML + '<div contenteditable="true" class="intq_rtoptn" data-title="rtoptn" >' + rtoptn + '</div>';

        innerHTML = innerHTML + '<div contenteditable="true" class="intq_complexity" data-title="complexity" >' + complexity + '</div>';

        innerHTML = innerHTML + '<div contenteditable="true" class="intq_discontinue" data-title="discontinue" >' + discontinue + '</div>';
        innerHTML = innerHTML + '<div contenteditable="true" class="intq_lastupdatedate" data-title="lastupdatedate" >' + lastupdatedate + '</div>';
        innerHTML = innerHTML + '<div contenteditable="true" class="intq_writer" data-title="writer" >' + writer + '</div>';

        if (reviewed != "1") {
            innerHTML = innerHTML + '<div contenteditable="true" data-title="reviewed" class="bgcolor_4 intq_reviewed" >' + reviewed + '</div>';
        } else {
            innerHTML = innerHTML + '<div contenteditable="true" data-title="reviewed" class="intq_reviewed">' + reviewed + '</div>';
        }
        innerHTML = innerHTML + '<button class="intq_saveasnew btn btn-primary" style="float:right" onclick="admsaveAsNewIntQ(event)">Save As New</button>';

        innerHTML = innerHTML + '<button class="intq_showans btn btn-primary displayNone" style="float:center" onclick="showAns(event)">Show/Hide Answer</button>';
        
        innerHTML = innerHTML + '<button class="intq_sanitize btn btn-primary" style="float:center" onclick="sanitizeQnA(event)">Sanitize Q-Ans Texts</button>';

        innerHTML = innerHTML + '<button class="intq_savechanges btn btn-primary" onclick="admsaveIntQChanges(event)">Save Changes</button>';
        
        innerHTML = innerHTML + '<button class="intq_showallfields btn btn-primary displayNone" onclick="showAllFieldsOfParent(event)">Show All Fields</button>';

        
        innerHTML = innerHTML + '</div>';
    }

    // document.getElementById("homeDivId").style.display = "none";
    // document.getElementById("loginDivId").style.display = "none";
    // document.getElementById("contactusDivId").style.display = "none";

    document.getElementById("tutorialListDivId").style.minWidth = "350px";
    document.getElementById("tutorialDivId").style.display = "block";
    document.getElementById("tutorialDivId").innerHTML = innerHTML + "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

    document.getElementById("slideInDivId").style.display = "block";
    document.getElementById("tutorialDivId").style.width = "100%";
}

function intQPracticeMode(cb){
    if (cb.checked){
        document.getElementById("intQEasyUpdMode").checked = false;
        // Hide elements
        $(".intq_questionid").hide();
        $(".intq_seqid").hide();
        $(".intq_tech").hide();
        $(".intq_subtech").hide();
        $(".intq_questiontype").hide();

        $('.intq_questiontype').each(function() {
            let $parent = $(this).closest('.intq_container');
            let qtype = $(this).text().toUpperCase();
          
            if (qtype !== 'MCQ') {
              $parent.find('.intq_opt1, .intq_opt2, .intq_opt3, .intq_opt4').hide();
            }
          });


        $(".intq_ansdesc").hide();

        $(".intq_rtoptn").hide();

        $(".intq_complexity").hide();
        $(".intq_discontinue").hide();
        $(".intq_lastupdatedate").hide();
        $(".intq_writer").hide();
        
        $(".intq_reviewed").hide();
        $(".intq_saveasnew").hide();
        $(".intq_sanitize").hide();
        $(".intq_savechanges").hide();

        // Display elements 
        $(".intq_showans").show();
        $(".intq_showallfields").show();
    }else {
        // Hide elements
        $(".intq_questionid").show();
        $(".intq_seqid").show();
        $(".intq_tech").show();
        $(".intq_subtech").show();
        $(".intq_questiontype").show();

        $(".intq_ansdesc").show();

        $(".intq_opt1").show();
        $(".intq_opt2").show();
        $(".intq_opt3").show();
        $(".intq_opt4").show();

        $(".intq_rtoptn").show();

        $(".intq_complexity").show();
        $(".intq_discontinue").show();
        $(".intq_lastupdatedate").show();
        $(".intq_writer").show();

        $(".intq_reviewed").show();
        $(".intq_saveasnew").show();
        $(".intq_sanitize").show();
        $(".intq_savechanges").show();

        // Display elements 
        $(".intq_showans").hide();
        $(".intq_showallfields").hide();
    }

}

function showAns(evt){
    let $parent = $(evt.currentTarget).closest('.intq_container');

    let qtype = $parent.find(".intq_questiontype").text().toUpperCase();

    if (qtype !== 'MCQ') {
        $parent.find('.intq_ansdesc').toggle();
    }else{
        $parent.find('.intq_rtoptn').toggle(); 
    }
}

function activateEasyUpdateMode(){
    $(".intq_questionid").hide();
    $(".intq_seqid").hide();
    $(".intq_tech").hide();
    $(".intq_subtech").hide();
    $(".intq_questiontype").hide();
    
    
    $('.intq_questiontype').each(function() {
        let $parent = $(this).closest('.intq_container');
        let qtype = $(this).text().toUpperCase();
      
        if (qtype !== 'MCQ') {
          $parent.find('.intq_opt1, .intq_opt2, .intq_opt3, .intq_opt4, .intq_rtoptn').hide();
        }else{
           $parent.find(".intq_ansdesc").hide();
        }
      });


    //$(".intq_ansdesc").hide();

    //$(".intq_rtoptn").hide();

    $(".intq_complexity").hide();
    $(".intq_discontinue").hide();
    $(".intq_lastupdatedate").hide();
    $(".intq_writer").hide();
    
    //$(".intq_reviewed").hide();
    $(".intq_saveasnew").hide();
    //$(".intq_sanitize").hide();
    //$(".intq_savechanges").hide();

    // Display elements 
    //$(".intq_showans").show();

    $(".intq_showallfields").show();
}

function showAllFields(){
    $(".intq_showallfields").hide();

    $(".intq_questionid").show();
    $(".intq_seqid").show();
    $(".intq_tech").show();
    $(".intq_subtech").show();
    $(".intq_questiontype").show();

    $(".intq_ansdesc").show();

    $(".intq_opt1").show();
    $(".intq_opt2").show();
    $(".intq_opt3").show();
    $(".intq_opt4").show();

    $(".intq_rtoptn").show();

    $(".intq_complexity").show();
    $(".intq_discontinue").show();
    $(".intq_lastupdatedate").show();
    $(".intq_writer").show();

    $(".intq_reviewed").show();
    $(".intq_saveasnew").show();
    $(".intq_sanitize").show();

    

    $(".intq_savechanges").show();

}

function showAllFieldsOfParent(evt){
    let $parent = $(evt.currentTarget).closest('.intq_container');


    $parent.find(".intq_questionid").show();
    $parent.find(".intq_seqid").show();
    $parent.find(".intq_tech").show();
    $parent.find(".intq_subtech").show();
    $parent.find(".intq_questiontype").show();

    $parent.find(".intq_ansdesc").show();

    $parent.find(".intq_opt1").show();
    $parent.find(".intq_opt2").show();
    $parent.find(".intq_opt3").show();
    $parent.find(".intq_opt4").show();

    $parent.find(".intq_rtoptn").show();

    $parent.find(".intq_complexity").show();
    $parent.find(".intq_discontinue").show();
    $parent.find(".intq_lastupdatedate").show();
    $parent.find(".intq_writer").show();

    $parent.find(".intq_reviewed").show();
    $parent.find(".intq_saveasnew").show();
    $parent.find(".intq_sanitize").show();    

    $parent.find(".intq_savechanges").show();
}

function intQEasyMode(cb){
    //alert(cb.checked);

    if (cb.checked){
        
        // Hide elements
        showAllFields();
        activateEasyUpdateMode();
        document.getElementById("intQPracticeModeId").checked = false;
        $(".intq_showans").hide();
    }else {
        // Hide elements
        showAllFields();

        // Display elements 
        //$(".intq_showans").hide();
    }

}

function sanitizeQnA(evt){
    let parentDiv = evt.currentTarget.parentElement;

    let question = parentDiv.querySelector('.intq_question').innerHTML;
    parentDiv.querySelector('.intq_question').innerHTML= sanitize(question);

    let ansdesc = parentDiv.querySelector('.intq_ansdesc').innerHTML;
    parentDiv.querySelector('.intq_ansdesc').innerHTML = sanitize(ansdesc);

    let opt1 = parentDiv.querySelector('.intq_opt1').innerHTML;
    parentDiv.querySelector('.intq_opt1').innerHTML= sanitize(opt1);

    let opt2 = parentDiv.querySelector('.intq_opt2').innerHTML;
    parentDiv.querySelector('.intq_opt2').innerHTML= sanitize(opt2);


    let opt3 = parentDiv.querySelector('.intq_opt3').innerHTML;
    parentDiv.querySelector('.intq_opt3').innerHTML= sanitize(opt3);

    let opt4 = parentDiv.querySelector('.intq_opt4').innerHTML;
    parentDiv.querySelector('.intq_opt4').innerHTML= sanitize(opt4);

    let rtoptn = parentDiv.querySelector('.intq_rtoptn').innerHTML;
    parentDiv.querySelector('.intq_rtoptn').innerHTML= sanitize(rtoptn);

}

function admsaveAsNewIntQ(evt){
    let parentDiv = evt.currentTarget.parentElement;

    let questionid = parentDiv.querySelector('.intq_questionid').textContent;
    let seqid = parentDiv.querySelector('.intq_seqid').textContent;
    let tech = parentDiv.querySelector('.intq_tech').textContent;
    let subtech = parentDiv.querySelector('.intq_subtech').textContent;
    let questiontype = parentDiv.querySelector('.intq_questiontype').textContent;

    let question = parentDiv.querySelector('.intq_question').innerHTML;
    let ansdesc = parentDiv.querySelector('.intq_ansdesc').innerHTML;

    let opt1 = parentDiv.querySelector('.intq_opt1').innerHTML;
    let opt2 = parentDiv.querySelector('.intq_opt2').innerHTML;
    let opt3 = parentDiv.querySelector('.intq_opt3').innerHTML;
    let opt4 = parentDiv.querySelector('.intq_opt4').innerHTML;
    let rtoptn = parentDiv.querySelector('.intq_rtoptn').innerHTML;

    let complexity = parentDiv.querySelector('.intq_complexity').textContent;
    let discontinue = parentDiv.querySelector('.intq_discontinue').textContent;
    let lastupdatedate = parentDiv.querySelector('.intq_lastupdatedate').textContent;

    let writer = parentDiv.querySelector('.intq_writer').textContent;
    let reviewed = parentDiv.querySelector('.intq_reviewed').textContent;

    tech = tech.replaceAll("'", "''");
    subtech = subtech.replaceAll("'", "''");
    questiontype = questiontype.replaceAll("'", "''");
    question = question.replaceAll("'", "''");
    ansdesc = ansdesc.replaceAll("'", "''");
    opt1 = opt1.replaceAll("'", "''");
    opt2 = opt2.replaceAll("'", "''");
    opt3 = opt3.replaceAll("'", "''");
    opt4 = opt4.replaceAll("'", "''");
    rtoptn = rtoptn.replaceAll("'", "''");
    writer = writer.replaceAll("'", "''");

    $.ajax({
        url: the.hosturl + '/php/process.php',
        data: { questionid: questionid,
                seqid: seqid, 
                tech: tech,
                subtech: subtech,
                questiontype: questiontype,
                question: question,
                ansdesc: ansdesc,
                opt1: opt1,
                opt2: opt2,
                opt3: opt3,
                opt4: opt4,
                rtoptn: rtoptn,
                complexity: complexity,
                discontinue: discontinue,
                lastupdatedate: lastupdatedate,
                writer: writer,
                reviewed: reviewed,
                usrfunction: "createnewintq" },
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            let x = document.getElementById("toastsnackbar");
            if (response) {
                x.innerHTML = "Updates saved";
            } else {
                x.innerHTML = "Updates failed";
            }
            x.classList.add("show");
            setTimeout(function () {
                x.classList.remove("show");
            }, 3000);
        },
        error: function (xhr, status, error) {
            let x = document.getElementById("toastsnackbar");
            x.innerHTML = "Updates failed";
            x.classList.add("show");
            setTimeout(function () {
                x.classList.remove("show");
            }, 3000);
        }
    });
}

function admsaveIntQChanges(evt){

    let parentDiv = evt.currentTarget.parentElement;

    let questionid = parentDiv.querySelector('.intq_questionid').textContent;
    let seqid = parentDiv.querySelector('.intq_seqid').textContent;
    let tech = parentDiv.querySelector('.intq_tech').textContent;
    let subtech = parentDiv.querySelector('.intq_subtech').textContent;
    let questiontype = parentDiv.querySelector('.intq_questiontype').textContent;

    let question = parentDiv.querySelector('.intq_question').innerHTML;
    let ansdesc = parentDiv.querySelector('.intq_ansdesc').innerHTML;
    let opt1 = parentDiv.querySelector('.intq_opt1').innerHTML;
    let opt2 = parentDiv.querySelector('.intq_opt2').innerHTML;
    let opt3 = parentDiv.querySelector('.intq_opt3').innerHTML;
    let opt4 = parentDiv.querySelector('.intq_opt4').innerHTML;
    let rtoptn = parentDiv.querySelector('.intq_rtoptn').innerHTML;

    let complexity = parentDiv.querySelector('.intq_complexity').textContent;
    let discontinue = parentDiv.querySelector('.intq_discontinue').textContent;
    let lastupdatedate = parentDiv.querySelector('.intq_lastupdatedate').textContent;

    let writer = parentDiv.querySelector('.intq_writer').textContent;
    let reviewed = parentDiv.querySelector('.intq_reviewed').textContent;

    tech = tech.replaceAll("'", "''");
    subtech = subtech.replaceAll("'", "''");
    questiontype = questiontype.replaceAll("'", "''");
    question = question.replaceAll("'", "''");
    ansdesc = ansdesc.replaceAll("'", "''");
    opt1 = opt1.replaceAll("'", "''");
    opt2 = opt2.replaceAll("'", "''");
    opt3 = opt3.replaceAll("'", "''");
    opt4 = opt4.replaceAll("'", "''");
    rtoptn = rtoptn.replaceAll("'", "''");
    writer = writer.replaceAll("'", "''");

    $.ajax({
        url: the.hosturl + '/php/process.php',
        data: { questionid: questionid,
                seqid: seqid, 
                tech: tech,
                subtech: subtech,
                questiontype: questiontype,
                question: question,
                ansdesc: ansdesc,
                opt1: opt1,
                opt2: opt2,
                opt3: opt3,
                opt4: opt4,
                rtoptn: rtoptn,
                complexity: complexity,
                discontinue: discontinue,
                lastupdatedate: lastupdatedate,
                writer: writer,
                reviewed: reviewed,
                usrfunction: "saveintqchanges" },
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            let x = document.getElementById("toastsnackbar");
            if (response) {
                x.innerHTML = "Updates saved";
            } else {
                x.innerHTML = "Updates failed";
            }
            x.classList.add("show");
            setTimeout(function () {
                x.classList.remove("show");
            }, 3000);
        },
        error: function (xhr, status, error) {
            let x = document.getElementById("toastsnackbar");
            x.innerHTML = "Updates failed";
            x.classList.add("show");
            setTimeout(function () {
                x.classList.remove("show");
            }, 3000);
        }
    });
}

function sanitize (html) {
    let sanitized = sanitizeHtml(html, {
      allowedTags: allowedTags
    });
    sanitized = sanitized
      // <br /><br /> -> </p><p>
      .replace(/<br \/>(\s)*(<br \/>)+/g, '</p><p>')
      // </p><br /> -> </p>
      .replace(/<p \/>(\s)*(<br \/>)+/g, '</p>')
      // <p><br /> -> </p>
      .replace(/<p>(\s)*(<br \/>)+/g, '<p>');
    // delete empty tags
    deleteEmptyTags.forEach(tag => {
      let regex = new RegExp(`<${tag}>(\\s)*</${tag}>`, 'g');
      sanitized = sanitized
        .replace(regex, '');
    })
    
    return sanitized;
}