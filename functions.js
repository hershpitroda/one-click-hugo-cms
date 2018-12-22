$(document).ready(function(){
	
	//var admin_script_path = "/burosys/admin/actions/";
	//var admin_script_path = "/development/admin/actions/";
	var admin_script_path = "/admin/actions/";
	
	//Cycle event for the intro panel
	$('#slider').cycle({
		timeout:5000,
		speed:650,
		fx:'fade',
		pause:true,
		pager:  '#nav',
		// callback fn that creates a thumbnail to use as pager anchor 
		pagerAnchorBuilder: function(idx, slide) { 
			return '<li><a href="#"></a></li>'; 
		}
	});
	
	//Cycle event for the intro panel
	$('#ads').cycle({
		timeout:5000,
		speed:650,
		fx:'fade',
		pause:true
	});
	
	//Cycle event for the featured projects
	$('#fproject .gallery .images').cycle({
		timeout:0,
		speed:650,
		fx:'fade',
		pause:true,
		pager:  '#fproject #paging',
		// callback fn that creates a thumbnail to use as pager anchor 
		pagerAnchorBuilder: function(idx, slide) { 
			return '<li><a href="#"></a></li>'; 
		}
	});
	
	//secondary menu roll over options
	$('.subcat').hover(function(){
		$(this).siblings('a').addClass('sel');
	}, function(){
		$(this).siblings('a').removeClass('sel');
	});
	
	$('.subcat2').hover(function(){
		$(this).siblings('a').addClass('sel');
		$(this).parent().parent('.subcat').siblings('a').addClass('sel');
	}, function(){
		$(this).siblings('a').removeClass('sel');
	});
	
	/*$('.catlist > li > a').hover(function(){
		$(this).siblings('.subcat').slideDown(250);
	}, function(){
		$(this).siblings('.subcat').slideUp(250);
	});*/
	
	$('.thumbs .wrapper li:first-child > a').addClass('sel');
	
	$('#intro #prev').click(function(){
		$('#slider').cycle("prev");
	});
	
	$('#intro #next').click(function(){
		$('#slider').cycle("next");
	});

	//Hover event for primary links
	$('#pmenu > li > a').hover(function(){
		if( $(this).hasClass('sel') ){
			return false;
		}else{
			$(this).css('color','#cd2222');	
		}
	}, function(){
		if( $(this).hasClass('sel') ){
			return false;
		}else{
			$(this).css('color','#505050');	
		}
	});
	
	//Hover event for side panel links
	$('.info strong a, .mailto').hover(function(){
		if( $(this).hasClass('sel') ){
			return false;
		}else{
			$(this).css('color','#cd2222');	
		}
	}, function(){
		if( $(this).hasClass('sel') ){
			return false;
		}else{
			$(this).css('color','#a0a0a0');	
		}
	});
	
	//Hover event for product name
	$('.info span a, #sitemap a').hover(function(){
		if( $(this).hasClass('sel') ){
			return false;
		}else{
			$(this).css('color','#cd2222');	
		}
		
	}, function(){
		if( $(this).hasClass('sel') ){
			return false;
		}else{
			$(this).css('color','#505050');	
		}
	});
	
	
	
	//Search watermark (placeholder)
	$('#q').watermark('Search for a specific product');
	
	//Search focus and blur event
	$('#q').bind("focus", function(){ 
		$(this).animate( {'width':300+'px'}, 150 ); 
		//$(this).css({'background':'#359fdb', 'color':'#ffffff'});
	});
	$('#q').bind("blur", function(){ 
		if( $(this).val() == '' ){
			$(this).animate( {'width':200+'px'}, 150 );
			//$(this).css({'background':'#efefef', 'color':'#505050'});
		}
	});
	
	//Clear search click event
	$('#q ~ a').click(function(){
		$('#q').val('');
		$('#q').animate( {'width':200+'px'}, 150 );
		//$('#srch_input').css({'background':'#efefef', 'color':'#505050'});
	});
	
	$('.listing li').hover(function(){
		$('.listing li .details, .listing li img').css('z-index',0);
		$(this).children('a').children('img').css('z-index',90);
		$(this).children('.details').css('z-index',80);
		$(this).children('.details').stop().fadeIn(100);
	}, function(){
		$(this).children('.details').fadeOut(100);
		$('.listing li .details').css('z-index',80);
	});
	
	//Clients image hover event
	$('#clients li').hover(function(){
		$(this).find('img').stop().animate({'top':0+'px'},250);
		$(this).children('.bubble').fadeIn(300);
	}, function(){
		$(this).find('img').stop().animate({'top':-118+'px'},250);
		$(this).children('.bubble').fadeOut(300);
	});
	
	//Product image hover
	$('.thumbs .wrapper li a').click(function(event){
		event.preventDefault();
		$('.thumbs .wrapper li a').removeClass('sel');
		$(this).addClass('sel');
		var img = $(this).find('img').attr('src').replace('thumb','big');
		var img_xl = $(this).find('img').attr('src').replace('thumb','xl');
		$('.gallery .fancybox').attr('href',img_xl);
		$('.gallery .fancybox img').attr('src',img);
	});
	
	//Product thumb next
	var next_flag = true;
	
	$('.thumbs > .next').click(function(event){
		event.preventDefault();
		if( next_flag ){
			
			var curr_left = parseInt($('.thumbs .wrapper ul').css('left').replace('px',''));
			var total_length = $('.thumbs .wrapper ul li').length;
			var total_length_px = ((total_length-4) * 70);
			var total_margin_px = ((total_length-4) * 10);
			var final_length_px = total_length_px + total_margin_px;
			var scroll_length_px = (1 * 70) + 10;
			if( curr_left <= -(final_length_px - scroll_length_px) ){
					return false;
			}else{
					var new_left = curr_left - scroll_length_px;
					$('.thumbs .wrapper ul').animate({'left':new_left+'px'}, 250);
			}
			
			next_flag = false;
		
			setTimeout(function() {
				next_flag = true;
			}, 500);
			
		}
	});
	
	//Product thumb prev
	var prev_flag = true;
	
	$('.thumbs > .prev').click(function(event){
		event.preventDefault();
		
		if( prev_flag ){
			
			var curr_left = parseInt($('.thumbs .wrapper ul').css('left').replace('px',''));
			var total_length = $('.thumbs .wrapper ul li').length;
			var total_length_px = ((total_length-4) * 70);
			var total_margin_px = ((total_length-4) * 10);
			var final_length_px = total_length_px + total_margin_px;
			var scroll_length_px = (1 * 70) + 10;
			if( curr_left >= 0 ){
				return false;
			}else{
				var new_left = curr_left + scroll_length_px;
				$('.thumbs .wrapper ul').animate({'left':new_left+'px'}, 250);
			}
			
			prev_flag = false;
		
			setTimeout(function() {
				prev_flag = true;
			}, 500);
			
		}
	});
	
	//Admin panel functions
	$('#chk_box').click(function(){
		$('.plist .col1 input').attr("checked",$(this).prop("checked"));
	});
	
	$('#chk_gallery').click(function(){
		$('.addimg .col1 input').attr("checked",$(this).prop("checked"));
	});
	
	$('#chk_relprod').click(function(){
		$('.relprod .col1 input').attr("checked",$(this).prop("checked"));
	});
	
	$('#sel_category').change(function(){
		var cat_id = $(this).val();
		$('#sel_collection').load('get_collection.php?cat_id=' + cat_id);
	});
	
	//Admin panel product filters
	$('#filter_category').change(function(){
		var cat_id = $(this).val();
		if( cat_id != 0 ){
			$('#filter_collection').load('filter.php?cat_id=' + cat_id);
			$('#listing').load('list.php?cat_id=' + cat_id);
		}else{
			alert('Please select a category to filter');
		}
	});
	
	$('#filter_collection').on("change", function(){
		var col_id = $(this).val();
		if( col_id != 0 ){
			$('#filter_product').load('filter.php?col_id=' + col_id);
			$('#listing').load('list.php?col_id=' + col_id);
		}else{
			alert('Please select a category to filter');
		}
	});
	
	$('#filter_product').on("change", function(){
		var prod_id = $(this).val();
		if( prod_id != 0 ){
			$('#listing').load('filter.php?prod_id=' + prod_id);
		}else{
			alert('Please select a category to filter');
		}
	});
	
	$('#filter_clients').on("change", function(){
		var industry_id = $(this).val();
		if( industry_id != 0 ){
			$('#listing').load('clientlist.php?industry_id=' + industry_id);
		}else{
			alert('Please select an industry to filter');
		}
	});
	
	//Admin panel options functions
	$('.enable_sel').click(function(){
	
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=1",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	
	});
	
	$('.disable_sel').click(function(){
									 
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=2",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	
	});
	
	$('.featured_sel').click(function(){
									  
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=3",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	
	});
	
	$('.bestseller_sel').click(function(){
										
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=4",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	
	});
	
	$('.featured_inactive_sel').click(function(){
									  
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=5",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	
	});
	
	$('.bestseller_inactive_sel').click(function(){
										
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=6",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	
	});
	
	$('.enable_sel_client').click(function(){
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "client_checkbox_options.php?opt=1",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.disable_sel_client').click(function(){						 
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "client_checkbox_options.php?opt=2",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.featured_sel_client').click(function(){
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "client_checkbox_options.php?opt=3",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.featured_inactive_sel_client').click(function(){						 
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "client_checkbox_options.php?opt=4",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.unsubscribe_nl').click(function(){
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "nl_checkbox_options.php?opt=1",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.subscribe_nl').click(function(){						 
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "nl_checkbox_options.php?opt=2",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.active_nl').click(function(){
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "nl_checkbox_options.php?opt=3",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.inactive_nl').click(function(){						 
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "nl_checkbox_options.php?opt=4",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.enable_sel_project').click(function(){
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "project_options.php?opt=1",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.disable_sel_project').click(function(){						 
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "project_options.php?opt=2",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.featured_sel_project').click(function(){
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "project_options.php?opt=3",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.featured_inactive_sel_project').click(function(){						 
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "project_options.php?opt=4",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.enable_sel_home').click(function(){
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=1",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	$('.disable_sel_home').click(function(){						 
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=2",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	$('.delete_home').click(function(){						 
		var myCheckboxes = new Array();
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=2",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	$('.delete').click(function(){						 
		var myCheckboxes = new Array();
		var id = $(this).attr('id').replace('-del','');
		var file_path = admin_script_path + 'delete.php?page=' + id;
		$("#listing input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : file_path,
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	/* ADD / EDIT PRODUCT ACTIONS */
	
	$('.enableimg').click(function(){
		
		var id = $(this).attr('id').replace('enableimg_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		$.ajax({
			url : admin_script_path + 'prod_options.php?opt=enimg&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproduct.php?pid=' + prod_id;
			}
		});
	});
	
	$('.disableimg').click(function(){
		
		var id = $(this).attr('id').replace('disableimg_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		$.ajax({
			url : admin_script_path + 'prod_options.php?opt=disimg&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproduct.php?pid=' + prod_id;
			}
		});
	});
	
	$('.delimg').click(function(){
		
		var id = $(this).attr('id').replace('delimg_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		$.ajax({
			url : admin_script_path + 'prod_options.php?opt=delimg&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproduct.php?pid=' + prod_id;
			}
		});
	});
	
	$('.enablerel').click(function(){
		
		var id = $(this).attr('id').replace('enablerel_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		$.ajax({
			url : admin_script_path + 'prod_options.php?opt=enrel&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproduct.php?pid=' + prod_id;
			}
		});
	});
	
	$('.disablerel').click(function(){
		
		var id = $(this).attr('id').replace('disablerel_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		$.ajax({
			url : admin_script_path + 'prod_options.php?opt=disrel&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproduct.php?pid=' + prod_id;
			}
		});
	});
	
	$('.delrel').click(function(){
		
		var id = $(this).attr('id').replace('delrel_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		console.log(id + ' ' + prod_id);
		$.ajax({
			url : admin_script_path + 'prod_options.php?opt=delrel&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproduct.php?pid=' + prod_id;
			}
		});
	});
	
	/* ADD / EDIT PROJECT ACTIONS */
	
	$('.enableimg_proj').click(function(){
		
		var id = $(this).attr('id').replace('enableimg_proj_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		console.log(id + ' ' + prod_id);
		$.ajax({
			url : admin_script_path + 'proj_options.php?opt=enimg&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproject.php?pid=' + prod_id;
			}
		});
	});
	
	$('.disableimg_proj').click(function(){
		
		var id = $(this).attr('id').replace('disableimg_proj_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		$.ajax({
			url : admin_script_path + 'proj_options.php?opt=disimg&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproject.php?pid=' + prod_id;
			}
		});
	});
	
	$('.delimg_proj').click(function(){
		
		var id = $(this).attr('id').replace('delimg_proj_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		$.ajax({
			url : admin_script_path + 'proj_options.php?opt=delimg&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproject.php?pid=' + prod_id;
			}
		});
	});
	
	$('.enablerel_proj').click(function(){
		
		var id = $(this).attr('id').replace('enablerel_proj_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		$.ajax({
			url : admin_script_path + 'proj_options.php?opt=enrel&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproject.php?pid=' + prod_id;
			}
		});
	});
	
	$('.disablerel_proj').click(function(){
		
		var id = $(this).attr('id').replace('disablerel_proj_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		$.ajax({
			url : admin_script_path + 'proj_options.php?opt=disrel&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproject.php?pid=' + prod_id;
			}
		});
	});
	
	$('.delrel_proj').click(function(){
		
		var id = $(this).attr('id').replace('delrel_proj_','');
		var prod_id = $(this).siblings('input[type="hidden"]').val();
		console.log(id + ' ' + prod_id);
		$.ajax({
			url : admin_script_path + 'proj_options.php?opt=delrel&id=' + id,
			type:"POST",
			dataType:"html",
			cache:false,
			success:function(data, textStatus, jqXHR){
				window.location = 'addproject.php?pid=' + prod_id;
			}
		});
	});
	
	/* ADD / EDIT INTRO ACTIONS */
	$('.enable_sel_intro').click(function(){
	
		var myCheckboxes = new Array();
		$(".col1 input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=1",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	
	});
	
	$('.disable_sel_intro').click(function(){
									 
		var myCheckboxes = new Array();
		$(".col1 input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=2",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
				//alert(data);
			}
		});
	});
	
	$('.delete_intro').click(function(){						 
		var myCheckboxes = new Array();
		var id = $(this).attr('id').replace('-del','');
		var file_path = admin_script_path + 'delete.php?page=' + id;
		$(".col1 input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : file_path,
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	//ENABLE / DISBALE BACKGROUND IMAGES
	$('.enable_sel_bg').click(function(){
		var myCheckboxes = new Array();
		$(".backgrounds .col1 input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=1",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	$('.disable_sel_bg').click(function(){						 
		var myCheckboxes = new Array();
		$(".backgrounds .col1 input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=2",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	//ENABLE / DISBALE ADS IMAGES
	$('.enable_sel_ads').click(function(){
		var myCheckboxes = new Array();
		$(".intro .col1 input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=1",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	$('.disable_sel_ads').click(function(){						 
		var myCheckboxes = new Array();
		$(".intro .col1 input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=2",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	//ENABLE / DISBALE / DELETE DOWNLOADS
	$('.enable_sel_dl').click(function(){
		var myCheckboxes = new Array();
		$(".downloads .col1 input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=1",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	$('.disable_sel_dl').click(function(){						 
		var myCheckboxes = new Array();
		$(".downloads .col1 input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : "checkbox_options.php?opt=2",
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	$('.delete_dl').click(function(){						 
		var myCheckboxes = new Array();
		var id = $(this).attr('id').replace('-del','');
		var file_path = admin_script_path + 'delete.php?page=' + id;
		$(".col1 input[type='checkbox']:checked").each(function() {
			myCheckboxes.push($(this).attr('id').replace('chk_box_',''));
		});
		
		$.ajax({
			url : file_path,
			type:"POST",
			dataType:"html",
			cache:false,
			data:{ myCheckboxes:myCheckboxes },
			success:function(data, textStatus, jqXHR){
				window.location = 'index.php';
			}
		});
	});
	
	//Admin panel add/edit related products
	$('.relcat').on("change", function(){
		var id = $(this).attr('id').replace('sel_relcat_','');
		var id_val = $(this).val();
		var rel_col_id = "#sel_relcol_" + id;
		$(rel_col_id).load('get_collection.php?cat_id=' + id_val);
	});
	
	$('.relcol').on("change", function(){
		var id = $(this).attr('id').replace('sel_relcol_','');
		var id_val = $(this).val();
		var rel_prod_id = "#sel_relprod_" + id;
		$(rel_prod_id).load('get_products.php?col_id=' + id_val);
	});
	
	$(".fancybox").fancybox({
		helpers : {
    		title : {
    			type : 'inside'
    		}
		}
	});
	
	//Google maps
	$("#directions").gmap3({
		action: 'init',
		options:{
			center:[18.96005, 72.81399],
			zoom:16,
			mapTypeId: google.maps.MapTypeId.MAP,
			mapTypeControl: true,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
			},
			navigationControl: true,
			scrollwheel: true,
			streetViewControl: false
		}
	}, 
	{
		action:'addMarker',
		latLng:[18.96005, 72.81399]
	});
	
	

});