
<div class="modal fade col-lg-6 offset-lg-3" id="workplaceSettingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="workplaceSettingsForm" class="form-horizontal"  >

                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="id" name="id" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Workplace Settings</h5>
                    <button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  ">
                    <div class="form-group">
                        <div class="form-group btn-group-sm mt-2 col-lg-10 offset-lg-1 ">
                            <label id="workplaceName-label"  class="btn-sm scroll-home-label" for="workplaceName">{{ __('Workplace Name:') }}</label>
                            <input id="workplaceName" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('workplaceName') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Workplace Name"  name="workplaceName"  >
                            @error('workplaceName')
                            <span  id="workplaceName-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>
                        <div class="form-group btn-group-sm mt-3 col-lg-10 offset-lg-1 ">
                            <label id="defaultDate-label"  class="btn-sm scroll-home-label" for="defaultDate">{{ __('Default Date:') }}</label>
                            <input id="defaultDate" data-bvalidator="required" type="date" class="form-control btn-sm  border-light shadow-main rounded-pill @error('defaultDate') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Default Date"  name="defaultDate"  >
                            @error('defaultDate')
                            <span  id="defaultDate-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>
                        <div class="form-group btn-group-sm mt-3 col-lg-10 offset-lg-1 ">
                            <label id="minTime-label"  class="btn-sm scroll-home-label" for="minTime">{{ __('Min Time:') }}</label>
                            <input id="minTime" data-bvalidator="required" type="time" class="form-control btn-sm  border-light shadow-main rounded-pill @error('minTime') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Min Time"  name="minTime"  >
                            @error('minTime')
                            <span  id="minTime-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>
                        <div class="form-group btn-group-sm mt-3 col-lg-10 offset-lg-1 ">
                            <label id="maxTime-label"  class="btn-sm scroll-home-label" for="maxTime">{{ __('Max Time:') }}</label>
                            <input id="maxTime" data-bvalidator="required" type="time" class="form-control btn-sm  border-light shadow-main rounded-pill @error('maxTime') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Max Time"  name="maxTime"  >
                            @error('maxTime')
                            <span  id="maxTime-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>

                        <div class="form-group btn-group-sm mt-3 col-lg-8 offset-lg-2 btn-sm">
                            <div class="custom-switch custom-control ">
                                <input class="custom-control-input    "  type="checkbox" name="weekends" id="weekends" >
                                <label for="weekends" class="custom-control-label   ">Weekends:</label>
                            </div>

                        </div>
                        <div id="defaultView" class="form-group btn-group-sm col-lg-8 offset-lg-2 btn-sm">
                            <label id="defaultView-label"  class="btn-sm" >{{ __('Default View Grid:') }}</label>
                            <div class="custom-switch custom-control ">
                                <input class="custom-control-input    " value="dayGridMonth" type="radio" name="defaultView" id="dayGridMonth" >
                                <label for="dayGridMonth" class="custom-control-label   ">Day Grid Month:</label>
                            </div>
                            <div class="custom-switch custom-control ">
                                <input class="custom-control-input    " value="timeGridWeek"  type="radio" name="defaultView" id="timeGridWeek" >
                                <label for="timeGridWeek" class="custom-control-label   ">Time Grid Week:</label>
                            </div>
                            <div class="custom-switch custom-control ">
                                <input class="custom-control-input    " value="timeGridDay"  type="radio" name="defaultView" id="timeGridDay" >
                                <label for="timeGridDay" class="custom-control-label   ">Time Grid Day:</label>
                            </div>

                        </div>

                    </div>







                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn  btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" id="workplaceSettingsSubmit" class="btn btn-success btn-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

