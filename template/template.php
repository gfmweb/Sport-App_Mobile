<!doctype html>
<html lang="<?=$this->APP_Language?>" prefix="og: http://ogp.me/ns#">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$this->Title?></title>
    <!-- Bootstrap core CSS -->
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <?= $this->CSS.PHP_EOL  ?>
        <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <?= $this->VUE.PHP_EOL ?>

  </head>
  <body>
        <?=$this->Navbar;?>

        <section class="py-5 px-5 mt-5">
            <?php
                include $this->View;
            ?>
        </section>

        <section>
            <footer class="footer mt-auto py-3 bg-dark fixed-bottom" >
                <div class="container text-center">
                    <span class="text-muted">© Persona FOOD 2021</span>
                </div>
            </footer>
        </section>
        <?= $this->JS.PHP_EOL ?>
  </body>
</html>


</body>
</html>
