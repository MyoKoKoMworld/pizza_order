@extends('admin.layout.app')

@section('title', 'Category List Page')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    <div>
                        <form action="{{ route('product#list') }}" method="get">
                            @csrf
                            <div class="row">
                                <h2 class="col-5">Search Key : <span class="text-danger">{{request('key')}}</span></h2>
                                <input type="text" name="key" id="" class="form-control col-4 offset-2"
                                    value="{{request('key')}}" placeholder="search for data">
                                <button class="btn btn-primary col-1" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="row my-2  ">
                        <h2 class="col-2 offset-9  text-end">
                            <i class="fa-solid fa-database me-3"></i> <span> {{count($orderlist)}}</span>
                        </h2>
                    </div>

                    <div class="col-2">
                        <select name="status" id="orderstatus" class="form-control">
                            <option value="all" >All</option>
                            <option value="0" >Pending</option>
                            <option value="1">Accept</option>
                            <option value="2" >Reject</option>

                        </select>
                    </div>

                    @if (session('create'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i> {{ session('create') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-xmark"></i> {{ session('delete') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('update'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-xmark"></i> {{ session('update') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- @if(count($product) != 0) --}}

                    <div class="table-responsive table-responsive-data2">

                        <table class="table table-data2 text-center table-striped table-secondary table-hovered">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody id="datalist">
                                @foreach ($orderlist as $o)
                                    <tr class="tr-shadow" class="mb-3">

                                        <td>{{$o->user_id}}</td>
                                        <td>{{$o->user_name}}</td>
                                        <td>{{$o->created_at->format('F-j-Y')}}</td>
                                        <td>{{$o->order_code}}</td>
                                        <td>{{$o->total_price}}</td>
                                        <td >
                                           <select name="status" class="form-control">
                                            <option value="0" @if($o->status == 0) selected @endif>Pending</option>
                                            <option value="1" @if($o->status == 1) selected @endif>Accept</option>
                                            <option value="2" @if($o->status == 2) selected @endif>Reject</option>

                                           </select>
                                        </td>


                                    </tr>
                                 @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{-- @else
                        <div>
                            <h2 class="text-danger">not have data</h2>
                        </div>

                    @endif --}}

                    {{-- <div>
                        {{$orderlist->appends(request()->query())->links()}}
                    </div> --}}




                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scriptsection')


    <script>
        $(document).ready(function(){
            $('#orderstatus').change(function(){
                $status = $('#orderstatus').val();
                // console.log( $status);
                $.ajax({
                    type:'get',
                    dataType:'json',
                    url:'http://127.0.0.1:8000/order/ajax/ordersort',
                    data:{'status':$status},
                    success:function(response){
                        console.log(response.length);
                        $list = ''
                        for($i=0;$i<response.length;$i++){
                            $list +=`

                            <tr class="tr-shadow" class="mb-3">

                                <td>${response[$i].user_id}</td>
                                <td>${response[$i].user_name}</td>
                                <td>${response[$i].created_at}</td>
                                <td>${response[$i].order_code}</td>
                                <td>${response[$i].total_price}</td>
                                <td >
                                <select name="status" class="form-control">
                                    <option value="0" @if($o->status == 0) selected @endif>Pending</option>
                                    <option value="1" @if($o->status == 1) selected @endif>Accept</option>
                                    <option value="2" @if($o->status == 2) selected @endif>Reject</option>

                                </select>
                                </td>


                            </tr>
                            `

                        }
                    $('#datalist').html($list)

                    }
                })
            })
        })
    </script>

@endsection
