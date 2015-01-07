@section('content')


      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-9">
                  	<div class="row mt">
                  		<div class="col-lg-6">
		                  	<div class="showback">
								<h1>공지사항 <small>Notice</small></h1>
								<p>
									<h5>기능</h5> 
									<ul>
										<li><a href="{{ url('memo'); }}">메모</a> <span class="label label-success">New</span></li>
										<li><a href="{{ url('stamp'); }}">도장 쾅</a> <span class="label label-success">Beta</span></li>
									</ul>
								</p>
							</div>
						</div>
					</div>
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                  <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
						<h3>NOTIFICATIONS</h3>
                                        

                       <!-- USERS ONLINE SECTION -->
						<h3>TEAM MEMBERS</h3>
                      
                        <!-- CALENDAR-->
                        <div id="calendar" class="mb">
                            <div class="panel green-panel no-margin">
                                <div class="panel-body">
                                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title" style="disadding: none;"></h3>
                                        <div id="date-popover-content" class="popover-content"></div>
                                    </div>
                                    <div id="my-calendar"></div>
                                </div>
                            </div>
                        </div><!-- / calendar -->
                      
                  </div><!-- /col-lg-3 -->
              </div><! --/row -->
          </section>
      </section>

      <!--main content end-->

@stop