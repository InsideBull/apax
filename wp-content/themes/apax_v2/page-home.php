<?php get_header(); ?>

<?php $video = get_field("video_home");
$image_video = get_field("image_attente_video");
if ($video): ?>
<video autoplay="true" class="bgvid" muted loop="true"<?php echo $image_video? ' poster="'.$image_video["url"].'"':''; ?>><source src="<?php echo $video["url"]; ?>" type="video/mp4" /></video>
<?php endif; ?>

<?php echo $image_video ? '<div class="bgvid" style="background-image: url('.$image_video["url"].');"></div>':''; ?>

<?php $list_bloc = get_field("list_bloc_slider_actu");
if ($list_bloc): ?>

<img src="<?php bloginfo("template_url"); ?>/img/logo-white-home.png" alt="" id="home-logo-mobile" />

<div class="container" id="wrap-actu">
	<div class="row">
		<div class="col-md-offset-8 col-md-3 col-sm-offset-7 col-sm-4">
			<div id="slide-actu">
				
				<?php include "flex-content-right.php"; ?>
				
				<?php if (count($list_bloc)>1): ?>
				<a href="#" id="prev-slide-actu"><?php _e("Previous","apax"); ?></a>
				<a href="#" id="next-slide-actu"><?php _e("Next","apax"); ?></a>
				<div id="wrap-progress-slide-actu"><div id="progress-slide-actu"></div></div>
				<div id="pager-cycle-actu"></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>


<div class="wrap-container wrap-container-first" id="apax-pres">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php $titre_sous_video = get_field("titre_sous_video");
				$sous_titre_sous_video = get_field("sous-titre_sous_video");
				if ($titre_sous_video != "" || $sous_titre_sous_video != ""): ?>
				
				<?php echo $titre_sous_video != "" ? '<h2>'.$titre_sous_video.'</h1>' : ''; ?>
				<?php echo $sous_titre_sous_video != "" ? '<div class="baseline">'.$sous_titre_sous_video.'</div>' : ''; ?>
				
				<?php endif; ?>
				
				<?php $list_bloc = get_field("list_bloc_sous_video");
				if ($list_bloc): ?>
				<div class="wrap-block">
					<?php include "flex-content-right.php"; ?>
					<div class="clear"></div>
				</div>
				<?php endif; ?>
				
				<?php $lien_sous_video = get_field("lien_sous_video");
				$titre_lien_sous_video = get_field("titre_lien_sous_video");
				if ($lien_sous_video != "" && $titre_lien_sous_video != ""): ?>				
				<div class="center">
					<a href="<?php echo $lien_sous_video; ?>" class="link-arrow"><?php echo $titre_lien_sous_video; ?></a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<div class="wrap-container wrap-container-grey">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="blue"><?php _e("ENTREPRENEURS CURRENTLY SUPPORTED","apax"); ?></h1>
				<div class="baseline baseline-short-margin"><?php _e("4 areas of specialisation","apax"); ?></div>
			</div>
		</div>
	</div>
</div>	

<?php $args = array(
	"hide_empty" => 0,
	"title_li" => "",
	"exclude" => array(1)
);
$category = get_categories($args);
if ($category && count($category)>0): ?>
<div class="wrap-list-click">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10">
				<ul class="bt-click">
					<?php $randomEntr = array(); foreach ($category as $k=>$c){
						
						$tmpEntr = get_posts("post_type=societe&posts_per_page=1&orderby=rand&category=".$c->term_id);
						if (count($tmpEntr) > 0) {
							$randomEntr[$c->term_id] = $tmpEntr[0];
							echo '<li><a href="'.get_permalink(get_the_id_wpml(139)).'?cat='.$c->term_id.'"'.($k==0?' class="active"':'').' id="bt-click-entre'.$c->term_id.'">'.str_replace("&amp;","&amp;<br/>",$c->name).'</a></li>';
						}
					} ?>
				</ul>
				
				<div id="slide-entrepreneur">
					<?php foreach ($randomEntr as $idcat=>$r) {
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($r->ID), 'home-secteur-spe' );
						$nom_entrepreneur_societe = get_field("nom_entrepreneur_societe",$r->ID);
						$statut_entrepreneur_societe = get_field("statut_entrepreneur_societe",$r->ID);
						if ($thumb) {
							echo '<div class="block-entrepreneur" data-click="entre'.$idcat.'">
								<a href="'.get_permalink($r->ID).'" class="bloc-ele" style="background-image: url('.$thumb[0].');">
									<img src="'.$thumb[0].'" alt="'.$r->post_title.'" />
									<span class="title">'.$r->post_title.'</span>';
									if ($statut_entrepreneur_societe != "" || $nom_entrepreneur_societe != "") {
										echo '<span class="name"><span>';
										echo $nom_entrepreneur_societe != "" ? $nom_entrepreneur_societe.'<br/>' : '';
										echo $statut_entrepreneur_societe != "" ? $statut_entrepreneur_societe : '';
										echo '</span></span>';
									}
							echo '</a>
							</div>';
						}
					} ?>
					<?php /*<div class="block-entrepreneur">
						<a href="<?php echo get_permalink(get_the_id_wpml(139)); ?>" class="bloc-ele" style="background-image: url(<?php bloginfo("template_url"); ?>/img/Push-entrepreneurs-<?php echo ICL_LANGUAGE_CODE; ?>.gif);">
							<img src="<?php bloginfo("template_url"); ?>/img/Push-entrepreneurs-<?php echo ICL_LANGUAGE_CODE; ?>.gif" alt="" />
						</a>
					</div> */ ?>
					<a href="#" id="prev-slide-entrepreneur"><?php _e("Previous","apax"); ?></a>
					<a href="#" id="next-slide-entrepreneur"><?php _e("Next","apax"); ?></a>
					<!-- <div id="wrap-progress-slide-entrepreneur"><div id="progress-slide-entrepreneur"></div></div> -->
					<div id="pager-cycle-entrepreneur"></div>
				</div>
				
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
				
<div class="wrap-container wrap-container-grey">
	<div class="container">
		<div class="row">
			<div class="col-md-12">				
				<div class="center center-padding">
					<a href="<?php echo get_permalink(get_the_id_wpml(139)); ?>" class="link-arrow"><?php _e("All entrepreneurs","apax"); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>


<?php $titre_val = get_field("titre_list_images_home");
$sous_titre_val = get_field("sous-titre_list_images_home");
if ($titre_val != "" || $sous_titre_val != ""): ?>
<div class="wrap-container">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php echo $titre_val != "" ? '<h2 class="blue2 blue-text">'.$titre_val.'</h2>' : ''; ?>
				<?php echo $sous_titre_val != "" ? '<div class="baseline baseline-short-margin">'.$sous_titre_val.'</div>' : ''; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php $list_3images = get_field("list_images_home");
if ($list_3images): ?>
<div class="wrap-container wrap-container-grey wrap-container-nopadding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">				
				<div class="wrap-block wrap-block-little">
					<?php foreach ($list_3images as $l3i){
						$image = $l3i["image"];
						$link = $l3i["lien"];
						$blank = is_array($l3i["blank"]);
						if ($image) {
							echo '<a'.($link != "" ? ' href="'.$link.'"'.($blank ? ' target="_blank"' : '') : '').' class="block-push">
								<span class="wrap-content-full-img" style="background-image: url('.$image["sizes"]["bloc-3-home"].');">
									<img src="'.$image["sizes"]["bloc-3-home"].'" alt="'.$image["alt"].'" />
								</span>
							</a>';
						}
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php get_footer(); ?>