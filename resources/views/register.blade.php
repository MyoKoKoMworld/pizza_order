@extends('layout.master')

@section('title')
    Register Page
@endsection

@section('content')
    <div class="login-form">
        <form action="" method="post">
            @csrf

            @error('terms')
                {{$message}}
            @enderror
            {{-- Name --}}
            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" value="{{old('name')}}" placeholder="Username">

                @error('name')
                    <h6 class="text-danger">{{$message}}</h6>
                @enderror
            </div>

            {{-- email --}}
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" value="{{old('email')}}" placeholder="Email">
                @error('email')
                    <h6 class="text-danger">{{$message}}</h6>
                @enderror
            </div>

            {{-- address --}}
            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" value="{{old('address')}}" placeholder="Address">
                @error('address')
                    <h6 class="text-danger">{{$message}}</h6>
                @enderror
            </div>

            {{-- phone --}}
            <div class="form-group">
                <label>Phone Number</label>
                <input class="au-input au-input--full" type="text" name="phone" value="{{old('phone')}}" placeholder="09xxxxxxxxx">
                @error('phone')
                    <h6 class="text-danger">{{$message}}</h6>
                @enderror
            </div>

            {{-- gender --}}
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            {{-- password --}}
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="text" name="password"  placeholder="Password">
                @error('password')
                    <h6 class="text-danger">{{$message}}</h6>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
                @error('password_confirmation')
                    <h6 class="text-danger">{{$message}}</h6>
                @enderror

            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('Auth#login')}}">Sign In</a>
            </p>
        </div>
    </div>
@endsection
