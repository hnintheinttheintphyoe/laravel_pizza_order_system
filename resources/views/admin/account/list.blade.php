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
                            <h2 class="title-1">Admin List</h2>

                        </div>
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
                    <form action="{{ route('admin#list') }}" method="get">
                        @csrf
                        <div class="d-flex">
                            <input type="text" class="form-control" value="{{ request('key') }}" name="key" placeholder="Search category.....">
                        <button class="btn btn-dark"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-1 offset-11 mt-2 bg-white p-2 text-center shadow">
                    <h4><i class="fas fa-database"></i> <span class="text-danger me-2">{{ $admin->total() }}</span></h4>
                </div>
               
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
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
                            <tr class="tr-shadow">
                                <td class="col-2">
                                    @if($a->image == null)
                                   @if($a->gender == 'male')
                                   <img src="{{ asset('image/user3.jpg') }}" class="img-thumbnail" alt="">
                                   @else
                                   <img src="{{ asset('image/user2.webp') }}" class="img-thumbnail" alt="">
                                   @endif
                                        
                                    @else
                                    <img src="{{asset('storage/'.$a->image)  }}" class="img-thumbnail" alt="">   
                                    
                                    @endif
                                </td>
                                <td>{{ $a->name }}
                                <input type="hidden" class="userId" value="{{ $a->id }}"></td>
                                <td>{{ $a->email }}</td>
                                <td>{{ $a->gender }}</td>
                                <td>{{ $a->phone }}</td>
                                <td>{{ $a->address }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        
                                      @if(Auth::user()->id == $a->id)
                                      @else
                                     
                                    <div class="me-5">
                                        <select name="status" id="roleChange" class="form-control">
                                            <option value="user" @if($a->role == 'user') selected @endif>User</option>
                                            <option value="admin" @if($a->role == 'admin') selected @endif>Admin</option>
                                        </select>
                                    </div>
                                      <a href="{{ route('admin#delete',$a->id) }}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                           <i class="zmdi zmdi-delete"></i>
                                        </button>
                                        
                                    </a>  
                                      @endif 
                                        
                                    </div>
                                </td>
                                
                            </tr>
                            <tr class="spacer"></tr>  
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $admin->links() }}
                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                     </div>
                </div>
                
                <!-- END DATA TABLE -->
                
            </div>
        </div>
    </div>
</div>
    
@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
        $('#roleChange').change(function(){
            $currentRole=$(this).val();
            $parentNode=$(this).parents('tr');
            $userId=$parentNode.find('.userId').val();
            
            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/admin/ajax/change/role',
                data:{'userId':$userId,
                      'role':$currentRole},
                dataType:'json',
                success:function(response){
                    if(response.message == 'success'){
                        location.reload(true);
                    }
                
                }
            })
        })
    })
</script>
@endsection