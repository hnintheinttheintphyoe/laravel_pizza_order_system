@extends('user.layouts.master')
@section('content')

    <div class="container-fluid">
        <div class="row px-xl-5 justify-content-center">
            
            <div class="col-lg-6  bg-white shadow-sm">
                @if(session('sendSuccess'))
            <div class="mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('sendSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif
            <form action="{{ route('contact#sendMessage') }}" class="p-3" method="post">
                @csrf
                <h2 class="mb-2"><i class="fa-regular fa-address-card text-primary me-2 "></i>Contact Form</h2>
            <div class="row mb-3">
                <div class="col-6">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Name" value="{{ old('name') }}">
                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>  
                    @enderror
                </div>
                <div class="col-6">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>  
                  @enderror
                </div>
            </div>
            <div class="row mb-3">
               <div class="col-12">
                <textarea name="message" id="" cols="30" rows="5" class="form-control @error('message') is-invalid @enderror" placeholder="Enter your message" value="{{ old('message') }}"></textarea>
                @error('message')
                <div class="invalid-feedback">{{ $message }}</div>  
              @enderror
               </div>
            </div>
            <div class="row">
              <div class="col-12 ">
                <button class="btn btn-dark float-right" type="submit">Send Message<i class="fa-solid fa-paper-plane ms-2"></i></button>
              </div>
            </div>
            </form>
        </div>
    </div>
</div>

    
@endsection

