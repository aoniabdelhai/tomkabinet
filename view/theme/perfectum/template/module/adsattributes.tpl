<div class="box" id="box_searchat" style="overflow: auto;">
  <div class="box-heading"><?php echo $heading_title; ?></div>
<?php if ($position == 'content_top'  or $position == 'content_bottom') { ?>
  <div class="box-content" style="overflow: auto; padding-bottom:0;">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
      
<!--keywords      -->
<!--title-->
<?php if($this->config->get("searchat_title")){ ?> 
    <div class="cell-box">       
        <div class="searchtext"><?php echo $entry_title; ?></div>     
        <div class="searchinputfield">
           <input autocomplete="off" type="text" id="filter_title" name="filter_title" value="<?php echo $filter_title; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" />
        </div> 
     </div>    
<?php } ?> 

<!--author-->
<?php if($this->config->get("searchat_author")){ ?> 
    <div class="cell-box">       
        <div class="searchtext"><?php echo $entry_author; ?></div>     
        <div class="searchinputfield">
           <input autocomplete="off" type="text" id="filter_author" name="filter_author" value="<?php echo $filter_author; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" />
        </div> 
     </div>    
<?php } ?> 

<!--isbn-->
<?php if($this->config->get("searchat_isbn")){ ?> 
    <div class="cell-box">       
        <div class="searchtext"><?php echo $entry_isbn; ?></div>     
        <div class="searchinputfield">
           <input autocomplete="off" type="text" id="filter_isbn" name="filter_isbn" value="<?php echo $filter_isbn; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" />
        </div> 
     </div>    
<?php } ?> 

<!--category-->
    <div class="cell-box category-cell-box">       
        <div class="searchtext"><?php echo $entry_category; ?></div>     
        <div class="searchinputfield"> 
           <select name="filter_category_id" id="filter_category_id">
              <option value="0"><?php echo $text_category; ?></option>
              <?php array_shift($categories); ?>
              <?php foreach ($categories as $category) { ?>
              <?php if ($category['category_id'] == $filter_category_id) { ?>
              <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
        </div>
    </div>

<!--language-->
<?php if($this->config->get("searchat_language")){ ?> 
    <div class="cell-box">       
        <div class="searchtext"><?php echo $entry_language; ?></div>     
        <div class="searchinputfield">
           <select name="filter_language" id="filter_language">
              <option value="0"><?php echo $text_language; ?></option>
              <?php foreach ($languages as $language) { ?>
              <?php if ($language['language'] == '') continue; ?>
              <?php if ($language['language'] == $filter_language) { ?>
              <option value="<?php echo $language['language']; ?>" selected="selected"><?php echo $language['language']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $language['language']; ?>"><?php echo $language['language']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
        </div>
    </div>
<?php } ?>


<!--price-->
<?php if($this->config->get("searchat_price")){ ?> 
    <div class="cell-box">     
        <div class="searchtext"><?php echo $text_price; ?></div>     
        <div class="searchpricefield">
<?php echo $text_pricemin; ?>&nbsp;<input type="text" size="4" name="filter_pricemin" value="<?php echo $filter_pricemin; ?>" id="filter_pricemin" />&nbsp;&nbsp;<?php echo $text_pricemax; ?>&nbsp;<input type="text" size="4" name="filter_pricemax" value="<?php echo $filter_pricemax; ?>" id="filter_pricemax" />
        </div>
        </div>
    </div>
<?php } ?> 

<!--button-->
    <div class="cell-box-button">       
        <span id="loader"></span><input type="submit" value="Laat Tom voor je zoeken" class="det_button" />
    </div>

</form>
</div>      
      

<?php } elseif ($position == 'column_left' or $position == 'column_right') { ?>
<style>
    .cell-box {
        margin-bottom: 5px;
    }
    .cell-box-button {
        float: right; 
        height: 44px;
        padding-top: 14px;
        text-align: right;
    }
    #filter_name {
        width: 154px ;
    }   
    #filter_title {
       width: 154px; 
    }
    #filter_author {
       width: 154px; 
    }
    #filter_isbn {
       width: 154px; 
    }
    #filter_category_id {
        width: 158px;  
    }
    #filter_manufacturer_id {
        width: 158px;  
    }
    #filter_groups {
        width: 158px;  
    }
    #filter_attribute {
        width: 158px;  
    }
</style>  

 <div class="box-content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data"> 
     
<!--keywords-->
   <?php if($this->config->get("searchat_keywords")){ ?> 
         <div class="cell-box">
            <div><?php echo $entry_search; ?></div>
            <div><input autocomplete="off" style="width: 145px;" type="text" id="filter_name" name="filter_name" value="<?php echo $filter_name; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" /></div>    
            <div>
                    <?php if ($filter_description) { ?>
                        <input type="checkbox" name="filter_description" value="1" id="filter_description" checked="checked" />
                        <?php } else { ?>
                        <input type="checkbox" name="filter_description" value="0" id="filter_description" />
                        <?php } ?>
                        <label for="filter_description"><?php echo $entry_description; ?></label>
            </div>
        </div> 
   <?php } ?>
         
<!--title-->
  <?php if($this->config->get("searchat_title")){ ?>  
         <div class="cell-box">
            <div><?php echo $entry_title; ?></div>
            <div><input autocomplete="off" style="width: 145px;" type="text" id="filter_title" name="filter_title" value="<?php echo $filter_title; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" /></div>       
         </div>
  <?php } ?> 

<!--author-->
  <?php if($this->config->get("searchat_author")){ ?>  
         <div class="cell-box">
            <div><?php echo $entry_author; ?></div>
            <div><input autocomplete="off" style="width: 145px;" type="text" id="filter_author" name="filter_author" value="<?php echo $filter_author; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" /></div>       
         </div>
  <?php } ?> 

<!--isbn-->
  <?php if($this->config->get("searchat_isbn")){ ?>  
         <div class="cell-box">
            <div><?php echo $entry_isbn; ?></div>
            <div><input autocomplete="off" style="width: 145px;" type="text" id="filter_isbn" name="filter_isbn" value="<?php echo $isbn; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" /></div>       
         </div>
  <?php } ?> 
         
<!--category-->
         <div class="cell-box">
         <div><?php echo $entry_category; ?></div>
         <div id="category_id">
           <select name="filter_category_id" id="filter_category_id">
              <option value="0"><?php echo $text_category; ?></option>
              <?php array_shift($categories); ?>
              <?php foreach ($categories as $category) { ?>
              <?php if ($category['category_id'] == $filter_category_id) { ?>
              <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>             
         </div>
         <div>
              <?php if ($filter_sub_category) { ?>
              <input type="checkbox" name="filter_sub_category" value="1" id="sub_category" checked="checked" />
              <?php } else { ?>
              <input type="checkbox" name="filter_sub_category" value="1" id="sub_category" />
              <?php } ?>
              <label for="sub_category"><?php echo $text_sub_category; ?></label>             
         </div>
     </div>    

<!--manufacture-->
<?php if($this->config->get("searchat_brend")){ ?> 
         <div class="cell-box">
            <div><?php echo $entry_manufacture; ?></div>        
            <div><?php echo $manufacturers; ?></div>        
         </div> 
<?php } ?>


<!--groups-->
<?php if(is_array($this->config->get("searchat_att_group"))){ ?> 
<?php if($groups) {  ?> 
     <div  class="cell-box">
         <div><?php echo $entry_groups_attribute; ?></div>
         <div id="group"><?php echo $groups; ?></div>
     </div>
<?php } ?>

<!--attributes-->
<?php if($attributes) {  ?> 
     <div  class="cell-box">
         <div><?php echo $entry_attribute; ?></div>
         <div id="attribute"><?php echo $attributes; ?></div>
     </div>
<?php } ?>
<?php } ?>     
     
<!--price-->
<?php if($this->config->get("searchat_price")){ ?> 
         <div class="cell-box"> 
            <div><?php echo $text_price; ?></div>        
            <div><?php echo $text_pricemin; ?>&nbsp;<input type="text" size="4" name="filter_pricemin" value="<?php echo $filter_pricemin; ?>" id="filter_pricemin" />&nbsp;&nbsp;<?php echo $text_pricemax; ?>&nbsp;<input type="text" size="4" name="filter_pricemax" value="<?php echo $filter_pricemax; ?>" id="filter_pricemax" /></div>
         </div> 
<?php } ?>

<!-- button-->
         <div class="cell-box">
             <div style="text-align: right;">
                 <span id="loader"></span><input type="submit" value="<?php echo $button_search; ?>" class="button" />
             </div>   
         </div> 
   
</form>
 </div>  
 <?php } ?>

