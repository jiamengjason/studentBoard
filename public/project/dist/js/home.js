$(document).scroll(function() {
	var scroH = $(document).scrollTop();  //滚动高度
	var viewH = $(window).height();  //可见高度 
	var contentH = $(document).height();  //内容高度
	var defaultShowHead = true
 
	if(scroH >100){  //距离顶部大于100px时
		console.info('设置')
		if(defaultShowHead){

		}
	}
	if (contentH - (scroH + viewH) <= 100){  //距离底部高度小于100px
		 
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
