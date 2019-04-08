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
                <select class="form-control" id="PurchasereportProjectId" name="project_id">
                  <option value="">Select Project Name</option>
                  <option value="all">All</option>
                  @foreach($projects as $project)
                    <option value="{{!empty($project['id'])?$project['id']:''}}">{{!empty($project['name'])?$project['name']:''}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <input type="text" name="seller_name" id="seller_name" placeholder="Seller Name" class="form-control">
              </div>
              <div class="col-md-3">
                <select name="year" class="form-control" id="year">
                  <option value="">Select Year</option>
                  <option value="">All</option>
                  <option value="">2019</option>
                  <option value="">2020</option>
                  <option value="">2021</option>
                  <option value="">2022</option>
                  <option value="">2023</option>
                  <option value="">2024</option>
                  <option value="">2025</option>
                  <option value="">2026</option>
                  <option value="">2027</option>
                  <option value="">2028</option>
                  <option value="">2029</option>
                  <option value="">2030</option>
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
          <div id="chartContainer" style="height: 370px; width: 100%;">
            <?php
            for($i =0; $i<12; $i++)
            {
              $date = date("F Y");
              
                $effectiveDate = date("F Y", strtotime("+".$i." months", strtotime($date)));
             
                $dataPoints[] = array("y" => 25+$i, "label" => $effectiveDate);
            }
            
              ?>
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
      text: "Purchases"
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