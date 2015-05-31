
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

/* article page app */

var appArticlePage = angular.module('articlePageApp', ['ngRoute'])

.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}])

.controller('articlePageController', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams) {

    var ite = 0;
    var length = 0;
    var imgUrl = "";
    var imgHeight;
    var imgWidth;

    $scope.init = function() {
        length = articleImages.length;
    };

    // set image size based on viewport vh vw, and keep aspect ratio of image
    $scope.setImgSize = function(){
        var img = $(".overlay-image");
        // Create dummy image to get real width and height
        $("<img>").attr("src", $(img).attr("src")).load(function(){
            imgWidth = this.width;
            imgHeight = this.height;
            if(imgHeight > imgWidth){
                ratio = imgWidth / imgHeight;
                maxratio = imgHeight / imgWidth;
                newWidth = (60 * ratio) + "vw";
                newMaxHeight = (70 * maxratio) + "vh";
                maxHeight = imgHeight + 'px';
                $('.overlay-image').css('width', newWidth);
                $('.overlay-image').css('height', '60vw');
                $('.overlay-image').css('max-width', '70vh');
                $('.overlay-image').css('max-height', newMaxHeight);
            }
            else{
                ratio = imgHeight / imgWidth;
                maxratio = imgWidth / imgHeight;
                newHeight = (70 * ratio) + "vw";
                newMaxWidth = (70 * maxratio) + "vh";
                maxHeight = imgHeight + 'px';
                $('.overlay-image').css('width', '70vw');
                $('.overlay-image').css('height', newHeight);
                $('.overlay-image').css('max-width', newMaxWidth);
                $('.overlay-image').css('max-height', '70vh');
            }
        });
    };

    $scope.closeOverlay = function(){
        //$('body').css('position','static');
        //$('body').css('overflow-y','auto');
        $('.overlay-wrapper').fadeOut("slow");
    };

    $scope.openOverlay = function(){
        //$('body').css('position','fixed');
        //$('body').css('overflow-y','scroll');
        $('.overlay-wrapper').fadeIn("slow");
    };

    $scope.showImage = function(imgWeight){
        $scope.openOverlay();
        ite = imgWeight - 1;
        imgUrl = "/img/articles/500W/" + articleImages[ite].articleID + "/" + articleImages[ite].name;
        $(".overlay-image").attr('src',imgUrl);
        $scope.setImgSize();
    };

    $scope.nextImage = function(){
        if((ite + 1) < length){
            ite = ite + 1;
        }
        else{
            ite = 0;
        }
        imgUrl = "/img/articles/500W/" + articleImages[ite].articleID + "/" + articleImages[ite].name;
        $(".overlay-image").attr('src',imgUrl);
        $scope.setImgSize();
    };

    $scope.prevImage = function(){
        if(ite === 0){
            ite = length - 1;
        }
        else{
            ite = ite - 1;
        }
        imgUrl = "/img/articles/500W/" + articleImages[ite].articleID + "/" + articleImages[ite].name;
        $(".overlay-image").attr('src',imgUrl);
        $scope.setImgSize();
    };

    $scope.init();

}]);


/* browse page app */

var appBrowse = angular.module('browseApp', ['ngRoute', 'vAccordion', 'angularUtils.directives.dirPagination'])

.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}])

.controller('browseController', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams) {

    $scope.loading = false;
    $scope.articles = [];
    $scope.articletypes = [];
    $scope.articlesubtypes = [];

    $scope.itemsByPage=9;

    var url = "";
    var type = 0;
    var subtype = 0;
    var page = 0;

    $scope.init = function() {
        $scope.loading = true;

        $http.get('/browse/articletypes').
        success(function(data, status, headers, config) {
            $scope.articletypes = data;
        });

        $http.get('/browse/articlesubtypes').
        success(function(data, status, headers, config) {
            $scope.articlesubtypes = data;
        });

        if(typeof browseTypeID !== 'undefined'){
            $scope.selectType(browseTypeID);
            //$scope.accordion.toggle(browseTypeID);
        }
        else if(typeof browseSubtypeID !== 'undefined'){
            $scope.selectSubtype(browseSubtypeID);
            //$scope.accordion.toggle(browseSubtypeID);
        }
        else{
            $http.get('/browse/articles/0').
            success(function(data, status, headers, config) {
                $scope.articles = data;
            });
        }

        $scope.loading = false;
    };

    $scope.selectType = function(typeID) {
        type = typeID;
        url = "/browse/type/" + typeID + "/0";
        $http.get(url).
        success(function(data, status, headers, config) {
            $scope.articles = data;
        });
    };

    $scope.selectSubtype = function(subtypeID) {
        subtype = subtypeID;
        url = "/browse/subtype/" + subtypeID + "/0";
        $http.get(url).
        success(function(data, status, headers, config) {
            $scope.articles = data;
        });
    };

    $scope.selectAll = function() {
        type = 0;
        subtype = 0;
        $http.get('/browse/articles/0').
        success(function(data, status, headers, config) {
            $scope.articles = data;
        });
    };

    $scope.init();

}]);


/* functions */


function scrollToTop(){
    $('html, body').animate({scrollTop : 0},400);
}


/* events */

$( document ).ready(function() {
    $(".content-main").css("display","block");
    $(".navbar-home-main").css("display","block");
});
