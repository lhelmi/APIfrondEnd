<!-- Modal -->
<div class="modal fade" id="addBook" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addBookLabel">Add</h5>
            
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="form-create" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="hidden" class="form-control" id="field-id" name="id">
                            <input type="text" class="form-control" id="field-name" name="name">
                            <span id="error-name" class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="field-price" name="price">
                            <span id="error-price" class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="field-stock" name="stock">
                            <span id="error-stock" class="invalid-feedback"></span>
                        </div>
                    </div>  
                    
                </div>
            </div>
        <div class="modal-footer">
            <button type="button" id="btnCloseBook" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" id="btnAddBook" class="btn btn-primary" value="Save">
        </div>
        </div>
    </div>
</div>