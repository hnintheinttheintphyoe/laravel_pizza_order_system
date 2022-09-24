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
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class=" title-2 ms-4">
                                <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                            </h3>
                        </div>
                        <hr>
                       <div class="row">
                        <div class="col-5">
                            
                            <img src="{{ asset('storage/'.$pizza->image) }}" class="w-100 img-thumbnail shadow" />  
                           
                        </div>
                        <div class="col-7">
                            <div  class="ms-4">
                                <div>
                                    <span class="my-3 btn bg-danger  text-white">{{ $pizza->name }}</span>
                                </div>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid me-2 fa-money-bill-wave"></i>{{ $pizza->price }}Kyats</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-regular me-2 fa-clock"></i>{{ $pizza->waiting_time }}mins</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid me-2 fa-eye"></i>{{ $pizza->view_count }}</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid me-2 fa-link"></i>{{ $pizza->category_name }}</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-user-clock me-2"></i>{{ $pizza->created_at->format('j-F-Y') }}</span>
                                <div><i class="fa-solid me-2 fa-file-lines"></i>Details
                                <p>{{ $pizza->description }}</p>
                                </div>
                            </div>
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