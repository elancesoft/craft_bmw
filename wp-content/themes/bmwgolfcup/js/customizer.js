jQuery(document).ready(function ($) {

	// Hide the video control
	var video = document.getElementById('video');

	var videoWorks = !!document.createElement('video').canPlayType;
	// var videoWorks_1 = !!document.createElement('video').canPlayType;

	if (videoWorks) {

		if (video != null) {
			video.controls = false;
		}
		for (let i = 1; i <= 20; i++) {
			let videoID = document.getElementById('video_' + i);
			if (videoID != null) {
				videoID.controls = false;
			}
		}
	}

	// Click to the video to play
	$(document).on('click', '.video', function () {
		$(this).get(0).play();
		$(this).addClass('playing');
	});

	$(document).on('click', '.video.playing', function () {
		$(this).get(0).pause();
		$(this).removeClass('playing');
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

	$(document).on('click', '#menu_icon', function () {
		$(this).toggleClass('open');
	});

	$(document).click(function (e) {
		// Container contains popup
		var container = $("ul#primary-menu");
		var containerMenuIcon = $("#menu_icon");

		if (!container.is(e.target) && container.has(e.target).length === 0) {
			if (!containerMenuIcon.is(e.target) && containerMenuIcon.has(e.target).length === 0) {
				let menuIcon = document.querySelector('#menu_icon');

				if (menuIcon.classList.contains('open')) {
					container.removeClass('menu');
					container.addClass('close');

					containerMenuIcon.removeClass('open');
				}
			}
		}
	});
});

