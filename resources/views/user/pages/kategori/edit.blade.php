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
                                <a href="{{ route('admin.kategori') }}" class="text-dark font-weight-bold"><i class="right fas fa-angle-left"></i> kembali</a>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <h4 class="card-title font-weight-normal">Ubah Kategori</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- {{ route('admin.matkul.store') }} --}}
                        <form method="POST" action="{{ route('admin.kategori-update', $item->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                              
                            {{-- <hr> --}}
                            <div class="form-group">
                                <label for="name">Nama Kategori </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ? old('name') : $item->name }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
            var file = input.files[0];
 
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
            // $('.size').attr('value', function(i) {
            //     return "{{ old('size"+(i+1)+"') ? old('size"+(i+1)+"') : '' }}";
            // });
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
    </script>
@endpush