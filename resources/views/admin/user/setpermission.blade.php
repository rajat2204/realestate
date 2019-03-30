<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Assign Form Rights</h1>
			</div>
		</div>
		<div class="box-body">
			<form role="permissions" method="POST" action="{!! action('Admin\UserController@store') !!}">
        {{csrf_field()}}
			<table class="table table-bordered table-stripped">
				<thead>
					<th><input type="checkbox" name =""></th>
					<th>S.No.</th>
					<th>Module Name</th>
					<th>Page Name</th>
				</thead>
				
				<tbody>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>1</td>
						<td>Agent</td>
						<td>Agents</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>2</td>
						<td>Client</td>
						<td>Clients</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>3</td>
						<td>Configuration</td>
						<td>Configurations</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>4</td>
						<td>Configuration</td>
						<td>Tax</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>5</td>
						<td>Configuration</td>
						<td>General</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>6</td>
						<td>Configuration</td>
						<td>Currency</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>7</td>
						<td>Configuration</td>
						<td>Units</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>8</td>
						<td>Configuration</td>
						<td>Extra Payments</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>9</td>
						<td>Configuration</td>
						<td>Organisation Logo</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>10</td>
						<td>Dashboard</td>
						<td>Dashboard</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>11</td>
						<td>Deals</td>
						<td>Plan Payment</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>12</td>
						<td>Deals</td>
						<td>Deals</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>13</td>
						<td>Deals</td>
						<td>Deals Payments</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>14</td>
						<td>Expense / Inventory</td>
						<td>Category</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>15</td>
						<td>Expense / Inventory</td>
						<td>Expense / Inventory</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>16</td>
						<td>Expense / Inventory</td>
						<td>Expenses</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>17</td>
						<td>Expense / Inventory</td>
						<td>Expenses Payments</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>18</td>
						<td>Expense / Inventory</td>
						<td>Inventory</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>19</td>
						<td>Expense / Inventory</td>
						<td>Inventories Entry</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>20</td>
						<td>Expense Report</td>
						<td>Expense Report</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>21</td>
						<td>Help</td>
						<td>Help</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>22</td>
						<td>Invoices</td>
						<td>Invoices</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>23</td>
						<td>Invoices</td>
						<td>Balance Invoices</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>24</td>
						<td>Invoices</td>
						<td>Paid Invoices</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>25</td>
						<td>Leads</td>
						<td>Leads</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>26</td>
						<td>Plans</td>
						<td>Plans</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>27</td>
						<td>Profit Report</td>
						<td>Profit Report</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>28</td>
						<td>Projects</td>
						<td>Projects</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>29</td>
						<td>Properties</td>
						<td>Properties</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>30</td>
						<td>Properties</td>
						<td>My Flats/Plots</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>31</td>
						<td>Properties</td>
						<td>Property Photo</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>32</td>
						<td>Properties</td>
						<td>Property Document</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>33</td>
						<td>Purchase</td>
						<td>Purchase</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>34</td>
						<td>Purchase</td>
						<td>Purchase Payment</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>35</td>
						<td>Purchase Report</td>
						<td>Purchase Report</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>36</td>
						<td>Reports</td>
						<td>Reports</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>37</td>
						<td>Sales Report</td>
						<td>Sales Report</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>38</td>
						<td>Users</td>
						<td>Users</td>										
					</tr>
					<tr>
						<td><input type="checkbox" name =""></td>
						<td>39</td>
						<td>Vendor / Staff</td>
						<td>Vendor / Staff</td>										
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="box-footer">
    <a href="{{url('admin/users')}}" class="btn btn-default">Cancel</a>
    <button type="button" data-request="ajax-submit" data-target='[role="permissions"]' class="btn btn-info pull-right">Submit</button>
  </div>
		</form>
</div>