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
                            <h2 class="title-1">User List</h2>

                        </div>
                    </div>
                   
                </div>
                @if(session('updateSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fa-solid fa-check"></i>{{ session('updateSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
               
                
                
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th> Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="dataList">
                            @foreach ($userList as $u)
                           <tr>
                            <td class="col-2">
                                @if($u->image == null)
                                @if ($u->gender == 'male')
                                <img src="{{ asset('image/user3.jpg') }}" alt="" class="img-thumbnail shadow-sm">
                                @elseif($u->gender == 'female')  
                                <img src="{{ asset('image/user2.webp') }}" alt="" class="img-thumbnail shadow-sm">
                                @endif
                                @else
                                <img src="{{ asset('storage/'.$u->image) }}" alt="" class="img-thumbnail shadow-sm">
                                @endif
                            </td>
                             <td class="col-3">{{ $u->name }}
                            <input type="hidden" id="userId" value="{{ $u->id }}"></td> 
                             <td class="col-2">{{ $u->email }}</td>
                             <td class="">{{ $u->address }}</td>
                             <td class="col-2">{{ $u->phone }}</td>
                             <td class="">{{ $u->gender }}</td>
                             <td class="col-3">
                              <select name="" id="" class="form-control changeUserRole">
                              <option value="user" @if ($u->role == 'user')
                               selected   
                              @endif>User</option>  
                              <option value="admin" @if ($u->role == 'admin')
                                selected   
                               @endif>Admin</option>
                            </select>  
                            </td>  
                            <td class="col-2">
                                <div class="table-data-feature float-center">
                                   
                                   <a href="{{ route('admin#userUpdatePage',$u->id) }}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                    <a href="{{ route('admin#userListDelete',$u->id) }}">
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
                        {{ $userList->links() }}
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
        $('.changeUserRole').change(function(){
            $currentRole=$(this).val();
            $parentNode=$(this).parents('tr');
            $userId=$parentNode.find('#userId').val();
            
            $role=$currentRole;
            $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/change/role',
            data:{'userId':$userId,
                  'role':$role },
            dataType:'json',      
            });
            location.reload(true);
            
        })
    })
    </script> 
@endsection
