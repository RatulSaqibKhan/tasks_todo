@extends('mainframe')
@section('page-title', 'Assign Task to Template')
@section('page-content')
<x-breadcrumb title="Assign Tasks to Template" pageName="Templates" buttonClass="d-none" buttonLink="" buttonName="" />

<div class="card">
  <div class="card-body">
    <div class="card-title">
      <h5 class="mb-0">Assign Task Template</h5>
    </div>
    <hr />
    <div class="form-body">
      {!! Form::open(['url' => url('/templates/assign-tasks'), 'method' => 'POST', 'id' => 'template-assign-tasks']) !!}
      <div class="row">
        <div class="col-md-4">
          {!! Form::label('company_id', 'Company', ['class' => 'form-label']) !!}
          {!! Form::select('company_id', $companies ?? [], null, ['class' => 'form-control select2-elem', 'placeholder' => 'Select Company', 'required']) !!}
          <span class="error-msg company_id"></span>
        </div>
        <div class="col-md-4">
          {!! Form::label('template_id', 'Template', ['class' => 'form-label']) !!}
          {!! Form::select('template_id', [], null, ['class' => 'form-control select2-elem', 'placeholder' => 'Select Template', 'required']) !!}
          <span class="error-msg template_id"></span>
        </div>
        <div class="col-md-4">
          {!! Form::label('task_completion_basis', 'Completion Basis', ['class' => 'form-label']) !!}
          {!! Form::select('task_completion_basis', $task_completion_basis_options ?? [], null, ['class' => 'form-control select2-elem', 'placeholder' => 'Select One', 'required']) !!}
          <span class="error-msg task_completion_basis"></span>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12 table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="w-10">SL</th>
                <th class="w-10">TASK NAME</th>
                <th class="w-20">TASK SHORT NAME</th>
                <th class="w-20">TASK DESCRIPTION</th>
                <th class="w-10">ESTIMATED COMPLETION TIME</th>
                <th class="w-20">STATUS</th>
                <th class="w-10">ACTION</th>
              </tr>
            </thead>
            <tbody id="task-breakdown-form">
              <tr>
                <th colspan="7" class="text-center">Select Template</th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
@section('bottom-scripts')
<script>
  $(document).on('change', '[name="company_id"]', function(e) {
    e.preventDefault();
    let company_id = $(this).val();
    let $templateSelectDom = $('[name="template_id"]');
    $templateSelectDom.empty();
    let templateSelectInnerHTML = '';
    if (company_id)
    $.ajax({
      type: 'GET',
      url: '/templates/search-select',
      data: {company_id: company_id}
    }).done(function(response) {
      templateSelectInnerHTML += '<option value=""> Select Template</option>';
      if (response.data.length > 0) {
        response.data.forEach(item => {
          templateSelectInnerHTML += '<option value="'+item.id+'">'+ item.text +'</option>';
        })
      }
      $templateSelectDom.html(templateSelectInnerHTML)
    }).fail(function(response) {
      console.log(response)
    })
  });

  $(document).on('change', '[name="template_id"]', function(e) {
    e.preventDefault();
    let template_id = $(this).val();
    let task_completion_basis = $('[name="task_completion_basis"]').val();
    let $taskBreakdownDOM = $('#task-breakdown-form');
    if (template_id && task_completion_basis) {
      fetchAssignTaskForm($taskBreakdownDOM, template_id)
    }
  });

  $(document).on('change', '[name="task_completion_basis"]', function(e) {
    e.preventDefault();
    let task_completion_basis = $(this).val();
    let template_id = $('[name="template_id"]').val();
    let $taskBreakdownDOM = $('#task-breakdown-form');
    if (template_id && task_completion_basis) {
      fetchAssignTaskForm($taskBreakdownDOM, template_id)
    }
  });

  $(document).on('click', '.add-item', function(e) {
    e.preventDefault();
    let trClone = $(this).parents('tr').clone();
    $('#task-breakdown-form').append(trClone);
    $(this).parents('tr').find('.add-item').addClass('d-none');
    $(this).parents('tr').find('.remove-item').removeClass('d-none');
    trClone.find('.remove-item').removeClass('d-none');
  })
  
  $(document).on('click', '.remove-item', function(e) {
    e.preventDefault();
    $(this).parents('tr').remove();
    let totalRow = $('#task-breakdown-form tr').length;
    let lastRow = $('#task-breakdown-form tr:eq('+ ( totalRow - 1 ) +')');
    if (totalRow - 1 > 0) {
      lastRow.find('.add-item').removeClass('d-none');
      lastRow.find('.remove-item').removeClass('d-none');
    } else {
      lastRow.find('.add-item').removeClass('d-none');
      lastRow.find('.remove-item').addClass('d-none');
    }
    
  })

  function fetchAssignTaskForm($taskBreakdownDOM, template_id) {
    $.ajax({
      type: 'GET',
      url: '/templates/fetch-assigned-tasks-form',
      data: {template_id: template_id}
    }).done(function(response) {
      if (response.status == 200) {
        $taskBreakdownDOM.html(response.form)
      }
    }).fail(function(response) {
      console.log(response)
    })
  }
</script>
@endsection