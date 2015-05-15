@extends('app')

@section('content')


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

        <div class="article-images-thumbs">
            <ul>
            @foreach($images as $image)
                <li>
                    <div class="article-image-thumb">
                        <a href="/article/{{$article->id}}">
                            <img src="/img/articles/200x200/{{$article->id}}/{{$image->name}}">
                        </a>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
        <br><br>
        <div class="spacer"><div class="mask"></div></div>

        <h4>Similar articles</h4>
        <div class="same-type-articles-thumbs">
            <ul>
            @foreach($similarArticles as $similarArticle)
                <li>
                    <div class="same-type-articles-thumb">
                        <a href="/article/{{$similarArticle->articleID}}">
                            <img src="/img/articles/200x200/{{$similarArticle->articleID}}/{{$similarArticle->image_name}}">
                            <div class="similar_article_top_txt">
                                <div class="similar_article_title">{{$similarArticle->title}}</div>
                                <div class="similar_article_artist">{{$similarArticle->artist_name}}</div>
                            </div>
                        </a>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>

        <div class="spacer"><div class="mask"></div></div>

        <h4>Other articles from {{$artist}}</h4>
        <div class="same-artist-articles-thumbs">
            <ul>
            @foreach($sameArtistArticles as $sameArtistArticle)
                <li>
                    <div class="same-artist-articles-thumb">
                        <a href="/article/{{$sameArtistArticle->articleID}}">
                            <img src="/img/articles/200x200/{{$sameArtistArticle->articleID}}/{{$sameArtistArticle->image_name}}">
                            <div class="similar_article_top_txt">
                                <div class="similar_article_title">{{$sameArtistArticle->title}}</div>
                                <div class="similar_article_artist">{{$artist}}</div>
                            </div>
                        </a>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>

    </div>
</div>

@endsection
