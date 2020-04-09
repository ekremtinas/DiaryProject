<div class="modal fade bd-example-modal-lg " id="ModalInBridge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="clickBridgeForm" class="form-horizontal" method="POST">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Appointment in Bridge</h5>
                    <button type="button" class="close btn-sm appointmentInAppointmentClose " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  ">
                    <table class="table btn-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">License Plate</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Country</th>
                            <th scope="col">Language</th>
                            <th scope="col">GSM</th>
                            <th scope="col">E Mail</th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
               </div>

                <div class="modal-footer">

                    <button  type="button" class="btn btn-danger btn-sm appointmentInAppointmentClose" data-dismiss="modal">Close</button>
                    <button id="editEventSubmit" type="submit" class="btn btn-success  btn-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
