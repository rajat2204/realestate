<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default m-t-20">
          <div class="box-header with-border">
            <h3 class="box-title">Purchase Report</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="classFloat centerContent"><button class="btn btn-primary" type="button">Total Purchase Count this month <span class="badge">3</span>
                <br><br>Total Purchase this month <span class="badge"><i class="fa fa-rupee"></i> 100,000</span></button></div>
              </div>
              <div class="col-md-6">
                <div class="centerContent"><button class="btn btn-primary" type="button">Total Purchase Count this month <span class="badge">3</span>
                <br><br>Total Purchase this month <span class="badge"><i class="fa fa-rupee"></i> 100,000</span></button></div>
              </div>
            </div>

            <div class="row m-t-20">
              <div class="col-md-3 col-sm-offset-1">
                <select name="" class="form-control" id="PurchasereportProjectId">
                  <option value="">All</option>
                  <option value="1">Project A</option>
                  <option value="2">Project B</option>
                  <option value="3">Project C</option>
                  <option value="4">Rajat</option>
                </select>
              </div>
              <div class="col-md-4">
                <select name="" class="form-control" id="PurchasereportProjectId">
                  <option value="">All</option>
                  <option value="1">Project A</option>
                  <option value="2">Project B</option>
                  <option value="3">Project C</option>
                  <option value="4">Rajat</option>
                </select>
              </div>
              <div class="col-md-3">
                <select name="" class="form-control" id="PurchasereportProjectId">
                  <option value="">All</option>
                  <option value="1">Project A</option>
                  <option value="2">Project B</option>
                  <option value="3">Project C</option>
                  <option value="4">Rajat</option>
                </select>
              </div>
            </div>
            <div class="row m-t-20">
              <label for="group_name" class="col-sm-1 col-sm-offset-1 control-label"><strong>Date</strong></label>
               <div class="col-md-2">
                <div class="input-group date" id="start_date">                        
                  <input name="" class="form-control" type="text" id="PurchasereportStartDate">                            
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
              </div>
              <div class="col-md-2">
                <div class="input-group date" id="end_date" data-date-format="YYYY-MM-DD">
                  <input name="" id="end_date" class="form-control" type="text">   
                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-success btn-sm"><span class="fa fa-search"></span> Search</button>
                <a href="" class="btn btn-warning btn-sm"><span class="fa fa-refresh"></span>&nbsp;Reset</a>        
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@section('requirejs')
<script type="text/javascript">

  
</script>
@endsection