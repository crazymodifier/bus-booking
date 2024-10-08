
<main class="d-flex bg-secondary">
  <div class="container p-5">
    <?php 
    if(isset($_REQUEST['id']))
    {
        $email = $this->logics->output_md5($_REQUEST['id'],'customer','email');
    }
    else
    {
        redirect();
    }
    if(isset($_REQUEST['action'])) {
        
        if($this->db->where('email', $email)->get('customer')->num_rows())
        {
            $this->db->where('email', $email)->update('customer',['status'=>1]);
        }
        else
        {
           redirect();
        }
        
        echo' Email Verification Successful. Redirecting...';
        echo '<script>setTimeout(function () {window.location.href= "http://hop-on-hop-off-barcelona.com/"},3000);</script>';
    } 
    else 
    
    { 
        if(!$email)
        {
            redirect();
        }
        else
        {
            echo' Your Registration Successful.<br> Please check your email and verify now...';
            echo '<script>setTimeout(function () {window.location.href= "http://hop-on-hop-off-barcelona.com/"},3000);</script>';
        }
        
    } ?>
  </div>
</main>