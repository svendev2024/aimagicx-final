/*===========================================================================
*
*  FORMAT TIME
*
*============================================================================*/

function formatTime(t) {
    let a = t.split(".");
    let date = new Date(null);
    date.setSeconds(a[0]); 
    let result = date.toISOString().substr(11, 8);
    return result + "." + a[1];
}



/*===========================================================================
*
*  DOWNLOAD TRANSCRIPT RESULT
*
*============================================================================*/

$('#download-now').on('click', function(e) {

    e.preventDefault();
    
    let d = new Date();
    let date = ("0" + d.getDate()).slice(-2) + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + d.getFullYear();

    let text = final_result;
    text = text.replace(/\n/g, "\r\n"); // To retain the Line breaks.
    let blob = new Blob([text], { type: "text/plain"});
    let anchor = document.createElement("a");
    anchor.download = date + "-transcribe-result.txt";
    anchor.href = window.URL.createObjectURL(blob);
    anchor.target ="_blank";
    anchor.style.display = "none"; // just to be safe!
    document.body.appendChild(anchor);
    anchor.click();
    document.body.removeChild(anchor);

});



