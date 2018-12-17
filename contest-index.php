<?php if (!is_user_logged_in() ) :
	wp_redirect( $cek->home.'/logowanie' );
	exit;
endif; ?>

<?php 
$actualDate = current_time( 'mysql' );
?>
<?php $rowCount = $wpdb->get_var("SELECT * FROM wp_contest_results WHERE user_id=".get_current_user_id());?>

<?php global $cek; ?>
<?php global $contest; ?>
<?php global $employee; ?>
<?php $current_user = wp_get_current_user(); ?>

<div class="front-page--after-login">

	<section class="section section--prizes">
		<div class="container">
			<?php get_template_part('partials/head', 'top'); ?>
			<div class="section__wrap">
				<div class="section__data">
					<div class="prize">
						<div class="prize-decription">
							<?php 
								if( $rowCount > 0 ){
									echo '<div class="prize__title">
									Brałeś już udział w <span class="green">konkursie</span><br>Wyniki zostaną ogłoszone wkrótce.</div>';
								} else {
									echo '<div class="prize__title">
										Włącz <span class="green">ekomyślenie</span><br/>
										i weź udział w konkursie,<br/>
										by wygrać <span class="green">super nagrody</span>!
									</div>
									<div class="prize__btn-wrap">
										<a href="'.$cek->home.'/quiz"><button class="btn btn--green">Start</button></a>
										<a href="http://akumulator.pl/kampaniaedukacyjna/" target="_blank" class="link link--white">Czytaj więcej</a>
									</div>';
								}
							?>
						</div>
						<div class="prize__image-wrap">
							<img src="<?php echo $cek->assets; ?>/img/awards.png" alt="" class="prize__image">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header__eko-mind">
			<img src="<?php echo $cek->assets; ?>/img/new-img/header-eko.png" alt="" class="eko-mind__image">
		</div>
	</section>
	<section class="section section--content green-separator">
		<div class="container">
			<div class="think__eko-wrap">
				<div class="think__eko-title">
					Co wiesz o <br><span class="green">eko myśleniu</span> ?
				</div>
				<div class="think__eko-description">
					Aby uzyskać jak najlepszy wynik, musisz znać <br> eko myślenie. Czy jesteś gotowy?
				</div>
				<div class="think__eko-button">
					<a href="http://akumulator.pl/kampaniaedukacyjna/" target="_blank"><button class="btn btn--green">odwiedź ekomyślenie.pl</button></a>
				</div>
			</div>
		</div>
	</section>

	<?php get_footer(); ?>
</div>