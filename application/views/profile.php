
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="main-content col-lg-12">
                        <div class="content-area card">
                            <div class="card-innr">
                                <div class="card-head">
                                    <h4 class="card-title">Profile Details</h4>
                                </div>
                                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#personal-data">Personal Data</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#password">Password</a>
                                    </li>
                                </ul>
                                <!-- .nav-tabs-line -->
                                <div class="tab-content" id="profile-details">
                                    <div class="tab-pane fade show active" id="personal-data">
                                        <form method="post" id="updateProfile">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-item input-with-label">
                                                        <label for="full-name" class="input-item-label">Name</label>
                                                        <input class="input-bordered" type="text" id="full-name" name="name" value="<?php echo $userInfo->NAME; ?>" required>
                                                    </div>
                                                    <!-- .input-item -->
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-item input-with-label">
                                                        <label for="email-address" class="input-item-label">Email Address</label>
                                                        <input class="input-bordered" type="text" id="email-address" name="email" value="<?php echo $userInfo->EMAIL; ?>" required>
                                                    </div>
                                                    <!-- .input-item -->
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-item input-with-label">
                                                        <label for="mobile-number" class="input-item-label">Phone</label>
                                                        <input class="input-bordered" type="text" id="mobile-number" name="phone" value="<?php echo $userInfo->PHONE; ?>" required>
                                                    </div>
                                                    <!-- .input-item -->
                                                </div>

                                                <input type="hidden" name="user_no" value="<?php echo $userInfo->USER_NO; ?>" required>
                                               
                                               
                                            </div>
                                            <!-- .row -->
                                            <div class="gaps-1x"></div>
                                            <!-- 10px gap -->
                                            <div class="d-sm-flex justify-content-between align-items-center">
                                                <button class="btn btn-primary">Update Profile</button>
                                                <div class="gaps-2x d-sm-none"></div>
                                               
                                            </div>
                                        </form>
                                        <!-- form -->
                                    </div>
                                    
                                    <!-- .tab-pane -->
                                    <div class="tab-pane fade" id="password">

                                    	<form id="updatePassword" method="post">
                                    	<input type="hidden" name="user_no" value="<?php echo $userInfo->USER_NO; ?>" required>
                                               
                                       
                                        <!-- .row -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="new-pass" class="input-item-label">New Password</label>
                                                    <input class="input-bordered" type="password" id="new-pass" name="password" required>
                                                </div>
                                                <!-- .input-item -->
                                            </div>
                                            <!-- .col -->
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="confirm-pass" class="input-item-label">Confirm New Password</label>
                                                    <input class="input-bordered" type="password" id="confirm-pass" name="confirm-password" required="">
                                                </div>
                                                <!-- .input-item -->
                                            </div>
                                            <!-- .col -->
                                        </div>
                                        <!-- .row -->
                                        
                                        <div class="gaps-1x"></div>
                                        <!-- 10px gap -->
                                        <div class="d-sm-flex justify-content-between align-items-center">
                                            <button class="btn btn-primary">Update</button>
                                            
                                        </div>
                                    </div>

                                </form>
                                    <!-- .tab-pane -->
                                </div>
                                <!-- .tab-content -->
                            </div>
                            <!-- .card-innr -->
                        </div>
                        
                    </div>
                    <!-- .col -->
                    
                </div>
                <!-- .container -->
            </div>
            <!-- .container -->
        </div>
        <!-- .page-content -->
        