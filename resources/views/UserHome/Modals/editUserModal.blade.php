<div class="modal fade" id="UserModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editUserEventForm" class="form-horizontal" method="POST" action="">

                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="editId" name="editId" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Diary Edit</h5>
                    <button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  ">
                    <div class="form-group">
                        <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                            <label id="editTitle-label"  class="btn-sm scroll-home-label" for="editTitle">{{ __('Edit Title:') }}</label>
                            <input id="editTitle" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('editTitle') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Edit Title"  name="editTitle"  >
                            @error('editTitle')
                            <span  id="editTitle-alert" class="editTitle-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>
                    </div>


                    <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                        <div id="chooseMessage"></div>
                        <table id="maintenanceTableEdit" style="border-radius: 1rem; !important;" class="table table-responsive-lg table-borderless  btn-sm shadow-main">
                            <tr>
                                <td ><b>Maintenance type</b></td>

                                <td><b>Choose</b></td>
                            </tr>

                        </table>
                      </div>


                    <div class="form-group">
                        <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                            <label id="editStart-label"  class="btn-sm scroll-home-label" for="editStart">{{ __('Start date:') }}</label>
                            <input readonly id="editStart" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('editStart') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Start date"  name="editStart"  >
                            @error('editStart')
                            <span  id="editStart-alert" class="editStart-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                            <label id="editEnd-label"  class="btn-sm scroll-home-label" for="editEnd">{{ __('End date:') }}</label>
                            <input readonly id="editEnd" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('editEnd') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="End date"  name="editEnd"  >
                            @error('editEnd')
                            <span  id="editEnd-alert" class="editEnd-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    <button id="editUserEventSubmit" type="submit" class="btn btn-success  btn-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

