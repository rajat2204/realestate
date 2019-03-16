<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Payment Plan</h3>
    </div>
    <div class="panel-body">
      <form action="{{url('admin/deals/makeplan/'.___encrypt($deal['id']))}}" class="form-horizontal" method="POST" role="make-payment-plan">
        {{csrf_field()}}
        <input type="hidden" name="balance" value="{{!empty($deal['balance'])?$deal['balance']:''}}">

        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Name:</small></label>
          <div class="col-sm-6">
             <input name="name[]" value="Booking Amount" class="form-control" type="text" >           
          </div>
        </div>
        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Amount:</small></label>
          <div class="col-sm-6">
             <input name="amount[]" class="form-control amount" placeholder="Enter Amount">            
           </div>
        </div>
        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Due Date:</small></label>
          <div class="col-sm-6">
            <div>                        
              <input name="date[]" class="form-control date" type="date">
            </div>
          </div>
        </div>
        <br><br><br>

        @for($i = 1; $i <= $installment-1; $i++)
        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Name:</small></label>
          <div class="col-sm-6">
             <input name="name[]" value="{{$i}} Installment" class="form-control" type="text">            
           </div>
        </div>
        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Amount:</small></label>
          <div class="col-sm-6">
             <input name="amount[]" class="form-control amount" placeholder="Enter Amount" type="">            
           </div>
        </div>
        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Due Date:</small></label>
          <div class="col-sm-6">
            <div>                        
              <input name="date[]" class="form-control date" type="date">
            </div>
          </div>
        </div>
           <br><br><br>
        @endfor

        <div class="box-footer">
          <a href="{{url('admin/deals')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" id="valid-submit" data-target='[role="make-payment-plan"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
<script type="text/javascript">
  /*$('#valid-submit').click(function(){
   var amount = $('.amount').val();
   var date = $('.date').val();
   alert(amount);
   if(amount.length <= 0)
   {
    alert('Please enter Payment.');
    return false;
   }
   alert(intRegex.test(amount));
   else if(intRegex.test(amount) || floatRegex.test(amount)) {
       alert('Please enter Payment in digits.');
      return false;
    }
   
  });*/
</script>
@endsection