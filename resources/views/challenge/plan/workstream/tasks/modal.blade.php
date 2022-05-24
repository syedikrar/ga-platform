@php
$isEdit = isset($task) ? true : false;
$url = $isEdit ? route('dashboard.workstream-tasks.update', $task->id) : route('dashboard.workstream-tasks.store');
@endphp
<form action="{{ $url }}" method="POST" id="task_form" data-datatable="#work_stream" data-form="ajax-form" data-modal="#ajax_model" >
    @csrf
    @if($isEdit)
    @method('put')
    @endif
    <div class="container">
        <div class="row p-2 border-bottom">
            <div class="col-sm-12 pt-1">
                <div class="nk-file-name">
                    <div class="nk-file-name"><span class="title"><img
                                src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="" class="mr-2" width="6%"> ADD
                            New Task</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-body p-4">
        <div id="tasks-wizard">
            <h3>Basic Details</h3>
            <section>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Title In English</label>
                            <input type="text" placeholder="Title In English" name="title_en"
                                required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Title In Arabic</label>
                            <input type="text" placeholder="Title In Arabic" name="title_ar"
                                required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Start Date</label>
                            <input type="datetime-local" placeholder="Entity Website"
                                name="start_date">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> End Date</label>
                            <input type="datetime-local" name="end_date">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Priority</label>
                            <select name="priority" id="priority"
                                class="form-select form-control form-select-modal"
                                data-search="on">
                                <option value="" selected="">Choose Priority</option>
                                <option value="low">Low</option>
                                <option value="medium">medium</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Status</label>
                            <select name="status" id="status"
                                class="form-select form-control form-select-modal"
                                data-search="on">
                                <option value="" selected="">Choose Priority</option>
                                <option value="in progress">In Progress</option>
                                <option value="complete">Complete</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Progress</label>
                            <input type="text" placeholder="Progress" name="progress" required>
                        </div>
                    </div>

                </div>
            </section>
            <h3>Members</h3>
            <section>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-searchbar">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-search"></em>
                                    </div>
                                    <input type="text" class="form-control" id="searchBar"
                                        placeholder="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="container">
                            <div class="row gy-4">
                                <div class="col-sm-4">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <img src="{{ asset('images/dashboard/author-img.png')}}" alt="">
                                        </div>
                                        <div class="user-info">
                                            <a href=""><span>User Name</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">Entity</div>
                                <div class="col-sm-4">
                                    <div class="custom-control">
                                        <input type="checkbox" name="members[]" class="custom-control"
                                            value="">
                                        <!-- <label class="custom-control-label" for="existing_user_form"></label> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 bg-white">
                        <ul class="btn-toolbar g-3">
                            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
                            <li><button href="#" type="submit"  class="btn btn-primary">Save</button></li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>
</form>
<script>
    $("#tasks-wizard").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true
});
</script>