@extends('admin.layout.master')
@section('title','Category List Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-8 offset-2">
                <h3 class="mb-3"><i class="fa-solid fa-arrow-left-long me-1" onclick="history.back()"></i></h3>
              <div class="bg-white shadow-sm p-4">
                <h2>User Contact Details</h2>
                <div class="d-flex my-3 align-items-center">
                    <h4 class="me-2"><i class="fa-solid fa-user me-1 text-primary"></i>{{ $contact->name }}</h4>|
                    <p class="ms-1"><i class="fa-solid fa-envelope me-1 text-danger"></i>{{ $contact->email }}</p>|
                    <p class="ms-1"><i class="fa-solid fa-clock me-1 text-success"></i>{{ $contact->created_at->format('j-M-Y') }}</p>
                </div>
                <div class="text-muted">
                    <i class="fa-solid fa-message me-1 text-warning"></i>
                    {{ $contact->message }}
                </div>
                </div>  
               
                
                
                
                
                
            </div>
        </div>
    </div>
</div>
    
@endsection