$(document).scroll(function() {
	var scroH = $(document).scrollTop();  //滚动高度
	var viewH = $(window).height();  //可见高度 
	var contentH = $(document).height();  //内容高度
	var defaultShowHead = true
 
	if(scroH >100){  //距离顶部大于100px时
		console.info('变化颜色')
		if(defaultShowHead){
			if(defaultShowHead){
				$("#headerBar").addClass("blackHead")
				// banner图上的搜索隐藏
				$("#conSearch").css('display', 'none')
				// 导航图上的搜索显示
				$("#headerSearch").css('display', 'block')
				// 菜单隐藏
				$("#elmenu").css('display', 'none')
				$("#langth").css('display', 'none')
				defaultShowHead = false
			}
		}
	}
	if (scroH <= 100){  //距离顶部小于100px
		console.info('背景白色')
		$("#headerBar").removeClass("blackHead")
		// 导航图上的搜索隐藏
		$("#headerSearch").css('display', 'none')
		// banner图上的搜索显示
		$("#conSearch").css('display', 'block')
		// 菜单显示
		$("#elmenu").css('display', 'block')
		$("#langth").css('display', 'block')
		defaultShowHead = true
	} 
})
// window.fullpage = function () {
// 	// one start ----->
// 	$('#dowebok').fullpage({
// 		navigation: true,
// 		navigationPosition: 'right',
// 		navigationColor: 'white',
// 		slidesNavPosition: 'top',
// 		controlArrowColor: '#4cabeb',
// 		loopHorizontal: false,
// 		anchors: ['firstPage', 'secondPage', 'thirdPage', 'fourthPage'],
// 		menu: '#copy-menu-item',
// 		sectionsColor: ['#ffffff', '#F8F6F9', '#ffffff', '#F8F6F9'],
// 		scrollingSpeed: 1000,
// 		afterLoad: function(anchorLink, index) {
// 			if (index == 1) {
				
// 			}
// 		},
// 		onLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex) {

// 		},
// 		afterSlideLoad: function(anchorLink, index, slideIndex) {

// 		}

// 	});
// }
