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
    <!-- links diretos -->
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap-vue.css"/>
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
                           <a href="/admin/logout.php" class="nav-link waves-effect">
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
            <b-alert :show="success" dismissible variant="success">
                    {{message}}
            </b-alert>
              <!-- Editable table -->
                  <div class="card">
                  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Manipulacao de Artigos</h3>
                        <div class="card-body">
                              <div id="table" class="table-editable">
                                <span class="table-add float-right mb-3 mr-2"><a href="#!" @click="clickCreatePost"
                                   class="text-success"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a></span>
                                
                                <div v-if="loading">
                                   <img src="../img/loading.gif" width="200px">
                                </div>   
                                <div v-else>
                                    <table class="table table-bordered table-responsive-md table-striped text-center">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Titulo</th>
                                        <th class="text-center">Data</th>
                                        <th class="text-center">Autor</th>
                                        <th class="text-center">Categoria</th>
                                        <th class="text-center">Editar</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                    <tr v-for="post in postsData">
                                        <td class="pt-3-half" contenteditable="true">{{post.id}}</td>
                                        <td class="pt-3-half" contenteditable="true">{{post.title}}</td>
                                        <td class="pt-3-half" contenteditable="true">{{post.date}}</td>
                                        <td class="pt-3-half" contenteditable="true">{{post.userName}}</td>
                                        <td class="pt-3-half" contenteditable="true">{{post.categoryName}}</td>
                                        <td>
                                        <span class="table-remove"><button type="button" 
                                        class="btn btn-info btn-rounded btn-sm my-0" @click="clickEdit(post.content)">Conteúdo</button></span>
                                        </td>
                                        <td>
                                        <span class="table-remove"><button type="button" 
                                        class="btn btn-danger btn-rounded btn-sm my-0">Delete</button></span>
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
   
      <!-- Modal -->
     
      <b-modal ref="myModalRef" size="lg" hide-footer title="Criar Artigo">
         <div class="d-block">
           
           <b-alert :show="error" variant="danger">
                    {{message}}
           </b-alert>

            <b-form-group label="Título">
                <b-form-input type="text"
                            v-model="post.title"
                            placeholder="Título">
                </b-form-input>
            </b-form-group>

            <b-form-group label="Data">
                <b-form-input type="date"
                            v-model="post.date"
                            placeholder="Data">
                </b-form-input>
            </b-form-group>
            
            <b-form-group label="Capa">
                <b-form-file v-model="selectedFile" @change="onUploadFile" :state="Boolean(selectedFile)" placeholder="Selecione a capa do artigo..."></b-form-file>
            </b-form-group>
            
            <b-form-group label="Categoria">
                <select v-model="post.categoryId"  class="browser-default custom-select">
                    <option v-for="category in categorysData" :value="category.id">{{category.name}}</option>
                </select>
            </b-form-group>
          

            <div class="form-group">
                <label for="content">Conteúdo</label>
                <ckeditor v-model="post.content"></ckeditor>
            </div>
                           
    
      </div>
      <b-btn  class="mt-3" variant="info" block @click="saveArticle">Salvar</b-btn>

    </b-modal>

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
    
    <!-- links diretos-->
    <script type="text/javascript" src="../js/polyfill.min.js"></script>
    <script type="text/javascript" src="../vuejs/bootstrap-vue.js"></script>

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
