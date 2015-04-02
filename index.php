<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <title>restmovie</title>
  </head>
  <body>
    <header class="col-md-12 col-sm-12 col-xs-12">
      <h1 class="title">Restmovie</h1>
    </header>
    <content class="">
      <div id="bloodhound">
        <input class="typeahead" type="text" placeholder="States of USA">
      </div>
      <form class="form-horizontal">
        <div class="form-group">
          <label for="searchMovie" class="col-sm-3 control-label">Rechercher un film</label>
          <div class="col-sm-8">
            <input type="email" class="form-control" id="searchMovie" placeholder="Entre le nom de votre film">
          </div>
        </div>
      </form>
    </content>
  </body>
</html>
