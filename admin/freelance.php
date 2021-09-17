<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Liste de Freelance</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary btn-sm">Add Freelance</a>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Nom</th>
              <th>Photo</th>
              <th>Domaine</th>
              <th>Email</th>
              <th>Téléphone</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="product_list">
            <!-- <tr>
              <td>1</td>
              <td>ABC</td>
              <td>FDGR.JPG</td>
              <td>122</td>
              <td>eLECTRONCS</td>
              <td>aPPLE</td>
              <td><a class="btn btn-sm btn-info"></a><a class="btn btn-sm btn-danger">Delete</a></td>
            </tr> -->
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>



<!-- Add Product Modal start -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Freelance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-product-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Freelance Name</label>
		        		<input type="text" name="product_name" class="form-control" autocomplete="off" placeholder="Enter Freelance Name">
		        	</div>
        		</div>

            <div class="col-12">
        			<div class="form-group">
		        		<label>Domaine Name</label>
		        		<input type="text" name="brand_id" class="form-control" autocomplete="off" placeholder="Enter Freelance Domaine">
		        	</div>
        		</div>

            <div class="col-12">
        			<div class="form-group">
		        		<label>Email Name</label>
		        		<input type="text" name="category_id" class="form-control" autocomplete="off" placeholder="Enter Email Domaine">
		        	</div>
        		</div>
            
        		
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Telephone Name</label>
		        		<input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Enter phone">
		        	</div>
        		</div>

        		<div class="col-12">
        			<div class="form-group">
		        		<label>Photo <small>(format: jpg, jpeg, png)</small></label>
		        		<input type="file" name="product_image" class="form-control">
		        	</div>
        		</div>
        		<input type="hidden" name="add_product" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-product">Ajouter</button>
        		</div>
        	</div>
        	
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Add Product Modal end -->

<!-- Edit Product Modal start -->
<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Freelance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-product-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Freelance Name</label>
                <input type="text" name="e_product_name" class="form-control" placeholder="Enter Freelance Name">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label>Domaine </label>
                <input type="text" name="e_brand_id" class="form-control" placeholder="Enter Domaine Name">
              </div>
            </div>
            
            <div class="col-12">
              <div class="form-group">
                <label>Email </label>
                <input type="email" name="e_category_id" class="form-control" placeholder="Enter Email Name">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label>Telephone </label>
                <input type="email" name="e_phone_id" class="form-control" placeholder="Enter phone Name">
              </div>
            </div>
            
          
            <div class="col-12">
              <div class="form-group">
                <label>Photo <small>(format: jpg, jpeg, png)</small></label>
                <input type="file" name="e_product_image" class="form-control">
                <img src="../product_images/1.0x0.jpg" class="img-fluid" width="50">
              </div>
            </div>
            <input type="hidden" name="pid">
            <input type="hidden" name="edit_product" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary submit-edit-product">Modifier</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit Product Modal end -->

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/freelance.js"></script>