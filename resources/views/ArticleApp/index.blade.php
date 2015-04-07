@extends('app')
@section('content')
<div class="container" ng-app="articleApp" ng-controller="articleController">
    <h1>Article Manager</h1><hr>

    <div class="row" ng-show="!create"><button class="btn btn-primary btn-md" ng-click="switchCreate()"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add article</button></div>
<br>
    <div class="row panel panel-primary">
        <div class="panel-heading">
            <h3 ng-show="create">Add article</h3>
            <h3 ng-show="!create">Edit article</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <h4>Information</h4>
                <h6>(Mandatory fields are marked with a *)</h6>
                <form name="ArticleForm">
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.title" placeholder="Title*" name="title" required></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.artist" placeholder="Creator*" name="creator" required></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.origin" placeholder="Origin*" name="origin" required></div></div>
                    <div class="row form-group"><div class="col-sm-12"><textarea rows="10" class="form-control" type='text' ng-model="article.description" placeholder="Description*" name="description" required></textarea></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.dimensions" placeholder="Dimensions" name="dimensions"></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.color" placeholder="Color" name="color"></div></div>
                    <div class="row form-group"><div class="col-sm-12"><input class="form-control" type='text' ng-model="article.tags" placeholder="Tags" name="tags"></div></div>
                    <div class="row form-group"><div class="col-xs-6"><input class="form-control" type='number' ng-model="article.stock" placeholder="Stock*" name="stock" required></div></div>
                    <div class="row form-group"><div class="col-xs-6"><input class="form-control" type='price' ng-model="article.price" placeholder="Price*" name="price" required></div><label class="checkbox-inline"><input type='checkbox' ng-true-value="1" ng-false-value="'0'" ng-model="article.sale" name="sale">Sell</label></div>
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
                    <span ng-show="!create"><hr>
                    <h4>Album</h4>
                    <h6>(Drag n drop / Place cover image in 1st place)</h6></span>
                    <ul ui-sortable="sortableOptions" ng-model="articleImages">
                        <li ng-repeat="articleImage in articleImages" ng-mouseover="hoverImage(articleImage)" class="image_elem_admin">
                            <img ng-src="<% articleImage.url %>">
                            <i class="glyphicon glyphicon-remove-sign"></i>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-xs-12" align="center">
                <hr>
                <div class="row" ng-show="create"><button class="btn btn-primary btn-md" ng-click="addArticle()" ng-disabled="ArticleForm.$invalid" type="submit"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add</button></div>
                <div class="row" ng-show="!create"><button class="btn btn-primary btn-md" ng-click="updateSaveArticle(article)" ng-disabled="ArticleForm.$invalid" type="submit"><i class="glyphicon glyphicon-save"></i>&nbsp;Save</button></div>
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
                            <th class="col-xs-3 text-center table-header" st-sort="artist">Creator</th>
                            <th class="col-xs-1 text-center table-header" st-sort="updated_at | date">Updated</th>
                            <th class="col-xs-1 text-center table-header" st-sort="created_at | date">Created</th>
                            <th class="col-xs-1 text-center" style="min-width: 100px">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="article in articlesDisplayed">
                            <td class="small"><% article.id %></td>
                            <td class="small"><% article.title %></td>
                            <td class="small"><% article.artist %></td>
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
                <h6>Add or edit the types of articles on sale.</h6>
                    <div class="col-xs-8 col-sm-6">
                        <form name="ArticletypeForm" class="input-group">
                            <input class="form-control" type='text' ng-model="articletype.name" placeholder="Name*" name="name" required>
                            <span class="input-group-btn">
                                <div class="row" ng-show="createType"><button class="btn btn-primary btn-md" ng-click="addArticletype()" ng-disabled="ArticletypeForm.$invalid" type="submit">&nbsp;&nbsp;<i class="glyphicon glyphicon-plus"></i>&nbsp;Add</button></div>

                                <div class="row" ng-show="!createType"><button class="btn btn-primary btn-md" ng-click="updateSaveArticletype(articletype)" ng-disabled="ArticletypeForm.$invalid" type="submit">&nbsp;&nbsp;<i class="glyphicon glyphicon-save"></i>&nbsp;Save</button></div>
                            </span>
                        </form>
                    </div>
            </div>
            <div class="col-xs-12">
                <div class="list_admin">
                    <ul ng-model="articletypes">
                        <li ng-repeat="articletype in articletypes">
                            <button class="btn btn-primary btn-md" ng-click="updateArticletype(articletype)"><% articletype.name %></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

