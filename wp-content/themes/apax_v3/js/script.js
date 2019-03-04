var slideshow;

function getUrlParam(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}
	
$(document).ready(function(){

	$("iframe").each(function(){
		if (!$(this).parent().hasClass("fluidMedia")) {
			$(this).wrap("<div class='fluidMedia'></div>" );
		}
	});

	if (oJson.isHome) {
		slideshow = $("#slide-actu").cycle({
			slides: '> .block-push',
			timeout: 4000,
			pauseOnHover: true,
			prev: '#prev-slide-actu',
			next: '#next-slide-actu',
			pager: '#pager-cycle-actu'
		});
		var progress = $('#progress-slide-actu');

		slideshow.on( 'cycle-initialized cycle-before', function( e, opts ) {
			progress.stop(true).css( 'width', 0 );
		});

		slideshow.on( 'cycle-initialized cycle-after', function( e, opts ) {
			if ( ! slideshow.is('.cycle-paused') )
				progress.animate({ width: '100%' }, opts.timeout, 'linear' );
		});

		slideshow.on( 'cycle-paused', function( e, opts ) {
		   progress.stop();
		});

		slideshow.on( 'cycle-resumed', function( e, opts, timeoutRemaining ) {
			progress.animate({ width: '100%' }, timeoutRemaining, 'linear' );
		});


		var slideshowentre = $("#slide-entrepreneur").cycle({
			slides: '> .block-entrepreneur',
			timeout: 4000,
			pauseOnHover: true,
			prev: '#prev-slide-entrepreneur',
			next: '#next-slide-entrepreneur',
			pager: '#pager-cycle-entrepreneur'
		});

		slideshowentre.on( 'cycle-initialized cycle-after', function( e, opts ) {
			var currSlide = slideshowentre.data("cycle.opts").currSlide;
			var currentClick = $("#slide-entrepreneur > .block-entrepreneur:not(.cycle-sentinel):eq("+currSlide+")").data("click");
			$(".bt-click a").removeClass("active");
			$("#bt-click-"+currentClick).addClass("active");
		});
	}

	$("#header .menu > li").hover(function(){
		if (!$(this).hasClass("current-menu-item") && !$(this).hasClass("current_page_parent"))
			$("#header .menu li.current-menu-item ul, #header .menu li.current_page_parent ul").addClass("hoverHide");
	},function(){
		$("#header .menu li ul").removeClass("hoverHide");
	});

	$("#lstancres a").click(function(e){
		e.preventDefault();
		var anchor = $($(this).attr("href")).offset().top-50;
		$.scrollTo(anchor,400);
	});

	$("#gototop, .flex-to_top a").click(function(e) {
		e.preventDefault();
		$.scrollTo(0,400);
	});

	$("#resetSearch").click(function(e){
		e.preventDefault();
		$("#s").val("").focus();
	});

	$("#menu_oc_min").click(function(e){
		if ($(this).hasClass("open")){
			$(this).removeClass("open");
			$(this).prev().slideUp(300);
		} else {
			$(this).addClass("open");
			$(this).prev().slideDown(300);
		}
		e.preventDefault();
	});

	$(".menu > li > a").click(function(e){
		if ($(window).width() < 992) {
			var li = $(this).parent();
			if (li.find("ul").length > 0) {
				e.preventDefault();
				if (li.find("ul").css("display") == "none") {
					li.find("ul").slideDown(300);
				} else {
					li.find("ul").slideUp(300);
				}
			}
		}
	});

	heightGridItemName();

	$(window).resize();

	$(window).scroll(function(){
		$(".animated-number").each(function(){
			if (!$(this).hasClass("isAnimated")){
				var $blocStat = $(this);
				if ($blocStat.is(":visible") && $(this).data("stats")) {
					if ($(this).offset().top < $(window).scrollTop()+$(window).height()){
						var separator = null;
						var decimalLength = 0;
						if ($("body").hasClass("fr")) {
							var commaSeparateNumber = false;
							var spaceSeparateNumber = true;
						} else {
							var commaSeparateNumber = true;
							var spaceSeparateNumber = false;
						}
						if($(this).data("stats").toString().lastIndexOf('.') >= 0){
							separator = '.';
						}
						else if(spaceSeparateNumber && $(this).data("stats").toString().lastIndexOf(',') >= 0){
							separator = ',';
						}
						if(separator != null){
							decimalLength = ($(this).data("stats").toString().length-1)-$(this).data("stats").toString().lastIndexOf(separator)
						}
						$(this).addClass("isAnimated");
						var number = parseFloat($(this).data("stats").toString())
						if(commaSeparateNumber){
							number = parseFloat($(this).data("stats").toString().replace(',', ''));
						}else if(spaceSeparateNumber){
							number = $(this).data("stats").toString().replace(',', '.');
							number = number.toString().replace(' ', '');
						}
						$(this).animateNumber({
							number: number,
							numberStep: function(now, tween) {
								var target = $(tween.elem);
								var text = parseFloat(Math.round(now * 100) / 100).toFixed(decimalLength).toString();
								if(commaSeparateNumber){
									var decimalComma = text.split('.')[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
									text = text.replace(text.split('.')[0], decimalComma);
								}else if(spaceSeparateNumber){
									// text = text.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ");
									var decimalComma = text.split('.')[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ");
									text = text.replace(text.split('.')[0], decimalComma);
									text = text.replace(".",",");
								}
								target.text(text);								
							},
						},2000);
					}
				}
			}
		});
	});
	$(window).scroll();
});

function heightGridItemName() {
	$(".grid .grid-item, .row .col-md-4, #sidebar .col-sm-6, #slide-entrepreneur .block-entrepreneur, #homecurrentlysuppentr .col-sm-6").each(function(){
		var $this = $(this);
		setTimeout(function() {
			var a = $this.find("a:not(.bloc-ele-partenaire)");
			if (a.outerHeight() == 0) {
				a.find("span.name").height(a.parent().outerHeight());
			} else {
				a.find("span.name").height(a.outerHeight());
			}
		},200);
	});
}

$(window).resize(function(){

	if ($("#menu-lang-mobile").length == 0) {
		$('<div id="menu-lang-mobile"></div>').insertBefore($("#search"));
		$("#menu-lang-mobile").append($(".menu li a.lang").clone());
	}
	if ($("#imgapaxtalksfooter").length == 0) {
		var img = $("#blog_info a img:first").clone().attr("id","imgapaxtalksfooter");
		$("#blog_info a").prepend(img);
	}
	if (oJson.isHome && $("#homecurrentlysuppentr").length == 0) {
		$('<div id="homecurrentlysuppentr"></div>').insertBefore($("#slide-entrepreneur").parent());
		var ul = $("#slide-entrepreneur").parent().find("ul.bt-click");
		ul.find("li").each(function(){
			var a = $(this).find("a:first").clone().addClass("click");
			var img = $("#slide-entrepreneur .block-entrepreneur[data-click="+a.attr("id").substring(9)+"] a").addClass("img").clone();
			a.attr("id",a.attr("id")+"-mob");
			$("#homecurrentlysuppentr").append($('<div class="col-sm-6"/>').append(img).append(a));
		});
	}
	if (oJson.isHome && $("#homeslideactu").length == 0) {
		$('<div id="homeslideactu"></div>').insertBefore($("#slide-actu"));
		$("#slide-actu a.block-push:not(.cycle-sentinel)").each(function(){
			$("#homeslideactu").append($(this).clone().attr("style",""));
		});
	}

	if ($("#list-cat-element").length && $("#list-cat-element-select").length == 0){
		var $selADAKA = $('<select id="list-cat-element-select"></select>');
		var $i=0;
		$("#list-cat-element li").each(function(){
			var li = $(this).clone().removeClass("active cat-item");
			$selADAKA.append('<option'+($i==0?' selected="selected"':'')+' value="'+li.attr("class")+'">'+li.text()+'</option>');
			$i++;
		});
		$selADAKA.insertBefore($("#list-cat-element"));
		$("#list-cat-element-select").adakaListMultiple({flottant:true}).change(function(){
			$("#list-cat-element li."+$(this).val()).trigger("click");
		});
	}

	if ($(window).height()<500) {
		$("body").addClass("stopFix");
	} else {
		$("body").removeClass("stopFix");
	}

	heightGridItemName();
});
