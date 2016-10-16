
// When the server is ready...
$(function () {
    'use strict';
    // Define the url to send the image data to
    var base_url = "<?php echo $websiteRoot; ?>";
    var url = base_url + "uploads/files.php";
        
    // Call the fileupload widget and set some parameters
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            // Add each uploaded file name to the #files list
            $.each(data.result.files, function (index, file) {
                // Update Database....
                var chattype = $("#chattype").val();
                var sendto = $("#sendto").val();
                var groupid = $("#groupid").val();
                                        
                var dataString = 'name='+file.name+'&chattype='+chattype+'&sendto='+sendto+'&groupid='+groupid;
                    
                if(file.error){
                    console.log(file.error);
                    $('#progress').hide();
                }else{
                    $.ajax({
                        type: "POST",
                        url: base_url + 'ajax_process.php',
                        data: dataString,
                        cache: true,
                        success: function(html){
                            if(file.error){
                            //Unable to uplaod, Catch all error here
                            }
                            else{
                                $('#progress').hide();
                            }
                        }  
                    });
                }        
            });
        },
        progressall: function (e, data) {
            // Update the progress bar while files are being uploaded
            $('#progress').show();
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .bar').css('width', progress + '%');
        }
    });
});
