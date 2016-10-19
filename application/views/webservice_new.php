<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/dashboard/js/jquery-1.11.0.min.js"></script>
<style type="text/css">
.footer {
    position: fixed;
    color: #777;
    text-align: center;
    border-top: 1px solid #eee;
    bottom: 0px;
    left: 0px;
    width: 100%;
}


/*.back_image {
    background-image: url(http://www.activate-enterprise.co.uk/wp-content/uploads/2015/02/Hands-Together-Team-Work.jpg);
    background-repeat: repeat-x;
    width: 100%;
    height: 150px;
    background-size: 100%;
}*/
</style>

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<head>
<title>Webservice- Team Eldho</title>
 
</head>

<body class="back_image">

<div class="container" >

<div class="col-lg-12 ">
<h1><center>Webservice</center></h1>

</div>



<div class="col-lg-12"><label>Enter Your JSON</label>



<textarea   class="form-control col-lg-12"  rows="3" id="json"  name="json" placeholder="Paste json here"></textarea>
<div  class="col-lg-12"> 

<div class="row input-group" style="margin-top:10px;"> <span class="input-group-addon">Controller</span>
<input class="form-control" id="controller" name="controller" readonly="readonly"  placeholder="Controller"  value="api" />
 </div>



<button  style="margin-top:10px; float:left;" class="btn btn-primary pull-right col-lg-3" type="button" onclick="submit_json()">Run</button>









</div>

</div>

<div class="col-lg-3" >


 


<div class="clearfix"></div>
 
 
 <label>Json Method</label>
 
 
 <div class="list-group" style="overflow:scroll; max-height:400px;">
     <?php foreach($sample_jsons as $sample_json) {
			
			
		  	if($category==''||$category!= $sample_json['category']){
		 $category  =     $sample_json['category']; 
			?>
  
  <a href="#" class="list-group-item active">
   <?php echo $category;?>
  </a>
  
  
    <?php } ?>
    
     <a    onclick="loadJson(<?php echo $sample_json['id'];?>)"  href="javascript:void(0)" class="list-group-item ">
   <?php echo $sample_json['name'];?>
  </a>
  
  
  
     <?php } ?>
    
    

</div>
 
 
 
 
 
 <label>POST Method</label>
 
 
 <div class="list-group" style="overflow:scroll; max-height:300px;">
     <?php foreach($sample_post as $value) {
			
			
		  	if($category==''||$category!= $value['category']){
		 $category  =     $value['category']; 
			?>
  
  <a href="#" class="list-group-item active">
   <?php echo $category;?>
  </a>
  
  
    <?php } ?>
    
     <a    onclick="loadPost(<?php echo $value['id'];?>)"  href="javascript:void(0)" class="list-group-item ">
   <?php echo $value['name'];?>
  </a>
  
  
  
     <?php } ?>
    
    

</div>
 
 
 
 
  


</div>
<div class="col-lg-9">


<div id="josn_pass_div" style="display:none;">

 <label>Input string passed</label>
 
 <textarea  class="form-control"  id="divjson2" rows="10"></textarea>
 
 
<div class="col-lg-12"  id="divjson">
 &nbsp;&nbsp;
</div>
</div>



<div id="post_pass_div" style="display: none;">
	
    <div class="col-lg-3"	><label>Post Function Name</label> </div>    <div class="col-lg-9"	>:  <span id="funtion_name"></span></div>
      
      <div class="clearfix"></div>  
	<div class="col-lg-3"	><label>Parameters</label></div><div class="col-lg-9"	>: <span  id="paramts"> </span></div>


</div>




<div class="col-lg-12" id="description_div" style="display:none;">
<div class="panel panel-default" style="margin-top:10px;">
  <div class="panel-heading">Description</div>


   <div class="panel-body">
 

<div class="col-lg-12"  id="description">
 &nbsp;&nbsp;
</div>


</div>

</div>

</div>




<div  style=" display:none;" id="jsn_result" >


<label>JSon string result</label>
<textarea class="form-control"  rows="15" id="divResult2"></textarea>

 <br />

 <div class="alert alert-success"   id="divResult" >
 
 &nbsp;&nbsp;
</div>


</div>





 


</div>



</div><br />
<br />
<br />
<br />





<footer class="footer navbar-inverse hidden-print" style="    z-index: 1000;">
  <div class="container text-center">
    <div style="color:#FFFFFF;">Webservice 2.0 Created and Maintained by <a style="color:#CCCCCC;" href="http://www.newagesmb.com" target="_blank">NewAgeSMB Inc.-Team Eldho</a>  <span style="color:#FFF;"> <br>
 <i class="icon-envelope">&nbsp;Mail us : </i> <a href="mailto:team_eldho@newagesmb.com" style="color:#FFF;"> 	team_eldho@newagesmb.com</a> </span> </div>
  </div>
</footer>
 
</body>
 <script type="text/javascript">

function submit_json()
{
	
	var jsonStr =   $("#json").val();
	var controller =   $("#controller").val();
	
	if(controller!=''){
	
	
	
	if(jsonStr!=''){
	
	 $("#divResult").text("loading...");
		 
              //jsonStr = "{id:'169013', page:'3', leagueids:''}";
              //jsonStr = "{'id': '534151','leagueids': '843,31','page': '1'}";
              jsonMethod = "<?php echo base_url()?>"+controller;   
			   $("#divjson").html(jsonMethod+"=>"+jsonStr);
			  
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callJsonMethod(jsonMethod, jsonStr, "#divResult");
       
	}else{
		
	alert('Paste valide JSON');
	
	}
	
	
	}else{
		
	alert('Enter controller name');
	
	}
	
}


function loadJson(id)
{
	
	 $("#post_pass_div").hide();
          
              $("#divResult").text("loading...");
			  
			  
			    <?php foreach($sample_jsons as $sample_json) { ?>
			  
				if(id==<?php echo $sample_json['id'];?>)
				{
				var 	jsonStr = '<?php echo $sample_json['json'];?>';
				var 	controller = '<?php echo $sample_json['controller'];?>';
				var 	description = '<?php echo $sample_json['desc'];?>';
				}
			  
			  <?php } ?>
			  
			  
			var newsonStr =  formatJson(jsonStr);
			
			
			  
			    $("#divjson").html(newsonStr);
				
				if(description!='')
				{
				 $("#description").html(description);
				 $("#description_div").show('slow');
				}else{
					 $("#description_div").hide();
				}
				
              //jsonStr = "{id:'169013', page:'3', leagueids:''}";
              //jsonStr = "{'id': '534151','leagueids': '843,31','page': '1'}";
              jsonMethod = "<?php echo base_url()?>"+controller;
			  
			      $("#divjson2").val(newsonStr);
				  
				  
				  
				  $("#josn_pass_div").show('slow');
				  
				  
			  
			    $("#divjson").html(jsonMethod);
			  
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callJsonMethod(jsonMethod, jsonStr, "#divResult");
		   
		  
}




function loadPost(id)
{
	 
	   $("#josn_pass_div").hide('slow');
	   $("#jsn_result").hide('slow');
	 
	  <?php foreach($sample_post as $value) { ?>
			  
				if(id==<?php echo $value['id'];?>)
				{
				var 	jsonStr = '<?php echo $value['json'];?>';
				var 	controller = '<?php echo $value['controller'];?>';
				}
			  
			  <?php } ?>
			  
			  jsonMethod = "<?php echo base_url()?>"+controller; 
			  
			  
			  $("#funtion_name").html(controller);
			   $("#paramts").html(jsonStr);
			  $("#post_pass_div").show();
			 
	// $("#divjson").html(jsonMethod+"=>"+jsonStr);
	//  $("#divResult").html('');
}


 </script>
<script type="text/javascript">
	  function callJsonMethod(jsonMethod, jsonStr, divResult) {

			$.ajax({
				type: "POST",
				url: jsonMethod,
				data: jsonStr,
				success: function (msg) {
				 //alert(msg)
				 
				 	var newsonStr =  formatJson(msg);
					$("#divResult2").val(newsonStr);
					
					$("#jsn_result").show('slow');
					
					$(divResult).text("Sucess");
				},
				error: function (msg) {
				//alert($.parseJSON(msg))
					$(divResult).text(msg);
					$("#jsn_result").hide();
					$(divResult).text("Error");
				}
			});
	}
      </script>
      
      
             
<script>
 function formatJson(json) {
        var i           = 0,
            il          = 0,
            tab         = "    ",
            newJson     = "",
            indentLevel = 0,
            inString    = false,
            currentChar = null;

        for (i = 0, il = json.length; i < il; i += 1) { 
            currentChar = json.charAt(i);

            switch (currentChar) {
            case '{': 
            case '[': 
                if (!inString) { 
                    newJson += currentChar + "\n" + repeat(tab, indentLevel + 1);
                    indentLevel += 1; 
                } else { 
                    newJson += currentChar; 
                }
                break; 
            case '}': 
            case ']': 
                if (!inString) { 
                    indentLevel -= 1; 
                    newJson += "\n" + repeat(tab, indentLevel) + currentChar; 
                } else { 
                    newJson += currentChar; 
                } 
                break; 
            case ',': 
                if (!inString) { 
                    newJson += ",\n" + repeat(tab, indentLevel); 
                } else { 
                    newJson += currentChar; 
                } 
                break; 
            case ':': 
                if (!inString) { 
                    newJson += ": "; 
                } else { 
                    newJson += currentChar; 
                } 
                break; 
            case ' ':
            case "\n":
            case "\t":
                if (inString) {
                    newJson += currentChar;
                }
                break;
            case '"': 
                if (i > 0 && json.charAt(i - 1) !== '\\') {
                    inString = !inString; 
                }
                newJson += currentChar; 
                break;
            default: 
                newJson += currentChar; 
                break;                    
            } 
        } 

        return newJson; 
    }

   function repeat(s, count) {
        return new Array(count + 1).join(s);
    }

</script>
</html>
