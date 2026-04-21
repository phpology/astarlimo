<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Your World">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Your World {{ APP_NAME }}" />
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ PUBLICFOLDER }}assets/images/yw-logo-m.png" type="image/x-icon"/>
    <!-- Page Title  -->
    <title>{{ APP_NAME }} Login</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ PUBLICFOLDER }}assets/css/style.css">
    <link id="skin-default" rel="stylesheet" href="{{ PUBLICFOLDER }}assets/css/skins/theme-blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

</head>
<!-- content @s -->
@yield('content')
<!-- content @e -->
<!-- JavaScript -->
<script src="{{ PUBLICFOLDER }}assets/js/bundle.js"></script>
<script src="{{ PUBLICFOLDER }}assets/js/scripts.js"></script>
@yield('footerscripts')
<script>
    $("#form1").submit(function (e) {
        e.preventDefault();
        proceed = true;
        if(proceed){
            var post_url = $(this).attr("action");
            var request_method = $(this).attr("method");
            var redirect = $(this).data("redirect");
            var form_data = new FormData(this);
            $.ajax({
                url : post_url,
                type: request_method,
                data : form_data,
                contentType: false,
                cache: false,
                processData:false,
                beforeSend:
                    function(){
                        $("#form1results").show();
                        $("#form1results").html('<div class="alert alert-danger">Please wait..</div>');
                    },
                success: function(resx){
                    var res = JSON.parse(resx);
                    $("#form1results").html("");
                    if(res.success){
                        $("#form1results").show();
                        $("#form1results").html('<div class="alert alert-fill alert-success">'+res.message+'</div>');
                        $("#form1")[0].reset();
                        if(redirect){
                            window.location.href= redirect;
                        }
                    }else{
                        $("#form1results").html('<div class="alert alert-danger">'+res.message+'</div>');
                    }
                },
                error: function(res){
                    $("#form1results").html("");
                    if(!res.success){
                        $("#form1results").html('<div class="alert alert-danger">'+res.data+'</div>');
                    }
                }
            });
        }
    });
</script>
</body>
</html>