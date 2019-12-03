




<?php
/*use \App\Http\Controllers\Reset\PostPasswordResetController;*/
$resetuid=time().microtime();
/*PostPasswordResetController::resetPasswordChange($resetuid);*/
?>

<h4 class="card-title text-center ">Password Change </h4>


                                <div class="row">

                                    <div class="form-group mt-4 col-6 offset-3">
                                        <a href="http://127.0.0.1:8000/dPasswordReset?resetuid=@if(isset($resetuid)) {{$resetuid}} @endif"  class="btn  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                            http://127.0.0.1:8000/dPasswordReset?resetuid=@if(isset($resetuid)) {{$resetuid}} @endif
                                        </a>

                                    </div>
                                </div>








