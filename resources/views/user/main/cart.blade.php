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
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="totaltr">
                       @foreach ($cart as $c)
                            <tr>

                                <td class="align-middle">
                                    <img src="{{asset('storage/products/'.$c->image)}}" alt="" style="width: 50px;">{{$c->products_name}}
                                    <input type="hidden" id="product_id" value="{{$c->product_id}}">
                                    <input type="hidden" id="order_id" value="{{$c->id}}">
                                    {{-- {{$c->id}} --}}
                                    <input type="hidden" id="user_id" value="{{$c->user_id}}">

                                </td>
                                <td class="align-middle"><span id="price">{{$c->price}}</span> <span class="text-danger ms-1">kyats</span></td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" >
                                            <i  class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="qty" disabled class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->qty}}">
                                        <div class="input-group-btn">
                                            <button  class="btn btn-sm btn-primary btn-plus">
                                                <i  class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{$c->price * $c->qty}} <span class="ms-1 text-danger">Kyats</span></td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger removeItem"><i class="fa fa-times"></i></button></td>
                            </tr>

                       @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 >Subtotal</h6>
                            <h6 id="subtotal">{{$totalprice}} <span class="text-danger ms-1">kyats</span></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">5000 <span class="text-danger ms-1">kyats</span></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finaltotal">{{$totalprice + 5000}} <span class="text-danger ms-1">kyats</span></h5>
                        </div>
                        <button class="btn btn-block btn-primary text-white font-weight-bold my-3 py-3" id="checkout">Proceed To Checkout</button>
                        <button class="btn btn-block btn-info text-white font-weight-bold my-3 py-3" id="clearcart">Clear Cart</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection

@section('scriptsource')
   <script>
        $(document).ready(function(){
            $('.btn-plus').click(function(){
                $parentnode = $(this).parents('tr');
                $price = Number($parentnode.find('#price').text());
                // console.log($price);
                $qty = $parentnode.find('#qty').val();
                $total = $price * $qty;
                // console.log($total);

                $parentnode.find('#total').html($total+'<span class="ms-1 text-danger">Kyats</span>')

                summerarycalculation();



            })

            $('.btn-minus').click(function () {
                $parentnode = $(this).parents('tr');
                $price = Number($parentnode.find('#price').text());

                $qty = $parentnode.find('#qty').val();
                $total = $price * $qty;
                // console.log($total);

                $parentnode.find('#total').html($total+'<span class="ms-1 text-danger">Kyats</span>')

                summerarycalculation();

            })

            $('.removeItem').click(function(){
               $parentNode = $(this).parents('tr');
               $parentNode.remove();
               $poduct_id =$parentNode.find('#product_id').val();
               $orderid = $parentNode.find('#order_id').val();
                // console.log($orderid);
            //    console.log($poduct_id);
                $.ajax({
                    type:'get',
                    url:'http://127.0.0.1:8000/user/ajax/clear/current/product',
                    data : {'product_id':$poduct_id,'orderid':$orderid},
                    dataType : 'json'

                })


                summerarycalculation();

            })
            function summerarycalculation(){
                $total_price = 0;
                $('#totaltr tr').each(function(index,row){
                    $total_price += Number($(row).find('#total').text().replace('Kyats',''));
                })

                $('#subtotal').html($total_price+'<span class="text-danger ms-1">kyats</span>');
                $('#finaltotal').html($total_price+5000+'<span class="text-danger ms-1">kyats</span>')
            }


            // $user_id = $('#user_id')
            $('#checkout').click(function(){

                $random_order_code = Math.floor(Math.random()*10000000);

                $orderlist = [];
                $('#totaltr tr').each(function(index,row){
                    // console.log($(row).find('#total').text());
                    $orderlist.push({
                        'user_id' : $(row).find('#user_id').val(),
                        'product_id' : $(row).find('#product_id').val(),
                        'qty' : $(row).find('#qty').val(),
                        'total' : $(row).find('#total').text().replace('Kyats',''),
                        'order_code' : '00'+$random_order_code+'00'

                    })
                })
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/order',
                    data : Object.assign({},$orderlist),
                    dataType : 'json',
                    success : function(respond){
                        if(respond.status == "success"){
                           window.location.href="http://127.0.0.1:8000/user/home"
                        }
                    }
                })

            })


            $('#clearcart').click(function(){
                // console.log('clear');
                $('#totaltr tr').remove();
                $('#subtotal').html('0 <span class="text-danger ms-1">kyats</span>')
                $('#finaltotal').html('5000 <span class="text-danger ms-1">kyats</span>')

                $.ajax({
                    type:'get',
                    url :'http://127.0.0.1:8000/user/ajax/clear/cart',
                    dataType : 'json'
                })

            })
        })



   </script>
@endsection




