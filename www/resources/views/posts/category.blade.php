@extends('layouts.main')
@section('content')
    <section class="site-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h2 class="mb-4">Category: {{$data['category']->name}}</h2>
                </div>
            </div>
            <div class="row blog-entries">
                <div class="col-md-12 col-lg-8 main-content">
                    <div class="row mb-5 mt-5">
                        <div class="col-md-12">
                            @foreach ($data['posts'] as $post)
                                <div class="post-entry-horzontal">
                                    <a href="/{{$post->category->slug}}/{{$post->slug}}">
                                        <div class="image element-animate" data-animate-effect="fadeIn"
                                            style="background-image: url(images/img_{{ rand(1, 12) }}.jpg);"></div>
                                        <span class="text">
                                            <div class="post-meta">
                                                <span class="category">{{$post->category->name}}</span>
                                                <span class="mr-2">{{$post->created_at->format('F j, Y')}}</span> &bullet;
                                                <span class="ml-2"><span class="fa fa-comments"></span>3</span>
                                            </div>
                                            <h2>{{$post->title}}</h2>
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <nav aria-label="Page navigation" class="text-center">
                                <ul class="pagination">
                                    @if ($data['posts']->total() > $data['posts']->perPage())
                                        @foreach ($data['posts']->linkCollection() as $page)
                                            <li
                                                class="page-item {{ $page['active'] ? 'active' : '' }} {{ $page['url'] ? '' : 'disabled' }}">
                                                <a class="page-link" href="{{ $page['url'] ?? '#' }}">{!! $page['label'] !!}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>



                </div>

                <!-- END main-content -->

                <div class="col-md-12 col-lg-4 sidebar">
                    <div class="sidebar-box search-form-wrap">
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <span class="icon fa fa-search"></span>
                                <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                            </div>
                        </form>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <div class="bio text-center">
                            <img src="images/person_1.jpg" alt="Image Placeholder" class="img-fluid">
                            <div class="bio-body">
                                <h2>Meagan Smith</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt
                                    repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias
                                    minus.</p>
                                <p><a href="#" class="btn btn-primary btn-sm">Read my bio</a></p>
                                <p class="social">
                                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <h3 class="heading">Popular Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                @foreach($data['posts']->take(3) as $post)
                                    <li>
                                        <a href="/{{$post->category->slug}}/{{$post->slug}}">
                                            <img src="images/img_{{ rand(1, 12) }}.jpg" alt="Image placeholder" class="mr-4">
                                            <div class="text">
                                                <h4>{{ $post->title }}</h4>
                                                <div class="post-meta">
                                                    <span class="mr-2">{{$post->created_at->format('F j, Y')}}</span> &bullet;
                                                    <span class="ml-2"><span class="fa fa-comments"></span>3</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <h3 class="heading">Categories</h3>
                        <ul class="categories">
                            @foreach ($categories as $category)
                                <li><a href="{{$category->slug}}">{{$category->name}}<span>({{rand(1, 100)}})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- END sidebar-box -->

                </div>
                <!-- END sidebar -->

            </div>
        </div>
    </section>
@endsection