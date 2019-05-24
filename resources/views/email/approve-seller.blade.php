@include('email.header')


 <!-- big image section -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    

                    <tr>
                        <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center">
                            <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                                <tr>
                                    <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center">
                            <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td height="20" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center" style="color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">


                                        <div style="line-height: 24px">
                                            <b style="color: #fc8019;text-transform: uppercase;">Hi, {{$user->name}}</b><br/> 

                                           <p>Your Gym has been Approved Now you can add your packages. Your login url and login credential Given below. Change your password immediate after login.</p><br/>
                                          <h4> E-mail:- {{$user->email}}<h4/><br/>
                                           <h4>Password:- welcome@1</h4><br/>


                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                        <td align="center">
                            <table border="0" align="center" width="130" cellpadding="0" cellspacing="0" bgcolor="fc8019" style="">

                                <tr>
                                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="center" style="color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;">


                                        <div style="line-height: 16px;">
                                            <a href="{{url('/sellerlogin')}}" style="color: #ffffff; text-decoration: none;">Login Here</a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height="15" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>

                   

                </table>

            </td>
        </tr>

        <tr class="hide">
            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
        </tr>
        <tr>
            <td height="100" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
        </tr>

    </table>
    <!-- end section -->
 

@include('email.footer')   