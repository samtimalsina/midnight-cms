<?php include("functions.php");?>
<div class="span-18 last hide" id="functions">
	<p>
    	<a href="#">adasd</a>
    </p>
</div>
<div class="span-18 last">
	<div class="span-18 last" id="folder_navigation">
    	<a href="javascript:void(0);" onclick="navigate('<?php echo "/".LOCAL_FOLDER."/";?>');" style="display: ;" id="home">Home</a>
        <a href="javascript:void(0);" onclick="navigate('back');" style="display: none;" id="back">Back</a>
        <a href="javascript:void(0);" onclick="navigate('forward');" style="display: none;" id="forward">Forward</a>
        <span id="currentPage"></span>
    </div>
	<div class="span-4" id="folder_view">
    	<ul>
    	<?php
		$dir=scanDirOnly("/".LOCAL_FOLDER."/");
		for ($i=0; $i<count($dir); $i++){?>
        	<li><a href="javascript:void(0);" onClick="navigate('<?php echo "/".LOCAL_FOLDER."/".$dir[$i]."/";?>')"><?php echo $dir[$i];?></a></li>
        <?php } ?>
    </div>
    <div class="span-14 last" id="files_view">
    </div>
</div>

<script language="javascript">
	var pageCrumb=new Array();
    var backPageCrum=new Array();
    var frontPageCrum=new Array();
	var currentPage=-1;
    var arrayCheck=-1;
	function getFileNames(dir){
		$.ajax({
			type: "POST",
			url: "<?php echo BASE_URL."website_specifics/File-Management/functions.php"; ?>",
			dataType: "json",
			data: "dir="+dir,
			success: function(json){
				fileNames=eval(json);
				$('#files_view').html('');
				$.each(fileNames.files, function() {					
					$('#files_view').append("<a class='file_file' href='javascript:void(0);' onClick=navigate('"+this.PATH+"');><img src='<?php echo BASE_URL."website_specifics/File-Management/Images/Icons/"; ?>"+this.type+".png'/><span class='file_name'>"+this.filename+"</span><span class='file_extension'>"+this.extension+"</span></a>");					
				});
				//console.log("getFileName: "+currentPage);
			}
		});	
	}
	
	function navigate(page){
		switch(page){
			case "back":
				currentPage--;
                $("#currentPage").html("");
                for(var i=0; i<pageCrumb.length; i++){
                   // $("#currentPage").append(pageCrumb[i]+",")
                }
                //$("#currentPage").append("CurrentPage: "+currentPage);
				//console.log('Back: '+currentPage);
				getFileNames(pageCrumb[currentPage]);	
                backPageCrum.pop();
                if(currentPage == 0){
                    $("#back").hide();
                    $("#forward").show();
                }
                else if(currentPage > 0){
                    $("#forward").show();
                }
				break;
			case "forward":
				currentPage++;
                $("#currentPage").html("");
                for(var i=0; i<pageCrumb.length; i++){
                    //$("#currentPage").append(pageCrumb[i]+",")
                }
                //$("#currentPage").append("CurrentPage: "+currentPage);
				console.log('Previous: '+currentPage);
				getFileNames(pageCrumb[currentPage]);
                if((currentPage+1) == pageCrumb.length){
                    $("#forward").hide();
                    $("#back").show();
                }
                else if(currentPage==2 && pageCrumb.length>currentPage){
                    $("#forward").hide();
                }
                else{
                    $("#back").show();
                }
				break;
			default:
				getFileNames(page);
                arrayCheck = $.inArray(page, pageCrumb)
                if(arrayCheck == -1){
                    while( currentPage+1 != pageCrumb.length){
                        pageCrumb.pop();    
                    }                    
                    pageCrumb.push(page);
                    currentPage= (pageCrumb.length-1);
                }
                else{
                    while( arrayCheck+1 != pageCrumb.length){
                        pageCrumb.pop();
                         
                    }
                    currentPage = (arrayCheck);
                }
				//$("#currentPage").html("");
                for(var i=0; i<pageCrumb.length; i++){
                    //$("#currentPage").append(pageCrumb[i]+",")
                }
				//$("#currentPage").append("CurrentPage: "+currentPage);
                if(pageCrumb.length > 1){
                    $("#back").show();
                }
                else{
                    $("#back").hide();
                }
                
                if(pageCrumb.length > (currentPage)){
                    $("#forward").hide();
                }
                
                if(page == "home"){
                    $("#forward").hide();
                    $("#back").hide();
                }
                
				break;
		}
	}
    
	$(document).ready(function() {
		//currentPage=0;
    	navigate("<?php echo "/".LOCAL_FOLDER."/";?>");		
    });


</script>