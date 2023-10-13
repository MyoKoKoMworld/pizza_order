@extends('user.layouts.master')

@section('content')


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $o)
                            <tr>
                                <td class="align-middle">{{$o->created_at}}</td>
                                <td class="align-middle">{{$o->order_code}}</td>
                                <td class="align-middle">{{$o->total_price}}</td>
                                <td class="align-middle">
                                    @if ( $o->status  == 0)
                                        <button class="btn btn-sm btn-warning">Pending</button>

                                    @elseif( $o->status  == 1)
                                        <button class="btn btn-sm btn-success">Success</button>
                                    @elseif( $o->status  == 2)
                                        <button class="btn btn-sm btn-danger">Reject</button>


                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
    <!-- Cart End -->

@endsection






