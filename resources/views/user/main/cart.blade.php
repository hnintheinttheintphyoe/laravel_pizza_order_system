@extends('user.layouts.master')
@section('content')
<!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0 " id="dataTable">
                    <thead class="thead-dark">
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c)
                        <tr>
                            {{-- <input type="hidden" value="{{ $c->pizza_price }}" id="price"> --}}
                            <td class="align-middle"><img src="{{ asset('storage/'.$c->pizza_image) }}" alt="" style="width: 100px;"></td>
                            <td class="align-middle"> {{ $c->pizza_name }}
                            <input type="hidden" class="cartId" value="{{ $c->id }}">    
                            <input type="hidden" class="productId" value="{{ $c->product_id }}">
                            <input type="hidden" class="userId" value="{{ $c->user_id }}">
                            </td>
                            <td class="align-middle " id="price">{{ $c->pizza_price }} Kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" id="minus-btn" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center " value="{{ $c->qty }}"  id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus " >
                                            <i class="fa fa-plus" ></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle total col-3">{{ $c->pizza_price*$c->qty }} Kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                        </tr>  
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="summaryPrice">{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice" >{{ $totalPrice+3000 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 clearBtn">Cart Clear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('scriptSource')
  <script src="{{ asset('js/cart.js') }}"></script>  
  <script>
    $(document).ready(function(){
        $('.orderBtn').click(function(){
           $orderList=[];
           $random=Math.floor((Math.random() * 1000001));
           $('#dataTable tbody tr').each(function(index,row){
           
            $orderList.push(
                {
                'userId':$(row).find('.userId').val(),
                'productId':$(row).find('.productId').val(),
                 'total':$(row).find('.total').text().replace('Kyats',''),
                'qty':$(row).find('#qty').val(),
                'orderCode':'POS'+$random
            }
            );
            
           })
        //    console.log(Object.assign({}, $orderList));
           $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/order',
            data:Object.assign({}, $orderList),
            dataType:'json',
            success:function(response) {
            //   console.log(response.message);  
            if(response.status == 'true'){
              window.location.href='http://127.0.0.1:8000/user/home';  
            }
               
            }

        })
        })
        $('.clearBtn').click(function(){
            $('#dataTable tbody tr').remove();
            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/user/ajax/order',
                dataType:'json'
            });
            $('#summaryPrice').html('kyats');
            $('#finalPrice').html('3000kyats');
        })
        $('.btnRemove').click(function(){
            $parentNode=$(this).parents('tr');
           $parentNode.remove();
           $summaryPrice=0;
        $('#dataTable tbody tr').each(function(index,row){
        $summaryPrice+=Number($(row).find('.total').text().replace('Kyats',""));  
        $('#summaryPrice').html(`${$summaryPrice} Kyats`);
        $('#finalPrice').html(`${$summaryPrice+3000} Kyats`);
        })
        $cartId=$parentNode.find('.cartId').val();
        $userId=$parentNode.find('.userId').val();
        $productId=$parentNode.find('.productId').val();
        $.ajax({
          type:'get',
          url:'http://127.0.0.1:8000/user/ajax/delete',
          data:{'cartId':$cartId,
                'userId':$userId,
                'productId':$productId
               },
          dataType:'json'
        });
    })
    })
  </script>
@endsection