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
                            <h3 class="text-center title-2">Pizza Update</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#update',$pizza->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                       <div class="row">
                        <div class="col-3 offset-2">
                            
                            <img src="{{ asset('storage/'.$pizza->image) }}"  />   
                            
                            <div><input type="file" name="pizzaImage" class="file-control mt-3 @error('pizzaImage') is-invalid @enderror">
                                @error('pizzaImage')
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
                                <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                <label for="cc-payment" class="control-label mb-1"> Name</label>
                                <input id="cc-pament" name="pizzaName" value="{{ old('pizzaName',$pizza->name) }}" type="text" class="form-control @error('pizzaName') is-invalid @enderror">
                                @error('pizzaName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                
                           </div>
                           <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1"> Description</label>
                            <textarea name="pizzaDescription" id="" cols="" rows="10" class="form-control @error('pizzaDescription') is-invalid @enderror">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                            @error('pizzaDescription')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            
                       </div>
                       <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Category</label>
                        <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is-invalid @enderror">
                            <option value="">Choose option.... </option>
                            @foreach ($category as $c)
                            <option value="{{ $c->id }}" @if($pizza->category_id == $c->id) selected @endif>{{ $c->name }}</option>    
                            @endforeach
                            
                        </select>
                        @error('pizzaCategory')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                        
                   </div>
                   <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1"> Price</label>
                    <input id="cc-pament" name="pizzaPrice" value="{{ old('pizzaPrice',$pizza->price) }}" type="text" class="form-control @error('pizzaPrice') is-invalid @enderror">
                    @error('pizzaPrice')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    
               </div>
               <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Wating Time</label>
                <input id="cc-pament" name="pizzaWaitingTime" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" type="text" class="form-control @error('pizzaWaitingTime') is-invalid @enderror">
                @error('pizzaWaitingTime')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                
           </div>
           <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">View Count</label>
            <input id="cc-pament" name="pizzaViewCount" value="{{ old('pizzaViewCount',$pizza->view_count) }}" type="text" class="form-control " disabled>
            
            
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
<!-- END MAIN CONTENT-->
    
@endsection