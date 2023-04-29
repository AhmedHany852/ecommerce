/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/cart.js ***!
  \******************************/
(function ($) {
  $(".item-quantity").on("change", function (e) {
    $.ajax({
      url: "/cart/" + $(this).data("id"),
      //data-id
      method: "put",
      data: {
        quantity: $(this).val(),
        _token: csrf_token
      }
    });
  });
  $(".item-remove").on("click", function (e) {
    var id = $(this).data("id");
    $.ajax({
      url: "/cart/" + id,
      //data-id
      method: "delete",
      data: {
        _token: csrf_token
      },
      success: function success(response) {
        $("#".concat(id)).remove();
      }
    });
  });
})(jQuery);
/******/ })()
;