<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;
?>
<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">精品推荐</h1>
</div>
<div class="wrapper-md">
    <div class="row">
        <div class="col-sm-6"></div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            精品推荐
        </div>
        <div class="row wrapper">

            <div class="col-sm-3">
                <form action="?r=song/discuss" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="input-sm form-control" placeholder="请输入搜索歌名..." value="">
          <span class="input-group-btn">
          <input type="submit" class="btn btn-sm btn-default" value="Go!">  
          </span>
                    </div>
                </form>
            </div>
            <div class="col-sm-4">
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <tr>
                    <th style="width:3%">
                        <label class="i-checks m-b-none">
                            <input type="checkbox"><i></i>
                        </label>
                    </th>
                    <th style="width:10%;">序号</th>
                    <th style="width:10%;">所属类型</th>
                    <th style="width:10%;">是否热门</th>
                    <th style="width:10%;">操作</th>
                </tr>
                <tbody>
                <?php foreach($type as $val){?>
                <tr ids="<?php echo $val['type_id'] ?>">
                    <th style="width:3%">
                        <label class="i-checks m-b-none">
                            <input type="checkbox"><i></i>
                        </label>
                    </th>
                    <th style="width:10%;"><?php echo $val['type_id']?></th>
                    <th style="width:10%;"><?php echo $val['type_name']?></th>
                    <th style="width:10%;">
                        <span class="span"><?php echo $val['hot']?></span>
                        <input class="input" type="text"  style="display: none;text-align: center" name="hot" value="<?php echo $val['hot']?>">
                    </th>
                    <th style="width:10%;"><a href="#">删除</a></th>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-4 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm"></small>
                </div>
                <div>
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li>

                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="./jquery.js"></script>
<script>
    $(".span").click(function () {
        var _this=$(this);
        _this.hide();
        _this.next().css('display','block').focus();
    });

    $(".input").blur(function(){
        var _this=$(this);
        var id=_this.parents('tr').attr('ids');
        var name=_this.attr('name');
        var text=_this.val();
        $.ajax({
            type:"post",
            url: "?r=type/hotinsert",
            data: {id:id,name:name,text:text},
            success: function(msg){
                if(msg=="OK"){
                    _this.css('display','none');
                    _this.prev().html(text);
                    _this.prev().css('display','block')
                }else{
                    _this.css('display','none');
                    _this.prev().css('display','block')
                }
            }
        });
    })
</script>