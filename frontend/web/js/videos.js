$(function () {
  // Sidebar
  let currentRoute = $(".sidebar-itube").data("route");

  $(`a[href="${currentRoute}"]`).addClass("active");
  $(`a[href="${currentRoute}"]`).children(".aside-nav-link").addClass("active");
});
