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
                @if(session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('deleteSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
               
                <div class="d-flex justify-content-between">
                    <h4 class="">Search Key: <span class="text-danger">{{ request('key') }}</span></h4>
                    <form action="{{ route('product#list') }}" method="get">
                        @csrf
                        <div class="d-flex">
                            <input type="text" class="form-control" value="{{ request('key') }}" name="key" placeholder="Search category.....">
                        <button class="btn btn-dark"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-1 offset-11 mt-2 bg-white p-2 text-center shadow">
                    <h4><i class="fas fa-database"></i> <span class="text-danger me-2">{{ $pizzas->total() }}</span></h4>
                </div>
                
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Waiting Time</th>
                                <th>View Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pizzas as $p)
                            <tr>
                                <td class="col-2"><img src="{{ asset('storage/'.$p->image) }}" alt="" class="img-thumbnail shadow"></td>
                                <td class="col-2">{{ $p->name }}</td>
                                <td class="col-2">{{ $p->price }}</td>
                                <td class="col-2">{{ $p->category_name }}</td>
                               
                                <td class="col-2"><i class="fa-solid fa-eye me-1"></i>{{ $p->view_count }}</td>
                                <td class="col-2">
                                    <div class="table-data-feature float-center">
                                        <a href="{{ route('product#detail',$p->id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>
                                       <a href="{{ route('product#updatePage',$p->id) }}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                    </a>
                                        <a href="{{ route('prouct#delete',$p->id) }}">
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
                        {{ $pizzas->links() }}
                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>
                </div>
               
                <!-- END DATA TABLE -->
                
            </div>
        </div>
    </div>
</div>
    
@endsection