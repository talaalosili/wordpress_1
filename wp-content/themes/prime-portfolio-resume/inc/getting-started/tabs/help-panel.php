<?php
/**
 * Help Panel.
 *
 * @package Prime_Portfolio_Resume
 */
?>

<div id="help-panel" class="panel-left visible">

    <div class="panel-aside active">
        <h4><?php printf( esc_html__( ' VISIT FREE DOCUMENTATION', 'prime-portfolio-resume' )); ?></h4>
        <p><?php esc_html_e( 'Are you a newcomer to the WordPress universe? Our comprehensive and user-friendly documentation guide is designed to assist you in effortlessly building a captivating and interactive website, even if you lack any coding expertise or prior experience. Follow our step-by-step instructions to create a visually appealing and engaging online presence.', 'prime-portfolio-resume' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( PRIME_PORTFOLIO_RESUME_FREE_DOC_URL ); ?>" title="<?php esc_attr_e( 'Visit the Documentation', 'prime-portfolio-resume' ); ?>" target="_blank">
            <?php esc_html_e( 'FREE DOCUMENTATION', 'prime-portfolio-resume' ); ?>
        </a>
    </div>

    <div class="panel-aside " >
        <h4><?php esc_html_e( 'Review', 'prime-portfolio-resume' ); ?></h4>
        <p><?php esc_html_e( 'If you are passionate about the Prime Portfolio Resume theme, we would love to hear your thoughts and feedback regarding our theme. Your review will be highly valuable to us as we strive to enhance and improve our theme based on the needs and preferences of our users. Your opinion matters, and we sincerely appreciate your time and effort in sharing your experience with the Prime Portfolio Resume theme.', 'prime-portfolio-resume' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( PRIME_PORTFOLIO_RESUME_REVIEW_URL ); ?>" title="<?php esc_attr_e( 'Visit the Review', 'prime-portfolio-resume' ); ?>" target="_blank">
            <?php esc_html_e( 'REVIEW', 'prime-portfolio-resume' ); ?>
        </a>
    </div>
    
    <div class="panel-aside">
        <h4><?php esc_html_e( 'CONTACT SUPPORT', 'prime-portfolio-resume' ); ?></h4>
        <p>
            <?php esc_html_e( 'Thank you for choosing Prime Portfolio Resume! We appreciate your interest in our theme and are here to assist you with any support you may need.', 'prime-portfolio-resume' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( PRIME_PORTFOLIO_RESUME_SUPPORT_URL ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'prime-portfolio-resume' ); ?>" target="_blank">
            <?php esc_html_e( 'CONTACT SUPPORT', 'prime-portfolio-resume' ); ?>
        </a>
    </div>

    
</div>