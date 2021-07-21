<?php include_once '../template-parts/header.php';?>
<?php
if (isset($_GET['id'])){
	include_once '../inc/connect_db.php';

	$sql ="SELECT * FROM products WHERE id = ?;";
	try{
		// use exec() because no results are returned
		$stmt = $conn->prepare($sql);
		$stmt->execute([$_GET['id']]);

	} catch(PDOException $e) {
		die( $sql . "<br>" . $e->getMessage());
	}

	$product = $stmt->fetch(PDO::FETCH_OBJ);
}else
{
	header("location: /admin/products/create.php");
	exit;
}
  ?>

<div class="container-fluid">
  <div class="row">
    <?php include_once '../template-parts/sidebar.php';?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update Products: </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a  class="btn btn-sm btn-outline-secondary" href="/admin/products/create.php">Save</a>
          </div>
        </div>
      </div>

        <form method="post" enctype="multipart/form-data" action="/admin/products/edit-process.php?id=<?php echo $_GET['id']?>">
          <div class="row mb-3">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control <?php if(isset($_SESSION['errors']['title'])):?>is-invalid<?php endif?>"
              id="title" name="title" value="<?php echo isset($_SESSION['errors'])?$_SESSION['data']['title']:$product->title?>">
              <?php if(isset($_SESSION['errors']['title'])):?>
              <div class="invalid-feedback">
                <?php echo $_SESSION['errors']['title']?>
              </div>
              <?php endif?>
            </div>
          </div>
          <div class="row mb-3">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
              <input type="text" class="form-control <?php if(isset($_SESSION['errors']['price'])):?>is-invalid<?php endif?>"
              id="price" name="price" value="<?php echo isset($_SESSION['errors'])?$_SESSION['data']['price'] : $product->price?>">
              <?php if(isset($_SESSION['errors']['price'])):?>
              <div class="invalid-feedback">
                <?php echo $_SESSION['errors']['price']?>
              </div>
              <?php endif?>
            </div>
          </div>
          <div class="row mb-3">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
              <textarea rows="8" cols="" class="form-control" id="description"
              name="description"><?php echo $product->description?></textarea>
            </div>
          </div>

          <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Publish</legend>
            <div class="col-sm-10">
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="publish" id="publish1" value="1" checked>
                  <label class="form-check-label" for="publish1">
                    Yes
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="publish" id="publish0" value="0">
                  <label class="form-check-label" for="publish0">
                    No
                  </label>
              </div>
            </div>
          </fieldset>
          <div class="row mb-3">
            <label for="photo" class="col-sm-2 col-form-label">Photo</label>
            <div class="col-sm-10">
            <?php if ($product->photo): ?>
              <img src="/uploads/<?php echo $product->photo?>" width="120px" class="img-thumbnail" alt="photo">
            <?php endif?>
            <input type="hidden" name="old_photo" value="<?php echo $product->photo?>">
            <input class="form-control" type="file" id="photo" name="photo">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </main>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script>
    ClassicEditor
    .create( document.querySelector( '#description' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'uploadImage','blockQuote','undo', 'redo' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        },
        ckfinder: {
			options: {
				resourceType: 'Images',
				uploadUrl: '/admin/connector.php?command=QuickUpload&type=Files&responseType=json'
			}
		},
		image: {
	        toolbar: [
	            'imageStyle:inline',
	            'imageStyle:block',
	            'imageStyle:side',
	            '|',
	            'toggleImageCaption',
	            'imageTextAlternative'
	        ]
	    },
	    language: 'en'
    } )
    .catch( error => {
        console.log( error );
    } );
    </script>
  </body>
</html>
