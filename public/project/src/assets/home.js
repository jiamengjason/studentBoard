let fullPage = {
// one start ----->
	dowebok: function(){
		$('#dowebok').fullpage({
			navigation: true,
			navigationPosition: 'right',
			navigationColor: 'white',
			slidesNavPosition: 'top',
			controlArrowColor: '#4cabeb',
			loopHorizontal: false,
			anchors: ['firstPage', 'secondPage', 'thirdPage', 'fourthPage'],
			menu: '#copy-menu-item',
			sectionsColor: ['#ffffff', '#F8F6F9', '#ffffff', '#F8F6F9'],
			scrollingSpeed: 1000,
			afterLoad: function(anchorLink, index) {
	
				if (index == 1) {
					
				}
			},
			onLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex) {
	
			},
			afterSlideLoad: function(anchorLink, index, slideIndex) {
	
			}
	
		});
	}
}

export default fullPage