<?php 
	$postMeta = get_post_meta(get_the_ID());
	$angariadoPercent = calcPercent($postMeta);
	$closeIn = daysUntil($postMeta["proj_data_fecho"][0]);

  $date1 = new DateTime($postMeta["proj_data_fecho"][0]);
  $date2 = new DateTime(date('Y-m-d h:m'));

  $diff = $date2->diff($date1);

  $hours = $diff->format('%hh %im');
?>
<article class="panel panel-default">
  <header class="panel-heading clearfix">
    <h3 class="panel-title pull-left"><?php the_title(); ?></h3>
    <div class="panel-time-left pull-right">
    	<?php if($closeIn > 0) : ?>
    		<span class="glyphicon glyphicon-time"></span><?php echo $closeIn;?> dias
    	<?php endif; ?>

      <?php if($closeIn == 0) : ?>
        <span class="text-danger"><span class="glyphicon glyphicon-time"></span><?php echo $hours;?></span>
      <?php endif; ?>

      <?php if($closeIn < 0) : ?>
    		Terminado
    	<?php endif;?>
    </div>
  </header>


  <div class="panel-body">
  	<div class="panel-thumb"><img src="<?php get_image_url(); ?>" alt="" /></div>

    <?php echo $postMeta["proj_resumo"][0];?>
	
	<div class="panel-value-status">
      <div class="panel-value-status-container">
        <div class="panel-value-status-bar" style="width:<?php echo ($angariadoPercent > 100)? 100 : $angariadoPercent;?>%;"><span><?php echo $angariadoPercent;?>%</span></div>
      </div>
      <div class="panel-value-angariado pull-left"><?php echo $postMeta["proj_total_angariado"][0];?>€</div>
      <div class="panel-value-angariar pull-right"><?php echo $postMeta["proj_total_angariar"][0];?>€</div>
    </div>

  </div>


  <footer class="panel-footer">

    <div class="btn-group btn-group-justified">
      <div class="btn-group">
	    <a class="btn btn-success">
	      <i class="glyphicon glyphicon-euro"></i>
	      Apoiar</a>
	  </div>
	  <div class="btn-group">
	    <a class="btn btn-primary" href="<?php the_permalink(); ?>">
	      <i class="glyphicon glyphicon-plus"></i>
	      Ver mais</a>
	  </div>
	</div><!--/goup container -->

  </footer>
</article>