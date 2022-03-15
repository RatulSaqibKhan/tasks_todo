{!! Form::model($holiday, ['url' => ($holiday && $holiday->id) ? "/holidays/$holiday->id": "/holidays/store", 'method'
=> ($holiday &&
$holiday->id) ? 'PUT': 'POST', 'id' => 'holiday-form', 'autocomplete' => 'off', 'class' => 'row g-3 needs-validation',
'novalidate']) !!}
<div class="col-md-6">
  {!! Form::label('company_id', 'Company', ['class' => 'form-label']) !!}
  {!! Form::select('company_id', $companies ?? [], null, ['class' => 'form-control select2-elem-modal', 'placeholder' => 'Select Company', 'required']) !!}
  <span class="error-msg company_id"></span>
</div>
<div class="col-md-6">
  {!! Form::label('holiday', 'Holiday', ['class' => 'form-label']) !!}
  {!! Form::text('holiday', null, ['class' => 'form-control datepicker', 'required']) !!}
  <span class="error-msg holiday"></span>
</div>

{!! Form::close() !!}