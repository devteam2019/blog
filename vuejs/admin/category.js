

new Vue({
  el: '#app',
  data: {
     loading: false,
     name: null,
     message: '',
     error: false,
     categorysData: []
  },
  mounted() {
    this.listAllCategory();
  },
  methods: {

    listAllCategory() {
        this.loading = true;
        axios.get("/blog/rest/category/listAll.php").then(response => {
          this.categorysData = response.data.categorys;
          this.loading = false;
        })
    },

    clickSave: function() {
      this.message = '';
      this.error = false;

      if(this.name == '' || this.name == null) {
          this.message = 'O nome da categoria é obrigatório.';
          this.error = true;
          return;
      }

      axios.post("/blog/rest/category/save.php", {name: this.name}).then(response => {
        if(response.data.error) {
           this.message = response.data.message;
           this.error = true;
        }
        else {
          this.name = '';
          this.listAllCategory();
        }

      })

    },

    clickDelete: function(category) {
      this.error = false;
      axios.post("/blog/rest/category/remove.php", {id: category.id}).then(response => {
        if(!response.data.error) {
           this.listAllCategory();
        }
      })

    }

  }

})
