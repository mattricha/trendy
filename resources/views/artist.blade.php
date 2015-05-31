@extends('app')

@section('content')


<div class="content-wrapper">
    <div class="content-main">

        <div class="artist-details-panel row">
            <div class="artist-cover-wrapper col-sm-12 col-md-4">
                <div class="artist-cover" style="background-image: url('/img/artists/200x200/{{$artist->id}}.jpg')">
                </div>
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="artist-name">
                    {{$artist->name}}
                </div>
                @if($artist->company != "")
                <div class="artist-company">
                    {{$artist->company}}
                </div>
                @endif
                <br>
                <div class="artist-description">
                    {{$artist->description}}
                </div>
                <br>
                @if($artist->email != "")
                <div class="artist-email">
                    <small>Email:</small>&nbsp;&nbsp; {{$artist->email}}
                </div>
                @endif
                @if($artist->urlPortfolio != "")
                <div class="artist-urlPortfolio">
                    <small>Portfolio:</small>&nbsp;&nbsp; <a href="{{$artist->urlPortfolio}}" target="_blank">{{$artist->urlPortfolio}}</a>
                </div>
                @endif
                <div class="artist-dateJoined">
                    <small>Member since:</small>&nbsp;&nbsp; {{$artist->dateJoined}}
                </div>
            </div>
        </div>

        <div class="spacer"><div class="mask"></div></div>

        <div class="row">
            <div class="col-xs-12">
                <h3>Articles</h3>
                <div class="artist-articles-thumbs row">
                    @foreach($articles as $article)
                            <div class="browse-articles-thumb col-xs-4 col-sm-3 col-md-2">
                                <a href="/article/{{$article->articleID}}">
                                    <img src="/img/articles/200x200/{{$article->articleID}}/{{$article->image_name}}">
                                    <div class="browse-article-top-txt">
                                        <div class="browse-article-title">{{$article->title}}</div>
                                        <div class="browse-article-artist">{{$artist->name}}</div>
                                    </div>
                                </a>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>


    </div>
</div>

@endsection
