@extends('mainframe')
@section('page-title', 'Company List')
@section('page-content')
<x-breadcrumb title="Company List" pageName="Companies" buttonLink="" buttonName="Create New" />

<div class="card">
  <div class="card-body">
    <div class="card-title">
      <h5 class="mb-0">Company List</h5>
    </div>
    <hr />
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>SL</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>Attention</th>
            <th>Phone No</th>
            <th>Address</th>
            <th>Party Type</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($companies as $company)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $company->name }}</td>
            <td>{{ $company->email }}</td>
            <td>{{ $company->attention }}</td>
            <td>{{ $company->phone_no }}</td>
            <td>{{ $company->address }}</td>
            <td>{{ $company->party_type }}</td>
            <td>{{ array_key_exists($company->active_status, ACTIVE_STATUS_OPTIONS) ? ACTIVE_STATUS_OPTIONS[$company->active_status] : $company->active_status }}</td>
            <td>
              <div class="d-flex align-items-center justify-content-center">
                <button type="button" class="btn-custom btn-close-white dropdown-toggle-split font-18"
                  data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                  <a class="dropdown-item" id="edit-btn" href="javascript:;"
                    data-edit-url="{{ url('/companies/'.$company->id.'/edit') }}">Edit</a>
                  <a class="dropdown-item" id="delete-btn" href="javascript:;"
                    data-delete-url="{{ url('/companies/'.$company->id) }}">Delete</a>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <th colspan="9" class="text-center">No Data Found</th>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-center">
      {{ $companies->appends(request()->except('page'))->links() }}
    </div>
  </div>
</div>
@endsection
@section('bottom-scripts')
<script>
  const create = () => {
    $.ajax({
      type: "GET",
      url: "/companies/create"
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
    let formElement = $('#company-form');
    submitForm(formElement);
  });

  const submitForm = (formElement) => {
    let formData = new FormData(document.getElementById("company-form"));
    formData.append("name", formElement.find('[name="name"]').val())
    let method = formElement.attr('method');
    let url = formElement.attr('action');
    let enctype = formElement.attr('enctype');
    $(".error-msg").empty();
    $.ajax({
      url: url,
      type: method,
      data: formData,
      enctype: enctype,
      processData: false,
      contentType: false,
      cache : false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }).done((response) => {
      $('#toast-icon-container').html('<i class="'+ response.iconClass +'"></i>')
      $('#toast-primary-msg').html(response.primaryMessage)
      $('#toast-secondary-msg').html(response.secondaryMessage)
      showToast();
      if (response.status === 200) {
        formFullScreenModal.hide();
        reloadCurrentPage();
      }
    }).fail((response, status, error) => {
      console.log([response, status, error])
      let resData = JSON.parse(response.responseText);
      if (response.status === 422) {
        let errors = resData.errors;
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
    });
  } 
</script>
@endsection