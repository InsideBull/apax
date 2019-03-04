<?php /* Template name: Liste équipe */ ?>
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
				
				<?php echo get_custom_categories(); ?>
				
			</div>
		</div>
	</div>
	
	<?php $ele = get_posts("post_type=team&posts_per_page=-1&orderby=menu_order&order=ASC&suppress_filters=0");
	if (count($ele)): ?>
	
	<div class="grid row no-gutters list-no-gutters">
		
		<?php foreach ($ele as $e): ?>
		
		<?php $cat = get_the_terms($e->ID, "category");
		if ($cat) {
			$strCat = '';
			foreach ($cat as $c) {
				$strCat .= ($strCat==""?"":" ").'cat-item-'.$c->term_id;
			}
		} ?>
		
		<div class="col-md-3 col-sm-6 col-xs-12 grid-item <?php echo $strCat; ?>">
			<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($e->ID), 'image-push' ); ?>
			<?php $poste_membre_equipe = get_field("poste_membre_equipe",$e->ID); ?>
			<a href="<?php echo get_permalink($e->ID); ?>" class="bloc-ele" style="<?php echo $thumb ? 'background-image: url('.$thumb[0].');' : ''; ?>">
				<?php echo $thumb ? '<img src="'.$thumb[0].'" alt="" />' : ''; ?>
				<span class="title"><?php echo $e->post_title; ?></span>
				<?php if ($poste_membre_equipe != "" || $e->post_title != "") {
					echo '<span class="name"><span>';
					echo $e->post_title != "" ? $e->post_title.'<br/>' : '';
					echo $poste_membre_equipe != "" ? $poste_membre_equipe : '';
					echo '</span></span>';
				} ?>
			</a>
		</div>
		<?php endforeach; ?>
	</div>
	
	<?php endif; ?>
	
	<div class="row">
		<div class="col-md-offset-3 col-md-3">
			<a href="<?php echo get_permalink(get_the_id_wpml(139)); ?>" class="show_all_list">
				<?php _e("All companies","apax"); ?>
				<?php _e("of our","apax"); ?>
				<span><?php _e("portfolio","apax"); ?></span><br/>
				<img src="<?php bloginfo("template_url"); ?>/img/link-more-list.png" alt="" />
			</a>
		</div>
		<div class="col-md-3">
			<a href="<?php echo get_permalink(get_the_id_wpml(5143)); ?>" class="show_all_list">
				<?php _e("See ","apax"); ?><span><?php _e("history","apax"); ?></span>
				<?php _e("of companies currently supported","apax"); ?><br/>
				<img src="<?php bloginfo("template_url"); ?>/img/link-more-list.png" alt="" />
			</a>
		</div>
	</div>
	
</div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>