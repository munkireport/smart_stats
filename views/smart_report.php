<?php $this->view('partials/head', array(
	"scripts" => array(
		"clients/client_list.js"
	)
)); ?>

<div class="container">
  <div class="row">
      <?php $widget->view($this, 'smart_overall_health_test'); ?>
      <?php $widget->view($this, 'ssd_service_program'); ?>
  </div> <!-- /row -->
</div>  <!-- /container -->

<script src="<?php echo conf('subdirectory'); ?>assets/js/munkireport.autoupdate.js"></script>

<?php $this->view('partials/foot'); ?>
