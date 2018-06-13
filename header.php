<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package name
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M4N4F7L');</script>
<!-- End Google Tag Manager -->


	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="shortcut icon" href="https://peru.itinero.travel/wp-content/themes/name/img/favicon.png" type="image/png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(function() {
		$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
		$('#toTop').fadeIn();
		} else {
		$('#toTop').fadeOut();
		}
		});
		$('#toTop').click(function() {
		$('body,html').animate({scrollTop:0},800);
		});
		});
    </script>
	<!--[if lt IE 9]>
	<script>
		document.createElement('header');
		document.createElement('nav');
		document.createElement('main');
		document.createElement('section');
		document.createElement('article');
		document.createElement('aside');
		document.createElement('footer');
	</script>
	<![endif]-->

	<?php wp_head(); ?>
    <script type="text/javascript">
        function getURLParameter(name) {
            return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null;
        }

        $(document).ready(function () {

            utm = [];
            $.each(["utm_source", "utm_medium", "utm_content", "utm_campaign", "utm_term", 'source_type', 'source', 'position_type', 'position', 'added', 'creative', 'matchtype'], function (i, v) {
                utm[v] = getURLParameter(v) || $.cookie(v) || '';
                $.cookie(v, utm[v], {
                    expires: 1,
                    path: '/'
                });
            });
        });
    </script>


</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4N4F7L"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<header class="header">
		<div class="header__nav row">
			<div class="case row">
				<div class="header__logo col"><a href="http://itinero.travel/"><img src="<?php the_field('логотип', option); ?>" alt=""></a></div>
				<div class="header__nav-wrap col">
					
<?php wp_nav_menu( array('menu' => 'top-pc-menu' )); ?>
				</div>
				<div class="header__phone col"><a href="tel:<?php the_field('телефон_без_редактирования', option); ?>"><?php the_field('телефон', option); ?></a></div>
				
				<a data-fancybox data-src="#popup-question" href="javascript:;" class="header__btn-question btn btn_orange btn_small col right">Задать вопрос организатору</a>
				<div class="header__mobile-btn">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		</div>
		<div class="header__content">
			<div class="case row">
				<div class="header__desc col"><?php the_field('главный_экран_описание'); ?></div>
				<div class="header__wrap col right">
					<div class="header__title title"><span><?php the_field('главный_экран_заголовок'); ?></span><img src="upload/text/text-header.png" alt=""></div>
					<div class="header__list"><?php the_field('главный_экран_список'); ?></div>
					<div class="header__date"><span class="text">Даты: </span><span class="yellow"><?php the_field('главный_экран_даты'); ?></span></div>
					<a data-fancybox href="#popup-plan" href="javascript:;" class="header__btn-plan btn btn_orange btn_pdf btn_radius" download><span>Скачать план путешествия</span></a>
				</div>
			</div>
		</div>
	</header>


<?php wp_reset_query();?>