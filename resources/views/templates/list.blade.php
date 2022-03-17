@extends('mainframe')
@section('page-title', 'Template List')
@section('page-content')
<x-breadcrumb title="Template List" pageName="Templates" buttonLink="" buttonName="Create New" />

<div class="card">
  <div class="card-body">
    <div class="card-title">
      <h5 class="mb-0">Template List</h5>
    </div>
    <hr />
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>SL</th>
            <th>Template</th>
            <th>Job Type</th>
            <th>Company</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($templates as $template)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $template->name }}</td>
            <td>{{ $template->jobType->name }}</td>
            <td>{{ $template->company->name }}</td>
            <td>
              <div class="d-flex align-items-center justify-content-center">
                <button type="button" class="btn-custom btn-close-white dropdown-toggle-split font-18"
                  data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                  <a class="dropdown-item" id="edit-btn" href="javascript:;"
                    data-edit-url="{{ url('/templates/'.$template->id.'/edit') }}">Edit</a>
                  <a class="dropdown-item" id="delete-btn" href="javascript:;"
                    data-delete-url="{{ url('/templates/'.$template->id) }}">Delete</a>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <th colspan="5" class="text-center">No Data Found</th>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-center">
      {{ $templates->appends(request()->except('page'))->links() }}
    </div>
  </div>
</div>
@endsection
@section('bottom-scripts')
<script>
  $(document).on('change', '[name="company_id"]', function(e) {
    e.preventDefault();
    let company_id = $(this).val();
    let $jobTypeDom = $('[name="job_type_id"]');
    $jobTypeDom.empty();
    let jobTypeInnerHTML = '';
    if (company_id)
    $.ajax({
      type: 'GET',
      url: '/job-types/search-select',
      data: {company_id: company_id}
    }).done(function(response) {
      jobTypeInnerHTML += '<option value=""> Select Job Type </option>';
      if (response.data.length > 0) {
        response.data.forEach(item => {
          jobTypeInnerHTML += '<option value="'+item.id+'">'+ item.text +'</option>';
        })
      }
      $jobTypeDom.html(jobTypeInnerHTML)
    }).fail(function(response) {
      console.log(response)
    })
  });
  const create = () => {
    $.ajax({
      type: "GET",
      url: "/templates/create"
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
    let formElement = $('#template-form');
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