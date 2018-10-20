//classe responsável por manipular a parte inicial do blog

new Vue({
  el:"#app",
  data: {
    postsData: []
  },
  created: function(){
     axios.get('/blog/rest/post/listAll.php').then(response => {
       this.postsData = response.data.posts;
       console.log(this.postsData);
     });
  }

})
