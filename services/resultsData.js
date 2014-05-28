mindBlitzApp.factory('resultsData', [function () {
    var results = {};

    return {
        getResults: function () {
            var localStorge = localStorage.getItem('userScales');
            if (localStorge) {
                results = JSON.parse(localStorage.getItem('userScales'));
                return results;
            }
            //To do: if not

        }
    }
} ]);