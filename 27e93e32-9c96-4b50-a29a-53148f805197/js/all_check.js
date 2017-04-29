$(document).ready(function(){
	// below code is used to remove all check property if,
    // user select/unselect options with class first options.    
	$(".first").click(function(){
		$("#checkAll").attr("data-type","uncheck");		
	});
	
	// below code is used to remove all check property if,
    // user select/unselect options with name=option2 options.  
	$("input[name=option2]").click(function(){
		$("#selectall").prop("checked", false);		
	});
	  
	/////////////////////////////////////////////////////////////   
	//       js for Check/Uncheck all CheckBoxes by Button     // 
	/////////////////////////////////////////////////////////////
	  
	$("#checkAll").attr("data-type","check");
	$("#checkAll").click(function(){
		if($("#checkAll").attr("data-type")==="check")
          {
            $(".first").prop("checked",true); 
			$("#checkAll").attr("data-type","uncheck");						   
          }
        else
          {
            $(".first").prop("checked",false);
		    $("#checkAll").attr("data-type","check");	
          }
	}) 
			
	/////////////////////////////////////////////////////////////   
	//     js for Check/Uncheck all CheckBoxes by Checkbox     // 
	/////////////////////////////////////////////////////////////	
				
	$("#selectall").click(function(){
		$(".second").prop("checked",$("#selectall").prop("checked"))
	}) 
				
});