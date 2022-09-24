$(document).ready(function(){
    $('.btn-plus').click(function(){
      
        $parentNode=$(this).parents('tr');
        $price=$parentNode.find('#price').text().replace('Kyats',"");
        
        $qty=$parentNode.find('#qty').val();
        $totalPrice=$price*$qty;
        $parentNode.find('.total').html($totalPrice+'Kyats');
       summaryCalculation();
        
        
    });
    $('.btn-minus').click(function(){
        $parentNode=$(this).parents('tr');
        $price=$parentNode.find('#price').text().replace('Kyats',"");
        $qty=$parentNode.find('#qty').val();
        $totalPrice=$price*$qty;
        
        $parentNode.find('.total').html($totalPrice+'Kyats');
        summaryCalculation();
    })
    
    function summaryCalculation(){
        $summaryPrice=0;
        $('#dataTable tbody tr').each(function(index,row){
        $summaryPrice+=Number($(row).find('.total').text().replace('Kyats',""));  
        $('#summaryPrice').html(`${$summaryPrice} Kyats`);
        $('#finalPrice').html(`${$summaryPrice+3000} Kyats`);
        })
    }
})