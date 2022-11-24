
<footer
id="footer"
class="dark"
data-scrollto-settings='{"offset":140,"speed":1250,"easing":"easeOutQuad"}'
>
<!-- Copyrights
============================================= -->
<div id="copyrights">
  <div class="container">
    <div class="row col-mb-30">
      <div class="col-md-6 text-center text-md-start">
        Copyrights © 2022 All Rights Reserved by FHM Agency.<br />
        <div class="copyright-links">
          <a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a>
        </div>
      </div>

      <div class="col-md-6 text-center text-md-end">
        <div
          class="d-flex justify-content-center justify-content-md-end"
        >
          <a
            href="#"
            class="social-icon si-small si-borderless si-facebook"
          >
            <i class="icon-facebook"></i>
            <i class="icon-facebook"></i>
          </a>

          <a
            href="#"
            class="social-icon si-small si-borderless si-twitter"
          >
            <i class="icon-twitter"></i>
            <i class="icon-twitter"></i>
          </a>

          <a
            href="#"
            class="social-icon si-small si-borderless si-gplus"
          >
            <i class="icon-gplus"></i>
            <i class="icon-gplus"></i>
          </a>

          <a
            href="#"
            class="social-icon si-small si-borderless si-pinterest"
          >
            <i class="icon-pinterest"></i>
            <i class="icon-pinterest"></i>
          </a>

          <a
            href="#"
            class="social-icon si-small si-borderless si-vimeo"
          >
            <i class="icon-vimeo"></i>
            <i class="icon-vimeo"></i>
          </a>

          <a
            href="#"
            class="social-icon si-small si-borderless si-github"
          >
            <i class="icon-github"></i>
            <i class="icon-github"></i>
          </a>

          <a
            href="#"
            class="social-icon si-small si-borderless si-yahoo"
          >
            <i class="icon-yahoo"></i>
            <i class="icon-yahoo"></i>
          </a>

          <a
            href="#"
            class="social-icon si-small si-borderless si-linkedin"
          >
            <i class="icon-linkedin"></i>
            <i class="icon-linkedin"></i>
          </a>
        </div>

        <div class="clear"></div>

        <i class="icon-envelope2"></i>  <?php if(isset($web_information->information->email)): ?>

        <?php echo e($web_information->information->email); ?>

    <?php endif; ?>
        <span class="middot">·</span>
        <i class="icon-headphones"></i> 
         <?php if(isset($web_information->information->phone)): ?>
        <?php echo e($web_information->information->phone); ?>

    <?php endif; ?>
        <span class="middot">·</span>
        <i class="icon-skype2"></i>  <?php if(isset($web_information->information->skype)): ?>
        <?php echo e($web_information->information->skype); ?>

    <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!-- #copyrights end -->
</footer>
<?php /**PATH C:\xampp\htdocs\fhm\resources\views/frontend/blocks/footer/styles/default.blade.php ENDPATH**/ ?>