$(function () {
  // Sidebar
  let currentRoute = $(".aside-user-profile-wrapper").data("route");

  $(`a[href="${currentRoute}"]`).addClass("active");
  $(`a[href="${currentRoute}"]`).children(".aside-nav-link").addClass("active");

  $(".menu-icon-wrapper").click(function () {
    //handle sidebar to move in and out
    $(".main-side-bar").toggleClass("active");
    $(".main.content-wrapper").toggleClass("active");
  });

  // Videos
  $("#videoFile").change(function (e) {
    $(e.target).closest("form").trigger("submit");
  });
});
