  function exportWord(){
    var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
        "xmlns:w='urn:schemas-microsoft-com:office:word' "+
        "xmlns='http://www.w3.org/TR/REC-html40'>"+
        "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";

   var footer = "</body></html>";
   var id = document.querySelector('.richText-editor').id
   var sourceHTML = header+document.getElementById(id).innerHTML+footer;
   
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
    var id = document.querySelector('.richText-editor').id;
    var elementHTML = document.querySelector('#' + id);
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

function copyText() {
    var r = document.createRange();
    var id2 = document.querySelector('.richText-editor').id;
    r.selectNode(document.getElementById(id2));
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(r);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();

    toastr.success('Result text has been copied successfully');
}

function exportTXT() {
    var id2 = document.querySelector('.richText-editor').id;
    var elHtml = document.getElementById(id2).innerText;
    var link = document.createElement('a');
    var mimeType = 'text/plain';

    link.setAttribute('download', 'document.txt');
    link.setAttribute('href', 'data:' + mimeType  +  ';charset=utf-8,' + encodeURIComponent(elHtml));
    link.click(); 
}
  
  