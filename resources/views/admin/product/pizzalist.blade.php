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
                                <h2 class="title-1">Product List</h2>

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
                            <i class="fa-solid fa-database me-3"></i> <span> {{ $product->total()}}</span>
                        </h2>
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

                    @if(count($product) != 0)

                    <div class="table-responsive table-responsive-data2">

                        <table class="table table-data2 text-center table-striped table-secondary table-hovered">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Name</th>
                                    <th>Category Name</th>
                                    <th>Price</th>
                                    <th><i class="fa-solid fa-eye"></i>View Count</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $p)
                                    <tr class="tr-shadow" class="mb-3">

                                        <td class="col-2">
                                            <img src="{{asset('storage/products/'.$p->image)}}">
                                        </td>
                                        <td class="col-2">
                                            <span class="block-email">{{ $p->name }}</span>
                                        </td>
                                        <td class="col-2">{{$p->category_name}}</td>
                                        <td class="col-2">{{$p->price}}</td>
                                        <td class="col-2">{{$p->view_count}}</td>

                                        <td class="col-2">
                                            <div class="table-data-feature">
                                                <a href="{{route('product#edit',$p->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="View">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button></a>
                                                <a href="{{route('product#updatepage',$p->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{route('product#delete',$p->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete text-danger"></i>
                                                    </button>
                                                </a>

                                            </div>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @else
                        <div>
                            <h2 class="text-danger">not have data</h2>
                        </div>

                    @endif

                    <div>
                        {{$product->links()}}
                    </div>




                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>


@endsection
