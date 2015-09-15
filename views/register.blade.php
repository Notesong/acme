@extends('base')

@section('browsertitle')
  Acme - Register
@stop

@section('content')
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <h1>Register</h1>
        <hr>
        <!-- Register Form Start -->
        <form name="registerform" id="registerform" class="form-horizontal" action="/register" method="post" novalidate="novalidate">
            <input type="hidden" name="_token" value="{!! htmlspecialchars($signer->getSignature()) !!}">
            <!-- First Name -->
            <div class="form-group">
                <label for="first_name" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="first_name" name="first_name" placeholder="First Name">
                </div>
            </div>
            <!-- Last Name -->
            <div class="form-group">
                <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="last_name" name="last_name" placeholder="Last Name">
                </div>
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control required email" id="email" name="email" placeholder="user@example.com">
                </div>
            </div>
            <!-- Verify Email -->
            <div class="form-group">
                <label for="verify_email" class="col-sm-2 control-label">Verify Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control required email" id="verify_email" name="verify_email" placeholder="user@example.com">
                </div>
            </div>
            <!-- Password -->
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control required" id="password" name="password" placeholder="Password ~ 6-15 Characters">
                </div>
            </div>
            <!-- Verify Password -->
            <div class="form-group">
                <label for="verify_password" class="col-sm-2 control-label">Verify Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control required" id="verify_password" name="verify_password" placeholder="Password ~ 6-15 Characters">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-2">
    </div>
</div>
@stop

@section('bottomjs')
<script>
    $(document).ready(function() {
         $("#registerform").validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 20
                },
                last_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 30
                },
                verify_email: {
                    required: true,
                    email: true,
                    equalTo: "#email"
                },
                email: {
                    required: true,
                    email: true,
                },
                verify_password: {
                    required: true,
                    equalTo: "#password",
                    minlength: 6,
                    maxlength: 15
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 15
                }
            }
        });
    });
</script>
@stop
