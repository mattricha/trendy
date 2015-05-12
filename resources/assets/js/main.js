
/* MASONRY APP */

var appMasonry = angular.module('masonryApp', ['ngRoute','wu.masonry'])

.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}])

.controller('masonryController', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams) {

    $scope.loading = false;
    $scope.homeArticles = [];
    $scope.articletypes = [];

    $scope.init = function() {
        $scope.loading = true;

        $http.get('/home/articletypes').
        success(function(data, status, headers, config) {
            $scope.articletypes = data;
        });

        $http.get('/home/articles').
        success(function(data, status, headers, config) {
            $scope.homeArticles = data;
        });

        $scope.loading = false;
    };

    $scope.init();

}]);



/*  MISC  */


/* scroll to top */

function scrollToTop(){
    $('html, body').animate({scrollTop : 0},400);
}
