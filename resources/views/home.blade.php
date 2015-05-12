@extends('app')

@section('content')

<div class="home" ng-app="masonryApp" ng-controller="masonryController">

	<div class="navbar-home-wrapper">
		<div class="navbar-home-main">
			<ul>
				<li class="navbar-home-item">ALL</li>
				<li class="navbar-home-item" ng-repeat="articletype in articletypes"><%articletype.name%></li>
			</ul>
		</div>
	</div>
	<div class="content-wrapper">
		<div class="content-main">

			<div masonry preserve-order class="homeMasonry" ng-model="homeArticles">
				<div class="masonry-brick homeMasonry_brick" ng-repeat="homeArticle in homeArticles">
					<img src="/img/articles/500W/<%homeArticle.articleID%>/<%homeArticle.image_name%>">
					<div class="homeMasonry_brick_title"><%homeArticle.title%></div>
					<div class="homeMasonry_brick_artist"><%homeArticle.artist_name%></div>
					<div class="homeMasonry_brick_type"><%homeArticle.articletype_name%></div>
				</div>
			</div>

		</div>
	</div>

</div>

@endsection
