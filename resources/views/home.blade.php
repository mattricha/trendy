@extends('app')

@section('content')

<div class="home" ng-app="masonryApp" ng-controller="masonryController">

	<div class="navbar-home-wrapper">
		<div class="navbar-home-main navbar">
			<ul>
				<li class="navbar-home-item"><a href="/browse">ALL</a></li>
				<li class="navbar-home-item" ng-repeat="articletype in articletypes"><a href="/browse"><%articletype.name%></a></li>
			</ul>
		</div>
	</div>
	<div class="content-wrapper">
		<div class="content-main">

			<div masonry preserve-order class="homeMasonry" ng-model="homeArticles">
				<div class="masonry-brick homeMasonry_brick" ng-repeat="homeArticle in homeArticles">
					<a href="/article/<%homeArticle.articleID%>">
						<img src="/img/articles/500W/<%homeArticle.articleID%>/<%homeArticle.image_name%>">
						<div class="homeMasonry_brick_top_txt">
							<div class="homeMasonry_brick_title"><%homeArticle.title%></div>
							<div class="homeMasonry_brick_artist"><%homeArticle.artist_name%></div>
						</div>
						<div class="homeMasonry_brick_type"><%homeArticle.articletype_name%></div>
					</a>
				</div>
			</div>

		</div>
	</div>

</div>

@endsection
