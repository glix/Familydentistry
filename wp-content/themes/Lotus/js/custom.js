/*
	Easy plugin to get element index position
	Author: Peerapong Pulpipatnan
	http://themeforest.net/user/peerapong
*/

var $j = jQuery.noConflict();

$j.fn.getIndex = function(){
	var $jp=$j(this).parent().children();
    return $jp.index(this);
};

$j.fn.setNav = function(){
	$j('#main_menu li ul').css({display: 'none'});

	$j('#main_menu li').each(function()
	{	
		var $jsublist = $j(this).find('ul:first');
		
		$j(this).hover(function()
		{	

			$jsublist.css({opacity: 1});
			
			$jsublist.stop().css({overflow:'hidden', height:'auto', display:'none'}).slideDown(400, function()
			{
				$j(this).css({overflow:'visible', height:'auto', display: 'block'});
			});	
		},
		function()
		{	
			$jsublist.stop().css({overflow:'hidden', height:'auto', display:'none'}).fadeOut(1000, function()
			{
				$j(this).css({overflow:'hidden', display:'none'});
			});	
		});	
		
	});
	
	$j('#main_menu li').each(function()
	{
		

		$j(this).hover(function()
		{	
			$j(this).find('a:first').addClass('hover');
		 	// $j(this).find('a:first').fadeIn(800);
		},
		function()
		{	
			$j(this).find('a:first').removeClass('hover');
		});	
		
	});
	
	$j('#menu_wrapper .nav ul li ul').css({display: 'none'});

	// $j('#menu_wrapper .nav ul li').each(function()
	// {	
		
	// 	var $jsublist = $j(this).find('ul:first');
		
	// 	$j(this).hover(function()
	// 	{	
	// 		$jsublist.css({opacity: 1});
			
	// 		$jsublist.stop().css({overflow:'hidden', height:'auto', display:'none'}).fadeIn(200, function()
	// 		{
	// 			$j(this).css({overflow:'visible', height:'auto', display: 'block'});
	// 		});	
	// 	},
	// 	function()
	// 	{	
	// 		$jsublist.stop().css({overflow:'hidden', height:'auto', display:'none'}).fadeOut(200, function()
	// 		{
	// 			$j(this).css({overflow:'hidden', display:'none'});
	// 		});	
	// 	});	
		
	// });
	
	$j('#menu_wrapper .nav ul li').each(function()
	{
		
		$j(this).hover(function()
		{	
			$j(this).find('a:first').addClass('hover');
		},
		function()
		{	
			$j(this).find('a:first').removeClass('hover');
		});	
		
	});
}

$j(function () {

    	$j('.slideshow').anythingSlider({
    	        easing: "easeInOutExpo",
    	        autoPlay: false,
    	        startStopped: true,
    	        animationTime: 600,
    	        hashTags: false,
    	        buildNavigation: true,
    	        buildArrows: false,
    			pauseOnHover: true,
    			startText: "Go",
    	        stopText: "Stop"
    	    });
    	    
    });

$j(document).ready(function(){ 

	$j("a.faqreply").click(function(){
		$j(this).fadeOut(10);
		$j(this).parent('td').find('div.faqanswerbox').addClass('faqdisplay');
	});
	$j("#content_wrapper .sidebar_content").find("img").addClass("img-frame");
	$j("#footer .posts").find("img").addClass("img_style ");
	// $j(".post_wrapper").find("img").removeClass("img-frame");
// $j(".widgettitle").find("img").removeClass("img-frame");
	$j(".pagination").find("a").addClass("btn btn-primary btn-large");
	$j("#submit").addClass("btn btn-success");
	$j(".datepicker-contact").datepicker({ minDate: 0 });
	 $j('.sidebar_content').find('a').addClass('img_frame');
	  $j('.home .small').find('a').addClass('img_frame');
	$j('.gallery-icon').find('a').addClass('img_frame');
	var i=1;
	var k=0;
	var pause=true;
	$j("#footer .posts").each(function(){
		
		var timer =null;
		$j(this).find("li").css({display:'none',position:'absolute',width:'215px'})
 		$list=$j('#footer .posts li');
		//$j("#footer .posts").find("li").eq(i).fadeIn(1000);
		$value = $list.length;
		$j(this).find("li").eq(0).fadeIn(1000);
		function scroll_(){	
				$j("#footer .posts").find("li").eq(k).fadeOut(2000);
				$j("#footer .posts").find("li").eq(i).delay(1000).fadeIn(1800);
				 k=i;
				 i=i+1;
				if(i==$value){
	 				i= 0;
				};
				
			}

		var timer =null;
		if(pause==true){
			timer =	window.setInterval(function(){scroll_()},8000);
		}

		 $j("#footer .posts").hover(function(){
		 	pause=false;
		 	
      		 window.clearInterval(timer);
         	
		});

       	$j("#footer .posts").on('mouseleave',function(){
       	
			timer =	window.setInterval(function(){scroll_()},8000);
			
	});  



	});	

	// $j('.sub-menu').find('li') .addClass('gradient');
	// $j('.current-menu-item').find('a').addClass('gradient');
	// $j('.sub-menu').find('li').hover(function(){
	// 	// $j(this).removeClass('gradient');
	// 	$j(this).addClass('hovergradient');
	// });
	//  $j(".sub-menu").find('li').on('mouseleave',function(){
 //        	$j(this).removeClass('hovergradient');
	// // 	$j(this).addClass('gradient');
	//  }); 
	// $j('ul.nav').find('li.menu a').hover(function{
	// 	$j(this).addClass('gradient');
	// }) ;
	// $j("ul.nav").find('li.menu').on('mouseleave',function(){
 //        	$j(this).removeClass('gradient');
	// // 	$j(this).addClass('gradient');
	//  });  

	// // $j("#footer .posts li").hover(function(){
 //        postpause = true;
 //        clearInterval(timer);
 //                timer = '';
 //            }, function(){
 //                postpause = false;
 //                //Restart the timer
 //                if(timer == ''){
 //                    timer =	setInterval(function(){
	// 					$j("#footer .posts").find("li").eq(i).fadeIn(1000).delay(6300);
	// 					$j("#footer .posts").find("li").eq(i).fadeOut(1500);			
	// 				    i=i+1;
	// 					if(i==$value){
	// 		 				i= 0;
	// 					};
	// 				},8000);
	// 			};
	// 		});
     
			
	

	$j("#header_wrapper .sub-menu li").find('ul').each(function(){
		$j(this).parent('li').find('a:first').after("<span style='color:red;float:right;margin-top:12px;margin-left:-20px;position:absolute;z-index:9999; width:16px;height:16px' class='img-icon-right'> </span>");
		// $j(this).parent('li').find('span').addClass("img-icon-right");
	});
	// <img style='color:red;position:absolute;margin-top:-30px; margin-left:180px;' alt='->' />

	// $('#content_wrapper').data('nivoslider').start();
	// 	$this.("li").slideDown();
	// });
			
	// $j(".standard_wrapper").find(".one_third").on('mouseenter',
	// 	function(){
	// 		$j(this).find(".one_third_img").addClass("bordercss")
	// 		$j(this).addClass("img-frame");
	// 	});
	// 	$j(".standard_wrapper").find(".one_third").on('mouseleave',function(){
	// 		$j(this).find(".one_third_img").removeClass("bordercss")
	// 		$j(this).removeClass("img-frame");
	//});
	// $j(".sidebar_content").find("img").addClass("img_frame");
	

/* Apply arrow sign  */
	// $j(".nav").find("li > ul").each(function(){
	// 	$j(this).parents('li').addClass('icon-chevron-right');
	// });
	//thi is used for show before and after case photo
	var j=1;
	var l=0;
	$j('.casephoto').find('dl:first').after("<dl class='banner gallery-item'><span class='before'>Before</span><span class='after'>After<span></dl>");

/*	show only single post */ 
		$j("li.casephoto").each(function(){
		$j(this).find("div.casephoto").css({display:'none',position:'absolute'});

		$j(this).find("div.casephoto:first").find('br:first').remove();
		// $j(this).after('<br style="clear:both">');
		// $j(this).find("div.casephoto").find('div.gallery').css({position:'absolute'});
 		$list=$j('li.casephoto div.casephoto');
		//$j("#footer .posts").find("li").eq(i).fadeIn(1000);
		$value = $list.length;
	
		$j(this).find("div.casephoto").eq(0).fadeIn(1000);
		function  beforescroll_(){
			$j("li.casephoto").find("div.casephoto").eq(l).fadeOut(2000);
			$j("li.casephoto ").find("div.casephoto").eq(j).fadeIn(1800);
			l=j;
			j=j+1;			
		    if(j==$value){
 				j = 0;
			};
			
		};
		var timer =null;
		if(pause==true){
			timer =	window.setInterval(function(){beforescroll_()},8000);
		}

		 $j("li.casephoto").hover(function(){
		 	pause=false;
		 	
      		 window.clearInterval(timer);
         	 // $j('#footer .posts').find('li').eq(i).delay(3000).fadeIn().delay(2000);
		});

       	$j("li.casephoto").on('mouseleave',function(){
       		// $j(this).find("li").eq(i).fadeIn(1000).delay(6000);
			// $j(this).find("li").eq(i).delay(3000).fadeOut(2000);
			timer =	window.setInterval(function(){beforescroll_()},8000);
			
	});  

	});

	// $j('img').addClass('img_frame');	
	$j(document).setNav();
	
	$j('.img_frame').fancybox({ 
		padding: 10,
		overlayColor: '#000',
		transitionIn: 'elastic',
		transitionOut: 'elastic',
		overlayOpacity: .8
	});
	
	$j('.pp_gallery a').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'elastic',
		transitionOut: 'elastic',
		overlayOpacity: .8
	});
	$j('.flickr li a').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'elastic',
		transitionOut: 'elastic',
		overlayOpacity: .8
	});
	
	$j('.lightbox').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .8
	});
	
	$j('.lightbox_youtube').fancybox({ 
		padding: 10,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .8
	});
	
	$j('.lightbox_vimeo').fancybox({ 
		padding: 10,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .8
	});
	
	$j('.lightbox_dailymotion').fancybox({ 
		padding: 10,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .8
	});
	
	$j('.lightbox_iframe').fancybox({ 
		padding: 0,
		type: 'iframe',
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .8,
		width: 900,
		height: 650
	});
	
	$j('a.one_fourth_img[rel=gallery]').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		overlayOpacity: .8
	});
	
	$j('#video_gallery_wrapper .one_fourth .portfolio_image .portfolio4_hover a').fancybox({ 
		padding: 10,
		overlayColor: '#000', 
		overlayOpacity: .8
	});
	
	$j.validator.setDefaults({
		submitHandler: function() { 
		    var actionUrl = $j('#contact_form').attr('action');
		    
		    $j.ajax({
  		    	type: 'GET',
  		    	url: actionUrl,
  		    	data: $j('#contact_form').serialize(),
  		    	success: function(msg){
  		    		$j('#contact_form').hide();
  		    		$j('#reponse_msg').html(msg);
  		    	}
		    });
		    
		    return false;
		}
	});
		    
		
	$j('#contact_form').validate({
		rules: {
		    your_name: "required",
		    firstname:"required",
		    lastname:"required",
		    age: "required",
		    emailid:{
		    	required:true,
		    	email:true
		    },
		    address :"required",
		    phonenumber: "required",
		    date: "required",
		    email: {
		    	required: true,
		    	email: true
		    },
		    message: "required"
		},
		messages: {
		    your_name: "Please enter your name",
		    firstname: "pleae enter your first name",
		    lastname: "please enter your last name",
		    age:"please enter a age",
		    emailid:"please enter a valid email adress",
		    adress: "please enter your addres",
		    date: "please enter your date",
		    email: "Please enter a valid email address",
		    agree: "Please enter some message"
		}
	});	
	$j("#appiontment_form").validate({	
		rules :{
			firstname:"required",
		    lastname:"required",
		    age: "required",
		    emailid:{
		    	required:true,
		    	email:true
		    },
		    address :"required",
		    phonenumber: "required",
		    date: "required",
		},
		messages :{
			firstname: "pleae enter your first name",
		    lastname: "please enter your last name",
		    age:"please enter a age",
		    emailid:"please enter a valid email adress",
		    adress: "please enter your Addres",
		    date: "please Select your date"
		},
		submitHandler:function(form){
			form.submit();
		}
	});
	$j("#faq_form").validate({	
		rules :{
			yname:"required",
		    yemail:{
		    	required:true,
		    	email:true
		    },
		    faqs :"required",
		    
		},
		messages :{
			Yname: "pleae enter your  name",
		   	yemail:"please enter a valid email adress",
		    faqs: "please enter your Your question",
		    
		},
		submitHandler:function(form){
			form.submit();
		}
	});
	if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version < 8)
	{
		var zIndexNumber = 1000;
		$j('div').each(function() {
			$j(this).css('zIndex', zIndexNumber);
			zIndexNumber -= 10;
		});

		$j('#thumbNav').css('zIndex', 1000);
		$j('#thumbLeftNav').css('zIndex', 1000);
		$j('#thumbRightNav').css('zIndex', 1000);
		$j('#fancybox-wrap').css('zIndex', 1001);
		$j('#fancybox-overlay').css('zIndex', 1000);
	}
	
	$j(".pp_accordion").accordion({ collapsible: true });
	
	$j(".pp_accordion_close").find('.ui-accordion-header a').click();
	
	$j(".tabs").tabs();
	
	$j('.portfolio1_hover').hide();
	$j('.two_third').hover(function(){  
 			$j(this).find('.portfolio1_hover').show();
 			$j(this).find('img').animate({top: '10px'}, 300);
 			
 			$j(this).click(function(){
 				$j(this).find('a').click();
 			});
 		}  
  		, function(){  
  		
  			$j(this).find('img').animate({top: '20px'}, 300);
  			$j(this).find('.portfolio1_hover').hide();
  		}  
  		
	);
	
	$j('.portfolio2_hover').hide();
	$j('.one_half .portfolio_image').hover(function(){  
 			$j(this).find('.portfolio2_hover').show();
 			$j(this).find('img').animate({top: '11px'}, 300);
 			
 			$j(this).click(function(){
 				$j(this).find('a').click();
 			});
 		}  
  		, function(){  
  		
  			$j(this).find('img').animate({top: '21px'}, 300);
  			$j(this).find('.portfolio2_hover').hide();
  		}  
  		
	);
	
	$j('.portfolio3_hover').hide();
	$j('.one_third .portfolio_image').hover(function(){  
 			$j(this).find('.portfolio3_hover').show();
 			$j(this).find('img').animate({top: '13px'}, 300);
 			
 			$j(this).click(function(){
 				$j(this).find('a').click();
 			});
 		} 
  		, function(){  
  		
  			$j(this).find('img').animate({top: '20px'}, 300);
  			$j(this).find('.portfolio3_hover').hide();
  		}  
  		
	);
	
	$j('.portfolio4_hover').hide();
	$j('.one_fourth .portfolio_image').hover(function(){  
 			$j(this).find('.portfolio4_hover').show();
 			$j(this).find('img').animate({top: '3px'}, 300);
 			
 			$j(this).click(function(){
 				$j(this).find('a').click();
 			});
 		}  
  		, function(){  
  		
  			$j(this).find('img').animate({top: '10px'}, 300);
  			$j(this).find('.portfolio4_hover').hide();
  		}  
  		
	);
	
	$j('.post_img').hover(function(){  
 			$j(this).find('img').animate({top: '0px'}, 300);
 			
 			$j(this).click(function(){
 				$j(this).find('a').click();
 			});
 		}  
  		, function(){  
  		
  			$j(this).find('img').animate({top: '15px'}, 300);
  		}  
  		
	);
	
	$j('.pp_gallery a img').hover(function(){  
 			$j(this).animate({top: '-3px'}, 100);
 		}  
  		, function(){  
  		
  			$j(this).animate({top: '0px'}, 100);
  		}  
  		
	);
	
	$j('.home_portfolio_grid').hover(function(){  
 			$j(this).animate({top: '-5px'}, 300);
 		}  
  		, function(){  
  		
  			$j(this).animate({top: '5px'}, 300);
  		}  
  		
	);
	
	$j('.card_portfolio_grid').hover(function(){  
 			$j(this).animate({top: '-10px'}, 300);
 		}  
  		, function(){  
  		
  			$j(this).animate({top: '0px'}, 300);
  		}  
  		
	);
	
	// $j('.img_nofade').hover(function(){  
	// 		$j(this).animate({opacity: 1}, 300);
 // 		}  
 //  		, function(){  
 //  			$j(this).animate({opacity: .7}, 300);
 //  		}  
  		
	// );
	
	$j('.tipsy').tipsy({fade: false, gravity: 's'});
	
	/*$j('.one_sixth_img').tipsy({fade: false, gravity: 'n'});
	
	$j('.one_third_img').tipsy({fade: false, gravity: 'n'});
	
	$j('.one_fourth_img').tipsy({fade: false, gravity: 'n'});*/
	
	/*Cufon.replace('h1.cufon');
	Cufon.replace('h2.cufon');
	Cufon.replace('h2.widgettitle');
	Cufon.replace('h3.cufon');
	Cufon.replace('h4.cufon');
	Cufon.replace('h5.cufon');
	Cufon.replace('h6.cufon');
	Cufon.replace('.tagline');
	Cufon.replace('.pricing_box h2');
	Cufon.replace('.pricing_box .header span');
	Cufon.replace('.dropcap1');
	Cufon.replace('.circle_date a');
	Cufon.replace('.page_caption h1.cufon');
	Cufon.replace('.tagline h2.cufon');
	Cufon.replace('.tagline p');
	Cufon.replace('.ui-accordion-header');*/
	
	var footerLi = 0;
	$j('#footer .sidebar_widget li.widget').each(function()
	{
		footerLi++;
		
		if(footerLi%4 == 0)
		{ 
			$j(this).addClass('widget-four');
		}
	});
	
	VideoJS.setupAllWhenReady({
      controlsBelow: false, // Display control bar below video instead of in front of
      controlsHiding: true, // Hide controls when mouse is not over the video
      defaultVolume: 0.85, // Will be overridden by user's last volume if available
      flashVersion: 9, // Required flash version for fallback
      linksHiding: true // Hide download links when video is supported
    });
	
	$j('.home_portfolio img.frame').each(function()
	{
		$j(this).hover(function()
		{	
			$j(this).animate({top: '-10px'}, 300);
		},
		function()
		{	
			$j(this).animate({top: 0}, 300);
		});	
	});
	
	$j('.html5_wrapper').hide();
	
	$j('input[title!=""]').hint();
	
	$j('.portfolio_title').tipsy({fade: true, gravity: 's'});
	
	$j('a.portfolio_image.gallery').tipsy({fade: true, gravity: 's'});
	
	$j('.tagline').css('visibility', 'visible');
	
});




