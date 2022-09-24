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
                        <h3 class=" title-2 ms-4">
                            <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        </h3>
                        <div class="card-title">
                            <h3 class="text-center title-2">User Update</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#userUpdate') }}" method="post" enctype="multipart/form-data">
                            @csrf
                       <div class="row">
                        <div class="col-3 offset-2">
                            
                            @if($user->image == null)
                            @if ($user->gender == 'male')
                            <img src="{{ asset('image/user3.jpg') }}" alt="" class="img-thumbnail shadow-sm">
                            @elseif($user->gender == 'female')  
                            <img src="{{ asset('image/user2.webp') }}" alt="" class="img-thumbnail shadow-sm">
                            @endif
                            @else
                            <img src="{{ asset('storage/'.$user->image) }}" alt="" class="img-thumbnail shadow-sm">
                            @endif  
                            
                            <div>
                                <input type="hidden" name="userId" value="{{ $user->id }}">
                                <input type="file" name="image" value="" class="file-control mt-3 @error('image') is-invalid @enderror">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class=" mt-3">
                                <button class="btn btn-dark  col-12" type="submit"><i class="fa-solid fa-circle-chevron-right mr-2"></i></i>Update</button>
                            </div>
                            
                        </div>
                        <div class="col-5 offset-1">
                            <div class="form-group">
                                
                                <label for="cc-payment" class="control-label mb-1"> Name</label>
                                <input id="cc-pament" name="name" value="{{ old('name',$user->name) }}" type="text" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                
                           </div>
                           <div class="form-group">
                                
                            <label for="cc-payment" class="control-label mb-1"> Email</label>
                            <input  id="cc-pament" name="email" value="{{ old('email',$user->email) }}" type="text" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            
                       </div>
                       <div class="form-group">
                                
                        <label for="cc-payment" class="control-label mb-1"> Phone</label>
                        <input id="cc-pament" name="phone" value="{{ old('phone',$user->phone) }}" type="text" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        
                   </div>
                           
                       <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                        <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror">
                            <option value="">Choose Option</option>
                            <option value="male" @if($user->gender == 'male') selected @endif>Male</option>
                            <option value="female" @if($user->gender == 'female') selected @endif>Female</option>    
                           
                            
                        </select>
                        @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                        
                   </div>
                   <div class="form-group">
                                
                    <label for="cc-payment" class="control-label mb-1">Address</label>
                    <textarea name="address" id="" cols="30" rows="5" class="form-control @error('address') is-invalid @enderror">{{ old('address',$user->address) }}
                    </textarea>
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    
               </div>
                   <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1">Role</label>
                    <input id="cc-pament" name="role" value="{{ $user->role }}" type="text" class="form-control " disabled>
                    
                    
               </div>
              
                      </div>
                    </div> 
                </form> 
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
    
@endsection