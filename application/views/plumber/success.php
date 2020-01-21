<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <title>Codeigniter File Upload Example</title>
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {

            padding-top: 5rem;
        }

        .starter-template {
          
          padding: 3rem 1.5rem;
          
          text-align: center;
        }
    </style>
  </head>

  <body>
  	 <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url(); ?>/index.php/upload">Upload File <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        
      </div>
    </nav>
  	 <main role="main" class="container">

      <div class="starter-template">

			<h3>File has been uploaded.</h3>

			<ul class="list-group">

				<?php foreach ($upload_data as $key => $value): ?>

					<li class="list-group-item"><strong><?php echo $key; ?></strong>: <?php echo $value;?></li>

				<?php endforeach; ?>


				<li class="list-group-item"><?php echo "<h3>Uploaded file:</h3>"; ?></li>
				
				<li class="list-group-item">
				
				  <img width="50%" src="<?php echo base_url(); ?>uploads/<?php echo $upload_data['file_name']; ?>" />
				
				</li>

			</ul>

  </div>

    </main><!-- /.container -->

  </body>
</html>

</body>

</html>