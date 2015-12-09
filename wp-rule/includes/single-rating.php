<?php
/**
 * The Template for displaying Review post rating.
 *
 * @package WordPress
 * @subpackage Pravda
 * @since Pravda 1.0
 */
?>

<?php
$post_type = get_post_meta($post->ID, 'ct_mb_post_type', true);
if( $post_type == '' ) $post_type = 'standard_post';
?>

<?php if( $post_type == 'review_post' ) : ?>
	<div class="review-block">
		<div class="overall_score">
			<?php

				$overall_name = get_post_meta( $post->ID, 'ct_mb_over_name', true); 
				$overall_score = get_post_meta( $post->ID, 'ct_mb_over_score', true);
				$overall_score_color = get_post_meta( $post->ID, 'ct_mb_overall_color', true);

				// Criteria #1 and Score #1
				$c1_name = get_post_meta( $post->ID, 'ct_mb_criteria1_name', true);
				$c1_score = get_post_meta( $post->ID, 'ct_mb_criteria1_score', true);

				// Criteria #2 and Score #2
				$c2_name = get_post_meta( $post->ID, 'ct_mb_criteria2_name', true);
				$c2_score = get_post_meta( $post->ID, 'ct_mb_criteria2_score', true);

				// Criteria #3 and Score #3
				$c3_name = get_post_meta( $post->ID, 'ct_mb_criteria3_name', true);
				$c3_score = get_post_meta( $post->ID, 'ct_mb_criteria3_score', true);

				// Criteria #4 and Score #4
				$c4_name = get_post_meta( $post->ID, 'ct_mb_criteria4_name', true);
				$c4_score = get_post_meta( $post->ID, 'ct_mb_criteria4_score', true);

				// Criteria #5 and Score #5
				$c5_name = get_post_meta( $post->ID, 'ct_mb_criteria5_name', true);
				$c5_score = get_post_meta( $post->ID, 'ct_mb_criteria5_score', true);

				// Summary
				$summary = get_post_meta( $post->ID, 'ct_mb_summary', true);

				if ( empty( $overall_score_color ) ) $overall_score_color = '#000';

				echo '<span class="score_name">' . $overall_name . '</span>'; 
				echo '<span class="score_value colored-title" style="background-color:' . $overall_score_color .';">' . $overall_score . '</span>'; 
			?>
			
			<ul class="score-list">
				<?php if ($c1_score != 0 ) : ?>
					<li class="clearfix">
						<?php 
						echo '<span class="criteria_name">' . $c1_name . '</span>';
						echo '<div class="rating-stars no-right-margin">';
						echo ct_get_single_rating ( $c1_score, $post->ID );
						echo '</div>';	
						?>
					</li>
				<?php endif; ?>

				<?php if ($c2_score != 0 ) : ?>
					<li class="clearfix">
						<?php 
						echo '<span class="criteria_name">' . $c2_name . '</span>';
						echo '<div class="rating-stars no-right-margin">';
						echo ct_get_single_rating ( $c2_score, $post->ID );
						echo '</div>';	
						?>
					</li>
				<?php endif; ?>

				<?php if ($c3_score != 0 ) : ?>
					<li class="clearfix">
						<?php 
						echo '<span class="criteria_name">' . $c3_name . '</span>';
						echo '<div class="rating-stars no-right-margin">';
						echo ct_get_single_rating ( $c3_score, $post->ID );
						echo '</div>';	
						?>
					</li>
				<?php endif; ?>

				<?php if ($c4_score != 0 ) : ?>
					<li class="clearfix">
						<?php 
						echo '<span class="criteria_name">' . $c4_name . '</span>';
						echo '<div class="rating-stars no-right-margin">';
						echo ct_get_single_rating ( $c4_score, $post->ID );
						echo '</div>';	
						?>
					</li>
				<?php endif; ?>

				<?php if ($c5_score != 0 ) : ?>
					<li class="clearfix">
						<?php 
						echo '<span class="criteria_name">' . $c5_name . '</span>';
						echo '<div class="rating-stars no-right-margin">';
						echo ct_get_single_rating ( $c5_score, $post->ID );
						echo '</div>';	
						?>
					</li>
				<?php endif; ?>

				<?php if ( $summary != '' ) : ?>
					<li class="clearfix summary-review" style="background-color:<?php echo $overall_score_color; ?>;">
						<?php echo $summary; ?>
					</li>
				<?php endif; ?>
			</ul> <!-- /score-list -->
		<div class="clear"></div>
	</div>	<!-- /overall_score -->	 
</div>	<!-- /review-block -->
<?php endif; //review_post ?>
