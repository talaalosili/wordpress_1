<?php
/**
 * Right Buttons Panel.
 *
 * @package Prime_Portfolio_Resume
 */
?>
<div class="panel-right">
	<div class="prime-portfolio-resume-button-container">
		<a target="_blank" href="<?php echo esc_url( PRIME_PORTFOLIO_RESUME_DEMO_URL ); ?>" class="button button-primary solo1">
			<?php esc_html_e("THEME DEMO", "prime-portfolio-resume"); ?>
		</a>
		<a target="_blank" href="<?php echo esc_url( PRIME_PORTFOLIO_RESUME_URL ); ?>" class="button button-primary solo2">
			<?php esc_html_e("GO PRO", "prime-portfolio-resume"); ?>
		</a>
		<a target="_blank" href="<?php echo esc_url( PRIME_PORTFOLIO_RESUME_PRO_DOC_URL ); ?>" class="button button-primary solo1">
			<?php esc_html_e("PRO DOCUMENTATION ", "prime-portfolio-resume"); ?>
		</a>
	</div>
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Upgrade To Pro', 'prime-portfolio-resume' ); ?></h4>
		<p><?php esc_html_e( '', 'prime-portfolio-resume' ); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( PRIME_PORTFOLIO_RESUME_URL ); ?>" title="<?php esc_attr_e( 'View Premium Version', 'prime-portfolio-resume' ); ?>" target="_blank">
            <?php esc_html_e( 'Read more about the features here', 'prime-portfolio-resume' ); ?>
        </a>
	</div>
</div>