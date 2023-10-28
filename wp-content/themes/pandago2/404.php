<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php get_header(); ?>

<div class="c-404 container text-center">
    <h1 class="c-404__title">404</h1>

    <h2 class="c-404__sub-title h3"><?php _e( 'Lapa netika atrasta!', 'pandago' ); ?></h2>

    <p class="c-404__message"><?php _e( 'Radusies kāda tehniska kļūda, vai arī šī lapa vairs nav pieejama.', 'pandago' ); ?></p>

    <div class="c-404__btn-wrap">
        <a class="btn btn--primary" href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Uz sākumlapu', 'pandago' ); ?></span></a>
    </div>
</div>

<?php get_footer(); ?>