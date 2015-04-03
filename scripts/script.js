Handlebars.registerHelper('each', function(context, options) {
  var ret = '';

  for (var i = 0, j = context.length; i < j; i++) {
    ret = ret + options.fn(context[i]);
  }

  return ret;
});

$(window).load(function() {
  var source = $('#movie-template').html();
  var template = Handlebars.compile(source);

  $.ajax({
    url: '/api/movies',
    type: 'GET',
    success: function(data) {
      if (data.length > 0) {
        var array = {};
        array.movies = data;
        var html = template(array);
        $('#movies').html(html);
      }
    }
  });


  var movies = new Bloodhound({
    datumTokenizer: function(m) {return m.title; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: '/api/allocine/%QUERY'
  });

  movies.initialize();

  $('.typeahead').typeahead(null, {
    name: 'movies',
    displayKey: 'title',
    source: movies.ttAdapter(),
    templates: {
      suggestion: Handlebars.compile('<div class="clearfix mbl"><img src="{{picture}}" class="picture pull-left mrm"><p class="h2 mtl">{{title}}</p></div>')
    }
  }).on('typeahead:selected', function (obj, data) {
    $.ajax({
      url: '/api/movies',
      data: data,
      type: 'POST',
      success: function(data) {}
    });
  });
});
