Vue.use(VueHtml5Editor, {
  image: {compress: false},
  icons: {
      text: "custom-icon text",
      color: "custom-icon color",
      font: "custom-icon font",
      align: "custom-icon align",
      list: "custom-icon list",
      link: "custom-icon link",
      unlink: "custom-icon unlink",
      tabulation: "custom-icon table",
      image: "custom-icon image",
      "horizontal-rule": "custom-icon hr",
      eraser: "custom-icon eraser",
      hr: "custom-icon hr",
      undo: "custom-icon undo",
      "full-screen": "custom-icon full-screen",
      info: "custom-icon info ",
  }
})


//logica
new Vue({
  el: '#app',
  data: {
    loading: false,
    categorysData: [],
    postsData: [],
    post: {
      title: null,
      date: null,
      content: null,
      userId: null,
      categoryId: null,
      public: 0,
      userName: null,
      categoryName: null
    },
    selectedFile: null,
    message: '',
    error: false,
    success: false,
    editContent: '',
    editId: null,
    errorEdit: false
  },

  mounted() {
      axios.get("/rest/category/listAll.php").then(response => {
        this.categorysData = response.data.categorys;
      }),

      axios.get("/rest/user/getUserLogger.php").then(response => {
        this.post.userId = response.data.userId;
      }),

      this.listPosts();

  },

  methods: {

    listPosts() {
      this.loading = true;
      axios.get("/rest/post/listAll.php").then(response => {
        this.postsData = response.data.posts;
        // console.log(this.postsData)
        this.loading = false;
      })
    },

    onUploadFile: function (event) {
      this.selectedFile = event.target.files[0];
      //console.log(this.selectedFile)
      if (this.selectedFile != null && !this.selectedFile.type.includes("image")) {
        alert("É possivel adicionar apenas imagens!");
      }
      else {
        this.nameFile = this.selectedFile.name;
        //coloca arquivo no objeto de parametro javascript..
        const data = new FormData();
        data.append('fileImage', this.selectedFile, this.selectedFile.name);

        axios.post("/rest/post/uploadFile.php", data).then(response => {
          console.log(response.data);
        })
      }
    },

    updateData: function (data) {
      // sync content to component
      this.post.content = data
    },

    updateDataEdit: function (data) {
      // sync content to component
      this.editContent = data
    },

    saveArticle: function () {
        
       console.log(this.post.content)

        //validações
        if (this.post.title == '' || this.post.title == null) {
          this.message = 'O título é obrigatório!';
          this.error = true;
          return;
        }
        if (this.post.date == '' || this.post.date == null) {
          this.message = 'A data do artigo é obrigatório!';
          this.error = true;
          return;
        }
        if (this.post.categoryId == '' || this.post.categoryId == null) {
          this.message = 'A categoria é obrigatório!';
          this.error = true;
          return;
        }
        if (this.post.content == '' || this.post.content == null) {
          this.message = 'O conteúdo do artigo é obrigatório!';
          this.error = true;
          return;
        }

        var imageName = null;
        if (this.selectedFile != null) {
          imageName = this.selectedFile.name;
        }
        
        var data = {
            title: this.post.title,
            date: this.post.date,
            content: this.post.content,
            image: imageName,
            userId: this.post.userId,
            categoryId: this.post.categoryId
        }

        axios.post("/rest/post/save.php", data).then(response => {
          if (response.data.error) {
            this.message = response.data.message;
            this.error = true;
            this.success = false;
          }
          else {
            this.message = response.data.message;
            this.success = true;
            this.error = false;
            this.$refs.myModalRef.hide();
            clearInstance(this);
            this.listPosts();      
          }
        })

    },

    clickCreatePost: function () {
        clearInstance(this);
        this.$refs.myModalRef.show();
    },
    
    clickEdit: function(post) {
        this.editId = post.id;
        this.editContent = post.content;
        this.$refs.contentModal.show();
    },

    clickAlterContent: function() {
     
      this.errorEdit = false;
      if(this.editContent == '' || this.editContent == null) {
          this.message = 'O conteúdo não pode está vazio!';
          this.errorEdit = true;
          return;
      }

      var data = {
        id: this.editId,
        content: this.editContent
      }  

      axios.post("/rest/post/update.php", data).then(response => {
        console.log(response)
        if (!response.data.error) {
          this.message = response.data.message;
          this.success = true;
          this.error = false;
          this.$refs.contentModal.hide();
          this.listPosts();      
        }
        else {
          this.message = response.data.message;
          this.success = false;
          this.error = true;
        }
        
      })

    },

    clickDelete: function(post) {
      axios.post("/rest/post/delete.php", {id: post.id}).then(response => {
        if (!response.data.error) {
          this.message = response.data.message;
          this.success = true;
          this.error = false;
          this.listPosts();      
        }
        else {
          this.message = response.data.message;
          this.success = false;
          this.error = true;
        }
     })

    },

    changePublic: function(event) {
      console.log(event.target.checked)
      var public = 0;
      if(event.target.checked) {
        public = 1;
      }

      
    }

   
  }

});

//Limpa formulário de artigo
function clearInstance(vue) {
  vue.post.title = null;
  vue.post.date = null;
  vue.post.content = null;
  vue.post.categoryId = null;
  vue.selectedFile = null;

  vue.error = false;

}
