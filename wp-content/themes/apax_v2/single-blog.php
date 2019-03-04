<?php get_header();
$translate_axe = [
	'en' => [
		1 => 'International',
		2 => 'External growth',
		3 => 'Digital transformation ',
	],
	'fr' => [
		1 => 'International',
		2 => 'Croissance externe',
		3 => 'Transformation digitale',
	],
];

global $post_list;

$related_meta_keys = [
	'entreprise_blog',
	'secteur_blog',
	'axe_blog',
	'associes_blog',
];

$post_list = null;
foreach ($related_meta_keys as $meta_key) {
	$ids = wp_list_pluck( $post_list->posts, 'ID' );
	$ids[] = get_the_ID(); // Exclude current post
	if($post_list == null || count($post_list->posts) < 3){ // If not enough post add next meta_key's associated posts
		$add_post_list = new WP_Query([
			'post_type' => 'blog',
			'posts_per_page' => $count,
			'meta_key'=> $meta_key,
			'meta_value'=> get_post_meta(get_the_ID(), $meta_key, true),
			'post__not_in' => $ids,
		]);
		if($post_list->posts != null){ // If already initialised
			$post_list->posts = array_merge( $post_list->posts, $add_post_list->posts );// Merge results
		}else{
			$post_list = $add_post_list;
		}
	}
}

?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="post">
				<a href="<?= get_post_type_archive_link('blog') ?>" class="col-lg-offset-1" title="<?php _e("Back to blogs list","apax"); ?>" id="link_back"></a>
				<?php $sous_titre = get_field("sous-titre_page"); ?>
				<h1 class="post-title<?php echo $sous_titre && $sous_titre != "" ? '' : ' no-baseline'; ?>"><img src="<?= get_template_directory_uri() ?>/img/apax-blog-logo.svg" alt="Apax Blog"></h1>
				<?php if ($sous_titre && $sous_titre != "") {
					echo '<div class="baseline">'.$sous_titre.'</div>';
				} ?>
			</div>
		</div>
	</div>

	<?php $ancres = get_field("menu_dancre");
	if ($ancres) echo '<div class="row" id="lstancres"><div class="col-lg-offset-1 col-md-7"><div class="post"><div class="post-content">'.$ancres.'</div></div></div></div>'; ?>

	<div class="row">
	
		<?php if ($post_list->have_posts()): ?>
		<div class="col-lg-offset-1 col-lg-7 col-md-8">
		<?php else: ?>
		<div class="col-lg-offset-2 col-lg-8 col-md-8">
		<?php endif; ?>
		
			<?php include "template/addthis-blog.php"; ?>
			<?php if (is_single()) {
				echo '<div class="post">
					<div class="post-content">
						<h2>'.get_the_title().'</h2>
					</div>
				</div>';
			} ?>

			<?php get_template_part("flex","content"); ?>
			<div class="clear"></div><div class="separator"></div>
			<div class="badge-list">
				<a class="badge" href="<?php echo get_post_type_archive_link('blog').'?meta_key=entreprise_blog&meta_value='.urlencode(get_field('entreprise_blog')->ID); ?>"><?= !empty(get_field('entreprise_blog')) ? get_field('entreprise_blog')->post_title : "" ?></a>
				<a class="badge" href="<?php echo get_post_type_archive_link('blog').'?meta_key=secteur_blog&meta_value='.urlencode(get_field('secteur_blog')); ?>"><?= !empty(get_field('secteur_blog')) && get_field('secteur_blog') !== 1 ? get_cat_name(get_field('secteur_blog')) : "" ?></a>
				<a class="badge" href="<?php echo get_post_type_archive_link('blog').'?meta_key=axe_blog&meta_value='.urlencode(get_field('axe_blog')); ?>"><?= !empty(get_field('axe_blog')) ? $translate_axe[ICL_LANGUAGE_CODE][get_field('axe_blog')] : "" ?></a>
				<a class="badge" href="<?php echo get_post_type_archive_link('blog').'?meta_key=associes_blog&meta_value='.urlencode(get_field('associes_blog')->ID); ?>"><?= !empty(get_field('associes_blog')) ? get_field('associes_blog')->post_title : "" ?></a>
			</div>
			<?php
			$associes = get_field('associes_blog');
			if(!empty($associes)) :
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($associes->ID), 'bloc_image_full' );
			?>
			<div class="fiche-associes">
				<img src="<?= $thumb[0] ?>" alt="" />
				<div class="content">
					<a href="<?= get_permalink($associes->ID); ?>"><span class="name"><?php echo $associes->post_title; ?></span></a>
					<span class="post"><?= get_field("poste_membre_equipe", $associes->ID); ?></span>
					<span class="link_vcf"><a href="<?= get_field("vcard_membre_equipe", $associes->ID)['url']; ?>" title="VCard"><?= _e('Contact informations', 'apax') ?></a></span>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php get_sidebar("blog"); ?>
	</div>

</div>

<?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>
