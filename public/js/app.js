
/* ARTICLE APP */

var appArticle = angular.module('articleApp', ['smart-table','angularFileUpload']);

appArticle.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

appArticle.filter('html', ['$sce', function ($sce) {
    return function (text) {
        return $sce.trustAsHtml(text);
    };
}])

appArticle.controller('articleController', ['$scope', '$http', '$filter', 'FileUploader', '$sce', function($scope, $http, $filter, FileUploader, $sce) {

    $scope.loading = false;
    $scope.articles = [];

    var uploadID = 0;
    var rep = "";
    var urlList = "";

    /* create or edit ? */

    $scope.create = true;


    /* table */

    $scope.itemsByPage=10;
    $scope.predicates = ['id', 'title', 'creator'];
    $scope.selectedPredicate = $scope.predicates[0];


    /* uploader */

    var uploader = $scope.uploader = new FileUploader({
        url: 'upload.php'
    });

    uploader.filters.push({
        name: 'imageFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    });

    uploader.onBeforeUploadItem = function(item) {
        item.url = 'upload.php?article=' + uploadID;
        console.info('onBeforeUploadItem', item);
    };

    uploader.onCompleteAll = function() {
        console.info('onCompleteAll');
        $scope.uploader.clearQueue();
    };

    console.info('uploader', uploader);


    /* articles */

    $scope.init = function() {
        $scope.loading = true;
        $http.get('/api/articles').
        success(function(data, status, headers, config) {
            $scope.articles = data;
            $scope.loading = false;
        });
    }

    $scope.addArticle = function() {
        $scope.loading = true;
        $http.post('/api/articles', {
        title: $scope.article.title,
        artist: $scope.article.artist,
        origin: $scope.article.origin,
        description: $scope.article.description,
        dimensions: $scope.article.dimensions,
        color: $scope.article.color,
        stock: $scope.article.stock,
        price: $scope.article.price,
        sale: $scope.article.sale,
        tags: $scope.article.tags
        }).success(function(data, status, headers, config) {
            $http.get('/api/articles').
            success(function(data, status, headers, config) {
                $scope.articles = data;
                uploadID = $scope.articles[$scope.articles.length - 1].id;
                $scope.uploader.uploadAll();
            });
            $scope.article = '';
            $scope.loading = false;
        });
    };

    $scope.updateArticle = function(article) {
        $scope.create = false;
        $scope.uploader.clearQueue();
        scrollToTop();
        $scope.article = {id: article.id};
        $scope.article.title = article.title;
        $scope.article.artist = article.artist;
        $scope.article.origin = article.origin;
        $scope.article.description = article.description;
        $scope.article.dimensions = article.dimensions;
        $scope.article.color = article.color;
        $scope.article.stock = article.stock;
        $scope.article.price = article.price;
        $scope.article.sale = article.sale;
        $scope.article.tags = article.tags;
        $scope.imageList(article.id);
    }

    $scope.updateSaveArticle = function(article) {
        $http.put('/api/articles/' + article.id, {
        title: $scope.article.title,
        artist: $scope.article.artist,
        origin: $scope.article.origin,
        description: $scope.article.description,
        dimensions: $scope.article.dimensions,
        color: $scope.article.color,
        stock: $scope.article.stock,
        price: $scope.article.price,
        sale: $scope.article.sale,
        tags: $scope.article.tags
        }).success(function(data, status, headers, config) {
            $http.get('/api/articles').
            success(function(data, status, headers, config) {
                $scope.articles = data;
            });
            uploadID = $scope.article.id;
            $scope.uploader.uploadAll();
            $scope.loading = false;
            $scope.create = true;
            $scope.article = "";
        });;
    };


    $scope.deleteArticle = function(article) {
        var confirmDelete = confirm("Are you sure you want to delete this article from the list?");
        if (confirmDelete == true) {
            $scope.loading = true;
            $http.delete('/api/articles/' + article.id)
            .success(function() {
                $http.get('/api/articles').
                success(function(data, status, headers, config) {
                    $scope.articles = data;
                });
                $scope.loading = false;
            });;
        }
    };

    $scope.switchCreate = function() {
        $scope.create = true;
        $scope.uploader.clearQueue();
        $scope.article.title = "";
        $scope.article.artist = "";
        $scope.article.origin = "";
        $scope.article.description = "";
        $scope.article.dimensions = "";
        $scope.article.color = "";
        $scope.article.stock = "";
        $scope.article.price = "";
        $scope.article.sale = "";
        $scope.article.tags = "";
    }

    $scope.imageList = function(id) {
        urlList = 'imageList.php?article=' + id;
        $http.get(urlList).
        success(function(data, status, headers, config) {
            $scope.imagelist = data;
        });
    }

    $scope.init();

}]);



appArticle.directive('ngThumb', ['$window', function($window) {
    var helper = {
        support: !!($window.FileReader && $window.CanvasRenderingContext2D),
        isFile: function(item) {
            return angular.isObject(item) && item instanceof $window.File;
        },
        isImage: function(file) {
            var type =  '|' + file.type.slice(file.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    };

    return {
        restrict: 'A',
        template: '<canvas/>',
        link: function(scope, element, attributes) {
            if (!helper.support) return;

            var params = scope.$eval(attributes.ngThumb);

            if (!helper.isFile(params.file)) return;
            if (!helper.isImage(params.file)) return;

            var canvas = element.find('canvas');
            var reader = new FileReader();

            reader.onload = onLoadFile;
            reader.readAsDataURL(params.file);

            function onLoadFile(event) {
                var img = new Image();
                img.onload = onLoadImage;
                img.src = event.target.result;
            }

            function onLoadImage() {
                var width = params.width || this.width / this.height * params.height;
                var height = params.height || this.height / this.width * params.width;
                canvas.attr({ width: width, height: height });
                canvas[0].getContext('2d').drawImage(this, 0, 0, width, height);
            }
        }
    };
}]);


/*  MISC  */

function scrollToTop(){
    $('html, body').animate({scrollTop : 0},400);
}

