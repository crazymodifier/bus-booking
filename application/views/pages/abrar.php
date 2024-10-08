<style>
  nav, footer{
    display:none !important;
  }
</style>
<?php
  if(isset($_POST['login']))
  {
    if ($this->db->where('email', $this->input->post('email'))->where('password', md5($this->input->post('password')))->get('admin')->num_rows()) {
      $this->session->set_userdata('admin', true);
      redirect('abrar/dashboard');
    }
    else {
      $this->session->set_flashdata('alert', 'Invalid Credentials');
    }
  }
?>
<main class="vh-100 d-flex bg-secondary">
  <div class="login-box m-auto">
    <div class="login-logo">
      <h4 class="text-center">Admin</h4>
      <a href=""><img src="<?=base_url('dist/img/logo.png')?>" alt="" class="w-75"></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</main>