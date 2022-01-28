{!! Form::model($user, ['url' => ($user && $user->id) ? "/users/$user->id": "/users/store", 'method' => ($user &&
$user->id) ? 'PUT': 'POST', 'id' => 'user-form', 'autocomplete' => 'off', 'class' => 'row g-3 needs-validation', 'novalidate']) !!}
<div class="col-md-6">
  {!! Form::label('name', 'User Name', ['class' => 'form-label']) !!}
  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'User Name', 'required']) !!}
  <span class="error-msg name"></span>
</div>
<div class="col-md-6">
  {!! Form::label('email', 'User Email', ['class' => 'form-label']) !!}
  {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'User Email', 'required']) !!}
  <span class="error-msg email"></span>
</div>
<div class="col-md-6">
  {!! Form::label('designation', 'User Designation', ['class' => 'form-label']) !!}
  {!! Form::text('designation', null, ['class' => 'form-control', 'placeholder' => 'User Designation']) !!}
  <span class="error-msg designation"></span>
</div>
<div class="col-md-6">
  {!! Form::label('phone_no', 'User Phone No', ['class' => 'form-label']) !!}
  {!! Form::text('phone_no', null, ['class' => 'form-control', 'placeholder' => 'User Phone No']) !!}
  <span class="error-msg phone_no"></span>
</div>
<div class="col-md-6">
  {!! Form::label('password', 'User Password', ['class' => 'form-label']) !!}
  {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'User Password', 'required']) !!}
  <span class="error-msg password"></span>
</div>
<div class="col-md-6">
  {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'form-label']) !!}
  {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Retype Password', 'required']) !!}
  <span class="error-msg confirm_password"></span>
</div>
<div class="col-12">
  {!! Form::label('address', 'User Address', ['class' => 'form-label']) !!}
  {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'User Address', 'rows' => 2]) !!}
  <span class="error-msg address"></span>
</div>
{!! Form::close() !!}