
<!--Jarvis is here-->
  <!-- Modal Structure -->
  </div> <!-- Closing container div -->
    </div> 
</br>
        <style>
        .all-browsers {
  margin: 0;
  padding: 5px;
  background-color:#2196F3 !important;
}

.all-browsers > h1, .browser {
  margin: 1px;
  padding: 5px;
}

.browser {
  background: #2196F3 !important;
}

.browser > h2, p {
  margin: 4px;
  font-size: 90%;
}



body {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 20px;
}


input:hover,
.btn:hover {
  opacity: 1;
}
input.right {
        float: right;
        background-color:#2196F3 !important;
      }

.footer {
   position:bottom;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color:#2196F3 !important;
   color: white;
   text-align: center;
}

/*#footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 2.5rem;            /* Footer height */
}*/
.google {
  background-color: #55ACEE;
  color: white;
}
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
</style>
</br>



<div class="footer">
<footer>
<?php if(!$logincheck) {?>
  <!--<a style="margin:auto;" href="<?=$google_client->createAuthUrl()?>" >
  <i class="right" style="color:#2196F3 !important;">
  <i class="google btn" ><i class="fa fa-google fa-fw">
          </i> Login with Google+
        </i>
</i></a>-->
<?php } ?>
  <p style="font-size: 15px;">Created and Managed by Kansu pvt. ltd.<br>
  <a href="#" style="color:white;" >kansupvtltd2020@gmail.com</a></p>
  </footer>
  </div>
<!--<h4>Login In /Sign Up to continue</h4><br>
      <a style="margin:auto;" href="<?=$google_client->createAuthUrl()?>">
      <img src="\img\btn_google_signin_dark_normal_web.png"></a>
    
-->


<script>  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(elems);
  });


  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems,{edge:'right'});
  });

  document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'interactive') {
       
  } else if (state == 'complete') {
      setTimeout(function(){
         document.getElementById('progress').style.visibility="hidden";
         },1000);
  }
}
function goBack() {
  window.history.go(-1);
}
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
  });
  </script>
  <script>
$('img').load(function(){
   $(this).css('background','none');
});
  </script>
<script>
$(function(){

  $('#old_search').focus(function(){

    $("#new_search").show();
    $("#search").focus();
    $("#old").hide();

  })

  $('#search').blur(function(){

    $("#new_search").hide();
    $("#old").show();

  });
});
</script>
		<script src="/js/materialize.min.js"></script>
  <script>
$(".dropdown-trigger").dropdown();
  </script>

  <script>
    $(document).ready(function(){
    $('.modal').modal();
  });
</script>

      <!-- Core Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/js/imagesloaded.pkgd.min.js"></script>
    <script src="/js/masonry.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/materialize/0.98.0/js/materialize.min.js"></script>
    <script src="/js/color-thief.min.js"></script>
    <script src="/js/galleryExpand.js"></script>
    <script src="/js/init.js"></script>

<script>
M.AutoInit();
</script>

<?php if($logincheck == false){ ?>
<script>
 $(document).ready(function(){
    $('#modalLogin').modal({
      'dismissible' : false
    });
    $('#modalLogin').modal('open'); 
 });
</script>
<?php } ?>

	</body>
</html>
