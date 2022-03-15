@extends('mainframe')
@section('page-title', 'Holiday List')
@section('styles')
<link href="{{ asset('assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />

@endsection
@section('page-content')
<x-breadcrumb title="Holiday List" pageName="Holidays" buttonLink="" buttonName="Create New" />

<div class="card">
  <div class="card-body">
    <div class="card-title">
      <h5 class="mb-0">Holiday List</h5>
    </div>
    <hr />
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>SL</th>
            <th>Holiday</th>
            <th>Company</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($holidays as $holiday)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ date('d M, Y', strtotime($holiday->holiday)) }}</td>
            <td>{{ $holiday->company->name }}</td>
            <td>
              <div class="d-flex align-items-center justify-content-center">
                <button type="button" class="btn-custom btn-close-white dropdown-toggle-split font-18"
                  data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                  <a class="dropdown-item" id="edit-btn" href="javascript:;"
                    data-edit-url="{{ url('/holidays/'.$holiday->id.'/edit') }}">Edit</a>
                  <a class="dropdown-item" id="delete-btn" href="javascript:;"
                    data-delete-url="{{ url('/holidays/'.$holiday->id) }}">Delete</a>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <th colspan="4" class="text-center">No Data Found</th>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-center">
      {{ $holidays->appends(request()->except('page'))->links() }}
    </div>
  </div>
</div>
@endsection
@section('bottom-scripts')
<script src="{{ asset('assets/plugins/datetimepicker/js/picker.js') }}"></script>
<script src="{{ asset('assets/plugins/datetimepicker/js/picker.date.js') }}"></script>
<script>
  var picker;
  function setDatePicker() {
    var $input = $('.datepicker').pickadate({
			selectMonths: true,
	    selectYears: true,
      format: 'yyyy-mm-dd'
		});
    picker = $input.pickadate('picker')
  }
  const create = () => {
    $.ajax({
      type: "GET",
      url: "/holidays/create"
    }).done((response) => {
      if (response.status === 200) {
        let modalTitle = formFullScreenModalDOM.querySelector('.modal-title');
        let modalBody = formFullScreenModalDOM.querySelector('.modal-body');
        modalTitle.innerHTML = response.title;
        modalBody.innerHTML = response.view;
        setSelect2();
        setDatePicker();
      }
    }).fail((response) => {
      console.log(response);
    })
  }
  const edit = (edit_url) => {
    $.ajax({
      type: "GET",
      url: edit_url
    }).done((response) => {
      if (response.status === 200) {
        let modalTitle = formFullScreenModalDOM.querySelector('.modal-title');
        let modalBody = formFullScreenModalDOM.querySelector('.modal-body');
        modalTitle.innerHTML = response.title;
        modalBody.innerHTML = response.view;
        setSelect2();
        setDatePicker();
      }
    }).fail((response) => {
      console.log(response);
    })
  }
  $(document).on('click', '#form-submit-btn', (e) => {
    e.preventDefault();
    let formElement = $('#holiday-form');
    submitForm(formElement);
  });

  const submitForm = (formElement) => {
    let data = formElement.serialize();
    let method = formElement.attr('method');
    let url = formElement.attr('action');
    $(".error-msg").empty();
    $.ajax({
      url: url,
      type: method,
      data: data,
    }).done((response) => {
      $('#liveToast').html(response.toastContainer)
      showToast();
      if (response.status === 200) {
        formFullScreenModal.hide();
        reloadCurrentPage();
      }
    }).fail((data) => {
      if (data.status === 422) {
        let errors = data.responseJSON.errors;
        $.each(errors, function (errorIndex, errorValue) {
          let errorDomElement, error_index, errorMessage;
          errorDomElement = '' + errorIndex;
          errorDomIndexArray = errorDomElement.split(".");
          errorDomElement = '.' + errorDomIndexArray[0];
          error_index = errorDomIndexArray[1];
          errorMessage = errorValue[0];
          $(".error-msg"+errorDomElement).html(errorMessage);
        });
      }
      console.log(data);
    });
  } 
</script>
@endsection