 <!-- .row -->
 <div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="white-box">
            <!-- <h3 class="box-title m-b-0">Default Tab</h3>
                <p class="text-muted m-b-40">Use default tab with class <code>nav-tabs</code></p> -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active nav-item"><a href="#home" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Home</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#profile" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Profile</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Messages</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#settings" class="nav-link" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Settings</span></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <form data-toggle="validator">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputName1" class="control-label">Name</label>
                                        <input type="text" class="form-control" id="inputName1" placeholder="Cina Saffary" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputName1" class="control-label">Name</label>
                                        <input type="text" class="form-control" id="inputName1" placeholder="Cina Saffary" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputName1" class="control-label">Name</label>
                                        <input type="text" class="form-control" id="inputName1" placeholder="Cina Saffary" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <!-------------- row 2----------------->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputName1" class="control-label">Name</label>
                                        <input type="text" class="form-control" id="inputName1" placeholder="Cina Saffary" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-check">
                                    <div class="checkbox">
                                     <input name="ContentPlaceHolder1isActive" type="checkbox" id="terms">
                                     <label for="terms"> Active </label>    
                                 </div>
                             </div>
                         </div>

                     </div>
                     <!-------------- row-------------------->
                     <div class="row">
                        <div class="col-md-12">
                         <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> </th>
                                        <th>Postive</th>
                                        <th>Negative</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Monthly Allotted Perforamce points - Allowed</td>
                                        <td><input type="number" name=""></td>
                                        <td><input type="number" name=""></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--------------- row ------------------------>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inputName1" class="control-label">Email</label>
                            <input type="email" class="form-control" id="inputName1" placeholder="Cina Saffary" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inputName1" class="control-label">Password</label>
                            <input type="Password" class="form-control" id="inputName1" placeholder="Cina Saffary" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <!---------------- Row ------------------->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inputName1" class="control-label">Phone (Work)</label>
                            <input type="number" class="form-control" id="inputName1" data-error="Minimum 10 digits" data-toggle="validator" data-minlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" placeholder="Enter Phone (Work)" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inputName1" class="control-label">Phone (Mobile)</label>
                            <input type="number" class="form-control" id="inputName1" data-error="Minimum 10 digits" data-toggle="validator" data-minlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" placeholder="Enter Phone (Mobile)" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <!------------- row -------------->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <h3 class="box-title m-b-0">Postal Address</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <select class="form-control" required aria-required="true" tabindex="1">
                                <option value="">Select Province</option>
                                <option value="Category 1">Category 1</option>
                                <option value="Category 2">Category 2</option>
                                <option value="Category 3">Category 5</option>
                                <option value="Category 4">Category 4</option>
                            </select>
                            <!-- <label for="inputName1" class="control-label">Phone (Work)</label>
                            <input type="number" class="form-control" id="inputName1" data-error="Minimum 10 digits" data-toggle="validator" data-minlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" placeholder="Enter Phone (Work)" >
                            <div class="help-block with-errors"></div>
                        </div> -->
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                            <!-- <label for="inputName1" class="control-label">Phone (Mobile)</label>
                            <input type="number" class="form-control" id="inputName1" data-error="Minimum 10 digits" data-toggle="validator" data-minlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" placeholder="Enter Phone (Mobile)" required>
                            <div class="help-block with-errors"></div> -->
                        </div>
                    </div>
                </div>

            </form>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</div>
</div>