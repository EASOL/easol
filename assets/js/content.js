$(function () {

    function createFilters(id) {
       var options = {
         valueNames: [ 'filter-name', 'filter-count' ]
        };

       var filterList = new List(id, options);
       filterList.sort('filter-count', { order: "desc" });        
    }

    function ready() {
        ['publishers-list', 'standards-list'].forEach(function (filterName){
            createFilters(filterName);
        })
    }

    $(document).ready(ready);

})