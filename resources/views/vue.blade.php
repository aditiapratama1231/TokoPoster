<html>
<body>
<div id="app">
    @{{ message }}}
</div>
</body>
<script type="text/javascript" src="https://unpkg.com/vue@2.5.9/dist/vue.js"></script>
<script>
    var app = new Vue({
    el: '#app',
    data: {
        message: 'Hello Adit!'
    }
    })
   </script> 
</html>