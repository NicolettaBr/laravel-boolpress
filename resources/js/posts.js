//alert('test vue');

const { default: Axios } = require("axios");

var app =new Vue({

    el: '#root',
    data: {
        title: 'Questi sono i post visualizzati con Vue',
        posts: []
    },

    mounted() {
        Axios.get('http://127.0.0.1:8000/api/posts')
             .then(result => {

                //console.log(result);

                this.posts = result.data.posts
                //console.log(this.posts);
             });
    }

});