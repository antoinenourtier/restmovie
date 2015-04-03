Handlebars.registerHelper('each', function(context, options) {
  var ret = '';

  for (var i = 0, j = context.length; i < j; i++) {
    ret = ret + options.fn(context[i]);
  }

  return ret;
});

$(window).load(function() {
  var movies = [];
  var source = $('#movie-template').html();
  var template = Handlebars.compile(source);

  var populate = function() {
    var array = {};
    array.movies = movies;
    var html = template(array);
    $('#movies').html(html);
  };

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


  var remoteData = new Bloodhound({
    datumTokenizer: function(m) {return m.title; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: '/api/allocine/%QUERY'
  });

  var moviesData = new Bloodhound({
    datumTokenizer: function(m) {return m.title; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: '/api/autocomplete/%QUERY'
  });

  remoteData.initialize();
  moviesData.initialize();

  $('.typeahead').typeahead(null, {
    name: 'movies',
    displayKey: 'title',
    source: remoteData.ttAdapter(),
    templates: {
      suggestion: Handlebars.compile('<div class="clearfix mbl"><img src="{{picture}}" class="picture pull-left mrm"><p class="h2 mtl">{{title}}</p></div>')
    }
  }, {
    name: 'movies',
    displayKey: 'title',
    source: moviesData.ttAdapter(),
    templates: {
      suggestion: Handlebars.compile('<div class="clearfix mbl"><img src="{{picture}}" class="picture pull-left mrm"><p class="h2 mtl">{{title}} <small>(en local)</small></p></div>')
    }
  }).on('typeahead:selected', function (obj, data) {
    $.ajax({
      url: '/api/movies',
      data: data,
      type: 'POST',
      success: function(data) {
        movies.push(data);
        populate();
      }
    });
  });
});
