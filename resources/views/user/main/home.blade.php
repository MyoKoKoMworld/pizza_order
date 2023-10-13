@extends('user.layouts.master')


@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->

                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3">

                            <label >All Price</label>
                            <span class="font-weight-normal">1000</span>
                        </div>

                        <hr class="bg-primary" style="height:5px;">

                        <a href="{{route('user#home')}}"> <label >All</label></a>

                        @foreach ($category as $c)
                            <div class="d-flex align-items-center justify-content-between mb-3">

                               <a href="{{route('user#filter',$c->id)}}"> <label >{{$c->name}}</label></a>

                            </div>

                        @endforeach

                    </form>
                </div>
                <!-- Price End -->


                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center mb-4">
                            {{-- cart --}}

                            <div>
                               <a href="{{route('user#cart')}}">
                                    <button class="bg-dark text-white position-relatve">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="badge bg-danger position-absolute top-0  rounded-pill">{{$cart->count()}}</span>
                                    </button>
                                </a>
                            </div>

                            {{-- history --}}
                            <div class="ms-3">
                                <a href="{{route('user#history')}}">
                                     <button class="bg-dark text-white position-relatve">
                                         <i class="fa-solid fa-cart-shopping"></i>
                                         <span class="badge bg-danger position-absolute top-0  rounded-pill">{{$order->count()}}</span>
                                     </button>
                                 </a>
                             </div>


                            <div class="ml-2 ms-5">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-select">
                                        <option value="">Select Sorting</option>
                                        <option value="asc">Asending</option>
                                        <option value="desc">Descending</option>

                                    </select>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="list">
                        @if($product->count())
                            @foreach ($product as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100"
                                                src="{{asset('storage/products/'.$p->image)}}" style="height: 250px">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href="{{route('pizza#detail',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>

                                                    </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">

                                                <h5>{{$p->price}} Kyats</h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        @endforeach

                        @else
                            <h2 class="text-center mt-4 text-info">there has not category pizza</h2>

                        @endif
                    </div>


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection


@section('scriptsource')

<script>
    $(document).ready(function(){



        $('#sortingOption').change(function(){
            optionvalue = $('#sortingOption').val();

            if(optionvalue == 'asc'){
                $.ajax({
                type:'get',
                data:{'status':'asc'},
                url:'http://127.0.0.1:8000/user/ajax/pizza/list',
                dataType:'json',
                success:function(respond){
                    list = ``
                    for($i = 0; $i < respond.length;$i++){
                        list +=
                        `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100"
                                            src="{{asset('storage/products/${respond[$i].image}')}}">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                                                </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${respond[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">

                                            <h5>${respond[$i].price} Kyats</h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        `;

                        $('#list').html(list);


                    }
                }
                })
            }
            else if(optionvalue == 'desc'){
                $.ajax({
                type:'get',
                data:{'status':'desc'},
                url:'http://127.0.0.1:8000/user/ajax/pizza/list',
                dataType:'json',
                success:function(respond){
                    list = ``
                    for($i = 0; $i < respond.length;$i++){
                        list +=
                        `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100"
                                            src="{{asset('storage/products/${respond[$i].image}')}}">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                                                </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${respond[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">

                                            <h5>${respond[$i].price} Kyats</h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        `;

                        $('#list').html(list);


                    }
                }
            })
            }
        })


    });
</script>

@endsection
