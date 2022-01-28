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
  });
  $(function () {
    $("#menu").metisMenu()
  });

  setSelect2();
});

function setSelect2() {
  $('.select2-elem-modal').each(function () {
    let placeholder = $(this).data('placeholder') || '';
    let allowClear = Boolean($(this).data('allow-clear'));
    $(this).select2({
      theme: 'bootstrap4',
      placeholder: placeholder,
      allowClear: allowClear,
      dropdownParent: $('#formFullScreenModal')
    });
  });
  $('.select2-elem').each(function () {
    let placeholder = $(this).data('placeholder') || '';
    let allowClear = Boolean($(this).data('allow-clear'));
    $(this).select2({
      theme: 'bootstrap4',
      placeholder: placeholder,
      allowClear: allowClear,
    });
  });
}

const formFullScreenModalDOM = document.getElementById('formFullScreenModal');
const deleteConfirmationModalDOM = document.getElementById('deleteConfirmationModal');

const formModalDefaultContent = `<div class="modal-header">
<h5 class="modal-title">Modal Form</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">Sorry you are Not Permitted!</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary" id="form-submit-btn">Submit</button>
</div>`;

$(document).on('click', '#edit-btn', function (e) {
  e.preventDefault();
  let edit_url = $(this).attr('data-edit-url');
  if (edit_url) {
    formFullScreenModal.show();
  }
});

$(document).on('click', '#create-btn', function (e) {
  e.preventDefault();
  create();
  formFullScreenModal.show();
});

$(document).on('click', '#delete-btn', function (e) {
  e.preventDefault();
  let delete_url = $(this).attr('data-delete-url');
  if (delete_url) {
    deleteConfirmationModal.show();
    $('#delete-confirm-btn').attr('data-url', delete_url);
  }
});

$(document).on('click', '#delete-confirm-btn', function (e) {
  e.preventDefault();
  let delete_url = $('#delete-confirm-btn').attr('data-url');
  if (delete_url) {
    $.ajax({
      url: delete_url,
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      type: 'DELETE'
    }).done(function (response) {
      if (response.status === 200) {
        alert(response.secondaryMessage);
      }
      deleteConfirmationModal.hide();
      reloadCurrentPage();
    }).fail(function (response, xhr) {
      console.log({
        response,
        xhr
      });
    });
    $('#delete-confirm-btn').attr('data-url', '')
  }
})

var deleteConfirmationModal = new bootstrap.Modal(deleteConfirmationModalDOM, {
  backdrop: 'static',
  keyboard: false
});
var formFullScreenModal = new bootstrap.Modal(formFullScreenModalDOM, {
  backdrop: 'static',
  keyboard: false
});

formFullScreenModalDOM.addEventListener('hidden.bs.modal', function (event) {
  let modalContent = this.querySelector('.modal-content');
  modalContent.innerHTML = formModalDefaultContent;
});

function reloadCurrentPage() {
  window.location.reload();
}

$("#liveToastBtn").click(function(){
  $("#liveToast").toast("show");
});