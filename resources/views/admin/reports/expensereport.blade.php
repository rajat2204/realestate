<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default m-t-20">
          <div class="box-header with-border">
            <h3 class="box-title">Expenses Report</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                @php
                  if(!empty($purchase_month)){
                    foreach ($purchase_month as $value) {
                      $my=0;
                      
                      $month_sum[]=$my+= $value['amount'];
                    }
                  }else{
                    $month_sum[]=0;
                  }
                  if(!empty($purchase_year)){
                  foreach ($purchase_year as $value1) {
                    $time=strtotime($value1['created_at']);
                    $month=date("F",$time);
                    $years=date("Y",$time);
                    /*$dateObj   = DateTime::createFromFormat('!m', $month);
                    $monthName = $dateObj->format('F');*/
                    $dataPoints[]=array("y" => $value1['amount'], "label" =>$month.' '.$years);
                    $my1=0;
                    $total_sum[]=$my1+= $value1['amount'];
                  }
                }else{
                  $total_sum[]=0;
                  $dataPoints[]=array();
                }

                
                @endphp
                <div class="classFloat centerContent"><button class="btn btn-primary" type="button">Total Expense Count this month <span class="badge">{{count($purchase_month)}}</span>
                <br><br>Total Expense this month <span class="badge"><i class="fa fa-rupee"></i>{{array_sum($month_sum)}}</span></button></div>
              </div>
              <div class="col-md-6">
                <div class="centerContent"><button class="btn btn-primary" type="button">Total Expense Count <span class="badge">{{count($purchase_year)}}</span>
                <br><br>Total Expense <span class="badge"><i class="fa fa-rupee"></i>{{array_sum($total_sum)}}</span></button></div>
              </div>
            </div>
            <form method="get" action="{{url('admin/expensereport')}}">
            <div class="row m-t-20">
              <div class="col-md-3">
                <select class="form-control" id="PurchasereportProjectId" name="project_name">
                  <option value="">Select Project Name</option>
                  <option value="">All</option>
                  @foreach($projects as $project)
                    <option value="{{!empty($project['id'])?$project['id']:''}}" @if($project_name==$project['id']) selected @endif>{{!empty($project['name'])?$project['name']:''}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                  <select class="form-control" id="PurchasereportProjectId" name="vendor_id">
                  <option value="">Select Staff/vendor Name</option>
                  <option value="">All</option>
                  @foreach($vendor as $vendors)
                    <option value="{{!empty($vendors['id'])?$vendors['id']:''}}" @if($vendor_id==$vendors['id']) selected @endif>{{!empty($vendors['name'])?$vendors['name']:''}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                  <select class="form-control" id="PurchasereportProjectId" name="expens_cat_id">
                  <option value="">Expense Category</option>
                  <option value="">All</option>
                  @foreach($expenseCat as $Expenses)
                    <option value="{{!empty($Expenses['id'])?$Expenses['id']:''}}" @if($expens_cat_id==$Expenses['id']) selected @endif>{{!empty($Expenses['name'])?$Expenses['name']:''}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <select name="year" class="form-control" id="year">
                  <option value="">Select Year</option>s
                  <option value="">All</option>
                  <option value="2019" @if($year=='2019') selected @endif>2019</option>
                  <option value="2020" @if($year=='2020') selected @endif>2020</option>
                  <option value="2021" @if($year=='2021') selected @endif>2021</option>
                  <option value="2022" @if($year=='2022') selected @endif>2022</option>
                  <option value="2023" @if($year=='2023') selected @endif>2023</option>
                  <option value="2024" @if($year=='2024') selected @endif>2024</option>
                  <option value="2025" @if($year=='2025') selected @endif>2025</option>
                  <option value="2026" @if($year=='2026') selected @endif>2026</option>
                  <option value="2027" @if($year=='2027') selected @endif>2027</option>
                  <option value="2028" @if($year=='2028') selected @endif>2028</option>
                  <option value="2029" @if($year=='2029') selected @endif>2029</option>
                  <option value="2030" @if($year=='2030') selected @endif>2030</option>
                </select>
              </div>
            </div>
            <div class="row m-t-20">
              <label for="group_name" class="col-sm-1 col-sm-offset-1 control-label"><strong>Date</strong></label>
               <div class="col-md-2">
                <div class="input-group date" id="start_date">                        
                  <input name="start_from" value="{{!empty($date_from)?$date_from:''}}" class="form-control" type="date" id="PurchasereportStartDate">                
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
              </div>
              <div class="col-md-2">
                <div class="input-group date" id="end_date" data-date-format="YYYY-MM-DD">
                  <input name="start_to" value="{{!empty($date_to)?$date_to:''}}" id="end_date" class="form-control" type="date">   
                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-success btn-sm"><span class="fa fa-search"></span> Search</button>
                <a href="{{url('admin/expensereport')}}" class="btn btn-warning btn-sm"><span class="fa fa-refresh"></span>&nbsp;Reset</a>        
              </div>
          </div>
        </form>
            <div id="chartContainer" style="height: 370px; width: 100%;">
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@section('requirejs')
<script type="text/javascript">
  window.onload = function () {
  var chart = new CanvasJS.Chart("chartContainer", {
    title: {
      text: "Expenses "
    },
    axisY: {
      title: "Total Cost"
    },
    data: [{
      type: "line",
      dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
  });
  chart.render();
   
  }
  
</script>
@endsection