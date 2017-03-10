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
                    		<li><span id='show-filters' class='disable-setting' data-status='0'>Show Filters</span></li>
                    		<li><span id='advance-search' data-status='0'>Advance Search</span></li>
                    		<li class="divider"></li>
                    		<li><span id='show-all-col' data-status='0'>Show All Columns</span></li>
                  		</ul>
                	</div>
              	</div>
            </div>
    		<div class='box-body hide-table-setting'>
    			<div class='row'>
    				<div class='col-md-12' id='company-table-row' style="padding-right: 28px;">
    					<div class='row'>
    						<div class='col-md-12' style="margin-bottom: 10px;">
    							<div class="input-group table-search">
								  <span class="input-group-addon" id="basic-addon1"><i class='fa fa-search'></i></span>
								  <input type="text" class="form-control general-search" placeholder="General Search..." aria-describedby="basic-addon1">
								</div>
    						</div>
    					</div>
						<table id='company-table' class='table table-hovered table-bordered' style='width: 100%'>
							<thead>
								<tr>
									<th></th>
									<th>Seq</th>
									<th>Name</th>
									<th>Address</th>
									<th>TIN</th>
									<th>Type</th>
									<th>Tax</th>
									<th>Contact Number</th>
									<th>Email</th>
								</tr>
								<tr id="searchfilterrow" class='hide-searchfilter searchfilterrow'>
									<th></th>
									<th>Seq</th>
									<th>Name</th>
									<th>Address</th>
									<th>TIN</th>
									<th>Type</th>
									<th>Tax</th>
									<th>Contact Number</th>
									<th>Email</th>
								</tr>
								
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id='view-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 9px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">View Company</h4>
	</div>
	<div class='modal-body'>
		<table width='90%'>
			<tr>
				<td style='padding-top: 10px; width: 150px; text-align: right; padding-right: 20px;'><label>Sequence</label></td>
				<td colspan='3' style='padding-top: 10px;'><input name='view-seq' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Name</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-name' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Address</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-address' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>TIN</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-tin' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Classification</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-class' class='form-control' type='text' readonly>
				</td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Type</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-type' class='form-control' type='text' placeholder='Select...' readonly>
				</td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Tax</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-tax-type' class='form-control' type='text' readonly>
				</td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Contact Number</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-cno' class='form-control' type='text' readonly></td>
			</tr>
			<tr>
				<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Email</label></td>
				<td colspan='3' style='padding-top: 5px;'><input name='view-email' class='form-control' type='text' readonly></td>
			</tr>
		</table>
	</div>
	<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px;'>
		<button id='close-btn' class='btn btn-info btn-sm close-popover btn-raised ripple-effect' type='button' data-dismiss='modal' style='float: right;'>Close</button>
	</div>
</div>
<div id='edit-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 10px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">Edit Company</h4>
	</div>
	<form action="<?php echo base_url(); ?>docpro_settings/company/edit" method='post' class='body'>
		<div class='modal-body'>
			<table width='90%'>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Sequence</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control' type='text' name='edit-seq' readonly></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control' type='text' name='edit-name' readonly></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Address</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control no-space' type='text' name='edit-address'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Contact Number</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control no-space number' type='text' name='edit-cno'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Email</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control no-space' type='email' name='edit-email'></td>
				</tr>
			</table>
		</div>
		<input type='hidden' name='edit-id'>
		<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px;'>
			<button class='btn btn-info btn-sm btn-raised ripple-effect' type='submit' style='float: right;'>Save Changes</button>
		</div>
	</form>
</div>
<div id='update-popover' class='modal fade' role='dialog' tabindex='-1'>
	<div style='border-bottom: 1px groove; height: 30px; padding-bottom: 10px;'>
		<button class='close close-popover' type='button' data-dismiss='modal' style='padding-right: 10px;'><span aria-hidden='true'>&times;</span></button>
		<h4 class='modal-title' style="font-family: 'Roboto Condensed', sans-serif;">Update Company</h4>
	</div>
	<form action="<?php echo base_url(); ?>docpro_settings/company/update" method='post' class='body'>
		<div class='modal-body'>
			<table width='90%'>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Sequence</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control' type='text' name='update-seq' readonly></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Name</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control' type='text' name='update-name' readonly></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Address</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control no-space' type='text' name='update-address'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Contact Number</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control no-space' type='text' name='update-cno'></td>
				</tr>
				<tr>
					<td style='padding-top: 5px; width: 150px; text-align: right; padding-right: 20px;'><label>Email</label></td>
					<td colspan='3' style='padding-top: 5px;'><input class='form-control no-space' type='email' name='update-email'></td>
				</tr>
			</table>
		</div>
		<input type='hidden' name='update-id'>
		<div class='modal-footer' style='border-top: 1px inset; padding-top: 5px; padding-bottom: 0px;'>
			<button class='btn btn-info btn-sm btn-raised ripple-effect' type='submit' style='float: right;'>Save Changes</button>
		</div>
	</form>
</div>