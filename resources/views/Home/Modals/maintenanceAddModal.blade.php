<div class="modal col-lg-4 offset-lg-4 " id="MaintenanceAddModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="maintenanceAddForm"  action="">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title">Maintenance Add</h5>
                <button id="maintenanceAddCloseX" type="button" data-dismiss="modal" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                        <label id="maintenanceTitle-label"  class="btn-sm scroll-home-label" for="maintenanceTitle">{{ __('Maintenance Title:') }}</label>
                        <input id="maintenanceTitle" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('maintenanceTitle') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Maintenance Title"  name="maintenanceTitle"  >
                        @error('maintenanceTitle')
                        <span  id="maintenanceTitle-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                        @enderror

                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group btn-group-sm mt-4 col-lg-10 offset-lg-1 ">

                        <label id="maintenanceMinute-label"  class="btn-sm scroll-home-label" for="maintenanceMinute">{{ __('Maintenance Minute:') }}</label>
                        <input id="maintenanceMinute" data-bvalidator="required" type="time" class="form-control btn-sm  border-light shadow-main rounded-pill @error('maintenanceMinute') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Maintenance Minute"  name="maintenanceMinute"  >
                        @error('maintenanceMinute')
                        <span  id="maintenanceMinute-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                        @enderror

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button id="maintenanceAddClose" data-dismiss="modal" type="button" class="btn btn-danger btn-sm" >Close</button>
                <button id="maintenanceAddSubmit" type="submit" class="btn btn-success  btn-sm">Save Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
