<?php get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="post">
				<a href="javascript:window.history.back();" class="col-lg-offset-1" id="link_back"><?php _e("Previous page","apax"); ?></a>
				<?php $logo_societe = get_field("logo_societe"); ?>
				<h1 class="post-title<?php echo $logo_societe ? ' post-title-has-logo' : ''; ?>"><span class="title"><?php the_title(); ?></span><?php echo $logo_societe ? '<span class="logo"><span><img src="'.$logo_societe["sizes"]["logo-societe"].'" alt="'.get_the_title().'" /></span></span>' : '' ?></h1>				
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-offset-1 col-lg-7 col-md-8">
			<div class="post" id="content-societe">
				<div class="post-content">					
					<div id="info_societe">
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'image-push' );
						$nom_entrepreneur_societe = get_field("nom_entrepreneur_societe");
						$statut_entrepreneur_societe = get_field("statut_entrepreneur_societe");
						$profil_societe = get_field("profil_societe");
						$site_internet_societe = get_field("site_internet_societe");
						$compte_twitter_societe = get_field("compte_twitter_societe");
						$compte_linkedin_societe = get_field("compte_linkedin_societe");
						$date_dinvestissement_societe = get_field("date_dinvestissement_societe");
						$position_societe = get_field("position_societe");
						$chiffre_cle_1 = get_field("chiffre_cle_1_societe");
						$chiffre_cle_2 = get_field("chiffre_cle_2_societe");
						$chiffre_cle_3 = get_field("chiffre_cle_3_societe");
						
						$expl_nom = explode("<br />", $nom_entrepreneur_societe);
						$expl_statut = explode("<br />", $statut_entrepreneur_societe);
						
						echo $thumb ? '<img src="'.$thumb[0].'" class="photo-entrepreneur" alt="" />' : '';
						if ($nom_entrepreneur_societe != "" || $statut_entrepreneur_societe != "") {
							echo '<div class="subtitle-societe">'.__("Entrepreneur","apax").(count($expl_nom)>1?'s':'').'</div><br/>';
							// echo $nom_entrepreneur_societe != "" ? '<div class="nom_entrepreneur_societe">'.$nom_entrepreneur_societe.'</div>' : '';
							// echo $statut_entrepreneur_societe != "" ? '<div class="statut_entrepreneur_societe">'.$statut_entrepreneur_societe.'</div>' : '';
							foreach ($expl_nom as $k=>$en) {
								echo '<div class="nom_entrepreneur_societe">'.$en.'</div>';
								if (isset($expl_statut[$k]));
								echo '<div class="statut_entrepreneur_societe">'.$expl_statut[$k].'</div>';
							}
							echo '<div class="clear"></div>';
						}
						
						if ($profil_societe != "") {
							echo '<div class="subtitle-societe">'.__("Profile","apax").'</div><br/>';
							echo '<div class="profil_societe">'.$profil_societe.'</div>';
						}
						
						if ($site_internet_societe != "" || $compte_twitter_societe != "" || $compte_linkedin_societe != "") {
							echo '<div class="subtitle-societe">'.__("Online","apax").'</div><br/><div class="online-societe">';
							if ($site_internet_societe != "") {
								$sites = explode("\n",$site_internet_societe);
								foreach ($sites as $site){
									echo '<a target="_blank" href="'.(substr($site,0,4) != "http" ? "http://" : "").$site.'" class="site_internet_societe">'.str_replace("www.","",$site).'</a>';
								}
							}
							echo $compte_twitter_societe != "" ? '<a target="_blank" href="https://twitter.com/'.(substr($compte_twitter_societe,0,1) != "@" ? "@" : "").$compte_twitter_societe.'" class="compte_twitter_societe">'.$compte_twitter_societe.'</a>' : '';
							if ($compte_linkedin_societe != "") {
								$lstLinkedIn = array();
								$expl = explode("\n",$compte_linkedin_societe);
								foreach ($expl as $ex){
									$tmp = explode("|",$ex);
									if (count($tmp) == 1) {
										$lstLinkedIn[] = array(
											"title"=>get_the_title(),
											"url"=>trim($tmp[0])
										);										
									} else {
										$lstLinkedIn[] = array(
											"title"=>trim($tmp[0]),
											"url"=>trim($tmp[1])
										);
									}
								}
								foreach ($lstLinkedIn as $lst){
									echo  '<a target="_blank" href="'.(substr($lst["url"],0,4) != "http" ? "http://" : "").$lst["url"].'" class="compte_linkedin_societe">'.$lst["title"].'</a>';									
								}
							}
							echo '</div>';
						}
						
						if ($date_dinvestissement_societe != "") {
							echo '<div class="subtitle-societe">'.__("Investment date","apax").'</div><br/>';
							echo '<div class="date_dinvestissement_societe">'.$date_dinvestissement_societe.'</div>';
						}
						
						if ($position_societe != "") {
							echo '<div class="subtitle-societe">'.__("Position","apax").'</div><br/>';
							echo '<div class="position_societe">'.$position_societe.'</div>';
						}
						
						if ($chiffre_cle_1 || $chiffre_cle_2 || $chiffre_cle_3) {
							echo '<div class="chiffres-cles">';
							if ($chiffre_cle_1) {
								$share_twitter = is_array(get_field("partage_twitter_media",$chiffre_cle_1["ID"]));
								echo '<div class="col-sm-4">
									'.($share_twitter ? '<a href="https://twitter.com/share" class="twitter-share-button twitter-share-button-content" data-url="'.make_bitly_url(get_permalink($chiffre_cle_1["ID"])).'" data-text="'.str_replace("'","\'",$chiffre_cle_1["description"]).'" data-via="ApaxPartners_FR">Tweet</a>': '').'
									<img src="'.$chiffre_cle_1["sizes"]["bloc-2-image"].'" alt="'.$chiffre_cle_1["alt"].'" />
								</div>';
							}
							if ($chiffre_cle_2) {
								$share_twitter = is_array(get_field("partage_twitter_media",$chiffre_cle_2["ID"]));
								echo '<div class="col-sm-4">
									'.($share_twitter ? '<a href="https://twitter.com/share" class="twitter-share-button twitter-share-button-content" data-url="'.make_bitly_url(get_permalink($chiffre_cle_2["ID"])).'" data-text="'.str_replace("'","\'",$chiffre_cle_2["description"]).'" data-via="ApaxPartners_FR">Tweet</a>': '').'
									<img src="'.$chiffre_cle_2["sizes"]["bloc-2-image"].'" alt="'.$chiffre_cle_2["alt"].'" />
								</div>';
							}
							if ($chiffre_cle_3) {
								$share_twitter = is_array(get_field("partage_twitter_media",$chiffre_cle_3["ID"]));
								echo '<div class="col-sm-4">
									'.($share_twitter ? '<a href="https://twitter.com/share" class="twitter-share-button twitter-share-button-content" data-url="'.make_bitly_url(get_permalink($chiffre_cle_3["ID"])).'" data-text="'.str_replace("'","\'",$chiffre_cle_3["description"]).'" data-via="ApaxPartners_FR">Tweet</a>': '').'
									<img src="'.$chiffre_cle_3["sizes"]["bloc-2-image"].'" alt="'.$chiffre_cle_3["alt"].'" />
								</div>';
							}
							echo '<div class="clear"></div></div>';
						}
						?>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>
					
					<?php $history = get_field("liste_blocs_history_societe");
					if ($history && count($history)>0) {
						echo '<script type="text/javascript" src="'.get_bloginfo("template_url").'/js/single-societe.js"></script>
						<div id="history_societe">';
						foreach ($history as $h){
							echo '<h2 class="title_year">'.$h["annee"].'</h2>';
							echo '<div class="content_history">';
							echo $h["texte"];
							
							if ($h["txt_internationalisation"] != "" || $h["txt_build-ups"] != "" || $h["txt_digitial"] != ""):
								echo '<ul class="nav nav-tabs" role="tablist">';
									echo $h["txt_internationalisation"] != "" ? '<li role="presentation" class="col-xs-4 active"><a href="#internationalisation'.$h["annee"].'" aria-controls="internationalisation'.$h["annee"].'" role="tab" data-toggle="tab">'.__("International","apax").'</a></li>' : '';
									echo $h["txt_build-ups"] != "" ? '<li role="presentation" class="col-xs-4'.($h["txt_internationalisation"] == "" ? ' active' : '').'"><a href="#build-ups'.$h["annee"].'" aria-controls="build-ups'.$h["annee"].'" role="tab" data-toggle="tab">'.__("Build-ups","apax").'</a></li>' : '';
									echo $h["txt_digitial"] != "" ? '<li role="presentation" class="col-xs-4'.($h["txt_build-ups"] == "" && $h["txt_internationalisation"] == "" ? ' active' : '').'"><a href="#digitial'.$h["annee"].'" aria-controls="digitial'.$h["annee"].'" role="tab" data-toggle="tab">'.__("Digital Transformation","apax").'</a></li>' : '';
								echo '</ul>
								<div class="tab-content">';
								
								echo $h["txt_internationalisation"] != "" ? '<div role="tabpanel" class="tab-pane active" id="internationalisation'.$h["annee"].'"><div class="table"><div class="ico"><img src="'.get_bloginfo("template_url").'/img/ico-internationnal.png" alt="" /></div><div>'.$h["txt_internationalisation"].'</div></div></div>' : '';
								echo $h["txt_build-ups"] != "" ? '<div role="tabpanel" class="tab-pane'.($h["txt_internationalisation"] == "" ? ' active' : '').'" id="build-ups'.$h["annee"].'"><div class="table"><div class="ico"><img src="'.get_bloginfo("template_url").'/img/ico-buildups.png" alt="" /></div><div>'.$h["txt_build-ups"].'</div></div></div>' : '';
								echo $h["txt_digitial"] != "" ? '<div role="tabpanel" class="tab-pane'.($h["txt_build-ups"] == "" && $h["txt_internationalisation"] == "" ? ' active' : '').'" id="digitial'.$h["annee"].'"><div class="table"><div class="ico"><img src="'.get_bloginfo("template_url").'/img/ico-digital.png" alt="" /></div><div>'.$h["txt_digitial"].'</div></div></div>' : '';
								
								echo '</div>';
								
							endif;
							
							echo '</div>';
						}
						echo '</div>';
					} ?>
					
					
				</div>
			</div>
		</div>
		<div id="sidebar">
			<div class="col-lg-3 col-md-4">
				<div class="row">
				<?php global $isSidebar; $isSidebar = true; ?>
				
				<?php $list_bloc = get_field("list_bloc"); ?>
				<?php include "flex-content-right.php"; ?>
				
				<?php include 'pushs/membre_equipe.php'; ?>
				
				<?php include 'pushs/same_secteur.php'; ?>				
				</div>
			</div>
		</div>
		
	</div>
</div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>