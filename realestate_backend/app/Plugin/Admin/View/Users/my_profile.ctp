<div class="row">
    <div class="col-md-12">    
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title">My <span>Profile</span></h4>
			</div>
		</div>
            <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td><strong class="text-danger"><small>Username</small></strong></td>
                        <td><strong><small><?php echo $post['User']['username'];?></small></strong></td>
                    </tr>
                    <tr>
                        <td><strong class="text-danger"><small>Name</small></strong></td>
                        <td><strong><small><?php echo $post['User']['name'];?></small></strong></td>
                    </tr>
                    <tr>
                        <td><strong class="text-danger"><small>Email</small></strong></td>
                        <td><strong><small><?php echo $post['User']['email'];?></small></strong></td>
                    </tr>
                    <tr>
                        <td><strong class="text-danger"><small>Mobile</small></strong></td>
                        <td><strong><small><?php echo $post['User']['mobile'];?></small></strong></td>
                    </tr>
                </table>                
            </div>
            </div>
        </div>
    </div>
</div>