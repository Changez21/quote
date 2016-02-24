quoteTool.controller("preQuoteController", ["$scope", "$window", "$filter", "CONFIG", "VALUES", "PreQuoteService", function ($scope, $window, $filter, CONFIG, VALUES, PreQuoteService) {
    // $scope.rows = [{id: '1', selectedItem: []}, {id: '2', selectedItem: []}];
    $scope.itTraining = 1;
    $scope.isSession = false;
    $scope.error = false;
    $scope.success = false;
    $scope.persons = ["Keith Vinciguerra", "Umair Khan", "Kevin Kritzman"];

    $scope.discSMAInclude = {
        availableOptions: [
            {id: '0', name: 'No'},
            {id: '1', name: 'Yes'}
        ],
        selectedOption: {id: '0', name: 'No'}
    };
    $scope.discThirdPartyInclude = {
        availableOptions: [
            {id: '0', name: 'No'},
            {id: '1', name: 'Yes'}

        ],
        selectedOption: {id: '0', name: 'No'}
    };
    $scope.rows = [{
        id: '1',
        selectedItem: [],
        quantity: 0,
        locations: '',
        notes: '',
        cost: 0,
        labor: 0,
        workflow: 0,
        userTraining: 0,
        goLive: 0,
        custom: 0.00
    }, {
        id: '2',
        selectedItem: [],
        quantity: 0,
        locations: '',
        notes: '',
        cost: 0,
        labor: 0,
        workflow: 0,
        userTraining: 0,
        goLive: 0,
        custom: 0.00
    }];

    $scope.thirdPartyrows = [{
        id: '1',
        selectedDevice: [],
        quantity: 0,
        locations: '',
        notes: '',
        cost: 0
    }];
    $scope.counter = 3;
    $scope.thirdCounter = 2;

    //datepicker
    $scope.datePicker = (function () {
        var method = {};
        method.instances = [];

        method.open = function ($event, instance) {
            console.log(instance);
            $event.preventDefault();
            $event.stopPropagation();
            method.instances[instance] = true;
            console.log(method.instances);
        };
        return method;
    }());

    $scope.verifySession = function () {
        PreQuoteService.isSession(
            function onSuccess(data) {
                if (data === "false") {
                    $scope.isSession = true;
                    $scope.getClient();
                } else {
                    $scope.isSession = false;
                    $window.location.href = CONFIG.urlAddress + "/renew/web/";
                }
            },
            function onError() {
                console.log("Something went wrong");
                $scope.products = [];
            });
    };

    $scope.getClient = function () {
        PreQuoteService.getData(
            function onSuccess(data) {
                $scope.products = data;
            },
            function onError() {
                console.log("Something went wrong");
                $scope.products = [];
            });
        PreQuoteService.getThirdParty(
            function onSuccess(data) {
                $scope.thirdPartyData = data;
            },
            function onError() {
                console.log("Something went wrong requesting Third Party hardware");
                $scope.products = [];
            });


    };


    $scope.setProduct = function (row) {
        row.learning = row.selectedItem.learning;
        row.notes = row.selectedItem.notes;
        row.workflow = row.selectedItem.workflow;
        row.configuration = row.selectedItem.configuration;
        $scope.calcPrice(row);
    };

    $scope.setHardware = function (row) {
        row.notes = row.selectedHardware.notes;
        $scope.calcPrice(row);
    };

    $scope.addRow = function () {
        $scope.rows.push({
            id: $scope.counter,
            selectedItem: [],
            quantity: 0,
            locations: '',
            notes: '',
            cost: 0,
            labor: 0,
            workflow: 0,
            userTraining: 0,
            goLive: 0,
            custom: 0.00
        });
        $scope.counter++;
    };

    $scope.addThirdPartyRow = function () {
        $scope.thirdPartyrows.push({
            id: $scope.thirdCounter,
            selectedDevice: [],
            quantity: 0,
            locations: '',
            notes: '',
            cost: 0
        });
        $scope.thirdCounter++;
    };
    $scope.saveQuote = function (quote, training) {
        $scope.preQuoteArr = [];
        $scope.trainingArr = [];
        $scope.preQuoteArr = quote;
        $scope.trainingArr = training;
        $scope.preQuoteArr = JSON.stringify($scope.preQuoteArr);
        $scope.trainingArr = JSON.stringify($scope.trainingArr);
        angular.forEach($scope.rows, function (item) {
            if (angular.isDefined(item.laborFormula)) {
                $scope.formula = JSON.stringify(item.laborFormula);

            }
        });
        PreQuoteService.sendPreQuote($scope.preQuoteArr, $scope.trainingArr).success(function (data) {
            console.log("data: ");
            console.log(data);
            if (data == "success") {
                $scope.success = true;
                $scope.error = false;
            } else {
                $scope.error = true;
                $scope.success = false;
            }
        }).error(function (data) {
            console.log("Fail:");
            console.log(data);
        });

        //var preQuoteArr=[];
        //angular.forEach($scope.rows, function (item) {
        //    if (angular.isUndefined(item.learning)){
        //        item.learning=item.selectedItem.learning;
        //    }
        //    console.log(item.selectedItem.software);
        //    preQuoteArr['client'+item.id]=item;
        //    preQuoteArr['cost']=item.cost;
        //});
        //if (angular.isUndefined(itTraining)) {
        //    itTraining = "";
        //}
        //if (angular.isUndefined(staffTraining)) {
        //    staffTraining = "";
        //}
        //if (angular.isUndefined(goLive)) {
        //    goLive = "";
        //}
        //preQuoteArr['staffTraining'] = staffTraining;
        //preQuoteArr['itTraining'] = itTraining;
        //preQuoteArr['goLive'] = goLive;
        //console.log(preQuoteArr);
        //PreQuoteService.sendPreQuote(preQuoteArr,
        //    function onSuccess(data) {
        //        console.log(data);
        //    },
        //    function onError(data, status) {
        //
        //        console.log("Something went wrong" + status);
        //    });
    };

    var _checkDefined = function (variable) {
        if (variable == "" || angular.isUndefined(variable) || isNaN(variable) || variable == null) {
            return 0;
        }
        return variable;
    };

    /**
     * CLIENT TABLE CALCULATIONS
     *
     */

    $scope.sumDays = function () {
        $scope.laborDays = $filter('number')(Math.ceil(sumColumn("labor")), 0).replace(",", ".");
        return $scope.laborDays + " days";
    };

    $scope.sumSoftware = function () {
        $scope.totalColSoftware = sumColumn("cost");
        return $scope.totalColSoftware;
    };


    $scope.sumDaysWorkflow = function () {
        $scope.workflowDays = $filter('number')(Math.ceil(sumColumn("workflow")), 0).replace(",", ".");
        return $scope.workflowDays + " days";
    };

    $scope.sumDaysGoLive = function () {
        $scope.goLiveDays = $filter('number')(Math.ceil(sumColumn("goLive")), 0).replace(",", ".");
        return $scope.goLiveDays + " days";
    };

    $scope.sumDaysTraining = function () {
        $scope.userTrainingDays = $filter('number')(Math.ceil(sumColumn("userTraining")), 0).replace(",", ".");
        return $scope.userTrainingDays + " days";
    };


    $scope.sumCustomUnits = function () {
        $scope.units = $filter('number')(sumColumn("custom"), '2').replace(",", ".");
        return $scope.units + " units";
    };

    var sumColumn = function (col) {
        var total = 0;
        var value = 0;

        angular.forEach($scope.rows, function (item) {
            value = _checkDefined(item[col]);
            total = parseFloat(total) + parseFloat(value);
        });
        return total;
    };

    $scope.sumThirdParty = function () {
        var total = 0;
        var value = 0;

        angular.forEach($scope.thirdPartyrows, function (item) {
            value = _checkDefined(item.cost);
            total = parseFloat(total) + parseFloat(value);
        });
        return total;
    };


    $scope.calcPrice = function (row) {
        if (!row.selectedItem || row.quantity == null) {
            return row.cost = 0;
        }
        if ($scope.country == 1) {
            price = row.selectedItem.canadaPrice;
        } else {
            price = row.selectedItem.usPrice;
        }
        row.cost = price * row.quantity;
        $scope.calcLabor(row);
    };

    $scope.calcLabor = function (item) {
        if (item.laborFormula == "" || angular.isUndefined(item.laborFormula)) {
            item.locations = _checkDefined(item.locations);
            if (item.selectedItem.clientType == "Input") {
                item.labor = $filter('number')((parseInt(item.configuration) +
                (parseInt(item.locations) / parseInt(item.learning))), '2')
                    .replace(",", ".");
            }
        } else {
            item.labor = $filter('number')($scope.$eval(item.laborFormula), '2').replace(",", ".");
        }
        $scope.calcWorkflow();
    };

    $scope.calcWorkflow = function (item) {
        var test = _checkDefined(item.workflowFormula);
        console.log("test: " + test);
        if (item.workflowFormula == "" || angular.isUndefined(item.workflowFormula)) {
            item.locations = _checkDefined(item.workflowFormula);
            if (item.selectedItem.clientType == "Input") {
                item.labor = $filter('number')((parseInt(item.configuration) +
                (parseInt(item.locations) / parseInt(item.learning))), '2')
                    .replace(",", ".");
            }
        } else {
            item.labor = $filter('number')($scope.$eval(item.laborFormula), '2').replace(",", ".");
        }
    };

    /**
     * Third Pary Calculations
     */

    $scope.calcThirdPartyPrice = function (line) {
        if (!line.selectedHardware || line.quantity == null) {
            return line.cost = 0;
        }
        if ($scope.country == 1) {
            price = line.selectedHardware.canadaPrice;
        } else {
            price = line.selectedHardware.usPrice;
        }
        line.cost = price * line.quantity;
    };

    /**
     * Professional Services Calculations
     */

    $scope.totalLaborDays = function () {
        $scope.laborDays = _checkDefined($scope.laborDays);
        if ($scope.roleBased == 1) {
            return $filter('number')(Math.ceil($scope.laborDays * 1.3), 0).replace(",", ".");
        } else {
            return $scope.laborDays;
        }
    };

    $scope.customPrice = function () {
        if ($scope.units == "" || angular.isUndefined($scope.units) || $scope.includeCustom == 0) {
            return 0;
        }
        if ($scope.country == 1) {
            return $scope.units * VALUES.customPriceCA;
        } else {
            return $scope.units * VALUES.customPriceUS;
        }
    };

    /**
     * High Availability price at 30%
     * @returns {number}
     */
    $scope.haPrice = function () {
        if ($scope.haOption == 1) {
            $scope.ha = $scope.sumSoftware() * 0.30;
            if ($scope.country == 1) {
                return $scope.ha;
            } else {
                return ($scope.ha) * 1.1;
            }
        }
        return $scope.ha = 0;

    };

    /**
     * SMA price at 15%
     * @returns {number}
     */
    $scope.smaPrice = function () {
        $scope.totalColSoftware = _checkDefined($scope.totalColSoftware);
        $scope.totalSMA = ($scope.ha + $scope.totalColSoftware) * 0.15;
        return $scope.totalSMA
    };

    $scope.installPrice = function () {
        $scope.laborDays = _checkDefined($scope.laborDays);
        if ($scope.country == 1) {
            return $scope.laborDays * VALUES.imPriceCA;
        } else {
            return $scope.totalLaborDays() * VALUES.imPriceUS;
        }
    };

    $scope.workflowPrice = function () {
        $scope.workflowDays = _checkDefined($scope.workflowDays);
        if ($scope.country == 1) {
            return $scope.workflowDays * VALUES.workflowPriceCA;
        } else {
            return $scope.workflowDays * VALUES.workflowPriceUS;
        }
    };

    $scope.trainingPrice = function () {
        if ($scope.country == 1) {
            $scope.totalTraining = ($scope.userTrainingDays + Math.round($scope.itTraining)) * VALUES.trainingPriceCA;
        } else {
            $scope.totalTraining = (parseInt($scope.userTrainingDays) + Math.round($scope.itTraining)) * VALUES.trainingPriceUS;
        }
        $scope.totalTraining = _checkDefined($scope.totalTraining);
        return $scope.totalTraining
    };

    $scope.visitDays = function () {
        $scope.totalDays = (parseInt($scope.userTrainingDays) + Math.round($scope.itTraining) + parseInt($scope.goLiveDays) + parseInt($scope.totalLaborDays()) + parseInt($scope.workflowDays));
        $scope.visit = Math.round($scope.totalDays / 5);
        return "For " + $scope.visit + " visits";
    };

    $scope.visitPrice = function () {
        if ($scope.liveTravel == 1) {
            return "Remote Only";
        } else if ($scope.liveTravel == 2) {
            return "Local";
        } else if ($scope.liveTravel == 0) {
            return $filter('currency')(($scope.visit * VALUES.flight) + (VALUES.hotel * $scope.totalDays));
        } else {
            return $filter('currency')(0);
        }
    };

    $scope.goLivePrice = function () {
        $scope.goLiveDays = _checkDefined($scope.goLiveDays);
        if ($scope.country == 1) {
            var goLive = $scope.goLiveDays * VALUES.goLivePriceCA;
            return goLive;
        } else {
            var goLive = $scope.goLiveDays * VALUES.goLivePriceUS;
            return goLive;
        }
    };

    $scope.subtotal = function () {
        $scope.subTotal = $scope.goLivePrice() + $scope.trainingPrice() + $scope.workflowPrice() + $scope.installPrice();
        $scope.subTotal = _checkDefined($scope.subTotal);
        return $scope.subTotal;
    };

    $scope.calcSVC = function () {
        return $scope.pmPrice() + $scope.subtotal();
    };

    /**
     *Calculates PM Cost
     * If PM = Yes, country=US and Travel and living = Remote and Onsite add 1000$ to pm cost
     * @returns number cost
     */
    $scope.pmPrice = function () {
        if ($scope.country == 1 && $scope.pm == 1) {
            return Math.round($scope.subTotal * 0.25);
        } else if ($scope.pm == 1 && $scope.liveTravel == 0) {
            return Math.round($scope.subTotal * 0.25 + 1000);
        } else if ($scope.pm == 1) {
            return Math.round($scope.subTotal * 0.25);
        } else {
            return 0;
        }
    };

    /**
     * DISCOUNTS
     */

    $scope.discSVCAmount = function () {
        $scope.discSVC = _checkDefined($scope.discSVC);
        $scope.discSVCPercent = _checkDefined($scope.discSVCPercent);
        $scope.totalSVC2 = $scope.pmPrice() + $scope.subtotal();
        $scope.SVCdiscount = calcDiscount($scope.discSVC, $scope.discSVCPercent, $scope.calcSVC());
        return $scope.SVCdiscount;
    };

    $scope.discSoftwareAmount = function () {
        $scope.discSoftware = _checkDefined($scope.discSoftware);
        $scope.discSoftwarePercent = _checkDefined($scope.discSoftwarePercent);
        $scope.softwareAmount = $scope.totalColSoftware + $scope.ha;
        $scope.softwareDiscount = calcDiscount($scope.discSoftware, $scope.discSoftwarePercent, $scope.softwareAmount);
        return $scope.softwareDiscount;
    };

    $scope.discSMAAmount = function () {
        $scope.discSMA = _checkDefined($scope.discSMA);
        $scope.discSMAPercent = _checkDefined($scope.discSMAPercent);

        $scope.smaDiscount = calcDiscount($scope.discSMA, $scope.discSMAPercent, $scope.smaPrice());
        return $scope.smaDiscount;
    };

    $scope.discThirdPartyAmount = function () {
        $scope.discThirdParty = _checkDefined($scope.discThirdParty);
        $scope.discThirdPartyPercent = _checkDefined($scope.discThirdPartyPercent);
        $scope.thirdPartyDiscount = calcDiscount($scope.discThirdParty, $scope.discThirdPartyPercent, $scope.sumThirdParty());
        return $scope.thirdPartyDiscount;
    };

    var calcDiscount = function (amount, percentage, total) {
        return amount + percentage * total;
    };

    /**
     * Total estimates
     */

    $scope.SVCTotal = function () {
        return $scope.totalSVC = calcTotal($scope.discSVCInclude, $scope.calcSVC(), $scope.SVCdiscount);
    };

    $scope.softwareTotal = function () {
        $scope.totalSoftware = parseInt($scope.sumSoftware()) + $scope.ha;
        return $scope.totalSoftware = calcTotal($scope.discSoftwareInclude, $scope.totalSoftware, $scope.softwareDiscount);
    };

    $scope.smaTotal = function () {
        return $scope.totalSMA = calcTotal($scope.discSMAInclude, $scope.totalSMA, $scope.smaDiscount);

    };
    $scope.thirdPartyTotal = function () {
        $scope.totalThirdParty = calcTotal($scope.discThirdPartyInclude, $scope.sumThirdParty(), $scope.thirdPartyDiscount);
        return $scope.totalThirdParty
    };

    var calcTotal = function (includeDisc, totalPrice, discount) {
        if (includeDisc == 1) {
            return totalPrice - discount;
        }
        return totalPrice;
    };

    $scope.grandTotal = function () {
        $scope.travel_living=_checkDefined($scope.travel_living);
        return $scope.SVCTotal() + $scope.softwareTotal() + $scope.thirdPartyTotal() + $scope.travel_living+$scope.smaTotal()
    };
}]);

