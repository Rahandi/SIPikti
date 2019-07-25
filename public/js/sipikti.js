
$('#sd').click(function(){
	$('#sltp_pendidikan').hide();
	$('#slta_pendidikan').hide();
	$('#diploma_pendidikan').hide();
	$('#sarjana_pendidikan').hide();
	$('#lain_pendidikan').hide();
	$('#sd_pendidikan').show();
});

$('#sltp').click(function(){
	$('#sd_pendidikan').hide();
	$('#slta_pendidikan').hide();
	$('#diploma_pendidikan').hide();
	$('#sarjana_pendidikan').hide();
	$('#lain_pendidikan').hide();
	$('#sltp_pendidikan').show();
});

$('#slta').click(function(){
	$('#sltp_pendidikan').hide();
	$('#sd_pendidikan').hide();
	$('#diploma_pendidikan').hide();
	$('#sarjana_pendidikan').hide();
	$('#lain_pendidikan').hide();
	$('#slta_pendidikan').show();
});

$('#diploma').click(function(){
	$('#sltp_pendidikan').hide();
	$('#slta_pendidikan').hide();
	$('#sd_pendidikan').hide();
	$('#sarjana_pendidikan').hide();
	$('#lain_pendidikan').hide();
	$('#diploma_pendidikan').show();
});

$('#sarjana').click(function(){
	$('#sltp_pendidikan').hide();
	$('#slta_pendidikan').hide();
	$('#diploma_pendidikan').hide();
	$('#sd_pendidikan').hide();
	$('#lain_pendidikan').hide();
	$('#sarjana_pendidikan').show();
});

$('#lainnya').click(function(){
	$('#sltp_pendidikan').hide();
	$('#slta_pendidikan').hide();
	$('#diploma_pendidikan').hide();
	$('#sarjana_pendidikan').hide();
	$('#sd_pendidikan').hide();
	$('#lain_pendidikan').show();
});

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".nextMyModal").click(function(){
	console.log('next pressed');
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	console.log(next_fs);
	//activate next step on progressbar using the index of next_fs
	// $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
		'transform': 'scale('+scale+')',
		'position': 'absolute'
	  });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".next1").click(function(){
	var arr = ['#nama','#nama_gelar','#tempat_lahir','#tanggal_lahir','#asal_jalan','#asal_kelurahan','#asal_kecamatan','#asal_kabupaten','#asal_kode_pos','#surabaya_jalan','#surabaya_kelurahan','#surabaya_kecamatan','#surabaya_kabupaten','#surabaya_kode_pos'];
	// $('#nama').blur(function(){
	var arr_ = []
	jQuery.each(arr, function(i,value){
		if(!$(value).val()) {
			arr_.push(value);
			console.log(arr_);
			console.log('belom keisi');
			// $("#lnama").append("<strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong>");
			$(value+'_label').show();
			if(arr_[0] == value){
				$('html, body').animate({
					scrollTop: $(value).offset().top - 100
				}, 1000, function() {
					$(value).focus();
				});
			}
		}
		else {
			$(value+'_label').hide();
			console.log('next pressed');
		}
	});
	if (arr_.length === 0){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();
		console.log(next_fs);
		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({
			'transform': 'scale('+scale+')',
			'position': 'absolute'
		  });
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	}
});

$(".next2").click(function(){
	var arr = ['#sd_institusi','#sd_tahun_masuk','#sd_tahun_lulus','#sltp_institusi','#sltp_tahun_masuk','#sltp_tahun_lulus','#slta_institusi','#slta_bidang_studi','#slta_tahun_masuk','#slta_tahun_lulus'];
	// $('#nama').blur(function(){
	var arr_ = []
	jQuery.each(arr, function(i,value){
		if(!$(value).val()) {
			arr_.push(value);
			console.log(arr_);
			console.log('belom keisi');
			// $("#lnama").append("<strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong>");
			$(value+'_label').show();
			if(arr_[0] == value){
				$('html, body').animate({
					scrollTop: $(value).offset().top - 100
				}, 1000, function() {
					$(value).focus();
				});
			}
		}
		else {
			$(value+'_label').hide();
			console.log('next pressed');
		}
	});
	if (arr_.length === 0){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();
		console.log(next_fs);
		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({
			'transform': 'scale('+scale+')',
			'position': 'absolute'
		  });
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	}
});

$(".previous").click(function(){
	console.log('prev pressed');
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	console.log('submit pressed');
	return false;
})
