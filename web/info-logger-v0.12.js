// ***SM:DO NOT DELETE***This file is used in individual pages

let speechRecognizer;

setTimeout(() => {
    $(".printBtnDivCls").hide();
    $(".commentMsg").hide();
    $("#sndmsgdivid").hide();
    toggleLeftSideMenu("hide");
}, 100);

function insertLogImage(evt) {
    let saveasname = window.location.href.substring(window.location.href.lastIndexOf('/') + 1) + "-" + (Math.floor(Math.random() * 1000000) + 1) + ".png";
    let maximumSize = 500;

    let files = evt.target.files;

    let $parentRow = $(evt.target).closest('tr');

    if (files.length > 0) {

        resizeImage({
            file: files[0],
            maxSize: maximumSize
        }).then(function (resizedImage) {

            let formData = new FormData();
            formData.append("file", resizedImage);
            formData.append("saveasname", saveasname);
            formData.append("dir", "img");

            let xhttp = new XMLHttpRequest();

            xhttp.open("POST", the.hosturl + "/php/upload.php", true);

            // call on request changes state
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    //let response = this.responseText;
                    //console.log(response);

                    //document.getElementById(errormsgelementid + itemid).innerHTML = "<font color = #0000>" + response + "</font> ";
                    //let imagename = document.getElementById("image-" + itemid).value;
                    let randomId = "div-" + Math.floor(Math.random() * 1000000);
                    let Str = "<div id= '" + randomId + "' onmousedown=setLastFocusedDivId(this.id)  class = 'image1-desc'> " + "<img class='movieImageCls' alt ='' src= '" + the.hosturl + "/img/" + saveasname + "'> " + " <button title='clear image without deleting from backend' class='deleteDivInnImg' onclick=deleteCurrentComponent(this) ></button><button title='Remove image and delete from backend' class='deleteDivInnImgBk' onclick=deleteCurrentComponentAndRemoveBK(this) ></button></div>";
                    //insertImageInInfoDiv(Str, event);
                    $parentRow.find(".activity-column").append(Str);
                }
            };

            xhttp.send(formData);
        }).catch(function (err) {
            //console.error(err);
        });


    } else {
        alert("Please select a file");
    }
}

function insertImageInInfoDiv(html, evt) {
    let $parentRow = $(evt.currentTarget).closest('tr');

    //const activityBox = parentElement.querySelector(".activity-column");

    $parentRow.querySelector(".activity-column").append(html);
}

function addNewRow() {
    const table = document.getElementById("activityLog");
    const newRow = table.insertRow(table.rows.length);
    newRow.innerHTML = table.rows[0].innerHTML; // Clone the first row

    // Clear the content in the new row
    newRow.cells[0].textContent = "";
    newRow.cells[1].textContent = "";

    // Reset the Date and Time to "Current Date and Time"
    const timeColumn = newRow.querySelector(".time-column");
    timeColumn.textContent = formatCurrentDateTime();
    timeColumn.id = "defaultTime";

    const activityColumns = newRow.querySelectorAll(".activity-column");

    activityColumns.forEach(function (column) {
        column.style.backgroundColor = "white";
    });
}

function removeRow(evt) {
    const isConfirmed = confirm("Are you sure you want to delete this element?");
    if (isConfirmed) {
        let $parentRow = $(evt.currentTarget).closest('tr');
        $parentRow.remove();
    }
}

function formatCurrentDateTime() {
    const options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        hour12: true,
    };
    const formattedDateTime = new Date().toLocaleString('en-US', options);
    return formattedDateTime;
}

function addVoiceToText() {
    // You can implement voice-to-text functionality here
    alert("Voice-to-text functionality will be implemented here.");
}

function changeColor(elem) {
    const selectedColor = elem.value;

    let parentElement = elem.parentElement.parentElement.parentElement;

    const activityColumns = parentElement.querySelectorAll(".activity-column");

    activityColumns.forEach(function (column) {
        column.style.backgroundColor = selectedColor;
    });
}

function recordInfo(evt) {
    
    let $parent = $(evt.currentTarget).closest('tr');

    $parent.find(".intq_stoprecording").show();
    $parent.find(".intq_recordresponse").hide();

    if ('webkitSpeechRecognition' in window) {
        if (!speechRecognizer) {
            speechRecognizer = new webkitSpeechRecognition();
        }
        speechRecognizer.continuous = true;
        speechRecognizer.interimResults = true;
        speechRecognizer.lang = 'en-US';
        speechRecognizer.start();

        let finalTranscripts = '';
        let spanElement = $('<span></span>');
        speechRecognizer.onresult = function (event) {
            //var interimTranscripts = '';
            for (var i = event.resultIndex; i < event.results.length; i++) {
                var transcript = event.results[i][0].transcript;
                transcript.replace("\n", "<br>");
                if (event.results[i].isFinal) {
                    finalTranscripts += transcript + '. '; // Add a full stop after each final result
                } else {
                    //interimTranscripts += transcript;
                }
            }
            //$parent.find(".activity-column").html(finalTranscripts);
            spanElement.html(finalTranscripts);
        };

        $parent.find(".activity-column").append(spanElement);

        speechRecognizer.onerror = function (event) {

        };
    }
}

function stopRecording(evt){
    let $parent = $(evt.currentTarget).closest('.btnControlDiv');

    $parent.find(".intq_stoprecording").hide();
    $parent.find(".intq_recordresponse").show();

    if (speechRecognizer) {
        speechRecognizer.stop();
    }
}
