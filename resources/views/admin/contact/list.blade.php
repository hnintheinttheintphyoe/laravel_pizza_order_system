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
                            <h2 class="title-1">User Contact List</h2>

                        </div>
                    </div>
                   
                </div>
                @if(session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fa-solid fa-triangle-exclamation me-1"></i>{{ session('deleteSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
               
                <div class="d-flex justify-content-between">
                    <h4 class="">Search Key: <span class="text-danger">{{ request('key') }}</span></h4>
                    <form action="" method="get">
                        @csrf
                        <div class="d-flex">
                            <input type="text" class="form-control" value="{{ request('key') }}" name="key" placeholder="Search category.....">
                        <button class="btn btn-dark"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-1 offset-11 mt-2 bg-white p-2 text-center shadow">
                    <h4><i class="fas fa-database"></i> <span class="text-danger me-2"></span>{{ $contact->total() }}</h4>
                </div>
                
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                               
                                <th >Name</th>
                                <th >Email</th>
                                <th >Message</th>
                                <th>Send Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($contact as $c)
                          <tr>
                            
                            <td class="col-2">{{ $c->name }}</td>
                          <td class="col-2">{{ $c->email }}</td>
                          <td class="col-3">{{ substr($c->message,0,30).'.......' }}</td>
                          <td class="col-2">{{ $c->created_at->format('j-M-Y') }}</td>
                          <td class="col-2">
                            <div class="table-data-feature float-center">
                                <a href="{{ route('contact#view',$c->id) }}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </a>
                               
                                <a href="{{ route('contact#delete',$c->id) }}">
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
                        {{ $contact->links() }}
                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>
                </div>
               
                <!-- END DATA TABLE -->
                
            </div>
        </div>
    </div>
</div>
    
@endsection