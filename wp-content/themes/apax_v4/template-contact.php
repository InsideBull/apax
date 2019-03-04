<?php /* Template name: Contact */ ?>
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

	<?php $titre_sous_carte = get_field("titre_sous_carte");
	$texte_sous_carte = get_field("texte_sous_carte");
	if ($titre_sous_carte != "" || $texte_sous_carte != "") {
		echo '<div class="row">
				<div class="col-md-10 col-md-offset-1" id="texte-sous-carte-contact">
					'.($titre_sous_carte ? '<h2 class="underline">'.$titre_sous_carte.'</h2>' : '').'
					'.$texte_sous_carte.'
				</div>
			</div>';
	} ?>


	<?php $siege_social = get_field("siege_social_contact");
	if ($siege_social != "") {
		echo '<div class="row">
			<div class="col-md-10 col-md-offset-1" id="siege-contact">
				<h2 class="underline">'.__("Head Office","apax").'</h2>
				'.$siege_social.'
			</div>
		</div>';
	} ?>


</div>

<div id="google-map-contact" class="page-content"></div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
