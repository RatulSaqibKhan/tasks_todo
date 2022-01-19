$(function () {
  "use strict";
  $(".mobile-search-icon").on("click", function () {
    $(".search-bar").addClass("full-search-bar")
  }), $(".search-close").on("click", function () {
    $(".search-bar").removeClass("full-search-bar")
  }), $(".mobile-toggle-menu").on("click", function () {
    $(".wrapper").addClass("toggled")
  }), $(".toggle-icon").click(function () {
    $(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function () {
      $(".wrapper").addClass("sidebar-hovered")
    }, function () {
      $(".wrapper").removeClass("sidebar-hovered")
    }))
  }), $(document).ready(function () {
    $(window).on("scroll", function () {
      $(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()
    }), $(".back-to-top").on("click", function () {
      return $("html, body").animate({
        scrollTop: 0
      }, 600), !1
    })
  }),

    $(document).ready(function () {
      $(window).on("scroll", function () {
        if ($(this).scrollTop() > 60) {
          $('.topbar').addClass('bg-dark');
        } else {
          $('.topbar').removeClass('bg-dark');
        }
      });
      $('.back-to-top').on("click", function () {
        $("html, body").animate({
          scrollTop: 0
        }, 600);
        return false;
      });
    });


  $(function () {
    for (var e = window.location, o = $(".metismenu li a").filter(function () {
      return this.href == e
    }).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")
  }), $(function () {
    $("#menu").metisMenu()
  }), $(".chat-toggle-btn").on("click", function () {
    $(".chat-wrapper").toggleClass("chat-toggled")
  }), $(".chat-toggle-btn-mobile").on("click", function () {
    $(".chat-wrapper").removeClass("chat-toggled")
  }), $(".email-toggle-btn").on("click", function () {
    $(".email-wrapper").toggleClass("email-toggled")
  }), $(".email-toggle-btn-mobile").on("click", function () {
    $(".email-wrapper").removeClass("email-toggled")
  }), $(".compose-mail-btn").on("click", function () {
    $(".compose-mail-popup").show()
  }), $(".compose-mail-close").on("click", function () {
    $(".compose-mail-popup").hide()
  })

  $(document).on('click', '.selectable-tr', function(e) {
    $('.selectable-tr.selected-tr').not(this).toggleClass('selected-tr');
    $(this).toggleClass('selected-tr');
  });

  $(document).on('click', '#edit-btn', function(e) {
    e.preventDefault();
    let edit_url = $('.selectable-tr.selected-tr').attr('data-edit-url');
    if (edit_url) {
      window.open(edit_url, '_blank')
    }
  });

  $(document).on('click', '#delete-btn', function(e) {
    e.preventDefault();
    let delete_url = $('.selectable-tr.selected-tr').attr('data-delete-url');
    if (delete_url) {
      deleteConfirmationModal.show();
      $('#delete-confirm-btn').attr('data-url', delete_url);
    }
  });

  $(document).on('click', '#delete-confirm-btn', function(e) {
    e.preventDefault();
    let delete_url = $('#delete-confirm-btn').attr('data-url');
    if (delete_url) {
      $.ajax({
        url: delete_url,
        data: {
          _token: $('meta[name="csrf-token"]').attr('content')
        },
        type: 'DELETE'
      }).done(function(response) {
        if(response.status === 200) {
          alert(response.secondaryMessage);
        }
        deleteConfirmationModal.hide();
        reloadCurrentPage();
      }).fail(function(response, xhr) {
        console.log({
          response,
          xhr
        });
      });
      $('#delete-confirm-btn').attr('data-url', '')
    }
  })

  var deleteConfirmationModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'), {
    backdrop: 'static',
    keyboard: false
  });

  function reloadCurrentPage() {
    window.location.reload();
  }
});