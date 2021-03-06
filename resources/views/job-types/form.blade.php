{!! Form::model($job_type, ['url' => ($job_type && $job_type->id) ? "/job-types/$job_type->id": "/job-types/store", 'method'
=> ($job_type &&
$job_type->id) ? 'PUT': 'POST', 'id' => 'job-type-form', 'autocomplete' => 'off', 'class' => 'row g-3 needs-validation',
'novalidate']) !!}
<div class="col-md-4">
  {!! Form::label('company_id', 'Company', ['class' => 'form-label']) !!}
  {!! Form::select('company_id', $companies ?? [], null, ['class' => 'form-control select2-elem-modal', 'placeholder' => 'Select Company', 'required']) !!}
  <span class="error-msg company_id"></span>
</div>
<div class="col-md-4">
  {!! Form::label('name', 'Job Type', ['class' => 'form-label']) !!}
  {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
  <span class="error-msg name"></span>
</div>
<div class="col-md-4">
  {!! Form::label('active_status', 'Status', ['class' => 'form-label']) !!}
  {!! Form::select('active_status', ACTIVE_STATUS_OPTIONS ?? [], null, ['class' => 'form-control select2-elem-modal', 'placeholder' => 'Select Company', 'required']) !!}
  <span class="error-msg active_status"></span>
</div>
{!! Form::close() !!}