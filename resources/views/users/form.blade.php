{!! Form::model($user, ['url' => ($user && $user->id) ? "/users/$user->id": "/users/store", 'method' => 'POST', 'id' => 'user-form', 'autocomplete' => 'off', 'class' => 'row g3']) !!}

{!! Form::close() !!}