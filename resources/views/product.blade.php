@extends('layouts.app')

@section('content')

<main>


    <section class="container">
        <h2>Category</h2>
        @foreach ($categories as $category)
        <a href="{{route('product-list', $category->slug)}}"><button class="btn btn-secondary">{{ $category->name }}</button></a>
        @endforeach
    </section>



    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                @foreach ($products as $product)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{ Storage::url($product->image) }}" alt="">

                        <div class="card-body">
                            <p class="card-text">{{ $product->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="product/{{ $product->id }}" class="btn btn-sm btn-outline-secondary">View</a>
                                    <a href="{{ route('add.cart', [$product->id]) }}" class="btn btn-sm btn-outline-secondary">Add to cart</a>
                                </div>
                                <small class="text-muted">RM {{ $product->price }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <center style='margin-bottom: 20px;'>
      <a href="{{route('moreProduct')}}"><button class="btn btn-success">More Product</button>
      </a>
    </center>
  

    <section class="container">
        <div class="jumbotron">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">


                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ Storage::url('images/NpxttqTikmuVsvGNq9afPq33hCDiFwbwR5oEYhIy.jpg') }}" alt="Error" class="img-thumbnail">
                            </div>
                            <div class="col-4">
                                <img src="{{ Storage::url('images/NpxttqTikmuVsvGNq9afPq33hCDiFwbwR5oEYhIy.jpg') }}" alt="Error" class="img-thumbnail">
                            </div>
                            <div class="col-4">
                                <img src="{{ Storage::url('images/NpxttqTikmuVsvGNq9afPq33hCDiFwbwR5oEYhIy.jpg') }}" alt="Error" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ Storage::url('images/2aiwfNw3Xzgs7zyIUKcmJdi6vjRZHVHF8dGgPSoF.jpg') }}" alt="Error" class="img-thumbnail">
                            </div>
                            <div class="col-4">
                                <img src="{{ Storage::url('images/NpxttqTikmuVsvGNq9afPq33hCDiFwbwR5oEYhIy.jpg') }}" alt="Error" class="img-thumbnail">
                            </div>
                            <div class="col-4">
                                <img src="{{ Storage::url('images/NpxttqTikmuVsvGNq9afPq33hCDiFwbwR5oEYhIy.jpg') }}" alt="Error" class="img-thumbnail">
                            </div>
                        </div>
                    </div>





                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>


        </div>

    </section>



</main>

@endsection