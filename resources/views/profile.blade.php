@extends('app')

@section('content')
@if (!Auth::guest())
<div class="profilePage" ng-app="profileApp" ng-controller="profileController">
    <div class="content-wrapper">
        <div class="content-main">
            <div class="user-details-panel row">
                <div class="user-cover-wrapper col-sm-12 col-md-4">
                    @if(file_exists('img/users/200x200/{{Auth::user()->id}}.jpg'))
                    <div class="user-cover" style="background-image: url('/img/users/200x200/{{Auth::user()->id}}.jpg')">
                    </div>
                    @else
                    <div class="user-cover" style="background-image: url('/img/users/200x200/default.jpg')">
                    </div>
                    @endif
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="user-name">
                        {{Auth::user()->name}}
                    </div>
                    <br>
                    @if(Auth::user()->email != "")
                    <div class="user-email">
                        <small>Email:</small>&nbsp;&nbsp; {{Auth::user()->email}}
                    </div>
                    @endif
                    <div class="user-dateJoined">
                        <small>Member since:</small>&nbsp;&nbsp;{{date('d-m-Y', strtotime(Auth::user()->created_at))}}
                    </div>
                    <br>
                    <div class="user-options">
                        <ul>
                            <li>
                                <div class="user-settings">
                                    <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-cog"></i>&nbsp;Settings</a>
                                </div>
                            </li>
                            <li>
                                <div class="user-logout">
                                    <a href="/auth/logout" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="spacer"><div class="mask"></div></div>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <tabset>
                        <tab active="{{$likeActive}}">
                            <tab-heading>
                                <i class="glyphicon glyphicon-heart"></i>&nbsp;Likes
                            </tab-heading>
                            <div class="browse-articles-thumbs row">
                                <div class="browse-articles-thumb col-xs-4 col-sm-2" dir-paginate="articlesLike in articlesLikes | itemsPerPage: itemsByPage" pagination-id="page_like">
                                    <a href="/article/<%articlesLike.articleID%>">
                                        <img src="/img/articles/200x200/<%articlesLike.articleID%>/<%articlesLike.image_name%>">
                                        <div class="browse-article-top-txt">
                                            <div class="browse-article-title"><%articlesLike.title%></div>
                                            <div class="browse-article-artist"><%articlesLike.artist_name%></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center"><dir-pagination-controls pagination-id="page_like" boundary-links="true"></dir-pagination-controls></div>
                        </tab>
                        <tab active="{{$wishlistActive}}">
                            <tab-heading>
                                <i class="glyphicon glyphicon-star"></i>&nbsp;Wishlist
                            </tab-heading>
                            <div class="browse-articles-thumbs row">
                                <div class="browse-articles-thumb col-xs-4 col-sm-2" dir-paginate="articlesWishlist in articlesWishlists | itemsPerPage: itemsByPage" pagination-id="page_wishlist">
                                    <a href="/article/<%articlesWishlist.articleID%>">
                                        <img src="/img/articles/200x200/<%articlesWishlist.articleID%>/<%articlesWishlist.image_name%>">
                                        <div class="browse-article-top-txt">
                                            <div class="browse-article-title"><%articlesWishlist.title%></div>
                                            <div class="browse-article-artist"><%articlesWishlist.artist_name%></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center"><dir-pagination-controls pagination-id="page_wishlist" boundary-links="true"></dir-pagination-controls></div>
                        </tab>
                        <tab active="{{$followingActive}}">
                            <tab-heading>
                                <i class="glyphicon glyphicon-link"></i>&nbsp;Following
                            </tab-heading>
                            <div class="browse-artists-thumbs row">
                                <div class="browse-artists-thumb col-xs-3 col-sm-2 col-md-2" dir-paginate="artistsFollow in artistsFollows | itemsPerPage: itemsByPage" pagination-id="page_follow">
                                    <a href="/artist/<%artistsFollow.artistID%>">
                                        <div class="artist-md-cover" style="background-image: url('/img/artists/70x70/<%artistsFollow.artistID%>.jpg')"></div>
                                        <div class="browse-artists-top-txt" align="center">
                                            <div class="browse-artists-name"><%artistsFollow.name%></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center"><dir-pagination-controls pagination-id="page_follow" boundary-links="true"></dir-pagination-controls></div>
                        </tab>
                        <tab active="{{$cartActive}}">
                            <tab-heading>
                                <i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Cart
                            </tab-heading>
                            <br>
                            <table class="table table-striped table-hover user-cart-table">
                                <thead>
                                    <tr>
                                        <th class="col-xs-3 text-center table-header">Item</th>
                                        <th class="col-xs-3 text-center table-header">Artist</th>
                                        <th class="col-xs-1 text-center table-header">Quantity</th>
                                        <th class="col-xs-2 text-center table-header">Price</th>
                                        <th class="col-xs-1 text-center table-header"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="articlesCart in articlesCarts">
                                        <td><a href="/article/<%articlesCart.articleID%>"><% articlesCart.title %></a></td>
                                        <td><a href="/article/<%articlesCart.articleID%>"><% articlesCart.artist_name %></a></td>
                                        <td><a href="/article/<%articlesCart.articleID%>"><% articlesCart.quantity %></a></td>
                                        <td><a href="/article/<%articlesCart.articleID%>">$<% articlesCart.price %></a></td>
                                        <td><button class="btn btn-danger btn-xs" ng-click="deleteFromCart(articlesCart)"><i class="glyphicon glyphicon-remove"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div class="row">
                                <div class="col-xs-6 cart-total-txt">
                                    Total (without taxes)
                                </div>
                                <div class="col-xs-6 cart-total">
                                    $<% totalPrice %>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 cart-taxe-txt">
                                    Taxes (GST + QST)
                                </div>
                                <div class="col-xs-6 cart-taxe">
                                    $<% totalTax %>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-6 cart-totalWithTx-txt">
                                    TOTAL (with taxes)
                                </div>
                                <div class="col-xs-6 cart-totalWithTx">
                                    $<% totalPriceWithTax %>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-12 cart-checkout">
                                    <a class="btn btn-default btn-md" href=""><i class="glyphicon glyphicon-ok"></i>&nbsp;Checkout</a>
                                </div>
                            </div>
                        </tab>
                    </tabset>
                </div>
            </div>


        </div>
    </div>
</div>
@endif
@endsection
