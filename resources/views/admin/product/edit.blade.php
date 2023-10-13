@extends('admin.layout.app')

@section('title','Category List Page')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card shadow">
                        <div class="card-body">
                           <div class="row">
                                <div class="col-1">

                                        <i class="fa-solid fa-backward" onclick="history.back()"></i>

                                </div>
                                <div class="col-10 card-title">
                                    <h3 class="text-center title-2">Product Details</h3>
                                </div>
                           </div>
                            <hr class="bg-danger">


                            <div class="row">
                                <div class="col-3 offset-1">
                                   <img src="{{ asset('storage/products/'.$product_edit->image)}}" alt="John Doe" />

                                </div>
                                <div class="col-7  ">
                                    <div class="ms-5">

                                        <h4><i class="fa-solid fa-file-signature me-3  mb-2"></i>{{$product_edit->name}}</h4>
                                        <h4><i class="fa-solid fa-coins me-3  mb-2"></i>{{$product_edit->price}}</h4>
                                        <h4><i class="fa-solid fa-file-contract me-3  mb-2"></i>{{$product_edit->description}}</h4>
                                        <h4><i class="fa-regular fa-eye me-3  mb-2"></i>{{$product_edit->view_count}}</h4>
                                        <h4><i class="fa-regular fa-clock me-3  mb-2"></i>{{$product_edit->waiting_time}}</h4>
                                        <h4><i class="fa-solid fa-circle-info me-3  mb-2"></i>{{$product_edit->category_name}}</h4>

                                        <h4><i class="fa-solid fa-calendar-days me-3  mb-2"></i>{{$product_edit->created_at->format('j-F-Y')}}</h4>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="text-end">

                                    <a href="{{route('admin#edit')}}">
                                        <button class="btn btn-lg rounded btn-primary">
                                            <i class="fa-solid fa-pen-to-square me-3"></i>
                                            Edit Product
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
