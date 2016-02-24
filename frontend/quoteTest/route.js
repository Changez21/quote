quoteTool.config(["$routeProvider", "ROUTES", function ($routeProvider, ROUTES) {
    $routeProvider
        .otherwise({
            templateUrl: 'components/preQuote/views/createPreQuote.html',
           controller:'preQuoteController'

        });
}]);