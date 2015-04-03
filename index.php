<!DOCTYPE html>
<html>
  <head>
    <title>restmovie</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:100">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
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

    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/handlebars.js"></script>
    <script type="text/javascript" src="scripts/typeahead.js"></script>
    <script type="text/javascript" src="scripts/script.js"></script>

    <script id="movie-template" type="text/x-handlebars-template">
      {{#each movies}}
        <div class="col-md-3">
          <img src="{{picture}}" class="max-width">
        </div>
      {{/each}}
    </script>
  </body>
</html>
