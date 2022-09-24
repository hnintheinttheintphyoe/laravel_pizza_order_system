{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>User Home Page</h1>
    <p>{{ Auth::user()->role }}</p>
    <form action="{{ route('logout') }}" method="post">
        @csrf
    <input type="submit" value="Logout">
    </form>
</body>
</html> --}}
@extends('user.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark px-3 py-1 text-white">
                        
                        <label class="mt-2" for="price-all">Categories</label>
                        <span class="badge border font-weight-normal">{{ count($category) }}</span>
                    </div>
                    <a href="{{ route('user#home') }}" class="text-black"><label class="" for="price-1 ">All</label></a>
                    @foreach($category as $c)
                    <div class=" d-flex align-items-center justify-content-between mb-3 mt-2">
                        
                        <a href="{{ route('user#filter',$c->id) }}" class="text-black"><label class="" for="price-1 ">{{ $c->name }}</label></a>
                        {{-- <span class="badge border font-weight-normal">150</span> --}}
                    </div>
                    @endforeach

                   
                </form>
            </div>
            <!-- Price End -->
            
           
            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a href="{{ route('cart#list') }}">
                            <button type="button" class="btn btn-dark position-relative">
                               
                                <i class="fa-solid fa-cart-plus fs-5 mt-1"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                  {{ count($cart) }}
                                  <span class="visually-hidden">unread messages</span>
                                </span>
                              </button>
                            </a>
                            <a href="{{ route('user#history') }}">
                                <button type="button" class="btn btn-dark position-relative ms-2">
                                   
                                    <i class="fa-solid fa-clock-rotate-left mt-1 fs-5"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{ count($order) }}
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                  </button>
                                </a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                
                                
                                   <select name="" id="sortingOption" class="form-control">
                                    <option value="">Choose Option</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                   </select>
                                    
                               
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="row" id="myForm">
                   @if(count($pizza) != null)
                   @foreach ($pizza as $p)
                   <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image) }}" alt="" style="height: 250px">
                             <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#details',$p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                               
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{ $p->price }} kyats</h5>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>   
                   @endforeach
                   @else
                   <p class="col-6 offset-3  text-center fs-1 shadow-sm my-4 p-5">There is no pizza<i class="fa-solid fa-pizza-slice ms-3"></i></p>
                   @endif
                </div>
                  
               
               
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>  
@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
        // $.ajax({
        //     type:'get',
        //     url:'http://127.0.0.1:8000/user/ajax/pizzaList',
        //     dataType:'json',
        //     success:function(response) {
        //         console.log(response);
        //     }

        // })
        $('#sortingOption').change(function(){
            $optionValue=$('#sortingOption').val();
            if($optionValue == 'asc'){
      $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/pizzaList',
            data:{'status':'asc'},
            dataType:'json',
            success:function(response) {
                // console.log(response);
                $list='';
                for($i=0;$i<response.length;$i++){
                   $list+=`
                   <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                     <div class="product-item bg-light mb-4">
                         <div class="product-img position-relative overflow-hidden">
                             <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="" style="height: 250px">
                              <div class="product-action">
                                 <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                 <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                
                             </div>
                         </div>
                         <div class="text-center py-4">
                             <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name} </a>
                             <div class="d-flex align-items-center justify-content-center mt-2">
                                 <h5> ${response[$i].price} kyats</h5>
                                 
                             </div>
                             
                         </div>
                     </div>
                 </div>
                   `;  
                }
                $('#myForm').html($list);
            }

        })
            }
            else if($optionValue == 'desc'){
                $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/pizzaList',
            data:{'status':'desc'},
            dataType:'json',
            success:function(response) {
                $list='';
                for($i=0;$i<response.length;$i++){
                   $list+=`
                   <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                     <div class="product-item bg-light mb-4">
                         <div class="product-img position-relative overflow-hidden">
                             <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="" style="height: 250px">
                              <div class="product-action">
                                 <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                 <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                
                             </div>
                         </div>
                         <div class="text-center py-4">
                             <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name} </a>
                             <div class="d-flex align-items-center justify-content-center mt-2">
                                 <h5> ${response[$i].name} kyats</h5>
                                 
                             </div>
                             
                         </div>
                     </div>
                 </div>
                   `;  
                }
                $('#myForm').html($list);
            }

        })
            }
        })
    })
</script>
@endsection