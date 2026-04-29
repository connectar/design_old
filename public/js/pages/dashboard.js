//[Dashboard Javascript]

//Project:	Crypto Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';

  // SLIMSCROLL FOR CHAT WIDGET
  // $('#direct-chat').slimScroll({
  //   height: '370px'
  // });

//ticker
 	if ($('#webticker-8').length) {
		$("#webticker-8").webTicker({
			height:'auto',
			duplicate:true,
			startEmpty:false,
			rssfrequency:5,
			direction: 'left'
		});
	}


}); // End of use strict

