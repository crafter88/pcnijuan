<input id='mc_id' type="hidden" name="mc_id" value="<?php echo $user->main_company->cb_id; ?>">
<input id='bc_id' type="hidden" name="bc_id" value="<?php echo $user->cb_id; ?>">
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
                    		<li><span id='show-filters' class='disable-setting' class='disable-setting' data-status='0'>Show Filters</span></li>
                    		<li><span id='advance-search' data-status='0'>Advance Search</span></li>
                    		<li class="divider"></li>
                    		<li><span id='show-all-col' class='disable-setting' data-status='0'>Show All Columns</span></li>
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
						<table id='discounts-table' class='table table-hovered table-bordered' style='min-width: 100%'>
							<thead>
								<tr>
									<th></th>
									<th>Code</th>
									<th>Name</th>
									<th>Short Name</th>
									<th>Rate</th>
								</tr>
								<tr id="searchfilterrow" class='hide-searchfilter searchfilterrow'>
									<th></th>
									<th>Code</th>
									<th>Name</th>
									<th>Short Name</th>
									<th>Rate</th>
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
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">Add Discount</h4>
	</div>
	<form action='<?php echo base_url(); ?>company_settings/discounts/add' method='post' class='body'>
		<div class='modal-body'>
			<table width='90%'>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input name='add-name' class='form-control v-required' title="Please fill out this field" type='text'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Shortname</label></td>
					<td colspan='3' style='padding-top: 5px;'><input name='add-shortname' class='form-control' type='text'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Rate</label></td>
					<td colspan='3' style='padding-top: 5px;'><input name='add-rate' class='form-control v-required v-decimal' title="Please fill out this field" type='text'></td>
				</tr>
			</table>
		</div>
		<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px;'>
			<button class='btn btn-info btn-sm btn-raised ripple-effect v-submit' type='button' style='float: right;'>Done</button>
		</div>
	</form>
</div>
<div id='view-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 9px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">View Discount</h4>
	</div>
	<div class='modal-body'>
		<table width='90%'>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Code</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-code' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Name</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-name' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Shortname</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-shortname' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Rate</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-rate' class='form-control' type='text' readonly></td>
			</tr>
		</table>
	</div>
	<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px; width: 497px;'>
		<button id='close-btn' class='btn btn-info btn-sm close-popover btn-raised ripple-effect' type='button' data-dismiss='modal' style='float: right;'>Close</button>
	</div>
</div>
<div id='edit-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 10px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">Edit Discount</h4>
	</div>
	<form action='<?php echo base_url(); ?>company_settings/discounts/edit' method='post' class='body'>
		<div class='modal-body'>
			<table width='90%'>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Code</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required v-number' title="Please fill out this field" type='text' name='edit-code'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required' title="Please fill out this field" type='text' name='edit-name'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Shortname</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control' type='text' name='edit-shortname'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Rate</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required v-decimal' title="Please fill out this field" type='text' name='edit-rate'></td>
				</tr>
			</table>
		</div>
		<input type='hidden' name='edit-id'>
		<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px;'>
			<button class='btn btn-info btn-sm btn-raised ripple-effect v-submit' type='button' style='float: right;'>Save Changes</button>
		</div>
	</form>
</div>
<div id='update-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 10px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">Update Discount</h4>
	</div>
	<form action='<?php echo base_url(); ?>company_settings/discounts/update' method='post' class='body'>
		<div class='modal-body'>
			<table width='90%'>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Code</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required v-number' title="Please fill out this field" type='text' name='update-code'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required' title="Please fill out this field" type='text' name='update-name'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Shortname</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control' type='text' name='update-shortname'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Rate</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required v-decimal' title="Please fill out this field" type='text' name='update-rate'></td>
				</tr>
			</table>
		</div>
		<input type="hidden" name="update-id">
		<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px;'>
			<button class='btn btn-info btn-sm btn-raised ripple-effect v-submit' type='button' style='float: right;'>Save Changes</button>
		</div>
	</form>
</div>