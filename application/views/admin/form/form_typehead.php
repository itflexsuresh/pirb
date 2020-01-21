 <!-- .row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Basic usage</h3>
                            <p class="text-muted m-b-30 font-13"> When initializing a typeahead, you pass the plugin method one or more datasets. The source of a dataset is responsible for computing a set of suggestions for a given query.</p>
                            <div id="the-basics">
                                <input class="typeahead form-control" type="text" placeholder="Countries">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Bloodhound</h3>
                            <p class="text-muted m-b-30 font-13">Suggestion Engine - For more advanced use cases, rather than implementing the source for your dataset yourself, you can take advantage of Bloodhound, the typeahead.js suggestion engine.</p>
                            <div id="bloodhound">
                                <input class="typeahead form-control" type="text" placeholder="Countries">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Prefetch </h3>
                            <p class="text-muted m-b-30 font-13">Prefetched data is fetched and processed on initialization. If the browser supports local storage, the processed data will be cached there to prevent additional network requests on subsequent page loads.</p>
                            <div id="prefetch">
                                <input class="typeahead form-control" type="text" placeholder="Countries">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Default Suggestions</h3>
                            <p class="text-muted m-b-30 font-13">Default suggestions can be shown for empty queries by setting the minLength option to 0 and having the source return suggestions for empty queries.</p>
                            <div id="default-suggestions">
                                <input class="typeahead form-control" type="text" placeholder="NFL Teams">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Multiple Datasets</h3>
                            <p class="text-muted m-b-30 font-13">Use multiple datasets like this</p>
                            <div id="multiple-datasets">
                                <input class="typeahead form-control" type="text" placeholder="NBA and NHL teams">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Scrollable Dropdown Menu</h3>
                            <p class="text-muted m-b-30 font-13">You can use scrollable drowdown</p>
                            <div id="scrollable-dropdown-menu">
                                <input class="typeahead form-control" type="text" placeholder="Countries">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->