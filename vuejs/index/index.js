//classe responsável por manipular a parte inicial do blog

new Vue({
  el:"#app",
  data: {
    postsData: []
  },
  created: function(){
     axios.get('/rest/post/listPostsPublics.php').then(response => {
       this.postsData = response.data.posts;
     });
  }

})
