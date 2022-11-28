<div>
        <div class="row">
        @forelse ($barang as $b)
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
        
            

        <div class="col-md-4 col-lg-3 col-sm-6" wire:ignore.self>
            <!-- Simple card -->
            <div class="card d-block ribbon-box border-info border h-full">
                <img class="card-img-top" src="{{ asset('/img/barang/'.$b->foto) }}" alt="Card image cap">
                <div class="card-body fs-6 p-1">
                    <div class="ribbon-two ribbon-two-{{ $bg }}"><span>{{ $title }}</span></div>
                    <h5 class="card-title text-info">{{ $b->nama }}</h5>
                    <p class="card-text">
                        Stock : {{ $b->stock }}
                        <br>
                        Kategori : 
                        {{-- <a href="{{ url('/list-barang',$b->kategori->nama) }}" class="card-text"> --}}
                            <span>{{ $b->kategori->nama }}</span>
                        {{-- </a> --}}
                    </p>
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#standard-modal{{ $b->id }}" {{ $b->stock <= 0 ? 'disabled' : '' }}>Pesan</button>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div><!-- end col -->

        <!-- Standard modal -->
        <div id="standard-modal{{ $b->id }}" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                    <form id="myForm" wire:submit.prevent='createCart({{ Auth::user()->id }},{{ $b->id }})'>
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Pesan : {{ $b->nama }}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Quantity</label>
                                <input type="number"  wire:model="quantity" max="{{ $b->stock }}" id="simpleinput" class="form-control" required>
                            </div>
                            
                            <input type="hidden" name="tanggal_request" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" onclick="addBarang(this.form.elements)" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        @empty
        <h3 class="text-center">Items Not Founds...</h3>
        @endforelse
        @if ($barang->count() >= 20)
        <div wire:click="loadMore" class="btn cursor-pointer text-center py-4">
            Load More...
        </div>
            
        @endif

        </div>

    @section('js')
        <script>
            
            document.getElementsByClassName("myForm").onkeypress = function(e) {
                var key = e.charCode || e.keyCode || 0;     
                if (key == 13) {
                    e.preventDefault();
                    return false;
                }
            } 
            var no = 1;
            function addBarang(data){
                if (data.quantity.value <= data.quantity.max) {
                    Swal.fire(
                        'success','berhasil menambahkan barang','success'
                    )
                }else{
                    Swal.fire(
                        'error','gagal minta barang','error'
                    )
                    return;
                }
                var target = document.getElementById('suply-out');
                target.innerHTML += 
                `<div id="keranjang-${no++}">
                    ${data.barang_name.value.substring(0,5)} ${data.quantity.value}
                </div>`
                // console.log(data.quantity.value);
            }

        </script>
    @endsection
</div>