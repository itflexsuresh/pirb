<div id="sidebar">
  <div class="secNav">
    <div class="widget" style="width:90%">
      <h6 class="headerbar">
           <span>
           
           </span>
          </h6>
          <div class="submenu">
             <?php
$user_role = $this->session->userdata('usrrole');

if($user_role=='1'){
  echo "hii admin"; ?>
  <h1>Side bars</h1>
          <ul>
                   <li> <a href="#">Dashboard</a><br/></li>
                  <li> <a href="#">Administration</a><br/></li>
                  <li> <a href="#">System Setup</a><br/></li>
                  <li> <a href="#">Registra</a><br/></li>
                  <li> <a href="#">Activity Queue</a><br/></li>
                  <li> <a href="#">Activity Queue</a></li>
                  <li> <a href="#">Accounts</a><br/></li>
                  <li> <a href="#">Audits</a><br/></li>
                  <li> <a href="#">Reports</a><br/></li>
                   <li> <a href="#">COC Statement</a><br/></li>
                   <li> <a href="#">Reseller</a><br/></li>
                   <li> <a href="#">Gamification</a><br/></li>

              </ul>
              <?php
            } 
            elseif($user_role=='2'){
  echo "hii Plumber"; ?>
  <h1>Side bars</h1>
          <ul>
                   <li> <a href="#">Dashboard</a><br/></li>
                  <li> <a href="#">Administration</a><br/></li>
                  <li> <a href="#">System Setup</a><br/></li>
                  <li> <a href="#">Registra</a><br/></li>
                  <li> <a href="#">Activity Queue</a><br/></li>
                  <li> <a href="#">Activity Queue</a></li>
                  <li> <a href="#">Accounts</a><br/></li>
                  <li> <a href="#">Audits</a><br/></li>
                  <li> <a href="#">Reports</a><br/></li>
                   <li> <a href="#">COC Statement</a><br/></li>
                   <li> <a href="#">Reseller</a><br/></li>
                   <li> <a href="#">Gamification</a><br/></li>

              </ul>
              <?php
            } 
            elseif($user_role=='3'){
  echo "hii Auditor"; ?>
  <h1>Side bars</h1>
          <ul>
                   <li> <a href="#">Dashboard</a><br/></li>
                  <li> <a href="#">Administration</a><br/></li>
                  <li> <a href="#">System Setup</a><br/></li>
                  <li> <a href="#">Registra</a><br/></li>
                  <li> <a href="#">Activity Queue</a><br/></li>
                  <li> <a href="#">Activity Queue</a></li>
                  <li> <a href="#">Accounts</a><br/></li>
                  <li> <a href="#">Audits</a><br/></li>
                  <li> <a href="#">Reports</a><br/></li>
                   <li> <a href="#">COC Statement</a><br/></li>
                   <li> <a href="#">Reseller</a><br/></li>
                   <li> <a href="#">Gamification</a><br/></li>

              </ul>
              <?php
            } 
            elseif($user_role=='4'){
  echo "hii Reseller"; ?>
  <h1>Side bars</h1>
          <ul>
                   <li> <a href="#">Dashboard</a><br/></li>
                  <li> <a href="#">Administration</a><br/></li>
                  <li> <a href="#">System Setup</a><br/></li>
                  <li> <a href="#">Registra</a><br/></li>
                  <li> <a href="#">Activity Queue</a><br/></li>
                  <li> <a href="#">Activity Queue</a></li>
                  <li> <a href="#">Accounts</a><br/></li>
                  <li> <a href="#">Audits</a><br/></li>
                  <li> <a href="#">Reports</a><br/></li>
                   <li> <a href="#">COC Statement</a><br/></li>
                   <li> <a href="#">Reseller</a><br/></li>
                   <li> <a href="#">Gamification</a><br/></li>

              </ul>
              <?php
            } 
            elseif($user_role=='5'){
  echo "hii Company"; ?>
  <h1>Side bars</h1>
          <ul>
                 <li> <a href="#">Dashboard</a><br/></li>
                  <li> <a href="#">Administration</a><br/></li>
                  <li> <a href="#">System Setup</a><br/></li>
                  <li> <a href="#">Registra</a><br/></li>
                  <li> <a href="#">Activity Queue</a><br/></li>
                  <li> <a href="#">Activity Queue</a></li>
                  <li> <a href="#">Accounts</a><br/></li>
                  <li> <a href="#">Audits</a><br/></li>
                  <li> <a href="#">Reports</a><br/></li>
                   <li> <a href="#">COC Statement</a><br/></li>
                   <li> <a href="#">Reseller</a><br/></li>
                   <li> <a href="#">Gamification</a><br/></li>

              </ul>
              <?php
            } ?>


          </div>

    </div>
  </div>
</div>