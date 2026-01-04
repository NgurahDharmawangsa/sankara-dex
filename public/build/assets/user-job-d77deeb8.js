import{a as v}from"./helper-1d4e7fcb.js";import{c as y}from"./dashboard-51044aed.js";let o=[],i=1,h=$("#subcategory-url").val(),u="",d,c,r;ajaxGet(h).done(function(t){t.data.forEach(function(e,a){u+=`<option value="${e.id}">${e.category.name} - ${e.name}</option>`})});function m(){let t=document.querySelectorAll("#duration"),e=0;t.length>0&&t.forEach(function(a,l){e+=parseInt(a.innerHTML)}),$(".total-working-hour").html(y(e))}function p(){c=`<div class="modal fade" id="modal-category" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modalLabel">Add Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-add-job-user">
                    <div class="modal-body">
                         <div class="row">
                                <div class="col-lg-12 col-md-12 col-12 mb-2">
                                    <div class="form-group">
                                    <label for="subcategory_id" class="form-label required">Project</label>
                                    <select class="form-select select1 subcategory_id" data-select2-id="project1" id="modal-subcategory_id" name="subcategory_id" required>
                                        <option value="">Select Project</option>
                                        ${u}
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 mb-2">
                                   <div class="form-group">
                                    <label for="duration" class="form-label required">Duration (Minutes)</label>
                                    <input type="number" class="form-control duration" id="modal-duration"
                                           name="duration" value="" placeholder="ex : 120" required>
                                   </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 mb-2">
                                  <div class="form-group">
                                    <label for="title" class="form-label required">Detail</label>
                                    <textarea name="title" id="modal-title" class="form-control" rows="2" placeholder="Ex: create feature..." value="" required></textarea>
                                  </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="btn-modal-submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>`,$("body").append(c),$("#modal-category").on("shown.bs.modal",function(){$(".select1").select2({width:"100%",placeholder:"Select Project",dropdownParent:$("#modal-category")})})}function b(t=null){c||p(),$("#modal-category").modal("show"),$("#modal-title").val(t==null?void 0:t.title),$("#modal-duration").val(t==null?void 0:t.duration),$("#modal-subcategory_id").val(t==null?void 0:t.subcategory_id)}function g(t){$(t)[0].reset(),$("#modal-subcategory_id").val(null).trigger("change")}$(document).on("keyup",".duration",function(){$(this).val()==="0"&&$(this).val().length===1&&$(this).val("1")});$(document).on("submit","#modal-category #form-add-job-user",function(t){t.preventDefault();let e=$("#modal-title").val(),a=$("#modal-duration").val(),l=$("#modal-subcategory_id").val();if(a<0)return sweetInfo("Please enter a duration greater than 0");if(d==null){o.push({id:i,subcategory_id:l,title:e,duration:a});let s=`
            <tr>
                <td id="title" style="width: 60%;" class="text-wrap">${e}</td>
                <td id="duration" style="width: 25%;" class="text-wrap">${a}</td>
                <td style="width: 15%;">
                    <a href="javascript:void(0)" id="edit-${i}" data-id="${i}" class="btn btn-outline-warning btn-edit"><i class="bx bx-pencil"></i></a>
                    <a href="javascript:void(0)" id="delete-${i}" data-id="${i}" class="btn btn-outline-danger btn-delete"><i class="bx bx-trash"></i></a>
                </td>
            </tr>`;$("#task-data").append(s)}else o[d]={id:o[d].id,subcategory_id:l,title:e,duration:a},r.find("td:nth-child(1)").text(e),r.find("td:nth-child(2)").text(a);m(),$("#modal-category").modal("hide"),$("#modal-title").val(""),i++,d=void 0,r=void 0});$(document).on("submit","#form-job",function(t){t.preventDefault();let e="#btn-save",a=$("#save-url").val(),l="";o.forEach(function(n,f){l+=`
            <input type="hidden" id="title" name="title[]" value="${n.title}">
            <input type="hidden" id="duration" name="duration[]" value="${n.duration}">
            <input type="hidden" id="subcategory-id" name="subcategory_id[]" value="${n.subcategory_id}">
        `}),$(".container-form-job").html(l);let s=new FormData(this);o.length==0?sweetInfo("Please insert your data!"):Swal.fire({title:"Are you sure?",text:"Data can't edit after save, click Yes to continue",type:"warning",showCancelButton:!0,confirmButtonColor:"#0d6efd",cancelButtonColor:"#d33",confirmButtonText:"Yes, Save it!"}).then(n=>{n.value&&v(a,s,e).done(function(f){Swal.fire({title:"Succeed!",text:"Data created successfully",type:"success"}),$("#form-job .container-form-job").empty(),$("#task-data").empty(),o=[],i=1})})});$(document).on("click","#form-job .table .btn-delete",function(){let t=$(this).closest("tr"),e=$(this).data("id");Swal.fire({title:"Are you sure?",text:"You won't be able to return this!",type:"warning",showCancelButton:!0,confirmButtonColor:"#0d6efd",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete!"}).then(a=>{a.value&&(Swal.fire({title:"Deleted!",text:"Data has been delete.",type:"success"}),t.remove(),o.splice(o.findIndex(l=>l.id===e),1),m())})});$(document).on("click","#form-job .table #task-data .btn-edit",function(){let t=$(this).data("id");r=$(this).closest("tr"),d=o.findIndex(a=>a.id===t);let e=o[d];b(e),$(document).on("hidden.bs.modal","#modal-category",function(){d=void 0,r=void 0}),$("#modalLabel").empty().html("Edit Job"),$("#btn-modal-submit").empty().html("Edit")});$(document).on("hidden.bs.modal","#modal-category",function(){g("#form-add-job-user")});$(document).on("click","#btn-new",function(){b(),$("#modalLabel").empty().html("Add Job"),$("#btn-modal-submit").empty().html("Add")});
