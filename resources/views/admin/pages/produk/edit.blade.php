@extends('admin.layouts.default')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col">
                                <a href="" class="text-dark font-weight-bold"><i class="right fas fa-angle-left"></i> kembali</a>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <h4 class="card-title font-weight-normal">Edit Produk</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- {{ route('admin.matkul.store') }} --}}
                        <form method="POST" action="{{ route('admin.produk-update', $item->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h5>Informasi Produk</h5>
                            <h6 class="text-danger">* Wajib diisi</h6>
                              
                            {{-- <hr> --}}
                            <div class="form-group">
                                <label for="name">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ? old('name') : $item->name }} " required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category">Kategori <span class="text-danger">*</span></label>
                                <select class="form-control category @error('category') is-invalid @enderror" name="category" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $item->category_id ? "selected" : "" }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi Produk <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description') ? old('description') : $item->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <hr> --}}
                            {{-- <h6>Foto Produk</h6> --}}
                            <div class="form-group mb-5">
                                <label for="name">Foto Produk</label>
                                <div class="row">
                                    <div class="col-2 text-center">
                                        <a href="" onclick="inputFoto1(event)" >
                                            <img src="{{ isset($item->images[0]->number) == 1 ? asset($item->images[0]->dir_photo) : asset('assets/admin/img/add-foto.png') }}" class="img-thumbnail" id="foto1" alt="...">
                                        </a>
                                        <input class="@error('image1') is-invalid @enderror" type="file" name="image1" id="image1" onchange="changeFoto1(this)" accept="image/png, image/jpg, image/jpeg" hidden>
                                        <h6 class="text-center mt-2">Foto utama <span class="text-danger">*</span></h6>
                                        
                                        @error('image1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-2">
                                        <a href="" onclick="inputFoto2(event)">
                                            <img src="{{ isset($item->images[1]->number) == 2 ? asset($item->images[1]->dir_photo) : asset('assets/admin/img/add-foto.png') }}" class="img-thumbnail" alt="..."  id="foto2" accept="image/png, image/jpg, image/jpeg">
                                        </a>
                                        <h6 class="text-center mt-2">Foto 1</h6>
                                        <input class="@error('image2') is-invalid @enderror" type="file" name="image2" id="image2"  onchange="changeFoto2(this)" style="display: none">
                                        @error('image2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-2">
                                        <a href="" onclick="inputFoto3(event)">
                                            <img src="{{ isset($item->images[2]->number) == 3 ? asset($item->images[2]->dir_photo) : asset('assets/admin/img/add-foto.png') }}" class="img-thumbnail" alt="..." id="foto3" accept="image/png, image/jpg, image/jpeg">
                                        </a>
                                        <h6 class="text-center mt-2">Foto 2</h6>
                                        <input class="@error('image3') is-invalid @enderror" type="file" name="image3" id="image3"  onchange="changeFoto3(this)" style="display: none">
                                        @error('image3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col my-auto ml-4">
                                        <span class=" font-weight-bold">
                                            Catatan : 
                                                <ul>
                                                    <li>Ukuran foto disarankan 550 x 750</li>
                                                    <li>Besar file foto kurang dari 2 MB</li>
                                                </ul>
                                        </span>
                                    </div>
                                </div>
                                <span class="text-danger font-weight-bold">(Klik gambar untuk merubah)</span>
                                
                            </div>
                            <hr>
                            {{-- <hr> --}}
                            <h5 class="mt-5">Informasi Penjualan
                            </h5>
                            <table class="table table-borderless" id="edit">
                                <thead>
                                    <tr>
                                        <th>Ukuran</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->detail as $dtl)
                                    <tr class="cloned-row" id="row{{ $loop->iteration }}">
                                        <td>
                                            <input type="text" class="form-control size @error('size{{ $loop->iteration }}') is-invalid @enderror" id="size{{ $loop->iteration }}" name="size[{{ $loop->iteration }}]" value="{{ old('size'.$loop->iteration) ? old('size'.$loop->iteration) : $dtl->size }}" maxlength="3" required>
                                            @error('size'.$loop->iteration)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control stock @error('stock{{ $loop->iteration }}') is-invalid @enderror" id="stock{{ $loop->iteration }}" name="stock[{{ $loop->iteration }}]" value="{{ old('stock'.$loop->iteration) ? old('stock'.$loop->iteration) : $dtl->stock }}" required>
                                            @error('stock'.$loop->iteration)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon{{ $loop->iteration }}">Rp</span>
                                                </div>
                                                <input type="number" class="form-control price @error('price{{ $loop->iteration }}') is-invalid @enderror" id="price{{ $loop->iteration }}" name="price[{{ $loop->iteration }}]" value="{{ old('price'.$loop->iteration) ? old('price'.$loop->iteration) : $dtl->price }}" required>
                                            </div>
                                            @error('price'.$loop->iteration)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <a href="#" class="text-danger hapus-input" id="hapus" hidden>Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                    
                                </tbody>
                                
                            </table>
                            <div class="text-center">
                                <a href="" class="text-center" onclick="addInput(event)">+ Tambah Ukuran</a>
                            </div>
                         
                            
                            <label for="">Aktifkan Produk <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Produk akan ditampilkan dihalaman user"></i></label>
                            <div class="custom-control custom-switch ">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="active" value="{{ $item->active }}" onclick="status()" {{ $item->active == "y" ? "checked" : "" }}>
                                <label class="custom-control-label" for="customSwitch1" ></label>
                              </div>
                            <hr>
                            {{-- <img src="{{ asset('assets/admin/img/hafidz1.jpg') }}"  alt="..."  id="crop-foto"> --}}
                            <div class="btn-bap text-right">
                                <button type="submit" class="btn btn-success">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('before-style')
<link rel="stylesheet" href="{{ asset('assets/adminLte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/adminLte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
{{-- <link rel="stylesheet" href="https://unpkg.com/jcrop/dist/jcrop.css"> --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
@endpush
@push('after-script')
<script src="{{ asset('assets/adminLte/plugins/select2/js/select2.full.min.js') }}"></script>
{{-- <script src="https://unpkg.com/jcrop"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        
        
        $(document).ready(function(){
            $('.category').select2();
            // Jcrop.attach('crop-foto');
            // const size = $('.size').length;

            $('.size').attr('id', function(i) {
                return 'size'+(i+1);
            });
            $('.size').attr('name', function(i) {
                return 'size['+(i+1)+']';
            });

            $('.hapus-input').attr('onclick', function(i) {
                return 'hapus('+(i+1)+')';
            });

            $('.hapus-input').attr('id', function(i) {
                return 'hapus'+(i+1);
            });

            $('.hapus-input').not(':first').removeAttr('hidden');
            // for (let i = 0; i < size; i++) {
            //     alert(size);

            //     var a = $("input")[i].attr("target", "size1" );
            //     alert(a);
            // }
        });

        function inputFoto1(event){
            event.preventDefault();
            $('#image1').click();
        }

        function inputFoto2(event){
            event.preventDefault();
            $('#image2').click();
        }

        function inputFoto3(event){
            event.preventDefault();
            $('#image3').click();
        }

        function changeFoto1(input){
            var file = input.files[0];
 
            if(file){
                var reader = new FileReader();
                
    
                reader.onload = function(){
                    console.log(reader.result);
                    $('#foto1').attr("src", reader.result);
                }
                
                reader.readAsDataURL(file);
            }
        }
        function changeFoto2(input){
            var file = input.files[0];n
            if(file){
                var reader = new FileReader();
                
    
                reader.onload = function(){
                    console.log(reader.result);
                    $('#foto2').attr("src", reader.result);
                }
    
                reader.readAsDataURL(file);
            }
        }
        function changeFoto3(input){
            var file = input.files[0];
 
            if(file){
                var reader = new FileReader();
                
    
                reader.onload = function(){
                    console.log(reader.result);
                    $('#foto3').attr("src", reader.result);
                }
    
                reader.readAsDataURL(file);
            }
        }

        function addInput(event){
            event.preventDefault();
            // console.log($('.cloned-row').clone());
            $('tbody tr:last').clone().insertAfter("tbody tr:last");
            // $('tbody tr input:last').attr("value", "");
            $('tbody tr').attr('id', function(i) {
                return 'row'+(i+1);
            });
            $('.size').attr('id', function(i) {
                return 'size'+(i+1);
            });
            $('.size:last').val("");
            $('.size').attr('name', function(i) {
                return 'size['+(i+1)+']';
            });
            $('.stock').attr('id', function(i) {
                return 'stock'+(i+1);
            });
            $('.stock').attr('name', function(i) {
                return 'stock['+(i+1)+']';
            });
            $('.stock:last').val("");
            $('.price').attr('id', function(i) {
                return 'price'+(i+1);
            });
            $('.price').attr('name', function(i) {
                return 'price['+(i+1)+']';
            });
            $('.price:last').val("");
            $('.hapus-input').attr('onclick', function(i) {
                return 'hapus('+(i+1)+')';
            });

            $('.hapus-input').attr('id', function(i) {
                return 'hapus'+(i+1);
            });

            $('.hapus-input').not(':first').removeAttr('hidden');
        }

        function hapus(id){
            event.preventDefault();
            $('#row'+id).remove();
            $('.size').attr('id', function(i) {
                return 'size'+(i+1);
            });
            $('.size').attr('name', function(i) {
                return 'size['+(i+1)+']';
            });
            $('.stock').attr('id', function(i) {
                return 'stock'+(i+1);
            });
            $('.stock').attr('name', function(i) {
                return 'stock['+(i+1)+']';
            });
            $('.price').attr('id', function(i) {
                return 'price'+(i+1);
            });
            $('.price').attr('name', function(i) {
                return 'price['+(i+1)+']';
            });
            $('.hapus-input').attr('onclick', function(i) {
                return 'hapus('+(i+1)+')';
            });

            $('.hapus-input').attr('id', function(i) {
                return 'hapus'+(i+1);
            });

            $('.hapus-input').not(':first').removeAttr('hidden');
        }
        function status(){
            
            if ($('#customSwitch1').prop("checked") == true) {
                $('#customSwitch1').val("y");
            }else {
                $('#customSwitch1').val("t");
            }
        }
    </script>
@endpush