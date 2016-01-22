<?php

/**
 * ModuleLink_v short summary.
 *
 * ModuleLink_v description.
 *
 * @version 1.0
 * @author Jozef
 */
class ModuleLink_v{
    public static function editor($container, $content, $operation){
	?>

	<form class="<?php echo $container["type"];  ?>_form form-horizontal" role="form" enctype="multipart/form-data" method="post"
      action="<?php echo $url;?>">
            <h1>Link</h1>
            <!--<h4 class="text-muted "> Module Container Data</h4><hr>-->
            <hr>
		    <div class="form-group">
		        <label class="control-label col-sm-2" for="cols">Width:</label>
		        <div class="col-sm-4">
		            <select id="cols" class="form-control" name="cols">
		                <option value="1" <?php echo  ((isset($container["cols"]) && $container["cols"]==1)?"selected":"");  ?>>1 column</option>
		                <option value="2" <?php echo  ((isset($container["cols"]) && $container["cols"]==2)?"selected":"");  ?>>2 columns</option>
		                <option value="3" <?php echo  ((isset($container["cols"]) && $container["cols"]==3)?"selected":"");  ?>>3 columns</option>
		                <option value="4" <?php echo  ((isset($container["cols"]) && $container["cols"]==4)?"selected":"");  ?>>4 columns</option>
		            </select>
		        </div>
		        <label class="control-label col-sm-2" for="rows">Height:</label>
		        <div class="col-sm-4">
		            <select id="rows" class="form-control col-sm-2" name="rows">
		                <option value="1" <?php echo  ((isset($container["rows"]) && $container["rows"]==1)?"selected":"");  ?>>1 row</option>
		                <option value="2" <?php echo  ((isset($container["rows"]) && $container["rows"]==2)?"selected":"");  ?>>2 rows</option>
		                <option value="3" <?php echo  ((isset($container["rows"]) && $container["rows"]==3)?"selected":"");  ?>>3 rows</option>
		                <option value="4" <?php echo  ((isset($container["rows"]) && $container["rows"]==4)?"selected":"");  ?>>4 rows</option>
		                <option value="0" <?php echo  ((isset($container["rows"]) && $container["rows"]==0)?"selected":"");  ?>>auto</option>
		            </select>
		        </div>
		    </div>

		    <div class="form-group">
		        <label class="control-label col-sm-2" for="status">Status:</label>
		        <div class="col-sm-4">
		            <select id="status" class="form-control" name="status">
		                <option value="0" <?php echo ((isset($container["status"]) && $container["status"]==0)?"selected":"");  ?>>Hidden</option>
		                <option value="1" <?php echo ((isset($container["status"]) && $container["status"]==1)?"selected":"");  ?>>Published</option>
		            </select>
		        </div>
		        <label class="control-label col-sm-2" for="me-order">Order:</label>
		        <div class="col-sm-4">
		            <select id="me-order" class="form-control" name="order">
		                <option value="0" selected>Last</option>
		                <?php
		                echo $order_options;
		                ?>
		            </select>
		        </div>
		    </div>

           	<!-- <h4 class="text-muted "> Module Content Data</h4> --><hr>
    	<div class="form-group">
        
        <div class="col-sm-6 col-xs-10 ">
            <button  type="button"  onclick="" class="btn btn-primary btn-block" > Internal Link</button>
        </div>
        <div class="col-sm-6 col-xs-10">
            <button  type="button"  onclick="" class="btn btn-danger btn-block "> External Link</button>
        </div>
    </div>
		
          <div class="form_result"></div>
    	  <button type="submit" onclick="return submitForm(this, '.<?php echo $container['type'];?>_form')" class="form_submit btn btn-success btn-block" data-loading-text=" Saving..." autocomplete="off"><i class="fa fa-check"></i> Save</button>
    	  <button type="reset" class="btn btn-warning btn-block"><i class="fa fa-undo"></i> Reset</button>
    	  <a onclick="location.reload()" class="btn btn-primary btn-block"><i class="fa fa-refresh"></i></a>
          </form>


    <?php
    }
    public static function module($container, $content, $editable){
    	?>
        <div class="module-container col-sm-<?php echo $container['cols'] * 3 ;?>">

		<?php
        if($editable){
         ?>
			<div class="module-buttons">
	      	<div class="row">
		      	<div class="col-md-6">
		      		<?php echo($container["status"]==1?"<i class=\"fa fa-eye\"></i>":"<i class=\"fa fa-eye-slash\"></i>").' #'.$container["id"];?>
		      	</div>
					<div class="col-md-6">
						<span class="pull-right">
		    				 <a onclick="updateModule('ModuleLink', <?php echo $container["id"];?>)"><i class="fa fa-pencil-square-o"></i></a>
                    		 <a onclick="deleteModule('ModuleLink', <?php echo $container["id"];?>)"><i class="fa fa-trash"></i></a>
		    			</span>
		    		</div>
		    	</div>

  			<div class="row">
            	<div class="col-xs-4"><strong>Child ID:</strong></div>
            	<div class="col-xs-8"><?php echo $content["id"];?></div>
       		</div>
	        <div class="row">
	            <div class="col-xs-4"><strong>Page:</strong></div>
	            <div class="col-xs-8"><?php echo $container["page_id"];?></div>
	        </div>
        	<div class="row">
	            <div class="col-xs-4"><strong>Type:</strong></div>
	            <div class="col-xs-8"><?php echo $container["type"];?></div>
        	</div>
        	<div class="row">
        		<div class="col-xs-4"><strong>Created:</strong></div>
            	<div class="col-xs-8"><?php echo $container["created"];?></div>
	        </div>
	        <div class="row">
	            <div class="col-xs-4"><strong>Created By:</strong></div>
	            <div class="col-xs-8"><?php echo $container["created_by"];?></div>
	        </div>
        	<div class="row">
            	<div class="col-xs-4"><strong>Edited:</strong></div>
            	<div class="col-xs-8"><?php echo $container["edited"];?></div>
	        </div>
	        <div class="row">
	            <div class="col-xs-4"><strong>Edited By:</strong></div>
	            <div class="col-xs-8"><?php echo $container["edited_by"];?></div>
	        </div>
	        <div class="row">
            	<div class="col-xs-4"><strong>Order:</strong></div>
            	<div class="col-xs-8"><?php echo $container["order"];?></div>
        	</div>
        <div class="row">
            <div class="col-xs-4"><strong>Status:</strong></div>
            <div class="col-xs-8"><?php echo $container["status"];?></div>
        </div>
    </div>

<script>
			   
</script>
<?php 
	}
?>
<div class="module-link  row-<?php echo $container['rows'] ;?> module">
   <div class="module-title ">
            <a class="help" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="bottom" title="<?php echo strtoupper($content['title']) ; ?>" data-content="<?php echo $content['description'] ;?>"><i class="fa fa-hashtag"></i><?php echo $content['title'] ; ?></a>
   </div>

</div>
</div>

<?php
}
}

?>