@extends('layouts.main')
@section('content')
    <section class="site-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h1>Contact</h1>
                </div>
            </div>
            <div class="row blog-entries">
                <div class="col-md-12 col-lg-8 main-content">

                    <form action="{{ route('contact.submit') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="phone">Phone</label>
                                <input pattern="\+7[0-9]{10}" placeholder="+7(___)___-__-__" type="tel" id="phone" name="phone" class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="message">Write Message</label>
                                <textarea name="message" id="message" class="form-control" cols="30" rows="8"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="submit" value="Send Message" class="btn btn-primary">
                            </div>
                        </div>
                    </form>


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
                                <li>
                                    <a href="">
                                        <img src="images/img_2.jpg" alt="Image placeholder" class="mr-4">
                                        <div class="text">
                                            <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">March 15, 2018 </span> &bullet;
                                                <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="images/img_4.jpg" alt="Image placeholder" class="mr-4">
                                        <div class="text">
                                            <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">March 15, 2018 </span> &bullet;
                                                <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="images/img_12.jpg" alt="Image placeholder" class="mr-4">
                                        <div class="text">
                                            <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">March 15, 2018 </span> &bullet;
                                                <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <h3 class="heading">Categories</h3>
                        <ul class="categories">
                            <li><a href="#">Courses <span>(12)</span></a></li>
                            <li><a href="#">News <span>(22)</span></a></li>
                            <li><a href="#">Design <span>(37)</span></a></li>
                            <li><a href="#">HTML <span>(42)</span></a></li>
                            <li><a href="#">Web Development <span>(14)</span></a></li>
                        </ul>
                    </div>
                    <!-- END sidebar-box -->

                </div>
                <!-- END sidebar -->
            </div>
        </div>
    </section>

@endsection