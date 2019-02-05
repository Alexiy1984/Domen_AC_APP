window.addEventListener("load", function(){
  var onchangeFilters = [ 'ind', 'name', 'dsc', 'sta' ];
  var onclickFilters = [ 'sta' ];
  var textFilters = [];

  if (textFilters) {
    textFilters.forEach( function (elt) {
      var eleData = document.getElementById(elt);
      //var eleTarget = document.getElementById(elt+'_target');

      eleData.addEventListener('input', function () {  
        //eleTarget.innerHTML= eleData.value; 
        //eleTarget.value= eleData.value;
        document.getElementById('filterform').submit();
      })  
    });
  };

  onchangeFilters.forEach( function (elt) {
    var eleData = document.getElementById(elt);
    //var eleTarget = document.getElementById(elt+'_target');
    
    eleData.addEventListener('change', function () {
      //eleTarget.innerHTML= eleData.value; 
      //eleTarget.value= eleData.value;
      document.getElementById('filterform').submit();
    })  
  });

  // onclickFilters.forEach( function (elt) {
  //   var eleData = document.getElementById(elt);

  //   eleData.addEventListener('click', function () {
  //     document.getElementById('filterform').submit();
  //   })  
  // });

});

