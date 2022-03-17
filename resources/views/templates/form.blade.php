{!! Form::model($template, ['url' => ($template && $template->id) ? "/templates/$template->id": "/templates/store", 'method'
=> ($template &&
$template->id) ? 'PUT': 'POST', 'id' => 'template-form', 'autocomplete' => 'off', 'class' => 'row g-3 needs-validation',
'novalidate']) !!}
<div class="col-md-4">
  {!! Form::label('company_id', 'Company', ['class' => 'form-label']) !!}
  {!! Form::select('company_id', $companies ?? [], null, ['class' => 'form-control select2-elem-modal', 'placeholder' => 'Select Company', 'required']) !!}
  <span class="error-msg company_id"></span>
</div>
<div class="col-md-4">
  {!! Form::label('job_type_id', 'Job Type', ['class' => 'form-label']) !!}
  {!! Form::select('job_type_id', $job_types ?? [], null, ['class' => 'form-control select2-elem-modal', 'placeholder' => 'Select Company', 'required']) !!}
  <span class="error-msg job_type_id"></span>
</div>
<div class="col-md-4">
  {!! Form::label('name', 'Template Name', ['class' => 'form-label']) !!}
  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Template name', 'required']) !!}
  <span class="error-msg name"></span>
</div>

{!! Form::close() !!}