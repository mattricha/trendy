@extends('app')
@section('content')

<div class="container" ng-app="articleApp" ng-controller="articleController">
    <h1>Shop Manager</h1><hr>
    <br>
    <div class="row panel panel-primary">
        <div class="panel-heading">
            <h3 ng-show="create">Add article</h3>
            <h3 ng-show="!create">Edit article</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <div class="row" ng-show="!create"><button class="btn btn-primary btn-md" ng-click="switchCreate()"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add article</button></div>
                <h4>Information</h4>
                <h6>(Mandatory fields are marked with a *)</h6>
                <br>
                <form name="ArticleForm">
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <h6>Select artist</h6>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle btn-block" data-toggle="dropdown" aria-expanded="false" name="articleSelectArtist"><% artist.name %>&nbsp;<span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" ng-model="artists">
                                    <input disable-auto-close type="search" ng-model="searchFilter1" placeholder="Search..."></input>
                                    <li ng-repeat="artist in artists | filter: searchFilter1" value="artist.id" ng-click="artistDropdownSelectArticle(artist)"><% artist.name %></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-sm-12">
                            <h6>Select type</h6>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle btn-block" data-toggle="dropdown" aria-expanded="false" name="articleSelectType"><% articletype.name %>&nbsp;<span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" ng-model="articletypes">
                                    <input disable-auto-close type="search" ng-model="searchFilter2" placeholder="Search..."></input>
                                    <li ng-repeat="articletype in articletypes | filter: searchFilter2" value="articletype.id" ng-click="typeDropdownSelectArticle(articletype)"><% articletype.name %></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-12">
                            <h6>Select subtype</h6>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle btn-block" data-toggle="dropdown" aria-expanded="false" name="articleSelectSubtype"><% articlesubtype.name %>&nbsp;<span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" ng-model="articlesubtypes">
                                    <input disable-auto-close type="search" ng-model="searchFilter3" placeholder="Search..."></input>
                                    <li ng-repeat="articlesubtype in articlesubtypes | filter: searchFilter3" ng-if="articlesubtype.typeID == articletype.id" value="articlesubtype.id" ng-click="subtypeDropdownSelectArticle(articlesubtype)"><% articlesubtype.name %></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group"><div class="col-sm-12"><h6>Date added</h6><input class="form-control" type="date" ng-model="article.dateAdded" name="dateAdded"></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.title" placeholder="Title*" name="title" required></div></div>
                    <div class="row form-group"><div class="col-sm-12"><textarea rows="10" class="form-control" type='text' ng-model="article.description" placeholder="Description*" name="description" required></textarea></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.dimensions" placeholder="Dimensions" name="dimensions"></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.size" placeholder="Size" name="size"></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.style" placeholder="Style" name="style"></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.color" placeholder="Color" name="color"></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.tags" placeholder="Tags" name="tags"></div></div>
                    <div class="row form-group"><div class="col-xs-6"><input class="form-control" type='number' ng-model="article.stock" placeholder="Stock*" name="stock" required></div></div>
                    <div class="row form-group"><div class="col-xs-6"><input class="form-control" type='price' ng-model="article.price" placeholder="Price*" name="price" required></div><label class="checkbox-inline"><input type='checkbox' ng-true-value="1" ng-false-value="0" ng-model="article.sale" name="sale">Sell</label></div>
                </form>
                <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
            </div>
            <div class="col-md-6">
                <h4>Upload images</h4>

                <input type="file" nv-file-select="" uploader="uploader" multiple />
                <br>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="small" width="50%">Name</th>
                            <th class="small" ng-show="uploader.isHTML5">Size</th>
                            <th class="small" ng-show="uploader.isHTML5">Progress</th>
                            <th class="small">Status</th>
                            <th class="small"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in uploader.queue">
                            <td>
                                <strong><% item.file.name %></strong>
                                <!-- Image preview -->
                                <!--auto height-->
                                <!--<div ng-thumb="{ file: item.file, width: 100 }"></div>-->
                                <!--auto width-->
                                <div ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }"></div>
                                <!--fixed width and height -->
                                <!--<div ng-thumb="{ file: item.file, width: 100, height: 100 }"></div>-->
                            </td>
                            <td ng-show="uploader.isHTML5"><% item.file.size/1024/1024|number:2 %> MB</td>
                            <td ng-show="uploader.isHTML5">
                                <div class="progress" style="margin-bottom: 0;">
                                    <div class="progress-bar" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span ng-show="item.isSuccess"><i class="glyphicon glyphicon-ok"></i></span>
                                <span ng-show="item.isCancel"><i class="glyphicon glyphicon-ban-circle"></i></span>
                                <span ng-show="item.isError"><i class="glyphicon glyphicon-remove"></i></span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-xs" ng-click="item.remove()">
                                    <span class="glyphicon glyphicon-trash"></span> Remove
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    Queue progress:
                    <div class="progress" style="">
                        <div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
                    </div>
                </div>


                <div class="list_admin">
                    <span ng-show="!create"><div class="col-xs-12" align="center"><hr></div>
                    <h4>Album</h4>
                    <h6>(Drag n drop / Place cover image in 1st place)</h6></span>
                    <ul ui-sortable="sortableOptions" ng-model="articleImages">
                        <li ng-repeat="articleImage in articleImages" class="articleImage_thumb">
                            <i class="glyphicon glyphicon-remove-sign articleImage_thumb_delete" ng-click="deleteImage(articleImage)"></i>
                            <img ng-src="/img/articles/100x100/<% articleImage.articleID %>/<% articleImage.name %>">
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-xs-12" align="center">
                <hr>
                <div class="row" ng-show="create"><button class="btn btn-primary btn-md" ng-click="addArticle()" ng-disabled="ArticleForm.$invalid" type="submit"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add</button></div>
                <div class="row" ng-show="!create"><button class="btn btn-primary btn-md" ng-click="updateSaveArticle(article)" ng-disabled="ArticleForm.$invalid" type="submit"><i class="glyphicon glyphicon-save"></i>&nbsp;Save</button></div>
                <hr>
            </div>
        </div>
    </div>

    <hr>


    <div class="row panel panel-primary">
        <div class="panel-heading"><h3>Article list</h3></div>

        <div class="row panel-body">
            <div class="col-xs-12">
                <table class="table table-bordered table-striped table-hover" st-table="articlesDisplayed" st-safe-src="articles">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <ul class="list-inline">
                                    <li><i class="glyphicon glyphicon-search"></i></li>
                                    <li><input st-search placeholder="Search..." class="input-md form-control" type="search"/></li>
                                </ul>
                            </th>
                        </tr>
                        <tr>
                            <th class="col-xs-1 text-center table-header" st-sort="id">ID</th>
                            <th class="col-xs-5 text-center table-header" st-sort="title">Title</th>
                            <th class="col-xs-3 text-center table-header" st-sort="artistID">Artist</th>
                            <th class="col-xs-1 text-center table-header" st-sort="updated_at | date">Updated</th>
                            <th class="col-xs-1 text-center table-header" st-sort="created_at | date">Created</th>
                            <th class="col-xs-1 text-center" style="min-width: 100px">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="article in articlesDisplayed">
                            <td class="small"><% article.id %></td>
                            <td class="small"><% article.title %></td>
                            <td class="small"><% findArtistName(article.artistID) %></td>
                            <td class="table-date"><% article.updated_at %></td>
                            <td class="table-date"><% article.created_at %></td>
                            <td style="text-align: center"><button class="btn btn-primary btn-sm" ng-click="updateArticle(article)"><i class="glyphicon glyphicon-pencil"></i></button> &nbsp;&nbsp;<button class="btn btn-danger btn-sm" ng-click="deleteArticle(article)"><i class="glyphicon glyphicon-trash"></i></button></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                <div st-pagination="" st-items-by-page="itemsByPage" st-displayed-pages="10"></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <hr>

    <div class="row panel panel-primary">
        <div class="panel-heading"><h3>Article types</h3></div>

        <div class="row panel-body">
            <div class="col-xs-12">
                <h4>Types</h4>
                <h6>Add or edit the types of articles on sale.</h6>
                    <div class="col-xs-8 col-sm-6">
                        <form name="ArticletypeForm" class="input-group">

                            <input class="form-control" type="text" ng-model="articletype.name" placeholder="Name*" name="name" required>

                            <div class="input-group-btn">
                                <div ng-show="createType"><button class="btn btn-primary" ng-click="addArticletype()" ng-disabled="ArticletypeForm.$invalid" type="submit"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add</button></div>
                                <div ng-show="!createType"><button class="btn btn-primary" ng-click="updateSaveArticletype(articletype)" ng-disabled="ArticletypeForm.$invalid" type="submit"><i class="glyphicon glyphicon-save"></i>&nbsp;Save</button></div>
                            </div>

                        </form>
                    </div>
            </div>
            <div class="col-xs-12">
                <div class="list_admin">
                    <ul ng-model="articletypes">
                        <li ng-repeat="articletype in articletypes">
                            <button class="btn btn-default btn-md" ng-click="updateArticletype(articletype)"><% articletype.name %></button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xs-12" align="center"><hr></div>


            <div class="col-xs-12">
                <h4>Subtypes</h4>
                <h6>Select a type and add or edit its subtypes.</h6>
                <div class="col-xs-8 col-sm-6">
                    <form name="ArticlesubtypeForm" class="input-group">

                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" name="selectType"><% articletype.name %>&nbsp;<span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" ng-model="articletypes">
                              <li ng-repeat="articletype in articletypes" value="articletype.id" ng-click="subtypeDropdownSelect(articletype)"><% articletype.name %></li>
                            </ul>
                        </div>

                        <input class="form-control" type="text" ng-model="articlesubtype.name" placeholder="Name*" name="name" required>

                        <div class="input-group-btn">
                            <div ng-show="createSubtype"><button class="btn btn-primary" ng-click="addArticlesubtype()" ng-disabled="ArticlesubtypeForm.$invalid" type="submit"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add</button></div>
                            <div ng-show="!createSubtype"><button class="btn btn-primary" ng-click="updateSaveArticlesubtype(articlesubtype)" ng-disabled="ArticlesubtypeForm.$invalid" type="submit"><i class="glyphicon glyphicon-save"></i>&nbsp;Save</button></div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="list_admin">
                    <ul ng-model="articlesubtypes">
                        <li ng-repeat="articlesubtype in articlesubtypes" ng-if="articlesubtype.typeID == articletype.id">
                            <button class="btn btn-default btn-md" ng-click="updateArticlesubtype(articlesubtype)"><% articlesubtype.name %></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <br>
    <div class="row panel panel-primary">
        <div class="panel-heading">
            <h3 ng-show="createArtist">Add artist</h3>
            <h3 ng-show="!createArtist">Edit artist</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <div class="row" ng-show="!createArtist"><button class="btn btn-primary btn-md" ng-click="switchCreateartist()"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add artist</button></div>
                <h4>Information</h4>
                <h6>(Mandatory fields are marked with a *)</h6>
                <form name="ArtistForm" method="post" enctype="multipart/form-data">
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="artist.name" placeholder="Name*" name="name" required></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="artist.email" placeholder="E-mail*" name="email" required></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="artist.company" placeholder="Company" name="company"></div></div>
                    <div class="row form-group"><div class="col-sm-12"><textarea rows="10" class="form-control" type='text' ng-model="artist.description" placeholder="Description*" name="description" required></textarea></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="artist.urlPortfolio" placeholder="Portfolio URL" name="urlPortfolio"></div></div>
                    <div class="row form-group"><div class="col-sm-12"><h6>Date joined</h6><input class="form-control" type="date" ng-model="artist.dateJoined" name="dateJoined"></div></div>
                    <div class="row form-group"><div class="col-sm-12"><h6>Upload profile image (.jpg only)</h6><input class="form-control inputImage" type="file" nv-file-select="" uploader="uploaderArtistProfile"></div></div>

                    <div class="row form-group"><div class="col-sm-12"><h6>Upload header image (.jpg only)</h6><input class="form-control inputImage" type="file" nv-file-select="" uploader="uploaderArtistHeader"></div></div>

                    <div class="row form-group"><div class="col-xs-12" align="center">
                        <hr>
                        <div class="row" ng-show="createArtist"><button class="btn btn-primary btn-md" ng-click="addArtist()" ng-disabled="ArtistForm.$invalid" type="submit"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add</button></div>
                        <div class="row" ng-show="!createArtist"><button class="btn btn-primary btn-md" ng-click="updateSaveArtist(artist)" ng-disabled="ArtistForm.$invalid" type="submit"><i class="glyphicon glyphicon-save"></i>&nbsp;Save</button></div>
                        <hr>
                    </div></div>
                </form>
                <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
            </div>
            <div class="col-md-6">
                <h4>Artist list</h4>
                <table class="table table-bordered table-striped table-hover" st-table="artistsDisplayed" st-safe-src="artists">
                    <thead>
                        <tr>
                            <th colspan="4">
                                <ul class="list-inline">
                                    <li><i class="glyphicon glyphicon-search"></i></li>
                                    <li><input st-search placeholder="Search..." class="input-md form-control" type="search"/></li>
                                </ul>
                            </th>
                        </tr>
                        <tr>
                            <th class="col-xs-1 text-center table-header" st-sort="id">ID</th>
                            <th class="col-xs-6 text-center table-header" st-sort="name">Name</th>
                            <th class="col-xs-4 text-center table-header" st-sort="updated_at | date">Updated</th>
                            <th class="col-xs-1 text-center" style="min-width: 100px">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="artist in artistsDisplayed">
                            <td class="small"><% artist.id %></td>
                            <td class="small"><% artist.name %></td>
                            <td class="table-date"><% artist.updated_at %></td>
                            <td style="text-align: center"><button class="btn btn-primary btn-sm" ng-click="updateArtist(artist)"><i class="glyphicon glyphicon-pencil"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-center">
                                <div st-pagination="" st-items-by-page="itemsByPage" st-displayed-pages="10"></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <hr>
<br><br><br><br><br>
</div>

