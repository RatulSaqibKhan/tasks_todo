@extends('mainframe')
@section('page-title', 'User List')
@section('page-content')
<x-breadcrumb title="User List" pageName="Users" buttonLink="" buttonName="Create New" />

<div class="card">
  <div class="card-body">
    <div class="card-title">
      <h5 class="mb-0">User List</h5>
    </div>
    <hr />
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>SL</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Designation</th>
            <th>Phone No</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->designation }}</td>
            <td>{{ $user->phone_no }}</td>
            <td>
              <div class="d-flex align-items-center justify-content-center">
                <button type="button" class="btn-custom btn-close-white dropdown-toggle-split font-18"
                  data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                  <a class="dropdown-item" id="edit-btn" href="javascript:;"
                    data-edit-url="{{ url('/users/'.$user->id.'/edit') }}">Edit</a>
                  <a class="dropdown-item" id="delete-btn" href="javascript:;"
                    data-delete-url="{{ url('/users/'.$user->id) }}">Delete</a>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <th colspan="5">No Data Found</th>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('bottom-scripts')
<script>
  const create = () => {
    $.ajax({
      type: "GET",
      url: "/users/create"
    }).done((response) => {
      if (response.status === 200) {
        let modalTitle = formFullScreenModalDOM.querySelector('.modal-title');
        let modalBody = formFullScreenModalDOM.querySelector('.modal-body');
        modalTitle.innerHTML = response.title;
        modalBody.innerHTML = response.view;
        setSelect2();
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
      }
    }).fail((response) => {
      console.log(response);
    })
  }
  $(document).on('click', '#form-submit-btn', (e) => {
    e.preventDefault();
    let formElement = $('#user-form');
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
      $('#toast-icon-container').html('<i class="'+ response.iconClass +'"></i>')
      $('#toast-primary-msg').html(response.primaryMessage)
      $('#toast-secondary-msg').html(response.secondaryMessage)
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