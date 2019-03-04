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
	
	<?php $other_lang = ICL_LANGUAGE_CODE == 'fr'?'en':'fr';
	$old_lang = ICL_LANGUAGE_CODE;
	
	$blog_push = false;
	
	/*$identifiant_dun_article_du_blog_interne = get_field("identifiant_dun_article_du_blog_interne");
	if ($identifiant_dun_article_du_blog_interne && $identifiant_dun_article_du_blog_interne != "") {
		$blog_push->posts = array(get_post(icl_object_id($identifiant_dun_article_du_blog_interne, 'post')));
	}*/
	
	if (!$blog_push) {			
		$blog_push = new WP_Query([
			'post_type' => 'blog',
			'meta_key'		=> 'associes_blog',
			'meta_value'	=> get_the_ID(),
			'post_limits' => 1,
		]);		
		if(!$blog_push->have_posts()){
			$blog_push = new WP_Query([
				'post_type' => 'blog',
				'meta_key'		=> 'associes_blog',
				'meta_value'	=> intval(icl_object_id(get_the_ID(), 'post', true, $other_lang)),
				'post_limits' => 1,
			]);	
		}
	}
	
	$id_tag_blog = get_field("id_tag_blog");
	$magazine_push = null;
	if ($id_tag_blog != ""){		
		$magazine_push = json_decode(file_get_contents(URL_WP_API_BLOG_ARTICLE.'?tags-api='.$id_tag_blog.'&per_page=1&lang='.ICL_LANGUAGE_CODE),true);
	}
	
	/* Count to center with offset*/
	$offset = "";
	$bloc = 0;
	if($blog_push){
		$bloc++;
	}
	if($magazine_push){$bloc++;}
	if($bloc == 2){$offset="col-md-offset-2";}
	if($bloc == 1){$offset="col-md-offset-4";}
		
	?>
	
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="separator"></div>
		</div>
	</div>
	
	<div class="col-lg-offset-1 col-lg-10 col-md-12 related">
		<div class="row">
			<?php if($blog_push && count($blog_push->posts)){
				$blog = $blog_push->posts[0];
				?>
				<div class="<?= (!empty($offset)?$offset." ":"" )?>col-md-4 col-sm-6">
					<h2 class="center_underline text-blue">Blog</h2>
					<a href="<?= get_permalink(get_the_id_wpml($blog->ID)) ?>" class="block-push block-push-blog-interne">
						<span class="wrap-image"><span><?= get_the_post_thumbnail($blog->ID,"image-push") ?></span></span>
						<div class="wrap-content">
							<div class="content hidden-sm hidden-md"><?php echo wp_trim_words($blog->post_title,23); ?></div>
							<div class="content hidden-xs hidden-sm hidden-lg"><?php echo wp_trim_words($blog->post_title,8); ?></div>
							<div class="content hidden-xs hidden-md hidden-lg"><?php echo wp_trim_words($blog->post_title,15); ?></div>
							<div class="associes"><?= get_field("associes_blog",$blog->ID)->post_title; ?></div>
						</div>
						<?php $temps = get_field('temps_lecture_blog',$blog->ID);
						if ($temps && $temps != "0" && $temps != ""): ?>
						<span class="time"><?php echo $temps ?>MN</span>
						<?php endif; ?>
						<span class="date"><?php echo date(ICL_LANGUAGE_CODE == "fr" ? "d.m.Y" : "Y.m.d",strtotime($blog->post_date)); ?></span>
						<span class="link">
							<?php if (ICL_LANGUAGE_CODE == "fr") {
								echo '<span>Blog</span>';
							} else {
								echo '<span>Blog</span>';
							} ?>
						</span>
					</a>
					<div class="text-center">
						<a href="<?= get_post_type_archive_link("blog"); ?>?meta_key=associes_blog&meta_value=<?= get_the_ID(); ?>" class="read-more text-blue"><?= __("See all","apax") ?><br><strong><?= __("posts","apax") ?></strong> <br><img src="<?= get_template_directory_uri() ?>/img/plus-blue.png" alt=""></a>
					</div>
				</div>

			<?php } ?>
			<?php if($magazine_push && count($magazine_push)){
				$magazine = $magazine_push[0];
				?>
				<div class="col-md-4 col-sm-6">
					<h2 class="center_underline text-grey"><?= __("Digital magazine","apax") ?></h2>
					<a href="<?= $magazine["link"] ?>" target="_blank" class="block-push block-push-blog">
						<span class="wrap-image"><span><img src="<?= $magazine["image-push"] ?>" alt="Thumbnail"></span></span>
						<div class="wrap-content">
							<div class="content hidden-sm hidden-md"><?= wp_trim_words($magazine["title"]["rendered"],23); ?></div>
							<div class="content hidden-xs hidden-sm hidden-lg"><?= wp_trim_words($magazine["title"]["rendered"],8); ?></div>
							<div class="content hidden-xs hidden-md hidden-lg"><?= wp_trim_words($magazine["title"]["rendered"],15); ?></div>
						</div>
						<span class="time"><?php echo $magazine["temps"] ?>MN</span>
						<span class="date"><?= date(ICL_LANGUAGE_CODE == "fr" ? "d.m.Y" : "Y.m.d",strtotime($magazine["date"])); ?></span>
						<span class="link">
							<?= __("Digital magazine","apax") ?>
						</span>
					</a>
					<div class="text-center">
						<a target="_blank" href="http://apax-talks.fr/en/?s=<?= strtolower(urlencode(get_the_title())) ?>" class="read-more"><?= __("See all","apax") ?><br><strong><?= __("articles","apax") ?></strong> <br><img src="<?= get_template_directory_uri() ?>/img/plus.png" alt=""></a>
					</div>
				</div>

			<?php } ?>
		</div>
	</div>
	
	
	<?php /*<div class="row" id="last-posts">
		<div class="col-md-12">
			<h2><?php _e("Latest Posts…","apax"); ?></h2>
			<div class="wrap-block">
				
				<?php foreach ($list_id_blog as $id_blog=>$blog) include 'pushs/blog.php';	?>
				
				<div class="clear"></div>
			</div>
		</div>
	</div> */ ?>
	
	<?php //endif; ?>
	
	<?php //endif; ?>
	
	<?php /*$id_tag_blog = get_field("id_tag_blog");
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
	</div> ?>
	
	<?php endif;  ?>
	
	<?php endif; */ ?>
	
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