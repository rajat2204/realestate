<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Payment Plan</h3>
    </div>
    <div class="panel-body">
      <form action="{{url('admin/deals/makeplan/'.___encrypt($deal['id']))}}" class="form-horizontal" method="POST" role="make-payment-plan">
        {{csrf_field()}}
        <input type="hidden" name="balance" value="{{!empty($deal['balance'])?$deal['balance']:''}}">
        <input type="hidden" name="client_id" value="{{!empty($deal['client_id'])?$deal['client_id']:''}}">
        <input type="hidden" name="property_id" value="{{!empty($deal['property_id'])?$deal['property_id']:''}}">
        <input type="hidden" name="invoice_no" value="{{!empty($deal['invoice_no'])?$deal['invoice_no']:''}}">
        
        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Name:</small></label>
          <div class="col-sm-6">
             <input name="deal[0][name]" value="Booking Amount" class="form-control" type="text" readonly>      
          </div>
        </div>
        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Amount:</small></label>
          <div class="col-sm-6">
             <input name="deal[0][amount]" class="form-control amount" placeholder="Enter Amount" required>            
           </div>
        </div>
        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Due Date:</small></label>
          <div class="col-sm-6">
            <div>                        
              <input name="deal[0][date]" class="form-control date" type="date" required>
            </div>
          </div>
        </div>
        <br><br><br>

        @for($i = 1; $i <= $installment-1; $i++)
        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Name:</small></label>
          <div class="col-sm-6">
             <input name="deal[{{$i}}][name]" value="{{$i}} Installment" class="form-control" type="text" readonly>            
           </div>
        </div>
        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Amount:</small></label>
          <div class="col-sm-6">
             <input name="deal[{{$i}}][amount]" class="form-control amount" placeholder="Enter Amount" type="" required>            
           </div>
        </div>
        <div class="form-group">
          <label for="group_name" class="col-sm-3 control-label"><small>Due Date:</small></label>
          <div class="col-sm-6">
            <div>                        
              <input name="deal[{{$i}}][date]" class="form-control date" type="date" required>
            </div>
          </div>
        </div>
           <br><br><br>
        @endfor
        
        <div class="box-footer">
          <a href="{{url('admin/deals')}}" class="btn btn-default">Cancel</a>
          <button type="button" id="valid-submit" data-request="ajax-submit" data-target='[role="make-payment-plan"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>