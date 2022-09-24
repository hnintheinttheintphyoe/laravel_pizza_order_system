@extends('layout.master')
@section('title','Register Page')
@section('content')
<div class="login-form ">
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input class="au-input au-input--full" type="text" name="name" value="{{ old('name') }}" placeholder="Username">
            @error('name')
            <small class="text-danger">{{ $message }}</small>    
            @enderror
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
            @error('email')
            <small class="text-danger">{{ $message }}</small>    
            @enderror
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input class="au-input au-input--full" type="text" name="phone" value="{{ old('phone') }}" placeholder="09xxxxxx">
            @error('phone')
            <small class="text-danger">{{ $message }}</small>    
            @enderror
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select name="gender" id="" class="form-control">
                <option value="">Choose Option...</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            @error('gender')
            <small class="text-danger">{{ $message }}</small>    
            @enderror
        </div>
        <div class="form-group">
            <label>Address</label>
            <input class="au-input au-input--full" type="text" name="address" value="{{ old('address') }}" placeholder="Address">
            @error('address')
            <small class="text-danger">{{ $message }}</small>    
            @enderror
        </div>
        
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            @error('password')
            <small class="text-danger">{{ $message }}</small>    
            @enderror
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
            <small class="text-danger">{{ $message }}</small>    
            @enderror
        </div>
        
        <div class="form-group">
            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
        </div>
        
    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{ route('auth#loginPage') }}">Sign In</a>
        </p>
    </div>
</div>  
@endsection