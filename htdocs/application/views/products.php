<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Products <small>All registered products</small>
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a id='show_all_columns' href="#" class=" waves-effect waves-block">Show All Columns</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <button id='add' type='button' class='btn btn-primary' style='margin-bottom: 10px;'>Add Product</button>
                <button id='return' type='button' class='btn bg-blue-grey' style='margin-bottom: 10px;'>Return Product</button>
                <button id='add' type='button' class='btn bg-black' style='margin-bottom: 10px;'>Deleted Products</button>
	        	    <div class="input-group">
      				    <span class="input-group-addon" id="basic-addon1">@</span>
        				  <input type="text" id='table_search' class="form-control" placeholder="Username" aria-describedby="basic-addon1">
        				</div>
               	<table class="table table-bordered table-striped table-hover" id='table' style='width: 100%;'>
               		<thead>
               			<th>Actions</th>
               			<th>Image</th>
               			<th>Name</th>
               			<th>Brand</th>
               			<th>Description</th>
               			<th>Price</th>
               			<th>Qty</th>
               			<th>Reorder lvl</th>
               			<th>Supplier</th>
               		</thead>
               </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-modal" role="dialog">
  <div class="modal-dialog modal-lg">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="fa fa-plus-circle"> Add Product</span></h4>
      </div>
      <form action="<?php echo base_url(); ?>create_product" method="POST" enctype='multipart/form-data'>
        <div class="modal-body">
          <div class='row'>
            <div class='col-md-5'>
              <h4 style="text-align: center;">Upload Image</h4>
              <img id='temp-img' src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/uploads/default.jpg" width='100%'>
              <input id='img' type='file' name='image' style='margin-top: 20px;'>
            </div>
            <div class='col-md-7'>
              <table width="100%">
                <tr>
                  <td colspan="2">
                    <div class='form-group'>
                      <select name="supplier" class="form-control show-tick">
                          <option value="">-- Select Supplier--</option>
                          <?php
                            foreach ($suppliers as $key => $value) {
                              echo "<option value='$value->suppID'>$value->suppName</option>";
                            }
                          ?>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                      <div class="form-group form-float">
                          <div class="form-line">
                              <input name="pname" type="text" class="form-control">
                              <label class="form-label">Product Name</label>
                          </div>
                      </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input name="brand" type="text" class="form-control">
                            <label class="form-label">Brand</label>
                        </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="form-group">
                      <div class="form-line">
                        <textarea name="desc" rows="4" class="form-control no-resize" placeholder="Description here..."></textarea>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group form-float">
                      <div class="form-line">
                          <input name="qty" type="number" name="qty" min="1" max="1000" name="qty" class="form-control">
                          <label class="form-label">Quantity in stock</label>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group form-float">
                      <div class="form-line">
                          <input name="relvl" type="number" name="qty" min="1" max="1000" name="qty" class="form-control">
                          <label class="form-label">Re-order Level</label>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input name="price" type="number" class="form-control">
                            <label class="form-label">Price per unit</label>
                        </div>
                    </div>
                  </td>
                </tr>
              </table>
              <input type='hidden' name='user' id='addProdUser'>
            </div>
          </div>
          <div class='row'>
            <div class='col-md-12' style='text-align: center; padding-top: 15px;'>
              <input type="submit" name="pADD" value="ADD" class="btn btn-primary btn-block">
            </div>
          </div>
        </div>
      </form>
    </div>   
  </div>
</div>

<div class="modal fade" id="return-modal" role="dialog">
    <div class="modal-dialog">  
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="fa fa-minus-circle"> Returned Product By Customer</span></h4>
        </div>
        <div class="modal-body">
        <form action="<?php echo base_url(); ?>return_product" method="POST">
          <table width="100%">
            <tr>
              <td colspan="2">
                  <div class='form-group'>
                    <select id='products' name="itemNum" class="form-control show-tick">
                        <option value="">-- Select Product--</option>
                        <?php
                          foreach ($products as $key => $value) {
                            echo "<option value='$value->itemNum' remaining_qty='$value->prodQty' supplier='$value->suppName' suppID='$value->suppID' brand='$value->prodBrand' >$value->prodName</option>";
                          }
                        ?>
                    </select>
                  </div>
              </td>
            </tr>
            <tr>
                <td colspan="2">
                  <div class="form-group form-float">
                      <div class="form-line">
                          <input name="brand" type="text" class="form-control" readonly>
                          <label class="form-label">Brand</label>
                      </div>
                  </div>
                </td>
            </tr>
             <tr>
                <td colspan="2">
                  <div class="form-group form-float">
                      <div class="form-line">
                          <input name="supplier" type="text" class="form-control" readonly>
                          <label class="form-label">Supplier</label>
                      </div>
                  </div>
                </td>
            </tr>
             <tr>
                <td colspan="2">
                  <div class="form-group">
                      <div class="form-line">
                          <input name="rDate" type="text" class="datepicker form-control" placeholder="Return date">
                      </div>
                  </div>
                </td>
            </tr>

            <tr>
              <td>
                  <div class="form-group form-float">
                      <div class="form-line">
                          <input name="qty" type="number" class="form-control" min='1' required>
                          <label class="form-label">Quantity to be returned</label>
                      </div>
                  </div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                  <div class="form-group form-float">
                      <div class="form-line">
                          <input name="remarks" type="text" class="form-control" required>
                          <label class="form-label">Remarks</label>
                      </div>
                  </div>
              </td>
            </tr>
          </table>
          <input type='hidden' name='suppID'>
          <input type="hidden" name="remaining_qty">
          <input type="submit" name="pADD" value="SUBMIT" class="btn btn-danger btn-block">
        </form>
      </div>
    </div>   
  </div>
</div> 

<div class="modal fade" id="checkin-modal" role="dialog">
  <div class="modal-dialog">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="fa fa-plus-circle"> Check-in Product</span></h4>
      </div>
      <form action="<?php echo base_url(); ?>checkin" method='post'>
        <div class="modal-body">
          <table width="100%">
              <tr>
                <td colspan="3">
                  <div class="form-group form-float">
                    <div class="form-line">
                        <input name="pname" type="text" class="form-control" readonly>
                        <label class="form-label">Product Name</label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <div class="form-group form-float">
                    <div class="form-line">
                        <input name="brand" type="text" class="form-control" readonly>
                        <label class="form-label">Brand</label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-group form-float">
                    <div class="form-line">
                        <input name="qty" type="number" class="form-control" readonly>
                        <label class="form-label">Quantity in stock</label>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="form-group form-float">
                    <div class="form-line">
                        <input name="qty_add" type="number" class="form-control" required>
                        <label class="form-label">Quantity to be added</label>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="form-group form-float">
                    <div class="form-line">
                        <input name="qty_total" type="number" class="form-control" readonly>
                        <label class="form-label">Total Qty</label>
                    </div>
                  </div>
                </td>                
              </tr>
              <tr>
                  <td colspan="3">
                    <div class="form-group">
                      <div class="form-line">
                          <input name="date_delivered" type="text" class="datepicker form-control" placeholder="Date Delivered" required>
                      </div>
                    </div>
                  </td>
              </tr>
              <tr>
                  <td colspan="3">
                    <div class="form-group form-float">
                      <div class="form-line">
                          <input name="remarks" type="text" class="form-control" required>
                          <label class="form-label">Remarks</label>
                      </div>
                    </div>
                  </td>
              </tr>
          </table>
          <input type='hidden' name='edit_prod_id'>
          <input type="submit" name="pEdit" value="SUBMIT" class="btn btn-primary btn-block">
        </div>
      </form>
    </div>   
  </div>
</div>

