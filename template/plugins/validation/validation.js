$().ready(function() { 
    // validate signup form on keyup and submit
    $("#frmAccident").validate({
		errorElement: 'div',
		errorClass:'form_error',
        rules: {
            f_name :{
				required : true,
			},
            l_name :{
				required : true,
			},
            email:{
              required:true,
              email:true,  
            },
			country:
			{
				required:true,
			},
			city:
			{
				required:true,
			},
			country_code : 
			{
				required:true,
			},
            mobile:{
              required:true,
              number:true, 
			  length : 10,
            },
			password : 
             {
                 required:true,
             },
           
             password2: {
                
             equalTo: "#password1"
            
             },
             
            skill :
			{
				required:true,
			},
			industry :
			{
				required : true,
			},
			news_letter :
			{
				required : true,
			},
            
            
        },
          
        errorPlacement: function(){
            return false;
        },
        messages: {
            f_name:
			{
				required : "Please enter your first name.",
			},
			l_name:
			{
				required : "Please enter your last name.",
			},
			email:{
              required:"Please enter your email.",
              email:"Please enter a valid email.",  
            },
			country:
			{
				required:"Please select your country.",
			},
			city:
			{
				required: "Please enter your city.",
			},
			country_code : 
			{
				required:"Please enter your country code.",
			},
            mobile:{
              required:"Please enter your mobile number.",
              number:"Enter number only.", 
			  length : "Mobile number must be 10 digits.",
            },
           
            skill :
			{
				required:"Please select your career skill.",
			},
			industry :
			{
				required : "Please select industry.",
			},
			news_letter :
			{
				required : "Please tick on confirmation box.",
			},
            
        }
    });

     

     
});
 