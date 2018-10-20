<!DOCTYPE html>
<html lang="pt">

<head>
    <!-- verifica se existe usuario logado-->


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../css/mdb.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

      <!--Main layout-->
       <main id="app" class="mt-5 pt-5">

           <div class="container" style="width:40%">

            <!--Section: Cards-->
            <section>

              <!--Form with header-->
              <?php

                if(isset ($_GET['error']) && $_GET['error'] == 1) { ?>
                  <div class="alert alert-danger" role="alert">
                    Usuario ou senha invalido!!
                  </div>
                  
              <?php } ?>

                <div class="card">
                    <div class="card-block">

                      <form action="/blog/rest/user/logger.php" method="post">
                          <!--Header-->
                          <div class="form-header text-center  purple  blue-grey lighten-5">
                              <h3><i class="fa fa-lock"></i> Login:</h3>
                          </div>

                          <!--Body-->
                          <div class="md-form" style="padding:10px;">
                              <i class="fa fa-envelope prefix"></i>
                              <input type="text" id="form2" name="login" autofocus class="form-control">
                              <label for="form2">usuario</label>
                          </div>

                          <div class="md-form" style="padding:10px;">
                              <i class="fa fa-lock prefix"></i>
                              <input type="password" id="form4" name="password" class="form-control">
                              <label for="form4">senha</label>
                          </div>

                          <div class="text-center">
                              <button type="submit" class="btn waves-effect blue-grey lighten-1">Login</button>
                          </div>
                      </form>

                    </div>

                </div>
                <!--/Form with header-->


            </section>
            <!--Section: Cards-->

        </div>
    </main>
    <!--Main layout-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <!-- vuejs framework de front-end -->
    <script type="text/javascript" src="../vuejs/vue.2.5.17.min.js"></script>
    <!-- axios cliente rest-->
    <script type="text/javascript" src="../js/axios.0.18.0.min.js"></script>
    <!-- index do vue-->
    <script type="text/javascript" src="../vuejs/admin/login.js"></script>

    <!-- Initializations -->
    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>
</body>

</html>
