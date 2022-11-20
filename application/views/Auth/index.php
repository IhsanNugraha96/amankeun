<body class="bg-gradient-dark">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-8 col-md-10">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <div class="brand-logo">
                       <img src="<?= base_url('assets/img/logo/logo.png') ?>" style="width: 50%;">
                    </div>
                    <!-- <h3 class="font-weight-bold" style='font-family: "Arial Rounded MT Bold"'><span class="text-success">AMAN</span>KEUN</h3> -->
                    <!-- <p style="margin-top: -10px;">(Aplikasi Manajemen Keuangan)</p> -->
                    <h5 class="text-gray-900 mt-4">Hello! let's get started</h5>
                    <p class=" mb-4"style="margin-top: -8px;">Sign in to continue.</p>
                  </div>

                  <!-- notifikasi -->
                    <div><?= $this->session->flashdata('message'); ?></div>       
                    
                  <!-- akhir notifikasi -->

                  <form class="user" method="post" action="<?= base_url('Auth');?>">

                    <?= form_error('username', '<small class="text-danger pl-3">','</small>'); ?>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Insert Username...">
                    </div>

                    <?= form_error('password', '<small class="text-danger pl-3">','</small>'); ?>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Insert Password" oninput="setCustomValidity('')" minlength="8" maxlength="50">
                    </div>

                    <button type="submit" class="btn btn-user btn-dark btn-block" style="background-color: #70AD47;">
                      Sign In
                    </button> 
                                       
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
