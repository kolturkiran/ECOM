@extends('master')
@section("content")
<div class="custom-product">
     <div class="col-sm-10">
     <table class="table">
  
  <tbody>
    <tr>   
      <td>Amount</td>
      <td>₹{{$total}}</td>
    </tr>
    <tr>    
      <td>Tax</td>
      <td>₹ 0</td>
    </tr>
    <tr>      
      <td>Delivery</td>
      <td>₹ 10</td>
    </tr>
    <tr>      
      <td>Total Amount</td>
      <td>₹{{$total + 10}}</td>
    </tr>
  </tbody>
</table>
<div>
    <form action="/orderplace" method="POST">
    <div class="form-group">
        <textarea placeholder="enter your address" class="form-control"></textarea>        
    </div>
    <div class="form-group">
        <label for="pwd">Payment Method</label><br>
        <input type="radio" name="payment"><span>online payment</span><br>
        <input type="radio" name="payment"><span>EMI payment</span><br>
        <input type="radio" name="payment"><span>Payment on Delivery</span><br>
    </div>    
    <button type="submit" class="btn btn-info">Order Now</button>
    </form> 
</div>

     </div>
</div>
@endsection 