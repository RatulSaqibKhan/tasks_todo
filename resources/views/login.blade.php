<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
  <!-- loader-->
  <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
  <script data-pace-options='{ "ajax": true }' src="{{ asset('assets/js/pace.min.js') }}"></script>
  <!-- Bootstrap CSS -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
  <title>Dashtrans - Bootstrap5 Admin Template</title>
</head>

<body class="bg-theme bg-theme2">
  <!--wrapper-->
  <div class="wrapper">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
      <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
          <div class="col mx-auto">
            <div class="mb-4 text-center">
              <img src="{{ asset('assets/images/logo-img.png') }}" width="180" alt="" />
            </div>
            <div class="card">
              <div class="card-body">
                <div class="border p-4 rounded">
                  <div class="text-center">
                    <h3 class="">Sign in</h3>
                  </div>
                  <div class="form-body">
                    {!! Form::open(['url' => '/signin', 'class' => 'row g-3 needs-validation', 'method' => 'POST',
                    'autocomplete' => 'off', 'novalidate']) !!}
                    <div class="col-12">
                      {!! Form::label('inputEmailAddress', 'Email Address', ['class' => 'form-label']) !!}
                      {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'inputEmailAddress',
                      'placeholder' => 'Email Address', 'required']) !!}
                      @if($errors->has('email'))
                        <div id="emailFeedback" class="invalid-feedback">
                          {{ $errors->first('email') }}
                        </div>
                      @endif
                    </div>
                    <div class="col-12">
                      {!! Form::label('inputChoosePassword', 'Enter Password', ['class' => 'form-label']) !!}
                      <div class="input-group" id="show_hide_password">
                        {!! Form::password('password', ['class' => 'form-control border-end-0', 'id' =>
                        'inputChoosePassword', 'placeholder' => 'Enter Password', 'required']) !!} <a
                          href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                      </div>
                      @if($errors->has('password'))
                        <div id="passwordFeedback" class="invalid-feedback">
                          {{ $errors->first('password') }}
                        </div>
                      @endif
                      @if(session()->has('error'))
                        <div class="text-danger">
                          {{ session()->get('error') }}
                        </div>
                      @endif
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                      </div>
                    </div>
                    <div class="col-md-6 text-end"> <a href="authentication-forgot-password.html">Forgot Password ?</a>
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button type="submit" class="btn btn-light"><i class="bx bxs-lock-open"></i>Sign in</button>
                      </div>
                    </div>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--end row-->
      </div>
    </div>
  </div>
  <!--end wrapper-->
  <!-- Bootstrap JS -->
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <!--Password show & hide js -->
  <script>
    $(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});

    $(document).on('submit', 'form.needs-validation', function(e) {
      let form = $(this);
      if(!this.checkValidity()) {
        e.preventDefault()
        e.stopPropagation()
      }
      form.addClass('was-validated');

    })
    
  </script>
</body>

</html>