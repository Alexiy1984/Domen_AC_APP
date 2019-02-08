$(document).ready(function() {

  $('#DomainsPG thead th').each( function () {
    $(this).on('click', 'input', function (evt) {
      evt.stopPropagation();
    });
    var title = $(this).text();
    $(this).html( '<input class="float-left" type="text" placeholder="Search '+title+'" />' );
  } );
 

  var table = $('#DomainsPG').DataTable( {
    "order": [[ 1, "asc" ]],
    "paging":   true,
    "ordering": true,
    "info":     true,
    "searching": true,
    "stateSave": true,
    "pagingType": "full_numbers",
    pageLength : 5,
    lengthMenu: [[5, 10, 20, 50], [5, 10, 20, 50]]
  });

  table.columns().every( function () {
    var that = this;

    $( 'input', this.header() ).on( 'keyup change', function () {
      if ( that.search() !== this.value ) {
        that
          .search( this.value )
          .draw();
      }
    } );
  } );
});

