<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package name
 */

?>

	<footer class="footer">
		<div class="case row">
			<div class="footer__logo col"><a href="http://itinero.travel/"><img src="<?php the_field('логотип', option); ?>" alt=""></a></div>
			<div class="footer__socials col">
				<ul>
					<li><a href="//<?php the_field('vk', option); ?>" target="_blank"><i class="icon icon-vk"></i></a></li>
					<li><a href="//<?php the_field('fb', option); ?>" target="_blank"><i class="icon icon-fb"></i></a></li>
					<li><a href="//<?php the_field('instagram', option); ?>" target="_blank"><i class="icon icon-insta"></i></a></li>
					<li><a href="//<?php the_field('youtube', option); ?>" target="_blank"><i class="icon icon-yt"></i></a></li>
				</ul>
			</div>
			<div class="footer__data col right row_line">
				<div class="footer__phone col_line"><a href="tel:<?php the_field('телефон_без_редактирования', option); ?>"><?php the_field('телефон', option); ?></a></div>
				<a data-fancybox data-src="#popup-question" href="javascript:;" class="footer__btn btn btn_orange btn_small col_line">Задать вопрос организатору</a>
			</div>
		</div>
		<div id="toTop">Вверх</div>
	</footer>
	<div class="popup popup_callback" id="popup-callback">
		<div class="popup__title">Заказать обратный звонок</div>
		<div class="popup__wrap">
			<div class="form"><?php the_field('форма_обратный_звонок', option); ?></div>
		</div>
	</div>
	<div class="popup-zakon popup_callback" id="popup-zakon">
		<div class="popup__title">Согласие на обработку персональных данных</div>
		<div class="">
			<div>Предоставляя свои персональные данные Пользователь даёт согласие на обработку, хранение и использование своих персональных данных на основании ФЗ № 152-ФЗ «О персональных данных» от 27.07.2006 г. в следующих целях:
<br>
Осуществление клиентской поддержки
Получения Пользователем информации о маркетинговых событиях
Проведения аудита и прочих внутренних исследований с целью повышения качества предоставляемых услуг.
<br>Под персональными данными подразумевается любая информация личного характера, позволяющая установить личность Пользователя/Покупателя такая как:
<br>
Фамилия, Имя, Отчество<br>
Дата рождения<br>
Контактный телефон<br>
Адрес электронной почты<br>
Почтовый адрес<br>
Персональные данные Пользователей хранятся исключительно на электронных носителях и обрабатываются с использованием автоматизированных систем, за исключением случаев, когда неавтоматизированная обработка персональных данных необходима в связи с исполнением требований законодательства.
<br>
Компания обязуется не передавать полученные персональные данные третьим лицам, за исключением следующих случаев:<br>

По запросам уполномоченных органов государственной власти РФ только по основаниям и в порядке, установленным законодательством РФ
Стратегическим партнерам, которые работают с Компанией для предоставления продуктов и услуг, или тем из них, которые помогают Компании реализовывать продукты и услуги потребителям. Мы предоставляем третьим лицам минимальный объем персональных данных, необходимый только для оказания требуемой услуги или проведения необходимой транзакции.<br>
Компания оставляет за собой право вносить изменения в одностороннем порядке в настоящие правила, при условии, что изменения не противоречат действующему законодательству РФ. Изменения условий настоящих правил вступают в силу после их публикации на Сайте.</div>
		</div>
	</div>

	<div class="popup popup_callback" id="popup-plan">
		<div class="popup__title">Скачать план путешествия</div>
		<div class="popup__wrap">
			<div class="form"><?php the_field('скачать_план', option); ?></div>
		</div>
	</div>
	<div class="popup popup_question" id="popup-question">
		<div class="popup__title">Задать вопрос организатору</div>
		<div class="popup__wrap">
			<div class="form"><?php the_field('форма_задать_вопрос_организатору', option); ?></div>
		</div>
	</div>
	<div class="popup popup_thanks" id="popup-thanks">
		<div class="popup__title">Спасибо!</div>
		<div class="popup__wrap">Вам перезвонит организатор.</div>
	</div>
	<div class="popup popup_thanks" id="popup-thanks-2">
		<div class="popup__title">Спасибо!</div>
		<div class="popup__wrap">Ваш вопрос отправлен!</div>
	</div>
</body>
</html>



	<script src="<?php echo get_template_directory_uri(); ?>/scripts/libs.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/scripts/common.js"></script>
<?php wp_footer(); ?>

</body>
</html>
