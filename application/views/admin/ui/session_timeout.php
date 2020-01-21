
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                        <h4 class="m-t-0 text-info">$58,356</h4></div>
                    <div class="spark-chart">
                        <div id="monthchart"></div>
                    </div>
                </div>
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                        <h4 class="m-t-0 text-primary">$48,356</h4></div>
                    <div class="spark-chart">
                        <div id="lastmonthchart"></div>
                    </div>
                </div>
                <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- .left-right-aside-column-->
                <div class="contact-page-aside">
                    <!-- .left-aside-column-->
                    <div class="left-aside">
                        <ul class="list-style-none">
                            <li class="box-label"><a href="javascript:void(0)">All Contacts <span>123</span></a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:void(0)">Work <span>103</span></a></li>
                            <li><a href="javascript:void(0)">Family <span>19</span></a></li>
                            <li><a href="javascript:void(0)">Friends <span>623</span></a></li>
                            <li><a href="javascript:void(0)">Private <span>53</span></a></li>
                            <li class="box-label"><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">+ Create New Label</a></li>
                            <div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Add Lable</h4> </div>
                                        <div class="modal-body">
                                            <from class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-md-12">Name of Label</label>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" placeholder="type name"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Select Number of people</label>
                                                    <div class="col-md-12">
                                                        <select class="form-control">
                                                            <option>All Contacts</option>
                                                            <option>10</option>
                                                            <option>20</option>
                                                            <option>30</option>
                                                            <option>40</option>
                                                            <option>Custome</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </from>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </ul>
                    </div>
                    <!-- /.left-aside-column-->
                    <div class="right-aside">
                        <div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                    <h4 class="card-title m-t-10">Contacts / Employee List </h4></div>
                                <div class="ml-auto">
                                    <input type="text" id="demo-input-search2" placeholder="search contacts" class="form-control"> </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table m-t-30 table-hover no-wrap contact-list" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Age</th>
                                        <th>Joining date</th>
                                        <th>Salery</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/1.jpg" alt="user" class="img-circle" /> Genelia Deshmukh</a>
                                        </td>
                                        <td>genelia@gmail.com</td>
                                        <td>+123 456 789</td>
                                        <td><span class="label label-danger">Designer</span> </td>
                                        <td>23</td>
                                        <td>12-10-2014</td>
                                        <td>$1200</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/2.jpg" alt="user" class="img-circle" /> Arijit Singh</a>
                                        </td>
                                        <td>arijit@gmail.com</td>
                                        <td>+234 456 789</td>
                                        <td><span class="label label-info">Developer</span> </td>
                                        <td>26</td>
                                        <td>10-09-2014</td>
                                        <td>$1800</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/3.jpg" alt="user" class="img-circle" /> Govinda jalan</a>
                                        </td>
                                        <td>govinda@gmail.com</td>
                                        <td>+345 456 789</td>
                                        <td><span class="label label-success">Accountant</span></td>
                                        <td>28</td>
                                        <td>1-10-2013</td>
                                        <td>$2200</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/4.jpg" alt="user" class="img-circle" /> Hritik Roshan</a>
                                        </td>
                                        <td>hritik@gmail.com</td>
                                        <td>+456 456 789</td>
                                        <td><span class="label label-inverse">HR</span></td>
                                        <td>25</td>
                                        <td>2-10-2017</td>
                                        <td>$200</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/5.jpg" alt="user" class="img-circle" /> John Abraham</a>
                                        </td>
                                        <td>john@gmail.com</td>
                                        <td>+567 456 789</td>
                                        <td><span class="label label-danger">Manager</span></td>
                                        <td>23</td>
                                        <td>10-9-2015</td>
                                        <td>$1200</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/6.jpg" alt="user" class="img-circle" /> Pawandeep kumar</a>
                                        </td>
                                        <td>pawandeep@gmail.com</td>
                                        <td>+678 456 789</td>
                                        <td><span class="label label-warning">Chairman</span></td>
                                        <td>29</td>
                                        <td>10-5-2013</td>
                                        <td>$1500</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/7.jpg" alt="user" class="img-circle" /> Ritesh Deshmukh</a>
                                        </td>
                                        <td>ritesh@gmail.com</td>
                                        <td>+123 456 789</td>
                                        <td><span class="label label-danger">Designer</span></td>
                                        <td>35</td>
                                        <td>05-10-2012</td>
                                        <td>$3200</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/8.jpg" alt="user" class="img-circle" /> Salman Khan</a>
                                        </td>
                                        <td>salman@gmail.com</td>
                                        <td>+234 456 789</td>
                                        <td><span class="label label-info">Developer</span></td>
                                        <td>27</td>
                                        <td>11-10-2014</td>
                                        <td>$1800</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/1.jpg" alt="user" class="img-circle" /> Govinda jalan</a>
                                        </td>
                                        <td>govinda@gmail.com</td>
                                        <td>+345 456 789</td>
                                        <td><span class="label label-success">Accountant</span></td>
                                        <td>18</td>
                                        <td>12-5-2017</td>
                                        <td>$100</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/2.jpg" alt="user" class="img-circle" /> Sonu Nigam</a>
                                        </td>
                                        <td>sonu@gmail.com</td>
                                        <td>+456 456 789</td>
                                        <td><span class="label label-inverse">HR</span></td>
                                        <td>36</td>
                                        <td>18-5-2009</td>
                                        <td>$4200</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/3.jpg" alt="user" class="img-circle" /> Varun Dhawan</a>
                                        </td>
                                        <td>varun@gmail.com</td>
                                        <td>+567 456 789</td>
                                        <td><span class="label label-danger">Manager</span></td>
                                        <td>43</td>
                                        <td>12-10-2010</td>
                                        <td>$5200</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/4.jpg" alt="user" class="img-circle" /> Genelia Deshmukh</a>
                                        </td>
                                        <td>genelia@gmail.com</td>
                                        <td>+123 456 789</td>
                                        <td><span class="label label-danger">Designer</span> </td>
                                        <td>23</td>
                                        <td>12-10-2014</td>
                                        <td>$1200</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/5.jpg" alt="user" class="img-circle" /> Arijit Singh</a>
                                        </td>
                                        <td>arijit@gmail.com</td>
                                        <td>+234 456 789</td>
                                        <td><span class="label label-info">Developer</span> </td>
                                        <td>26</td>
                                        <td>10-09-2014</td>
                                        <td>$1800</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>
                                            <a href="app-contact-detail.html"><img src="<?php echo base_url() ?>assets/images/users/6.jpg" alt="user" class="img-circle" /> Govinda jalan</a>
                                        </td>
                                        <td>govinda@gmail.com</td>
                                        <td>+345 456 789</td>
                                        <td><span class="label label-success">Accountant</span></td>
                                        <td>28</td>
                                        <td>1-10-2013</td>
                                        <td>$2200</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#add-contact">Add New Contact</button>
                                        </td>
                                        <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Add New Contact</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <from class="form-horizontal form-material">
                                                            <div class="form-group">
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Type name"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Email"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Phone"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Designation"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Age"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Date of joining"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Salary"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light"><span><i class="ion-upload m-r-5"></i>Upload Contact Image</span>
                                                                        <input type="file" class="upload"> </div>
                                                                </div>
                                                            </div>
                                                        </from>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <td colspan="7">
                                            <div class="text-right">
                                                <ul class="pagination"> </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- .left-aside-column-->
                    </div>
                    <!-- /.left-right-aside-column-->
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    


    <h3>Contact Details</h3><hr>

    <!-- ============================================================== -->
    <!-- Start contact details -->
    <!-- ============================================================== -->


    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card"> <img class="card-img" src="<?php echo base_url() ?>assets/images/background/socialbg.jpg" alt="Card image">
                <div class="card-img-overlay card-inverse social-profile d-flex ">
                    <div class="align-self-center"> <img src="<?php echo base_url() ?>assets/images/users/1.jpg" class="img-circle" width="100">
                        <h4 class="card-title">James Anderson</h4>
                        <h6 class="card-subtitle">@jamesandre</h6>
                        <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body"> <small class="text-muted">Email address </small>
                    <h6>hannagover@gmail.com</h6> <small class="text-muted p-t-30 db">Phone</small>
                    <h6>+91 654 784 547</h6> <small class="text-muted p-t-30 db">Address</small>
                    <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
                    <div class="map-box">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div> <small class="text-muted p-t-30 db">Social Profile</small>
                    <br/>
                    <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Timeline</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="card-body">
                            <div class="profiletimeline">
                                <div class="sl-item">
                                    <div class="sl-left"> <img src="<?php echo base_url() ?>assets/images/users/1.jpg" alt="user" class="img-circle" /> </div>
                                    <div class="sl-right">
                                        <div><a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                            <p>assign a new task <a href="#"> Design weblayout</a></p>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-6 m-b-20"><img src="<?php echo base_url() ?>assets/images/big/img1.jpg" class="img-responsive radius" /></div>
                                                <div class="col-lg-3 col-md-6 m-b-20"><img src="<?php echo base_url() ?>assets/images/big/img2.jpg" class="img-responsive radius" /></div>
                                                <div class="col-lg-3 col-md-6 m-b-20"><img src="<?php echo base_url() ?>assets/images/big/img3.jpg" class="img-responsive radius" /></div>
                                                <div class="col-lg-3 col-md-6 m-b-20"><img src="<?php echo base_url() ?>assets/images/big/img4.jpg" class="img-responsive radius" /></div>
                                            </div>
                                            <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="sl-item">
                                    <div class="sl-left"> <img src="<?php echo base_url() ?>assets/images/users/2.jpg" alt="user" class="img-circle" /> </div>
                                    <div class="sl-right">
                                        <div> <a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                            <div class="m-t-20 row">
                                                <div class="col-md-3 col-xs-12"><img src="<?php echo base_url() ?>assets/images/big/img1.jpg" alt="user" class="img-responsive radius" /></div>
                                                <div class="col-md-9 col-xs-12">
                                                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. </p> <a href="#" class="btn btn-success"> Design weblayout</a></div>
                                            </div>
                                            <div class="like-comm m-t-20"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="sl-item">
                                    <div class="sl-left"> <img src="<?php echo base_url() ?>assets/images/users/3.jpg" alt="user" class="img-circle" /> </div>
                                    <div class="sl-right">
                                        <div><a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                            <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
                                        </div>
                                        <div class="like-comm m-t-20"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="sl-item">
                                    <div class="sl-left"> <img src="<?php echo base_url() ?>assets/images/users/4.jpg" alt="user" class="img-circle" /> </div>
                                    <div class="sl-right">
                                        <div><a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                            <blockquote class="m-t-10">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--second tab-->
                    <div class="tab-pane" id="profile" role="tabpanel">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                    <br>
                                    <p class="text-muted">Johnathan Deo</p>
                                </div>
                                <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                    <br>
                                    <p class="text-muted">(123) 456 7890</p>
                                </div>
                                <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                    <br>
                                    <p class="text-muted">johnathan@admin.com</p>
                                </div>
                                <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                    <br>
                                    <p class="text-muted">London</p>
                                </div>
                            </div>
                            <hr>
                            <p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries </p>
                            <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <h4 class="font-medium m-t-30">Skill Set</h4>
                            <hr>
                            <h5 class="m-t-30">Wordpress <span class="pull-right">80%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                            </div>
                            <h5 class="m-t-30">HTML 5 <span class="pull-right">90%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                            </div>
                            <h5 class="m-t-30">jQuery <span class="pull-right">50%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                            </div>
                            <h5 class="m-t-30">Photoshop <span class="pull-right">70%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="settings" role="tabpanel">
                        <div class="card-body">
                            <form class="form-horizontal form-material">
                                <div class="form-group">
                                    <label class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input type="password" value="password" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Message</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" class="form-control form-control-line"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Select Country</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line">
                                            <option>London</option>
                                            <option>India</option>
                                            <option>Usa</option>
                                            <option>Canada</option>
                                            <option>Thailand</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    
</div>
<!-- ============================================================== -->
<!-- End contact details  -->
<!-- ============================================================== -->