<div class="col-md-3">
       <div class="card">
       <div class="card-body p-0 pt-3">
       <div class="profile-img text-center img-thumbnail">
               <img src="{{asset('/images/user/'.Auth::user()->image)}}" id="Picture" class="avatar img-fluid rounded-circle" alt="avatar">
              <form action="{{url('update_avatar')}}" id="update_avatar" method="post">               
               
            <label for="imgInp">Upload Image</label>
           <input type="file" name="avatar" id="imgInp">
           </form>
       </div>
           <div class="text-center mt-3"><strong>{{ucfirst(Auth::user()->name)}}</strong></div>
           <hr/>

           <div class="profile-usermenu">
               <ul class="">
                   <li class="{{ Request::segment('2')=='' ? 'active' : '' }}">
                       <a href="{{url('/profile')}}">
                           <i class="fas fa-home"></i>
                           Profile </a>
                   </li>
                   <li class="{{ Request::segment('2')=='order' ? 'active' : '' }}">
                       <a href="{{url('/profile/order')}}">
                           <i class="fas fa-clipboard-list"></i>
                           My Orders </a>
                   </li>
                   <li class="{{ Request::segment('2')=='notification' ? 'active' : '' }}">
                       <a href="{{url('/profile/notification')}}">
                           <i class="fas fa-bell"></i>
                           Notification </a>
                   </li>
                    <li class="{{ Request::segment('2')==='reset-password' ? 'active' : '' }}">
                       <a href="{{route('userchangepassword')}}">
                           <i class="fa fa-key" aria-hidden="true"></i>
                           Change Password </a>
                   </li>
                    <li>
                       <a href="{{ url('/logout') }}">
                           <i class="fas fa-sign-out-alt"></i>
                           Sign Out </a>
                   </li>
               </ul>
           </div>



       </div>
       </div>
     </div>

     <script type="text/javascript">
     $(document).ready(function() {
         $("#imgInp").change(function () {
             upload(this);
         });

         function upload(img) 
         {
             if (img.files && img.files[0]) 
             {
                
                var form_data = new FormData();
                //console.log(form_data);
                form_data.append('avatar', img.files[0]);
                form_data.append('_token', '{{csrf_token()}}');
               // console.log(form_data);
                $.ajax({
                  type: 'POST',
                  url: "{{url('update_avatar')}}",
                  data: form_data,
                  contentType: false,
                  processData: false,
                  success:  function(response)
                  {
                        console.log(response);
                        var reader = new FileReader();
                      reader.onload = function (e) {
                        $('#Picture').attr('src',e.target.result);
                        $('#profile_pic').attr('src',e.target.result);
                        
                     }
                     reader.readAsDataURL(img.files[0]);

                  }
                });
              }
         }
     });





 </script>