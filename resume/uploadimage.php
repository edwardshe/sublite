<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Upload Image Without Page Refresh!</title>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>

        <script type="text/javascript" >
            $(document).ready(function() {
                $('#submitbtn').click(function() {
                    $("#viewresult").html('');
                    $("#viewresult").html('<img src="img/loading.gif" />');
                    $(".uploadform").ajaxForm({
                        target: '#viewresult'
                    }).submit();
                });
            });
        </script> 
    </head> 
    <body>
        <h2>Upload Resume Without Page Refresh!</h2>
 
            <form class="uploadform" method="post" enctype="multipart/form-data" action='upload.php'>
                <p>Select File to Upload (Must be under 2MB):</p>
                <input type="hidden" name="MAX_FILE_SIZE" value="2097152" /> 
                <input type="file" accept=".doc, .docx, .rtf, .pdf, .txt, .odf" name="userFile" id="userFile">
                <input type="submit" value="Upload" name="submitbtn" id="submitbtn">
                <p>Accepted file extensions are .doc, .docx, .rtf, .pdf, .txt, .odf</p>
                <input type="text" >
            </form>
            
            <div id='viewresult'></div>
 
    </body>
</html>