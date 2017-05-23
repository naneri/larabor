Vue.http.headers.common['X-CSRF-TOKEN'] =  $('meta[name="csrf-token"]').attr('content');

var app = new Vue({
    el: '#comments',
    data : {
        comments: [],
        newComment: {
            text: ""
        }
    },
    components: {
        VPaginator: VuePaginator
    },
    methods: {
        addComment: function(comment){
            var vm = this;
            this.$http.post($('meta[name="item-url"]').attr('content'), comment)
                .then(function(response){
                    toastr.success(response.data.result);
                    comment.text = "";
                    this.$refs.vpaginator.fetchData();
                    document.getElementById('comments').scrollIntoView();
                }).catch(function (error) {
                    if(error.data){
                        toastr.error(error.data.text[0]);
                    }
                })
        }
    }
});