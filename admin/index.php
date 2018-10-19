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

                        <li class="nav-item active">
                            <a class="nav-link waves-effect" href="index.php">Artigos</a>
                        </li>
                        <li class="nav-item">
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
                  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Manipulacao de Artigos</h3>
                        <div class="card-body">
                              <div id="table" class="table-editable">
                                <span class="table-add float-right mb-3 mr-2"><a href="#!" data-toggle="modal" data-target="#basicExampleModal"
                                   class="text-success"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a></span>
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                  <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Titulo</th>
                                    <th class="text-center">Conteudo</th>
                                    <th class="text-center">Data</th>
                                    <th class="text-center">Editar</th>
                                    <th class="text-center">Delete</th>
                                  </tr>
                                  <tr>
                                     <td class="pt-3-half" contenteditable="true">1</td>
                                     <td class="pt-3-half" contenteditable="true">Teste</td>
                                     <td class="pt-3-half" contenteditable="true">Teste</td>
                                     <td class="pt-3-half" contenteditable="true">18/10/2018</td>
                                     <td>
                                       <span class="table-remove"><button type="button" class="btn btn-info btn-rounded btn-sm my-0">Editar</button></span>
                                     </td>
                                     <td>
                                       <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Delete</button></span>
                                     </td>
                                 </tr>
                                </table>
                              </div>
                        </div>
                  </div>
                  <!-- Editable table -->

            </section>
            <!--Section: Cards-->

        </div>

    <!-- modal de criacao de post-->

      <!-- Modal -->
      <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg modal-notify modal-info" role="document">
          <div class="modal-content" style="width:100%">

              <div class="modal-header">
                <p class="heading lead">Criar Artigo</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="white-text">×</span>
                </button>
              </div>

              <div class="modal-body">

                <!-- Material input -->
                <div class="md-form">
                  <input type="text" id="form1" class="form-control">
                  <label for="form1" >Titulo</label>
                </div>
                <div class="md-form">
                  <input type="date" id="form1" class="form-control">
                  <label for="form1" ></label>
                </div>

                <div class="md-form pt-2">
                  <span>Conteúdo</span>
                  <ckeditor v-model="content"></ckeditor>
                </div>

                <div class="md-form">
                  <select class="mdb-select md-form">
                      <option value="" disabled selected>Selecionar a Categoria</option>
                      <option value="1">Option 1</option>
                      <option value="2">Option 2</option>
                      <option value="3">Option 3</option>
                  </select>
                </div>

              </div>

              <div class="modal-footer">
                <a type="button" class="btn btn-info waves-effect waves-light">Salvar
                  <i class="fa fa-diamond ml-1"></i>
                </a>
                <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Cancelar</a>
             </div>
          </div>
        </div>
      </div>

    <!-- fim modal-->

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
    <!-- ckeditor-->
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <!-- index do vue-->
    <script type="text/javascript" src="../vuejs/admin/index.js"></script>

    <!-- Initializations -->
    <script type="text/javascript">
        // Animations initialization
        new WOW().init();

    </script>

</body>

</html>
