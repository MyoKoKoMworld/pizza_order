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
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    <div>
                        <form action="{{ route('admin#list') }}" method="get">
                            @csrf
                            <div class="row">
                                <h2 class="col-5">Search Key : <span class="text-danger">{{ request('key') }}</span></h2>
                                <input type="text" name="key" id="" class="form-control col-4 offset-2"
                                    value="{{ request('key') }}" placeholder="search for data">
                                <button class="btn btn-primary col-1" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="row my-2  ">
                        <h2 class="col-2 offset-9  text-end">
                            <i class="fa-solid fa-database me-3"></i> <span> </span>
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
                    {{-- @if (!$categorys->count()) --}}
                        {{-- <div class="text-center text-muted ">
                            <h2>Not have Data</h2>
                        </div> --}}
                    {{-- @else --}}
                        <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2 text-center table-striped table-secondary table-hovered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                        <tr class="tr-shadow" class="mb-3">
                                            <td  class="col-2">
                                                @if ($a->image != null)
                                                     <img src="{{asset('storage/'.$a->image)}}" >
                                                @else

                                                    @if ($a->gender == 'male')
                                                        <img src="{{asset('image/default_user.jpg')}}">
                                                    @else
                                                        <img src="{{asset('image/female.jpg')}}" >
                                                    @endif
                                                @endif

                                            </td>
                                            <td>{{$a->name}}</td>
                                            <td>{{$a->email}}</td>
                                            <td>{{$a->gender}}</td>
                                            <td>{{$a->phone}}</td>
                                            <td>{{$a->address}}</td>
                                            <td>
                                                @if (Auth::user()->id != $a->id)


                                                    <a href="{{route('admin#changerole',$a->id)}}" class="me-3">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Change Admin Role">
                                                            <i class="fa-solid fa-person-booth"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{route('admin#delete',$a->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete text-danger"></i>
                                                        </button>
                                                    </a>


                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach





                                </tbody>
                            </table>
                        </div>
                        <div class="my-5">
                            {{-- {{$categorys->appends($_REQUEST)->links()}}
                            {{$categorys->appends(request()->query())->links()}} --}}
                            {{ $admin->appends(request()->query())->links() }}
                        </div>




                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>


@endsection
