<div id="form_all">
 <form action=""  method="post" id="fa_asset"  name="fa_asset"><span class="heading">Fixed Asset Details</span>
  <div id ="form_header">
   <div id="tabsHeader">
    <ul class="tabMain">
     <li><a href="#tabsHeader-1">Basic</a></li>
     <li><a href="#tabsHeader-2">Tracking Info</a></li>
     <li><a href="#tabsHeader-3">Attachments</a></li>
     <li><a href="#tabsHeader-4">Note</a></li>
    </ul>
    <div class="tabContainer">
     <div id="tabsHeader-1" class="tabContent">
      <ul class="column header_field">
       <li><label><img src="<?php echo HOME_URL; ?>themes/images/serach.png" class="fa_asset_id select_popup clickable">
         Asset Id</label><?php $f->text_field_dsr('fa_asset_id') ?>
        <a name="show" href="form.php?class_name=fa_asset&<?php echo "mode=$mode"; ?>" class="show document_id fa_asset_id"><img src="<?php echo HOME_URL; ?>themes/images/refresh.png"/></a> 
       </li>
       <li><label>Asset Number</label><?php $f->text_field_d('asset_number'); ?></li>
       <li><label>Category</label><?php echo $f->select_field_from_object('fa_asset_category_id', fa_asset_category::find_all(), 'fa_asset_category_id', 'asset_category', $$class->fa_asset_category_id, 'fa_asset_category_id', '', 1); ?></li>
       <li><label>Status</label><?php echo $f->select_field_from_array('status', fa_asset::$status_a, $$class->status, 'status'); ?></li>
       <li><label>Units</label><?php $f->text_field_d('units'); ?></li>
       <li><label>Parent Asset</label><?php $f->text_field_d('parent_asset_id'); ?></li>
       <li><label>Description</label><?php $f->text_field_d('description'); ?></li>
      </ul>
     </div>
     <div id="tabsHeader-2" class="tabContent">
      <ul class="column header_field">
       <li><label>Tag Number</label><?php $f->text_field_d('tag_number'); ?></li>
       <li><label>Serial</label><?php $f->text_field_d('serial_number'); ?></li>
       <li><label>Key</label><?php $f->text_field_d('key_number'); ?></li>
       <li><label>Manufacturer</label><?php $f->text_field_d('manufacturer'); ?></li>
       <li><label>Model#</label><?php $f->text_field_d('model_number'); ?></li>
       <li><label>Warranty#</label><?php $f->text_field_d('warrranty_number'); ?></li>
       <li><label>Lease#</label><?php $f->text_field_d('lease_number'); ?></li>
       <li><label>Physical Inv?</label><?php echo $f->checkBox_field('physical_inventory_cb', $$class->physical_inventory_cb); ?></li>
       <li><label>Rev Number</label><?php $f->text_field_d('rev_number'); ?></li>
      </ul>
     </div>
     <div id="tabsHeader-3" class="tabContent">
      <div> <?php echo ino_attachement($file) ?> </div>
     </div>
     <div id="tabsHeader-4" class="tabContent">
      <div id="comments">
       <div id="comment_list">
        <?php echo!(empty($comments)) ? $comments : ""; ?>
       </div>
       <div id ="display_comment_form">
        <?php
        $reference_table = 'fa_asset';
        $reference_id = $$class->fa_asset_id;
        ?>
       </div>
       <div id="new_comment">
       </div>
      </div>
      <div> 
      </div>
     </div>
    </div>
   </div>
  </div>

 <div id ="form_line" class="form_line"><span class="heading">Asset Line Details </span>
  
    <div id="tabsLine">
   <ul class="tabMain">
    <li><a href="#tabsLine-1">Assignments</a></li>
    <li><a href="#tabsLine-2">Other Details</a></li>
 
   </ul>
   <div class="tabContainer"> 
    <div id="tabsLine-1" class="tabContent">
<table class="form_table">
       <thead> 
        <tr>
         <th>Action</th>
         <th>Line Id</th>
         <th>Units</th>
         <th>Employee</th>
         <th>Expense</th>
         <th>Address</th>
         <th>Description</th>
        </tr>
       </thead>
       <tbody class="form_data_line_tbody fa_asset_assignment_values" >
        <?php
        $count = 0;
        $f = new inoform();
        $fa_asset_assignment_object_ai = new ArrayIterator($fa_asset_assignment_object);
        $fa_asset_assignment_object_ai->seek($position);
        while ($fa_asset_assignment_object_ai->valid()) {
         $fa_asset_assignment = $fa_asset_assignment_object_ai->current();
         if (!empty($fa_asset_assignment->hr_employe_id)) {
          $emp_details_l = hr_employee::find_by_id($fa_asset_assignment->hr_employe_id);
          $fa_asset_assignment->employee_name = $emp_details_l->first_name . ' ' . $emp_details_l->last_name;
         } else {
          $fa_asset_assignment->employee_name = null;
         }
         ?>         
         <tr class="fa_asset_assignment<?php echo $count ?>">
          <td>    
           <ul class="inline_action">
            <li class="add_row_img"><img  src="<?php echo HOME_URL; ?>themes/images/add.png"  alt="add new line" /></li>
            <li class="remove_row_img"><img src="<?php echo HOME_URL; ?>themes/images/remove.png" alt="remove this line" /> </li>
            <li><input type="checkbox" name="line_id_cb" value="<?php echo htmlentities($fa_asset_assignment->fa_asset_assignment_id); ?>"></li>           
            <li><?php echo form::hidden_field('fa_asset_id', $$class->fa_asset_id); ?></li>
           </ul>
          </td>
          <td><?php form::number_field_wid2sr('fa_asset_assignment_id'); ?></td>
          <td><?php echo $f->number_field('units', $$class_second->units, '', '', 'line_units'); ?></td>
          <td><?php
           $f->text_field_wid2('employee_name', 'select employee');
           echo $f->hidden_field('hr_employe_id', $$class_second->hr_employe_id);
           ?><img src="<?php echo HOME_URL; ?>themes/images/serach.png" class="select_employee_name select_popup clickable"></td>
          <td><?php $f->ac_field_d2m('expense_ac_id'); ?></td>
          <td><?php $f->text_field_wid2('address_id'); ?></td>
          <td><?php $f->text_field_wid2('description'); ?></td>
         </tr>
         <?php
         $fa_asset_assignment_object_ai->next();
         if ($fa_asset_assignment_object_ai->key() == $position + $per_page) {
          break;
         }
         $count = $count + 1;
        }
        ?>
       </tbody>
      </table>
     <!--end of tab1 div three_column-->
    </div> 
        <div id="tabsLine-2" class="tabContent">
      <ul class='column four_column'>
       <li>
        <div class="btn-group row">
         <button type="button" class="btn btn-primary btn-lg">
          <span  aria-hidden="true"></span><i class='fa fa-book'></i> Asset Books</button>
         <button type="button" class="btn btn-primary dropdown-toggle btn-lg" data-toggle="dropdown" aria-expanded="false">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
         </button>
         <ul class="dropdown-menu" role="menu">
          <?php
          $ab = fa_asset_book::find_all();
          foreach ($ab as $ab_i) {
           echo '<li><a href="form.php?class=asset_book_info&asset_book_info_id=' . $ab_i->fa_asset_book_id . '">' . $ab_i->asset_book_name . '</a></li>';
          }
          ?>
         </ul>
        </div>
       </li>
       <li>      <button type="button" class="btn btn-primary btn-lg disabled">
         <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Source Lines
        </button>
       </li>

       <li>      <button type="button" class="btn btn-primary btn-lg disabled">
         <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Components
        </button>
       </li>

       <li>      <button type="button" class="btn btn-primary btn-lg disabled">
         <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Retirements
        </button>
       </li>

       <li class=" margin-top">      <button type="button" class="btn btn-primary btn-lg disabled">
         <i class="fa fa-money" aria-hidden="true"></i> Financial Inquiry
        </button>
       </li>

      </ul>

    </div>

   </div>


  </div>
  
  

 </div> 
 </form>
</div>


<div id="pagination" style="clear: both;">
 <?php echo $pagination->show_pagination(); ?>
</div>

<div id="js_data">
 <ul id="js_saving_data">
  <li class="headerClassName" data-headerClassName="fa_asset" ></li>
  <li class="lineClassName" data-lineClassName="fa_asset_assignment" ></li>
  <li class="savingOnlyHeader" data-savingOnlyHeader="false" ></li>
  <li class="primary_column_id" data-primary_column_id="fa_asset_id" ></li>
  <li class="form_header_id" data-form_header_id="fa_asset" ></li>
  <li class="line_key_field" data-line_key_field="line_type" ></li>
  <li class="single_line" data-single_line="false" ></li>
  <li class="form_line_id" data-form_line_id="fa_asset_assignment" ></li>
 </ul>
 <ul id="js_contextMenu_data">
  <li class="docHedaderId" data-docHedaderId="fa_asset_id" ></li>
  <li class="docLineId" data-docLineId="fa_asset_assignment_id" ></li>
  <li class="btn1DivId" data-btn1DivId="fa_asset" ></li>
  <li class="btn2DivId" data-btn2DivId="form_line" ></li>
  <li class="trClass" data-docHedaderId="fa_asset_assignment" ></li>
  <li class="tbodyClass" data-tbodyClass="form_data_line_tbody" ></li>
  <li class="noOfTabbs" data-noOfTabbs="3" ></li>
 </ul>
</div>