@extends('app')

@section('content')

<div class="articlePage" ng-app="articlePageApp" ng-controller="articlePageController">
    <div class="content-wrapper">
        <div class="content-main">
            <div class="row">
                <div class="article-left-panel col-sm-6">
                    <div class="article-cover"><img src="/img/articles/500W/{{$article->id}}/{{$images[0]->name}}"></div>
                </div>
                <div class="article-right-panel col-sm-6">
                    <div class="article-type">
                        <a href="/browse/t/{{$article->typeID}}">{{$type}}</a>/<a href="/browse/st/{{$article->subtypeID}}">{{$subtype}}</a>
                    </div>
                    <div class="article-title">
                        {{$article->title}}
                    </div>
                    <div class="article-artist">
                        <ul>
                            <li>
                                <a href="/artist/{{$article->artistID}}"><div class="article-artist-image" style="background-image: url('/img/artists/30x30/{{$article->artistID}}.jpg')"></div></a>
                            </li>
                            <li>
                                <div class="article-artist-name"><a href="/artist/{{$article->artistID}}">{{$artist}}</a></div>
                            </li>
                        </ul>
                    </div>
                    <br>
                    <div class="article-description">
                        {{$article->description}}
                    </div>
                    <br>
                    @if($article->size != "")
                    <div class="article-size">
                        <i>Size:</i> {{$article->size}}
                    </div>
                    <br>
                    @endif
                    @if($article->dimensions != "")
                    <div class="article-dimensions">
                        <i>Dimensions:</i> {{$article->dimensions}}
                    </div>
                    <br>
                    @endif
                    <div class="article-shop">
                        <ul>
                            <li>
                                <div class="article-price">
                                    ${{$article->price}}
                                </div>
                            </li>
                            <li>
                                <div class="article-cart">
                                    <button class="btn btn-default btn-md"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Add to cart</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <br>
                    <div class="article-likes">
                        <i class="glyphicon glyphicon-heart"></i> {{$article->likes}}
                    </div>
                </div>
            </div>

            <br>

            <div class="article-images-thumbs row">
                @foreach($images as $image)
                        <div class="article-image-thumb col-xs-4 col-sm-3 col-md-2">
                            <img name="{{$image->weight}}" src="/img/articles/200x200/{{$article->id}}/{{$image->name}}" ng-click="showImage({{$image->weight}})">
                        </div>
                @endforeach
            </div>
            <br><br>
            <div class="spacer"><div class="mask"></div></div>

            <div class="article-subsection-title">Similar articles</div>
            <div class="browse-articles-thumbs row">
                @foreach($similarArticles as $similarArticle)
                        <div class="browse-articles-thumb col-xs-4 col-sm-2">
                            <a href="/article/{{$similarArticle->articleID}}">
                                <img src="/img/articles/200x200/{{$similarArticle->articleID}}/{{$similarArticle->image_name}}">
                                <div class="browse-article-top-txt">
                                    <div class="browse-article-title">{{$similarArticle->title}}</div>
                                    <div class="browse-article-artist">{{$similarArticle->artist_name}}</div>
                                </div>
                            </a>
                        </div>
                @endforeach
            </div>

            <hr>

            <div class="article-subsection-title">Other articles from {{$artist}}</div>
            <div class="browse-articles-thumbs row">
                @foreach($sameArtistArticles as $sameArtistArticle)
                        <div class="browse-articles-thumb col-xs-4 col-sm-2">
                            <a href="/article/{{$sameArtistArticle->articleID}}">
                                <img src="/img/articles/200x200/{{$sameArtistArticle->articleID}}/{{$sameArtistArticle->image_name}}">
                                <div class="browse-article-top-txt">
                                    <div class="browse-article-title">{{$sameArtistArticle->title}}</div>
                                    <div class="browse-article-artist">{{$artist}}</div>
                                </div>
                            </a>
                        </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="overlay-wrapper" align="center">
        <div class="overlay-main">
            <ul>
                <li><i class="overlay-left-arrow glyphicon glyphicon-chevron-left" ng-click="prevImage()"></i></li>
                <li><i class="overlay-close glyphicon glyphicon-remove" ng-click="closeOverlay()"></i></li>
                <li><i class="overlay-right-arrow glyphicon glyphicon-chevron-right" ng-click="nextImage()"></i><li>
            </ul>
            <img class="overlay-image" src="/img/site/bg/black70.png">
        </div>
    </div>

</div>



@endsection
