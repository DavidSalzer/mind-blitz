mindBlitzApp.factory('resultsData', [function () {
    var results = {};

    return {
        getResults: function () {
            var localStorge = localStorage.getItem('userScales');
            if (localStorge) {
                results = JSON.parse(localStorage.getItem('userScales'));
                return results;
            }
            else{
                results = {
        "visualTextual": "5",
        "independentSocial": "5",
        "bouncyLinear": "5",
        "activePassive": "5",
        "autodidacticFramed": "5",
        "gamesSerious": "5",
        "subjectInterdisciplinary": "5"
    }
            }
            //To do: if not

        }
    }
} ]);