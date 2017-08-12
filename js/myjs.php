<script>
    
        $("document").ready(function()
        {
                $("#error").hide();
                $(".close").click(function()
                {
                        $("#error").hide();        
                });

        });
    
    
</script>

<script type="text/javascript">                    
    

    
    function chk()
    {	
            var user = document.forms["regi"]["regi_username"].value;
           // var phnno = document.forms["regi"]["regi_phnno"].value;
            var pass = document.forms["regi"]["regi_password"].value;
            var pass_confim = document.forms["regi"]["regi_password_confim"].value;
            
        
            
                    if(user=="" || pass=="" || pass_confim=="")
                    {
                        
                        document.getElementById("errorMSG").innerHTML="Enter All Field";
                        $("#error").show();
                        return false;
                    }
                    
                    if(pass!=pass_confim)
                    {
                        document.getElementById("errorMSG").innerHTML="Password Does Not Match";
                        $("#error").show();
                        return false;
                    }
                    else
                    {
                        
                        var regpan = /^(?=.*\d)(?=.*(0-9A-Za-z!@#$%){6}$/;
                        if(regpan.test(pass) == false)
                        {
                            
                            $("#error").show();
                            $("#errorMSG").html("Enter Storng Password of Atleast 6 Characters");    
                             return false;
                        }
                       
                    }
                    
                   
                    if(user.indexOf("@")==-1)
                    {
                         document.getElementById("errorMSG").innerHTML="Enter Vaild Email Address";
                        $("#error").show();
                        return false;
                    }
     
                    
                    
           return true;
    }
            
        </script>