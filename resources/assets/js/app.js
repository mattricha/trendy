
var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

/* ARTICLE APP */

var appArticle = angular.module('articleApp', ['ngRoute','smart-table','angularFileUpload', 'ui.sortable'])

.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}])

.controller('articleController', ['$scope', '$http', '$filter', 'FileUploader', '$routeParams', function($scope, $http, $filter, FileUploader, $routeParams) {

    $scope.loading = false;
    $scope.articles = [];
    $scope.articleImages = [];
    $scope.articletypes = [];
    $scope.articlesubtypes = [];
    $scope.artists = [];

    var uploadID = 0;
    var artistID = 0;
    var rep = "";

    var weightImg = 0;
    var urlImg = "";
    var nameImg = "";

    /* create or edit ? */

    $scope.create = true;
    $scope.createType = true;
    $scope.createSubtype = true;
    $scope.createArtist = true;

    /* table */

    $scope.itemsByPage=10;
    $scope.predicates = ['id', 'title', 'creator'];
    $scope.selectedPredicate = $scope.predicates[0];


    $scope.init = function() {
        $scope.loading = true;
        $http.get('/api/articles').
        success(function(data, status, headers, config) {
            $scope.articles = data;
            $scope.loading = false;
        });
        $http.get('/api/articletypes').
        success(function(data, status, headers, config) {
            $scope.articletypes = data;
        });
        $http.get('/api/articlesubtypes').
        success(function(data, status, headers, config) {
            $scope.articlesubtypes = data;
        });
        $http.get('/api/artists').
        success(function(data, status, headers, config) {
            $scope.artists = data;
        });
    };


    /* uploader */

    var uploader = $scope.uploader = new FileUploader({
        url: 'uploadArticle/0',
        headers : {
            'X-XSRF-TOKEN': csrf_token
        },
    });

    uploader.filters.push({
        name: 'imageFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    });

    uploader.onBeforeUploadItem = function(item) {
        item.url = 'uploadArticle/' + $routeParams.uploadID;
    };

    uploader.onCompleteAll = function() {
        $scope.uploader.clearQueue();
    };



    var uploaderArtistProfile = $scope.uploaderArtistProfile = new FileUploader({
        url: 'uploadArtist/0',
        headers : {
            'X-XSRF-TOKEN': csrf_token
        },
    });

    uploaderArtistProfile.filters.push({
        name: 'imageFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    });

    uploaderArtistProfile.onBeforeUploadItem = function(item) {
        item.url = 'uploadArtist/' + $routeParams.artistID + '/1';
    };

    uploaderArtistProfile.onCompleteAll = function() {
        $scope.uploaderArtistProfile.clearQueue();
    };



    var uploaderArtistHeader = $scope.uploaderArtistHeader = new FileUploader({
        url: 'uploadArtist/0',
        headers : {
            'X-XSRF-TOKEN': csrf_token
        },
    });

    uploaderArtistHeader.filters.push({
        name: 'imageFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    });

    uploaderArtistHeader.onBeforeUploadItem = function(item) {
        item.url = 'uploadArtist/' + $routeParams.artistID + '/2';
    };

    uploaderArtistHeader.onCompleteAll = function() {
        $scope.uploaderArtistHeader.clearQueue();
    };



    /* sortable images options */

    $scope.sortableOptions = {
        'ui-floating': true
    };

    var fixHelper = function(e, ui) {
      ui.children().each(function() {
        $(this).width($(this).width());
      });
      return ui;
    };


    /* articles */

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
                $scope.uploadImages();
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
        $http.get('/api/images/' + article.id)
        .success(function(data, status, headers, config){
            $scope.articleImages = data;
        });
    };

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
            $routeParams.uploadID = uploadID;
            $scope.sortImages();
            $scope.uploadImages();
            $http.get('/api/images/' + article.id)
            .success(function(data, status, headers, config){
                $scope.articleImages = data;
            });
            $scope.loading = false;
            var confirmSave = alert("Your changes have been saved.");
        });
    };

    $scope.deleteArticle = function(article) {
        var confirmDelete = confirm("Are you sure you want to delete this article from the list?");
        if (confirmDelete === true) {
            $scope.loading = true;
            $http.delete('/api/articles/' + article.id)
            .success(function() {
                $http.get('/api/articles').
                success(function(data, status, headers, config) {
                    $scope.articles = data;
                });
                $scope.loading = false;
            });
        }
    };

    $scope.switchCreate = function() {
        $scope.create = true;
        $scope.uploader.clearQueue();
        $scope.articleImages = [];
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
        $scope.article = "";
    };

    /* Image upload */

    $scope.sortImages = function(){
        for(i=0; i < $scope.articleImages.length; i++){
            $scope.articleImage = $scope.articleImages[i];
            $scope.articleImage.weight = i + 1;
            $http.put('/api/images/' + $scope.articleImage.id, {
                weight: $scope.articleImage.weight
            }).success();
        }
    };

    $scope.uploadImages = function() {
        for(i = 0; i < $scope.uploader.queue.length; i++){
            weightImg = 1000;
            nameImg = $scope.uploader.queue[i].file.name;
            urlImg = "/img/articles/" + uploadID + "/" + nameImg;
            $http.post('/api/images', {
                articleID: uploadID,
                weight: weightImg,
                name: nameImg,
                url: urlImg,
                visible: true
            }).success();
        }
        $scope.uploader.uploadAll();
    };

    /* Article types */

    $scope.addArticletype = function() {
        $http.post('/api/articletypes', {
        name: $scope.articletype.name
        }).success(function(data, status, headers, config) {
            $http.get('/api/articletypes').
            success(function(data, status, headers, config) {
                $scope.articletypes = data;
            });
            $scope.articletypes = '';
        });
        $scope.switchCreatetype();
    };

    $scope.updateArticletype = function(articletype) {
        var confirmDelete = confirm("Are you sure you want to edit this type?");
        if (confirmDelete === true) {
            $scope.createType = false;
            $scope.articletype = {id: articletype.id};
            $scope.articletype.name = articletype.name;
        }
        else{
            $scope.switchCreatetype();
        }
    };

    $scope.updateSaveArticletype = function(articletype) {
        $http.put('/api/articletypes/' + articletype.id, {
        name: $scope.articletype.name
        }).success(function(data, status, headers, config) {
            $http.get('/api/articletypes').
            success(function(data, status, headers, config) {
                $scope.articletypes = data;
            });
            $scope.switchCreatetype();
        });
    };

    $scope.switchCreatetype = function() {
        $scope.createType = true;
        $scope.articletype.name = "";
    };

    /* Article subtypes */

    $scope.addArticlesubtype = function() {
        $http.post('/api/articlesubtypes', {
        typeID: $scope.articletype.id,
        name: $scope.articlesubtype.name
        }).success(function(data, status, headers, config) {
            $http.get('/api/articlesubtypes').
            success(function(data, status, headers, config) {
                $scope.articlesubtypes = data;
            });
            $scope.articlesubtypes = '';
        });
        $scope.switchCreatesubtype();
    };

    $scope.updateArticlesubtype = function(articlesubtype) {
        var confirmDelete = confirm("Are you sure you want to edit this subtype?");
        if (confirmDelete === true) {
            $scope.createSubtype = false;
            $scope.articlesubtype = {id: articlesubtype.id};
            $scope.articlesubtype.name = articlesubtype.name;
        }
        else{
            $scope.switchCreatesubtype();
        }
    };

    $scope.updateSaveArticlesubtype = function(articlesubtype) {
        $http.put('/api/articlesubtypes/' + articlesubtype.id, {
        typeID: $scope.articletype.id,
        name: $scope.articlesubtype.name
        }).success(function(data, status, headers, config) {
            $http.get('/api/articlesubtypes').
            success(function(data, status, headers, config) {
                $scope.articlesubtypes = data;
            });
            $scope.switchCreatesubtype();
        });
    };

    $scope.switchCreatesubtype = function() {
        $scope.createSubtype = true;
        $scope.articlesubtype = "";
    };

    $scope.subtypeDropdownSelect = function(articletype){
        $scope.articletype = {id: articletype.id};
        $scope.articletype.name = articletype.name;
        $scope.switchCreatesubtype();
    };


    /* Artists */

    $scope.addArtist = function() {
        $scope.loading = true;
        $http.post('/api/artists', {
        name: $scope.artist.name,
        email: $scope.artist.email,
        company: $scope.artist.company,
        description: $scope.artist.description,
        urlPortfolio: $scope.artist.urlPortfolio,
        dateJoined: $scope.artist.dateJoined
        }).success(function(data, status, headers, config) {
            $http.get('/api/artists').
            success(function(data, status, headers, config) {
                $scope.artists = data;
                $routeParams.artistID = $scope.artists[$scope.artists.length - 1].id;
                $scope.uploadArtistImages();
            });
            $scope.artist = '';
            $scope.loading = false;
        });
    };

    $scope.updateArtist = function(artist) {
        $scope.createArtist = false;
        $routeParams.artistID = artist.id;
        $scope.artist = {id: artist.id};
        $scope.artist.name = artist.name;
        $scope.artist.email = artist.email;
        $scope.artist.company = artist.company;
        $scope.artist.description = artist.description;
        $scope.artist.dateJoined = artist.dateJoined;
    };

    $scope.updateSaveArtist = function(artist) {
        $http.put('/api/artists/' + artist.id, {
        name: $scope.artist.name,
        email: $scope.artist.email,
        company: $scope.artist.company,
        description: $scope.artist.description,
        urlPortfolio: $scope.artist.urlPortfolio,
        dateJoined: $scope.artist.dateJoined
        }).success(function(data, status, headers, config) {
            $http.get('/api/artists').
            success(function(data, status, headers, config) {
                $scope.artists = data;
            });
            $scope.uploadArtistImages();
            $scope.loading = false;
            var confirmSave = alert("Your changes have been saved.");
        });
    };

    $scope.switchCreateartist = function(){
        $scope.createArtist = true;
        $scope.artist = "";
    };

    $scope.uploadArtistImages = function() {
        $scope.uploaderArtistProfile.uploadAll();
        $scope.uploaderArtistHeader.uploadAll();
    };


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


appArticle.directive('disableAutoClose', [ function(){
    return {
        link: function($scope, $element) {
            $element.on('click', function($event) {
                console.log("Dropdown should not close");
                $event.stopPropagation();
            });
        }
    };
}]);

/*  MISC  */


/* scroll to top */

function scrollToTop(){
    $('html, body').animate({scrollTop : 0},400);
}

