<div class="modal modal-lg fade" id="modal-job" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-job">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="mb-3">
                     <div class="form-group">
                         <label for="name" class="form-label required">User</label>
                         <select name="user_id" id="user-edit-id" class="form-select select2">
                             <option value="">Select User</option>
                             @foreach($users as $user)
                                 <option value="{{ $user->id }}">{{ $user->name }}</option>
                             @endforeach
                         </select>
                     </div>
                    </div>
                    <div class="mb-3">
                     <div class="form-group">
                         <label for="name" class="form-label required">Project</label>
                         <select name="subcategory_id" id="subcategory-id" class="form-select select2">
                             <option value="">Select Project</option>
                             @foreach($subcategories as $subcategory)
                                 <option value="{{ $subcategory->id }}">{{ $subcategory->category->name . ' - ' . $subcategory->name }}</option>
                             @endforeach
                         </select>
                     </div>
                    </div>
                    <div class="mb-3">
                       <div class="form-group">
                           <label for="name" class="form-label required" style="display: block; margin-bottom:5px;">Detail</label>
                           <textarea name="title" id="title" cols="60" class="form-control" rows="4" style="padding: 10px;"></textarea>
                       </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="name" class="form-label required">Duration (Minute)</label>
                            <input type="number" class="form-control" name="duration" id="duration" placeholder="ex : 60">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" id="date" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btn-submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
