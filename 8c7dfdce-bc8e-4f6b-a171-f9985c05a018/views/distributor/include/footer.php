<footer>
    <p>2015 &copy; F3holding Admin Template.</p>
</footer>

<!-- hidden field data to get in login.js page -->
<input type="hidden" id="base_url" value="<?= base_url() ?>">
<input type="hidden" id="csrf" csrftokenname="<?php echo $this->security->get_csrf_token_name()?>" csrftokenhash="<?php echo $this->security->get_csrf_hash() ?>">


<a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="fa fa-chevron-up"></i></a>
</div>
<!-- END Content -->
</div>
<!-- END Container -->

<!-- include common js variable -->
<script>
var base_url = '<?= base_url() ?>';
</script>

<!--basic scripts-->
<script src="<?php echo JSPATH; ?>jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')</script>
<script src="<?php echo JSPATH; ?>bootstrap.min.js"></script>
<script src="<?php echo JSPATH; ?>jquery.slimscroll.min.js"></script>
<script src="<?php echo JSPATH; ?>jquery.cookie.js"></script>

<!--page specific plugin scripts-->
<script src="<?php echo JSPATH; ?>jquery.flot.js"></script>
<script src="<?php echo JSPATH; ?>jquery.flot.resize.js"></script>
<script src="<?php echo JSPATH; ?>jquery.flot.pie.js"></script>
<script src="<?php echo JSPATH; ?>jquery.flot.stack.js"></script>
<script src="<?php echo JSPATH; ?>jquery.flot.crosshair.js"></script>
<script src="<?php echo JSPATH; ?>jquery.flot.tooltip.min.js"></script>
<script src="<?php echo JSPATH; ?>jquery.sparkline.min.js"></script>

<!--flaty scripts-->
<script src="<?php echo JSPATH; ?>flaty.js"></script>
<script src="<?php echo JSPATH; ?>flaty-demo-codes.js"></script>

<!-- include common js file in every page -->
<script src="<?php echo JSPATH; ?>site/common.js"></script>

</body>
</html>
