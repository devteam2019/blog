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
        default: '90px',
      },
      toolbar: {
        type: Array,
        default: () => [
          ['Undo','Redo'],
          ['Bold','Italic','Strike'],
          ['NumberedList','BulletedList'],
          ['Cut','Copy','Paste'],
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
		beforeUpdate () {
      const ckeditorId = this.id
      if (this.value !== CKEDITOR.instances[ckeditorId].getData()) {
        CKEDITOR.instances[ckeditorId].setData(this.value)
      }
		},
		mounted () {
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
		},
		destroyed () {
      const ckeditorId = this.id
      if (CKEDITOR.instances[ckeditorId]) {
        CKEDITOR.instances[ckeditorId].destroy()
      }
		}

});

//logica
new Vue({
  el: '#app',
  data: {
    content: null,
    categorysData: [],
    categoryId: null,
    title: null,
    date: null,
    userId: null,
    selectedFile: null,
    nameFile: 'Selecionar Capa',
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
    })

  },

  methods: {
    
    onUploadFile: function(event) {
      this.selectedFile = event.target.files[0];
      //console.log(this.selectedFile)
      if(this.selectedFile != null && !this.selectedFile.type.includes("image")) {
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

    saveArticle: function() {
       //validações
       if(this.title == '' || this.title == null) {
           this.message = 'O título é obrigatório!';
           this.error = true;
           return;
       }
       if(this.date == '' || this.date == null) {
          this.message = 'A data do artigo é obrigatório!';
          this.error = true;
          return;
       }
       if(this.categoryId == '' || this.categoryId == null) {
          this.message = 'A categoria é obrigatório!';
          this.error = true;
          return;
       }
       if(this.content == '' || this.content == null) {
          this.message = 'O conteúdo do artigo é obrigatório!';
          this.error = true;
          return;
       }

       var imageName = null;
       if(this.selectedFile != null) {
          imageName = this.selectedFile.name;
       }

       var data = {
         title: this.title,
         date: this.date,
         content: this.content,
         image: imageName,
         userId: this.userId,
         categoryId: this.categoryId
       }
     
       axios.post("/blog/rest/post/save.php", data).then(response => {
           if(response.data.error) {
              this.message = response.data.message;  
              this.error = true;
              this.success = false;
           }
           else {
              this.message = response.data.message;
              this.success = true;
              this.error = false;
              clearInstance(this);
              
           }
       })
    },

    clickCancel: function() {
      clearInstance(this);
    },

    clickClose: function() {
      clearInstance(this);
    }

  }

});

function clearInstance(vue) {
  vue.title = null;
  vue.date = null;
  vue.content = null;
  vue.nameFile = 'Selecionar Capa';
  vue.categoryId = null;

  vue.error = false;
}
