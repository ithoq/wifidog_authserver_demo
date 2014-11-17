<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="/images/jquery-1.7.1.min.js"></script>
    <link href="/images/css/login_m.css" rel="stylesheet" type="text/css" />
    <title>wifidog Login</title>
    <style type="text/css">
      @media screen and (max-width: 500px) {
        .changecolor {
          background: #ccc;
        }
      }
    </style>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#pwtext").attr("value"," Please enter your password ");
        $("#password").hide();
        $("#pwtext").focus(function(){
          $(this).hide();
          $("#password").show().focus();
          //$("#password").attr("value","");
          //$("#password").attr("type","password");
        });
        $("#password").blur(function(){
          if($(this).val()==""){
            $(this).hide();
            $("#pwtext").show();
          }
        });
        $("#username").attr("value"," Please enter your username ");
        //focuscount=0;
        $("#username").focus(function(){
          $(this).attr("value","");
          //	focuscount++;
        });
        $("#username").blur(function(){
          if($(this).val()==""){
            $(this).attr("value"," Please enter your username ");
            $("#username").focus(function(){
              $(this).attr("value","");
              focuscount++;
            });
          }else{
            $("#username").unbind("focus");
          }
        });
        $("#img_btn").click(function(){
          $("#myform").submit();
        });
      });
    </script>
  </head>

  <body>
    <div id="phoneall">
      <img src="/images/images/logo-123.jpg" width="100%" />
      <?php echo form_open( "http://".$_SERVER ['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'],array('id'=>'myform')); ?>
        <input type="hidden" name="gw_address" value="<?php echo empty($gw_address)?'':$gw_address;?>">
        <input type="hidden" name="gw_port" value="<?php echo empty($gw_port)?'':$gw_port;?>">
        <input type="hidden" name="gw_id" value="<?php echo empty($gw_id)?'':$gw_id;?>">
        <input type="hidden" name="url" value="<?php echo empty($url)?'':$url;?>">

        <input type="text" class="yuanjiao" id="username" name="username" style="">
        <input type="text" class="yuanjiao" id="pwtext"  style="margin-top:10px">
        <input type="password" class="yuanjiao" id="password" name="password" style="margin-top:10px">
        <img src="/images/images/loingbutton-1.jpg" id="img_btn"  style="margin-left:5%;width:90%;margin-top:15px"/>
        <p align="center" class="p-comment">
          Before you use a network, you need to be authenticated.<br />
          Please get added to the QQ group 331,230,369 accounts.
        </p>
      </form>
    </div>

    <script type="text/javascript">
      var winWidth = 0;
      var winHeight = 0;

      function findDimensions() {   
      // get the window width
        if (window.innerWidth)   
          winWidth = window.innerWidth;   
        else if ((document.body) && (document.body.clientWidth))  
          winWidth = document.body.clientWidth;   // Get the window height

        if (window.innerHeight)   
          winHeight = window.innerHeight;   
        else if ((document.body) && (document.body.clientHeight))   
          winHeight = document.body.clientHeight;   // depth on the body to detect internal Document, get the window size

        if (document.documentElement  && document.documentElement.clientHeight && document.documentElement.clientWidth){   
          winHeight = document.documentElement.clientHeight;
          winWidth = document.documentElement.clientWidth;
        }  
      }
      
      findDimensions();  
      // call the function to get the value
      //window.onresize=findDimensions;
      
    </script>
  </body>
</html>
