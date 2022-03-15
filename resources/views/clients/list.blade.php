@extends('mainframe')
@section('page-title', 'Client List')
@section('page-content')
<x-breadcrumb title="Client List" pageName="Clients" buttonLink="" buttonName="Create New" />

<div class="card">
  <div class="card-body">
    <div class="card-title">
      <h5 class="mb-0">Client List</h5>
    </div>
    <hr />
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>SL</th>
            <th>Company Name</th>
            <th>Client Name</th>
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
          @forelse ($clients as $client)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $client->company->name }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->attention }}</td>
            <td>{{ $client->phone_no }}</td>
            <td>{{ $client->address }}</td>
            <td>{{ $client->party_type }}</td>
            <td>{{ array_key_exists($client->active_status, ACTIVE_STATUS_OPTIONS) ? ACTIVE_STATUS_OPTIONS[$client->active_status] : $client->active_status }}</td>
            <td>
              <div class="d-flex align-items-center justify-content-center">
                <button type="button" class="btn-custom btn-close-white dropdown-toggle-split font-18"
                  data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                  <a class="dropdown-item" id="edit-btn" href="javascript:;"
                    data-edit-url="{{ url('/clients/'.$client->id.'/edit') }}">Edit</a>
                  <a class="dropdown-item" id="delete-btn" href="javascript:;"
                    data-delete-url="{{ url('/clients/'.$client->id) }}">Delete</a>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <th colspan="10" class="text-center">No Data Found</th>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-center">
      {{ $clients->appends(request()->except('page'))->links() }}
    </div>
  </div>
</div>
@endsection
@section('bottom-scripts')
<script>
  const create = () => {
    $.ajax({
      type: "GET",
      url: "/clients/create"
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
    let formElement = $('#client-form');
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