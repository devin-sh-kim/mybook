@section('sidebar')
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <p class="centered">
            	<a href="profile.html"><img src="{{ asset('img/ui-sam.jpg') }}" class="img-circle" width="60"></a>
            </p>
            <h5 class="centered">{{ Auth::user()->username }}</h5>
            <div class="centered">{{ Auth::user()->email }}</div>
            
            <li class="mt">
            	<a href="{{ url('/dashboard') }}" class="<?= $action == "dashboard" ? "active" : "" ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <!--
			<li class="sub-menu">
				<a href="javascript:;"   class="<?= $action == "moneybook" ? "active" : "" ?>">
					<i class="fa fa-desktop"></i>
					<span>Money Book</span>
				</a>
              	<ul class="sub">
					<li><a  href="{{ url('/moneybook/create') }}">쓰기</a></li>
					<li><a  href="{{ url('/moneybook') }}">보기</a></li>
					<li><a  href="{{ url('/setting') }}">설정</a></li>
            	</ul>
          	</li>
          	-->
            <li class="">
            	<a href="{{ url('/moneybook') }}" class="<?= $action == "moneybook" ? "active" : "" ?>"><i class="fa fa-krw"></i> <span>Money Book</span></a>
            </li>
            
            
            <!--
            <li class="">
            	<a href="{{ url('/write') }}" class="<?= $action == "write" ? "active" : "" ?>"><i class="fa fa-pencil-square-o"></i> <span>쓰기</span></a>
            </li>
            
            <li class="">
            	<a href="{{ url('/wallet') }}" class="<?= $action == "wallet" ? "active" : "" ?>"><i class="fa fa-pencil-square-o"></i> <span>자산</span></a>
            </li>
            
            <li class="">
            	<a href="{{ url('/report') }}" class="<?= $action == "report" ? "active" : "" ?>"><i class="fa fa-bar-chart-o"></i> <span>보고서</span></a>
            </li>
            
            <li class="">
            	<a href="{{ url('/setting') }}" class="<?= $action == "setting" ? "active" : "" ?>"><i class="fa fa-bar-chart-o"></i> <span>설정</span></a>
            </li>
            -->
            
            <li class="">
            	<a href="{{ url('/stamp') }}" class="<?= $action == "stamp" ? "active" : "" ?>"><i class="fa fa-paw"></i> <span>도장 쾅</span></a>
            </li>
            <li class="">
            	<a href="{{ url('/memo') }}" class="<?= $action == "memo" ? "active" : "" ?>"><i class="fa fa-file-text"></i> <span>메모</span></a>
            </li>
            
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
@stop