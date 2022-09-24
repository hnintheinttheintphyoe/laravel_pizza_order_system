@extends('admin.layout.master')
@section('title','Category List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
               <div class="col-3 offset-6 mb-2">
                @if(session('updateSuccess'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('updateSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                </div> 
            </div>
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                       <div class="row">
                        <div class="col-5 offset-1">
                            @if (Auth::user()->image == null)
                            @if(Auth::user()->gender == 'male')
                            <img src="{{ asset('image/user3.jpg') }}" class="img-thumbnail" alt="">
                            @else
                            <img src="{{ asset('image/user2.webp') }}" class="img-thumbnail" alt="">
                            @endif   
                            @else
                            <img src="{{ asset('storage/'.Auth::user()->image) }}" class="w-100 img-thumbnail shadow" />  
                            @endif
                        </div>
                        <div class="col-5">
                            <div  class="ms-4">
                                <h3 class="mb-3"><i class="mr-2 fas fa-user-edit"></i>{{ Auth::user()->name }}</h3>
                                <h3 class="my-3"><i class="mr-2 fas fa-envelope"></i>{{ Auth::user()->email }}</h3>
                                <h3 class="my-3"><i class="mr-2 fas fa-phone"></i>{{ Auth::user()->phone }}</h3>
                                <h3 class="my-3"><i class="mr-2 fas fa-address-card"></i>{{ Auth::user()->address }}</h3>
                                <h3 class="my-3"><i class="mr-2 fa-solid fa-mars-and-venus"></i>{{ Auth::user()->gender }}</h3>
                                <h3 class="my-3"><i class="mr-2 fas fa-user-clock"></i>{{ Auth::user()->created_at->format('j-F-Y') }}</h3>
                            </div>
                        </div>
                    </div>  
                    <div class="row mt-3">
                        <div class="col-4 offset-2 ">
                            <a href="{{ route('admin#edit') }}">
                                <button class="btn btn-dark ml-4"><i class="fas fa-edit mr-2"></i>Edit Profile</button>
                            </a>
                        </div>
                    </div>  

                        
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
    
@endsection