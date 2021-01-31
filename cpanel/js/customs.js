    // Wait for the DOM to be ready
const BASE_URL = "http://hospitalmanagement.com/";
    
$(function() {
  $("#login").validate({
    rules: {
      email: {
        required: true,
        email: true
      },
      clear_password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      clear_password: {
        required: "<span style='color:red;'>Please enter password</span>",
        minlength: "<span style='color:red;'>Your password must be at least 5 characters long</span>"
      },
      email: "<span style='color:red;'>Please enter a valid email address</span>"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form,e) {
        e.preventDefault();
            $.ajax({
                type: 'POST',
                url: BASE_URL+'admin_panel/sign_in',
                dataType: "json",
                data: $('#login').serialize(),
                success: function(result) {
                    if(result['message'] =='Login succss'){
                       $("#login_message").html(result['message']).css('color','green'); 
                       window.location.href = BASE_URL+"dashboard";
                    }else{
                       $("#login_message").html(result['message']).css('color','red'); 
                    }
                    
                }
            });
            return false;
      form.submit();
    }
    
    
  });
  
  
 $("#add_opd_patient").validate({  
    rules: {
      opd_number_id: {  
        required: true
      },
      patient_name: {
        required: true
      },
      contact_number: {
        required: true,
        digits: true,
        maxlength: 10
      },
      date: {
        required: true
      },
      valid_date: {
        required: true
      },
      shift: {
        required: true,
      },
      department: {
        required: true
      },
      guardian_name: {
        required: true
      },
      doctor_id: {
        required: true
      },
      address: {
        required: true,
        maxlength: 150
      }
    },
    messages: {
      opd_number_id: "<span style='color:red;'> Enter OPD Number Id.</span>",
      patient_name: "<span style='color:red;'> Enter Patient Name.</span>",
      contact_number: "<span style='color:red;'>Enter Contact Number.</span>",
      date: "<span style='color:red;'>Select Date.</span>",
      valid_date: "<span style='color:red;'>Select Valid Date.</span>",
      shift: "<span style='color:red;'>Enter shift.</span>",
      department: "<span style='color:red;'> Enter Department.</span>",
      guardian_name: "<span style='color:red;'>Enter Guardian Name.</span>",
      doctor_id: "<span style='color:red;'>Select Doctor Name.</span>",
      address: "<span style='color:red;'>Enter Address.</span>"
    }
  });
  
  
  
  
  
  
  $("#edit_opd_patient").validate({  
    rules: {
      opd_number_id: {  
        required: true
      },
      patient_name: {
        required: true
      },
      contact_number: {
        required: true,
        digits: true,
        maxlength: 10
      },
      date: {
        required: true
      },
      valid_date: {
        required: true
      },
      shift: {
        required: true,
      },
      department: {
        required: true
      },
      guardian_name: {
        required: true
      },
      doctor_id: {
        required: true
      },
      address: {
        required: true,
        maxlength: 150
      }
    },
    messages: {
      opd_number_id: "<span style='color:red;'> Enter OPD Number Id.</span>",
      patient_name: "<span style='color:red;'> Enter Patient Name.</span>",
      contact_number: "<span style='color:red;'>Enter Contact Number.</span>",
      date: "<span style='color:red;'>Select Date.</span>",
      valid_date: "<span style='color:red;'>Select Valid Date.</span>",
      shift: "<span style='color:red;'>Enter shift.</span>",
      department: "<span style='color:red;'>Enter Department.</span>",
      guardian_name: "<span style='color:red;'>Enter Guardian Name.</span>",
      doctor_id: "<span style='color:red;'>Select Doctor Name.</span>",
      address: "<span style='color:red;'>Enter Address.</span>"
    }
  });
  
  
  
  $("#surgery_patient_form_id").validate({  
    rules: {
      surgery_patient_name: {
        required: true
      },
      surgery_type: {
        required: true,
      },
      doctor_id:{
          required:true,
      },
      surgery_date: {
        required: true
      },
      surgery_amount: {
        required: true
      },
      discount_amount: {
        required: true,
      },
      advance_amount: {
        required: true
      },
      pending_amount: {
        required: true
      },
      advance_taken: {
        required: true
      },
      parent_risk_bound: {
        required: true,
      },
      patient_risk_bound:{
        required: true,  
      }
    },
    messages: {
      surgery_patient_name: "<span style='color:red;'> Enter Patient Name.</span>",
      surgery_type: "<span style='color:red;'>Select Surgery Type.</span>",
      doctor_id:"<span style='color:red;'>Select Doctor Name.</span>",
      surgery_date: "<span style='color:red;'>Select Surgery Date.</span>",
      surgery_amount: "<span style='color:red;'>Enter Surgery Amount.</span>",
      discount_amount: "<span style='color:red;'>Enter Discount Amount.</span>",
      advance_amount: "<span style='color:red;'>Enter Advance Amount.</span>",
      pending_amount: "<span style='color:red;'>Enter Pending Amount.</span>",
      advance_taken: "<span style='color:red;'>Enter Advance Amount.</span>",
      parent_risk_bound: "<span style='color:red;'>Choose Parent Risk Bound.</span>",
      patient_risk_bound: "<span style='color:red;'>Choose Parent Risk Bound.</span>"
    }
  });
  
   
  
  $("#create_new_login").validate({
    rules: {
      user_name: {
        required: true,
      },
      user_email: {
        required: true,
        email: true
      },
     user_phone: {
        required: true,
      },
      user_type: {
        required: true,
      },
      password: {
        required: true,
        minlength: 5   
      },
      confirm_password: {
        required: true,
        minlength: 5,
        equalTo : "#password"
      },
     
    },
    // Specify validation error messages
    messages: {
      user_email: "<span style='color:red;'>Enter email.</span>",
      password: {
         required:"<span style='color:red;'>Enter password.</span>",
         minlength:"<span style='color:red;'>Password min 5 digit.</span>",
      },
      confirm_password:{ 
          required:"<span style='color:red;'>Confirm password.</span>",
          minlength:"<span style='color:red;'>Confirm Pass min 5 digit.</span>",
          equalTo:"<span style='color:red;'>Password & Confirm mismatched.</span>",
      },
      user_phone: "<span style='color:red;'>Enter phone No.</span>",
      user_name: "<span style='color:red;'>Enter Name.</span>",
      user_type: "<span style='color:red;'>Select permission.</span>"
    }
  });
   
 
   
});

/* 
 * @Individual Escorts Profile
 */

$(function() {
    $("#about_me").submit(function(e) {
        var user_name = $("#user_name").val();
        if(user_name == ''){
           $("#user_name").css({'border': '2px solid red'}); 
        }else{
          $("#user_name").css({'border': '2px solid #ccc'});   
        }
        
        var dob = $("#dob").val();
        if(dob == ''){
           $("#dob").css({'border': '2px solid red'}); 
        }else{
          $("#dob").css({'border': '2px solid #ccc'});     
        }
        
        var mobile_no = $("#mobile_no").val();
        if(mobile_no == ''){
           $("#mobile_no").css({'border': '2px solid red'}); 
        }else{
          $("#mobile_no").css({'border': '2px solid #ccc'});     
        }
        
        var escort_type_id = $("#escort_type_id").val();
        if(escort_type_id == ''){
           $("#escort_type_id").css({'border': '2px solid red'}); 
        }else{
          $("#escort_type_id").css({'border': '2px solid #ccc'});     
        }
        
               
        var about_information = $("#about_information").val();
        if(about_information == ''){
           $("#about_information").css({'border': '2px solid red'}); 
        }else{
          $("#about_information").css({'border': '2px solid #ccc'});     
        }
        
        
        if( about_information == '' || user_name == '' || dob == '' || mobile_no == ''){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/update_about_details',
                dataType: "json",
                data: $('#about_me').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                       $("#about_error").html(result['message']).css({'color':'green'});
                       $("#about_me").trigger("reset");
                    }
                    
                }
            });

    });
    

   $("#profile_figure_details").submit(function(e) {
       
        var height = $("#height").val();
        if(height == ''){
           $("#height").css({'border': '2px solid red'}); 
        }else{
          $("#height").css({'border': '2px solid #ccc'});   
        }
        
        var eye_color = $("#eye_color").val();
        if(eye_color == ''){
           $("#eye_color").css({'border': '2px solid red'}); 
        }else{
          $("#eye_color").css({'border': '2px solid #ccc'});     
        }
        
        var skin_color = $("#skin_color").val();
        if(skin_color == ''){
           $("#skin_color").css({'border': '2px solid red'}); 
        }else{
          $("#skin_color").css({'border': '2px solid #ccc'});     
        }
                       
        var hair_color = $("#hair_color").val();
        if(hair_color == ''){
           $("#hair_color").css({'border': '2px solid red'}); 
        }else{
          $("#hair_color").css({'border': '2px solid #ccc'});     
        }
        
         var bust = $("#bust").val();
        if(bust == ''){
           $("#bust").css({'border': '2px solid red'}); 
        }else{
          $("#bust").css({'border': '2px solid #ccc'});     
        }
              
        var weight = $("#weight").val();
        if(weight == ''){
           $("#weight").css({'border': '2px solid red'}); 
        }else{
          $("#weight").css({'border': '2px solid #ccc'});     
        }
        
        var waist = $("#waist").val();
        if(waist == ''){
           $("#waist").css({'border': '2px solid red'}); 
        }else{
          $("#waist").css({'border': '2px solid #ccc'});     
        }
        
        var hips = $("#hips").val();
        if(hips == ''){
           $("#hips").css({'border': '2px solid red'}); 
        }else{
          $("#hips").css({'border': '2px solid #ccc'});     
        }
        
        var smoker = $("#smoker").val();
        if(smoker == ''){
           $("#smoker").css({'border': '2px solid red'}); 
        }else{
          $("#smoker").css({'border': '2px solid #ccc'});     
        }
        
        var drink = $("#drink").val();
        if(drink == ''){
           $("#drink").css({'border': '2px solid red'}); 
        }else{
          $("#drink").css({'border': '2px solid #ccc'});     
        }
        
        var occupation = $("#occupation").val();
        if(occupation == ''){
           $("#occupation").css({'border': '2px solid red'}); 
        }else{
          $("#occupation").css({'border': '2px solid #ccc'});     
        }
        
        var hobbies = $("#hobbies").val();
        if(hobbies == ''){
           $("#hobbies").css({'border': '2px solid red'}); 
        }else{
          $("#hobbies").css({'border': '2px solid #ccc'});     
        }
        
        if( height == '' || eye_color == '' || skin_color == '' || hair_color == '' || weight == '' || waist == '' || hips == '' ||  drink == '' || occupation == '' || hobbies == ''){
            return false; 
        }
      
        e.preventDefault();
            
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/profile_figure_details',
                secureuri:false,
                dataType: "json",
                data: $('#profile_figure_details').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                       $("#figure_error").html(result['message']).css({'color':'green'});
                    }else{
                       $("#figure_error").html(result['message']).css('color','red'); 
                    }
                    
                }
            });
         

    });
    
   $("#profile_image").on("click",function(){
       $("#upload_image_button").removeAttr("disabled");
   }); 
    
   $('#upload_images').submit(function(e){
       var images = $("#profile_image").val();
       if(images == ''){
           $("#dropzone_wrapper").removeClass("dropzone-wrapper");
           $("#dropzone_wrapper").addClass("dropzone-wrapper-error");
           return false;
       }else{
          $("#dropzone_wrapper").addClass("dropzone-wrapper");  
       }
       
    e.preventDefault(); 
         $.ajax({
             url:BASE_URL+'usersprofile/users_profile/upload_user_images',
             type:"post",
             data:new FormData(this),
             processData:false,
             contentType:false,
             dataType: "json",
             cache:false,
             async:false,
              success: function(data){
                  setTimeout(function(){ $("#loader_id").css("display", "none"); }, 1000);
                  if(data['message'] == 'Image uploaded fail'){
                    $("#upload_error").html(data['message']).css('color','red'); 
                  }else{
                    var html = '';
                    for(var i = 0; i < data['lists'].length; i++){
                        html += '<div class="custom-container" style="display: inline-block;">';
                        html += '<span aria-hidden="true" onclick="remove_image_list('+data['lists'][i]['id']+')">&times;</span>';
                        html += '<img style="width: 100px; height: 100px;" src="'+BASE_URL+'images/escorts-image/'+data['lists'][i]['original_image']+'">';
                        html += '</div>';
                    }
                    $("#agency_image_list_id").html(html);
                    $("#upload_error").html(data['message']).css('color','green');  
                    $("#upload_image_button").attr("disabled","disabled");
                  }
           }
         });
    });
    
     $("#language_details").submit(function(e) {
       var checkCount = $("input[name='language[]']:checked").length;
       if(checkCount < 1){
           $("#language_error").html("Please check at least one language.").css('color','red');
            return false;
       }else{
          $("#language_error").html(""); 
       }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/update_language_details',
                dataType: "json",
                data: $('#language_details').serialize(),
                success: function(result) {
                    if(result['message'] == 'Image uploaded fail'){
                       $("#language_error").html(result['message']).css({'color':'red'});
                       $("#language_details").trigger("reset");
                    }else{
                        $("#language_error").html(result['message']).css({'color':'green'});
                    }
                    
                }
            });

    });
    
    
     
    $("#escort_service_area").submit(function(e) {
        var country_id = $("#country_id").val();
        if(country_id == ''){
           $("#country_id").css({'border': '2px solid red'}); 
        }else{
          $("#country_id").css({'border': '2px solid #ccc'});   
        }
        
        var city_id = $("#city_id").val();
        if(city_id == ''){
           $("#city_id").css({'border': '2px solid red'}); 
        }else{
          $("#city_id").css({'border': '2px solid #ccc'});     
        }
        
        var pincode_id = $("#pincode_id").val();
        if(pincode_id == ''){
           $("#pincode_id").css({'border': '2px solid red'}); 
        }else{
          $("#pincode_id").css({'border': '2px solid #ccc'});     
        }
        
               
        var address = $("#address").val();
        if(address == ''){
           $("#address").css({'border': '2px solid red'}); 
        }else{
          $("#address").css({'border': '2px solid #ccc'});     
        }
        
        
        if( address == '' || country_id == '' || city_id == '' || pincode_id == ''){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/update_escort_address_details',
                dataType: "json",
                data: $('#escort_service_area').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                       $("#address_error").html(result['message']).css({'color':'green'});
                       $("#escort_service_area").trigger("reset");
                    }else{
                      $("#address_error").html(result['message']).css({'color':'red'});  
                    }
                    
                }
            });

    });
   
    
      $("#rate_list").submit(function(e) {
        
        var one_hour = $("#one_hour").val();
        if(one_hour == ''){
           $("#one_hour").css({'border': '2px solid red'}); 
        }else{
          $("#one_hour").css({'border': '2px solid #ccc'});   
        }
        
        var two_hours = $("#two_hours").val();
        if(two_hours == ''){
           $("#two_hours").css({'border': '2px solid red'}); 
        }else{
          $("#two_hours").css({'border': '2px solid #ccc'});     
        }
        
        var three_hours = $("#three_hours").val();
        if(three_hours == ''){
           $("#three_hours").css({'border': '2px solid red'}); 
        }else{
          $("#three_hours").css({'border': '2px solid #ccc'});     
        }
        
        var whole_night = $("#whole_night").val();
        if(whole_night == ''){
           $("#whole_night").css({'border': '2px solid red'}); 
        }else{
          $("#whole_night").css({'border': '2px solid #ccc'});     
        }
        
        if( one_hour == '' || two_hours == '' || three_hours == '' || whole_night == ''){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/insert_escort_rate_details',
                dataType: "json",
                data: $('#rate_list').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Failed.'){
                       $("#rate_error").html(result['message']).css({'color':'red'}); 
                    }else{
                        $("#rate_error").html(result['message']).css({'color':'green'});
                        $("#rate_list").trigger("reset");
                    }
                    
                }
            });

    });
    
    
     $("#service_area_details").submit(function(e) {
        
        var service_area_id = $("#service_area_id").val();
       
        if(service_area_id == null){
           $(".select2-selection--multiple").css({'border': '2px solid red'}); 
        }else{
          $(".select2-selection--multiple").css({'border': '2px solid #ccc'});   
        }
       
        
        if( service_area_id == null){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/insert_service_area_details',
                dataType: "json",
                data: $('#service_area_details').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                        $("#service_area_error").html(result['message']).css({'color':'green'});
                        $("#service_area_details").trigger("reset");
                    }else{
                        $("#service_area_error").html(result['message']).css({'color':'red'}); 

                    }
                    
                }
            });

    });
    
     $("#specalities_form").submit(function(e) {
        
        var specialties_id = $("#specialties_id").val();
       
        if(specialties_id == null){
           $(".select2-selection--multiple").css({'border': '2px solid red'}); 
        }else{
          $(".select2-selection--multiple").css({'border': '2px solid #ccc'});   
        }
       
        
        if( specialties_id == null){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/insert_specalities_details',
                dataType: "json",
                data: $('#specalities_form').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                        $("#specialties_error").html(result['message']).css({'color':'green'});
                        $("#specalities_form").trigger("reset");
                    }else{
                        $("#specialties_error").html(result['message']).css({'color':'red'}); 

                    }
                    
                }
            });

    });
    
    
    $("#featured_services_form").submit(function(e) {
        
        var featured_services_id = $("#featured_services_id").val();
       
        if(featured_services_id == null){
           $(".select2-selection--multiple").css({'border': '2px solid red'}); 
        }else{
          $(".select2-selection--multiple").css({'border': '2px solid #ccc'});   
        }
       
        
        if( featured_services_id == null){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/insert_featured_services_details',
                dataType: "json",
                data: $('#featured_services_form').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                        $("#featured_services_error").html(result['message']).css({'color':'green'});
                        $("#featured_services_form").trigger("reset");
                    }else{
                        $("#featured_services_error").html(result['message']).css({'color':'red'}); 

                    }
                    
                }
            });

    });
    
    
   $("#agency_about_me_form").submit(function(e) {
        var user_name = $("#owner_name").val();
        if(user_name == ''){
           $("#owner_name").css({'border': '2px solid red'}); 
        }else{
          $("#owner_name").css({'border': '2px solid #ccc'});   
        }
        
        var website_link = $("#website_link").val();
        if(website_link == ''){
           $("#website_link").css({'border': '2px solid red'}); 
        }else{
          $("#website_link").css({'border': '2px solid #ccc'});     
        }
        
        var mobile_no = $("#mobile_no").val();
        if(mobile_no == ''){
           $("#mobile_no").css({'border': '2px solid red'}); 
        }else{
          $("#mobile_no").css({'border': '2px solid #ccc'});     
        }
                               
        var about_information = $("#about_information").val();
        if(about_information == ''){
           $("#about_information").css({'border': '2px solid red'}); 
        }else{
          $("#about_information").css({'border': '2px solid #ccc'});     
        }
        
        
        if( about_information == '' || user_name == '' || mobile_no == ''){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/update_agency_about',
                dataType: "json",
                data: $('#agency_about_me_form').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                       $("#about_error").html(result['message']).css({'color':'green'});
                       $("#agency_about_me_form").trigger("reset");
                    }else{
                       $("#about_error").html(result['message']).css({'color':'red'});  
                    }
                    
                }
            });

    });
    
    
   $("#agency_logo").on("click",function(){
       $("#upload_image_button").removeAttr("disabled");
   }); 
    
   $('#upload_agency_logo_form').submit(function(e){
       var images = $("#agency_logo").val();
       if(images == ''){
           $("#agency_wrapper").removeClass("dropzone-wrapper");
           $("#agency_wrapper").addClass("dropzone-wrapper-error");
           return false;
       }else{
          $("#agency_wrapper").addClass("dropzone-wrapper");  
       }
       
    e.preventDefault(); 
         $.ajax({
             url:BASE_URL+'usersprofile/agency_profile/upload_agency_logo',
             type:"post",
             data:new FormData(this),
             processData:false,
             contentType:false,
             dataType: "json",
             cache:false,
             async:false,
              success: function(data){
                  if(data['message'] == 'Image uploaded fail'){
                    $("#upload_logo_error").html(data['message']).css('color','red'); 
                  }else{
                    $("#upload_logo_error").html(data['message']).css('color','green');  
                    $("#upload_logo_button").attr("disabled","disabled");
                  }
           }
         });
    });
    
    
    $("#agency_address").submit(function(e) {
        var country_id = $("#country_id").val();
        if(country_id == ''){
           $("#country_id").css({'border': '2px solid red'}); 
        }else{
          $("#country_id").css({'border': '2px solid #ccc'});   
        }
        
        var city_id = $("#city_id").val();
        if(city_id == ''){
           $("#city_id").css({'border': '2px solid red'}); 
        }else{
          $("#city_id").css({'border': '2px solid #ccc'});     
        }
        
        var pincode_id = $("#pincode_id").val();
        if(pincode_id == ''){
           $("#pincode_id").css({'border': '2px solid red'}); 
        }else{
          $("#pincode_id").css({'border': '2px solid #ccc'});     
        }
        
               
        var address = $("#address").val();
        if(address == ''){
           $("#address").css({'border': '2px solid red'}); 
        }else{
          $("#address").css({'border': '2px solid #ccc'});     
        }
        
        
        if( address == '' || country_id == '' || city_id == '' || pincode_id == ''){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/update_agency_address_details',
                dataType: "json",
                data: $('#agency_address').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                       $("#address_error").html(result['message']).css({'color':'green'});
                       $("#escort_service_area").trigger("reset");
                    }else{
                      $("#address_error").html(result['message']).css({'color':'red'});  
                    }
                    
                }
            });

    });
    
    
     $("#agency_service_area_form").submit(function(e) {
        
        var service_area_id = $("#service_area_id").val();
       
        if(service_area_id == null){
           $(".select2-selection--multiple").css({'border': '2px solid red'}); 
        }else{
          $(".select2-selection--multiple").css({'border': '2px solid #ccc'});   
        }
       
        
        if( service_area_id == null){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/insert_agency_service_area_details',
                dataType: "json",
                data: $('#agency_service_area_form').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                        $("#service_area_error").html(result['message']).css({'color':'green'});
                        $("#service_area_details").trigger("reset");
                    }else{
                        $("#service_area_error").html(result['message']).css({'color':'red'}); 

                    }
                    
                }
            });

    });
    
    
    $("#about_agency_me").submit(function(e) {
        var ids_string = $("#about_me_next").val();
        var ids_arr = ids_string.split("-");
        var about_me = $("#about_me_details").val();
        if(about_me != ''){
            $("#tab_"+ids_arr[0]).removeClass("active");
            $("#tab_"+ids_arr[1]).addClass("active");
            $("#left_menu_"+ids_arr[0]).removeClass("active");
            $("#left_menu_"+ids_arr[1]).addClass("active");
            return false;
        }
        
        var user_name = $("#user_name").val();
        if(user_name == ''){
           $("#user_name").css({'border': '2px solid red'}); 
        }else{
          $("#user_name").css({'border': '2px solid #ccc'});   
        }
        
        var dob = $("#dob").val();
        if(dob == ''){
           $("#dob").css({'border': '2px solid red'}); 
        }else{
          $("#dob").css({'border': '2px solid #ccc'});     
        }
        
        var mobile_no = $("#mobile_no").val();
        if(mobile_no == ''){
           $("#mobile_no").css({'border': '2px solid red'}); 
        }else{
          $("#mobile_no").css({'border': '2px solid #ccc'});     
        }
        
        var escort_type_id = $("#escort_type_id").val();
        if(escort_type_id == ''){
           $("#escort_type_id").css({'border': '2px solid red'}); 
        }else{
          $("#escort_type_id").css({'border': '2px solid #ccc'});     
        }
        
               
        var about_information = $("#about_information").val();
        if(about_information == ''){
           $("#about_information").css({'border': '2px solid red'}); 
        }else{
          $("#about_information").css({'border': '2px solid #ccc'});     
        }
        
        
        if( about_information == '' || user_name == '' || dob == '' || mobile_no == '' || escort_type_id == ''){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/update_about_agency_me_details',
                dataType: "json",
                data: $('#about_agency_me').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                        //alert(result['inserted_id']);
                       $("#about_me_details").val('1');
                       $("#left_menu_2").removeClass("not-active");
                       $("#about_error").html(result['message']).css({'color':'green'});
                       $("#about_agency_me").trigger("reset");
                    }else{
                       $("#about_error").html(result['message']).css({'color':'red'});
                    }
                    
                }
            });

    });
    
    //escort_image_details
    
   $("#profile_image").on("click",function(){
       $("#upload_image_button").removeAttr("disabled");
   }); 
    
   $('#agency_escort_upload').submit(function(e){
       
        var ids_string = $("#upload_next").val();
        var ids_arr = ids_string.split("-");
        var escort_image = $("#escort_image_details").val();
        if(escort_image != ''){
            $("#tab_"+ids_arr[0]).removeClass("active");
            $("#tab_"+ids_arr[1]).addClass("active");
            $("#left_menu_"+ids_arr[0]).removeClass("active");
            $("#left_menu_"+ids_arr[1]).addClass("active");
            return false;
        }
       
       var images = $("#profile_image").val();
       if(images == ''){
           $("#dropzone_wrapper").removeClass("dropzone-wrapper");
           $("#dropzone_wrapper").addClass("dropzone-wrapper-error");
           return false;
       }else{
          $("#dropzone_wrapper").addClass("dropzone-wrapper");  
       }
       
    e.preventDefault(); 
         $.ajax({
             url:BASE_URL+'usersprofile/agency_profile/upload_agency_escort_images',
             type:"post",
             data:new FormData(this),
             processData:false,
             contentType:false,
             dataType: "json",
             cache:false,
             async:false,
              success: function(data){
                  if(data['message'] == 'Image uploaded fail'){
                    $("#escort_image_details").val('1');
                    $("#upload_error").html(data['message']).css('color','red'); 
                  }else{
                    $("#escort_image_details").val('1');  
                    $("#left_menu_3").removeClass("not-active"); 
                    $("#agency_escort_upload").trigger("reset");
                    
                    var html = '';
                    for(var i = 0; i < data['lists'].length; i++){
                        html += '<div class="custom-container" style="display: inline-block;">';
                        html += '<span aria-hidden="true" style="color: red;margin-left: 80%;" onclick="remove_image_list('+data['lists'][i]['escort_id']+','+data['lists'][i]['id']+')">&times;</span>';
                        html += '<img src="'+BASE_URL+'images/escorts-image/'+data['lists'][i]['original_image']+'" style="width: 100px; height: 100px;">';
                        html += '</div>';
                    }
                    
                    $("#image_list_id").html(html);
                    
                    $("#upload_error").html(data['message']).css('color','green');  
                    //$("#upload_image_button").attr("disabled","disabled");
                  }
           }
         });
    });
    
    
    
    $("#agency_escort_figure_details").submit(function(e) {
                
        var ids_string = $("#figure_next").val();
        var ids_arr = ids_string.split("-");
        var escort_figure = $("#escort_figure_details").val();
        if(escort_figure != ''){
            $("#tab_"+ids_arr[0]).removeClass("active");
            $("#tab_"+ids_arr[1]).addClass("active");
            $("#left_menu_"+ids_arr[0]).removeClass("active");
            $("#left_menu_"+ids_arr[1]).addClass("active");
            return false;
        }
       
        var height = $("#height").val();
        if(height == ''){
           $("#height").css({'border': '2px solid red'}); 
        }else{
          $("#height").css({'border': '2px solid #ccc'});   
        }
        
        var eye_color = $("#eye_color").val();
        if(eye_color == ''){
           $("#eye_color").css({'border': '2px solid red'}); 
        }else{
          $("#eye_color").css({'border': '2px solid #ccc'});     
        }
        
        var skin_color = $("#skin_color").val();
        if(skin_color == ''){
           $("#skin_color").css({'border': '2px solid red'}); 
        }else{
          $("#skin_color").css({'border': '2px solid #ccc'});     
        }
                       
        var hair_color = $("#hair_color").val();
        if(hair_color == ''){
           $("#hair_color").css({'border': '2px solid red'}); 
        }else{
          $("#hair_color").css({'border': '2px solid #ccc'});     
        }
        
         var bust = $("#bust").val();
        if(bust == ''){
           $("#bust").css({'border': '2px solid red'}); 
        }else{
          $("#bust").css({'border': '2px solid #ccc'});     
        }
              
        var weight = $("#weight").val();
        if(weight == ''){
           $("#weight").css({'border': '2px solid red'}); 
        }else{
          $("#weight").css({'border': '2px solid #ccc'});     
        }
        
        var waist = $("#waist").val();
        if(waist == ''){
           $("#waist").css({'border': '2px solid red'}); 
        }else{
          $("#waist").css({'border': '2px solid #ccc'});     
        }
        
        var hips = $("#hips").val();
        if(hips == ''){
           $("#hips").css({'border': '2px solid red'}); 
        }else{
          $("#hips").css({'border': '2px solid #ccc'});     
        }
        
        var smoker = $("#smoker").val();
        if(smoker == ''){
           $("#smoker").css({'border': '2px solid red'}); 
        }else{
          $("#smoker").css({'border': '2px solid #ccc'});     
        }
        
        var drink = $("#drink").val();
        if(drink == ''){
           $("#drink").css({'border': '2px solid red'}); 
        }else{
          $("#drink").css({'border': '2px solid #ccc'});     
        }
        
        var occupation = $("#occupation").val();
        if(occupation == ''){
           $("#occupation").css({'border': '2px solid red'}); 
        }else{
          $("#occupation").css({'border': '2px solid #ccc'});     
        }
        
        var hobbies = $("#hobbies").val();
        if(hobbies == ''){
           $("#hobbies").css({'border': '2px solid red'}); 
        }else{
          $("#hobbies").css({'border': '2px solid #ccc'});     
        }
        
        if( height == '' || eye_color == '' || skin_color == '' || hair_color == '' || weight == '' || waist == '' || hips == '' ||  drink == '' || occupation == '' || hobbies == ''){
            return false; 
        }
      
        e.preventDefault();
            
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/update_agency_escort_figure_details',
                secureuri:false,
                dataType: "json",
                data: $('#agency_escort_figure_details').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                       $("#escort_figure_details").val("1");
                       $("#left_menu_4").removeClass("not-active"); 
                       $("#figure_error").html(result['message']).css({'color':'green'});
                       $("#agency_escort_figure_details").trigger("reset");
                    }else{
                       $("#figure_error").html(result['message']).css('color','red'); 
                    }
                    
                }
            });
         

    });
    
   $("#agencey_escorts_language").submit(function(e) {
       
        var ids_string = $("#language_next").val();
        var ids_arr = ids_string.split("-");
        var escort_language = $("#escort_language_details").val();
        if(escort_language != ''){
            $("#tab_"+ids_arr[0]).removeClass("active");
            $("#tab_"+ids_arr[1]).addClass("active");
            $("#left_menu_"+ids_arr[0]).removeClass("active");
            $("#left_menu_"+ids_arr[1]).addClass("active");
            return false;
        }
       
       var checkCount = $("input[name='language[]']:checked").length;
       if(checkCount < 1){
           $("#language_error").html("Please check at least one language.").css('color','red');
            return false;
       }else{
          $("#language_error").html(""); 
       }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/update_language_details',
                dataType: "json",
                data: $('#agencey_escorts_language').serialize(),
                success: function(result) {
                    if (result['message'] == 'Insertion failed') {
                        $("#language_error").html(result['message']).css({'color': 'red'});
                    } else {
                        $("#escort_language_details").val('1');
                        $("#left_menu_5").removeClass("not-active");
                        $("#agencey_escorts_language").trigger("reset");
                        $("#language_error").html(result['message']).css({'color': 'green'});
                    }
                    
                }
            });

    });
    
        
    $("#agency_escort_address").submit(function(e) {
        
        var ids_string = $("#address_next").val();
        var ids_arr = ids_string.split("-");
        var escort_address = $("#escort_address_details").val();
        if(escort_address != ''){
            $("#tab_"+ids_arr[0]).removeClass("active");
            $("#tab_"+ids_arr[1]).addClass("active");
            $("#left_menu_"+ids_arr[0]).removeClass("active");
            $("#left_menu_"+ids_arr[1]).addClass("active");
            return false;
        }
        
        var country_id = $("#country_id").val();
        if(country_id == ''){
           $("#country_id").css({'border': '2px solid red'}); 
        }else{
          $("#country_id").css({'border': '2px solid #ccc'});   
        }
        
        var city_id = $("#city_id").val();
        if(city_id == ''){
           $("#city_id").css({'border': '2px solid red'}); 
        }else{
          $("#city_id").css({'border': '2px solid #ccc'});     
        }
        
        var pincode_id = $("#pincode_id").val();
        if(pincode_id == ''){
           $("#pincode_id").css({'border': '2px solid red'}); 
        }else{
          $("#pincode_id").css({'border': '2px solid #ccc'});     
        }
        
        var address = $("#address").val();
        if(address == ''){
           $("#address").css({'border': '2px solid red'}); 
        }else{
          $("#address").css({'border': '2px solid #ccc'});     
        }
        
        
        if( address == '' || country_id == '' || city_id == '' || pincode_id == ''){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/update_agency_escort_address',
                dataType: "json",
                data: $('#agency_escort_address').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                       $("#left_menu_6").removeClass("not-active");                       
                       $("#escort_address_details").val('1');
                       $("#agency_escort_address").trigger("reset");
                       $("#address_error").html(result['message']).css({'color':'green'});
                    }else{
                      $("#address_error").html(result['message']).css({'color':'red'});  
                    }
                    
                }
            });

    });

     $("#agency_escort_rate_list").submit(function(e) {
         
        var ids_string = $("#rate_next").val();
        var ids_arr = ids_string.split("-");
        var escort_rate = $("#escort_rate_details").val();
        if(escort_rate != ''){
            $("#tab_"+ids_arr[0]).removeClass("active");
            $("#tab_"+ids_arr[1]).addClass("active");
            $("#left_menu_"+ids_arr[0]).removeClass("active");
            $("#left_menu_"+ids_arr[1]).addClass("active");
            return false;
        }
        
        var one_hour = $("#one_hour").val();
        if(one_hour == ''){
           $("#one_hour").css({'border': '2px solid red'}); 
        }else{
          $("#one_hour").css({'border': '2px solid #ccc'});   
        }
        
        var two_hours = $("#two_hours").val();
        if(two_hours == ''){
           $("#two_hours").css({'border': '2px solid red'}); 
        }else{
          $("#two_hours").css({'border': '2px solid #ccc'});     
        }
        
        var three_hours = $("#three_hours").val();
        if(three_hours == ''){
           $("#three_hours").css({'border': '2px solid red'}); 
        }else{
          $("#three_hours").css({'border': '2px solid #ccc'});     
        }
        
        var whole_night = $("#whole_night").val();
        if(whole_night == ''){
           $("#whole_night").css({'border': '2px solid red'}); 
        }else{
          $("#whole_night").css({'border': '2px solid #ccc'});     
        }
        
        if( one_hour == '' || two_hours == '' || three_hours == '' || whole_night == ''){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/insert_escort_rate_details',
                dataType: "json",
                data: $('#agency_escort_rate_list').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Failed.'){
                       
                       $("#rate_error").html(result['message']).css({'color':'red'}); 
                    }else{
                        $("#agency_escort_rate_list").trigger("reset");
                        $("#left_menu_7").removeClass("not-active"); 
                        $("#escort_rate_details").val('1');
                        $("#rate_error").html(result['message']).css({'color':'green'});
                    }
                    
                }
            });

    });
    
    
    
   $("#agency_service_area").submit(function(e) {
      
        var ids_string = $("#serviceable_next").val();
        var ids_arr = ids_string.split("-");
        var escort_serviceable = $("#escort_serviceable_area").val();
        if(escort_serviceable != ''){
            $("#tab_"+ids_arr[0]).removeClass("active");
            $("#tab_"+ids_arr[1]).addClass("active");
            $("#left_menu_"+ids_arr[0]).removeClass("active");
            $("#left_menu_"+ids_arr[1]).addClass("active");
            return false;
        }
        
        var service_area_id = $("#service_area_id").val();

        if(service_area_id == null){
           $(".select2-selection--multiple").css({'border': '2px solid red'}); 
        }else{
          $(".select2-selection--multiple").css({'border': '2px solid #ccc'});   
        }
       
        if( service_area_id == null){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/insert_agency_escort_service_area',
                dataType: "json",
                data: $('#agency_service_area').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                        $("#agency_service_area").trigger("reset");
                        $("#left_menu_8").removeClass("not-active");
                        $("#escort_serviceable_area").val('1');
                        $("#service_area_error").html(result['message']).css({'color':'green'});
                    }else{
                        $("#service_area_error").html(result['message']).css({'color':'red'}); 

                    }
                    
                }
            });

    });
    
    
    
     $("#agency_escort_specalities").submit(function(e) {
        
        var ids_string = $("#specalities_next").val();
        var ids_arr = ids_string.split("-");
        var escort_serviceable = $("#escort_specalities").val();

        if(escort_serviceable != ''){
            $("#tab_"+ids_arr[0]).removeClass("active");
            $("#tab_"+ids_arr[1]).addClass("active");
            $("#left_menu_"+ids_arr[0]).removeClass("active");
            $("#left_menu_"+ids_arr[1]).addClass("active");
            return false;
        }
        
        var specialties_id = $("#specialties_id").val();
       
        if(specialties_id == null){
           $(".select2-selection--multiple").css({'border': '2px solid red'}); 
        }else{
          $(".select2-selection--multiple").css({'border': '2px solid #ccc'});   
        }
       
        
        if( specialties_id == null){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/insert_specalities_details',
                dataType: "json",
                data: $('#agency_escort_specalities').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                        $("#agency_escort_specalities").trigger("reset");
                        $("#escort_specalities").val('1');
                        $("#left_menu_9").removeClass("not-active");
                        $("#specialties_error").html(result['message']).css({'color':'green'});
                    }else{
                        $("#specialties_error").html(result['message']).css({'color':'red'}); 
                    }
                    
                }
            });

    });
    
    
    $("#agency_escorts_featured_services").submit(function(e) {
        
        var ids_string = $("#featured_next").val();
        var ids_arr = ids_string.split("-");
        var escort_featured = $("#escort_featured_service").val();
        
        if(escort_featured != ''){
            $("#tab_"+ids_arr[0]).removeClass("active");
            $("#tab_"+ids_arr[1]).addClass("active");
            $("#left_menu_"+ids_arr[0]).removeClass("active");
            $("#left_menu_"+ids_arr[1]).addClass("active");
            return false;
        }
        
        var featured_services_id = $("#featured_services_id").val();
        if(featured_services_id == null){
           $(".select2-selection--multiple").css({'border': '2px solid red'}); 
        }else{
          $(".select2-selection--multiple").css({'border': '2px solid #ccc'});   
        }
       
        
        if( featured_services_id == null){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/insert_featured_services_details',
                dataType: "json",
                data: $('#agency_escorts_featured_services').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                        $("#escort_specalities").val('1');
                        $("#featured_services_error").html(result['message']).css({'color':'green'});
                        $("#agency_escorts_featured_services").trigger("reset");
                    }else{
                        $("#featured_services_error").html(result['message']).css({'color':'red'}); 

                    }
                    
                }
            });

    });
    
    /*
     * Edit Agency Escort Profile
     */
    
     $("#edit_about_agency_me").submit(function(e) {
               
        var user_name = $("#user_name").val();
        if(user_name == ''){
           $("#user_name").css({'border': '2px solid red'}); 
        }else{
          $("#user_name").css({'border': '2px solid #ccc'});   
        }
        
        var dob = $("#dob").val();
        if(dob == ''){
           $("#dob").css({'border': '2px solid red'}); 
        }else{
          $("#dob").css({'border': '2px solid #ccc'});     
        }
        
        var mobile_no = $("#mobile_no").val();
        if(mobile_no == ''){
           $("#mobile_no").css({'border': '2px solid red'}); 
        }else{
          $("#mobile_no").css({'border': '2px solid #ccc'});     
        }
        
        var escort_type_id = $("#escort_type_id").val();
        if(escort_type_id == ''){
           $("#escort_type_id").css({'border': '2px solid red'}); 
        }else{
          $("#escort_type_id").css({'border': '2px solid #ccc'});     
        }
        
               
        var about_information = $("#about_information").val();
        if(about_information == ''){
           $("#about_information").css({'border': '2px solid red'}); 
        }else{
          $("#about_information").css({'border': '2px solid #ccc'});     
        }
        
        
        if( about_information == '' || user_name == '' || dob == '' || mobile_no == '' || escort_type_id == ''){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/update_about_agency_me_details',
                dataType: "json",
                data: $('#edit_about_agency_me').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                       $("#about_error").html(result['message']).css({'color':'green'});
                    }else{
                       $("#about_error").html(result['message']).css({'color':'red'});
                    }
                }
            });

    });
    
    
       
   $("#profile_image").on("click",function(){
       $("#upload_image_button").removeAttr("disabled");
   }); 
    
   $('#edit_agency_escort_upload').submit(function(e){

       var images = $("#profile_image").val();
      
       
       if(images == ''){
           $("#dropzone_wrapper").removeClass("dropzone-wrapper");
           $("#dropzone_wrapper").addClass("dropzone-wrapper-error");
           return false;
       }else{
          $("#dropzone_wrapper").addClass("dropzone-wrapper");  
       }
       
    e.preventDefault(); 
         $.ajax({
             url:BASE_URL+'usersprofile/agency_profile/upload_agency_escort_images',
             type:"post",
             data:new FormData(this),
             processData:false,
             contentType:false,
             dataType: "json",
             cache:false,
             async:false,
              success: function(data){
                  if(data['message'] == 'Image uploaded fail'){
                    $("#upload_error").html(data['message']).css('color','red'); 
                  }else{
                    var html = '';
                    for(var i = 0; i < data['lists'].length; i++){
                        html += '<div class="custom-container">';
                        html += '<span aria-hidden="true" style="color: red;margin-left: 80%;" onclick="remove_image_list('+data['lists'][i]['id']+')">&times;</span>';
                        html += '<img src="'+BASE_URL+'images/escorts-image/'+data['lists'][i]['original_image']+'">';
                        html += '</div>';
                    }
                    $("#image_list_id").html(html);
                    $("#upload_error").html(data['message']).css('color','green');  
                  }
           }
         });
    });
    
    $("#edit_agency_escort_figure_details").submit(function(e) {
                
        var height = $("#height").val();
        if(height == ''){
           $("#height").css({'border': '2px solid red'}); 
        }else{
          $("#height").css({'border': '2px solid #ccc'});   
        }
        
        var eye_color = $("#eye_color").val();
        if(eye_color == ''){
           $("#eye_color").css({'border': '2px solid red'}); 
        }else{
          $("#eye_color").css({'border': '2px solid #ccc'});     
        }
        
        var skin_color = $("#skin_color").val();
        if(skin_color == ''){
           $("#skin_color").css({'border': '2px solid red'}); 
        }else{
          $("#skin_color").css({'border': '2px solid #ccc'});     
        }
                       
        var hair_color = $("#hair_color").val();
        if(hair_color == ''){
           $("#hair_color").css({'border': '2px solid red'}); 
        }else{
          $("#hair_color").css({'border': '2px solid #ccc'});     
        }
        
         var bust = $("#bust").val();
        if(bust == ''){
           $("#bust").css({'border': '2px solid red'}); 
        }else{
          $("#bust").css({'border': '2px solid #ccc'});     
        }
              
        var weight = $("#weight").val();
        if(weight == ''){
           $("#weight").css({'border': '2px solid red'}); 
        }else{
          $("#weight").css({'border': '2px solid #ccc'});     
        }
        
        var waist = $("#waist").val();
        if(waist == ''){
           $("#waist").css({'border': '2px solid red'}); 
        }else{
          $("#waist").css({'border': '2px solid #ccc'});     
        }
        
        var hips = $("#hips").val();
        if(hips == ''){
           $("#hips").css({'border': '2px solid red'}); 
        }else{
          $("#hips").css({'border': '2px solid #ccc'});     
        }
        
        var smoker = $("#smoker").val();
        if(smoker == ''){
           $("#smoker").css({'border': '2px solid red'}); 
        }else{
          $("#smoker").css({'border': '2px solid #ccc'});     
        }
        
        var drink = $("#drink").val();
        if(drink == ''){
           $("#drink").css({'border': '2px solid red'}); 
        }else{
          $("#drink").css({'border': '2px solid #ccc'});     
        }
        
        var occupation = $("#occupation").val();
        if(occupation == ''){
           $("#occupation").css({'border': '2px solid red'}); 
        }else{
          $("#occupation").css({'border': '2px solid #ccc'});     
        }
        
        var hobbies = $("#hobbies").val();
        if(hobbies == ''){
           $("#hobbies").css({'border': '2px solid red'}); 
        }else{
          $("#hobbies").css({'border': '2px solid #ccc'});     
        }
        
        if( height == '' || eye_color == '' || skin_color == '' || hair_color == '' || weight == '' || waist == '' || hips == '' ||  drink == '' || occupation == '' || hobbies == ''){
            return false; 
        }
      
        e.preventDefault();
            
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/update_agency_escort_figure_details',
                secureuri:false,
                dataType: "json",
                data: $('#edit_agency_escort_figure_details').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                       $("#figure_error").html(result['message']).css({'color':'green'});
                    }else{
                       $("#figure_error").html(result['message']).css('color','red'); 
                    }
                }
            });
         

    });
    
      $("#edit_agencey_escorts_language").submit(function(e) {
              
       var checkCount = $("input[name='language[]']:checked").length;
       if(checkCount < 1){
           $("#language_error").html("Please check at least one language.").css('color','red');
            return false;
       }else{
          $("#language_error").html(""); 
       }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/update_language_details',
                dataType: "json",
                data: $('#edit_agencey_escorts_language').serialize(),
                success: function(result) {
                    if (result['message'] == 'Insertion failed') {
                        $("#language_error").html(result['message']).css({'color': 'red'});
                    } else {
                        $("#language_error").html(result['message']).css({'color': 'green'});
                    }
                    
                }
            });

    });
    
    
     $("#edit_agency_escort_address").submit(function(e) {
        
        var country_id = $("#country_id").val();
        if(country_id == ''){
           $("#country_id").css({'border': '2px solid red'}); 
        }else{
          $("#country_id").css({'border': '2px solid #ccc'});   
        }
        
        var city_id = $("#city_id").val();
        if(city_id == ''){
           $("#city_id").css({'border': '2px solid red'}); 
        }else{
          $("#city_id").css({'border': '2px solid #ccc'});     
        }
        
        var pincode_id = $("#pincode_id").val();
        if(pincode_id == ''){
           $("#pincode_id").css({'border': '2px solid red'}); 
        }else{
          $("#pincode_id").css({'border': '2px solid #ccc'});     
        }
        
        var address = $("#address").val();
        if(address == ''){
           $("#address").css({'border': '2px solid red'}); 
        }else{
          $("#address").css({'border': '2px solid #ccc'});     
        }
        
        if( address == '' || country_id == '' || city_id == '' || pincode_id == ''){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/update_agency_escort_address',
                dataType: "json",
                data: $('#edit_agency_escort_address').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                       $("#address_error").html(result['message']).css({'color':'green'});
                    }else{
                      $("#address_error").html(result['message']).css({'color':'red'});  
                    }
                    
                }
            });

    });
    
    
    $("#edit_agency_escort_rate_list").submit(function(e) {
       
        var one_hour = $("#one_hour").val();
        if(one_hour == ''){
           $("#one_hour").css({'border': '2px solid red'}); 
        }else{
          $("#one_hour").css({'border': '2px solid #ccc'});   
        }
        
        var two_hours = $("#two_hours").val();
        if(two_hours == ''){
           $("#two_hours").css({'border': '2px solid red'}); 
        }else{
          $("#two_hours").css({'border': '2px solid #ccc'});     
        }
        
        var three_hours = $("#three_hours").val();
        if(three_hours == ''){
           $("#three_hours").css({'border': '2px solid red'}); 
        }else{
          $("#three_hours").css({'border': '2px solid #ccc'});     
        }
        
        var whole_night = $("#whole_night").val();
        if(whole_night == ''){
           $("#whole_night").css({'border': '2px solid red'}); 
        }else{
          $("#whole_night").css({'border': '2px solid #ccc'});     
        }
        
        if( one_hour == '' || two_hours == '' || three_hours == '' || whole_night == ''){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/insert_escort_rate_details',
                dataType: "json",
                data: $('#edit_agency_escort_rate_list').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Failed.'){
                       $("#rate_error").html(result['message']).css({'color':'red'}); 
                    }else{                       
                        $("#rate_error").html(result['message']).css({'color':'green'});
                    }
                    
                }
            });

    });
    
    
    
    $("#edit_agency_service_area").submit(function(e) {
            
        var service_area_id = $("#service_area_id").val();

        if(service_area_id == null){
           $(".select2-selection--multiple").css({'border': '2px solid red'}); 
        }else{
          $(".select2-selection--multiple").css({'border': '2px solid #ccc'});   
        }
       
        if( service_area_id == null){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/insert_agency_escort_service_area',
                dataType: "json",
                data: $('#edit_agency_service_area').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                        $("#service_area_error").html(result['message']).css({'color':'green'});
                    }else{
                        $("#service_area_error").html(result['message']).css({'color':'red'}); 

                    }
                    
                }
            });

    });
    
    
    $("#edit_agency_escort_specalities").submit(function(e) {
        var specialties_id = $("#specialties_id").val();
        if(specialties_id == null){
           $(".select2-selection--multiple").css({'border': '2px solid red'}); 
        }else{
          $(".select2-selection--multiple").css({'border': '2px solid #ccc'});   
        }
        
        if( specialties_id == null){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/insert_specalities_details',
                dataType: "json",
                data: $('#edit_agency_escort_specalities').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                        $("#specialties_error").html(result['message']).css({'color':'green'});
                    }else{
                        $("#specialties_error").html(result['message']).css({'color':'red'}); 
                    }
                    
                }
            });

    });
    
    
    $("#edit_agency_escorts_featured_services").submit(function(e) {
        
        var featured_services_id = $("#featured_services_id").val();
        if(featured_services_id == null){
           $(".select2-selection--multiple").css({'border': '2px solid red'}); 
        }else{
          $(".select2-selection--multiple").css({'border': '2px solid #ccc'});   
        }
        
        if( featured_services_id == null){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/users_profile/insert_featured_services_details',
                dataType: "json",
                data: $('#edit_agency_escorts_featured_services').serialize(),
                success: function(result) {
                    if(result['message'] == 'Information Insertion Successfully.'){
                        $("#featured_services_error").html(result['message']).css({'color':'green'});
                    }else{
                        $("#featured_services_error").html(result['message']).css({'color':'red'}); 

                    }
                    
                }
            });

    });
    
      $("#change_agency_password").submit(function(e) {
        var old_password = $("#old_password").val();
        if(old_password == ''){
           $("#old_password").css({'border': '2px solid red'}); 
        }else{
          $("#old_password").css({'border': '2px solid #ccc'});   
        }
                
        var new_password = $("#new_password").val();
        if(new_password == ''){
           $("#new_password").css({'border': '2px solid red'}); 
        }else{
          $("#new_password").css({'border': '2px solid #ccc'});   
        }
        
        var confirm_password = $("#confirm_password").val();
        if(confirm_password == ''){
           $("#confirm_password").css({'border': '2px solid red'}); 
        }else{
          $("#confirm_password").css({'border': '2px solid #ccc'});   
        }
        
        if( new_password !='' && confirm_password !='' && new_password != confirm_password){
           $("#new_password").css({'border': '2px solid red'}); 
           $("#confirm_password").css({'border': '2px solid red'}); 
        }else{
            if(new_password == '' && confirm_password == ''){
               $("#new_password").css({'border': '2px solid red'}); 
               $("#confirm_password").css({'border': '2px solid red'}); 
            }else{
                $("#confirm_password").css({'border': '2px solid #ccc'});   
                $("#new_password").css({'border': '2px solid #ccc'});
            }

        }
        
        if( old_password == ''|| new_password =='' || confirm_password =='' || new_password != confirm_password){
            return false; 
        }
        //prevent Default functionality
        e.preventDefault();
        //do your own request an handle the results
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/change_agency_escorts_password',
                dataType: "json",
                data: $('#change_agency_password').serialize(),
                success: function(result) {
                    if(result['message'] == 'Your Password Has Been Sucessfully Change.'){
                        $("#change_agency_password").trigger("reset");
                        $("#change_pass_error").html(result['message']).css({'color':'green'});
                    }else{
                        $("#change_pass_error").html(result['message']).css({'color':'red'}); 
                    }
                    
                }
            });

    });
    
});

  function remove_agency_image(escort_id, image_id){
        if(image_id != ''){
            $.ajax({
                 type: 'POST',
                 url: BASE_URL+'usersprofile/users_profile/remove_escorts_image',
                 dataType: "json",
                 data: {escort_id : escort_id, id : image_id},
                 success: function(result) {
                     if(result){
                        var html = '';
                        for(var i = 0; i < result.length; i++){
                            html += '<div class="custom-container" style="display: inline-block;">';
                            html += '<span aria-hidden="true" style="color: red;" onclick="remove_agency_image('+result[i]['escort_id']+','+result[i]['id']+')">&times;</span>';
                            html += '<img style="width: 100px; height: 100px;" src="'+BASE_URL+'images/escorts-image/'+result[i]['original_image']+'">';
                            html += '</div>';
                        }
                     }
                     $("#agency_image_list_id").html(html);
                 }
             });
        }
   }
   
   $(".dectivate_account").click(function (){
        var agency_escort_id = $(this).attr("id");
        if( agency_escort_id != '' ){
            if (confirm("Are you sure? You want to delete.")) {
            $.ajax({
                type: 'POST',
                url: BASE_URL+'usersprofile/agency_profile/dectivate_agency_escort_accounts',
                dataType: "json",
                data: {id : agency_escort_id},
                success: function(result) {
                    if(result['message'] == 'Updation Successfully.'){
                        window.location.reload();
                    }                    
                }
            });
        }
    } 
    });
