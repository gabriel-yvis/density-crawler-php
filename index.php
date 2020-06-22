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
         echo 'URL, PÁGINA, DENSIDADE <br />';
         if(isset($_POST['density'])){
            $density = preg_split('/[\n\r]+/', $_POST['density']);
            foreach ($density as $key => $value) {
               $density[$key] = explode(' - ', $value);
            }
            // echo "<pre>";var_dump($density);
            foreach ($density as $key => $value) printDensity(getDensity($value[0], $value[1]));
         }else{
            // $time[0] = date('h:i:s');
            foreach ($conteudo as $key => $value) printCSVDensity(getDensity($value[0], $value[1]));
            // foreach ($conteudo as $key => $value) printDensity(getDensity($value[0], $value[1]));
            // foreach ($conteudo as $key => $value) checkGZip($value);
            // $time[1] = date('h:i:s');
            // echo $time[0].' => '.$time[1];
         }
      ?>
   </section>
</body>
</html>