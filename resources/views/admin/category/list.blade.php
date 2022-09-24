@extends('admin.layout.master')
@section('title','Category List Page')
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
                @if(session('deleteMessage'))
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('deleteMessage') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                <div class="d-flex justify-content-between">
                    <h4 class="">Search Key: <span class="text-danger">{{ request('key') }}</span></h4>
                    <form action="{{ route('category#list') }}" method="get">
                        @csrf
                        <div class="d-flex">
                            <input type="text" class="form-control" value="{{ request('key') }}" name="key" placeholder="Search category.....">
                        <button class="btn btn-dark"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-1 offset-11 mt-2 bg-white p-2 text-center shadow">
                    <h4><i class="fas fa-database"></i> <span class="text-danger me-2">{{ $categories->total() }}</span></h4>
                </div>
                @if(count($categories) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Category Name</th>
                                <th>Category Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr class="tr-shadow">
                                <td>{{ $category->id }}</td>
                                <td class="col-6">{{ $category->name }}</td>
                                <td>{{ $category->created_at->format('j-M-Y ') }}</td>
                                <td>
                                    <div class="table-data-feature">
                                       
                                       <a href="{{ route('category#edit',$category->id) }}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                    </a>
                                        <a href="{{ route('category#delete',$category->id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button> 
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>  
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $categories->links() }}
                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>
                </div>
                @else
                <h3 class="text-secondary text-center mt-3">There is no data. Here!</h3>
                @endif
                <!-- END DATA TABLE -->
                
            </div>
        </div>
    </div>
</div>
    
@endsection