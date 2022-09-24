@extends('user.layouts.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                
            </div>
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                        <hr>
                        @if(session('updateSuccess'))
                                    <div class="col-4 offset-7">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong><i class="fa-solid fa-square-pen mr-2"></i>{{ session('updateSuccess') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                          </div>
                                    </div>
                                            @endif     
                        <form action="{{ route('account#change',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                       <div class="row">
                        <div class="col-3 offset-2">
                            @if (Auth::user()->image == null)
                            @if(Auth::user()->gender == 'male')
                            <img src="{{ asset('image/user3.jpg') }}" class="img-thumbnail" alt="">
                            @else
                            <img src="{{ asset('image/user2.webp') }}" class="img-thumbnail" alt="">
                            @endif     
                            @else
                            <img src="{{ asset('storage/'.Auth::user()->image) }}"  class="img-thumbnail" />   
                            @endif
                            <div><input type="file" name="image" class="file-control mt-3 @error('image') is-invalid @enderror">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class=" mt-3">
                                <button class="btn btn-dark  col-12"><i class="fa-solid fa-circle-chevron-right mr-2"></i></i>Update</button>
                            </div>
                            
                        </div>
                        <div class="col-5 offset-1">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1"> Name</label>
                                <input id="cc-pament" name="name" value="{{ old('name',Auth::user()->name) }}" type="text" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                
                           </div>
                           <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1"> Email</label>
                            <input id="cc-pament" name="email" value="{{ old('email',Auth::user()->email) }}" type="text" class="form-control @error('email') is-invalid @enderror" >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            
                       </div>
                       <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">  Phone</label>
                        <input id="cc-pament" name="phone" value="{{ old('email',Auth::user()->phone) }}" type="text" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        
                   </div>
                   <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1">Gender</label>
                    <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror">
                        <option value="">Choose option.... </option>
                        <option value="male" @if(Auth::user()->gender == 'male')selected @endif>Male</option>
                        <option value="female" @if(Auth::user()->gender == 'female')selected @endif>Female</option>
                    </select>
                    @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                    
               </div>
                   <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1"> Address</label>
                    <textarea name="address" id="" cols="" rows="10" class="form-control @error('address') is-invalid @enderror">{{ old('address',Auth::user()->address) }}</textarea>
                    @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                    
                    
               </div>
               <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Role</label>
                <input id="cc-pament" name="role" value="{{ old('role',Auth::user()->role) }}" type="text" class="form-control"   disabled>
                
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
@endsection