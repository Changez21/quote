var quoteTool = angular.module('quoteTool', ['ngRoute', 'ui.bootstrap', 'flow', 'ui.bootstrap.datetimepicker','angular-directive-percentage', 'ng-currency', 'mentio']);

quoteTool.controller('AppController', ['$scope', '$location', 'ROUTES', 'PreQuoteService', function ($scope, $location, ROUTES) {

    return ROUTES;
}]);


quoteTool.directive('stringToNumber', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, ngModel) {
            ngModel.$parsers.push(function (value) {
                return parseFloat(value);
            });
            ngModel.$formatters.push(function (value) {
                return parseFloat(value);
            });
        }
    };
});





