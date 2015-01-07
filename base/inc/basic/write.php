<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Write</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" id="writeTab">
                    <li><a href="#payout" data-toggle="tab">지출</a></li>
                    <li><a href="#income" data-toggle="tab">수입</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="payout">
                        <div class="row mt"><!--  -->
                            <div class="col-lg-12">
                                <h4><i class="fa fa-angle-right"></i> 지출 기록 하기</h4>
                            </div>
                        </div>
                        <div class="row mt"><!--  -->
                            <div class="col-lg-12">
								<form role="form" id="record">
								    <div class="col-lg-2">
    									<div class="form-group">
    										<div class='input-group date' id='targetDatePicker'>
    											<input type="text" class="form-control" id="targetDate" name="targetDate" data-date-format="YYYY-MM-DD">
    											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
    										</div>
    									</div>
									</div>
									<div class="col-lg-1">
    									<div class="form-group">
    										<input type="text" class="form-control" id="store" name="store" placeholder="사용처">
    									</div>
									</div>
									<div class="col-lg-2">
    									<div class="form-group">
    										<input type="text" class="form-control" id="comment" name="comment" placeholder="사용내역">
    									</div>
									</div>
									<div class="col-lg-1">
    									<div class="form-group">
    										<input type="text" class="form-control" id="value" name="value" placeholder="금액">
    									</div>
									</div>
									<div class="col-lg-2">
    									<div class="form-group">
    										<input type="text" class="form-control" id="target" name="target" placeholder="지불 방법/출금 대상">
    									</div>
									</div>
									<div class="col-lg-1">
    									<div class="form-group">
    										<input type="text" class="form-control" id="category" name="category" placeholder="분류">
    									</div>
									</div>
									<div class="col-lg-1">
    									<div class="form-group">
    										<input type="text" class="form-control" id="tag" name="tag" placeholder="태그">
    									</div>
									</div>
									<div class="col-lg-1">
    									<div class="checkbox">
    										<label>
    										    <input type="checkbox" id="overspend" name="overspend"> 낭비
    										</label>
    									</div>
									</div>
									
								</form>
								<div class="col-lg-1">
							        <button class="btn btn-default" id="btn-save">저장</button>
								</div>
                    		</div>
                    	</div>
                    </div>
                    
                    <div class="tab-pane" id="income">
                    수입 기록
                    </div>
                </div>
            </div>
        </div>

    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->

<!--main content end-->