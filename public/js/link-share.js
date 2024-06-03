/*===========================================================================
*
*  COPY TO CLIPBOARD (Result URL)
*
*============================================================================*/

$('#actions-copy').on("click", function(e) {

    "use strict";

    e.preventDefault();

    var clipboardText = "";
    clipboardText = $(this).data("link")
    copyToClipboard( clipboardText );

	toastr.success('Your referral url has been copied');
    
});
  
function copyToClipboard(text) {

    "use strict";

    var textArea = document.createElement( "textarea" );
    textArea.value = text;
    document.body.appendChild( textArea );

    textArea.select();

    try {
        var successful = document.execCommand( 'copy' );
        var msg = successful ? 'successful' : 'unsuccessful';
    
    } catch (err) {
        console.log(msg);
    }
        document.body.removeChild( textArea );
}