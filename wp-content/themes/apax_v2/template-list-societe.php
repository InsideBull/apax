<?php /* Template name: Liste société */ ?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="post">
				<h1 class="post-title"><?php the_title(); ?></h1>
				<?php $sous_titre = get_field("sous-titre_page");
				if ($sous_titre && $sous_titre != "") {
					echo '<div class="baseline">'.$sous_titre.'</div>';
				} ?>
				
				<?php echo get_custom_categories('33,34'); ?>
				
			</div>
		</div>
	</div>
	
	<?php $ele = get_posts("post_type=societe&posts_per_page=-1&orderby=title&order=ASC&suppress_filters=0");
	include "template/list-societe-no-gutters.php"; ?>
		
	<div class="row">
		<div class="col-md-offset-4 col-md-4">
			<a href="<?php echo get_permalink(get_the_id_wpml(5143)); ?>" class="show_all_list">
				<?php if (ICL_LANGUAGE_CODE == "en"): ?>				
				<?php _e("Previously","apax"); ?>
				<span><?php _e("supported","apax"); ?></span><br/>
				<?php _e("companies","apax"); ?>
				<?php else: ?>
				<?php _e("Voir l'","apax"); ?><span><?php _e("historique","apax"); ?></span><br/>
				<?php _e("des sociétés accompagnées","apax"); ?>
				<?php endif; ?>
			</a>
		</div>
	</div>
	
</div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>