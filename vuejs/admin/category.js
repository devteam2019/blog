

new Vue({
  el: '#app',
  data: {
     name: null,
     message: '',
     error: false,
     success: false
  },
  methods: {
    clickSave: function() {
      console.log("teste")
      console.log(this.name)

      this.message = '';
      this.success = false;
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
          this.message = response.data.message;
          this.success = true;
        }

      })

    }

  }

})
