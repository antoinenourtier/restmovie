$(window).load(function() {
   var movies = new Bloodhound({
    datumTokenizer: function(m) {return m.title; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: '/api/autocomplete',
    remote: '/api/allocine/%QUERY'
  });

  movies.initialize();

  $('.typeahead').typeahead(null, {
    name: 'movies',
    displayKey: 'title',
    source: movies.ttAdapter()
  }).on('typeahead:selected', function (obj, data) {
    $.ajax({
      url: '/api/movies',
      data: data,
      type: 'POST',
      success: function(data) {
        alert('Nickel !');
      }
    });
  });
});
