@extends('user.layouts.master')


@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Your Password</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('user#changepassword')}}" method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="categoryid" >
                                            <label for="cc-payment" class="control-label mb-1">Current Password</label>
                                            <input id="cc-pament" name="currentPassword" type="text" class="form-control @if(session('incorrect')) is-invalid @endif @error('currentPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter Current Password">
                                            @error('currentPassword')
                                                <div class="invalid-feedback">
                                                    <h5 class="mt-2 text-danger">{{$message}}</h5>
                                                </div>
                                            @enderror
                                            @if (session('incorrect'))
                                                <div class="invalid-feedback">
                                                    <h5 class="mt-2 text-danger">{{session('incorrect')}}</h5>
                                                </div>
                                            @endif
                                        </div>


                                        <div class="form-group">
                                            <input type="hidden" name="categoryid" >
                                            <label for="cc-payment" class="control-label mb-1">New password</label>
                                            <input id="cc-pament" name="newPassword" type="text" class="form-control @error('newPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                            @error('newPassword')
                                                <div class="invalid-feedback">
                                                    <h5 class="mt-2 text-danger">{{$message}}</h5>
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <input type="hidden" name="categoryid">
                                            <label for="cc-payment" class="control-label mb-1">Confrim Password</label>
                                            <input id="cc-pament" name="confirmPassword" type="text" class="form-control @error('confirmPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password">
                                            @error('confirmPassword')
                                                <div class="invalid-feedback">
                                                    <h5 class="mt-2 text-danger">{{$message}}</h5>
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Change Password</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-light fa-key"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
