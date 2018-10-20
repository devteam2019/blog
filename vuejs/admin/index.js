//componente de ediacao
Vue.component('ckeditor', {
  template: `<div class="ckeditor"><textarea :id="id" :value="value"></textarea></div>`,
  props: {
    value: {
      type: String
    },
    id: {
      type: String,
      default: 'editor'
    },
    height: {
      type: String,
      default: '200px',
    },
    toolbar: {
      type: Array,
      default: () => [
        ['Undo', 'Redo'],
        ['Bold', 'Italic', 'Strike'],
        ['NumberedList', 'BulletedList'],
        ['Cut', 'Copy', 'Paste'],
      ]
    },
    language: {
      type: String,
      default: 'en'
    },
    extraplugins: {
      type: String,
      default: ''
    }
  },

  mounted() {
    const ckeditorId = this.id
    // console.log(this.value)
    const ckeditorConfig = {
      toolbar: this.toolbar,
      language: this.language,
      height: this.height,
      extraPlugins: this.extraplugins
    }
    CKEDITOR.replace(ckeditorId, ckeditorConfig)
    CKEDITOR.instances[ckeditorId].setData(this.value)
    CKEDITOR.instances[ckeditorId].on('change', () => {
      let ckeditorData = CKEDITOR.instances[ckeditorId].getData()
      if (ckeditorData !== this.value) {
        this.$emit('input', ckeditorData)
      }
    })
  }

});

//logica
new Vue({
  el: '#app',
  data: {
    loading: false,
    categorysData: [],
    postsData: [],
    title: null,
    date: null,
    content: null,
    userId: null,
    categoryId: null,
    userName: null,
    categoryName: null,
    selectedFile: null,
    message: '',
    error: false,
    success: false
  },

  mounted() {
    axios.get("/blog/rest/category/listAll.php").then(response => {
      this.categorysData = response.data.categorys;
    }),

      axios.get("/blog/rest/user/getUserLogger.php").then(response => {
        this.userId = response.data.userId;
      }),

      this.listPosts();

  },

  methods: {

    listPosts() {
      this.loading = true;
      axios.get("/blog/rest/post/listAll.php").then(response => {
        this.postsData = response.data.posts;
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

        axios.post("/blog/rest/post/uploadFile.php", data).then(response => {
          console.log(response.data);
        })
      }
    },

    saveArticle: function () {
      //validações
      if (this.title == '' || this.title == null) {
        this.message = 'O título é obrigatório!';
        this.error = true;
        return;
      }
      if (this.date == '' || this.date == null) {
        this.message = 'A data do artigo é obrigatório!';
        this.error = true;
        return;
      }
      if (this.categoryId == '' || this.categoryId == null) {
        this.message = 'A categoria é obrigatório!';
        this.error = true;
        return;
      }
      if (this.content == '' || this.content == null) {
        this.message = 'O conteúdo do artigo é obrigatório!';
        this.error = true;
        return;
      }

      var imageName = null;
      if (this.selectedFile != null) {
        imageName = this.selectedFile.name;
      }


      var data = {
        title: this.title,
        date: this.date,
        content: this.content,
        image: null,
        userId: this.userId,
        categoryId: this.categoryId
      }

      console.log(data);

      axios.post("/blog/rest/post/save.php", data).then(response => {
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
      this.$refs.myModalRef.show();
    },


  }

});

//çimpa formulário de artigo
function clearInstance(vue) {
  vue.title = null;
  vue.date = null;
  vue.content = null;
  vue.categoryId = null;
  vue.selectedFile = null;

  vue.error = false;

}
