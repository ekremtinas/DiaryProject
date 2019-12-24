
<div class="modal fade col-lg-6 offset-lg-3" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addEventForm" class="form-horizontal" method="POST" action="{{route('addEventPost')}}">

                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Diary Add</h5>
                    <button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  ">
                    <div class="form-group">
                        <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                            <label id="saveTitle-label"  class="btn-sm scroll-home-label" for="saveTitle">{{ __('Event Title:') }}</label>
                            <input id="saveTitle" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('saveTitle') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Event Title"  name="saveTitle"  >
                            @error('saveTitle')
                            <span  id="saveTitle-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>
                    </div>


                    <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 row">
                        <label id="maintenanceAddSelect-label"  class="btn-sm scroll-home-label" for="maintenanceAddSelect">{{ __('Maintenance:') }}</label>
                        <select  autocomplete="off" data-bvalidator="required"  placeholder="Maintenance"   name="maintenanceAddSelect" class="col-lg-8 form-control btn-sm h-50  form-control btn-sm  border-light shadow-main rounded-pill " id="maintenanceAddSelect">
                        <option selected>Choose</option>

                        </select>
                        <div class="col-lg-5 row">
                            <div class="col-lg-1 offset-lg-2">  <button id="maintenanceAdd" type="button" class=" btn btn-success btn-sm small-btn-size fa fa-plus p-1" data-toggle="popover"  data-content="
                            Double-click if you want to add maintenance type" data-placement="bottom" data-trigger="focus" title="Maintenance Add"  ></button>
                            </div>
                            <div class="col-lg-1">    <button id="maintenanceEdit" type="button" class=" btn btn-info  btn-sm small-btn-size fa fa-pencil p-1"  data-toggle="popover"  data-content="
                             If you want to edit the type of maintenance. Select from the side and double-click" data-placement="bottom" data-trigger="focus" title="Maintenance Edit"></button>
                            </div>
                            <div class="col-lg-1">  <button id="maintenanceDelete" type="button" class=" btn btn-danger btn-sm small-btn-size fa fa-trash p-1"  data-toggle="popover"  data-content="

                            If you want to delete the type of maintenance. Select from the side and double-click" data-placement="bottom" data-trigger="focus" title="Maintenance Delete"></button>
                            </div>
                        </div>


                    </div>


                    <div class="form-group">
                        <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                            <label id="saveStart-label"  class="btn-sm scroll-home-label" for="saveStart">{{ __('Start date:') }}</label>
                            <input readonly id="saveStart" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('saveStart') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Start date"  name="saveStart"  >
                            @error('saveStart')
                            <span  id="saveStart-alert" class="saveStart-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                            <label id="saveEnd-label"  class="btn-sm scroll-home-label" for="saveEnd">{{ __('End date:') }}</label>
                            <input readonly id="saveEnd" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('saveEnd') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="End date"  name="saveEnd"  >
                            @error('saveEnd')
                            <span  id="saveEnd-alert" class="saveEnd-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn  btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" id="addEventSubmit" class="btn btn-success btn-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('Home.Modals.maintenanceAddModal')
@include('Home.Modals.maintenanceEditModal')
@include('Home.Modals.maintenanceDeleteModal')
