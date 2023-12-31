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
                                <h2 class="title-1">Category List</h2>

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
                        <form action="{{ route('category#list') }}" method="get">
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
                            <i class="fa-solid fa-database me-3"></i> <span> {{ $categorys->total() }}</span>
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
                    @if (!$categorys->count())
                        <div class="text-center text-muted ">
                            <h2>Not have Data</h2>
                        </div>
                    @else
                        <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2 text-center table-striped table-secondary table-hovered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorys as $category)
                                        <tr class="tr-shadow" class="mb-3">
                                            <td>{{ $category->id }}</td>
                                            <td class="col-5">
                                                <span class="block-email">{{ $category->name }}</span>
                                            </td>

                                            <td>{{ $category->created_at->format('j-F-Y') }}</td>

                                            <td>
                                                <div class="table-data-feature">
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button> --}}
                                                    <a href="{{ route('category#edit',$category->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $category->id) }}">
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
                        <div class="my-5">
                            {{-- {{$categorys->appends($_REQUEST)->links()}} --}}
                            {{-- {{$categorys->appends(request()->query())->links()}} --}}
                            {{ $categorys->links() }}
                        </div>
                    @endif



                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>


@endsection
