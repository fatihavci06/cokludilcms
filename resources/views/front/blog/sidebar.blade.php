<div class="col-lg-3 xs-padding">
                        <div class="sidebar-wrap">
                            <div class="sidebar-widget mb-50">
                                <h4>@lang('general.search')</h4>
                                <form action="{{route('front.blog_search')}}" method="get" class="search-form">
                                    <input type="text" name='name' class="form-control" placeholder="@lang('general.search')">
                                    <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <div class="sidebar-widget mb-50">
                                <h4>@lang('general.categories')</h4>
                                <ul class="cat-list">
                                    @php
                                    $ca=\App\Http\Controllers\front\IndexController::getCategory();

                                    @endphp
                                    
                                    @foreach($ca as $c)
                                    <li><a href="{{route('front.blog_cat',['slug'=>$c->slug])}}">{{$c->name}}</a><span>{{$c->cat_count->count()}}</span></li>
                                    @endforeach
                                    
                                </ul>
                            </div><!-- Categories --> 
                            
                            <div class="sidebar-widget mb-50">
                                <h4>@lang('general.random_post')</h4>
                                <ul class="recent-posts">
                                    @php 
                                    $ra=\App\Http\Controllers\front\IndexController::getRandomBlog();
                                    @endphp
                                    @foreach($ra as $r)
                                    <li>
                                        <img src="{{Storage::url($r->image)}}" alt="blog post">
                                        <div>
                                            <h4><a href="{{route('front.blog_detail',$r->slug)}}">{{$r->title}}</a></h4>
                                            <span class="date"><i class="fa fa-clock-o"></i> {{$r->date}}</span>   
                                        </div>                 
                                    </li>
                                    @endforeach
                                </ul>
                            </div><!-- Recent Posts -->
                            
                        </div><!-- /Sidebar Wrapper -->
                    </div>

