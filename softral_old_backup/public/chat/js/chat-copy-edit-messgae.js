
    $(".me").on('mousedown', function(e){
        if( e.button == 2 ) {
            console.log("Right Click");
            
            var me = $(this);
            $(".js-emaillink").html($(this).html());
            $("#js-emaillink-edit").val($(me).next().val());
        }
    });
    
    
    $(function(){
        //        $('.context').jeegoocontext('menu');
        $('.me').jeegoocontext('menu');
        /*
        $('.context').jeegoocontext('menu', {
            data: $(this).html()
        });
         */
    });
    
    
    /**
     * Copy
     */
    $(".js-emailcopybtn").click(function(){
        console.log("copy");
        $("#js-emaillink-edit").val("0");
    });
    
    
    
    var copyEmailBtn = document.querySelector('.js-emailcopybtn');  
    if(copyEmailBtn != null){
        
        
        copyEmailBtn.addEventListener('click', function(event) {
            
            
            // Select the email link anchor text  
            var emailLink = document.querySelector('.js-emaillink');  
            var range = document.createRange();  
            range.selectNode(emailLink);  
            window.getSelection().addRange(range);  
    
            try {  
                // Now that we've selected the anchor text, execute the copy command  
                var successful = document.execCommand('copy');  
                var msg = successful ? 'successful' : 'unsuccessful';  
                console.log('Copy email command was ' + msg);  
            } catch(err) {  
                console.log('Oops, unable to copy');  
            }  
    
            // Remove the selections - NOTE: Should use   
            // removeRange(range) when it is supported  
            window.getSelection().removeAllRanges();  
        });
        
        
        /**
         * End of section
         * Copy
         */
        
        
        /**
         * Edit
         */
        var editEmailBtn = document.querySelector('.js-emailcopybtn-edit');  
        if(editEmailBtn != null){
        
        
            editEmailBtn.addEventListener('click', function(event) {
            
                console.log('edited');
            
                // Select the email link anchor text  
                var emailLink = document.querySelector('.js-emaillink');  
                var range = document.createRange();  
                range.selectNode(emailLink);  
                window.getSelection().addRange(range);  
                
                
                //                var range = document.createRange();
                //                range.selectNode(document.getElementById('js-emaillink'));
                //                window.getSelection().addRange(range);
    
                try {  
                    // Now that we've selected the anchor text, execute the copy command  
                    var successful = document.execCommand('copy');  
                    var msg = successful ? 'successful' : 'unsuccessful';  
                    console.log('Edit command was ' + msg);  
                } catch(err) {  
                    console.log('Oops, unable to edit');  
                }  
    
                // Remove the selections - NOTE: Should use   
                // removeRange(range) when it is supported  
                window.getSelection().removeAllRanges();  
            });
    
        }
        
        /**
         * End of Section
         * Edit
         */
    
    }
