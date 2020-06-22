<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Density 3000</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
   <section class="container py-5">
      <div class="row">
         <form class="col-12" method="POST">
            <textarea class="form-control" rows="10" style="resize:none;" name="density"
            placeholder="https://www.domain.com - keyword"></textarea>
            <button class="btn btn-success d-block ml-auto mt-3">GET DENSITY</button>
         </form>
      </div> 
   </section>
   <section id="result" class="container">
      <?php
         include 'functions.php';
         if(isset($_POST['density'])){
            echo 'URL, PÁGINA, DENSIDADE <br />';
            $density = preg_split('/[\n\r]+/', $_POST['density']);
            foreach ($density as $key => $value) {
               $density[$key] = explode(' - ', $value);
            }
            // echo "<pre>";var_dump($density);
            foreach ($density as $key => $value) printCSVDensity(getDensity($value[0], $value[1]));
         }
      ?>
   </section>
</body>
</html>