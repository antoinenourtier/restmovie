<!DOCTYPE html>
<html>
  <head>
    <title>restmovie</title>
    <link rel="stylesheet" href="stylesheets/stylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  </head>
  <body>
    <header class="col-md-12 col-sm-12 col-xs-12">
      <h1 class="title">Restmovie</h1>
    </header>

    <content>
      <input class="typeahead" type="text" placeholder="Films">

      <form class="form-horizontal">
        <div class="form-group">
          <label for="searchMovie" class="col-sm-3 control-label">Rechercher un film</label>
          <div class="col-sm-8">
            <input type="email" class="form-control" id="searchMovie" placeholder="Entre le nom de votre film">
          </div>
        </div>
      </form>
    </content>

    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/typeahead.js"></script>
    <script type="text/javascript" src="scripts/script.js"></script>
  </body>
</html>
