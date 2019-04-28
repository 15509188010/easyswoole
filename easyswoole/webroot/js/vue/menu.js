var menu = new Vue({
    el: '#menu',
    data: {
        video: [],
        category: [],
    },
    mounted: function() {
        // this.getVideo();
        this.getCategory();
    },
    methods: {
        // getVideo: function() {
        //     axios.post('http://182.61.41.38:8000/api/video/list', {
        //             id: '2',
        //         })
        //         .then(function(response) {
        //             menu.video = response.data.msg;
        //         })
        //         .catch(function(error) {
        //             console.log(error);
        //         })
        // },
        getCategory: function() {
            axios.post('http://182.61.41.38:8000/api/menu/category', {

                })
                .then(function(response) {
                    menu.category = response.data.result;
                })
                .catch(function(error) {
                    console.log(error);
                })
        },
    },
})