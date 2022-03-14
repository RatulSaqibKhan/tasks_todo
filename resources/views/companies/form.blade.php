{!! Form::model($company, ['url' => ($company && $company->id) ? "/companies/$company->id": "/companies/store", 'method'
=> ($company &&
$company->id) ? 'PUT': 'POST', 'id' => 'company-form', 'autocomplete' => 'off', 'files' => true, 'class' => 'row g-3 needs-validation',
'novalidate']) !!}
<div class="col-md-6">
  {!! Form::label('name', 'Company Name', ['class' => 'form-label']) !!}
  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Company Name', 'required']) !!}
  <span class="error-msg name"></span>
</div>
<div class="col-md-6">
  {!! Form::label('email', 'Company Email', ['class' => 'form-label']) !!}
  {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Company Email']) !!}
  <span class="error-msg email"></span>
</div>
<div class="col-md-6">
  {!! Form::label('attention', 'Attention', ['class' => 'form-label']) !!}
  {!! Form::text('attention', null, ['class' => 'form-control', 'placeholder' => 'Attention', 'required']) !!}
  <span class="error-msg attention"></span>
</div>
<div class="col-md-6">
  {!! Form::label('phone_no', 'Company Phone No', ['class' => 'form-label']) !!}
  {!! Form::text('phone_no', null, ['class' => 'form-control', 'placeholder' => 'Company Phone No', 'required']) !!}
  <span class="error-msg phone_no"></span>
</div>
<div class="col-md-6">
  {!! Form::label('fax', 'Fax', ['class' => 'form-label']) !!}
  {!! Form::text('fax', null, ['class' => 'form-control', 'placeholder' => 'Fax']) !!}
  <span class="error-msg fax"></span>
</div>
<div class="col-md-6">
  {!! Form::label('party_type', 'Party Type', ['class' => 'form-label']) !!}
  {!! Form::text('party_type', null, ['class' => 'form-control', 'placeholder' => 'Party Type'])
  !!}
  <span class="error-msg party_type"></span>
</div>
<div class="col-6">
  {!! Form::label('address', 'Company Address', ['class' => 'form-label']) !!}
  {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Company Address', 'rows' => 1]) !!}
  <span class="error-msg address"></span>
</div>
<div class="col-md-6">
  {!! Form::label('logo', 'Company Logo', ['class' => 'form-label']) !!}
  {!! Form::file('logo', ['class' => 'form-control'])
  !!}
  <span class="error-msg logo"></span>
  @if($company && $company->logo)
  <div class="pt-2 image-responsive">
    <img src="{{ asset('storage/company_logo/'.$company->logo) }}" alt="Company Logo" style="width:90px;">
  </div>
  @endif
</div>
{!! Form::close() !!}