<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		#html code here.
		?>

<form action="<?=make_admin_url('banner', 'list_ops', 'list', 'id='.$id)?>" method="post">
  <table width="100%" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" class="table">
    <tr >
      <td colspan="5"  align="left">Banners</td>
      <td colspan="4"  align="right">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="9"  style="border-top:solid 1px #dcdcdc;"><?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=banner', 2);?></td>
    </tr>
  </table>
  <br/>
  <table width="100%" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" class="table">
    <tr>
      <td width="14%" class="table_head" align="center" valign="top">Sr.</td>
      <td width="28%" class="table_head" align="left">Image</td>
      <td width="31%" class="table_head" align="center">Name</td>
      <td width="27%"  align="center" class="table_head">Controls</td>
    </tr>
  </table>
  <br/>
  <table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" id="zebra" class="table">
    <? $sr=serialNo($QueryObj->PageNo,$QueryObj->PageSize); while($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
    <tr id="<?php $QueryObj1->id?>">
      <td width="16%" align="center" valign="middle"><?=$sr++;?>.</td>
      <td width="26%" align="left"><img src="<?=get_medium('banner',$QueryObj1->image);?>" width="100px"/></td>
      <td width="31%" align="center" style="padding-left:5px;"><?=$QueryObj1->name?>
      </td>
      <td width="27%" align="center"><?=make_admin_link(make_admin_url('banner', 'update', 'update', 'id='.$QueryObj1->id), get_control_icon('edit'));;?></td>
    </tr>
    <? endwhile;?>
  </table>
</form>
<?
		break;
	case 'insert':
		#html code here.
		?>

<?
		break;
	case 'update':
		#html code here.
		?>
<form id="banner" action="<?=make_admin_url('banner', 'update', 'list', 'id='.$id);?>" method="post" name="banner" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
    <tr>
      <td colspan="2" align="left"><?=make_admin_link(make_admin_url('banner', 'list', 'list'), 'Back to banner  listing')?></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="table_head">Update Banner</td>
    </tr>
    <tr>
      <td width="18%" align="left">Image</td>
      <td width="82%" align="left"><input type="file" name="image"  />
        <img src="<?=get_large('banner',$product->image)?>" width="100px"/></td>
    </tr>
    <tr>
      <td width="18%" align="left"></td>
      <td width="82%" align="left">You must upload a banner 277*146 pixels</td>
    </tr>
    <tr>
      <td width="17%" align="left">Name</td>
      <td width="83%" align="left"><input type="text" name="name" value="<?=$product->name?>" /></td>
    </tr>
    <tr>
      <td width="17%" align="left">Description</td>
      <td width="83%" align="left"><textarea name="description" rows="5" cols="50" ><?=$product->description?></textarea></td>
    </tr>
    <input type="hidden" name="id" value="<?=$product->id?>">
    <tr>
      <td width="18%" ></td>
      <td width="82%" align="left"><input type="submit" name="update_banner" value="Update" tabindex="9" /></td>
    </tr>
  </table>
</form>
<?
		break;
	case 'delete':
		#html code here.
		break;
	case 'more_op':
		?>
<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
  <tr>
    <td  ><?=make_admin_link(make_admin_url('product', 'list', 'list', 'id='.$product->parent_id), 'Back to prodcut listing')?></td>
    <td align="right"><?=make_admin_link(make_admin_url('product', 'bundle', 'bundle', 'id='.$id), 'Bundle Price')?></td>
  </tr>
  <tr>
    <td colspan="2" align="left" class="table_head">Product Operations</td>
  </tr>
</table>
<?php if(USE_RELATED_PRODUCT):?>
<form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="POST">
  <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table">
    <tr>
      <td class="table_head" colspan="2">Related Products</td>
    </tr>
    <tr>
      <td colspan="2"><?//=print_r($product_list);exit;?>
        <?php echo product_drop_down($product_list, 'rp_id[]', $selected_r_pro);?> </td>
    </tr>
    <tr>
      <td align="left"><input type="submit" name="related_product" value="Submit" style="width:150px;"></td>
      <td align="right"><input type="submit" name="related_product_clear" value="Clear All" style="width:150px;"></td>
    </tr>
  </table>
</form>
<br/>
<?endif;?>
<?if(USE_COPY_PRODUCT):?>
<form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="POST">
  <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table">
    <tr>
      <td class="table_head">Copy to category (s)</td>
    </tr>
    <tr>
      <td><?php echo category_drop_down($category_list, 'copy_to[]', 10, 'multiple');?> </td>
    </tr>
    <tr>
      <td align="left"><input type="submit" name="copy_product" value="Submit" style="width:150px;"></td>
    </tr>
  </table>
</form>
<br/>
<?endif;?>
<?if(USE_PRODUCT_ATTRIBUTE):?>
<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table">
  <tr>
    <td class="table_head"><span id="attributes">Manage Attributes</span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
        <tr>
          <td width="5%" class="table_head">Sr.</td>
          <td width="25%" class="table_head">Name</td>
          <td align="center" width="15%" class="table_head">Is Paid</td>
          <td align="center" width="15%" class="table_head">Values</td>
          <td align="center" width="15%" class="table_head">Edit</td>
          <td align="center" class="table_head">Delete</td>
        </tr>
      </table>
      <?php 
					$a_sr=1;
					while($att_object= $attribute->GetObjectFromRecord()):
						if($att_id==$att_object->id && $att_edit):
						?>
      <form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="POST">
        <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
          <tr>
            <td width="5%" align="center">&nbsp;</td>
            <td width="25%" align="left"><input type="text" name="name" value="<?php echo $att_object->name;?>" size="32"></td>
            <td width="15%" align="center"><input type="checkbox" name="is_paid" value="1" <?php echo ($att_object->is_paid)?'checked':'';?>></td>
            <td width="15%" align="center"> - </td>
            <td width="15%" align="center"> - </td>
            <td align="center"><input type="hidden" name="product_id" value="<?php echo $id?>">
              <input type="hidden" name="id" value="<?php echo $att_object->id?>">
              <input type="submit" name="edit_attribute" value="Done"></td>
          </tr>
        </table>
      </form>
      <?else:?>
      <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
        <tr>
          <td width="5%" align="center"><?php echo $a_sr++;?>.</td>
          <td width="25%" align="left"><?php echo ucfirst($att_object->name);?></td>
          <td width="15%" align="center"><?php echo ($att_object->is_paid)?'Paid':'FREE';?></td>
          <td width="15%" align="center"><?php echo '<a href="'.make_admin_url('product', 'more_op', 'more_op', 'att_id='.$att_object->id.'&att_value=1&id='.$id.'#attributes').'">Values</a>';?></td>
          <td width="15%" align="center"><?php echo '<a href="'.make_admin_url('product', 'more_op', 'more_op', 'att_id='.$att_object->id.'&att_edit=1&id='.$id.'#attributes').'">Edit</a>';?></td>
          <td align="center"><?php echo '<a href="'.make_admin_url('product', 'more_op', 'more_op', 'att_id='.$att_object->id.'&att_delete=1&id='.$id.'#attributes').'">Delete</a>';?></td>
        </tr>
      </table>
      <?endif;?>
      <?endwhile;?>
      <form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="POST">
        <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
          <tr>
            <td width="5%" align="center">&nbsp;</td>
            <td width="25%" align="left"><input type="text" name="name" value="" size="32"></td>
            <td width="15%" align="center"><input type="checkbox" name="is_paid" value="1"></td>
            <td width="15%" align="center"> - </td>
            <td width="15%" align="center"> - </td>
            <td align="center"><input type="hidden" name="product_id" value="<?php echo $id?>">
              <input type="submit" name="new_attribute" value="Done"></td>
          </tr>
        </table>
      </form>
      <?php if($att_value):?>
      <table width="100%" border="0" cellspacing="2" cellpadding="2" align="left" class="table">
        <tr>
          <td colspan="5"><?php echo $att_detail->name;?> &gt;&gt; Values</td>
        </tr>
        <tr>
          <td width="5%" class="table_head">Sr.</td>
          <td width="30%" class="table_head">Value</td>
          <td width="20%" class="table_head">Stock</td>
          <td class="table_head">Controls</td>
        </tr>
        <?php 
						$sr=1;
						while($obj= $attribute_values->GetObjectFromRecord()):?>
        <tr>
          <td><?php echo $sr++;?></td>
          <td><?php echo $obj->name;?></td>
          <td><?php echo $obj->stock;?></td>
          <td><a href="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&att_id='.$att_detail->id.'&delete_att_val=1&att_val_id='.$obj->id.'#attributes')?>">Delete</a> </td>
        </tr>
        <?php endwhile;?>
        <tr>
          <td colspan="5" ><form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&att_value=1&att_id='.$att_detail->id)?>" method="POST">
              <table width="100%" border="0" cellspacing="2" cellpadding="2" align="right">
                <tr>
                  <td width="5%">&nbsp;</td>
                  <td width="30%" align="left"><input type="text" name="name" size="25" tabindex="1"/></td>
                  <td width="20%" align="left"><input type="text" name="stock" size="5" tabindex="2" /></td>
                  <td><input type="hidden" name="attribute_id" value="<?php echo $att_id?>">
                    <input type="submit" name="attribute_value" value="Done" tabindex="6" /></td>
                </tr>
              </table>
            </form></td>
        </tr>
      </table>
      <?php endif;?>
    </td>
  </tr>
</table>
<?endif;?>
<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table">
  <tr>
    <td class="table_head"><span id="images">Images</span></td>
  </tr>
  <tr>
    <td><form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="post">
        <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table">
          <tr>
            <td width="30%" class="table_head">Thumbnail</td>
            <td width="50%" class="table_head" align="center">Position</td>
            <td class="table_head">Controls</td>
          </tr>
          <?while($img = $pimages->GetObjectFromRecord()):?>
          <tr>
            <td width="30%"><img src="<?php get_thumb('product', $img->image);?>"></td>
            <td width="50%" align="center"><input type="text" name="position[<?php echo $img->id?>]"  value="<?php echo $img->position?>"size="3"></td>
            <td><a href="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&delete_image=1&delete='.$img->id)?>">Delete</a></td>
          </tr>
          <?endwhile;?>
          <tr>
            <td width="30%" class="table_head">&nbsp;</td>
            <td width="50%" class="table_head" align="center"><input name="image_position" value="Update" type="submit"></td>
            <td class="table_head">&nbsp;</td>
          </tr>
        </table>
      </form>
      <form id="images" action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="post" name="images" enctype="multipart/form-data">
        <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table">
          <tr>
            <td width="30%"></td>
            <td width="50%"><input type="file" name="image" size="52" /></td>
            <td><input type="submit" name="image_upload" value="Upload" size="52" /></td>
          </tr>
        </table>
      </form></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
<?php
		break;
		
	case 'bundle':
	?>
<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
  <tr>
    <td colspan="2" ><?=make_admin_link(make_admin_url('product', 'more_op', 'more_op', 'id='.$id), 'Back to prodcut operation')?></td>
  </tr>
  <tr>
    <td colspan="2"  style="border-top:solid 1px #dcdcdc;"><?//=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=product&action=bundle&section=bundle&id='.$id, 2);?></td>
  </tr>
  <tr>
    <td colspan="2" align="left" class="table_head">Product Bundles</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
  <tr>
    <td  style="border-top:solid 1px #dcdcdc;" align="right"><a href="<?=make_admin_url('product', 'bundle', 'bundle', 'id='.$id.'&add_new_line='.($add_new_line+1))?>">
      <input type="submit" name="bundle_price" value="Add New Line">
      </a></td>
  </tr>
</table>
<form action="<?=make_admin_url('product', 'bundle', 'bundle', 'id='.$id)?>" method="post">
  <table width="100%" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" class="table">
    <tr>
      <td width="20%" class="table_head" align="center">Sr.</td>
      <td width="40%"  class="table_head" align="center">Quantity</td>
      <td  width="40%" class="table_head" align="center">Price(&pound;)</td>
    </tr>
  </table>
  <br/>
  <table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" id="zebra" class="table">
    <? $sr=1;while($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
    <tr >
      <td width="20%" align="center"><?= $sr++;?>
        .</td>
      <td width="40%" align="center"><input type="text" name="quantity[<?php echo $sr?>]" value="<?=$QueryObj1->quantity?>"  size="3"></td>
      <td width="40%" align="center"><input type="text" name="price[<?php echo $sr?>]" value="<?=number_format( $QueryObj1->price,2)?>"  size="3"></td>
    </tr>
    <? endwhile; ?>
    <?  for($i=$sr;$i<=$add_new_line;$i++): ?>
    <tr >
      <td width="20%" align="center"><?= $sr++;?></td>
      <td width="40%" align="center"><input type="text" name="quantity[<?php echo $sr?>]"  size="3"></td>
      <td width="40%" align="center"><input type="text" name="price[<?php echo $sr?>]"  size="3"></td>
    </tr>
    <? endfor;?>
    <tr>
      <td colspan="2"  style="border-top:solid 1px #dcdcdc;">&nbsp;</td>
      <td  align="right" style="border-top:solid 1px #dcdcdc;"><input type="submit" name="bundle_price" value="Done"></td>
    </tr>
  </table>
</form>
<? 
	break;	 
		
	default:break;
endswitch;
?>
