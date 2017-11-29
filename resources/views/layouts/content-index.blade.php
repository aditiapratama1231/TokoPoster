<h1 class="my-4"></h1>

      <!-- Portfolio Section -->
      <h2>All Poster</h2>

      <div class="row card-items">
        <div class="col-md-4 portfolio-item" v-for="poster in posters">
          <div class="card h-75">
            {{--  <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>  --}}
            <div class="card-header">
                <p class="center">@{{ poster.poster_name }}</p>
            </div>
            <div class="card-body">
               <a href="#"><img class="card-img-top" :src="poster.poster_image.filename" alt=""></a>
               <p></p>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>