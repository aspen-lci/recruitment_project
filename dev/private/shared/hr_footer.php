 <!-- Time Out Popups -->
 <!--Start Show Session Expire Warning Popup here -->

 <div class="modal fade" id="session-expire-warning-modal" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

<div class="modal-dialog" role="document">

    <div class="modal-content">

        <div class="modal-header">                 

            <h4 class="modal-title">Session Expire Warning</h4>

        </div>

        <div class="modal-body">

            Your session will expire in <span id="seconds-timer"></span> seconds. Do you want to extend the session?

        </div>

        <div class="modal-footer">

            <button id="btnOk" type="button" class="btn btn-default" style="padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: normal; border: 1px solid transparent; border-radius: 4px;  background-color: #428bca; color: #FFF;">Ok</button>

            <button id="btnSessionExpiredCancelled" type="button" class="btn btn-default" data-dismiss="modal" style="padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: normal; border: 1px solid transparent; border-radius: 4px; background-color: #428bca; color: #FFF;">Cancel</button>

            <button id="btnLogoutNow" type="button" class="btn btn-default" style="padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: normal; border: 1px solid transparent; border-radius: 4px;  background-color: #428bca; color: #FFF;">Logout now</button>

        </div>

    </div>

</div>

</div>

<!--End Show Session Expire Warning Popup here -->

<!--Start Show Session Expire Popup here -->

<div class="modal fade" id="session-expired-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

<div class="modal-dialog" role="document">

    <div class="modal-content">

        <div class="modal-header">

            <h4 class="modal-title">Session Expired</h4>

        </div>

        <div class="modal-body">

            Your session is expired.

        </div>

        <div class="modal-footer">

            <button id="btnExpiredOk" onclick="sessionExpiredRedirect()" type="button" class="btn btn-primary" data-dismiss="modal" style="padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: normal; border: 1px solid transparent; border-radius: 4px; background-color: #428bca; color: #FFF;">Ok</button>

        </div>

    </div>

</div>

</div>
 <!-- End Timeout Popup -->

 <!-- Footer -->
    
 <footer class="py-5 bg-dark">
  <div class="container">
      <p class="text-white text-center" id="footer_tagline"><strong>Changing hearts & bringing hope to individuals, families, and communities.</strong></p>
      <p class="text-white text-center mb-0">Lasting Change, Inc.</p>
      <p class="text-white text-center mb-0">4150 Illinois Road</p>
      <p class="text-white text-center mb-0">Fort Wayne, IN 46804</p>
      <p class="m-0 text-center text-white" id="footer_disclaimer">Copyright &copy; <?php echo date('Y') ?> Lasting Change, Inc.</br>
      This website is operated by Lasting Change, Inc. pursuant to and in compliance with service agreements with both Lifeline Youth & Family Services, Inc. and Crosswinds, Inc.</p>
    </div>
      <!-- /.container -->
  </footer>
 
     <!-- Bootstrap core JavaScript -->
     <script src="<?php echo url_for('/vendor/jquery/jquery.min.js'); ?>"></script>
     <script src="<?php echo url_for('/vendor/jquery/tableManager.js'); ?>"></script>
    <!-- <script src="https://unpkg.com/@popperjs/core@2"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?php echo url_for('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Bootstrap Table -->
    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>

    <!-- X-editable -->
    
    <script src="<?php echo url_for('/vendor/bootstrap3-editable/js/bootstrap-editable.min.js'); ?> "></script>  
    <script src="<?php echo url_for('/js/moment.js'); ?>"></script>
    <script src="<?php echo url_for('/js/custom.js'); ?>"></script>
    

<script>
    setInterval(function(){
    logout();
},1200000);

function logout(){
    if(confirm('You have been idle for more than 20 minutes.  Click OK to stay logged in.'))
        alert('OK! keeping you logged in');
        
    else
    redirect()
}

function redirect(){
    document.location = "../../public/logout.php"
}
</script>

    <?php
      db_disconnect($db);
    ?>