//classe responsável por manipular a parte inicial do blog

new Vue({
  el: "#app",
  data: {
    loading: true,
    showListArticle: false,
    viewArticle: false,
    postsData: [],
    categorysData: [],
    selectedPost: null,
    isInfo: false,
    message: ''
  },
  created() {
    setTimeout(() => {
      this.loading = false;
    }, 1000);
  },

  mounted() {
    axios.get('/rest/post/listPostsPublics.php').then(response => {
      this.postsData = response.data.posts;
      this.showListArticle = true;
    }),
      axios.get("/rest/category/listAll.php").then(response => {
        this.categorysData = response.data.categorys;
      })

  },

  methods: {
    clickReadArticle: function (post) {
      this.showListArticle = false;
      this.viewArticle = true;
      this.selectedPost = post;
    },

    clickBackArticle: function () {
      this.showListArticle = true;
      this.viewArticle = false;
      this.selectedPost = null;
    },

    clickCategory: function (category) {
      this.loading = true;
      this.showListArticle = false;
      axios.get('/rest/post/listPostsByCategory.php', { nameCategory: category.name }).then(response => {
        if(response.data.error) {
          console.log("não veio nada")
           this.message = response.data.message;
           this.isInfo = true;
           //tempo de espera da mensagem
           messageTimeInstance(this);
        }
        else {
          this.postsData = response.data.posts;
        }
        this.loading = false;
        this.showListArticle = true;
      })
    }
  }

})

function messageTimeInstance(vue) {
  setInterval(function() { 
    vue.isInfo = false;
  }, 8000);
} 
