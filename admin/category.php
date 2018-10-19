<!DOCTYPE html>
<html lang="pt">

<head>
     <!-- verifica se existe usuario logado-->
     <?php include_once('../config/logged.php'); ?>

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

    <!--Main Navigation-->
    <header>

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container">

                <!-- Brand -->
                <a class="navbar-brand waves-effect" href="#">
                    <i class="fa fa-unlock-alt"></i>
                    <strong class="blue-text">Admin</strong>
                </a>

                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left -->
                    <ul class="navbar-nav mr-auto">

                      <li class="nav-item">
                          <a class="nav-link waves-effect" href="index.php">Artigos</a>
                      </li>
                      <li class="nav-item active">
                          <a class="nav-link waves-effect" href="category.php">Categoria</a>
                      </li>

                   </ul>

                   <!-- Right -->
                   <ul class="navbar-nav nav-flex-icons">
                       <li class="nav-item">
                           <a href="#" class="nav-link waves-effect">
                               <i class="fa fa-user"></i><?php echo $userName; ?>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="/blog/admin/logout.php" class="nav-link waves-effect">
                            <i class="fa fa-sign-out"></i>Sair
                           </a>

                       </li>
                  </ul>

                </div>

            </div>
        </nav>
        <!-- Navbar -->

    </header>

    <!--Main layout-->
       <main id="app" class="mt-5 pt-5">

           <div class="container">

            <!--Section: Cards-->
            <section class="text-center">

              <!-- Editable table -->
                  <div class="card">
                  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Categorias</h3>
                        <div class="card-body">

                        </div>
                  </div>
                  <!-- Editable table -->

            </section>
            <!--Section: Cards-->

        </div>

    <!-- modal de criacao de post-->


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


</body>

</html>
