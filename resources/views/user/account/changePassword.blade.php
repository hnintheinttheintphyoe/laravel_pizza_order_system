

@extends('user.layouts.master')
@section('content')
<div class="col-6 offset-3">
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    
                </div>
                <div class="">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            @if(session('changeSuccess'))
                            <div class="col-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong><i class="fas fa-check mr-2"></i>{{ session('changeSuccess') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                            </div>
                                    @endif
                                    @if(session('oldPassError'))
                                    <div class="col-12">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong><i class="fas fa-exclamation-triangle mr-2"></i>{{ session('oldPassError') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                          </div>
                                    </div>
                                            @endif     
    
                            <form action="{{ route('password#change') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror "  aria-required="true" aria-invalid="false" placeholder="Old Password">
                                    @error('oldPassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                   
    
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="New Password">
                                    @error('oldPassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                               </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Confirm Password">
                                    @error('confirmPassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
    
                                </div>
                                
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block text-white">
                                        <span id="payment-button-amount">Change Password</span>
                                        
                                        <i class="fas fa-key"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection