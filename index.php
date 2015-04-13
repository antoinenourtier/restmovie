<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>restmovie</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:100">
    <link rel="stylesheet" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheets/stylesheet.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <header class="col-md-12 col-sm-12 col-xs-12">
          <h1 class="title">Restmovie.</h1>
        </header>
      </div>

      <div class="row">
        <div class="col-sm-8 col-sm-offset-2 mtxl">
          <div class="search-container">
            <input class="col-md-12 col-xs-12 typeahead search" type="search" placeholder="Rechercher un film" />
          </div>

          <div class="search-button">
            <button type="button" class="btn btn-default" aria-label="Left Align">
              <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </button>
          </div>
        </div>
      </div>

      <div id="movies" class="row mtxl"></div>
    </div>

    <div class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modification</h4>
          </div>
          <div class="modal-body">
            <form class="movie-form" name="movie-form">
              <div class="form-group hidden">
                <input type="text" name="id" class="form-control" id="id">
              </div>
              <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" class="form-control" id="title">
              </div>
              <div class="form-group">
                <label for="link">Lien</label>
                <input type="url" name="link" class="form-control" id="link">
              </div>
              <div class="form-group">
                <label for="actors">Acteurs</label>
                <input type="text" name="actors" class="form-control" id="actors">
              </div>
              <div class="form-group">
                <label for="directors">Directeurs</label>
                <input type="text" name="directors" class="form-control" id="directors">
              </div>
              <div class="form-group">
                <label for="picture">Image</label>
                <input type="text" name="picture" class="form-control" id="picture">
                <img id="picture-preview" class="mtl max-width">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="button" class="btn btn-primary" id="btn-movie-form">Mettre à jour</button>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/lodash.min.js"></script>
    <script type="text/javascript" src="scripts/bootstrap.min.js"></script>
    <script type="text/javascript" src="scripts/handlebars.js"></script>
    <script type="text/javascript" src="scripts/typeahead.js"></script>
    <script type="text/javascript" src="scripts/script.js"></script>

    <script id="movie-template" type="text/x-handlebars-template">
      {{#each movies}}
        <div class="col-md-3 movie" data-id="{{id}}">
          <img src="{{picture}}" class="max-width">
        </div>
      {{/each}}
    </script>
  </body>
</html>
