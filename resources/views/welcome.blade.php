@extends('main-layout')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $machine }}</h3>

              <p>Total Machine</p>
            </div>
            <div class="icon">
              <i class="ion ion-gear-a"></i>
            </div>
            <a href="{{route('index-machine')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $material }}</h3>

              <p>Total Material</p>
            </div>
            <div class="icon">
              <i class="ion ion-ionic"></i>
            </div>
            <a href="{{route('index-material')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $mould }}</h3>

              <p>Total Mould</p>
            </div>
            <div class="icon">
              <i class="ion ion-disc"></i>
            </div>
            <a href="{{route('index-mould')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $product }}</h3>

              <p>Total Product</p>
            </div>
            <div class="icon">
              <i class="ion ion-cube"></i>
            </div>
            <a href="{{route('index-product')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>
</section>

@endsection

@section('custom_js')

@endsection