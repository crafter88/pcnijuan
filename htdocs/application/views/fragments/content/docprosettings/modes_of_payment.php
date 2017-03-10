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
					<div class='col-md-12' id='modes-of-payment-table-row' style="padding-right: 28px;">
						<div class='row hide-filter'>
    						<div class='col-md-12' style="margin: 0;">
    							<h3 class='filter-title'>FILTERS</h3>
    						</div>
    					</div>
    					<div class='row hide-filter'>
							<div class='col-md-6'>
								<div class="input-group">
								  <span class="input-group-addon filter-subtitle">Type of Payment</span>
								  <select id='filter1' class='form-control' placeholder='--- SELECT ---'></select>
								</div>
							</div>
    					</div>
    					<div class='row'>
    						<div class='col-md-1' style="margin-bottom: 10px;">
    							<button id='add-mop' type='button' class='btn btn-info btn-sm btn-raised ripple-effect title' custom-title='Add New' <?php if($user->main_company->cb_id !== $user->cb_id){ echo 'disabled'; } ?> style='height: 34px; margin: 0;'><i class='fa fa-plus'></i> Add New</button>
    						</div>
    						<div class='col-md-11' style="margin-bottom: 10px;">
    							<div class="input-group table-search">
								  <span class="input-group-addon" id="basic-addon1"><i class='fa fa-search'></i></span>
								  <input type="text" class="form-control general-search" placeholder="General Search..." aria-describedby="basic-addon1">
								</div>
    						</div>
    					</div>
						<table id='modes-of-payment-table' class='table table-hovered table-bordered' style="width: 100%;">
							<thead>
								<tr>
									<th></th>
									<th>Sequence</th>
									<th>Code</th>
									<th>Name</th>
									<th>Shortname</th>
									<th>Type</th>
								</tr>
								<tr id="searchfilterrow" class='hide-searchfilter searchfilterrow'>
									<th></th>
									<th>Sequence</th>
									<th>Code</th>
									<th>Name</th>
									<th>Shortname</th>
									<th>Type</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id='mop-view-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 9px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">View Mode of Payment</h4>
	</div>
	<div class='modal-body'>
		<table width='90%'>
			<tr>
				<td style='padding-top: 5px; width: 110px; text-align: right; padding-right: 20px;'><label>Sequence</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='mop-view-seq' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 110px; text-align: right; padding-right: 20px;'><label>Code</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='mop-view-code' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; text-align: right; padding-right: 20px;'><label>Name</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='mop-view-name' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; text-align: right; padding-right: 20px;'><label>Shortname</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='mop-view-shortname' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; text-align: right; padding-right: 20px;'><label>Type</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='mop-view-type' class='form-control' type='text' placeholder='Select...' readonly></td>
			</tr>
		</table>
	</div>
	<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px; width: 100%;'>
		<button id='close-btn' class='btn btn-info btn-sm close-popover btn-raised ripple-effect' type='button' data-dismiss='modal' style='float: right;'>Close</button>
	</div>
</div>
<div id='mop-add-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 10px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">Add Mode of Payment</h4>
	</div>
	<form action='<?php echo base_url(); ?>docpro_settings/modes_of_payment/add' method='post' class='body'>
		<div class='modal-body'>
			<table width='90%'>
				<tr>
					<td style='padding-top: 5px; text-align: right; padding-right: 20px;'><label>Type</label></td>
					<td colspan='3' style='padding-top: 5px;'>
						<select class='v-select-required' title="Please fill out this field" id='mop-add-type' name='mop-add-type' placeholder='Select...'></select>
					</td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 100px; text-align: right; padding-right: 20px;'><label>Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required' title="Please fill out this field" type='text' name='mop-add-name'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; text-align: right; padding-right: 20px;'><label>Shortname</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control no-space' type='text' name='mop-add-shortname'></td>
				</tr>
			</table>
		</div>
		<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px;'>
			<button class='btn btn-info btn-sm btn-raised ripple-effect v-submit' type='button' style='float: right;'>Done</button>
		</div>
	</form>
</div>
<div id='mop-edit-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 10px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">Edit Mode of Payment</h4>
	</div>
	<form action='<?php echo base_url(); ?>docpro_settings/modes_of_payment/edit' method='post' class='body'>
		<div class='modal-body'>
			<table width='90%'>
				<tr>
					<td style='padding-top: 5px; width: 100px; text-align: right; padding-right: 20px;'><label>Sequence</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control no-space' type='text' name='mop-edit-seq' readonly></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 100px; text-align: right; padding-right: 20px;'><label>Code</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required' title="Please fill out this field" type='text' name='mop-edit-code'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; text-align: right; padding-right: 20px;'><label>Type</label></td>
					<td colspan='3' style='padding-top: 5px;'>
						<select class='v-select-required' title="Please fill out this field" id='mop-edit-type' name='mop-edit-type' placeholder='Select...'></select>
					</td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 100px; text-align: right; padding-right: 20px;'><label>Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required' title="Please fill out this field" type='text' name='mop-edit-name'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; text-align: right; padding-right: 20px;'><label>Shortname</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control' type='text' name='mop-edit-shortname'></td>
				</tr>
			</table>
		</div>
		<input type='hidden' name='mop-edit-id'>
		<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px;'>
			<button class='btn btn-info btn-sm btn-raised ripple-effect v-submit' type='button' style='float: right;'>Save Changes</button>
		</div>
	</form>
</div>
<div id='mop-update-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 10px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">Update Mode of Payment</h4>
	</div>
	<form action='<?php echo base_url(); ?>docpro_settings/modes_of_payment/update' method='post' class='body'>
		<div class='modal-body'>
			<table width='90%'>
				<tr>
					<td style='padding-top: 5px; width: 100px; text-align: right; padding-right: 20px;'><label>Sequence</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control no-space' type='text' name='mop-update-seq' readonly></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 100px; text-align: right; padding-right: 20px;'><label>Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required' title="Please fill out this field" type='text' name='mop-update-code'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; text-align: right; padding-right: 20px;'><label>Type</label></td>
					<td colspan='3' style='padding-top: 5px;'>
						<select class='v-select-required' title="Please fill out this field" id='mop-update-type' name='mop-update-type' placeholder='Select...'></select>
					</td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 100px; text-align: right; padding-right: 20px;'><label>Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control v-required' title="Please fill out this field" type='text' name='mop-update-name'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; text-align: right; padding-right: 20px;'><label>Shortname</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control no-space' type='text' name='mop-update-shortname'></td>
				</tr>
			</table>
		</div>
		<input type="hidden" name="mop-update-id">
		<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px;'>
			<button class='btn btn-info btn-sm btn-raised ripple-effect v-submit' type='button' data-dismiss='modal' style='float: right;'>Save Changes</button>
		</div>
	</form>
</div>