<?php global $wp_query; ?>

<?php 
	$nbRes = $wp_query->found_posts; 
	$removeScriptTags = true;
?>

<?php get_header(); ?>

<div class="container" id="res_search">
	<?php get_search_form(); ?>
	
	<?php if ($nbRes == 0)
	{
	
		 echo '<h2>'.__('No results...', 'apax').'</h2>
		<p>
			'.__('You can search again.', 'apax').'<br>
		</p>';
	} else {
		
		echo '<div class="row">
			<div class="col-md-offset-1 col-md-10">';
		
		$paged = get_query_var( 'paged');
		if ($paged == 0)
			$count = 1;
		else
			$count = ($paged-1)*intval(get_option('posts_per_page'))+1;
		
		// echo '<h2 style="margin-bottom: 30px; font-size: 2rem;">'.$nbRes.' résultat'.($nbRes>1?'s':'').'</h2>';
		while ( have_posts() ) : the_post();
			echo '<div class="bloc_res_search">
				<a class="title" href="'.get_permalink().'">'.$count.'. '.get_the_title().'</a>';
				
			$cut = "";
			if ($post->post_type == "societe") {
				$cut = substr(strip_tags(get_field("profil_societe")),0,200);
				if ($cut < strip_tags(get_field("profil_societe"))) $cut.= '...';
			} else if ($post->post_type == "team") {
				$cut = substr(strip_tags(get_field("presentation_membre_equipe")),0,200);
				if ($cut < strip_tags(get_field("presentation_membre_equipe"))) $cut.= '...';
			} else if (get_page_template_slug() == "template-historique.php") {
				$content = get_field("liste_accordeon");
				$origine = $content[0]["titre"].' - '.$content[0]["liste_societes"][0]["nom_societe"].' - '.$content[0]["liste_societes"][0]["description"];
				$cut = substr(strip_tags($origine),0,200);
				if ($cut < strip_tags($origine)) $cut.= '...';
			} else if (get_page_template_slug() == "template-list-societe.php") {
				$ele = get_posts("post_type=societe&posts_per_page=-1&orderby=menu_order&order=ASC");
				$origine = "";
				foreach ($ele as $e) $origine .= ($origine == "" ? "" : ", ").$e->post_title;
				$cut = substr(strip_tags($origine),0,200);
				if ($cut < strip_tags($origine)) $cut.= '...';
			} else if (get_page_template_slug() == "template-contact.php") {
				$origine = get_field("siege_social_contact");
				$cut = substr(strip_tags($origine),0,200);
				if ($cut < strip_tags($origine)) $cut.= '...';
			} else if (get_page_template_slug() == "template-list-equipe.php") {
				$ele = get_posts("post_type=team&posts_per_page=-1&orderby=menu_order&order=ASC");
				$origine = "";
				foreach ($ele as $e) $origine .= ($origine == "" ? "" : ", ").$e->post_title;
				$cut = substr(strip_tags($origine),0,200);
				if ($cut < strip_tags($origine)) $cut.= '...';
			} else if (get_page_template_slug() == "") {
				ob_start();
				include "flex-content.php";
				$origine = trim(preg_replace('/\t+/', '',strip_tags(ob_get_contents())));
				ob_end_clean();
				$cut = substr(strip_tags($origine),0,200);
				if ($cut < strip_tags($origine)) $cut.= '...';
			}
			
			if ($cut != "") {
				echo '<a class="desc" href="'.get_permalink().'">'.$cut.'</a>';
			}
			
			echo '</div>';
			$count++;
		endwhile; 
		
		pressPagination();
		
		echo '</div>
		</div>';
	} ?>
	
</div>

<?php get_footer(); ?>