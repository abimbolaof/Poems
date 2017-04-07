<?php require 'templates/header.php'; ?>
<div id="maincontent">
<div class="poem-back-image">
	<div style="background-color: rgba(0, 0, 0, 0.7);">
		<div id="div-poetry-h4">
		<h4 id="poetry-h4">Welcome to my poem collection!</h4>
		</div>		
	</div>
	<input id="url-val" type="hidden" value="search.php"/>
    
    <!-- field to store search id if a specific poem needs to be loaded directly by specifying the id in url-->
    <label id="url-val-id" hidden><?php if (isset($_GET['id'])){ echo $_GET['id']; } ?></label>
    
    <!--page marker tag -->
	<input id="url-go" type="hidden" value="go"/>
</div>
    
<div class="section-cover">
<div class="audio-list-div">
</div>

<div class="audio-play-div disappear">
		<div>
				<h4 id="audio-title"></h4>
				<table id="info-table">
				<tr><td>Created by:</td><td><em id="audio-author" style="color:darkgoldenrod;"></em></td></tr>
				<tr><td>Created on:</td><td><em id="audio-date" style="color:darkgoldenrod;"></em></td></tr>
				</table>
				<div>
                    <p id="item-transcript-p"></p>
				</div>
                <button id="audio-back-button">Back</button>
				<br/>
		</div>
</div>
    <div id="item-controls">
        <div>
            <button id="previous-button">prev</button>
            <button id="next-button">next</button><br/>
            <div id="fetch-status-label" style="height:1.5em;color:darkgoldenrod;font-size:small;"></div>
        </div>
    </div>
</div> 
</div>
<!--END OF HOME PAGE MAIN CONTENT-->
<script>

$(document).ready(function(){
	var url = $('#url-val').val();
	var go = $('#url-go').val();
    var sData = {
        start : 0,
        end : 4,
        total : 0
    };
    var itemCount = 0;
    var directId = parseInt($("#url-val-id").html());
	
	if (go == 'go'){
        
        //check if direct link to poem is provided
        if (directId){
            loadPoem(directId);
        }
		else{//else display all poems
            loadAllItems();
        }
	}
    $("#next-button").click(function(){
        sData.start = itemCount;
        loadAllItems();
    });
    
    $("#previous-button").click(function(){
        
        sData.total -= itemCount;
        
        if (sData.total <= sData.end)
            sData.start = 0;
        else
            sData.start = sData.total - sData.end - 1;
        loadAllItems();
        
    });
    
    function loadAllItems(){
        
        $.getJSON(url, sData ,function(data){
            if (data){
                if (!data.ifa_error){
                    itemCount = 0;
                    var tableData = "<ul>";
                    $.each(data, function(i, item){
                        tableData += "<li id=\"" + item.id + "\" class=\"list-item\"><table><tr><td>Title:</td><td><em>" +
                                    item.title + "</em></td>" +	"</tr><tr><td>Author:</td><td><em>"+ item.author + 
                                    "</em></td></tr>" +	"</table></li>";
                        itemCount++;
                    });
                    
                    if (itemCount > 0){//if items were loaded
                        sData.total += itemCount;
                        tableData += "</ul>";
                        $(".audio-list-div").html(tableData);
                        $(".list-item").click(function(){
                            var id = $(this).attr("id");
                            loadPoem(id);
                        });
                    }
                }else if (data.ifa_error == "empty"){
                    $("#fetch-status-label").html("No more items.");
                    setTimeout(function(){
                        $("#fetch-status-label").html("");
                    }, 3000);
                }
            }else{
                $("#fetch-status-label").html("Could not load poems at this time.");
            }
        });
    }
    
    function loadPoem(id){
        var s = {
            id : id
        };
        $.getJSON("search.php", s, function(data){
            if (data){
                var d = data[0];
                $(".audio-list-div").toggleClass("disappear");
                $("#item-controls div").toggleClass("disappear");
                $(".audio-play-div").toggleClass("disappear");
                $("#audio-title").html(d.title);
                $("#audio-author").html(d.author);
                $("#audio-date").html(d.creation_date);
                $("#item-transcript-p").html(d.transcript);
                $("#item-transcript-p").css("white-space", "pre-wrap");
            }
        });
    }
    
      
    $("#audio-back-button").click(function(){
        $(".audio-list-div").toggleClass("disappear");
        $(".audio-play-div").toggleClass("disappear");
        $("#item-controls div").toggleClass("disappear");
        //$("html, body").scrollTop(0);
        $("html, body").animate({
            scrollTop : 0
        }, 300);
        
        if (directId){
            loadAllItems();
            directId = null;
        }  
    });
  
	
});


</script>

<?php require 'templates/footer.php'; ?>