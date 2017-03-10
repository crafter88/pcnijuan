<div id='m_c_d' class='appear'>
    <div class='n_cp_n_cm' class='container' style="margin: 0;">
    	<div class="box">
            <div class="box-header with-border box-normal">
                <h3 class="box-title"> </h3>
                <div class="box-tools pull-right">
                	<div class="btn-group">
                  		<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    		<i class="fa fa-wrench"></i> Settings
                    	</button>
                  		<ul class="dropdown-menu" role="menu">
                    		<li><span id='show-filters' data-status='0'>Show Filters</span></li>
                    		<li><span id='advance-search' data-status='0'>Advance Search</span></li>
                    		<li class="divider"></li>
                    		<li><span id='show-all-col' data-status='0'>Show All Columns</span></li>
                  		</ul>
                	</div>
              	</div>
            </div>
    		<div class='box-body hide-table-setting'>
    			<div class='row'>
    				<div class='col-md-12' id='company-table-row' style="padding-right: 20px;">
    					<div class='row hide-filter'>
    						<div class='col-md-12' style="margin: 0;">
    							<h3 class='filter-title'>FILTERS</h3>
    						</div>
    					</div>
    					<div class='row hide-filter'>
							<div class='col-md-6'>
								<div class="input-group">
								  <span class="input-group-addon filter-subtitle">Access Level</span>
								  <select id='filter1' class='form-control' placeholder='--- SELECT ---'></select>
								</div>
							</div>
    					</div>
    					<div class='row'>
    						<div class='col-md-1' style="margin-bottom: 10px;">
    							<button id='add' type='button' class='btn btn-info btn-sm btn-raised ripple-effect title' custom-title='Add New' <?php if($user->main_company->cb_id !== $user->cb_id){ echo 'disabled'; } ?> style='height: 34px; margin: 0;'><i class='fa fa-plus'></i> Add New</button>
    						</div>
    						<div class='col-md-11' style="margin-bottom: 10px;">
    							<div class="input-group table-search">
								  <span class="input-group-addon" id="basic-addon1"><i class='fa fa-search'></i></span>
								  <input type="text" class="form-control general-search" placeholder="General Search..." aria-describedby="basic-addon1">
								</div>
    						</div>
    					</div>
						<table id='users-table' class='table table-hovered table-bordered' style='width: 100%;'>
							<thead>
								<tr>
									<th></th>
									<th>Sequence</th>
									<th>Name</th>
									<th>Home Address</th>
									<th>Contact Number</th>
									<th>Email Address</th>
									<th>Username</th>
									<th>Access Level</th>
								</tr>
								<tr id="searchfilterrow" class='hide-searchfilter searchfilterrow'>
									<th></th>
									<th>Sequence</th>
									<th>Name</th>
									<th>Home Address</th>
									<th>Contact Number</th>
									<th>Email Address</th>
									<th>Username</th>
									<th>Access Level</th>
								</tr>
								
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id='add-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 10px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">Add User</h4>
	</div>
	<form action="<?php echo base_url(); ?>docpro_settings/users/add" method='post' class='body'>
		<div class='modal-body'>
			<table style="width: 90%; margin-left: 20px;">
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>First Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required' type='text' name='add-fname'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Middle Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required' type='text' name='add-mname'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Last Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required' type='text' name='add-lname'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Address</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required' type='text' name='add-address'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Mobile Number</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control number v-number v-format' f='^[0-9]{11}$' title='Mobile number format: 09xxxxxxxxx' type='text' name='add-cno'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Email</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-format' f='@{1}' title="Email address requires '@'" type='email' name='add-email'></td>
				</tr>
			</table>
			<div style="border-top: 1px solid #C1C1C1; margin-top: 15px; background-color: #F1F1F1; padding-bottom: 10px;">
				<table style="width: 90%; margin-left: 20px;">
					<tr>
						<td style='padding-top: 10px; width: 150px; text-align: right; padding-right: 20px;'><label>Username</label></td>
						<td colspan='3' style='padding-top: 10px;'>
						<span id='add-username-notif' style='font-size: 10px; color: red; display: none;'><i class='fa fa-warning'></i>&nbsp; Username already taken!</span>
						<input class='form-control add-username v-required v-format v-unique' u='/docpro_settings/users/check_username' f="^\S{6,}$" title='Minimum of 6 characters and must be unique' o_title='Minimum of 6 characters and must be unique' type='text' name='add-username'>
						</td>
					</tr>
					<tr>
						<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Password</label></td>
						<td colspan='3' style='padding-top: 5px;'><input class='form-control add-password1 v-required' title="Please fill out this field" type='password' name='add-password'></td>
					</tr>
					<tr>
						<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Re-Type Password</label></td>
						<td colspan='3' style='padding-top: 5px;'>
						<span id='add-password-match' style='color: red; font-size: 10px; display: none;'><i class='fa fa-warning'></i>&nbsp; Password doesn't match!</span>
						<input class='form-control add-password2 v-required' title="Please fill out this field" type='password' name='add-r-password'>
						</td>
					</tr>
					<tr>
						<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Access Level</label></td>
						<td colspan='3' style='padding-top: 5px;'>
							<select class='v-select-required' id='add-user-type' name='add-user-type' placeholder='Select...'>
								<option value='Super Admin'>Super Admin</option>
								<option value='Admin'>Admin</option>
								<option value='User'>User</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px;'>
			<button id='add-submit' class='btn btn-info btn-sm btn-raised ripple-effect v-submit' type='button' style='float: right;'>Done</button>
		</div>
	</form>
</div>
<div id='view-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 9px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">View User</h4>
	</div>
	<div class='modal-body'>
		<table width='90%'>
			<tr>
				<td style='padding-top: 10px; width: 150px; text-align: right; padding-right: 20px;'><label>Sequence</label></td>
				<td colspan='3' style='padding-top: 10px;'><input name='view-seq' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>First Name</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-fname' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Middle Name</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-mname' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Last Name</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-lname' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Address</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-address' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Contact Number</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-cno' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Email</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-email' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Username</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-username' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Access Level</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-user-type' class='form-control' type='text' placeholder='Select...' readonly>
				</td>
			</tr>
		</table>
	</div>
	<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px; width: 100%;'>
		<button id='close-btn' class='btn btn-info btn-sm close-popover btn-raised ripple-effect' type='button' data-dismiss='modal' style='float: right;'>Close</button>
	</div>
</div>
<div id='edit-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 10px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">Edit User</h4>
	</div>
	<form action="<?php echo base_url(); ?>docpro_settings/users/edit" method='post' class='body'>
		<div class='modal-body'>
			<table style="width: 90%; margin-left: 20px;">
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Sequence</label></td>
					<td style='padding-top: 5px;'><input class='form-control no-space' type='text' name='edit-seq' disabled></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>First Name</label></td>
					<td style='padding-top: 5px;'><input class='form-control v-required' title='Please fill out this field' type='text' type='text' name='edit-fname'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Middle Name</label></td>
					<td style='padding-top: 5px;'><input class='form-control v-required' title='Please fill out this field' type='text' type='text' name='edit-mname'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Last Name</label></td>
					<td style='padding-top: 5px;'><input class='form-control v-required' title='Please fill out this field' type='text' type='text' name='edit-lname'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Address</label></td>
					<td style='padding-top: 5px;'><input class='form-control v-required' title='Please fill out this field' type='text' type='text' name='edit-address'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Contact Number</label></td>
					<td style='padding-top: 5px;'><input class='form-control v-number v-format' f='^[0-9]{11}$' title='Mobile number format: 09xxxxxxxxx' type='text' name='edit-cno'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Email</label></td>
					<td style='padding-top: 5px;'><input class='form-control v-format' f='@{1}' title="Email address requires '@'" type='text' name='edit-email'></td>
				</tr>
			</table>
			<div style="border-top: 1px solid #C1C1C1; margin-top: 15px; background-color: #F1F1F1; padding-bottom: 10px;">
				<table style='width: 90%; margin-left: 20px;'>
					<tr>
						<td style='padding-top: 10px; width: 150px; text-align: right; padding-right: 20px;'><label>Username</label></td>
						<td style='padding-top: 10px;'>
						<span id='edit-username-notif' style='font-size: 10px; color: red; display: none;'><i class='fa fa-warning'></i>&nbsp; Username already taken!</span>
						<input class='form-control edit-username v-required v-format v-unique' u='/setup/setup2/check_username' f="^\S{6,}$" title='Minimum of 6 characters and must be unique' o_title='Minimum of 6 characters and must be unique' type='text' name='edit-uname'>
						</td>
					</tr>
					<tr>
						<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>New Password</label></td>
						<td style='padding-top: 5px;'><input class='form-control edit-password1' type='password' name='edit-npass'></td>
					</tr>
					<tr>
						<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Re-Type Password</label></td>
						<td style='padding-top: 5px;'>
						<span id='edit-password-match' style='color: red; font-size: 10px; display: none;'><i class='fa fa-warning'></i>&nbsp; Password doesn't match!</span>
						<input class='form-control edit-password2' type='password' name='edit-rpass'>
						</td>
					</tr>
					<tr>
						<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Access Level</label></td>
						<td colspan='3' style='padding-top: 5px;'>
							<select class='v-select-required' id='edit-user-type' name='edit-user-type' placeholder='Select...'>
								<option value='Super Admin'>Super Admin</option>
								<option value='Admin'>Admin</option>
								<option value='User'>User</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<input type='hidden' name='edit-id'>
		<input type='hidden' name='p-id'>
		<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px;'>
			<button id='edit-submit' class='btn btn-info btn-sm btn-raised ripple-effect v-submit' type='button' style='float: right;'>Save Changes</button>
		</div>
	</form>
</div>