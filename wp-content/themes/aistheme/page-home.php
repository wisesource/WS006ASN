<?php get_header(); ?>

     <div class="bannerSection">
      <div id="bannerIndicator" class="carousel slide" data-ride="carousel">
         <?php
			$banner_a = array (  
				'post_type' => 'banner',
				'order'     =>  'ASC',
				'posts_per_page'=>  '-1',
			);            
			$banner_q = new WP_Query($banner_a);
		?>
		<ol class="carousel-indicators">
			<?php 
			if ($banner_q->have_posts() && $banner_q->count > 1) {				
				$j=0;				
				while($banner_q->have_posts()) {
					$banner_q->the_post(); ?>					
					<li data-target="#bannerIndicator" data-slide-to="<?php echo $j; ?>"  ></li>
					<?php $j++; 			   } 
			}			wp_reset_postdata();  
			?> 
        </ol>
        <div class="carousel-inner">
          <?php 		  
            $banner_a = array (
                'post_type' =>  'banner',
                'order'     =>  'ASC',
                'posts_per_page'=>  '-1',
            );
            $banner_q = new WP_Query($banner_a);
            if($banner_q->have_posts()) {				$i = 0;
                while($banner_q->have_posts()) {					$banner_q->the_post(); ?>
					<div class="carousel-item <?php echo (!$i)? 'active' : ''; ?>">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('original', array('class' => 'd-block w-100'));
						} ?>
						<div class="carousel-caption">
						  <?php the_content(); ?>
						</div>
					</div>
                 <?php $i++; }
            } else {
            };
            /* Restore original Post Data */
            wp_reset_postdata();    
        ?>
        </div>		<?php if($banner_q->post_count > 1 ): ?>
        <a class="carousel-control-prev" href="#bannerIndicator" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#bannerIndicator" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>		<?php endif; ?>		
      </div>       
     </div> 

     <div class="homeAboutSection">



     </div>
     
     <div class="homePartnersSection">
     </div>





     <?php get_footer(); ?>