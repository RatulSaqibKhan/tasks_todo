{!! Form::model($client, ['url' => ($client && $client->id) ? "/clients/$client->id": "/clients/store", 'method'
=> ($client &&
$client->id) ? 'PUT': 'POST', 'id' => 'client-form', 'autocomplete' => 'off', 'files' => true, 'class' => 'row g-3 needs-validation',
'novalidate']) !!}
<div class="col-md-6">
  {!! Form::label('company_id', 'Company', ['class' => 'form-label']) !!}
  {!! Form::select('company_id', $companies ?? [], null, ['class' => 'form-control select2-elem-modal', 'placeholder' => 'Select Company', 'required']) !!}
  <span class="error-msg company_id"></span>
</div>
<div class="col-md-6">
  {!! Form::label('name', 'Client Name', ['class' => 'form-label']) !!}
  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Client Name', 'required']) !!}
  <span class="error-msg name"></span>
</div>
<div class="col-md-6">
  {!! Form::label('email', 'Client Email', ['class' => 'form-label']) !!}
  {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Client Email']) !!}
  <span class="error-msg email"></span>
</div>
<div class="col-md-6">
  {!! Form::label('attention', 'Attention', ['class' => 'form-label']) !!}
  {!! Form::text('attention', null, ['class' => 'form-control', 'placeholder' => 'Attention', 'required']) !!}
  <span class="error-msg attention"></span>
</div>
<div class="col-md-6">
  {!! Form::label('phone_no', 'Client Phone No', ['class' => 'form-label']) !!}
  {!! Form::text('phone_no', null, ['class' => 'form-control', 'placeholder' => 'Client Phone No', 'required']) !!}
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
  {!! Form::label('address', 'Client Address', ['class' => 'form-label']) !!}
  {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Client Address', 'rows' => 1]) !!}
  <span class="error-msg address"></span>
</div>
{!! Form::close() !!}