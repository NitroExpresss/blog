@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
  <section class="site-section pt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="owl-carousel owl-theme home-slider">
            <div>
              <a href="blog-single.html" class="a-block d-flex align-items-center height-lg" style="background-image: url('images/img_1.jpg');">
                <div class="text half-to-full">
                  <div class="post-meta">
                    <span class="category">Lifestyle</span>
                    <span class="mr-2">March 15, 2018 </span> &bullet;
                    <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                  </div>
                  <h3>There’s a Cool New Way for Men to Wear Socks and Sandals</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem nobis, ut dicta eaque ipsa laudantium!</p>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
