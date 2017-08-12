

<form method="POST" name="regi" onsubmit="return chk()"> 

<div id="login" class="modal fade" role="dialog">
         <div class="modal-dialog">
             <!-- Modal content-->
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Create Account in B<small>usiness</small> Hub</h4>
                 </div>
                 <div class="modal-body">
                     <!-- BODy  -->
                     <div>
                         <div class="panel">
                             <br/>
                             <div class="input-group">
                                 <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-edit"></i></small></span>
                                 <input type="text" class="form-control" placeholder="Frist Name" required="" name="fname">
                                 <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-edit"></i></small></span>
                                 <input type="text" class="form-control" placeholder="Last Name" required=""  name="lname">
                             </div><br/>
                             
                             
                             <div class="input-group">
                                 <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-lock"></i></small></span>
                                 <select required class="form-control" name="catName">
                                     <option>Select Your Profession</option>
                                     <option value="Science">Science</option>
                                     <option value="Arts">Art's</option>
                                     <option value="Commerce">Commerce</option>
                                     <option value="Government Employees">Government Employees</option>
                                     <option value="Corporate Employees">Corporate Employees</option>
                                     <option value="Self Employees">Self Employees</option>
                                     <option value="House Worker">House Worker</option>
                                     <option value="Politicians">Politicians</option>
                                     <option value="Social Activity">Social Activity</option>
                                 </select>
                                 
                             </div>
                             <br/>
                             <div class="input-group">
                                 <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-user"></i></small></span>
                                 <input type="email" class="form-control" placeholder="Email Address" id="emailchk"  name="regi_username">
                             </div>
                             
                             <br/>
                             <div class="input-group">
                                 <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-phone"></i></small></span>
                                 <input type="number" class="form-control" placeholder="Mobile Number(Optional)" id="phnno"  name="regi_phnno">
                             </div>
                             
                             <br/>
                             <div class="input-group">
                                 <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-lock"></i></small></span>
                                 <input type="password" class="form-control" placeholder="Create Password For BHub"  id="passwd" name="regi_password">
                                 
                             </div>
                              <br/>
                             
                             
                             <div class="input-group">
                                 <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-lock"></i></small></span>
                                 <input type="password" class="form-control" placeholder="Confim Password" id="passwdConf"  name="regi_password_confim">
                                 
                             </div>
                           <br/>
                           
                                <div class="alert alert-danger" id="error">
                                    <a href="#" class="close">&times;</a>
                                    <center id="errorMSG">Check Details</center>
                                    
                                </div>
                           
                           
                    
                           
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                     <input type="submit" value="Register" class="btn btn-primary pull-right" name="btn_register">
                 </div>
             </div>
         </div>
     </div>
            
                                  </form>