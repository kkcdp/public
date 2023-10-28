<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<!doctype html>
<html <?php language_attributes(); ?> <?php pdg_element_attributes( 'html' ); ?>>
    <head>
		<?php get_template_part( 'template-parts/head/meta' ); ?>

		<?php wp_head(); ?>

		<?php get_template_part( 'template-parts/head', 'additional' ); ?>
	</head>
	<body <?php body_class(); ?> <?php pdg_element_attributes( 'body' ); ?>>
		<?php wp_body_open(); ?>

		<div class="site-wrap">