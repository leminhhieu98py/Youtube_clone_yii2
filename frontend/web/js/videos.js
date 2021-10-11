$(function () {
  let baseUrl = $(".baseUrl").val();

  // Popover
  $('[data-toggle="tooltip"]').tooltip({
    placement: "top",
    trigger: "hover",
  });

  // Sidebar
  let currentRoute = $(".sidebar-itube").data("route");
  // console.log(currentRoute);
  // console.log(baseUrl);

  $(`a[href="${currentRoute}"]`).addClass("active");
  $(`a[href="${currentRoute}"]`).children(".aside-nav-link").addClass("active");

  //handle channel page
  if (currentRoute == "/channel/view") {
    $(".channel-side-bar").addClass("active");
    $(".channel-side-bar").children(".aside-nav-link").addClass("active");

    // handle channel navbar to sticky position
    window.onscroll = function () {
      if (window.scrollY >= 300) {
        $(".channel-nav-bar").css("z-index", "2");
        $(".channel-nav-bar").css("position", "fixed");
        $(".channel-nav-bar").css("top", "64px");
        $(".channel-videos-wrapper").css("margin-top", "63px");
      } else {
        $(".channel-nav-bar").css("z-index", "unset");
        $(".channel-nav-bar").css("position", "unset");
        $(".channel-nav-bar").css("top", "unset");
        $(".channel-videos-wrapper").css("margin-top", "unset");
      }
    };

    if ($(".channel-videos-wrapper").data("page") == "home") {
      let popular_wrapper = $(".videos-slide-wrapper.popular-videos");
      let latest_wrapper = $(".videos-slide-wrapper.latest-videos");
      let popular_videos = popular_wrapper.data("videos-count");
      let latest_videos = latest_wrapper.data("videos-count");

      //set width for wrapper
      let popular_wrapper_width = 100;
      if (popular_videos > 5) {
        popular_wrapper_width = popular_videos * 20;
      }
      popular_wrapper.css("width", `${popular_wrapper_width}%`);

      let latest_wrapper_width = 100;
      if (latest_videos > 5) {
        latest_wrapper_width = latest_videos * 20;
      }
      latest_wrapper.css("width", `${latest_wrapper_width}%`);

      //handle next/previous videos button of popular wrapper
      let translateX_ratio_popular = (100 * 5) / popular_videos;
      let current_translateX_popular = 0;
      let translateX_ratio_latest = (100 * 5) / latest_videos;
      let current_translateX_latest = 0;
      $(".next-videos-channel-btn")
        .off()
        .click(function () {
          current_translateX_popular -= translateX_ratio_popular;
          if (current_translateX_popular > -100) {
            $(this)
              .parent()
              .parent()
              .children(".videos-slide-wrapper")
              .css("transform", `translateX(${current_translateX_popular}%)`);
          } else {
            current_translateX_popular += translateX_ratio_popular;
          }
        });

      $(".previous-videos-channel-btn")
        .off()
        .click(function () {
          if (
            current_translateX_popular < 0 &&
            current_translateX_popular > -100
          ) {
            current_translateX_popular += translateX_ratio_popular;
            $(this)
              .parent()
              .parent()
              .children(".videos-slide-wrapper")
              .css("transform", `translateX(${current_translateX_popular}%)`);
          } else if (current_translateX_popular == 0) {
          } else {
            current_translateX_popular -= translateX_ratio_popular;
          }
        });

      $(".next-videos-channel-btn.latest-video-next-btn")
        .off()
        .click(function () {
          current_translateX_latest -= translateX_ratio_latest;
          if (current_translateX_latest > -100) {
            $(this)
              .parent()
              .parent()
              .children(".videos-slide-wrapper")
              .css("transform", `translateX(${current_translateX_latest}%)`);
          } else {
            current_translateX_latest += translateX_ratio_latest;
          }
        });

      $(".previous-videos-channel-btn.latest-video-previous-btn")
        .off()
        .click(function () {
          if (
            current_translateX_latest < 0 &&
            current_translateX_latest > -100
          ) {
            current_translateX_latest += translateX_ratio_latest;
            $(this)
              .parent()
              .parent()
              .children(".videos-slide-wrapper")
              .css("transform", `translateX(${current_translateX_latest}%)`);
          } else if (current_translateX_latest == 0) {
          } else {
            current_translateX_latest -= translateX_ratio_latest;
          }
        });
    }
  }

  $(".menu-icon-wrapper").click(function () {
    //handle sidebar to move in and out
    $(".main-side-bar").toggleClass("active");
    $(".main.content-wrapper").toggleClass("active");
  });

  $(window).resize(function(){
    let windowWidth = $(window).width();
    if(windowWidth < 992){
      $(".main-side-bar").addClass("active");
      $(".main.content-wrapper").addClass("active");
    }else{
      $(".main-side-bar").removeClass("active");
      $(".main.content-wrapper").removeClass("active");
    }
  })

  // Check login for comment + submit comment
  // declare comment function
  let comment = function () {
    return $.ajax({
      type: "POST",
      url: baseUrl + "/checkcomment",
      success: function () {
        // submit comment
        $("#comment-input")
          .off()
          .keyup(function (e) {
            if (e.keyCode === 13 && $("#comment-input").val() != "") {
              let videoID = $("#comment-input").data("videoid");
              return $.ajax({
                type: "POST",
                url: baseUrl + "/comment",
                data: {
                  videoID: videoID,
                  content: $("#comment-input").val(),
                },
                success: function (data) {
                  $("#comment-input-wrapper").html(data);
                  $("#comment-input").click(function () {
                    comment();
                    displayComments();
                  });
                  displayComments();
                  Swal.fire({
                    icon: "success",
                    title: "Your comment has been uploaded",
                    showConfirmButton: false,
                    timer: 1500,
                  });
                },
              });
            }
          });
      },
      error: function () {
        alert("Something is wrong, please try later");
      },
    });
  };

  // display comment function
  let displayComments = function () {
    let videoID = $("#comment-input").data("videoid");
    return $.ajax({
      type: "post",
      url: baseUrl + "/displaycomments",
      data: {
        videoID: videoID,
      },
      success: function (data) {
        $(".comment-wrapper").html(data);
      },
    });
  };

  $("#comment-input").click(function () {
    comment();
  });
  if (baseUrl == "/videos") {
    displayComments();
  }
});
