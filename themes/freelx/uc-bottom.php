<div class="bottom">
	<div class="menu">
		<?php 
          $destMenu = wp_nav_menu(
            array( 'sort_column' => 'menu_order', 
                 'menu_class' => 'homeNav', 
                 'theme_location' => 'bottom-menu'
                 )
           );
        ?>
	</div>

	<div class="paypal">
		<img src="<?php echo get_stylesheet_directory_uri();?>/images/logo_paypal.png" /><br />
		Pague as suas compras de forma segura com Paypal.
	</div>
</div>