var movies = [];

// Handlebars helper to each over data
Handlebars.registerHelper('each', function(context, options) {
  var ret = '';

  for (var i = 0, j = context.length; i < j; i++) {
    ret = ret + options.fn(context[i]);
  }

  return ret;
});

// populate data
var populate = function() {
  var template = Handlebars.compile($('#movie-template').html());
  var array = {};

  array.movies = movies;
  $('#movies').html(template(array));
};

// update function
$('#btn-movie-form').on('click', function() {
  var form = $('.movie-form').serialize();

  $.ajax({
    url: '/api/movies',
    data: form,
    type: 'PUT',
    success: function(data) {
      var idx = _(movies).map(function(m) { return m.id; }).indexOf($('#id').val());

      movies.splice(idx, 1);
      movies.push(data);

      setTimeout(function() {
        $('.modal').modal('hide');
        populate();
      }, 500);
    }
  });
});

// open modal
$('body').on('click', '.movie', function() {
  var id = $(this).data('id');

  var movie = _(movies).find(function(m) {
    return m.id == id;
  });

  var $form = $('.movie-form');
  $form.find('#id').val(movie.id);
  $form.find('#title').val(movie.title);
  $form.find('#link').val(movie.link);
  $form.find('#actors').val(movie.actors);
  $form.find('#directors').val(movie.directors);
  $form.find('#picture').val(movie.picture);
  $form.find('#picture-preview').attr('src', movie.picture);

  $('.modal').modal('show');
});

$(window).load(function() {
  // populate data
  $.ajax({
    url: '/api/movies',
    type: 'GET',
    success: function(data) {
      if (data.length > 0) {
        movies = data;
        populate();
      }
    }
  });

  var allocineData = new Bloodhound({
    datumTokenizer: function(m) {return m.title; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: '/api/allocine/%QUERY'
  });

  var imdbData = new Bloodhound({
    datumTokenizer: function(m) {return m.title; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: '/api/imdbData/%QUERY'
  });

  var moviesData = new Bloodhound({
    datumTokenizer: function(m) {return m.title; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: '/api/autocomplete/%QUERY'
  });

  allocineData.initialize();
  imdbData.initialize();
  moviesData.initialize();

  $('.typeahead').typeahead(null, {
    name: 'movies',
    displayKey: 'title',
    source: allocineData.ttAdapter(),
    templates: {
      suggestion: Handlebars.compile('<div class="clearfix mbl"><img src="{{picture}}" class="picture pull-left mrm"><p class="h2 mtl">{{title}}</p></div>')
    }
  }, {
    name: 'movies',
    displayKey: 'title',
    source: imdbData.ttAdapter(),
    templates: {
      suggestion: Handlebars.compile('<div class="clearfix mbl"><img src="{{picture}}" class="picture pull-left mrm"><p class="h2 mtl">{{title}}</p></div>')
    }
  },{
    name: 'movies',
    displayKey: 'title',
    source: moviesData.ttAdapter(),
    templates: {
      suggestion: Handlebars.compile('<div class="clearfix mbl"><img src="{{picture}}" class="picture pull-left mrm"><p class="h2 mtl">{{title}} <small>(en local)</small></p></div>')
    }
  }).on('typeahead:selected', function (obj, data) {
    if (!data.id) {
      // create action
      $.ajax({
        url: '/api/movies',
        data: data,
        type: 'POST',
        success: function(data) {
          movies.push(data);
          populate();
        }
      });
    }
  });
});
