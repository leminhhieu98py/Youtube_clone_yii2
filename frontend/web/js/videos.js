$(function () {
  let baseUrl = $(".baseUrl").val();

  // Sidebar
  let currentRoute = $(".sidebar-itube").data("route");

  $(`a[href="${currentRoute}"]`).addClass("active");
  $(`a[href="${currentRoute}"]`).children(".aside-nav-link").addClass("active");

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

  displayComments();
});
