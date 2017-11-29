<html>
<head>
    @include('includes.head')
</head>
    <body>

{{--  navbar  --}}
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
        @include('includes.navbar')
    </nav>

{{--  header  --}}
    <header>
        @include('includes.header')
    </header>

{{--  content  --}}
    <div class="container">
        @include('layouts.content-index')
    </div>

{{--  footer  --}}
@include('includes.footer')
   <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
   <script>
    new Vue({
        el: '.card-items',
        data: {
            posters: [],
        },
        mounted(){
            this.getData('api/v1/posters');
        },
        methods: {
            getData(url) {
                axios.get(url).then((response) => {
                    this.posters = response.data.data
                })
            }
        }
    })
    
   </script> 
</html>