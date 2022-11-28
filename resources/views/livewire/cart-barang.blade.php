<div>
    <div class="bg-primary rounded-3 text-white p-2">
        Keranjang : 
        <table class="table text-white">
            <tr>
                <th>Barang : </th>
                <th>Qty : </th>
                <th>Action : </th>
            </tr>
            <tbody style="max-height: 100px; overflow:scroll;">
                @forelse ($data as $i)
                    <tr>
                        <td>{{ Str::limit($i->barang->nama, 7, '...') }}</td>
                        <td>x{{ $i->stock }}</td>
                        <td><button wire:click="batalCart({{ $i->id }})" class="btn-sm btn btn-danger">Batal</button></td>
                    </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">
                        Belum Ada Pesanan
                    </td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    @if ($data != Null && $data->count() > 0)
                    {{-- {{ dd($data->count()); }} --}}
                    <th colspan="2"> Pesan Sekarang!</th>
                        <th>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Pesan
                            </button>
                            
                            <form wire:submit.prevent="createRequestSuply({{ $data }},{{ Auth::user()->id }})">
                                <!-- Modal -->
                                <div wire:ignore.self class="modal fade text-black" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Pesanan Sekarang!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating">
                                                    <textarea wire:model="keterangan" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                                    <label for="floatingTextarea2">Detail Keperluan Pesanan</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form> 
                        </th>
                    @endif
                </tr>
            </tfoot>
        </table>
    </div>
</div>
