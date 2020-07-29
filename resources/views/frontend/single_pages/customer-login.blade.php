
@extends('frontend.layouts.master')
@section('content')


<style type="text/css">
#login .container #login-row #login-column #login-box {
  max-width: 600px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
  margin-bottom: 40px;
  margin-top: 40px;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('frontend/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Customer Login
		</h2>
	</section>

    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{ route('login') }}" method="POST">
                            @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                @foreach ($errors->all() as $error)
                                <strong>{{ $error }}</strong><br>
                                @endforeach
                            </div>
                        @endif

                        @if (Session::get('message'))
                            <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>{{ Session::get('message') }}</strong><br>
                            </div>
                        @endif

                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control">
                                <font color="red">{{ ($errors->has('email'))?($errors->first('email')):'' }}</font>
                            </div>
                            <div class="form-group">
                                <label class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                                <font color="red">{{ ($errors->has('password'))?($errors->first('password')):'' }}</font>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                                <i class="fa fa-user"></i> No account yet ?<a href="{{ route('customer.signup') }}"><span> Signup new account</span></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection





    <script type="text/javascript">
        $(document).ready(function () {
          $('#login-column').validate({
            rules: {

              email: {
                required: true,
                email: true,
              },
              code: {
                required: true,
              },

            },
            messages: {
              code: {
                required: "Please enter the Full Name",
              },
              email: {
                required: "Please enter a email address",
                email: "Please enter a vaild email address"
              },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
            }
          });
        });
    </script>



