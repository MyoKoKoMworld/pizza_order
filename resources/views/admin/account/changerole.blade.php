@extends('admin.layout.app')

@section('title','Category List Page')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Edit</h3>
                            </div>
                            <hr class="bg-danger">


                           <form action="{{route('admin#change',$account->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-3 offset-1">
                                    @if ($account->image == null)
                                        <img src="{{ asset('image/default_user.jpg')}}"  alt="John Doe" />
                                    @else
                                        <img src="{{ asset('storage/'.$account->image)}}" alt="John Doe" />
                                    @endif
                                    <input type="file" class="form-control mt-3 @error('image') is-invalid @enderror" name="image">
                                    @error('image')
                                        <div>
                                            <p class="text-danger">
                                                {{$message}}
                                            </p>
                                        </div>
                                    @enderror
                                    <div class="mt-3">
                                        <button class="btn btn-primary col-12">
                                            Update
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    {{-- name --}}
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" value="{{old('name',$account->name)}}"  disabled type="text" class="form-control @error('name') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                        @error('name')
                                            <div>
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- email --}}
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" value="{{old('email',$account->email)}}"  disabled type="text" class="form-control @error('email') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                        @error('email')
                                            <div>
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- address --}}
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" disabled cols="30" rows="10">{{old('address',$account->address)}} </textarea>
                                        @error('address')
                                            <div>
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- phone --}}
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" value="{{old('phone',$account->phone)}}" type="text" disabled class="form-control @error('phone') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                        @error('phone')
                                            <div>
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            </div>
                                        @enderror
                                    </div>

                                      {{-- Gender --}}
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror" disabled>
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if($account->gender == 'male') selected @endif>Male</option>
                                            <option value="female"  @if($account->gender == 'female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                            <div>
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- role --}}
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Role</label>
                                        <select name="role" class="form-control data-bs-toggle">
                                            <option value="admin" @if($account->role == 'admin') selected @endif id="">Admin</option>
                                            <option value="user" @if($account->role == 'user') selected @endif id="">User</option>

                                        </select>
                                        {{-- <input id="cc-pament" name="role"value="{{old('role',$account->role)}}" @disabled(true) type="text" class="form-control"  aria-required="true" aria-invalid="false" placeholder="Enter New Password"> --}}
                                    </div>

                                </div>
                            </div>
                           </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
