<div class="left-sidebar">
    <h2>Shops</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <?php
                $shops=DB::table('shops')->get();
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                            <a href="">Shops</a>
                    </h4>
                </div>
                @if(count($shops)>0)
                    <div id="sportswear" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($shops as $shop)
                                    <li><a href="{{route('shops',$shop->id)}}">{{$shop->shop_name}} </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
    </div><!--/category-products-->

</div>