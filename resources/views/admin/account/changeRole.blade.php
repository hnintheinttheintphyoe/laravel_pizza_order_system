@extends('admin.layout.master')
@section('title','Category List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                
            </div>
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#changeRole',$changeRole->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                       <div class="row">
                        <div class="col-3 offset-2">
                            @if ($changeRole->image == null)
                            @if($changeRole->gender == 'male')
                            <img src="{{ asset('image/user3.jpg') }}" class="img-thumbnail" alt="">
                            @else
                            <img src="{{ asset('image/user2.webp') }}" class="img-thumbnail" alt="">
                            @endif     
                            @else
                            <img src="{{ asset('storage/'.$changeRole->image) }}"  />   
                            @endif
                            
                            <div class=" mt-3">
                                <button class="btn btn-dark  col-12"><i class="fa-solid fa-circle-chevron-right mr-2"></i></i>Update</button>
                            </div>
                            
                        </div>
                        <div class="col-5 offset-1">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1"> Name</label>
                                <input id="cc-pament" name="name" disabled value="{{ old('name',$changeRole->name) }}" type="text" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                
                           </div>
                           <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Role</label>
                            <select name="role" class="form-control" id="">
                                <option value="admin" @if($changeRole->role == 'admin') selected  @endif>admin</option>
                                <option value="user" @if($changeRole->role == 'user') selected  @endif>user</option>
                            </select>
                            
                       </div> 
                           <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1"> Email</label>
                            <input id="cc-pament" name="email" disabled value="{{ old('email',$changeRole->email) }}" type="text" class="form-control @error('email') is-invalid @enderror" >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            
                       </div>
                       <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">  Phone</label>
                        <input id="cc-pament" name="phone" disabled value="{{ old('email',$changeRole->phone) }}" type="text" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        
                   </div>
                   <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1">Gender</label>
                    <select name="gender" id="" disabled class="form-control @error('gender') is-invalid @enderror">
                        <option value="">Choose option.... </option>
                        <option value="male" @if($changeRole->gender == 'male')selected @endif>Male</option>
                        <option value="female" @if($changeRole->gender == 'female')selected @endif>Female</option>
                    </select>
                    @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                    
               </div>
                   <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1"> Address</label>
                    <textarea name="address" disabled id="" cols="" rows="10" class="form-control @error('address') is-invalid @enderror">{{ old('address',$changeRole->address) }}</textarea>
                    @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                    
                    
               </div>
               
                        </div>
                    </div> 
                </form> 
                    <div class="row mt-3">
                        
                    </div>  

                        
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
    
@endsection