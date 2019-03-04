<?php get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="post">
				<a href="javascript:window.history.back();" class="col-md-offset-1" id="link_back"><?php _e("Previous page","apax"); ?></a>
				<h1 class="post-title"><?php the_title(); ?></h1>
				<?php $poste_membre_equipe = get_field("poste_membre_equipe");
				if ($poste_membre_equipe && $poste_membre_equipe != "") {
					echo '<div class="baseline">'.$poste_membre_equipe.'</div>';
				} ?>
			</div>
		</div>
	</div>
	
	<div class="row">
		
		<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'image-push' );
		if ($thumb) {
			echo '<div class="col-md-offset-1 col-sm-3 col-xs-12"><img class="img-profil" src="'.$thumb[0].'" alt="" /></div>';
		} ?>
		<div class="<?php echo !$thumb ? 'col-md-offset-1 ' : '' ;?>col-md-7 col-sm-9">
			<div class="post" id="content-equipe">
				<div class="post-content">					
					<div id="info_equipe">
						<?php $presentation_membre_equipe = get_field("presentation_membre_equipe");
						$vcard_membre_equipe = get_field("vcard_membre_equipe");
						$linkedin_membre_equipe = get_field("linkedin_membre_equipe");
						if ($presentation_membre_equipe != "") {
							echo '<div class="presentation_membre_equipe">'.$presentation_membre_equipe.'</div>';
						}
						
						if ($vcard_membre_equipe) {
							echo '<p><a href="'.$vcard_membre_equipe["url"].'" target="_blank" class="link_vcf">'.__("Contact details","apax").'</a></p>';
						}
						
						if ($linkedin_membre_equipe) {
							echo '<p><a href="'.(substr($linkedin_membre_equipe,0,4) == "http" ? "" : "http://").$linkedin_membre_equipe.'" target="_blank" class="link_linkedin">'.__("Linkedin","apax").'</a></p>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<?php $id_tag_blog = get_field("id_tag_blog");
	if ($id_tag_blog != ""): 
		
		$list_id_blog = array();
		$lst_art = json_decode(file_get_contents(URL_WP_API_BLOG_ARTICLE.'?tags-api='.$id_tag_blog.'&per_page=3&lang='.ICL_LANGUAGE_CODE),true);
		
		if ($lst_art && count($lst_art) > 0):
		
			foreach ($lst_art as $la) {
				$list_id_blog[$la["id"]] = $la;
			}
		
	?>
	
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="separator"></div>
		</div>
	</div>
	
	<div class="row" id="last-posts">
		<div class="col-md-12">
			<h2><?php _e("Latest Posts…","apax"); ?></h2>
			<div class="wrap-block">
				
				<?php $list_id_blog = array();
				$lst_art = json_decode(file_get_contents(URL_WP_API_BLOG_ARTICLE.'?tags-api='.$id_tag_blog.'&per_page=3&lang='.ICL_LANGUAGE_CODE),true);
				if ($lst_art) {
					foreach ($lst_art as $la) {
						$list_id_blog[$la["id"]] = $la;
					}
				}
				foreach ($list_id_blog as $id_blog=>$blog) include 'pushs/blog.php';
				?>
				
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
	<?php endif; ?>
	
	<?php endif; ?>
	
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="separator"></div>
		</div>
	</div>
	
	
	<?php 
	
	
	$args = array(
		"post_type" => "societe",
		"posts_per_page" => -1,
		"orderby" => "title",
		"order" => "ASC",
		'meta_query'	=> array(
			array(
				'key'	 	=> 'liste_membres_team',
				'value'	  	=> '"'.get_the_ID().'"',
				'compare' 	=> 'LIKE',
			),
		),
		'suppress_filters' => false
	);
	$societe = new WP_Query($args);
	$ele = $societe->posts;
	// $ele = get_field("entrepreneurs_membre_equipe"); 
	if ($ele && count($ele)>0): ?>
	<div class="row" id="lst-entrepreneur">
		<div class="col-md-12">
			<h2><?php _e("Entrepreneurs currently supported","apax"); ?></h2>
		</div>
	</div>
	<?php include "template/list-societe-no-gutters.php"; ?>
	<?php endif; ?>
	
</div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>