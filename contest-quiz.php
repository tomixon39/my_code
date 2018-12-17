<?php global $cek; ?>
<?php 
$actualDate = current_time( 'mysql' );
if( $actualDate >= '2018-12-01 23:59:59' ) :
	wp_redirect( $cek->home.'/koniec-konkursu' );
	exit;
endif;

$rowCount = $wpdb->get_var("SELECT * FROM wp_contest_results WHERE user_id=".get_current_user_id());

if ( !is_user_logged_in() || $rowCount > 0 ) : 
	wp_redirect( $cek->home );
	exit;
endif; ?>
<?php get_header(); ?>
<?php
/***********************************/
/* Template Name: Quiz */
/***********************************/
?>
<?php $current_user = wp_get_current_user(); ?>

<section class="section section--contest">
	<div class="container">
		<?php get_template_part('partials/head', 'top'); ?>
		<div class="contest">
			<div class="contest-wrap">
				<form id="form-question" mathod="POST">
					<div class="counter-wrap">
						<div class="contest-counter">
							<div class="item current-question-index"></div>
							<span class="green quanity">/</span>
						</div>
						<div class="contest-clock">
							<img src="<?php echo $cek->assets; ?>/img/new-img/clock.png" alt="" class="clock-ikon">
							<span class="clock time-last"></span>
						</div>	
					</div>
					<div class="question__item-wrap">
						<?php $questions = $wpdb->get_results("SELECT * FROM wp_contest_questions"); $i=0; ?>
							<?php foreach ($questions as $question) : ?>
							<div class="question__item <?php echo ($i===0) ? 'is-active' : '' ; ?>">
								<?php $answers = $wpdb->get_results("SELECT * FROM wp_contest_answers WHERE question_id = " . $question->ID); ?>
								<div class="question" data-question-id="<?php echo $question->ID; ?>"><?php echo $question->name ?></div>
								<div class="validate-answer"></div>
									<div class="answers">
										<?php shuffle($answers);?>
										<?php foreach ($answers as $answer) : ?>
											<div class="answer-item">
												<label class="label" onclick="clearNoAnswerError()">
													<input type="radio" class="inp-radio" name="answer-question-<?php echo $question->ID; ?>" value="<?php echo $answer->ID; ?>" > <?php echo $answer->name; ?>
													<span class="checkmark"></span>
												</label>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
						<?php $i++; endforeach; ?>
					</div>
					<?php wp_nonce_field('send_quiz', 'send_quiz_nonce_field'); ?>
				</form>
				<div class="question__btn-wrap">
					<a href="#" class="link link--white js-prev-question js-rem">Poprzednie pytanie</a>
					<button type="button" class="btn btn--green js-next-question js-rem">Następne</button>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
