quoteTool.factory("PreQuoteService", ["$http", "CONFIG", "$timeout", "$httpParamSerializer", function ($http, CONFIG, $timeout, $httpParamSerializer) {
    return {
        isSession: function (onSuccess, onError) {
            $timeout(function () {
                $http.get(CONFIG.urlAddress + CONFIG.checkSession, {})
                    .success(function (data, status) {
                        onSuccess(data);
                    }).error(function (data, status, headers, config) {
                    onError();
                });
            }, CONFIG.loadingTimeout * 1000);
        },
        getData: function (onSuccess, onError) {
            $timeout(function () {
                $http.get(CONFIG.urlAddress + CONFIG.getClient, {})
                    .success(function (data, status) {
                        onSuccess(data);
                    }).error(function (data, status, headers, config) {
                    onError();
                });
            }, CONFIG.loadingTimeout * 1000);
        },

        getThirdParty: function (onSuccess, onError) {
            $timeout(function () {
                $http.get(CONFIG.urlAddress + CONFIG.getThirdParty, {})
                    .success(function (data, status) {
                        onSuccess(data);
                    }).error(function (data, status, headers, config) {
                    onError();
                });
            }, CONFIG.loadingTimeout * 1000);
        },

        sendPreQuote:function(quoteContent,trainingContent){
            return $http({
                method:"post",
                url:CONFIG.urlAddress+CONFIG.createPreQuote,
                data:"PreQuote="+quoteContent+"&Training="+trainingContent,
                headers:{'Content-Type':'application/x-www-form-urlencoded'}
            });
        }
        //sendPreQuote: function (quote, onSuccess, onError) {
        //    var config = {
        //        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        //    };
        //    $timeout(function () {
        //        $http.post(CONFIG.urlAddress + CONFIG.createPreQuote, $httpParamSerializer(quote), config)
        //            .success(function (data) {
        //                onSuccess(data);
        //            }).error(function (response, status, headers, config) {
        //
        //            onError(response,status);
        //        });
        //    }, CONFIG.loadingTimeout * 1000);
        //}
    };
}]);

