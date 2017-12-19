<?php get_header(); ?>

<div class="topLogo">
	<img src="http://aissaian.loc/wp-content/uploads/2017/12/Aissaian-logo-blue-one.jpg" />
	
</div>

<div class="container partnerContainer pageContainer">

	<?php if (have_posts()): while (have_posts()): the_post(); ?>

		<div class="row partnerRow">

			<div class="col-12 col-md-5 contentHolder">

				<h2 class="partnerTitle pageTitle"><?php the_title(); ?></h2>

				<div class="partnerContent">
					<?php the_content(); ?>
				</div>
				<div class="parnerMeta">
					<?php if (get_post_meta($post->ID,'_partnerwebsite')) { ?>
                         <a class="websiteLink" href="<?php echo get_post_meta($post->ID,'_partnerwebsite')[0]; ?>" target="_blank"><?php _e('VISIT PARTNER\'S WEBSITE','asn_lang'); ?></a>
                       <?php  } ?><br/>
					<?php if (get_post_meta($post->ID,'_partnerslink')) { ?>
                         <a class="catalogLink" href="<?php echo get_post_meta($post->ID,'_partnerslink')[0]; ?>" target="_blank"><?php _e('VIEW CATALOG','asn_lang'); ?></a>
                       <?php  } ?>
				</div>
			</div>
			<div class="col-12 col-md-7 imageHolder">
				<?php the_post_thumbnail('post-thumbnail', ['class' => 'img-responsive responsive--full', 'title' => 'Feature image']); ?>
			</div>
		</div>

	<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>