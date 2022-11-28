<div>
    <div class="row">
        <div class="col-md-6">

            <input wire:model="search" class="form-control" type="text" placeholder="Search...">
        </div>
        <ul class="side-nav btn btn-success col-md-6 ms-auto">
            <a data-bs-toggle="collapse" href="#kategori" aria-expanded="false" aria-controls="kategori" class="text-white">
                <li class="side-nav-item">Kategori</li>
            </a>
            <div class="collapse" id="kategori">
                <hr>
                <ul class="side-nav-second-level row">
                    <li class="side-nav-link col-6" wire:click="kategori('')">
                        <span>Semua Kategori</span>
                    </li>
                    @foreach ($kategori as $i)
                        <li class="side-nav-link col-6" wire:click="kategori('{{ $i->nama }}')">
                            <span>{{ $i->nama }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </ul>

    </div>
</div>
