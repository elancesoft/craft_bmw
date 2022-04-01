jQuery(document).ready(function ($) {

	// Hide the video control
	var video = document.getElementById('video');
	var video_1 = document.getElementById('video_1');

	var videoWorks = !!document.createElement('video').canPlayType;
	var videoWorks_1 = !!document.createElement('video').canPlayType;
	
	if (videoWorks) {
		video.controls = false;
	}

	if (videoWorks_1) {
		video_1.controls = false;
	}


	// Create button to play
	/*$(document).on('click', '#play_video', function () {
		$('#video').get(0).play();
	});*/

	// Create button to pause
	/*$(document).on('click', '#pause_video', function () {
		$('#video').get(0).pause();
	});*/

	// Click to the video to play
	$(document).on('click', 'video', function () {
		$(this).get(0).play();
	});

	// TAB 1 PROCESS
	$("#keyword_tab1").keyup(function () {
		let keyword = $("#keyword_tab1").val();

		$('#leaderboard_tab1 tr.leaderboard-item').each(function (index, tr) {
			$(tr).find('td.leaderboard-item-name').each(function (index, td) {
				let item_name = $(td).html();

				if (item_name === keyword) {
					$(tr).attr('id', 'leaderboard_item_found_tab1');

				} else {
					$(tr).attr("id", "");
				}
			});
		});
	});
	$(document).on('click', '#btn_leader_board_tab1', function () {
		$('html, body').animate({
			scrollTop: $("#leaderboard_item_found_tab1").offset().top
		}, 1000);
	});


	// TAB 2 PROCESS
	$("#keyword_tab2").keyup(function () {
		let keyword = $("#keyword_tab2").val();

		$('#leaderboard_tab2 tr.leaderboard-item').each(function (index, tr) {
			$(tr).find('td.leaderboard-item-name').each(function (index, td) {
				let item_name = $(td).html();

				if (item_name === keyword) {
					$(tr).attr('id', 'leaderboard_item_found_tab2');

				} else {
					$(tr).attr("id", "");
				}
			});
		});
	});

	$(document).on('click', '#btn_leader_board_tab2', function () {
		$('html, body').animate({
			scrollTop: $("#leaderboard_item_found_tab2").offset().top
		}, 1000);
	});

	// TAB 3 PROCESS
	$("#keyword_tab3").keyup(function () {
		let keyword = $("#keyword_tab3").val();

		$('#leaderboard_tab3 tr.leaderboard-item').each(function (index, tr) {
			$(tr).find('td.leaderboard-item-name').each(function (index, td) {
				let item_name = $(td).html();

				if (item_name === keyword) {
					$(tr).attr('id', 'leaderboard_item_found_tab3');

				} else {
					$(tr).attr("id", "");
				}
			});
		});
	});

	$(document).on('click', '#btn_leader_board_tab3', function () {
		$('html, body').animate({
			scrollTop: $("#leaderboard_item_found_tab3").offset().top
		}, 1000);
	});


	// TAB 4 PROCESS
	$("#keyword_tab4").keyup(function () {
		let keyword = $("#keyword_tab4").val();

		$('#leaderboard_tab4 tr.leaderboard-item').each(function (index, tr) {
			$(tr).find('td.leaderboard-item-name').each(function (index, td) {
				let item_name = $(td).html();

				if (item_name === keyword) {
					$(tr).attr('id', 'leaderboard_item_found_tab4');

				} else {
					$(tr).attr("id", "");
				}
			});
		});
	});

	$(document).on('click', '#btn_leader_board_tab4', function () {
		$('html, body').animate({
			scrollTop: $("#leaderboard_item_found_tab4").offset().top
		}, 1000);
	});

	// TAB 5 PROCESS
	$("#keyword_tab5").keyup(function () {
		let keyword = $("#keyword_tab5").val();

		$('#leaderboard_tab5 tr.leaderboard-item').each(function (index, tr) {
			$(tr).find('td.leaderboard-item-name').each(function (index, td) {
				let item_name = $(td).html();

				if (item_name === keyword) {
					$(tr).attr('id', 'leaderboard_item_found_tab5');

				} else {
					$(tr).attr("id", "");
				}
			});
		});
	});

	$(document).on('click', '#btn_leader_board_tab5', function () {
		$('html, body').animate({
			scrollTop: $("#leaderboard_item_found_tab5").offset().top
		}, 1000);
	});
});