<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Barang Terbaru</h2>
        <h5>See more? <a href="{{ url('list-barang') }}"> here!</a></h5>
      </div>

      <div class="row">
        
      @foreach ($barang as $b)
            @php
                if($b->stock >= 100){
                    $bg = 'success';
                    $title = 'Ready';
                }elseif ($b->stock >= 1 && $b->stock < 100) {
                    $bg = 'warning';
                    $title = 'Hampir Habis';
                }else {
                    $bg = 'danger';
                    $title = 'Habis';
                }
            @endphp
            <div class="col-md-4 col-lg-3 col-sm-6">
                <!-- Simple card -->
                <div class="card d-block border-info border ">
                    <img class="card-img-top" src="{{ asset('/img/barang/'.$b->foto) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-info">{{ $b->nama }} <span style="font-size: 0.6rem" class="align-self-center text-center badge text-bg-{{ $bg }}">{{ $title }}</span></h5>
                        <p class="card-text">
                            
                            Kategori : 
                            <a href="{{ url('/list-barang',$b->kategori->nama) }}" disabled class="card-text">
                                <span>{{ $b->kategori->nama }}</span>
                            </a>
                        </p>
                        <a href="{{ url('/list-barang') }}" class="btn btn-info btn-sm">Pesan</a>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div><!-- end col -->
          @endforeach
        </div>

    </div>
  </section>
