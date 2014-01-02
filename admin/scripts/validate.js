function validate(object, validation){
	    
	var isvalidate=false;
	var objValue=$("#"+object).val();
     // alert (objValue)
	switch (validation){
		case "text": case "none":
			if (objValue==""){
			    isvalidate=false;                
			}
			else {
			    isvalidate=true;
			}
			break;
            
		case "image":
        //alert(objValue)
			if (objValue!=""){
				var imageExt=["jpeg","jpg","png","gif","JPG"];
				var extension = objValue.substr( (objValue.lastIndexOf('.') +1) );
				for(i=0;i<imageExt.length; i++){
					if(extension==imageExt[i]){
						isvalidate=true; break;
					}
					else{
						isvalidate=false;	
					}
				}
			}
           
            
			break;
            
		case "email":
			var atpos=objValue.indexOf("@");
			var dotpos=objValue.lastIndexOf(".");
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=objValue.length){
				isvalidate=false;
			}
			else{ 
                isvalidate=true;
            }
			break;
            
		case "website":        
            var url1 = /^(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
            var url2 = /^(www.|wap.)(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/                
            if (url1.test(objValue)){
                //alert ('website true');
                isvalidate = true;
            }
            else if (url2.test(objValue)){
                isvalidate = true;
            }
            else{
                isvalidate = false;
            }
            break;
            
		case "number":
			
			break;
		default:
			
			break;	
            
        	
	}
	if (isvalidate==false){
		$("#bubble_"+object).hide("slow");
		$("#errorbubble_"+object).show("slow");
        
	}
	else if(isvalidate==true){
		$("#bubble_"+object).show("slow");
		$("#errorbubble_"+object).hide("slow");
        $('#errorwarn').text("");
        
	}
   
   return isvalidate;
    
    
}

function validateform(formname){
    var isvalidate1=false;
    var formvalidate=true;
    
    
    $("#"+formname+" :input").map(function(){   

        if($(this).attr('onblur')){  
             var allOnblur = ($(this).attr('onblur'));
             
             var splitOnblur = allOnblur.split(',');
             var finaltext = splitOnblur[1].replace("');","");
             var validation = finaltext.replace("'","");
             var validation = $.trim(validation)
             var object = $(this).attr('id');
             
             var connected = $("#connected").val();
             var view_more_link = $("#view_more_link").val();
                       
             isvalidate1 = validate(object, validation);
             
             if(connected=="yes" && object=="row_name" && view_more_link!="" ){
                isvalidate1 = true;
             }
             
             
             if($("#submit_button").val() == "Edit" && $("#hidden_value").val()=="file_exists" && $(this).attr("type")=="file" && $(this).val() == ""){
                isvalidate1 = true;   
             }
             
             if(isvalidate1==false && formvalidate==true){
                formvalidate=false;
             }
        }       
    });

    return formvalidate;    
}
