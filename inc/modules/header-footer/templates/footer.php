<?php
do_action( 'hop_ekit/header_footer/template/before_footer' ); ?>
<div class="hop-ekit__footer">
	<div <?php
	do_action( 'hop_ekit/modules/header_footer/template/attributes', 'footer' ); ?>>
		<?php
		do_action( 'hop_ekit/modules/header_footer/template/footer' ); ?>
	</div>
</div>
<?php
do_action( 'hop_ekit/header_footer/template/after_footer' ); ?>
<?php
wp_footer(); ?>
</body>
</html>
