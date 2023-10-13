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
                                <h3 class="text-center title-2">Details Account</h3>
                            </div>
                            <hr class="bg-danger">


                            <div class="row">
                                <div class="col-3 offset-1">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('image/default_user.jpg')}}" alt="John Doe" />
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image)}}" alt="John Doe" />
                                    @endif
                                </div>
                                <div class="col-7  ">
                                    <div class="ms-5">
                                        <h4><i class="fa-regular fa-pen-to-square me-3 mb-2"></i>{{Auth::user()->name}}</h4>
                                        <h4><i class="fa-solid fa-location-dot me-3  mb-2"></i>{{Auth::user()->address}}</h4>
                                        <h4><i class="fa-solid fa-envelope me-3 mb-2"></i>{{Auth::user()->email}}</h4>
                                        <h4><i class="fa-solid fa-phone me-3 mb-2"></i></i>{{Auth::user()->phone}}</h4>
                                        <h4><i class="fa-solid fa-venus-mars me-3 mb-2"></i>{{Auth::user()->gender}}</h4>
                                        <h4><i class="fa-solid fa-user-clock me-3 mb-2"></i>{{Auth::user()->created_at->format('j-F-Y')}}</h4>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="text-end">

                                    <a href="{{route('admin#edit')}}">
                                        <button class="btn btn-lg rounded btn-primary">
                                            <i class="fa-solid fa-pen-to-square me-3"></i>
                                            Edit Profile
                                        </button>
                                    </a>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
