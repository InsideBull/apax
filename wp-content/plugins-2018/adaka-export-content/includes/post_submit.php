<?php

function render_post_template($postObj){
	global $post;
	setup_postdata($postObj);
	$post = $postObj;
	
	if(wpml_get_language_information($post->ID)['different_language']){return;}
	$child = get_posts("post_type=page&post_parent=".$post->ID."&orderby=menu_order&order=ASC&posts_per_page=1");
	if(!is_search() && count($child) > 0 && get_current_page_depth() === 0){return;}
	if(get_page_template_slug( $post->ID ) == "template-list-societe.php" ||
	get_page_template_slug( $post->ID ) == "template-list-equipe.php" ||
		get_page_template_slug( $post->ID ) == "template-live.php"){return;}
	if(get_permalink($post) == get_post_type_archive_link('post')){return;}

	if($post->post_type == "post" || $post->post_type == "page"){
		if(get_page_template_slug( $post->ID ) == "template-recherche.php"){return;}
		echo '<div class="col-lg-offset-1 col-lg-7 col-md-8">';
		$sous_titre = get_field("sous-titre_page");
			echo '<div class="post">
				<div class="post-content">
					<h1>'.((wp_get_post_parent_id($post->ID)!=$post->ID && wp_get_post_parent_id($post->ID)!=0)?get_the_title(wp_get_post_parent_id($post->ID)).' --> ': "").get_the_title().'</h1>';
					if ($sous_titre && $sous_titre != "") {
						echo '<div style="color:#0DA4B5">'.$sous_titre.'</div>';
					}
				echo '</div>
			</div>';

		get_template_part("flex","content");
		if($post->ID  ==  get_option( 'page_on_front' )):  ?>
			<div class="wrap-container wrap-container-first" id="apax-pres">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<?php $titre_sous_video = get_field("titre_sous_video");
							$sous_titre_sous_video = get_field("sous-titre_sous_video");
							if ($titre_sous_video != "" || $sous_titre_sous_video != ""): ?>

							<?php echo $titre_sous_video != "" ? '<h2>'.$titre_sous_video.'</h2>' : ''; ?>
							<?php echo $sous_titre_sous_video != "" ? '<div class="baseline">'.$sous_titre_sous_video.'</div>' : ''; ?>

							<?php endif; ?>

							<?php $list_bloc = get_field("list_bloc_sous_video");
							if ($list_bloc): ?>
							<div class="wrap-block">
								<?php include get_template_directory()."/flex-content-right.php"; ?>
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
							<h2 class="blue"><?php _e("ENTREPRENEURS CURRENTLY SUPPORTED","apax"); ?></h2>
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
		<?php endif;
		if(get_page_template_slug( $post->ID ) == 'template-historique.php'){ // PAGE HISTORIQUE ?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="post">
							<?php $args = array(
								"show_option_all" => __("ALL","apax"),
								"hide_empty" => 0,
								"title_li" => "",
								"exclude" => array(1,33,34)
							);

							echo '<ul id="list-cat-element">';
							wp_list_categories($args);
							echo '</ul>'; ?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-offset-1 col-md-10">

					<?php get_template_part("accordeon","content"); ?>

					</div>
				</div>
			</div>
		<?php }else if(get_page_template_slug( $post->ID ) == 'template-contact.php'){ // PAGE CONTACT ?>
			<?php $list_membre = get_field("list_membres");
			if ($list_membre) {
				echo '<div class="row">
					<div class="col-md-10 col-md-offset-1" id="list-contact-membre">
						<div class="row no-gutters">';

				foreach ($list_membre as $lemembre) {
					if ($lemembre["type_membre"] == "equipe") {
						$membre = $lemembre["membre_existant"];
						if ($membre->post_status == "publish") {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($membre->ID), 'contact-membre' );
							$nom = $membre->post_title;
							$poste_membre_equipe = get_field("poste_membre_equipe",$membre->ID);
							$mail = get_field("email_membre_equipe",$membre->ID);
						}
					} else {
						$thumb = array($lemembre["photo"]["sizes"]["contact-membre"]);
						$nom = $lemembre["nom"];
						$mail = $lemembre["email"];
						$poste_membre_equipe = $lemembre["fonction"];
					}

					if (isset($nom)) {
						echo '<div class="col-md-4 col-sm-6">';
						echo ($mail != "" ? '<a href="mailto:'.$mail.'"' : '<div').' class="bloc-ele" style="'.($thumb ? 'background-image: url('.$thumb[0].');' : '').'">
						'.($thumb ? '<img src="'.$thumb[0].'" alt="" />' : '').'
						<span class="title">'.$nom.'</span>';
						if ($nom != "" || $poste_membre_equipe != "") {
							echo '<span class="name"><span>';
							echo $nom != "" ? $nom.'<br/>' : '';
							echo $poste_membre_equipe != "" ? $poste_membre_equipe.'<br/>' : '';
							// echo $mail != "" ? $mail : '';
							echo '</span></span>';
						}
						echo $mail != '' ? '</a>' : '</div>';
						echo '</div>';
					}

				}

				echo '</div>
					</div>
				</div>';
			}

			?>


			<?php $siege_social = get_field("siege_social_contact");
			if ($siege_social != "") {
				echo '<div class="row">
					<div class="col-md-10 col-md-offset-1" id="siege-contact">
						<h2 class="underline">'.__("Head Office","apax").'</h2>
						'.$siege_social.'
					</div>
				</div>';
			} ?>
	<?php }
		echo '</div>';
	}else if($post->post_type == "societe"){ ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="post">
						<h1><?php the_title(); ?></h1>
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
								$chiffre_affaires = get_field("chiffre_affaires");
								$majoritaire = get_field("majoritaire_societe");
								$these_investissement = get_field("these_investissement");

								$expl_nom = explode("<br />", $nom_entrepreneur_societe);
								$expl_statut = explode("<br />", $statut_entrepreneur_societe);

								echo '<div class="entrepreneur-wrapper clearfix">';
									echo $thumb ? '<img src="'.$thumb[0].'" class="photo-entrepreneur" alt="" />' : '';
									echo '<div class="right pull-left content">';
									if ($nom_entrepreneur_societe != "" || $statut_entrepreneur_societe != "") {
										echo '<div class="subtitle-societe">'.__("Entrepreneur","apax").(count($expl_nom)>1?'s':'').'</div>';
										foreach ($expl_nom as $k=>$en) {
											echo '<div class="nom_entrepreneur_societe">'.$en.'</div>';
											if (isset($expl_statut[$k]));
											echo '<div class="statut_entrepreneur_societe">'.$expl_statut[$k].'</div>';
										}
										echo '<a href="" class="profile-btn collapse-btn" data-toggle="adaka-collapse" data-target="#profile-collapse">'.__("Profile","apax").'</a>';
									}
									echo '</div>';
								echo '</div>';
								echo '<div class="adaka-collapse content" id="profile-collapse">';

								// Profile part
								if ($profil_societe != "") {
									echo '<div class="profil_societe">'.$profil_societe.'</div>';
								}

								// Online part
								if ($site_internet_societe != "" || $compte_twitter_societe != "" || $compte_linkedin_societe != "") {
									echo '<div class="subtitle-societe">'.__("Online","apax").'</div><br/><div class="online-societe">';
									if ($site_internet_societe != "") {
										$sites = explode("\n",$site_internet_societe);
										foreach ($sites as $site){
											echo '<a target="_blank" href="'.(substr($site,0,4) != "http" ? "http://" : "").$site.'" class="site_internet_societe">'.str_replace("www.","",$site).'</a>';
										}
									}
									echo '</div>';
								} // End online condition
								echo '</div>'; //End collapse dive

								?>
							</div>

							<div class="chiffres-societe">
								<div class="chiffre-affaires">
									€<span class="num animated-number" <?= (!$IS_EXPORT?'data-stats="'.$chiffre_affaires.'"':"") ?>><?= (!$IS_EXPORT?"0":$chiffre_affaires) ?></span>m<br>
									<span class="text"><?= __("Turnover","apax") ?></span>
								</div>
								<div class="small">
									<span class="secteur"><?= __("Sector","apax") ?> : <?= get_the_category()[0]->name; ?></span>
									<span class="date_investissement"><?= __("Investment date","apax") ?> : <?= $date_dinvestissement_societe ?></span>
									<span class="majoritaire"><?= __("Majority","apax") ?> : <span class="animated-number" <?= (!$IS_EXPORT?'data-stats="'.$majoritaire.'"':"") ?>><?= (!$IS_EXPORT?"0":$majoritaire) ?></span>%</span>
								</div>
							</div>
							<?php if($these_investissement){ ?>
							<div class="these-investissement">
								<div class="subtitle-societe"><?= __("Investment thesis","apax") ?></div>
								<?= $these_investissement ?>
							</div>
							<?php } ?>

							<?php $history = get_field("liste_blocs_history_societe");
							if ($history && count($history)>0) {
								echo '<div class="content_history">';
									echo '<div class="subtitle-societe">'.__("Valuable creation","apax").'</div>
										<div class="online-societe">';
										echo '<h2>'.$history[0]["annee"].'</h2>';
										echo $history[0]["texte"];

										if ($history[0]["txt_internationalisation"] != "" || $history[0]["txt_build-ups"] != "" || $history[0]["txt_digitial"] != ""){
											echo '<ul class="nav nav-tabs" role="tablist">';
												echo $history[0]["txt_internationalisation"] != "" ? '<li role="presentation" class="col-xs-4 active"><a href="#internationalisation'.$history[0]["annee"].'" aria-controls="internationalisation'.$history[0]["annee"].'" role="tab" data-toggle="tab">'.__("International","apax").'</a></li>' : '';
												echo $history[0]["txt_build-ups"] != "" ? '<li role="presentation" class="col-xs-4'.($history[0]["txt_internationalisation"] == "" ? ' active' : '').'"><a href="#build-ups'.$history[0]["annee"].'" aria-controls="build-ups'.$history[0]["annee"].'" role="tab" data-toggle="tab">'.__("Build-ups","apax").'</a></li>' : '';
												echo $history[0]["txt_digitial"] != "" ? '<li role="presentation" class="col-xs-4'.($history[0]["txt_build-ups"] == "" && $history[0]["txt_internationalisation"] == "" ? ' active' : '').'"><a href="#digitial'.$history[0]["annee"].'" aria-controls="digitial'.$history[0]["annee"].'" role="tab" data-toggle="tab">'.__("Digital Transformation","apax").'</a></li>' : '';
											echo '</ul>
											<div class="tab-content">';

											echo $history[0]["txt_internationalisation"] != "" ? '<div role="tabpanel" class="tab-pane active" id="internationalisation'.$history[0]["annee"].'"><div class="table"><div class="ico"><img src="'.get_bloginfo("template_url").'/img/ico-internationnal.png" alt="" /></div><div>'.$history[0]["txt_internationalisation"].'</div></div></div>' : '';
											echo $history[0]["txt_build-ups"] != "" ? '<div role="tabpanel" class="tab-pane'.($history[0]["txt_internationalisation"] == "" ? ' active' : '').'" id="build-ups'.$history[0]["annee"].'"><div class="table"><div class="ico"><img src="'.get_bloginfo("template_url").'/img/ico-buildups.png" alt="" /></div><div>'.$history[0]["txt_build-ups"].'</div></div></div>' : '';
											echo $history[0]["txt_digitial"] != "" ? '<div role="tabpanel" class="tab-pane'.($history[0]["txt_build-ups"] == "" && $history[0]["txt_internationalisation"] == "" ? ' active' : '').'" id="digitial'.$history[0]["annee"].'"><div class="table"><div class="ico"><img src="'.get_bloginfo("template_url").'/img/ico-digital.png" alt="" /></div><div>'.$h["txt_digitial"].'</div></div></div>' : '';

											echo '</div>';
										}
										$chiffre_cle_1=$history[0]["chiffre_cle_1_societe_manuel"];
										$chiffre_cle_2=$history[0]["chiffre_cle_2_societe_manuel"];
										$chiffre_cle_3=$history[0]["chiffre_cle_3_societe_manuel"];
										if ($chiffre_cle_1["chiffre_cle_text"] || $chiffre_cle_2["chiffre_cle_text"] || $chiffre_cle_3["chiffre_cle_text"]) {
											echo '<div class="chiffres-cles row">';
											if ($chiffre_cle_1["chiffre_cle_text"]) {
												//$share_twitter = is_array(get_field("partage_twitter_media",$chiffre_cle_1["ID"]));
												$chiffre_cle = $chiffre_cle_1;
												echo '<div class="col-sm-4">';
													include get_template_directory().'/template/chiffre-cle.php';
												echo '</div>';
											}
											if ($chiffre_cle_2["chiffre_cle_text"]) {
												//$share_twitter = is_array(get_field("partage_twitter_media",$chiffre_cle_2["ID"]));
												$chiffre_cle = $chiffre_cle_2;
												echo '<div class="col-sm-4">';
													include get_template_directory().'/template/chiffre-cle.php';
												echo '</div>';
											}
											if ($chiffre_cle_3["chiffre_cle_text"]) {
												//$share_twitter = is_array(get_field("partage_twitter_media",$chiffre_cle_3["ID"]));
												$chiffre_cle = $chiffre_cle_3;
												echo '<div class="col-sm-4">';
													include get_template_directory().'/template/chiffre-cle.php';
												echo '</div>';
											}
											echo '</div>';
										}
									echo $history[0]["texte_dessous_onglet"];
									echo '</div>';
									if(count($history)>1){
										echo '<a href="" class="read-more collapse-btn" data-toggle="adaka-collapse" data-target="#history-collapse">'.__("Previously","apax").'</a>';
									}
								echo '</div>';
									if(count($history)>1){
										echo '<div class="content_history adaka-collapse" id="history-collapse">';
										for($i=1; $i<count($history); $i++){
											echo '<div class="online-societe">';
											echo '<h2>'.$history[$i]["annee"].'</h2>';
											echo $history[$i]["texte"];
											if ($history[$i]["txt_internationalisation"] != "" || $history[$i]["txt_build-ups"] != "" || $history[$i]["txt_digitial"] != ""){
												echo '<ul class="nav nav-tabs" role="tablist">';
													echo $history[$i]["txt_internationalisation"] != "" ? '<li role="presentation" class="col-xs-4 active"><a href="#internationalisation'.$history[$i]["annee"].'" aria-controls="internationalisation'.$history[$i]["annee"].'" role="tab" data-toggle="tab">'.__("International","apax").'</a></li>' : '';
													echo $history[$i]["txt_build-ups"] != "" ? '<li role="presentation" class="col-xs-4'.($history[$i]["txt_internationalisation"] == "" ? ' active' : '').'"><a href="#build-ups'.$history[$i]["annee"].'" aria-controls="build-ups'.$history[$i]["annee"].'" role="tab" data-toggle="tab">'.__("Build-ups","apax").'</a></li>' : '';
													echo $history[$i]["txt_digitial"] != "" ? '<li role="presentation" class="col-xs-4'.($history[$i]["txt_build-ups"] == "" && $history[$i]["txt_internationalisation"] == "" ? ' active' : '').'"><a href="#digitial'.$history[$i]["annee"].'" aria-controls="digitial'.$history[$i]["annee"].'" role="tab" data-toggle="tab">'.__("Digital Transformation","apax").'</a></li>' : '';
												echo '</ul>
												<div class="tab-content">';

												echo $history[$i]["txt_internationalisation"] != "" ? '<div role="tabpanel" class="tab-pane active" id="internationalisation'.$history[$i]["annee"].'"><div class="table"><div class="ico"><img src="'.get_bloginfo("template_url").'/img/ico-internationnal.png" alt="" /></div><div>'.$history[$i]["txt_internationalisation"].'</div></div></div>' : '';
												echo $history[$i]["txt_build-ups"] != "" ? '<div role="tabpanel" class="tab-pane'.($history[$i]["txt_internationalisation"] == "" ? ' active' : '').'" id="build-ups'.$history[$i]["annee"].'"><div class="table"><div class="ico"><img src="'.get_bloginfo("template_url").'/img/ico-buildups.png" alt="" /></div><div>'.$history[$i]["txt_build-ups"].'</div></div></div>' : '';
												echo $history[$i]["txt_digitial"] != "" ? '<div role="tabpanel" class="tab-pane'.($history[$i]["txt_build-ups"] == "" && $history[$i]["txt_internationalisation"] == "" ? ' active' : '').'" id="digitial'.$history[$i]["annee"].'"><div class="table"><div class="ico"><img src="'.get_bloginfo("template_url").'/img/ico-digital.png" alt="" /></div><div>'.$h["txt_digitial"].'</div></div></div>' : '';

												echo '</div>';
											};
											$chiffre_cle_1=$history[$i]["chiffre_cle_1_societe_manuel"];
											$chiffre_cle_2=$history[$i]["chiffre_cle_2_societe_manuel"];
											$chiffre_cle_3=$history[$i]["chiffre_cle_3_societe_manuel"];
											if ($chiffre_cle_1["chiffre_cle_text"] || $chiffre_cle_2["chiffre_cle_text"] || $chiffre_cle_3["chiffre_cle_text"]) {
												echo '<div class="chiffres-cles">';
												if ($chiffre_cle_1["chiffre_cle_text"]) {
													$chiffre_cle = $chiffre_cle_1;
													echo '<div class="col-sm-4">';
														include get_template_directory().'/template/chiffre-cle.php';
													echo '</div>';
												}
												if ($chiffre_cle_2["chiffre_cle_text"]) {
													$chiffre_cle = $chiffre_cle_2;
													echo '<div class="col-sm-4">';
														include get_template_directory().'/template/chiffre-cle.php';
													echo '</div>';
												}
												if ($chiffre_cle_3["chiffre_cle_text"]) {
													$chiffre_cle = $chiffre_cle_3;
													echo '<div class="col-sm-4">';
														include get_template_directory().'/template/chiffre-cle.php';
													echo '</div>';
												}
												echo '</div>';
											}
											echo $history[$i]["texte_dessous_onglet"];
											echo '</div>';
										}
										echo '</div>';
									}
							} ?>

						</div>
					</div>
				</div>
				<div id="sidebar">
					<div class="col-lg-3 col-md-4">
						<div class="row">
						<?php global $isSidebar; $isSidebar = true; ?>

						<?php $list_bloc = get_field("list_bloc"); ?>
						<?php include get_template_directory()."/flex-content-right.php"; ?>

						<?php include get_template_directory().'/pushs/membre_equipe.php'; ?>

						<?php include get_template_directory().'/pushs/same_secteur.php'; ?>
						</div>
					</div>
				</div>

			</div>
			<div class="row">
				<?php
					$blog_push = new WP_Query([
						'post_type' => 'blog',
						'meta_key'		=> 'entreprise_blog',
						'meta_value'	=> get_the_ID(),
						'post_limits' => 1,
					]);
					$presse_push = new WP_Query([
						'post_type' => 'post',
						'meta_key'		=> 'societe_presse',
						'meta_value'	=> get_the_ID(),
						'post_limits' => 1,
					]);
					$magazine_push = false;

				?>
				<div class="col-lg-offset-1 col-lg-10 col-md-12 related">
					<div class="row">
						<?php if($blog_push && count($blog_push->posts)){
							$blog = $blog_push->posts[0];
							?>
							<div class="col-md-4 col-sm-6">
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
									<a href="<?= get_post_type_archive_link("blog"); ?>" class="read-more text-blue"><?= __("All the","apax") ?><br><strong><?= __("posts","apax") ?></strong> <br><img src="<?= get_template_directory_uri() ?>/img/plus-blue.png" alt=""></a>
								</div>
							</div>

						<?php } ?>
						<?php if($presse_push && count($presse_push->posts)){
							$press = $blog_push->posts[0];
							?>
							<div class="col-md-4 col-sm-6">
								<h2 class="center_underline">Presse</h2>
								<div class="block-push-presse">
									<a href="<?php echo get_permalink(); ?>"><span class="date"><?php echo str_replace(" ","<br/>",get_the_date(null,$press->ID)); ?></span></a>
									<?php $origine = $press->post_title;
									$cut = substr($origine,0,120);
									if ($cut < $origine) $cut .= "..."; ?>
									<h2><a href="<?php echo get_permalink(); ?>"><?php echo $cut; ?></a></h2>
									<a class="link" href="<?= get_permalink($press->ID) ?>">
										<span>Communiqué de presse</span>
									</a>
								</div>
								<div class="text-center">
									<a href="<?= get_post_type_archive_link("post") ?>" class="read-more text-red"><?= __("All the","apax") ?><br><strong><?= __("press releases","apax") ?></strong> <br><img src="<?= get_template_directory_uri() ?>/img/plus-orange.png" alt=""></a>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div><?php
	}else if($post->post_type == "team"){ ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="post">
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
						foreach ($list_id_blog as $id_blog=>$blog) include get_template_directory().'/pushs/blog.php';
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
			<?php include get_template_directory()."/template/list-societe-no-gutters.php"; ?>
			<?php endif; ?>

		</div>
		<?php
	}else if($post->post_type == "blog"){ ?>
		<?php

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

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="post">
						<?php $sous_titre = get_field("sous-titre_page"); ?>
						<h1 class="post-title<?php echo $sous_titre && $sous_titre != "" ? '' : ' no-baseline'; ?>"><?php the_title(); ?></h1>
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

					<?php get_template_part("flex","content"); ?>
					<div class="clear"></div><div class="separator"></div>
					<div class="badge-list">
						<a class="badge" href="<?php echo get_post_type_archive_link('blog').'?meta_key=entreprise_blog&meta_value='.urlencode(get_field('entreprise_blog')->ID); ?>"><?= !empty(get_field('entreprise_blog')) ? get_field('entreprise_blog')->post_title : "" ?></a>
						<a class="badge" href="<?php echo get_post_type_archive_link('blog').'?meta_key=secteur_blog&meta_value='.urlencode(get_field('secteur_blog')); ?>"><?= !empty(get_field('secteur_blog')) && get_field('secteur_blog') !== 1 ? get_cat_name(get_field('secteur_blog')) : "" ?></a>
						<a class="badge" href="<?php echo get_post_type_archive_link('blog').'?meta_key=axe_blog&meta_value='.urlencode(get_field('axe_blog')); ?>"><?= !empty(get_field('axe_blog')) ? $translate_axe[ICL_LANGUAGE_CODE][get_field('axe_blog')] : "" ?></a>
						<a class="badge" href="<?php echo get_post_type_archive_link('blog').'?meta_key=associes_blog&meta_value='.urlencode(get_field('associes_blog')->ID); ?>"><?= !empty(get_field('associes_blog')) ? get_field('associes_blog')->post_title : "" ?></a>
					</div>
					<?php $associes = get_field('associes_blog'); ?>
					<div class="fiche-associes">
						<img src="<?= $thumb[0] ?>" alt="" />
						<div class="content">
							<a href="<?= get_permalink($associes->ID); ?>"><span class="name"><?php echo $associes->post_title; ?></span></a>
							<span class="post"><?= get_field("poste_membre_equipe", $associes->ID); ?></span>
							<span class="link_vcf"><a href="<?= get_field("vcard_membre_equipe", $associes->ID)['url']; ?>" title="VCard"><?= _e('Contact informations', 'apax') ?></a></span>
						</div>
					</div>
				</div>
				<?php get_sidebar("blog"); ?>
			</div>

		</div>

		<?php
		
	}
	echo '<hr/>';
	
}

function post_action(){
	//error_reporting(E_ALL);
	//ini_set("display_errors", 1);
	global $post,$sitepress;
	global $IS_EXPORT;
	$IS_EXPORT = 1;
	ob_start();
	get_header();
	get_footer();
	ob_clean();
	$oldLang= ICL_LANGUAGE_CODE;
	$sitepress->switch_lang($_POST['lang']);

	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=export.doc');
	?>
	<html>
		<meta charset="utf-8">
		<body>
			<?php
			
			ob_start();
			foreach($_POST['types'] as $type){
				$query = new WP_Query([
					'post_status' => 'publish',
					'post_type' => $type,
					"suppress_filters" => false,
					"post_parent" => 0,
					"posts_per_page" => -1,
					"orderby" => "menu_order title",
					"order" => "ASC",
				]);
				echo "<h1 style=\"border:1px solid black;text-align:center;padding:5px 0;\">Type : ".$type."</h1>";
				foreach($query->posts as $post){
					setup_postdata($post);
					render_post_template($post);
					$child_query = new WP_Query([
						'post_status' => 'publish',
						'post_type' => $type,
						"suppress_filters" => false,
						"post_parent" => $post->ID,
						"posts_per_page" => -1,
						"orderby" => "menu_order title",
						"order" => "ASC",
					]);	
					if($child_query->have_posts()){
						foreach($child_query->posts as $child_post){
							setup_postdata($child_post);
							render_post_template($child_post);
						}
					}
				}
			} 
			$content = ob_get_clean();
			$content = preg_replace("/<img[^>]+\>/i", "", $content);
			$content = preg_replace('/<iframe.*?\/iframe>/i','', $content);
			$content = preg_replace('/<script.*?\/script>/i','', $content);
			$content = preg_replace('/<a href="https:\/\/twitter\.com\/share" .*?\/a>/i','', $content);
			$content = preg_replace('/<div class="flex-to_top">(.|\n|\t)*?<\/div>/i','', $content);

			echo  $content;
			?>
			
		</body>
	</html>
	<?php
	$sitepress->switch_lang($oldLang);
	die();
}

if(isset($_POST, $_POST['lang'], $_POST['types']) && !empty($_POST['lang']) && is_array($_POST['types']) && !empty($_POST['types'])){
	add_action( 'init', 'post_action');
}
