<?php get_header(); ?>

<div class="pageContainer">
  <div class="container ">
  	<div class="row">
      <?php  if(have_posts()) : while(have_posts()) : the_post(); ?>
      				<div class="col-12"> <h1 class="pageTitle">
                       		<?php the_title(); ?>
                       </h1>
                   </div>
                   <div class="col-12">


                       <?php the_content(); ?>
                    </div>


                <?php endwhile; endif; ?>
        </div>
      </div>

</div>
<?php get_footer(); ?>