@extends('admin.layout.master')
@section('title','Category List Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    
                </div>
                @if(session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('deleteSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                <a href="{{ route('admin#orderList') }}" class="fs-5 text-black">
                    <i class="fa-solid fa-arrow-left pb-0"></i>
                    <span>back</span>
                </a>
                <div class="row col-4">
                    <div class="card shadow-sm">
                        
                        <div class="card-body">
                            <h3 class="card-title">
                                <i class="fa-regular fa-clipboard me-2 fs-4"></i>Order Info 
                            </h3>
                            <small class="text-warning"><i class="fa-solid fa-triangle-exclamation"></i>Include Delivery Charges</small>
                            <div class="row">
                             <div class="col"><i class="me-1 fa-solid fa-user"></i>User Name</div>
                             <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                            </div>
                            <div class="row">
                                <div class="col"><i class="me-1 fa-regular fa-clock"></i>Order Date</div>
                                <div class="col">{{ $orderList[0]->created_at->format('j-F-Y') }}</div>
                               </div>
                               <div class="row">
                                <div class="col"><i class="me-1 fa-solid fa-barcode"></i>Order Code</div>
                                <div class="col">{{ $orderList[0]->order_code }}</div>
                               </div>
                               <div class="row">
                                <div class="col"><i class="me-1 fa-solid fa-money-bill-1-wave"></i>Total Price</div>
                                <div class="col">{{ $order->total_price }} Kyats</div>
                               </div>
                        </div>
                    </div>
                </div>
               <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th> ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Create Date</th>
                                <th>Amount</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody class="dataList">
                         @foreach ($orderList as $o)
                         <tr>
                            <td class="col-2 align-middle">{{ $o->id }}</td>
                            <td class="col-1"><img src="{{ asset('storage/'.$o->product_image) }}" class="img-thumbnail shadow-sm" alt=""></td>
                            <td class="col-2">{{ $o->product_name }}</td>
                            <td class="col-2">{{ $o->created_at->format('j-F-Y') }}</td>
                            <td class="col-2">{{ $o->total }}</td>
                            <td class="col-2">{{ $o->qty }}</td>
                         </tr>
                             
                         @endforeach  
                        </tbody>

                        
                    </table>
                    <div class="mt-2">
                        {{-- {{ $orderList->links() }} --}}
                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>
                </div>
               
                <!-- END DATA TABLE -->
                
            </div>
        </div>
    </div>
</div>
    
@endsection
