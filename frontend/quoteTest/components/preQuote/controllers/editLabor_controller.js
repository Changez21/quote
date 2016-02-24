quoteTool.controller('imageController', ['$scope', function ($scope) {
    $scope.imageShowModal = function (item,field) {
        $scope.field=field;
        $scope.item = item;
        $scope.initLearning = item.learning;
        $scope.initconfig = item.configuration;
        $scope.initformula = item.formula;
        $scope.variables = [
            {label: 'item.canadaPrice'},
            {label: 'item.learning'},
            {label: 'item.configuration'},
            {label: 'item.cost'}, {label: 'item.locations'}, {label: 'item.custom'},
            {label: 'item.quantity'}, {label: 'item.workflow'}
        ];
        // "item.canadaPrice","item.cost","item.quantity","item.locations","item.custom"];
    };

    $scope.getVariableText = function (item) {
        return item.label;
    };

    $scope.eval = function (v) {
        try {
            $scope.ans = $scope.$eval(v);
        } catch (e) {
        }
    };

    $scope.close = function () {
        $scope.item = "";
        $scope.ans = "";
        $scope.item.laborFormula = "";
    };

    $scope.cancel = function () {
        $scope.item.learning = $scope.initLearning;
        $scope.item.configuration = $scope.initconfig;
        $scope.item.formula = $scope.initformula;
        $scope.close();
    };

    $scope.updateFormula = function (formula) {
        $scope.item.laborFormula = formula;
        $scope.item.workflowFormula="";
        $scope.ans = "";
        $scope.calcLabor($scope.item);
    };


}]);
