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


                           <form action="{{route('product#update',$product->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-3 offset-1">

                                    <input type="hidden" name="pizzaId" value="{{$product->id}}">
                                     <img src="{{ asset('storage/products/'.$product->image)}}"  alt="John Doe" />

                                    <input type="file" class="form-control mt-3 @error('image') is-invalid @enderror" name="pizzaImage">
                                    @error('pizzaImage')
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
                                        <input id="cc-pament" name="pizzaName" value="{{old('pizzaName',$product->name)}}"  type="text" class="form-control @error('pizzaName') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                        @error('pizzaName')
                                            <div>
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            </div>
                                        @enderror
                                    </div>



                                    {{-- description --}}
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30" rows="10">{{old('pizzaDescription',$product->description)}} </textarea>
                                        @error('pizzaDescription')
                                            <div>
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- price --}}
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="pizzaPrice" value="{{old('pizzaPrice',$product->price)}}" type="text" class="form-control @error('pizzaPrice') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                        @error('pizzaPrice')
                                            <div>
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- waiting_time --}}
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                        <input id="cc-pament" name="pizzaWaiting" value="{{old('pizzaWaiting',$product->waiting_time)}}" type="text" class="form-control @error('pizzaWaiting') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                        @error('pizzaWaiting')
                                            <div>
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            </div>
                                        @enderror
                                    </div>

                                      {{-- Category --}}
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                                        <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror" >
                                            <option value="">Choose Category</option>
                                            @foreach ($category as $c)
                                                <option value="{{$c->id}}" @if($product->category_id == $c->id) selected @endif>{{$c->name}}</option>

                                            @endforeach

                                        </select>
                                        @error('pizzaCategory')
                                            <div>
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- view_count --}}
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">View Count</label>
                                        <input id="cc-pament" name="view_count"value="{{old('view_count',$product->view_count)}}" @disabled(true) type="text" class="form-control"  aria-required="true" aria-invalid="false" placeholder="Enter New Password">
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
