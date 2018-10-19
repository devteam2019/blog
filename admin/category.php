<!DOCTYPE html>
<html lang="pt">

<head>
     <!-- verifica se existe usuario logado-->
     <?php include_once('../config/logged.php'); ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
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
                      
           <div v-if="error" class="alert alert-danger" role="alert">
                {{message}}
           </div>
            <!--Section: Cards-->
            <section class="text-center">

              <!-- Editable table -->
                  <div class="card">
                  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Categoria</h3>
                        <div class="card-body">
                            
                            <div class="md-form input-group">
                                <input type="text" class="form-control" v-model="name" placeholder="Nome" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-info waves-effect btn-sm m-0" 
                                    @click="clickSave" type="button">Adicionar</button>
                                </div>
                            </div>

                            <div class="md-form">
                                <div v-if="loading">
                                   <img src="../img/loading.gif" width="200px">
                                </div>
                                <div v-else>
                                    <table class="table table-bordered table-responsive-md table-striped text-center">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nome</th>
                                            <th class="text-center"></th>
                                        </tr>
                                        <tr v-for="category in categorysData">
                                            <td class="pt-3-half" contenteditable="true">{{category.id}}</td>
                                            <td class="pt-3-half" contenteditable="true">{{category.name}}</td>
                                            <td style="width:80px;">
                                                <span class="table-remove">
                                                <button type="button" class="btn btn-danger btn-rounded btn-sm my-0" @click="clickDelete(category)">Delete</button>
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                                                                             
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
     <!-- regra de categoria-->
     <script type="text/javascript" src="../vuejs/admin/category.js"></script>


</body>

</html>
