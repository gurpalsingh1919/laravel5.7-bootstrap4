

    <div class="side-navbar col-md-2">

      <div class="user-info media pl-3">
          <i class="fas fa-user mr-3"></i>
          <div class="media-body">
              <h4>{{ ucwords(Auth::user()->name) }}</h4>
             
          </div>
      </div>
        <ul class="nav flex-column sidebar-nav">


      <?php if ($user = Auth::user()) {
	   if ($user->hasRole('seller')) {
		  ?>
    <li class="green kwatt-menu {{{ Request::is('packages')?'active':'' }}}">
      <a  href="{{ url('/packages') }}"><i></i>Packages</a></li>
      
       <li class="{{{ Request::is('add-package')?'active':'' }}}">
        <a href="{{ url('/add-package') }}"><i class="fas fa-credit-card"></i>Add package</a></li>
        <li class="{{{ Request::is('user-transactions')?'active':'' }}}">
        <a href="{{ url('/user-transactions') }}"><i class="fa fa-exchange"></i>Transactions</a></li>
             <?php $ico_link = in_array(Request::path(), ['buy-coin', 'transfer', 'ico-info']);?>

            <?php $wallet_link = in_array(Request::path(), ['buy-coin-list', 'deposit-list', 'withdraw-list', 'transfer-list']);
		  ?>

             <li class="{{{ Request::is('My-Order')?'active':'' }}}">
                <a href="{{ url('/My-Order') }}">
                  <i class="fas fa-cart-plus"></i>My Order
                </a>
              </li>
                     

            
              
                <!-- For Login histry -->
               <li class="{{{ Request::is('login-history')?'active':'' }}} nav-item">
                    <a class="" href="{{ url('login-history') }}">
                     <i class="fas fa-history"></i>Login History
                    </a>
                </li>
                 <!-- For Login histry -->
              

              <!-- For Sign Out  -->
            <li class="{{{ Request::is('transfer-list')?'active':'' }}} nav-item">
                    <a class="" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-user').submit();">
                    <i class="fas fa-sign-out-alt"></i>Sign Out
            <form id="logout-form-user" action="{{ url('/logout') }}" method="POST">
                    {{ csrf_field() }}
            </form>
                    </a>

            </li>
           

                           <?php }} ?>
        </ul>
</div>

    
    <!-- begin:: Page -->
   
        <script type="text/javascript">
       
      $(document).ready(function()
      {
          $('#ico-table').DataTable({
              responsive: true,
              language: {
                  search: '_INPUT_',
                  searchPlaceholder: "Search records"
              }
          });


          $('#ico-table-two').DataTable({
              responsive: true,
              language: {
                  search: '_INPUT_',
                  searchPlaceholder: "Search records"
              }
          });


      });
    </script>
    


<style type="text/css">
    .goog-te-banner-frame.skiptranslate {
    display: none !important;
    }
    body {
    top: 0px !important;
    }
    .goog-logo-link {
    display:none !important;
    }
    .goog-te-gadget{
    color: transparent !important;
    }
    #google_translate_element
    {
      margin-bottom: -25px;
    }

</style>



