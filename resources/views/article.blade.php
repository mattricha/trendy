@extends('app')

@section('content')

<div ng-app="articlepageApp" ng-controller="articlepageController">

    <div class="content-wrapper">
        <div class="content-main">



            <div class="row">
                <div class="article-left-panel col-sm-6">
                    <div class="article-cover"><img src="/img/articles/500W/{{$article->id}}/{{$images[0]->name}}"></div>
                </div>
                <div class="article-right-panel col-sm-6">
                    <div class="article-type">
                        <a href="/articletype/{{$article->typeID}}">{{$type}}</a>/<a href="/articlesubtype/{{$article->subtypeID}}">{{$subtype}}</a>
                    </div>
                    <div class="article-title">
                        {{$article->title}}
                    </div>
                    <div class="article-artist">
                        <ul>
                            <li>
                                <div class="article-artist-image" style="background-image: url('/img/artists/30x30/{{$article->artistID}}.jpg')"></div>
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

            <hr>

            <div class="article-images-thumbs">
                <ul>
                @foreach($images as $image)
                    <li>
                        <div class="article-image-thumb">
                            <img src="/img/articles/200x200/{{$article->id}}/{{$image->name}}">
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>



        </div>
    </div>

</div>

@endsection
