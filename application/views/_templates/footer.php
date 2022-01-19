
		</div> <!-- Closing container div -->
    </div> 
		</div>

  <!-- Modal Structure -->
  <div id="modalLogin" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>Login to Continue</h4><br>
      <div style="height:100%;width:100%;" class="valign-wrapper"><a style="margin:auto;" href="<?=$google_client->createAuthUrl()?>"><img src="\img\btn_google_signin_dark_normal_web.png"></a></div><br>
    </div>
  </div>

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
