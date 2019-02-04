window.addEventListener("load", function(){
  var filters = [ 'id', 'type', 'sta', 'dsc' ];

  filters.forEach( function (elt) {
    var eleData = document.getElementById(elt);
    console.log(eleData);
    var eleTarget = document.getElementById(elt+'_target');
    eleTarget.innerHTML = 'reach';
    eleData.addEventListener("change", function () {
      eleTarget.innerHTML = eleData.value;
      console.log(eleData.value);
    })  
  });
});

