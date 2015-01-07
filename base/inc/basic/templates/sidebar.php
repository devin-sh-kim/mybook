<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <p class="centered"><a href="profile.html"><img src="<?=$ctx?>img/ui-sam.jpg" class="img-circle" width="60"></a>
            </p>
            <h5 class="centered"><strong><?=$userId?></strong> <?=$username?></h5>
            <li class="mt"><a href="<?=$ctx?>dashboard" class="<?= $action == "dashboard" ? "active" : "" ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            <li class=""><a href="<?=$ctx?>write" class="<?= $action == "write" ? "active" : "" ?>"><i class="fa fa-pencil-square-o"></i><span>쓰기</span></a>
            </li>
            <li class=""><a href="<?=$ctx?>wallet" class="<?= $action == "wallet" ? "active" : "" ?>"><i class="fa fa-pencil-square-o"></i><span>자산</span></a>
            </li>
            <li class=""><a href="<?=$ctx?>report" class="<?= $action == "report" ? "active" : "" ?>"><i class="fa fa-bar-chart-o"></i><span>보고서</span></a>
            </li>
            <li class=""><a href="<?=$ctx?>setting" class="<?= $action == "setting" ? "active" : "" ?>"><i class="fa fa-bar-chart-o"></i><span>설정</span></a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->