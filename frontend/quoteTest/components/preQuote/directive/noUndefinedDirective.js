/**
 * Created by Pedro on 18/02/2016.
 */
quoteTool.directive("noUndefined", function () {
    return {
        require: "ngModel",
        link: function (scope, element, attrs, ctrl) {
            var _isEmpty=function(input){
                if(input==""){
                    return 0;
                }
            };
            element.bind("keyup", function () {
                ctrl.$setViewValue(_isEmpty(ctrl.$viewValue));
            });

        }
    }
});