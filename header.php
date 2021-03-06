<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>

<!-- character encoding utf-8 -->
<meta charset="<?php bloginfo( 'charset' ); ?>">

<!-- google chrome frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">

<!-- title -->
<title><?php
// if tag
if( function_exists( 'is_tag' ) && is_tag() ) :
  single_tag_title( 'Tag Archive for &quot;' ); echo '&quot; - ';

// if archives
elseif( is_archive() ) :
  esc_attr( wp_title( '' ) ); echo ' '; echo 'Archive -';

// if search
elseif( is_search() ) :
  echo 'Search for &quot;' . wp_specialchars( $s ) . '&quot; -';

// if !404 and single or page
elseif( !( is_404() ) && ( is_single() ) || ( is_page() ) ) :
  esc_attr( wp_title( '' ) ); echo '-';

// if 404
elseif( is_404() ) :
  echo 'Not Found -';
endif;

//if home
if( is_home() ):
  esc_attr( bloginfo( 'name' ) ); echo '-'; esc_attr( bloginfo( 'description' ) ); echo '-'; esc_attr( wp_title() );
else :
  esc_attr( bloginfo( 'name' ) );
endif;

// if pages is greater than 1
if( $paged > 1 ) :
  echo '-page' . $paged;
endif; ?></title>

<!-- search engine robots meta instructions -->
<?php if ( is_search() || is_404() ) : ?>
<meta name="robots" content="noindex, nofollow">
<?php else: ?>
<meta name="robots" content="all">
<?php endif; ?>

<!-- index search meta data -->
<?php if ( is_home() ) : ?>
<meta name="description" content="<?php esc_attr( bloginfo( 'name' ) ); esc_attr( bloginfo( 'description' ) ); ?>">
<!-- single page meta tag description -->
<?php elseif ( is_single() ) : ?>
<meta name="description" content="<?php esc_attr( wp_title() ) ?>">
<!-- archive pages meta tag description -->
<?php elseif ( is_archive() ) : ?>
<meta name="description" content="">
<?php elseif ( is_search() ) : ?>
<meta name="" content="<?php wp_specialchars( $s ) ?>">
<!-- fallback meta tag description -->
<?php else : ?>
<meta name="description" content="<?php esc_attr( bloginfo( 'name' ) ); esc_attr( bloginfo( 'description' ) ) ?>">
<?php endif; ?>

<!-- Mobile viewport optimized: h5bp.com/viewport -->
<meta name="viewport" content="width=device-width">

<!-- http://t.co/dKP3o1e -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">

<!-- Sets whether a web application runs in full-screen mode -->
<meta name="apple-mobile-web-app-capable" content="yes">

<!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
<!-- base css -->
<link rel="stylesheet" media="screen" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<!-- pingback url -->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- RSS Feed -->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo( 'rss2_url' ); ?>" />

<!-- All JavaScript at the bottom, except this Modernizr. Modernizr enables HTML5 elements & feature detects;
         for optimal performance, create your own custom Modernizr build: www.modernizr.com/download/ -->
<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.6.1.min.js"></script>

<?php //required comment functionality ?>
<?php if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); } ?>

<!-- coments popup script -->
<?php comments_popup_script(); ?>

<?php wp_head(); //required for all wordpress themes and placed at the end of the head tag element ?>
</head>

<!-- body element tag -->
<?php if ( is_single() ) : ?>
<body <?php body_class(); ?> id="wpflex-single">
<?php elseif ( is_home() ) : ?>
<body <?php body_class(); ?> id="wpflex-index">
<?php else : ?>
<body <?php body_class(); ?> id="wpflex-<?php the_title(); ?>">
<?php endif; ?>
<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6. chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

<header id="wpflex-header" role="banner">
  <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" usemap="#Map">
  <h1><a href="<?php echo home_url();  ?>"><?php esc_attr( bloginfo( 'name' ) ); ?></a></h1>
  <h2><?php echo esc_attr( bloginfo( 'description' ) ); ?></h2>
  <!-- end header custom image -->

  <!-- http://codex.wordpress.org/Function_Reference/wp_nav_menu -->
  <nav role="navigation">
    <ol>
      <?php
      //wp_list_pages arguments as an array
      $nav_wpflex = array(
        'depth'         => 2,
        'show_date'     => '',
        'date_format'   => get_option( 'date_format' ),
        'child_of'      => 0,
        'exclude'       => '',
        'include'       => '',
        'title_li'      => '',
        'echo'          => 1,
        'authors'       => '',
        'sort_column'   => 'menu_order',
        'link_before'   => '',
        'link_after'    => '',
        'walker'  => ''
        );

      //begin wp_list_pages loop
      if( wp_list_pages( $nav_wpflex ) ) : while ( wp_list_pages( $nav_wpflex ) ) :
        //list items from the array above
        wp_list_pages( $nav_wpflex );
      endwhile;
      endif;
      ?>
    </ol>
  </nav>
  <?php //endif; ?>

</header>

<article><a href="<?php bloginfo('rss2_url') ?>">RSS Feed</a></article>

<?php //required call for search-form ?>
<?php get_search_form(); ?>