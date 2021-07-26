<?php require_once '../views/admin/layouts/header.php';?>

<div class="container-fluid">
  <div class="row">
  <?php require_once '../views/admin/layouts/sidebar.php';?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a  class="btn btn-sm btn-outline-secondary" href="/admin/products/create.php">Create new a product</a>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Photo</th>
              <th scope="col">Price</th>
              <th scope="col">Category</th>
              <th scope="col" style="width: 10%">-</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $row = $result->fetch(PDO::FETCH_OBJ);
		    do {
		  ?>
            <tr>
              <td><?php echo $row->id; ?></td>
              <td><?php echo $row->title; ?></td>
              <td><?php echo $row->price; ?></td>
              <td>placeholder</td>
              <td><?php //echo $row->description; ?></td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <a class="btn btn-primary" href="/admin/products/edit?id=<?php echo $row->id;?>">
				  Edit
				  </a>
                  <button type="button" class="btn btn-success">Pushlish</button>
                  <button type="button" class="delete btn btn-danger" data="<?php echo $row->id;?>">Delete</button>
                </div>
              </td>
            </tr>
			<?php
			} while ($row = $result->fetch(PDO::FETCH_OBJ));?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/admin/products/delete.php" method="post">
      <input type="hidden" name="product_id" id="product_id" value="0">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete product!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you want to delete this product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
      $('.delete').click(function(){
          $('#product_id').val($(this).attr('data'))
          var myModal = new bootstrap.Modal($('#deleteModal'),
          {
              keyboard: false
          });
          myModal.show();
      });

    </script>
  </body>
</html>
