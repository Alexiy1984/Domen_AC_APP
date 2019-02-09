$(document).ready(function() {

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

  $('.domainsPG__collumns').each(function(index) {
    var name = $(this).text();
    console.log(name);
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

  $('#DomainsPG tbody tr').each( function () {
    $(this).contextmenu(function(evt) {
      evt.preventDefault();
      evt.stopPropagation();
      currData = ( table.row( this ).data() );
      PopUpShow();
    });
  });
  
  PopUpHide();

  function refreshPW() {
    PopUpHide();
    $('.data').hide();
    $('.addRow').show();
    $('.editRow').show();
  }

  $(document).keyup(function(e) {
    if (e.keyCode === 27) {
      refreshPW();
    }
  });

  $(popupWindow).on('click', function () {
    refreshPW();
  });

  function PWRowInsert() {
    currData = ( table.row( 0 ).data() );
    currData.forEach(function(item, index) {
      var colname = $('.domainsPG__collumns span')[index].textContent;
      $('.PWInner').append('<label for="' + colname + '" class="data">' + colname + '</label>');
      $('.PWInner').append('<input name="' + colname + '" id="' + colname + '" class="data" type="text"/>');
    });
    $('.PWInner').append('<input name="submit" class="data" value="submit" type="submit"/>');
    $('.data').hide();
  }

  PWRowInsert();
  
  function PWDataInsert(oper) {
    currData.forEach(function(item, index) {
      var colname = $('.domainsPG__collumns span')[index].textContent;
      oper == 'edit' ? $('.PWInner input[name='+ colname +']').attr('value', item) : 
      $('.PWInner input[name='+ colname +']').attr('value', '');
    });
    $('.PWInner input[name="submit"]').attr('value', oper);
  }

  $('.addRow').on('click', function (evt) {
    evt.preventDefault();
    evt.stopPropagation();
    $('.addRow').hide();
    $('.editRow').hide();
    $('.data').show();
    PWDataInsert('add');
  });

  $('.editRow').on('click', function (evt) {
    evt.preventDefault();
    evt.stopPropagation();
    $('.addRow').hide();
    $('.editRow').hide();
    $('.data').show();
    PWDataInsert('edit');
  });

  $(popupWindow).on('click', '.data', function (evt) {
    evt.stopPropagation();

  });

  $('#DomainsPG thead th').each( function () {
    $(this).on('click', 'input', function (evt) {
      evt.stopPropagation();
    });
    var title = $(this).text();
    $(this).append( '<p class="pt-1"><input class="float-left" type="text" placeholder="Search '+title+'" /></p>' );
  });

});

function PopUpShow(){
  $("#popupWindow").show();
}
function PopUpHide(){
  $("#popupWindow").hide();
}
