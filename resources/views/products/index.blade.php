@extends('layout.app')
@section('content')
<div class="m-3">
    {{-- <a href="{{ route('product.create') }}" class="btn btn-primary">add</a> --}}
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBook" id="btnAdd">
        Add
    </button>
</div>
<table id="product-table" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Stock</th>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@include('products.addModal')
@stop
@push('scripts')
<script>
let sub = null
$(document).ready(function() {
    $("#btnAdd").click(function () {
        sub = 'add'
    })

    $.ajax({
        url: "{{ route('product.home') }}",
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
            let bookTable = $('#product-table').DataTable({
                serverSide: false,
                responsive: true,
                bDestroy: true,
                data: response.data,
                columns: [
                    {
                        "data": "id", render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'stock', name: 'stock'},
                    {
                        data: "id" , render : function ( data, type, row, meta ) {
                            if(type === 'display'){
                                let dropdown = ''
                                dropdown += '<div class="dropdown">'
                                    dropdown += '<button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'
                                        dropdown += 'Action'
                                    dropdown += '</button>'
                                    dropdown += '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">'
                                    dropdown += '<li><a class="dropdown-item" href="javascript:void(0)" onClick="view('+ data +')">View</a></li>'
                                    dropdown += '<li><a class="dropdown-item" href="javascript:void(0)" onClick="edit('+ data +')">Edit</a></li>'
                                    dropdown += '<li><a class="dropdown-item" href="javascript:void(0)" onClick="destroy('+ data +')">Delete</a></li>'
                                    dropdown += '</ul>'
                                dropdown += '</div>'
                                return dropdown
                            }else{
                                return data
                            }
                        }
                    },
                ]
            })
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        }
    })
});

$("#form-create").submit(function (e) {
    // console.log('ok');
    let id = $("#field-id").val()
    e.preventDefault();
    let formData = new FormData($('#form-create')[0]);
    let myurl = null
    let action = null
    if(sub == 'edit'){
        myurl = '{{ route("product.update", ":id") }}';
        myurl = myurl.replace(':id', id);
        action = 'POST'
        formData.append('_method', 'PUT');
    }else{
        myurl = "{{ route('product.store') }}";
        action = 'POST'
    }
    $.ajax({
        url: myurl,
        type: action,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            $('.is-invalid').removeClass('is-invalid')
            if (response.errors == null) {
                window.location.reload()
            }else{
                for (control in response.errors) {
                    $('#field-' + control).addClass('is-invalid');
                    $('#error-' + control).html(response.errors[control]);
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        }
    })
});

function edit(id){
    let myurl = '{{ route("product.show", ":id") }}';
    myurl = myurl.replace(':id', id);
    sub = 'edit'
    
    $.ajax({
        url : myurl,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
            $("#addBook").modal('show');
            console.log(response)
            $('[name="id"]').val(response.data.id);
            $('[name="name"]').val(response.data.name);
            $('[name="price"]').val(response.data.price);
            $('[name="stock"]').val(response.data.stock);
        },
        error: function (jqXHR, textStatus, errorThrown){
            console.log(jqXHR);
        }
    });
}
</script>
@endpush