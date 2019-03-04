<?php /* Template name: Live ! */ ?>
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
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="wrap-block wrap-block-blog">
				
				<?php $list_id_blog = array();
				$lst_art = json_decode(file_get_contents(URL_WP_API_BLOG_ARTICLE.'?per_page=3&lang='.ICL_LANGUAGE_CODE),true);
				if ($lst_art) {
					foreach ($lst_art as $la) {
						$list_id_blog[$la["id"]] = $la;
					}
				}
				foreach ($list_id_blog as $id_blog=>$blog) include 'pushs/blog.php';
				?>

			</div>	
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-offset-3 col-md-3">
			<a href="http://apax-talks.fr/en/inscription/#bloc-inscription" target="_blank" class="show_all_list">
				<?php _e("Register for","apax"); ?><br/>
				<?php _e("the","apax"); ?>
				<span><?php _e("newsletter","apax"); ?></span><br/>
				<img src="<?php bloginfo("template_url"); ?>/img/link-more-list.png" alt="" />
			</a>
		</div>
		<div class="col-md-3">
			<a href="http://www.apax-talks.fr" target="_blank" class="show_all_list">
				<?php _e("The digital magazine","apax"); ?><br/>
				<span><?php _e("Apax talks","apax"); ?></span><br/>
				<img src="<?php bloginfo("template_url"); ?>/img/link-more-list.png" alt="" />
			</a>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<a class="twitter-timeline" href="https://twitter.com/ApaxPartners_FR" data-chrome="nofooter transparent" data-lang="<?php echo ICL_LANGUAGE_CODE; ?>" data-widget-id="727102341355327488"><?php _e("Tweets of @ApaxPartners_FR","apax"); ?></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>
</div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>