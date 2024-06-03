  function exportWord(){
    var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
        "xmlns:w='urn:schemas-microsoft-com:office:word' "+
        "xmlns='http://www.w3.org/TR/REC-html40'>"+
        "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";

   var footer = "</body></html>";
   var sourceHTML = header+document.getElementById('chat-container').innerHTML+footer;
   
   var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
   var fileDownload = document.createElement("a");
   document.body.appendChild(fileDownload);
   fileDownload.href = source;
   fileDownload.download = 'document.doc';
   fileDownload.click();
   document.body.removeChild(fileDownload);

   toastr.success('Word document was created successfully');
}

function exportPDF(){
    window.jsPDF = window.jspdf.jsPDF;
    var doc = new jsPDF();
    var elementHTML = document.querySelector('#chat-container');
    doc.setFont('PTSans');
    doc.html(elementHTML, {
        callback: function(doc) {
            doc.save('document.pdf');
        },
        x: 15,
        y: 15,
        width: 170, //target width in the PDF document
        windowWidth: 650 //window width in CSS pixels
    });

    toastr.success('PDF file was created successfully');

}

function exportTXT() {
    var elHtml = document.getElementById('chat-container').innerText;
    var link = document.createElement('a');
    var mimeType = 'text/plain';

    link.setAttribute('download', 'document.txt');
    link.setAttribute('href', 'data:' + mimeType  +  ';charset=utf-8,' + encodeURIComponent(elHtml));
    link.click(); 
}
  
  