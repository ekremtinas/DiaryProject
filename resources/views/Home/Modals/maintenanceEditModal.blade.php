<div class="modal col-lg-4 offset-lg-4" id="MaintenanceEditModal"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="maintenanceEditForm" action="">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title">Maintenance Edit</h5>
                <button id="maintenanceEditCloseX" type="button" data-dismiss="modal" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                        <label id="maintenanceEditTitle-label"  class="btn-sm scroll-home-label" for="maintenanceEditTitle">{{ __('Maintenance Title:') }}</label>
                        <input id="maintenanceEditTitle" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('maintenanceEditTitle') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Maintenance Title"  name="maintenanceEditTitle"  >
                        @error('maintenanceEditTitle')
                        <span  id="maintenanceEditTitle-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                        @enderror

                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group btn-group-sm mt-4 col-lg-10 offset-lg-1 ">

                        <label id="maintenanceEditMinute-label"  class="btn-sm scroll-home-label" for="maintenanceEditMinute">{{ __('Maintenance Minute:') }}</label>
                        <input id="maintenanceEditMinute" data-bvalidator="required" type="time"  class="form-control btn-sm  border-light shadow-main rounded-pill @error('maintenanceEditMinute') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Maintenance Minute"  name="maintenanceEditMinute"  >
                        @error('maintenanceEditMinute')
                        <span  id="maintenanceEditMinute-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 "  role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                        @enderror

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button id="maintenanceEditClose" data-dismiss="modal" type="button" class="btn btn-danger btn-sm" >Close</button>
                <button id="maintenanceEditSubmit" type="submit" class="btn btn-success  btn-sm">Save Edit</button>
            </div>
            </form>
        </div>
    </div>
</div>
