"use strict";
quoteTool.constant("CONFIG", {
    /* Main configurations */
    urlAddress: "http://localhost",
    getClient:"/renew/web/client/get-clients",
    getThirdParty:"/renew/web/third-party/get-third-party",
    checkSession:"/renew/web/user/check-session",
    createPreQuote:"/renew/web/pre-quote/create"
});
//quoteTool.constant("MENUOPTIONS",{
//    values: {
//        availableOptions: [
//            {id: '0', name: 'No'},
//            {id: '1', name: 'Yes'}
//        ],
//        selectedOption: {id: '0', name: 'No'}
//    }
//});

quoteTool.constant("VALUES",{
    customPriceUS:13750,
    customPriceCA:12500,
    laborPriceUS:1328,
    laborPriceCA:1200,
    workflowPriceUS:1650,
    workflowPriceCA:1500,
    trainingPriceUS:1650,
    trainingPriceCA:1500,
    goLivePriceUS:1320,
    goLivePriceCA:1200,
    imPriceUS:1320,
    imPriceCA:1200,
    flight:1500,
    hotel:250
});
quoteTool.constant("ROUTES", {
    root: "/"
});