@extends('app')

@section('content')

<div class="browse" ng-app="browseApp" ng-controller="browseController">
    <div class="content-wrapper">
        <div class="content-main">
            <h3>Browse</h3>
            <hr>
            <div class="row">
                <div class="browse-left-panel col-sm-4 col-md-3">
                    <v-accordion class="vAccordion--default">
                        <v-pane expanded="$first">
                            <v-pane-header ng-click="selectAll()">
                               <div class="accordion-section-title">ALL</div>
                            </v-pane-header>
                            <v-pane-content>
                               <div class="accordion-section-content">Browse all of our articles!</div>
                            </v-pane-content>
                        </v-pane>
                        <v-pane ng-repeat="articletype in articletypes">
                            <v-pane-header ng-click="selectType(articletype.id)">
                                  <div class="accordion-section-title"><%articletype.name%></div>
                            </v-pane-header>
                            <v-pane-content>
                                <div class="accordion-section-content"><a ng-repeat="articlesubtype in articlesubtypes" ng-if="articlesubtype.typeID == articletype.id" ng-click="selectSubtype(articlesubtype.id)"><%articlesubtype.name%><br></a></div>
                            </v-pane-content>
                        </v-pane>
                    </v-accordion>
                </div>
                <div class="browse-right-panel col-sm-8 col-md-9">
                    <div class="browse-articles-thumbs row">
                        <div class="browse-articles-thumb col-xs-4 col-sm-4 col-md-3" dir-paginate="article in articles | itemsPerPage: itemsByPage">
                            <a href="/article/<%article.articleID%>">
                                <img src="/img/articles/200x200/<%article.articleID%>/<%article.image_name%>">
                                <div class="browse-article-top-txt">
                                    <div class="browse-article-title"><%article.title%></div>
                                    <div class="browse-article-artist"><%article.artist_name%></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="text-center">
                        <dir-pagination-controls boundary-links="true"></dir-pagination-controls>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
