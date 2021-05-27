$(function () {
  // Sidebar
  let currentRoute = $(".aside-user-profile-wrapper").data("route");

  $(`a[href="${currentRoute}"]`).addClass("active");
  $(`a[href="${currentRoute}"]`).children(".aside-nav-link").addClass("active");

  // Videos
  $("#videoFile").change(function (e) {
    $(e.target).closest("form").trigger("submit");
  });
});
