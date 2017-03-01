<div class="panel panel-default">
    <div class="panel-heading font-bold">
        歌曲分类
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="?r=type/index" method="post" enctype="multipart/form-data">


            <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">分类标题</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control rounded" >
                </div>
            </div>


            <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">歌曲语种</label>
                <div class="col-sm-10">
                    <select name="type_id" id="type_id" class="form-control m-b">
                        <?php foreach($type as $val){?>
                            <option value="<?php echo  $val['parent_id']?>"><?php echo  $val['type_name']?></option>
                            <?php foreach($val['son'] as $v){?>
                                <option value="<?php echo $v['type_id']?>"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". $v['type_name']?></option>
                            <?php }?>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">歌曲列表</label>
                <div class="col-sm-10">
                    <select name="song_id" id="song_id" class="form-control m-b" >
                        <option value="0">---请选择---</option>
                        <?php foreach($music as $val){?>
                            <option value="<?php echo $val['music_id']?>"><?php echo $val['music_name']?></option>
                        <?php }?>
                    </select>
                    <span id="check_song" style="color: #ff0000"></span>
                </div>
            </div>



            <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">类型封面</label>
                <div class="col-sm-10">
                    <input ui-jq="filestyle" type="file" name="img" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                </div>
            </div>
            <div class="line line-dashed b-b line-lg pull-in"></div>

            <div class="form-group">
                <label class="col-sm-2 control-label">分类介绍</label>
                <div class="col-sm-10">
                    <textarea ui-jq="wysiwyg" name="desc" class="form-control" style="overflow:scroll;height:200px;max-height:200px" placeholder="分类介绍。"></textarea>
                </div>
            </div>

            <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button type="reset" class="btn btn-default">重置</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="./jquery.js"></script>
<script>
    $(function(){
        $('#song_id').change(function(){
            var song_id = $('#song_id').val();
            var check_song = $('#check_song')
            var type_id = $('#type_id').val()
            $.ajax({
                type: "get",
                url: "?r=type/check-song",
                data: {song_id:song_id,type_id:type_id},
                success: function(msg){
                    if(msg == 0){
                        check_song.text("该歌曲在此类型下已经添加过，请使用其他类型").css("color","red");
                    }else if(msg==1){
                        check_song.text("该歌曲可以添加在此类型下").css("color","blue");
                    }
                }
            });
        });
    });
</script>
