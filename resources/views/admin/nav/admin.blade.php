<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="treeview"><a href="#"><i class="fa fa-lock"></i><span> Administrator</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
            <li class="treeview"><a href="#"><i class="fa fa-user fa-fw"></i> User <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('/admin/user')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add User</a></li><li class="treeview">
                </ul>
            </li>
            {{--permissions--}}
            <li class="treeview"><a href="#"><i class="fa fa-exchange" aria-hidden="true"></i> Permission <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/admin/permission')}}">&nbsp;&nbsp;&nbsp;&nbsp; permission</a></li><li class="treeview">
                </ul>

            <li class="treeview"><a href="#"><i class="fa fa-address-card" aria-hidden="true"></i> Positions <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/admin/position/create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-users" aria-hidden="true"></i> Staff <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('staff.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-university " aria-hidden="true"></i> Branch <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('branch.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-user-md"></i> Doctor <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('doctor.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-stethoscope"></i> Servay <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('servay.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-users " aria-hidden="true"></i> Client <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('client.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>

            </li>

            <li class="treeview"><a href="#"><i class="fa fa-thermometer-quarter " aria-hidden="true"></i> Treatment <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('treatment.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                    <li><a href="{{route('view-treatment')}}">&nbsp;&nbsp;&nbsp;&nbsp; Views</a></li><li class="treeview">
                </ul>

            </li>

            <li class="treeview"><a href="#"><i class="fa fa-file-pdf-o " aria-hidden="true"></i> Invoice <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('invoice.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                    <li><a href="{{route('invoice.index')}}">&nbsp;&nbsp;&nbsp;&nbsp; Views</a></li><li class="treeview">
                </ul>

            </li>

            <li class="treeview"><a href="#"><i class="fa fa-dollar " aria-hidden="true"></i> Currency <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('currency.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>

            </li>

            <li class="treeview"><a href="#"><i class="fa fa-dollar " aria-hidden="true"></i> Exchange <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('exchange.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>

            </li>

            <li class="treeview"><a href="#"><i class="fa fa-medkit " aria-hidden="true"></i> Prescription <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('prescription.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                    <li><a href="{{route('prescription.index')}}">&nbsp;&nbsp;&nbsp;&nbsp; Views</a></li><li class="treeview">
                </ul>

            </li>

            <li class="treeview"><a href="#"><i class="fa fa-tasks " aria-hidden="true"></i> Plan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('plan.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                    <li><a href="{{route('plan.index')}}">&nbsp;&nbsp;&nbsp;&nbsp; Views</a></li><li class="treeview">
                </ul>

            </li>

            <li class="treeview"><a href="#"><i class="fa fa-suitcase " aria-hidden="true"></i> Treatment Procedure <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('treatmentprocedure.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                    <li><a href="{{route('treatmentprocedure.index')}}">&nbsp;&nbsp;&nbsp;&nbsp; Views</a></li><li class="treeview">
                </ul>

            </li>

            <li class="treeview"><a href="#"><i class="fa fa-user-md " aria-hidden="true"></i> Share Doctor<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('sharedoc.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; New Share</a></li><li class="treeview">
                    <li><a href="{{route('sharedoc.index')}}">&nbsp;&nbsp;&nbsp;&nbsp; Views Shared</a></li><li class="treeview">
                </ul>
            </li>


        </ul>

    </li>

    <li class="treeview"><a href="#"><i class="fa fa-area-chart"></i><span> Stock Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">

            <li class="treeview"><a href="#"><i class="fa fa-tag" aria-hidden="true"></i> Category <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('category.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-product-hunt" aria-hidden="true"></i> Product <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('product.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-money" aria-hidden="true"></i> Pricelist <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('pricelist.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-industry" aria-hidden="true"></i> Suppliers <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('suppliers.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-industry" aria-hidden="true"></i> Import Product <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('import.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
                    <li><a href="{{route('import.index')}}">&nbsp;&nbsp;&nbsp;&nbsp; View</a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-industry" aria-hidden="true"></i> Stock Out <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('stockout.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Export</a></li><li class="treeview">
                    <li><a href="{{route('stockout.index')}}">&nbsp;&nbsp;&nbsp;&nbsp; View</a></li><li class="treeview">
                </ul>
            </li>
            <li class="treeview"><a href="#"><i class="fa fa-industry" aria-hidden="true"></i> Request <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/create/request/product')}}">&nbsp;&nbsp;&nbsp;&nbsp; Create Request</a></li><li class="treeview">
                    <li><a href="{{route('requestpro.index')}}">&nbsp;&nbsp;&nbsp;&nbsp; View Request</a></li><li class="treeview">
                    <li><a href="{{url('/create/verify/request/product')}}">&nbsp;&nbsp;&nbsp;&nbsp;Verify Request</a></li><li class="treeview">
                    <li><a href="{{url('/export/request/product')}}">&nbsp;&nbsp;&nbsp;&nbsp;Export Request</a></li><li class="treeview">
                </ul>
            </li>

        </ul>
    </li>

    <li class="treeview"><a href="#"><i class="fa fa-dollar"></i><span>Payment Doctor</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
            <li><a href="{{route('doctorpayment.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
            <li><a href="{{route('doctorpayment.index')}}">&nbsp;&nbsp;&nbsp;&nbsp; View</a></li><li class="treeview">
        </ul>
    </li>

    <li class="treeview"><a href="#"><i class="fa fa-dollar"></i><span>Payment Client</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
            <li><a href="{{url('/client/payment/create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Add New</a></li><li class="treeview">
            <li><a href="{{url('/client/payment/index')}}">&nbsp;&nbsp;&nbsp;&nbsp; View</a></li><li class="treeview">
        </ul>
    </li>
    <li class="treeview"><a href="#"><i class="fa fa-dollar"></i><span>Create</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
            <li><a href="{{url('/account/create/acc/type')}}">&nbsp;&nbsp;&nbsp;&nbsp; Account Type</a></li><li class="treeview">
            <li><a href="{{url('/account/create/acc/chart')}}">&nbsp;&nbsp;&nbsp;&nbsp; Chart Of Account</a></li><li class="treeview">
        </ul>
    </li>
    <li class="treeview"><a href="#"><i class="fa fa-dollar"></i><span>Set Variable</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
            <li><a href="{{URL::to('/admin/set/variable')}}">&nbsp;&nbsp;&nbsp;&nbsp; Generate Invoice</a></li><li class="treeview">
            <li><a href="{{URL::to('/admin/set/variable/payment/create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Income Payment</a></li><li class="treeview">
        </ul>
    </li>

    <li class="treeview"><a href="#"><i class="fa fa-dollar"></i><span>Stock Report</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
            <li><a href="{{ route('stockreport.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; Report Stock In</a></li><li class="treeview">
            <li><a href="{{URL::to('/reportStockOut')}}">&nbsp;&nbsp;&nbsp;&nbsp; Report Stock Out</a></li><li class="treeview">
            <li><a href="{{ route('stockreport.index')}}">&nbsp;&nbsp;&nbsp;&nbsp; Report Stock Balance</a></li><li class="treeview">
            {{--<li><a href="{{URL::to('/admin/reportStockExchange')}}">&nbsp;&nbsp;&nbsp;&nbsp; Report Stock Exchange</a></li><li class="treeview">--}}
            {{--<li><a href="{{URL::to('/admin/reportStockReturn')}}">&nbsp;&nbsp;&nbsp;&nbsp; Report Stock Return</a></li><li class="treeview">--}}
            {{--<li><a href="{{URL::to('/report/expired/prouduct')}}">&nbsp;&nbsp;&nbsp;&nbsp; Expired Products</a></li><li class="treeview">--}}
        </ul>
    </li>


</ul>