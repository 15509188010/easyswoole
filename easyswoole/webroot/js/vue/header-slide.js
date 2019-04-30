var slide = new Vue({
    el: '#owl-demo',
    data: {
        list: [
            { title: 'videos', id: '1' },
            { title: 'videos', id: '1' },
            { title: 'videos', id: '1' },
            { title: 'videos', id: '1' },
            { title: 'videos', id: '1' },
            { title: 'videos', id: '1' },
            { title: 'videos', id: '1' },
            { title: 'videos', id: '1' },
        ],
    },
    mounted: function() {
        this.getList();
    },
    methods: {
        getList: function() {
            axios.post('http://182.61.41.38:8000/api/slide/hot', getData({
                    num: '8',
                    appKey: kAppKey,
                    sign: getSign({ num: '8' }, kAppKey, kAppSecret),
                }), {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(function(response) {
                    slide.list = response.data.result;
                })
                .catch(function(error) {
                    console.log(error);
                })
        },
        handleClick: function(id) {
            location.href = "single.html?id=" + id;
        },
    },
});